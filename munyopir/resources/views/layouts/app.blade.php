<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Munyopir') · Munyopir</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-4 px-4 py-4 sm:px-6">
            <a href="{{ route('home') }}" class="flex items-center gap-3" aria-label="Munyopir, beranda">
                <span class="grid size-10 place-items-center rounded-xl bg-emerald-700 text-lg font-bold text-white">M</span>
                <span>
                    <span class="block text-lg font-bold tracking-tight text-slate-950">munyopir</span>
                    <span class="block text-xs text-slate-500">Asisten digital sopir pribadi</span>
                </span>
            </a>

            <nav class="flex items-center gap-2 sm:gap-4" aria-label="Navigasi utama">
                @auth
                    <a href="{{ route('dashboard') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Beranda</a>
                    <a href="{{ route('trips.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Perjalanan</a>
                    <a href="{{ route('vehicles.edit') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Kendaraan</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">Masuk</a>
                    <a href="{{ route('register') }}" class="rounded-lg bg-emerald-700 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-800">Daftar</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="mx-auto w-full max-w-6xl px-4 py-8 sm:px-6 sm:py-10">
        @if (session('status'))
            <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-900" role="status">
                {{ session('status') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
