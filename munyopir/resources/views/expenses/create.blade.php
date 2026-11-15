@extends('layouts.app')

@section('title', 'Catat pengeluaran')

@section('content')
    <div class="mx-auto max-w-2xl">
        <a href="{{ route('expenses.index') }}" class="text-sm font-semibold text-accent-700 hover:underline">← Kembali ke pengeluaran</a>
        <div class="mt-5 rounded-3xl border border-brand-100 bg-white p-6 shadow-xl shadow-brand-900/5 sm:p-9">
            <p class="text-sm font-semibold uppercase tracking-[0.16em] text-accent-700">Catatan biaya</p>
            <h1 class="mt-3 text-3xl font-bold tracking-tight text-brand-950">Catat pengeluaran</h1>
            <p class="mt-2 text-sm leading-6 text-brand-800/80">Simpan nominal dan bukti pengeluaran. Nota hanya bisa dibuka oleh akun Anda.</p>

            @include('expenses.partials.form', [
                'action' => route('expenses.store'),
                'method' => 'POST',
                'expense' => null,
                'categories' => $categories,
                'trips' => $trips,
                'submitLabel' => 'Simpan pengeluaran',
            ])
        </div>
    </div>
@endsection
