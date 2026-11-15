@extends('layouts.app')

@section('title', 'Pengaturan')

@section('content')
    <section class="mx-auto max-w-3xl">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.14em] text-accent-700">Akun Anda</p>
            <h1 class="mt-2 text-3xl font-bold tracking-tight text-brand-950">Pengaturan</h1>
            <p class="mt-2 text-sm leading-6 text-brand-800/80">Kelola akses akun Munyopir Anda.</p>
        </div>

        <section class="mt-6 overflow-hidden rounded-3xl border border-brand-100 bg-white shadow-sm">
            <div class="flex items-center gap-4 p-5 sm:p-6">
                <div class="flex size-12 shrink-0 items-center justify-center rounded-2xl bg-brand-50 text-brand-700" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" class="size-6" stroke="currentColor" stroke-width="1.8">
                        <circle cx="12" cy="8" r="3.5"/>
                        <path d="M5 20a7 7 0 0 1 14 0" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <h2 class="truncate text-lg font-bold text-brand-950">{{ auth()->user()->name }}</h2>
                    <p class="truncate text-sm text-brand-700/80">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <div class="flex flex-col gap-4 border-t border-brand-100 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
                <div>
                    <h2 class="font-bold text-brand-950">Keluar dari akun</h2>
                    <p class="mt-1 text-sm leading-6 text-brand-700/80">Akhiri sesi Anda di perangkat ini.</p>
                </div>
                <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Apakah kamu yakin ingin keluar ?')">
                    @csrf
                    <button type="submit" class="inline-flex min-h-11 w-full items-center justify-center rounded-xl border border-red-200 bg-white px-4 py-2.5 text-sm font-semibold text-red-700 transition hover:bg-red-50 focus:outline-none focus:ring-4 focus:ring-red-200/70 sm:w-auto">
                        Keluar
                    </button>
                </form>
            </div>
        </section>
    </section>
@endsection
