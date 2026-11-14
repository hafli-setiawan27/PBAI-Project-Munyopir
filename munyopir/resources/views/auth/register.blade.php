@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
    <div class="mx-auto max-w-xl rounded-3xl border border-brand-100 bg-white px-6 py-8 shadow-xl shadow-brand-900/5 sm:px-10 sm:py-10">
        <p class="text-sm font-semibold uppercase tracking-[0.16em] text-accent-700">Mulai dengan Munyopir</p>
        <h1 class="mt-3 text-3xl font-bold tracking-tight text-brand-950">Buat akun sopir</h1>
        <p class="mt-2 text-sm leading-6 text-brand-800/80">Daftarkan akun untuk mengatur perjalanan dan kendaraan Anda.</p>

        <form method="POST" action="{{ route('register.store') }}" class="mt-8 space-y-5">
            @csrf
            <div>
                <label for="name" class="mb-2 block text-sm font-semibold text-brand-800">Nama lengkap</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name"
                    class="w-full rounded-xl border border-brand-200 px-4 py-3 text-base outline-none transition focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
                @error('name')
                    <p class="mt-2 text-sm text-accent-700" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="mb-2 block text-sm font-semibold text-brand-800">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email"
                    class="w-full rounded-xl border border-brand-200 px-4 py-3 text-base outline-none transition focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
                @error('email')
                    <p class="mt-2 text-sm text-accent-700" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-2 block text-sm font-semibold text-brand-800">Kata sandi</label>
                <input id="password" name="password" type="password" required autocomplete="new-password"
                    class="w-full rounded-xl border border-brand-200 px-4 py-3 text-base outline-none transition focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
                @error('password')
                    <p class="mt-2 text-sm text-accent-700" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-brand-800">Ulangi kata sandi</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                    class="w-full rounded-xl border border-brand-200 px-4 py-3 text-base outline-none transition focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
            </div>

            <button type="submit" class="w-full rounded-xl bg-brand-900 px-5 py-3.5 text-sm font-bold text-white transition hover:bg-brand-800 focus:outline-none focus:ring-4 focus:ring-sky-400/40">
                Buat akun
            </button>
        </form>

        <p class="mt-7 text-center text-sm text-brand-800/80">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-bold text-accent-700 hover:underline">Masuk</a>
        </p>
    </div>
@endsection
