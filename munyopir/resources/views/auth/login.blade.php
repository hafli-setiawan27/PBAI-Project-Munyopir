@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
    <div class="mx-auto grid max-w-5xl overflow-hidden rounded-3xl border border-brand-100 bg-white shadow-xl shadow-brand-900/5 md:grid-cols-2">
        <section class="bg-brand-900 px-6 py-10 text-white sm:px-10 sm:py-14">
            <p class="text-sm font-semibold uppercase tracking-[0.18em] text-sky-400">Selamat datang</p>
            <h1 class="mt-4 max-w-sm text-3xl font-bold tracking-tight sm:text-4xl">Ayo urus perjalanan dan kendaraan mu menjadi lebih mudah</h1>
            <p class="mt-5 max-w-md leading-7 text-brand-100/90">Munyopir membantu pekerjaan harian sopir pribadi tetap tertata, langsung dari ponsel.</p>
        </section>

        <section class="px-6 py-9 sm:px-10 sm:py-12">
            <h2 class="text-2xl font-bold tracking-tight text-brand-950">Masuk ke akun</h2>
            <p class="mt-2 text-sm text-brand-800/80">Lanjutkan mengelola aktivitas harian Anda.</p>

            <form method="POST" action="{{ route('login.store') }}" class="mt-8 space-y-5">
                @csrf
                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold text-brand-800">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                        class="w-full rounded-xl border border-brand-200 px-4 py-3 text-base outline-none transition placeholder:text-brand-700/50 focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
                    @error('email')
                        <p class="mt-2 text-sm text-accent-700" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="mb-2 block text-sm font-semibold text-brand-800">Kata sandi</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password"
                        class="w-full rounded-xl border border-brand-200 px-4 py-3 text-base outline-none transition placeholder:text-brand-700/50 focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
                    @error('password')
                        <p class="mt-2 text-sm text-accent-700" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <label class="flex items-center gap-3 text-sm text-brand-800/80">
                    <input type="checkbox" name="remember" value="1" class="size-4 rounded border-brand-300 text-accent-600 focus:ring-accent-600">
                    Ingat saya di perangkat ini
                </label>

                <button type="submit" class="w-full rounded-xl bg-brand-900 px-5 py-3.5 text-sm font-bold text-white transition hover:bg-brand-800 focus:outline-none focus:ring-4 focus:ring-sky-400/40">
                    Masuk
                </button>
            </form>

            <p class="mt-7 text-center text-sm text-brand-800/80">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-bold text-accent-700 hover:underline">Daftar sekarang</a>
            </p>
        </section>
    </div>
@endsection
