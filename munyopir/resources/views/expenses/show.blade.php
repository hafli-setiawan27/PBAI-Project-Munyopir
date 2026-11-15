@extends('layouts.app')

@section('title', 'Detail pengeluaran')

@section('content')
    <div class="mx-auto max-w-3xl">
        <a href="{{ route('expenses.index') }}" class="text-sm font-semibold text-accent-700 hover:underline">← Kembali ke pengeluaran</a>

        <article class="mt-5 rounded-3xl border border-brand-100 bg-white p-6 shadow-xl shadow-brand-900/5 sm:p-9">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.16em] text-accent-700">Detail pengeluaran</p>
                    <h1 class="mt-3 text-3xl font-bold tracking-tight text-brand-950">{{ $expense->category->label() }}</h1>
                    <p class="mt-2 text-sm text-brand-800/80">{{ $expense->expense_date->locale('id')->translatedFormat('d F Y') }}</p>
                </div>
                <p class="rounded-2xl bg-brand-50 px-4 py-3 text-xl font-bold text-brand-950">Rp{{ number_format($expense->amount, 0, ',', '.') }}</p>
            </div>

            <dl class="mt-8 grid gap-5 border-t border-brand-100 pt-6 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-semibold text-brand-700">Perjalanan terkait</dt>
                    <dd class="mt-1 text-sm text-brand-950">{{ $expense->trip?->destination ?? 'Tidak terkait perjalanan' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-semibold text-brand-700">Catatan</dt>
                    <dd class="mt-1 whitespace-pre-line text-sm text-brand-950">{{ $expense->description ?: 'Tidak ada catatan' }}</dd>
                </div>
            </dl>

            @if ($expense->receipt_path)
                <a href="{{ route('expenses.receipt', $expense) }}" class="mt-6 inline-flex min-h-11 items-center justify-center rounded-xl border border-brand-200 px-4 py-3 text-sm font-semibold text-brand-900 transition hover:bg-brand-50">
                    Unduh foto nota
                </a>
            @endif

            <div class="mt-8 flex flex-wrap gap-3 border-t border-brand-100 pt-6">
                <a href="{{ route('expenses.edit', $expense) }}" class="inline-flex min-h-11 items-center justify-center rounded-xl bg-brand-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-brand-800">
                    Ubah pengeluaran
                </a>
                <form method="POST" action="{{ route('expenses.destroy', $expense) }}" onsubmit="return confirm('Hapus catatan pengeluaran ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex min-h-11 items-center justify-center rounded-xl border border-brand-200 px-5 py-3 text-sm font-semibold text-brand-800 hover:bg-brand-50">
                        Hapus
                    </button>
                </form>
            </div>
        </article>
    </div>
@endsection
