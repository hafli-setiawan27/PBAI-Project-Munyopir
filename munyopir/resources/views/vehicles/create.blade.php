@extends('layouts.app')

@section('title', 'Tambah kendaraan')

@section('content')
    <div class="mx-auto max-w-2xl">
        <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-accent-700 hover:underline">← Kembali ke beranda</a>
        <div class="mt-5 rounded-3xl border border-brand-100 bg-white p-6 shadow-xl shadow-brand-900/5 sm:p-9">
            <p class="text-sm font-semibold uppercase tracking-[0.16em] text-accent-700">Langkah 1 dari 1</p>
            <h1 class="mt-3 text-3xl font-bold tracking-tight text-brand-950">Kenali kendaraan Anda</h1>
            <p class="mt-2 text-sm leading-6 text-slate-600">Simpan data kendaraan agar jadwal servis dan dokumen dapat dikelola di tahap berikutnya.</p>

            @include('vehicles.partials.form', [
                'action' => route('vehicles.store'),
                'method' => 'POST',
                'vehicle' => null,
                'submitLabel' => 'Simpan kendaraan',
            ])
        </div>
    </div>
@endsection
