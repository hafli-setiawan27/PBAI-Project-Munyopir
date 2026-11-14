@extends('layouts.app')

@section('title', 'Tambah perjalanan')

@section('content')
    <div class="mx-auto max-w-2xl">
        <a href="{{ route('trips.index') }}" class="text-sm font-semibold text-emerald-800 hover:underline">← Kembali ke perjalanan</a>
        <div class="mt-5 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-9">
            <p class="text-sm font-semibold uppercase tracking-[0.16em] text-emerald-800">Jadwal perjalanan</p>
            <h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-950">Catat perjalanan baru</h1>
            <p class="mt-2 text-sm leading-6 text-slate-600">Simpan lokasi dan waktu penjemputan agar rencana perjalanan mudah dipantau.</p>

            @include('trips.partials.form', [
                'action' => route('trips.store'),
                'method' => 'POST',
                'trip' => null,
                'submitLabel' => 'Simpan jadwal',
            ])
        </div>
    </div>
@endsection
