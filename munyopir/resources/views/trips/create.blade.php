@extends('layouts.app')

@section('title', 'Tambah perjalanan')

@section('content')
    <div class="mx-auto max-w-2xl">
        <a href="{{ route('trips.index') }}" class="text-sm font-semibold text-accent-700 hover:underline">← Kembali ke perjalanan</a>
        <div class="mt-5 rounded-3xl border border-brand-100 bg-white p-6 shadow-xl shadow-brand-900/5 sm:p-9">
            <p class="text-sm font-semibold uppercase tracking-[0.16em] text-accent-700">Jadwal perjalanan</p>
            <h1 class="mt-3 text-3xl font-bold tracking-tight text-brand-950">Catat perjalanan baru</h1>
            <p class="mt-2 text-sm leading-6 text-brand-800/80">Simpan lokasi dan waktu penjemputan agar rencana perjalanan mudah dipantau.</p>

            @include('trips.partials.form', [
                'action' => route('trips.store'),
                'method' => 'POST',
                'trip' => null,
                'submitLabel' => 'Simpan jadwal',
            ])
        </div>
    </div>
@endsection
