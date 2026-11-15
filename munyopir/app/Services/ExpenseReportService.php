<?php

namespace App\Services;

use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;

class ExpenseReportService
{
    /**
     * @return array{
     *     total: int,
     *     count: int,
     *     by_category: Collection<string, int>
     * }
     */
    public function summarize(User $user, CarbonImmutable $start, CarbonImmutable $end): array
    {
        $expenses = $user->expenses()
            ->whereBetween('expense_date', [$start->startOfDay(), $end->endOfDay()]);

        return [
            'total' => (int) (clone $expenses)->sum('amount'),
            'count' => (clone $expenses)->count(),
            'by_category' => (clone $expenses)
                ->selectRaw('category, SUM(amount) as total')
                ->groupBy('category')
                ->pluck('total', 'category')
                ->map(fn (string|int $total): int => (int) $total),
        ];
    }
}
