@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
    <div class="mx-auto grid max-w-5xl overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm md:grid-cols-2">
        <section class="bg-emerald-950 px-6 py-10 text-white sm:px-10 sm:py-14">
            <p class="text-sm font-semibold uppercase tracking-[0.18em] text-emerald-300">Selamat datang</p>
            <h1 class="mt-4 max-w-sm text-3xl font-bold tracking-tight sm:text-4xl">Urus perjalanan, pengeluaran, dan kendaraan dalam satu tempat.</h1>
            <p class="mt-5 max-w-md leading-7 text-emerald-100/80">Munyopir membantu pekerjaan harian sopir pribadi tetap tertata, langsung dari ponsel.</p>
        </section>

        <section class="px-6 py-9 sm:px-10 sm:py-12">
            <h2 class="text-2xl font-bold tracking-tight text-slate-950">Masuk ke akun</h2>
            <p class="mt-2 text-sm text-slate-600">Lanjutkan mengelola aktivitas harian Anda.</p>

            <form method="POST" action="{{ route('login.store') }}" class="mt-8 space-y-5">
                @csrf
                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-base outline-none transition focus:border-emerald-700 focus:ring-4 focus:ring-emerald-700/10">
                    @error('email')
                        <p class="mt-2 text-sm text-red-700" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Kata sandi</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-base outline-none transition focus:border-emerald-700 focus:ring-4 focus:ring-emerald-700/10">
                    @error('password')
                        <p class="mt-2 text-sm text-red-700" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <label class="flex items-center gap-3 text-sm text-slate-600">
                    <input type="checkbox" name="remember" value="1" class="size-4 rounded border-slate-300 text-emerald-700 focus:ring-emerald-700">
                    Ingat saya di perangkat ini
                </label>

                <button type="submit" class="w-full rounded-xl bg-emerald-700 px-5 py-3.5 text-sm font-bold text-white transition hover:bg-emerald-800 focus:outline-none focus:ring-4 focus:ring-emerald-700/20">
                    Masuk
                </button>
            </form>

            <p class="mt-7 text-center text-sm text-slate-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-bold text-emerald-800 hover:underline">Daftar sekarang</a>
            </p>
        </section>
    </div>
@endsection
