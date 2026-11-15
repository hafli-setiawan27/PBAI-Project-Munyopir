@extends('layouts.app')

@section('title', 'Rekap pengeluaran')

@section('content')
    <section class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <a href="{{ route('expenses.index') }}" class="text-sm font-semibold text-accent-700 hover:underline">← Kembali ke pengeluaran</a>
            <p class="mt-5 text-sm font-semibold uppercase tracking-[0.14em] text-accent-700">Ringkasan biaya</p>
            <h1 class="mt-2 text-3xl font-bold tracking-tight text-brand-950">Rekap pengeluaran</h1>
            <p class="mt-2 text-sm leading-6 text-brand-800/80">
                {{ $period === 'harian' ? $start->locale('id')->translatedFormat('d F Y') : $start->locale('id')->translatedFormat('F Y') }}
            </p>
        </div>
        <a href="{{ route('expenses.create') }}" class="inline-flex min-h-11 items-center justify-center rounded-xl bg-brand-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-brand-800">
            + Catat pengeluaran
        </a>
    </section>

    <form method="GET" action="{{ route('expenses.report') }}" class="mt-7 grid gap-4 rounded-2xl border border-brand-100 bg-white p-5 sm:grid-cols-[1fr_1fr_auto] sm:items-end">
        <div>
            <label for="periode" class="mb-2 block text-sm font-semibold text-brand-800">Periode rekap</label>
            <select id="periode" name="periode" class="w-full rounded-xl border border-brand-200 bg-white px-4 py-3 text-base outline-none focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
                <option value="harian" @selected($period === 'harian')>Harian</option>
                <option value="bulanan" @selected($period === 'bulanan')>Bulanan</option>
            </select>
        </div>
        <div>
            <label for="tanggal" class="mb-2 block text-sm font-semibold text-brand-800">Pilih tanggal</label>
            <input id="tanggal" name="tanggal" type="date" value="{{ $date->format('Y-m-d') }}" class="w-full rounded-xl border border-brand-200 px-4 py-3 text-base outline-none focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
        </div>
        <button type="submit" class="inline-flex min-h-11 items-center justify-center rounded-xl border border-brand-200 px-5 py-3 text-sm font-bold text-brand-900 transition hover:bg-brand-50">
            Tampilkan rekap
        </button>
    </form>

    <section class="mt-6 grid gap-4 sm:grid-cols-2" aria-label="Ringkasan pengeluaran">
        <article class="rounded-2xl bg-brand-900 p-6 text-white shadow-lg shadow-brand-900/10">
            <p class="text-sm font-semibold text-white/75">Total pengeluaran</p>
            <p class="mt-2 text-3xl font-bold">Rp{{ number_format($summary['total'], 0, ',', '.') }}</p>
            <p class="mt-2 text-sm text-white/75">{{ $summary['count'] }} catatan</p>
        </article>
        <article class="rounded-2xl border border-brand-100 bg-white p-6">
            <h2 class="text-sm font-semibold text-brand-800">Rincian per kategori</h2>
            @if ($summary['by_category']->isEmpty())
                <p class="mt-3 text-sm text-brand-700/80">Belum ada pengeluaran pada periode ini.</p>
            @else
                <ul class="mt-3 space-y-3">
                    @foreach ($summary['by_category'] as $categoryValue => $total)
                        <li class="flex items-center justify-between gap-4 text-sm">
                            <span class="text-brand-800">{{ \App\Enums\ExpenseCategory::from($categoryValue)->label() }}</span>
                            <span class="font-semibold text-brand-950">Rp{{ number_format($total, 0, ',', '.') }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </article>
    </section>

    <section class="mt-7 space-y-4" aria-label="Rincian catatan pengeluaran">
        <h2 class="text-xl font-bold text-brand-950">Rincian pengeluaran</h2>
        @forelse ($expenses as $expense)
            <article class="flex flex-wrap items-center justify-between gap-4 rounded-2xl border border-brand-100 bg-white p-5">
                <a href="{{ route('expenses.show', $expense) }}" class="min-w-0 flex-1">
                    <h3 class="font-bold text-brand-950">{{ $expense->category->label() }}</h3>
                    <p class="mt-1 text-sm text-brand-800/80">
                        {{ $expense->expense_date->format('d/m/Y') }}
                        @if ($expense->trip)
                            <span aria-hidden="true">·</span> {{ $expense->trip->destination }}
                        @endif
                    </p>
                </a>
                <p class="font-bold text-brand-950">Rp{{ number_format($expense->amount, 0, ',', '.') }}</p>
            </article>
        @empty
            <div class="rounded-2xl border border-dashed border-brand-200 bg-white px-6 py-10 text-center">
                <p class="text-sm text-brand-800/80">Belum ada pengeluaran pada periode ini.</p>
            </div>
        @endforelse
    </section>

    @if ($expenses->hasPages())
        <div class="mt-6">
            {{ $expenses->links() }}
        </div>
    @endif
@endsection
