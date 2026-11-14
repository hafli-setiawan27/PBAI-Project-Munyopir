@extends('layouts.app')

@section('title', 'Profil kendaraan')

@section('content')
    <div class="mx-auto max-w-5xl">
        <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-accent-700 hover:underline">← Kembali ke beranda</a>

        <section class="mt-5 grid gap-5 md:grid-cols-[minmax(0,1.15fr)_minmax(18rem,0.85fr)]">
            <div class="relative flex min-h-72 items-center justify-center overflow-hidden rounded-3xl border border-sky-100 bg-linear-to-br from-sky-50 via-white to-accent-50 p-6 sm:min-h-96 sm:p-10">
                <div class="absolute -right-12 -top-16 size-56 rounded-full bg-white/80 blur-2xl" aria-hidden="true"></div>
                <div class="absolute -bottom-16 -left-10 size-48 rounded-full bg-sky-100/70 blur-2xl" aria-hidden="true"></div>
                <x-vehicle-illustration class="relative z-10 w-full max-w-[34rem] drop-shadow-xl" />
                <span class="absolute bottom-4 left-4 inline-flex items-center gap-2 rounded-full border border-white/80 bg-white/85 px-3 py-2 text-xs font-semibold text-brand-800 shadow-sm backdrop-blur sm:bottom-6 sm:left-6">
                    <span class="size-2 rounded-full bg-accent-600"></span>
                    Kendaraan terdaftar
                </span>
            </div>

            <article class="flex flex-col rounded-3xl border border-brand-100 bg-white p-6 shadow-sm sm:p-8">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.14em] text-accent-700">Profil kendaraan</p>
                        <h1 class="mt-2 text-2xl font-bold tracking-tight text-brand-950 sm:text-3xl">{{ $vehicle->name }}</h1>
                    </div>
                    <span class="flex size-11 shrink-0 items-center justify-center rounded-2xl bg-accent-50 text-accent-700" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8">
                            <path d="M3 13.5h18l-1.6-5a2 2 0 0 0-1.9-1.4H6.5a2 2 0 0 0-1.9 1.4L3 13.5Z" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4 13.5v4h2m12 0h2v-4M7 17.5h10M7 11h10" stroke-linecap="round" stroke-linejoin="round"/>
                            <circle cx="7" cy="15.5" r=".75" fill="currentColor"/>
                            <circle cx="17" cy="15.5" r=".75" fill="currentColor"/>
                        </svg>
                    </span>
                </div>

                <div class="mt-7 space-y-4">
                    <div class="rounded-2xl border border-brand-100 bg-canvas p-4">
                        <p class="text-xs font-semibold uppercase tracking-[0.12em] text-brand-700/70">Nomor polisi</p>
                        <div class="mt-2 inline-flex min-h-12 items-center rounded-lg border-2 border-brand-300 bg-white px-4 shadow-sm">
                            <span class="font-mono text-lg font-bold tracking-[0.16em] text-brand-950">{{ $vehicle->plate_number }}</span>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-brand-100 bg-canvas p-4">
                        <p class="text-xs font-semibold uppercase tracking-[0.12em] text-brand-700/70">Odometer saat ini</p>
                        <p class="mt-1 text-2xl font-bold tracking-tight text-brand-950">
                            {{ number_format($vehicle->current_odometer, 0, ',', '.') }}
                            <span class="text-sm font-semibold text-brand-700/70">km</span>
                        </p>
                    </div>
                </div>

                <p class="mt-5 text-sm leading-6 text-brand-800/80">Informasi ini digunakan untuk membantu mencatat perjalanan dan memantau kebutuhan perawatan kendaraan.</p>

                <a href="{{ route('vehicles.edit') }}" class="mt-auto inline-flex min-h-12 items-center justify-center gap-2 rounded-xl bg-brand-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-brand-800 focus:outline-none focus:ring-4 focus:ring-sky-400/40">
                    <svg viewBox="0 0 24 24" fill="none" class="size-4" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="m14 5 5 5M4 20l4.5-1 10-10a2.1 2.1 0 0 0-3-3l-10 10L4 20Z" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Ubah informasi kendaraan
                </a>
            </article>
        </section>
    </div>
@endsection
