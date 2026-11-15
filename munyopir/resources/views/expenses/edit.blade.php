@extends('layouts.app')

@section('title', 'Ubah pengeluaran')

@section('content')
    <div class="mx-auto max-w-2xl">
        <a href="{{ route('expenses.show', $expense) }}" class="text-sm font-semibold text-accent-700 hover:underline">← Kembali ke detail</a>
        <div class="mt-5 rounded-3xl border border-brand-100 bg-white p-6 shadow-xl shadow-brand-900/5 sm:p-9">
            <p class="text-sm font-semibold uppercase tracking-[0.16em] text-accent-700">Catatan biaya</p>
            <h1 class="mt-3 text-3xl font-bold tracking-tight text-brand-950">Ubah pengeluaran</h1>
            <p class="mt-2 text-sm leading-6 text-brand-800/80">Perbarui rincian biaya atau ganti bukti nota yang tersimpan.</p>

            @include('expenses.partials.form', [
                'action' => route('expenses.update', $expense),
                'method' => 'PUT',
                'expense' => $expense,
                'categories' => $categories,
                'trips' => $trips,
                'submitLabel' => 'Simpan perubahan',
            ])
        </div>
    </div>
@endsection
