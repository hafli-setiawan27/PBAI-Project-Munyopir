@extends('layouts.app')

@section('title', 'Tentang')

@section('content')
    <section class="relative isolate overflow-hidden rounded-3xl bg-brand-900 px-6 py-10 text-white shadow-2xl shadow-brand-900/10 sm:px-10 sm:py-14 lg:px-14 lg:py-16">
        <div class="pointer-events-none absolute -right-24 -top-32 -z-10 size-96 rounded-full bg-accent-600/25 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-40 left-1/3 -z-10 size-80 rounded-full bg-sky-400/20 blur-3xl"></div>

        <div class="grid items-center gap-10 lg:grid-cols-[1.1fr_0.9fr] lg:gap-14">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full border border-sky-400/30 bg-brand-800/80 px-3 py-1.5 text-xs font-semibold tracking-wide text-sky-200">
                    <span class="size-2 rounded-full bg-sky-400"></span>
                    Asisten digital sopir pribadi
                </span>
                <h1 class="mt-6 max-w-2xl text-4xl font-bold leading-tight tracking-tight sm:text-5xl">
                    Tentang
                    <span class="text-sky-400">Munyopir.</span>
                </h1>
                <p class="mt-5 max-w-xl text-base leading-7 text-brand-100/90 sm:text-lg sm:leading-8">
                    Munyopir membantu sopir pribadi mengatur perjalanan, menyimpan informasi kendaraan, dan mencatat kebutuhan operasional dalam satu tempat.
                </p>
                <p class="mt-4 max-w-xl text-sm leading-6 text-brand-100/80 sm:text-base">
                    Aplikasi web responsif ini dirancang agar informasi penting mudah diakses langsung dari browser ponsel.
                </p>
            </div>

            <x-app-preview />
        </div>
    </section>

    <x-developer-profile />
@endsection
