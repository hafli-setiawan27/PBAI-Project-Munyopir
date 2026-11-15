<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Munyopir') · Munyopir</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-canvas text-brand-950 antialiased">
    <header class="border-b border-brand-100 bg-white">
        <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-4 px-4 py-4 sm:px-6">
            <a href="{{ route('home') }}" class="flex items-center gap-3" aria-label="Munyopir, beranda">
                <img src="{{ asset('logo-munyopir.svg') }}" alt="Logo Munyopir" class="size-10 shrink-0 rounded-xl">
                <span>
                    <span class="block text-lg font-bold tracking-tight text-brand-950">mun<span class="text-accent-600">yopir</span></span>
                    <span class="block text-xs text-brand-700/70">Asisten digital sopir pribadi</span>
                </span>
            </a>

            @auth
                <nav class="hidden items-center gap-2 sm:gap-4 lg:flex" aria-label="Navigasi utama">
                    <a href="{{ route('dashboard') }}" @class([
                        'rounded-lg px-3 py-2 text-sm font-medium transition',
                        'bg-brand-50 text-brand-950' => request()->routeIs('dashboard'),
                        'text-brand-800 hover:bg-brand-50' => ! request()->routeIs('dashboard'),
                    ]) @if (request()->routeIs('dashboard')) aria-current="page" @endif>Beranda</a>
                    <a href="{{ route('trips.index') }}" @class([
                        'rounded-lg px-3 py-2 text-sm font-medium transition',
                        'bg-brand-50 text-brand-950' => request()->routeIs('trips.*'),
                        'text-brand-800 hover:bg-brand-50' => ! request()->routeIs('trips.*'),
                    ]) @if (request()->routeIs('trips.*')) aria-current="page" @endif>Perjalanan</a>
                    <a href="{{ route('expenses.index') }}" @class([
                        'rounded-lg px-3 py-2 text-sm font-medium transition',
                        'bg-brand-50 text-brand-950' => request()->routeIs('expenses.*'),
                        'text-brand-800 hover:bg-brand-50' => ! request()->routeIs('expenses.*'),
                    ]) @if (request()->routeIs('expenses.*')) aria-current="page" @endif>Pengeluaran</a>
                    <a href="{{ route('vehicles.show') }}" @class([
                        'rounded-lg px-3 py-2 text-sm font-medium transition',
                        'bg-brand-50 text-brand-950' => request()->routeIs('vehicles.*'),
                        'text-brand-800 hover:bg-brand-50' => ! request()->routeIs('vehicles.*'),
                    ]) @if (request()->routeIs('vehicles.*')) aria-current="page" @endif>Kendaraan</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded-lg px-3 py-2 text-sm font-semibold text-brand-700 hover:bg-brand-50">Keluar</button>
                    </form>
                </nav>

                <form method="POST" action="{{ route('logout') }}" class="lg:hidden">
                    @csrf
                    <button type="submit" class="inline-flex min-h-11 items-center rounded-xl px-3 py-2 text-sm font-semibold text-brand-700 hover:bg-brand-50">
                        Keluar
                    </button>
                </form>
            @else
                <nav class="flex w-full items-center justify-center gap-2 sm:w-auto sm:gap-4" aria-label="Navigasi utama">
                    @if (request()->routeIs('home'))
                        <a href="#tentang" class="inline-flex min-h-11 items-center rounded-xl px-3 py-2 text-sm font-semibold text-brand-800 transition hover:bg-brand-50">Tentang</a>
                    @endif
                    <a href="{{ route('login') }}" class="inline-flex min-h-11 items-center rounded-xl px-3 py-2 text-sm font-semibold text-brand-800 hover:bg-brand-50">Masuk</a>
                    <a href="{{ route('register') }}" class="inline-flex min-h-11 items-center rounded-xl bg-brand-900 px-4 py-2 text-sm font-semibold text-white hover:bg-brand-800">Daftar</a>
                </nav>
            @endauth
        </div>
    </header>

    @auth
        <nav class="fixed inset-x-0 bottom-0 z-50 border-t border-brand-100 bg-white/95 px-2 pt-2 pb-2 shadow-lg shadow-brand-900/5 backdrop-blur-md lg:hidden" aria-label="Navigasi bawah">
            <div class="mx-auto flex max-w-lg items-center justify-around gap-1">
                <a href="{{ route('dashboard') }}" @class([
                    'flex min-h-14 flex-1 flex-col items-center justify-center gap-1 rounded-xl px-2 text-xs font-semibold transition',
                    'bg-brand-50 text-brand-950' => request()->routeIs('dashboard'),
                    'text-brand-700 hover:bg-brand-50' => ! request()->routeIs('dashboard'),
                ]) @if (request()->routeIs('dashboard')) aria-current="page" @endif>
                    <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1V10Z" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>Beranda</span>
                </a>
                <a href="{{ route('trips.index') }}" @class([
                    'flex min-h-14 flex-1 flex-col items-center justify-center gap-1 rounded-xl px-2 text-xs font-semibold transition',
                    'bg-brand-50 text-brand-950' => request()->routeIs('trips.*'),
                    'text-brand-700 hover:bg-brand-50' => ! request()->routeIs('trips.*'),
                ]) @if (request()->routeIs('trips.*')) aria-current="page" @endif>
                    <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M4 19V5m0 14h16M8 15l3-4 3 2 4-6" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="8" cy="15" r="1"/>
                        <circle cx="11" cy="11" r="1"/>
                        <circle cx="14" cy="13" r="1"/>
                        <circle cx="18" cy="7" r="1"/>
                    </svg>
                    <span>Perjalanan</span>
                </a>
                <a href="{{ route('expenses.index') }}" @class([
                    'flex min-h-14 flex-1 flex-col items-center justify-center gap-1 rounded-xl px-1 text-[11px] font-semibold transition',
                    'bg-brand-50 text-brand-950' => request()->routeIs('expenses.*'),
                    'text-brand-700 hover:bg-brand-50' => ! request()->routeIs('expenses.*'),
                ]) @if (request()->routeIs('expenses.*')) aria-current="page" @endif>
                    <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M5 4h14v16H5zM8 8h8M8 12h8M8 16h4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>Pengeluaran</span>
                </a>
                <a href="{{ route('vehicles.show') }}" @class([
                    'flex min-h-14 flex-1 flex-col items-center justify-center gap-1 rounded-xl px-2 text-xs font-semibold transition',
                    'bg-brand-50 text-brand-950' => request()->routeIs('vehicles.*'),
                    'text-brand-700 hover:bg-brand-50' => ! request()->routeIs('vehicles.*'),
                ]) @if (request()->routeIs('vehicles.*')) aria-current="page" @endif>
                    <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="m3 13 1.5-5A2 2 0 0 1 6.4 6.5h11.2A2 2 0 0 1 19.5 8l1.5 5v5h-3v-2H6v2H3v-5Z" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4 13h16M7 10h.01M17 10h.01" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>Kendaraan</span>
                </a>
            </div>
        </nav>
    @endauth

    <main class="mx-auto w-full max-w-6xl px-4 pt-8 sm:px-6 sm:pt-10 {{ auth()->check() ? 'pb-28 lg:pb-10' : 'pb-8 sm:pb-10' }}">
        @if (session('status'))
            <div class="mb-6 rounded-xl border border-accent-200 bg-accent-50 px-4 py-3 text-sm font-medium text-accent-900" role="status">
                {{ session('status') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
