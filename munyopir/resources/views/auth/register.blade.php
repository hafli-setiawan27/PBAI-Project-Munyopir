@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
    <div class="mx-auto max-w-xl rounded-3xl border border-slate-200 bg-white px-6 py-8 shadow-sm sm:px-10 sm:py-10">
        <p class="text-sm font-semibold uppercase tracking-[0.16em] text-emerald-800">Mulai dengan Munyopir</p>
        <h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-950">Buat akun sopir</h1>
        <p class="mt-2 text-sm leading-6 text-slate-600">Daftarkan akun untuk mengatur perjalanan dan kendaraan Anda.</p>

        <form method="POST" action="{{ route('register.store') }}" class="mt-8 space-y-5">
            @csrf
            <div>
                <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">Nama lengkap</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-base outline-none transition focus:border-emerald-700 focus:ring-4 focus:ring-emerald-700/10">
                @error('name')
                    <p class="mt-2 text-sm text-red-700" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-base outline-none transition focus:border-emerald-700 focus:ring-4 focus:ring-emerald-700/10">
                @error('email')
                    <p class="mt-2 text-sm text-red-700" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Kata sandi</label>
                <input id="password" name="password" type="password" required autocomplete="new-password"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-base outline-none transition focus:border-emerald-700 focus:ring-4 focus:ring-emerald-700/10">
                @error('password')
                    <p class="mt-2 text-sm text-red-700" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-slate-700">Ulangi kata sandi</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-base outline-none transition focus:border-emerald-700 focus:ring-4 focus:ring-emerald-700/10">
            </div>

            <button type="submit" class="w-full rounded-xl bg-emerald-700 px-5 py-3.5 text-sm font-bold text-white transition hover:bg-emerald-800 focus:outline-none focus:ring-4 focus:ring-emerald-700/20">
                Buat akun
            </button>
        </form>

        <p class="mt-7 text-center text-sm text-slate-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-bold text-emerald-800 hover:underline">Masuk</a>
        </p>
    </div>
@endsection
