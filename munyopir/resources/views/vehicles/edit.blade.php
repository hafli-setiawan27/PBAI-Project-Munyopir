@extends('layouts.app')

@section('title', 'Kendaraan')

@section('content')
    <div class="mx-auto max-w-2xl">
        <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-accent-700 hover:underline">← Kembali ke beranda</a>
        <div class="mt-5 rounded-3xl border border-brand-100 bg-white p-6 shadow-xl shadow-brand-900/5 sm:p-9">
            <p class="text-sm font-semibold uppercase tracking-[0.16em] text-accent-700">Profil kendaraan</p>
            <h1 class="mt-3 text-3xl font-bold tracking-tight text-brand-950">Perbarui data kendaraan</h1>
            <p class="mt-2 text-sm leading-6 text-slate-600">Odometer terakhir akan digunakan sebagai dasar pengingat perawatan.</p>

            @include('vehicles.partials.form', [
                'action' => route('vehicles.update'),
                'method' => 'PUT',
                'vehicle' => $vehicle,
                'submitLabel' => 'Simpan perubahan',
            ])
        </div>
    </div>
@endsection
