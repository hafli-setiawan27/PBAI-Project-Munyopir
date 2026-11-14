@extends('layouts.app')

@section('title', 'Kendaraan')

@section('content')
    <div class="mx-auto max-w-5xl">
        <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-accent-700 hover:underline">← Kembali ke beranda</a>
        <div class="mt-5 rounded-3xl border border-brand-100 bg-white p-6 shadow-xl shadow-brand-900/5 sm:p-9">
            <div class="grid items-start gap-8 md:grid-cols-[minmax(0,1.15fr)_minmax(18rem,0.85fr)]">
                <div class="md:col-start-1 md:row-start-1">
                    <p class="text-sm font-semibold uppercase tracking-[0.16em] text-accent-700">Profil kendaraan</p>
                    <h1 class="mt-3 text-3xl font-bold tracking-tight text-brand-950">Perbarui data kendaraan</h1>
                    <p class="mt-2 text-sm leading-6 text-brand-800/80">Odometer terakhir akan digunakan sebagai dasar pengingat perawatan.</p>
                </div>

                <aside class="rounded-2xl border border-sky-100 bg-sky-50 p-4 sm:p-5 md:col-start-2 md:row-span-2 md:row-start-1">
                    <div class="flex min-h-40 items-center justify-center rounded-xl bg-white/70 px-4 py-4">
                        <x-vehicle-illustration class="max-w-[16rem]" />
                    </div>

                    <div class="mt-4 rounded-xl border border-brand-100 bg-white p-4">
                        <p class="text-xs font-semibold uppercase tracking-[0.14em] text-accent-700">Ringkasan kendaraan</p>
                        <p class="mt-2 text-lg font-bold text-brand-950">{{ $vehicle->name }}</p>
                        <div class="mt-4 grid grid-cols-2 gap-3">
                            <div>
                                <p class="text-xs text-brand-700/70">Nomor polisi</p>
                                <p class="mt-1 text-sm font-semibold text-brand-900">{{ $vehicle->plate_number }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-brand-700/70">Odometer</p>
                                <p class="mt-1 text-sm font-semibold text-brand-900">{{ number_format($vehicle->current_odometer, 0, ',', '.') }} km</p>
                            </div>
                        </div>
                    </div>
                </aside>

                <div class="md:col-start-1 md:row-start-2">
                    @include('vehicles.partials.form', [
                        'action' => route('vehicles.update'),
                        'method' => 'PUT',
                        'vehicle' => $vehicle,
                        'submitLabel' => 'Simpan perubahan',
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection
