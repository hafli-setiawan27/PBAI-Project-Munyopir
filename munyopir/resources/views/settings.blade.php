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
                @if (auth()->user()->profile_photo_path)
                    <img src="{{ route('settings.profile-photo') }}" alt="Foto profil {{ auth()->user()->name }}" class="size-14 shrink-0 rounded-2xl border border-brand-100 object-cover">
                @else
                    <div class="flex size-14 shrink-0 items-center justify-center rounded-2xl bg-brand-50 text-brand-700" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" class="size-6" stroke="currentColor" stroke-width="1.8">
                            <circle cx="12" cy="8" r="3.5"/>
                            <path d="M5 20a7 7 0 0 1 14 0" stroke-linecap="round"/>
                        </svg>
                    </div>
                @endif
                <div class="min-w-0">
                    <h2 class="truncate text-lg font-bold text-brand-950">{{ auth()->user()->name }}</h2>
                    <p class="truncate text-sm text-brand-700/80">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <form method="POST" action="{{ route('settings.profile.update') }}" enctype="multipart/form-data" class="space-y-5 border-t border-brand-100 p-5 sm:p-6">
                @csrf
                @method('PATCH')
                <div>
                    <h2 class="text-lg font-bold text-brand-950">Informasi akun</h2>
                    <p class="mt-1 text-sm leading-6 text-brand-700/80">Perbarui nama dan email yang terhubung ke akun Anda.</p>
                </div>

                <div>
                    <label for="name" class="mb-2 block text-sm font-semibold text-brand-800">Nama lengkap</label>
                    <input id="name" name="name" type="text" value="{{ old('name', auth()->user()->name) }}" required autocomplete="name"
                        class="w-full rounded-xl border border-brand-200 px-4 py-3 text-base outline-none transition focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
                    @error('name')
                        <p class="mt-2 text-sm text-accent-700" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold text-brand-800">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', auth()->user()->email) }}" required autocomplete="email"
                        class="w-full rounded-xl border border-brand-200 px-4 py-3 text-base outline-none transition focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
                    @error('email')
                        <p class="mt-2 text-sm text-accent-700" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="profile_photo" class="mb-2 block text-sm font-semibold text-brand-800">Foto profil</label>
                    <input id="profile_photo" name="profile_photo" type="file" accept="image/jpeg,image/png,image/webp"
                        class="block w-full rounded-xl border border-brand-200 bg-white px-3 py-3 text-sm text-brand-800 file:mr-4 file:rounded-lg file:border-0 file:bg-brand-50 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-brand-900">
                    <p class="mt-2 text-xs leading-5 text-brand-700/70">Pilih foto JPG, PNG, atau WebP dengan ukuran maksimal 2 MB.</p>
                    @error('profile_photo')
                        <p class="mt-2 text-sm text-accent-700" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="inline-flex min-h-11 w-full items-center justify-center rounded-xl bg-brand-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-brand-800 focus:outline-none focus:ring-4 focus:ring-sky-400/40 sm:w-auto">
                        Simpan perubahan
                    </button>
                </div>
            </form>
        </section>

        <section class="mt-5 overflow-hidden rounded-3xl border border-brand-100 bg-white shadow-sm">
            <form method="POST" action="{{ route('settings.password.update') }}" class="space-y-5 p-5 sm:p-6">
                @csrf
                @method('PATCH')
                <div>
                    <h2 class="text-lg font-bold text-brand-950">Ubah kata sandi</h2>
                    <p class="mt-1 text-sm leading-6 text-brand-700/80">Masukkan kata sandi saat ini sebelum membuat kata sandi baru.</p>
                </div>

                <div>
                    <label for="current_password" class="mb-2 block text-sm font-semibold text-brand-800">Kata sandi saat ini</label>
                    <div class="relative">
                        <input id="current_password" name="current_password" type="password" required autocomplete="current-password"
                            class="w-full rounded-xl border border-brand-200 px-4 py-3 pr-12 text-base outline-none transition focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
                        <button type="button" data-password-toggle aria-controls="current_password" aria-label="Tampilkan kata sandi" aria-pressed="false"
                            class="absolute inset-y-0 right-0 flex min-h-11 w-12 items-center justify-center rounded-r-xl text-brand-700 transition hover:text-brand-950 focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-accent-600/20">
                            <svg data-password-hidden-icon viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path d="M2.5 12s3.4-6 9.5-6 9.5 6 9.5 6-3.4 6-9.5 6-9.5-6-9.5-6Z" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="12" cy="12" r="2.5"/>
                            </svg>
                            <svg data-password-visible-icon viewBox="0 0 24 24" fill="none" class="hidden size-5" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path d="m3 3 18 18M10.6 6.2A10.8 10.8 0 0 1 12 6c6.1 0 9.5 6 9.5 6a16 16 0 0 1-3.2 3.7M6.2 6.2C3.8 7.7 2.5 12 2.5 12s3.4 6 9.5 6a10 10 0 0 0 3.1-.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9.9 9.9a3 3 0 0 0 4.2 4.2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                    @error('current_password')
                        <p class="mt-2 text-sm text-accent-700" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="mb-2 block text-sm font-semibold text-brand-800">Kata sandi baru</label>
                    <div class="relative">
                        <input id="password" name="password" type="password" required autocomplete="new-password"
                            class="w-full rounded-xl border border-brand-200 px-4 py-3 pr-12 text-base outline-none transition focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
                        <button type="button" data-password-toggle aria-controls="password" aria-label="Tampilkan kata sandi" aria-pressed="false"
                            class="absolute inset-y-0 right-0 flex min-h-11 w-12 items-center justify-center rounded-r-xl text-brand-700 transition hover:text-brand-950 focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-accent-600/20">
                            <svg data-password-hidden-icon viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path d="M2.5 12s3.4-6 9.5-6 9.5 6 9.5 6-3.4 6-9.5 6-9.5-6-9.5-6Z" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="12" cy="12" r="2.5"/>
                            </svg>
                            <svg data-password-visible-icon viewBox="0 0 24 24" fill="none" class="hidden size-5" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path d="m3 3 18 18M10.6 6.2A10.8 10.8 0 0 1 12 6c6.1 0 9.5 6 9.5 6a16 16 0 0 1-3.2 3.7M6.2 6.2C3.8 7.7 2.5 12 2.5 12s3.4 6 9.5 6a10 10 0 0 0 3.1-.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9.9 9.9a3 3 0 0 0 4.2 4.2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-accent-700" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-brand-800">Konfirmasi kata sandi baru</label>
                    <div class="relative">
                        <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                            class="w-full rounded-xl border border-brand-200 px-4 py-3 pr-12 text-base outline-none transition focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
                        <button type="button" data-password-toggle aria-controls="password_confirmation" aria-label="Tampilkan kata sandi" aria-pressed="false"
                            class="absolute inset-y-0 right-0 flex min-h-11 w-12 items-center justify-center rounded-r-xl text-brand-700 transition hover:text-brand-950 focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-accent-600/20">
                            <svg data-password-hidden-icon viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path d="M2.5 12s3.4-6 9.5-6 9.5 6 9.5 6-3.4 6-9.5 6-9.5-6-9.5-6Z" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="12" cy="12" r="2.5"/>
                            </svg>
                            <svg data-password-visible-icon viewBox="0 0 24 24" fill="none" class="hidden size-5" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path d="m3 3 18 18M10.6 6.2A10.8 10.8 0 0 1 12 6c6.1 0 9.5 6 9.5 6a16 16 0 0 1-3.2 3.7M6.2 6.2C3.8 7.7 2.5 12 2.5 12s3.4 6 9.5 6a10 10 0 0 0 3.1-.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9.9 9.9a3 3 0 0 0 4.2 4.2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="inline-flex min-h-11 w-full items-center justify-center rounded-xl bg-brand-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-brand-800 focus:outline-none focus:ring-4 focus:ring-sky-400/40 sm:w-auto">
                        Perbarui kata sandi
                    </button>
                </div>
            </form>
        </section>

        <section class="mt-5 overflow-hidden rounded-3xl border border-brand-100 bg-white shadow-sm">
            <div class="flex flex-col gap-4 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
                <div>
                    <h2 class="font-bold text-brand-950">Keluar dari akun</h2>
                    <p class="mt-1 text-sm leading-6 text-brand-700/80">Akhiri sesi Anda di perangkat ini.</p>
                </div>
                <button type="button" data-logout-dialog-open class="inline-flex min-h-11 w-full items-center justify-center rounded-xl border border-red-200 bg-white px-4 py-2.5 text-sm font-semibold text-red-700 transition hover:bg-red-50 focus:outline-none focus:ring-4 focus:ring-red-200/70 sm:w-auto">
                    Keluar
                </button>
            </div>
        </section>
    </section>

    <dialog data-logout-dialog aria-labelledby="logout-dialog-title" aria-describedby="logout-dialog-description"
        class="fixed inset-0 m-0 h-full max-h-full w-full max-w-none border-0 bg-transparent p-0 text-inherit backdrop:bg-brand-950/60 backdrop:backdrop-blur-sm">
        <div class="flex min-h-full items-end justify-center sm:items-center sm:p-4">
            <section class="w-full rounded-t-3xl border border-brand-100 bg-white p-5 shadow-2xl shadow-brand-950/20 sm:max-w-md sm:rounded-3xl sm:p-6">
                <div class="flex items-start gap-4">
                    <div class="flex size-12 shrink-0 items-center justify-center rounded-2xl bg-red-50 text-red-600" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" class="size-6" stroke="currentColor" stroke-width="1.8">
                            <path d="M10 4H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h5M14 16l4-4-4-4m4 4H9" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="pt-0.5">
                        <h2 id="logout-dialog-title" class="text-lg font-bold text-brand-950">Keluar dari akun?</h2>
                        <p id="logout-dialog-description" class="mt-1.5 text-sm leading-6 text-brand-700/80">Apakah kamu yakin ingin keluar dari akun Munyopir?</p>
                    </div>
                </div>

                <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <button type="button" data-logout-dialog-close autofocus class="inline-flex min-h-11 w-full items-center justify-center rounded-xl border border-brand-200 bg-white px-4 py-2.5 text-sm font-semibold text-brand-800 transition hover:bg-brand-50 focus:outline-none focus:ring-4 focus:ring-brand-200/70 sm:w-auto">
                        Batal
                    </button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex min-h-11 w-full items-center justify-center rounded-xl bg-red-600 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300/70 sm:w-auto">
                            Ya, keluar
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </dialog>
@endsection
