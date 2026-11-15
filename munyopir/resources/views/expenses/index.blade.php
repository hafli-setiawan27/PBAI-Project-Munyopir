@extends('layouts.app')

@section('title', 'Pengeluaran')

@section('content')
    <section class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.14em] text-accent-700">Catatan biaya</p>
            <h1 class="mt-2 text-3xl font-bold tracking-tight text-brand-950">Pengeluaran</h1>
            <p class="mt-2 text-sm leading-6 text-brand-800/80">Catat biaya perjalanan dan simpan bukti pengeluaran dengan aman.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('expenses.report') }}" class="inline-flex min-h-11 items-center justify-center rounded-xl border border-brand-200 bg-white px-4 py-3 text-sm font-bold text-brand-900 transition hover:bg-brand-50">
                Lihat rekap
            </a>
            <a href="{{ route('expenses.create') }}" class="inline-flex min-h-11 items-center justify-center rounded-xl bg-brand-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-brand-800 focus:outline-none focus:ring-4 focus:ring-sky-400/40">
                + Catat pengeluaran
            </a>
        </div>
    </section>

    <section class="mt-7 space-y-4" aria-label="Daftar pengeluaran">
        @forelse ($expenses as $expense)
            <article class="rounded-2xl border border-brand-100 bg-white p-5 shadow-sm sm:p-6">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                    <a href="{{ route('expenses.show', $expense) }}" class="flex min-w-0 items-start gap-3 sm:gap-4 lg:flex-1">
                        @if ($expense->receipt_path)
                            <span class="h-32 w-24 shrink-0 overflow-hidden rounded-xl border border-brand-100 bg-brand-50 sm:h-36 sm:w-28">
                                <img src="{{ route('expenses.receipt.preview', $expense) }}" alt="Foto struk {{ $expense->category->label() }}" class="size-full object-contain" loading="lazy" decoding="async">
                            </span>
                        @endif
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-col items-start gap-2 sm:flex-row sm:flex-wrap sm:items-center sm:gap-3">
                                <h2 class="text-lg font-bold text-brand-950">{{ $expense->category->label() }}</h2>
                                <span class="rounded-full bg-brand-50 px-3 py-1 text-sm font-bold text-brand-900">Rp{{ number_format($expense->amount, 0, ',', '.') }}</span>
                            </div>
                            <p class="mt-2 text-sm text-brand-800/80">
                                {{ $expense->expense_date->format('d/m/Y') }}
                                @if ($expense->trip)
                                    <span aria-hidden="true">·</span> {{ $expense->trip->destination }}
                                @endif
                            </p>
                            @if ($expense->description)
                                <p class="mt-2 line-clamp-2 text-sm leading-6 text-brand-800">{{ $expense->description }}</p>
                            @endif
                        </div>
                    </a>

                    <div class="flex w-full flex-wrap items-center justify-end gap-2 lg:w-auto lg:shrink-0">
                        @if ($expense->receipt_path)
                            <a href="{{ route('expenses.receipt', $expense) }}" class="rounded-lg border border-brand-200 px-3 py-2 text-sm font-semibold text-brand-800 transition hover:border-accent-600 hover:text-accent-700">
                                Nota
                            </a>
                        @endif
                        <a href="{{ route('expenses.edit', $expense) }}" class="rounded-lg border border-brand-200 px-3 py-2 text-sm font-semibold text-brand-800 transition hover:border-accent-600 hover:text-accent-700">
                            Ubah
                        </a>
                        <form method="POST" action="{{ route('expenses.destroy', $expense) }}" onsubmit="return confirm('Hapus catatan pengeluaran ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-lg border border-sky-200 bg-sky-50 px-3 py-2 text-sm font-semibold text-brand-900 hover:bg-sky-100">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div class="rounded-2xl border border-dashed border-brand-200 bg-white px-6 py-12 text-center">
                <h2 class="text-lg font-bold text-brand-950">Belum ada pengeluaran</h2>
                <p class="mt-2 text-sm text-brand-800/80">Catat biaya pertama agar pengeluaran harian lebih mudah dipantau.</p>
                <a href="{{ route('expenses.create') }}" class="mt-5 inline-flex min-h-11 items-center justify-center rounded-xl bg-brand-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-brand-800">
                    Catat pengeluaran
                </a>
            </div>
        @endforelse
    </section>

    @if ($expenses->hasPages())
        <div class="mt-6">
            {{ $expenses->links() }}
        </div>
    @endif
@endsection
