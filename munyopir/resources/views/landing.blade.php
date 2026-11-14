@extends('layouts.app')

@section('title', 'Asisten digital sopir pribadi')

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
                <h1 class="mt-6 max-w-2xl text-4xl font-bold leading-tight tracking-tight sm:text-5xl lg:text-6xl">
                    Kerja lebih tertata,
                    <span class="text-sky-400">perjalanan lebih tenang.</span>
                </h1>
                <p class="mt-5 max-w-xl text-base leading-7 text-brand-100/90 sm:text-lg sm:leading-8">
                    Atur jadwal penjemputan, simpan informasi kendaraan, dan siapkan catatan operasional harian dalam satu tempat yang nyaman dibuka dari ponsel.
                </p>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('register') }}" class="inline-flex min-h-12 items-center justify-center rounded-xl bg-sky-400 px-6 py-3 text-sm font-bold text-brand-950 transition hover:bg-sky-300 focus:outline-none focus:ring-4 focus:ring-sky-400/40">
                        Mulai gunakan Munyopir
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex min-h-12 items-center justify-center rounded-xl border border-white/20 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10 focus:outline-none focus:ring-4 focus:ring-white/20">
                        Saya sudah punya akun
                    </a>
                </div>
                <p class="mt-4 text-xs leading-5 text-brand-100/70">Aplikasi web responsif—langsung dibuka dari browser, tanpa instalasi.</p>
            </div>

            <div class="mx-auto w-full max-w-md">
                <div class="rounded-[2rem] border border-white/15 bg-white/10 p-3 shadow-2xl shadow-brand-950/40 backdrop-blur">
                    <div class="rounded-[1.5rem] bg-canvas p-5 text-brand-950 sm:p-6">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.14em] text-accent-700">Ruang kerja Anda</p>
                                <p class="mt-1 text-xl font-bold tracking-tight">Hari ini</p>
                            </div>
                            <span class="grid size-10 place-items-center rounded-xl bg-sky-100 text-brand-900" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8">
                                    <path d="M7 3v3m10-3v3M4 9h16M5 5h14a1 1 0 0 1 1 1v13H4V6a1 1 0 0 1 1-1Z" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </div>

                        <div class="mt-6 rounded-2xl border border-brand-100 bg-white p-4 shadow-sm">
                            <div class="flex items-center justify-between gap-3">
                                <span class="text-sm font-bold text-brand-950">Jadwal perjalanan</span>
                                <span class="rounded-full bg-brand-50 px-2.5 py-1 text-[11px] font-semibold text-brand-800">Terjadwal</span>
                            </div>
                            <div class="mt-4 flex gap-3">
                                <span class="mt-1 flex size-9 shrink-0 items-center justify-center rounded-xl bg-accent-50 text-accent-700" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8">
                                        <path d="M12 21s7-5.3 7-12a7 7 0 1 0-14 0c0 6.7 7 12 7 12Z" stroke-linejoin="round"/>
                                        <circle cx="12" cy="9" r="2.2"/>
                                    </svg>
                                </span>
                                <div>
                                    <p class="text-sm font-semibold text-brand-950">Lokasi penjemputan</p>
                                    <p class="mt-1 text-xs text-brand-700/70">Tujuan perjalanan tercatat rapi</p>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center justify-between border-t border-brand-100 pt-3 text-xs">
                                <span class="text-brand-700/70">Waktu penjemputan</span>
                                <span class="font-semibold text-brand-900">Mudah diperbarui</span>
                            </div>
                        </div>

                        <div class="mt-3 grid grid-cols-2 gap-3">
                            <div class="rounded-2xl border border-brand-100 bg-white p-4">
                                <span class="grid size-9 place-items-center rounded-xl bg-sky-50 text-sky-700" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8">
                                        <path d="M4 7.5h16M6.5 4v3.5M17.5 4v3.5M5 5.5h14a1 1 0 0 1 1 1v13H4v-13a1 1 0 0 1 1-1Z" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M8 12h3m-3 3h6" stroke-linecap="round"/>
                                    </svg>
                                </span>
                                <p class="mt-3 text-xs font-bold text-brand-950">Catatan pengeluaran</p>
                                <p class="mt-1 text-[11px] text-brand-700/70">Segera hadir</p>
                            </div>
                            <div class="rounded-2xl border border-brand-100 bg-white p-4">
                                <span class="grid size-9 place-items-center rounded-xl bg-accent-50 text-accent-700" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8">
                                        <path d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.36-6.36-1.42 1.42M7.06 16.94l-1.42 1.42m12.72 0-1.42-1.42M7.06 7.06 5.64 5.64" stroke-linecap="round"/>
                                        <circle cx="12" cy="12" r="5"/>
                                    </svg>
                                </span>
                                <p class="mt-3 text-xs font-bold text-brand-950">Pengingat kendaraan</p>
                                <p class="mt-1 text-[11px] text-brand-700/70">Segera hadir</p>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="mt-4 text-center text-xs text-brand-100/70">Contoh tampilan Munyopir di perangkat Anda</p>
            </div>
        </div>
    </section>

    <section class="py-12 sm:py-16">
        <div class="mx-auto max-w-2xl text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.16em] text-accent-700">Satu aplikasi, lebih terorganisir</p>
            <h2 class="mt-3 text-3xl font-bold tracking-tight text-brand-950 sm:text-4xl">Dirancang untuk rutinitas sopir pribadi</h2>
            <p class="mt-4 text-base leading-7 text-brand-800/80">Informasi penting tersimpan rapi dan mudah dibuka kapan pun dibutuhkan.</p>
        </div>

        <div class="mt-9 grid gap-4 md:grid-cols-3">
            <article class="rounded-2xl border border-brand-100 bg-white p-5 shadow-sm sm:p-6">
                <span class="grid size-11 place-items-center rounded-xl bg-sky-100 text-brand-900" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8">
                        <path d="M7 3v3m10-3v3M4 9h16M5 5h14a1 1 0 0 1 1 1v13H4V6a1 1 0 0 1 1-1Z" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="m9 15 2 2 4-4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <div class="mt-4 flex items-center gap-2">
                    <h3 class="font-bold text-brand-950">Jadwal perjalanan</h3>
                    <span class="rounded-full bg-accent-50 px-2 py-0.5 text-[10px] font-bold text-accent-800">Tersedia</span>
                </div>
                <p class="mt-2 text-sm leading-6 text-brand-800/80">Catat lokasi dan waktu jemput, lalu perbarui status saat rencana berubah.</p>
            </article>

            <article class="rounded-2xl border border-brand-100 bg-white p-5 shadow-sm sm:p-6">
                <span class="grid size-11 place-items-center rounded-xl bg-sky-50 text-sky-700" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8">
                        <path d="M5 4h14a1 1 0 0 1 1 1v15l-4-2-4 2-4-2-4 2V5a1 1 0 0 1 1-1Z" stroke-linejoin="round"/>
                        <path d="M8 9h8m-8 4h5" stroke-linecap="round"/>
                    </svg>
                </span>
                <div class="mt-4 flex items-center gap-2">
                    <h3 class="font-bold text-brand-950">Arsip bukti pengeluaran</h3>
                    <span class="rounded-full bg-sky-50 px-2 py-0.5 text-[10px] font-bold text-sky-800">Segera hadir</span>
                </div>
                <p class="mt-2 text-sm leading-6 text-brand-800/80">Rencana pencatatan pengeluaran dan penyimpanan foto nota agar bukti transaksi mudah ditemukan.</p>
            </article>

            <article class="rounded-2xl border border-brand-100 bg-white p-5 shadow-sm sm:p-6">
                <span class="grid size-11 place-items-center rounded-xl bg-accent-50 text-accent-700" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8">
                        <path d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.36-6.36-1.42 1.42M7.06 16.94l-1.42 1.42m12.72 0-1.42-1.42M7.06 7.06 5.64 5.64" stroke-linecap="round"/>
                        <circle cx="12" cy="12" r="5"/>
                    </svg>
                </span>
                <div class="mt-4 flex items-center gap-2">
                    <h3 class="font-bold text-brand-950">Pengingat kendaraan</h3>
                    <span class="rounded-full bg-sky-50 px-2 py-0.5 text-[10px] font-bold text-sky-800">Segera hadir</span>
                </div>
                <p class="mt-2 text-sm leading-6 text-brand-800/80">Rencana pengingat servis berkala serta masa berlaku dokumen kendaraan.</p>
            </article>
        </div>
    </section>

    <section id="tentang" class="scroll-mt-8 py-12 sm:py-16">
        <div class="mx-auto max-w-2xl text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.16em] text-accent-700">Kenali pembuatnya</p>
            <h2 class="mt-3 text-3xl font-bold tracking-tight text-brand-950 sm:text-4xl">Tentang developer</h2>
            <p class="mt-4 text-base leading-7 text-brand-800/80">Hafli Setiawan adalah mahasiswa dan pengembang Munyopir yang antusias terhadap teknologi dan pengembangan solusi digital.</p>
        </div>

        <article class="mx-auto mt-8 grid max-w-4xl overflow-hidden rounded-3xl border border-brand-100 bg-white shadow-sm md:grid-cols-[minmax(15rem,0.8fr)_minmax(0,1.2fr)]">
            <div class="flex flex-col items-center justify-center bg-sky-50 p-7 text-center sm:p-9">
                <div class="grid size-24 place-items-center rounded-3xl bg-brand-900 shadow-lg shadow-brand-900/15">
                    <svg viewBox="0 0 64 64" class="size-14" role="img" aria-label="Ilustrasi komputer developer">
                        <rect x="7" y="8" width="50" height="36" rx="5" fill="#F5F8FF" stroke="#BFD5FF" stroke-width="2"/>
                        <path d="M9 15h46" stroke="#C6CDE2" stroke-width="2"/>
                        <circle cx="13" cy="11.5" r="1.25" fill="#5B3DF5"/>
                        <circle cx="17.5" cy="11.5" r="1.25" fill="#7398FA"/>
                        <path d="m26 23-5 5 5 5m12-10 5 5-5 5m-5-3-2 6" fill="none" stroke="#0E1A3A" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                        <path d="M32 44v7m-9 5h18m-22 0h26" fill="none" stroke="#F5F8FF" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                        <path d="M27 51h10" stroke="#8F7CFF" stroke-linecap="round" stroke-width="2"/>
                    </svg>
                </div>
                <h3 class="mt-5 text-2xl font-bold tracking-tight text-brand-950">Hafli Setiawan</h3>
                <p class="mt-2 text-sm font-medium text-accent-700">Mahasiswa / Pengembang Munyopir</p>
            </div>

            <div class="flex flex-col justify-center p-6 sm:p-9">
                <p class="text-sm font-semibold uppercase tracking-[0.14em] text-brand-700/70">Profil singkat</p>
                <p class="mt-3 text-base leading-7 text-brand-800/80">Antusias terhadap teknologi dan pengembangan solusi digital. Munyopir merupakan aplikasi web untuk membantu rutinitas sopir pribadi menjadi lebih tertata.</p>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="https://github.com/hafli-setiawan27" target="_blank" rel="noopener noreferrer" class="inline-flex min-h-11 items-center gap-2 rounded-xl border border-brand-200 px-4 py-2.5 text-sm font-semibold text-brand-800 transition hover:border-accent-600 hover:text-accent-700 focus:outline-none focus:ring-4 focus:ring-accent-600/10">
                        <svg viewBox="0 0 24 24" fill="none" class="size-4" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path d="M9 19c-4.3 1.4-4.3-2.5-6-3m12 6v-3.9a3.4 3.4 0 0 0-.9-2.6c3-.3 6.1-1.5 6.1-6.7a5.2 5.2 0 0 0-1.4-3.6 4.8 4.8 0 0 0-.1-3.6s-1.2-.4-3.8 1.4a13.2 13.2 0 0 0-6.9 0C5.4 1.2 4.2 1.6 4.2 1.6a4.8 4.8 0 0 0-.1 3.6 5.2 5.2 0 0 0-1.4 3.6c0 5.2 3.1 6.4 6.1 6.7a3.4 3.4 0 0 0-.9 2.6V22"/>
                        </svg>
                        GitHub
                    </a>
                    <a href="https://www.linkedin.com/in/hafli-setiawan" target="_blank" rel="noopener noreferrer" class="inline-flex min-h-11 items-center gap-2 rounded-xl border border-brand-200 px-4 py-2.5 text-sm font-semibold text-brand-800 transition hover:border-accent-600 hover:text-accent-700 focus:outline-none focus:ring-4 focus:ring-accent-600/10">
                        <svg viewBox="0 0 24 24" fill="none" class="size-4" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <rect x="3" y="3" width="18" height="18" rx="3"/>
                            <path d="M8 10v7m0-10v.01M12 17v-7m0 3a3 3 0 0 1 6 0v4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        LinkedIn
                    </a>
                </div>
            </div>
        </article>
    </section>

    <section class="mb-2 rounded-3xl border border-sky-200 bg-sky-50 px-6 py-8 text-center sm:px-10 sm:py-10">
        <h2 class="text-2xl font-bold tracking-tight text-brand-950">Mulai dengan jadwal yang lebih rapi</h2>
        <p class="mx-auto mt-3 max-w-xl text-sm leading-6 text-brand-800/80">Buat akun Munyopir dan simpan rencana perjalanan Anda dengan mudah.</p>
        <a href="{{ route('register') }}" class="mt-6 inline-flex min-h-12 items-center justify-center rounded-xl bg-brand-900 px-6 py-3 text-sm font-bold text-white transition hover:bg-brand-800 focus:outline-none focus:ring-4 focus:ring-sky-400/40">
            Daftar sekarang
        </a>
    </section>
@endsection
