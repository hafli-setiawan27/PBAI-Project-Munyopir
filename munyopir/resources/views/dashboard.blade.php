@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <section class="rounded-3xl bg-brand-900 px-6 py-8 text-white shadow-xl shadow-brand-900/10 sm:px-9 sm:py-10">
        <p class="text-sm font-semibold text-sky-400">Ruang kerja sopir pribadi</p>
        <h1 class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl">Halo, {{ $user->name }}.</h1>
        <p class="mt-3 max-w-2xl text-sm leading-6 text-brand-100/90 sm:text-base">Satu tempat untuk menjaga aktivitas dan kendaraan tetap siap menemani perjalanan.</p>
    </section>

    <section class="mt-8">
        <div class="flex flex-wrap items-end justify-between gap-3">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.14em] text-accent-700">Kendaraan Anda</p>
                <h2 class="mt-2 text-2xl font-bold tracking-tight text-brand-950">Informasi kendaraan</h2>
            </div>
            <a href="{{ route('vehicles.edit') }}" class="inline-flex min-h-11 items-center gap-2 rounded-xl border border-brand-200 bg-white px-4 py-2.5 text-sm font-semibold text-brand-800 transition hover:border-accent-600 hover:text-accent-700">
                <svg viewBox="0 0 24 24" fill="none" class="size-4" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path d="m14 5 5 5M4 20l4.5-1 10-10a2.1 2.1 0 0 0-3-3l-10 10L4 20Z" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Ubah kendaraan
            </a>
        </div>

        <div class="mt-5 grid gap-4 lg:grid-cols-[minmax(0,1.7fr)_minmax(15rem,0.8fr)]">
            <article class="overflow-hidden rounded-3xl border border-brand-100 bg-white shadow-sm">
                <div class="grid h-full md:grid-cols-2">
                    <div class="p-5 sm:p-7">
                        <p class="text-sm text-brand-700/70">Tipe kendaraan</p>
                        <h3 class="mt-2 text-xl font-bold text-brand-950">{{ $vehicle->name }}</h3>
                        <p class="mt-5 text-xs font-semibold uppercase tracking-[0.14em] text-brand-700/70">Nomor polisi</p>
                        <div class="mt-2 inline-flex min-h-11 items-center rounded-lg border-2 border-brand-200 bg-white px-3 py-2 shadow-sm">
                            <span class="font-mono text-base font-bold tracking-widest text-brand-950">{{ $vehicle->plate_number }}</span>
                        </div>
                    </div>

                    <div class="flex min-h-44 items-center justify-center bg-sky-50 px-5 py-7 sm:min-h-56">
                        <x-vehicle-illustration class="max-w-[18rem]" />
                    </div>
                </div>
            </article>

            <article class="rounded-3xl border border-brand-100 bg-white p-5 shadow-sm sm:p-6">
                <div class="flex size-11 items-center justify-center rounded-xl bg-accent-50 text-accent-700" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8">
                        <path d="M4 17a8 8 0 1 1 16 0M12 13l4-4M7 17h10" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="12" cy="17" r="1"/>
                    </svg>
                </div>
                <p class="mt-5 text-sm font-medium text-brand-700/70">Odometer saat ini</p>
                <p class="mt-1 text-3xl font-bold tracking-tight text-brand-950">
                    {{ number_format($vehicle->current_odometer, 0, ',', '.') }}
                    <span class="text-base font-semibold text-brand-700/70">km</span>
                </p>
                <p class="mt-3 text-sm leading-6 text-brand-800/80">Perbarui angka kilometer melalui tombol ubah kendaraan.</p>
            </article>
        </div>
    </section>

    <section class="mt-9">
        <div class="flex flex-wrap items-end justify-between gap-3">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.14em] text-accent-700">Rencana berikutnya</p>
                <h2 class="mt-2 text-2xl font-bold tracking-tight text-brand-950">Perjalanan mendatang</h2>
            </div>
            <a href="{{ route('trips.index') }}" class="rounded-xl border border-brand-200 bg-white px-4 py-2.5 text-sm font-semibold text-brand-800 transition hover:border-accent-600 hover:text-accent-700">
                Semua perjalanan
            </a>
        </div>

        <div class="mt-5 space-y-3">
            @forelse ($upcomingTrips as $trip)
                <article class="flex flex-wrap items-center justify-between gap-3 rounded-2xl border border-brand-100 bg-white p-4 shadow-sm sm:p-5">
                    <div class="min-w-0">
                        <h3 class="truncate font-bold text-brand-950">{{ $trip->destination }}</h3>
                        <p class="mt-1 truncate text-sm text-brand-800/80">Jemput di {{ $trip->pickup_location }}</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-semibold text-brand-800">{{ $trip->pickup_at->format('d/m/Y, H:i') }}</span>
                        <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $trip->status->badgeClasses() }}">
                            {{ $trip->status->label() }}
                        </span>
                    </div>
                </article>
            @empty
                <div class="rounded-2xl border border-dashed border-brand-200 bg-white p-6">
                    <p class="font-semibold text-brand-950">Belum ada perjalanan mendatang</p>
                    <p class="mt-1 text-sm text-brand-800/80">Tambahkan jadwal agar rencana penjemputan mudah dipantau.</p>
                </div>
            @endforelse
        </div>

        <a href="{{ route('trips.create') }}" class="mt-4 inline-flex min-h-11 items-center justify-center rounded-xl bg-brand-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-brand-800 focus:outline-none focus:ring-4 focus:ring-sky-400/40">
            + Tambah perjalanan
        </a>
    </section>
@endsection
