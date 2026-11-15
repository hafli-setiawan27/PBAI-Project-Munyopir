<?php

namespace App\Http\Controllers;

use App\Enums\ExpenseCategory;
use App\Http\Requests\ExpenseReportRequest;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;
use App\Services\ExpenseReportService;
use Carbon\CarbonImmutable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use RuntimeException;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExpenseController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('viewAny', Expense::class);

        return view('expenses.index', [
            'expenses' => $request->user()->expenses()
                ->with('trip')
                ->orderByDesc('expense_date')
                ->orderByDesc('id')
                ->paginate(10),
        ]);
    }

    public function create(Request $request): View
    {
        Gate::authorize('create', Expense::class);

        return view('expenses.create', [
            'categories' => ExpenseCategory::cases(),
            'trips' => $request->user()->trips()->orderByDesc('pickup_at')->get(),
        ]);
    }

    public function store(StoreExpenseRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $receipt = $validated['receipt'] ?? null;
        unset($validated['receipt']);

        $receiptPath = $receipt?->store('receipts', 'local');
        if ($receipt && $receiptPath === false) {
            throw new RuntimeException('Bukti pengeluaran gagal disimpan.');
        }

        $expense = $request->user()->expenses()->create([
            ...$validated,
            'receipt_path' => $receiptPath,
        ]);

        return redirect()
            ->route('expenses.show', $expense)
            ->with('status', 'Pengeluaran berhasil dicatat.');
    }

    public function show(Request $request, Expense $expense): View
    {
        $expense = $this->ownedExpense($request, $expense);
        Gate::authorize('view', $expense);

        return view('expenses.show', ['expense' => $expense->load('trip')]);
    }

    public function edit(Request $request, Expense $expense): View
    {
        $expense = $this->ownedExpense($request, $expense);
        Gate::authorize('update', $expense);

        return view('expenses.edit', [
            'expense' => $expense,
            'categories' => ExpenseCategory::cases(),
            'trips' => $request->user()->trips()->orderByDesc('pickup_at')->get(),
        ]);
    }

    public function update(UpdateExpenseRequest $request, Expense $expense): RedirectResponse
    {
        $expense = $this->ownedExpense($request, $expense);
        $validated = $request->validated();
        $receipt = $validated['receipt'] ?? null;
        unset($validated['receipt']);

        $previousReceiptPath = $expense->receipt_path;
        if ($receipt) {
            $receiptPath = $receipt->store('receipts', 'local');
            if ($receiptPath === false) {
                throw new RuntimeException('Bukti pengeluaran gagal disimpan.');
            }

            $validated['receipt_path'] = $receiptPath;
        }

        $expense->update($validated);

        if ($receipt && $previousReceiptPath !== null) {
            $this->deleteReceipt($previousReceiptPath);
        }

        return redirect()
            ->route('expenses.show', $expense)
            ->with('status', 'Pengeluaran berhasil diperbarui.');
    }

    public function destroy(Request $request, Expense $expense): RedirectResponse
    {
        $expense = $this->ownedExpense($request, $expense);
        Gate::authorize('delete', $expense);
        $receiptPath = $expense->receipt_path;
        $expense->delete();

        if ($receiptPath !== null) {
            $this->deleteReceipt($receiptPath);
        }

        return redirect()
            ->route('expenses.index')
            ->with('status', 'Pengeluaran berhasil dihapus.');
    }

    public function report(ExpenseReportRequest $request, ExpenseReportService $reportService): View
    {
        $validated = $request->validated();
        $period = $validated['periode'] ?? 'bulanan';
        $date = CarbonImmutable::createFromFormat(
            'Y-m-d',
            $validated['tanggal'] ?? CarbonImmutable::today()->toDateString(),
        );
        $start = $period === 'harian' ? $date->startOfDay() : $date->startOfMonth();
        $end = $period === 'harian' ? $date->endOfDay() : $date->endOfMonth();

        return view('expenses.report', [
            'period' => $period,
            'date' => $date,
            'start' => $start,
            'end' => $end,
            'summary' => $reportService->summarize($request->user(), $start, $end),
            'expenses' => $request->user()->expenses()
                ->with('trip')
                ->whereBetween('expense_date', [$start->startOfDay(), $end->endOfDay()])
                ->orderByDesc('expense_date')
                ->orderByDesc('id')
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    public function receipt(Request $request, Expense $expense): StreamedResponse
    {
        $expense = $this->ownedExpense($request, $expense);
        Gate::authorize('view', $expense);

        abort_if($expense->receipt_path === null, 404);

        $disk = Storage::disk('local');
        abort_unless($disk->exists($expense->receipt_path), 404);

        $stream = $disk->readStream($expense->receipt_path);
        if ($stream === false) {
            throw new RuntimeException('Bukti pengeluaran gagal dibaca.');
        }

        return response()->streamDownload(function () use ($stream): void {
            try {
                if (fpassthru($stream) === false) {
                    throw new RuntimeException('Bukti pengeluaran gagal dikirim.');
                }
            } finally {
                fclose($stream);
            }
        }, basename($expense->receipt_path), [
            'Content-Type' => $disk->mimeType($expense->receipt_path) ?? 'application/octet-stream',
        ]);
    }

    private function ownedExpense(Request $request, Expense $expense): Expense
    {
        return $request->user()->expenses()->findOrFail($expense->getKey());
    }

    private function deleteReceipt(string $path): void
    {
        if (! Storage::disk('local')->delete($path)) {
            throw new RuntimeException('Bukti pengeluaran gagal dihapus.');
        }
    }
}
