@extends('layouts.app')

@section('title', 'Fitur terbaru & developer')

@section('content')
    <section class="space-y-6">
        <header class="max-w-3xl">
            <p class="text-sm font-semibold uppercase tracking-[0.16em] text-accent-700">Pembaruan Munyopir</p>
            <h1 class="mt-2 text-3xl font-bold tracking-tight text-brand-950 sm:text-4xl">Fitur terbaru</h1>
            <p class="mt-3 text-base leading-7 text-brand-800/80">Lihat fitur yang membantu Anda memantau pekerjaan, kendaraan, dan akun dengan lebih praktis.</p>
        </header>

        <div class="grid gap-5 lg:grid-cols-3">
            <article class="overflow-hidden rounded-3xl border border-brand-100 bg-white shadow-sm">
                <div class="flex min-h-40 items-center justify-center bg-violet-50 p-6">
                    <div class="relative grid size-20 place-items-center rounded-3xl bg-white text-violet-800 shadow-sm">
                        <svg viewBox="0 0 24 24" fill="none" class="size-9" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path d="M18 9a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="absolute -right-2 -top-2 grid size-7 place-items-center rounded-full bg-accent-600 text-xs font-bold text-white ring-4 ring-violet-50" aria-hidden="true">3</span>
                    </div>
                </div>
                <div class="p-5 sm:p-6">
                    <span class="rounded-full bg-violet-50 px-2.5 py-1 text-xs font-bold text-violet-800">Pantau aktivitas</span>
                    <h2 class="mt-4 text-xl font-bold text-brand-950">Pengingat dengan badge lonceng</h2>
                    <p class="mt-2 text-sm leading-6 text-brand-700/80">Buka pusat pengingat dari ikon lonceng. Badge menunjukkan jumlah pemberitahuan yang belum dibaca.</p>
                    <a href="{{ route('notifications.index') }}" class="mt-5 inline-flex min-h-11 items-center font-bold text-accent-700 hover:underline">Lihat pengingat <span class="ml-2" aria-hidden="true">→</span></a>
                </div>
            </article>

            <article class="overflow-hidden rounded-3xl border border-brand-100 bg-white shadow-sm">
                <div class="flex min-h-40 items-center justify-center bg-emerald-50 p-5">
                    <div class="w-full max-w-xs rounded-2xl border border-emerald-100 bg-white p-4 shadow-sm">
                        <div class="flex items-center justify-between gap-3"><span class="text-xs font-semibold text-brand-700">Rekap bulanan</span><span class="rounded-lg bg-emerald-50 px-2 py-1 text-[10px] font-bold text-emerald-800">Pengeluaran</span></div>
                        <p class="mt-3 text-2xl font-extrabold tracking-tight text-brand-950">Rp 1.250.000</p>
                        <div class="mt-4 flex h-9 items-end gap-2" aria-hidden="true"><span class="h-3 flex-1 rounded-t bg-emerald-200"></span><span class="h-5 flex-1 rounded-t bg-emerald-300"></span><span class="h-4 flex-1 rounded-t bg-emerald-200"></span><span class="h-8 flex-1 rounded-t bg-emerald-500"></span><span class="h-6 flex-1 rounded-t bg-emerald-300"></span><span class="h-7 flex-1 rounded-t bg-emerald-400"></span></div>
                    </div>
                </div>
                <div class="p-5 sm:p-6">
                    <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-800">Kelola biaya</span>
                    <h2 class="mt-4 text-xl font-bold text-brand-950">Rekap pengeluaran</h2>
                    <p class="mt-2 text-sm leading-6 text-brand-700/80">Lihat total dan rincian biaya berdasarkan kategori untuk periode harian maupun bulanan.</p>
                    <a href="{{ route('expenses.report') }}" class="mt-5 inline-flex min-h-11 items-center font-bold text-accent-700 hover:underline">Buka rekap <span class="ml-2" aria-hidden="true">→</span></a>
                </div>
            </article>

            <article class="overflow-hidden rounded-3xl border border-brand-100 bg-white shadow-sm">
                <div class="flex min-h-40 items-center justify-center bg-sky-50 p-5">
                    <div class="w-full max-w-xs space-y-3 rounded-2xl border border-sky-100 bg-white p-4 shadow-sm">
                        <div><span class="text-[10px] font-semibold uppercase tracking-wide text-brand-700/70">Nama lengkap</span><div class="mt-1 rounded-lg bg-canvas px-3 py-2 text-xs font-semibold text-brand-900">Nama akun Anda</div></div>
                        <div><span class="text-[10px] font-semibold uppercase tracking-wide text-brand-700/70">Email</span><div class="mt-1 rounded-lg bg-canvas px-3 py-2 text-xs font-semibold text-brand-900">email@contoh.com</div></div>
                        <div class="flex items-center gap-2 text-[10px] font-bold text-sky-800"><span class="size-2 rounded-full bg-sky-500"></span>Profil dapat diperbarui</div>
                    </div>
                </div>
                <div class="p-5 sm:p-6">
                    <span class="rounded-full bg-sky-50 px-2.5 py-1 text-xs font-bold text-sky-800">Kelola akun</span>
                    <h2 class="mt-4 text-xl font-bold text-brand-950">Pengaturan akun</h2>
                    <p class="mt-2 text-sm leading-6 text-brand-700/80">Perbarui nama, email, dan kata sandi langsung dari halaman Pengaturan.</p>
                    <a href="{{ route('settings') }}" class="mt-5 inline-flex min-h-11 items-center font-bold text-accent-700 hover:underline">Atur akun <span class="ml-2" aria-hidden="true">→</span></a>
                </div>
            </article>
        </div>
    </section>

    <x-developer-profile />
@endsection
