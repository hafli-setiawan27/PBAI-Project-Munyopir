@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <section class="rounded-3xl bg-emerald-950 px-6 py-8 text-white sm:px-9 sm:py-10">
        <p class="text-sm font-semibold text-emerald-300">Ruang kerja sopir pribadi</p>
        <h1 class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl">Halo, {{ $user->name }}.</h1>
        <p class="mt-3 max-w-2xl text-sm leading-6 text-emerald-100/80 sm:text-base">Satu tempat untuk menjaga aktivitas dan kendaraan tetap siap menemani perjalanan.</p>
    </section>

    <section class="mt-8">
        <div class="flex flex-wrap items-end justify-between gap-3">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.14em] text-emerald-800">Kendaraan Anda</p>
                <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-950">Profil kendaraan</h2>
            </div>
            <a href="{{ route('vehicles.edit') }}" class="rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 hover:border-emerald-700 hover:text-emerald-800">
                Ubah data
            </a>
        </div>

        <div class="mt-5 grid gap-4 sm:grid-cols-3">
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:col-span-2">
                <p class="text-sm text-slate-500">Kendaraan</p>
                <p class="mt-2 text-xl font-bold text-slate-950">{{ $vehicle->name }}</p>
                <p class="mt-1 text-sm font-medium uppercase tracking-wide text-slate-600">{{ $vehicle->plate_number }}</p>
            </article>
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-slate-500">Odometer terakhir</p>
                <p class="mt-2 text-xl font-bold text-slate-950">{{ number_format($vehicle->current_odometer, 0, ',', '.') }} <span class="text-sm font-semibold text-slate-500">km</span></p>
                <p class="mt-1 text-sm text-slate-500">Perbarui setelah mencatat jarak tempuh.</p>
            </article>
        </div>
    </section>

    <section class="mt-9">
        <div class="flex flex-wrap items-end justify-between gap-3">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.14em] text-emerald-800">Rencana berikutnya</p>
                <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-950">Perjalanan mendatang</h2>
            </div>
            <a href="{{ route('trips.index') }}" class="rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 hover:border-emerald-700 hover:text-emerald-800">
                Semua perjalanan
            </a>
        </div>

        <div class="mt-5 space-y-3">
            @forelse ($upcomingTrips as $trip)
                <article class="flex flex-wrap items-center justify-between gap-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-5">
                    <div class="min-w-0">
                        <h3 class="truncate font-bold text-slate-950">{{ $trip->destination }}</h3>
                        <p class="mt-1 truncate text-sm text-slate-600">Jemput di {{ $trip->pickup_location }}</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-semibold text-slate-700">{{ $trip->pickup_at->format('d/m/Y, H:i') }}</span>
                        <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $trip->status->badgeClasses() }}">
                            {{ $trip->status->label() }}
                        </span>
                    </div>
                </article>
            @empty
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-6">
                    <p class="font-semibold text-slate-900">Belum ada perjalanan mendatang</p>
                    <p class="mt-1 text-sm text-slate-600">Tambahkan jadwal agar rencana penjemputan mudah dipantau.</p>
                </div>
            @endforelse
        </div>

        <a href="{{ route('trips.create') }}" class="mt-4 inline-flex min-h-11 items-center justify-center rounded-xl bg-emerald-700 px-5 py-3 text-sm font-bold text-white transition hover:bg-emerald-800">
            + Tambah perjalanan
        </a>
    </section>
@endsection
