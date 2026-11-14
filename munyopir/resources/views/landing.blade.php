@extends('layouts.app')

@section('title', 'Asisten digital sopir pribadi')

@section('content')
    <section class="relative isolate overflow-hidden rounded-3xl bg-emerald-950 px-6 py-10 text-white sm:px-10 sm:py-14 lg:px-14 lg:py-16">
        <div class="pointer-events-none absolute -right-24 -top-32 -z-10 size-96 rounded-full bg-emerald-700/30 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-40 left-1/3 -z-10 size-80 rounded-full bg-teal-500/20 blur-3xl"></div>

        <div class="grid items-center gap-10 lg:grid-cols-[1.1fr_0.9fr] lg:gap-14">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full border border-emerald-400/30 bg-emerald-900/60 px-3 py-1.5 text-xs font-semibold tracking-wide text-emerald-200">
                    <span class="size-2 rounded-full bg-emerald-400"></span>
                    Asisten digital sopir pribadi
                </span>
                <h1 class="mt-6 max-w-2xl text-4xl font-bold leading-tight tracking-tight sm:text-5xl lg:text-6xl">
                    Kerja lebih tertata,
                    <span class="text-emerald-300">perjalanan lebih tenang.</span>
                </h1>
                <p class="mt-5 max-w-xl text-base leading-7 text-emerald-100/80 sm:text-lg sm:leading-8">
                    Atur jadwal penjemputan, simpan informasi kendaraan, dan siapkan catatan operasional harian dalam satu tempat yang nyaman dibuka dari ponsel.
                </p>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('register') }}" class="inline-flex min-h-12 items-center justify-center rounded-xl bg-emerald-300 px-6 py-3 text-sm font-bold text-emerald-950 transition hover:bg-emerald-200 focus:outline-none focus:ring-4 focus:ring-emerald-200/30">
                        Mulai gunakan Munyopir
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex min-h-12 items-center justify-center rounded-xl border border-white/20 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10 focus:outline-none focus:ring-4 focus:ring-white/20">
                        Saya sudah punya akun
                    </a>
                </div>
                <p class="mt-4 text-xs leading-5 text-emerald-100/60">Aplikasi web responsif—langsung dibuka dari browser, tanpa instalasi.</p>
            </div>

            <div class="mx-auto w-full max-w-md">
                <div class="rounded-[2rem] border border-white/15 bg-white/10 p-3 shadow-2xl shadow-emerald-950/40 backdrop-blur">
                    <div class="rounded-[1.5rem] bg-slate-50 p-5 text-slate-900 sm:p-6">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.14em] text-emerald-800">Ruang kerja Anda</p>
                                <p class="mt-1 text-xl font-bold tracking-tight">Hari ini</p>
                            </div>
                            <span class="grid size-10 place-items-center rounded-xl bg-emerald-100 text-emerald-800" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8">
                                    <path d="M7 3v3m10-3v3M4 9h16M5 5h14a1 1 0 0 1 1 1v13H4V6a1 1 0 0 1 1-1Z" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </div>

                        <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                            <div class="flex items-center justify-between gap-3">
                                <span class="text-sm font-bold text-slate-950">Jadwal perjalanan</span>
                                <span class="rounded-full bg-sky-50 px-2.5 py-1 text-[11px] font-semibold text-sky-800">Terjadwal</span>
                            </div>
                            <div class="mt-4 flex gap-3">
                                <span class="mt-1 flex size-9 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-800" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8">
                                        <path d="M12 21s7-5.3 7-12a7 7 0 1 0-14 0c0 6.7 7 12 7 12Z" stroke-linejoin="round"/>
                                        <circle cx="12" cy="9" r="2.2"/>
                                    </svg>
                                </span>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900">Lokasi penjemputan</p>
                                    <p class="mt-1 text-xs text-slate-500">Tujuan perjalanan tercatat rapi</p>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-3 text-xs">
                                <span class="text-slate-500">Waktu penjemputan</span>
                                <span class="font-semibold text-slate-800">Mudah diperbarui</span>
                            </div>
                        </div>

                        <div class="mt-3 grid grid-cols-2 gap-3">
                            <div class="rounded-2xl border border-slate-200 bg-white p-4">
                                <span class="grid size-9 place-items-center rounded-xl bg-amber-50 text-amber-700" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8">
                                        <path d="M4 7.5h16M6.5 4v3.5M17.5 4v3.5M5 5.5h14a1 1 0 0 1 1 1v13H4v-13a1 1 0 0 1 1-1Z" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M8 12h3m-3 3h6" stroke-linecap="round"/>
                                    </svg>
                                </span>
                                <p class="mt-3 text-xs font-bold text-slate-900">Catatan pengeluaran</p>
                                <p class="mt-1 text-[11px] text-slate-500">Segera hadir</p>
                            </div>
                            <div class="rounded-2xl border border-slate-200 bg-white p-4">
                                <span class="grid size-9 place-items-center rounded-xl bg-violet-50 text-violet-700" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8">
                                        <path d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.36-6.36-1.42 1.42M7.06 16.94l-1.42 1.42m12.72 0-1.42-1.42M7.06 7.06 5.64 5.64" stroke-linecap="round"/>
                                        <circle cx="12" cy="12" r="5"/>
                                    </svg>
                                </span>
                                <p class="mt-3 text-xs font-bold text-slate-900">Pengingat kendaraan</p>
                                <p class="mt-1 text-[11px] text-slate-500">Segera hadir</p>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="mt-4 text-center text-xs text-emerald-100/60">Contoh tampilan Munyopir di perangkat Anda</p>
            </div>
        </div>
    </section>

    <section class="py-12 sm:py-16">
        <div class="mx-auto max-w-2xl text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.16em] text-emerald-800">Satu aplikasi, lebih terorganisir</p>
            <h2 class="mt-3 text-3xl font-bold tracking-tight text-slate-950 sm:text-4xl">Dirancang untuk rutinitas sopir pribadi</h2>
            <p class="mt-4 text-base leading-7 text-slate-600">Informasi penting tersimpan rapi dan mudah dibuka kapan pun dibutuhkan.</p>
        </div>

        <div class="mt-9 grid gap-4 md:grid-cols-3">
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                <span class="grid size-11 place-items-center rounded-xl bg-emerald-50 text-emerald-800" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8">
                        <path d="M7 3v3m10-3v3M4 9h16M5 5h14a1 1 0 0 1 1 1v13H4V6a1 1 0 0 1 1-1Z" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="m9 15 2 2 4-4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <div class="mt-4 flex items-center gap-2">
                    <h3 class="font-bold text-slate-950">Jadwal perjalanan</h3>
                    <span class="rounded-full bg-emerald-50 px-2 py-0.5 text-[10px] font-bold text-emerald-800">Tersedia</span>
                </div>
                <p class="mt-2 text-sm leading-6 text-slate-600">Catat lokasi dan waktu jemput, lalu perbarui status saat rencana berubah.</p>
            </article>

            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                <span class="grid size-11 place-items-center rounded-xl bg-amber-50 text-amber-700" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8">
                        <path d="M5 4h14a1 1 0 0 1 1 1v15l-4-2-4 2-4-2-4 2V5a1 1 0 0 1 1-1Z" stroke-linejoin="round"/>
                        <path d="M8 9h8m-8 4h5" stroke-linecap="round"/>
                    </svg>
                </span>
                <div class="mt-4 flex items-center gap-2">
                    <h3 class="font-bold text-slate-950">Arsip bukti pengeluaran</h3>
                    <span class="rounded-full bg-amber-50 px-2 py-0.5 text-[10px] font-bold text-amber-800">Segera hadir</span>
                </div>
                <p class="mt-2 text-sm leading-6 text-slate-600">Rencana pencatatan pengeluaran dan penyimpanan foto nota agar bukti transaksi mudah ditemukan.</p>
            </article>

            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                <span class="grid size-11 place-items-center rounded-xl bg-violet-50 text-violet-700" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8">
                        <path d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.36-6.36-1.42 1.42M7.06 16.94l-1.42 1.42m12.72 0-1.42-1.42M7.06 7.06 5.64 5.64" stroke-linecap="round"/>
                        <circle cx="12" cy="12" r="5"/>
                    </svg>
                </span>
                <div class="mt-4 flex items-center gap-2">
                    <h3 class="font-bold text-slate-950">Pengingat kendaraan</h3>
                    <span class="rounded-full bg-amber-50 px-2 py-0.5 text-[10px] font-bold text-amber-800">Segera hadir</span>
                </div>
                <p class="mt-2 text-sm leading-6 text-slate-600">Rencana pengingat servis berkala serta masa berlaku dokumen kendaraan.</p>
            </article>
        </div>
    </section>

    <section class="mb-2 rounded-3xl border border-emerald-100 bg-emerald-50 px-6 py-8 text-center sm:px-10 sm:py-10">
        <h2 class="text-2xl font-bold tracking-tight text-slate-950">Mulai dengan jadwal yang lebih rapi</h2>
        <p class="mx-auto mt-3 max-w-xl text-sm leading-6 text-slate-600">Buat akun Munyopir dan simpan rencana perjalanan Anda dengan mudah.</p>
        <a href="{{ route('register') }}" class="mt-6 inline-flex min-h-12 items-center justify-center rounded-xl bg-emerald-700 px-6 py-3 text-sm font-bold text-white transition hover:bg-emerald-800 focus:outline-none focus:ring-4 focus:ring-emerald-700/20">
            Daftar sekarang
        </a>
    </section>
@endsection
