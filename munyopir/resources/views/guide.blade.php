@extends('layouts.app')

@section('title', 'Panduan aplikasi')

@section('content')
    <div class="mx-auto max-w-6xl space-y-10 sm:space-y-14">
        <section class="overflow-hidden rounded-3xl bg-brand-900 text-white shadow-xl shadow-brand-900/10">
            <div class="grid gap-8 p-6 sm:p-9 lg:grid-cols-[1.1fr_0.9fr] lg:items-center lg:p-12">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.16em] text-sky-300">Pusat bantuan Munyopir</p>
                    <h1 class="mt-3 max-w-2xl text-3xl font-bold leading-tight tracking-tight sm:text-4xl lg:text-5xl">Panduan lengkap menggunakan aplikasi</h1>
                    <p class="mt-4 max-w-2xl text-sm leading-7 text-brand-100 sm:text-base">Pelajari cara mengatur kendaraan, mencatat perjalanan dan pengeluaran, serta menerima pengingat dalam satu alur kerja yang mudah diikuti.</p>
                    <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                        <a href="#mulai" class="inline-flex min-h-12 items-center justify-center rounded-xl bg-sky-300 px-5 py-3 text-sm font-bold text-brand-950 transition hover:bg-sky-200 focus:outline-none focus-visible:ring-4 focus-visible:ring-white/40">Mulai dari awal</a>
                        <a href="#fitur" class="inline-flex min-h-12 items-center justify-center rounded-xl border border-white/25 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10 focus:outline-none focus-visible:ring-4 focus-visible:ring-white/30">Jelajahi fitur</a>
                    </div>
                </div>

                <div class="rounded-3xl border border-white/15 bg-white/10 p-4 sm:p-5" aria-label="Gambaran alur penggunaan Munyopir">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-brand-100/70">Alur kerja</p>
                            <p class="mt-1 text-lg font-bold">Dari rencana ke pengingat</p>
                        </div>
                        <span class="grid size-11 place-items-center rounded-2xl bg-sky-300 text-brand-950" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" class="size-6" stroke="currentColor" stroke-width="1.8">
                                <path d="M4 12h15m-6-6 6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </div>
                    <div class="mt-5 grid grid-cols-2 gap-3">
                        <div class="rounded-2xl bg-white p-4 text-brand-950">
                            <span class="grid size-9 place-items-center rounded-xl bg-sky-100 text-sky-800" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8"><path d="M4 7h16M6 4v3m12-3v3M5 5h14v15H5z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                            <p class="mt-3 text-sm font-bold">Rencanakan</p>
                            <p class="mt-1 text-xs text-brand-700/70">Atur jadwal perjalanan</p>
                        </div>
                        <div class="rounded-2xl bg-white p-4 text-brand-950">
                            <span class="grid size-9 place-items-center rounded-xl bg-emerald-100 text-emerald-800" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8"><path d="M5 4h14v16H5zM8 8h8M8 12h8M8 16h4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                            <p class="mt-3 text-sm font-bold">Catat</p>
                            <p class="mt-1 text-xs text-brand-700/70">Simpan biaya operasional</p>
                        </div>
                        <div class="rounded-2xl bg-white p-4 text-brand-950">
                            <span class="grid size-9 place-items-center rounded-xl bg-amber-100 text-amber-800" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8"><path d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.36-6.36-1.42 1.42M7.06 16.94l-1.42 1.42m12.72 0-1.42-1.42M7.06 7.06 5.64 5.64" stroke-linecap="round"/><circle cx="12" cy="12" r="5"/></svg>
                            </span>
                            <p class="mt-3 text-sm font-bold">Rawat</p>
                            <p class="mt-1 text-xs text-brand-700/70">Pantau servis kendaraan</p>
                        </div>
                        <div class="rounded-2xl bg-white p-4 text-brand-950">
                            <span class="grid size-9 place-items-center rounded-xl bg-violet-100 text-violet-800" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8"><path d="M18 9a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                            <p class="mt-3 text-sm font-bold">Pantau</p>
                            <p class="mt-1 text-xs text-brand-700/70">Buka pusat pengingat</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="mulai" class="scroll-mt-6">
            <div class="max-w-2xl">
                <p class="text-sm font-semibold uppercase tracking-[0.14em] text-accent-700">Langkah pertama</p>
                <h2 class="mt-2 text-2xl font-bold tracking-tight text-brand-950 sm:text-3xl">Siapkan akun dalam tiga langkah</h2>
                <p class="mt-2 text-sm leading-6 text-brand-700">Mulai dari informasi dasar, lalu gunakan menu utama untuk aktivitas harian.</p>
            </div>
            <ol class="mt-5 grid gap-4 md:grid-cols-3">
                <li class="rounded-2xl border border-brand-100 bg-white p-5 shadow-sm">
                    <span class="grid size-9 place-items-center rounded-xl bg-brand-900 text-sm font-bold text-white">1</span>
                    <h3 class="mt-4 font-bold text-brand-950">Lengkapi akun</h3>
                    <p class="mt-2 text-sm leading-6 text-brand-700/80">Buka menu titik tiga lalu Pengaturan untuk mengubah nama, email, atau kata sandi.</p>
                    <a href="{{ route('settings') }}" class="mt-4 inline-flex min-h-10 items-center text-sm font-bold text-accent-700 hover:underline">Buka Pengaturan</a>
                </li>
                <li class="rounded-2xl border border-brand-100 bg-white p-5 shadow-sm">
                    <span class="grid size-9 place-items-center rounded-xl bg-brand-900 text-sm font-bold text-white">2</span>
                    <h3 class="mt-4 font-bold text-brand-950">Daftarkan kendaraan</h3>
                    <p class="mt-2 text-sm leading-6 text-brand-700/80">Simpan nama kendaraan, nomor polisi, dan odometer agar jadwal perawatan lebih mudah dipantau.</p>
                    <a href="{{ route('vehicles.show') }}" class="mt-4 inline-flex min-h-10 items-center text-sm font-bold text-accent-700 hover:underline">Lihat Kendaraan</a>
                </li>
                <li class="rounded-2xl border border-brand-100 bg-white p-5 shadow-sm">
                    <span class="grid size-9 place-items-center rounded-xl bg-brand-900 text-sm font-bold text-white">3</span>
                    <h3 class="mt-4 font-bold text-brand-950">Catat aktivitas</h3>
                    <p class="mt-2 text-sm leading-6 text-brand-700/80">Buat jadwal perjalanan, catat biaya, lalu tambahkan perawatan kendaraan yang perlu diingat.</p>
                    <a href="{{ route('trips.create') }}" class="mt-4 inline-flex min-h-10 items-center text-sm font-bold text-accent-700 hover:underline">Buat perjalanan</a>
                </li>
            </ol>
        </section>

        <section id="navigasi" class="scroll-mt-6 rounded-3xl border border-brand-100 bg-white p-5 shadow-sm sm:p-7">
            <div class="max-w-2xl">
                <p class="text-sm font-semibold uppercase tracking-[0.14em] text-accent-700">Kenali navigasi</p>
                <h2 class="mt-2 text-2xl font-bold tracking-tight text-brand-950 sm:text-3xl">Menu utama selalu dekat</h2>
                <p class="mt-2 text-sm leading-6 text-brand-700">Di layar lebar, menu utama berada di bagian atas. Di ponsel, gunakan navigasi bawah. Ikon lonceng membuka pengingat; titik tiga berisi Pengaturan, Panduan aplikasi, dan Tentang.</p>
            </div>

            <div class="mt-6 grid gap-4 lg:grid-cols-[1.2fr_0.8fr]">
                <div class="rounded-2xl bg-canvas p-4 sm:p-5">
                    <p class="mb-3 text-xs font-bold uppercase tracking-[0.12em] text-brand-700/70">Contoh navbar desktop</p>
                    <div class="flex flex-wrap items-center gap-2 rounded-2xl border border-brand-100 bg-white p-3">
                        <span class="rounded-xl bg-brand-50 px-3 py-2 text-xs font-bold text-brand-950">Beranda</span>
                        <span class="rounded-xl px-3 py-2 text-xs font-semibold text-brand-700">Perjalanan</span>
                        <span class="rounded-xl px-3 py-2 text-xs font-semibold text-brand-700">Pengeluaran</span>
                        <span class="rounded-xl px-3 py-2 text-xs font-semibold text-brand-700">Perawatan</span>
                        <span class="rounded-xl px-3 py-2 text-xs font-semibold text-brand-700">Kendaraan</span>
                        <span class="relative ml-auto grid size-10 place-items-center rounded-xl bg-brand-50 text-brand-900" aria-label="Ikon pengingat dengan badge jumlah belum dibaca">
                            <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M18 9a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <span class="absolute -right-1 -top-1 grid h-5 min-w-5 place-items-center rounded-full bg-accent-600 px-1 text-[10px] font-bold text-white ring-2 ring-white" aria-hidden="true">3</span>
                        </span>
                        <span class="grid size-10 place-items-center rounded-xl text-brand-700" aria-hidden="true">•••</span>
                    </div>
                    <p class="mt-3 text-xs leading-5 text-brand-700/70">Contoh: badge merah menunjukkan jumlah pengingat yang belum dibaca.</p>
                </div>

                <div class="rounded-2xl bg-brand-50 p-4 sm:p-5">
                    <p class="mb-3 text-xs font-bold uppercase tracking-[0.12em] text-brand-700/70">Contoh navigasi ponsel</p>
                    <div class="mx-auto max-w-xs rounded-[1.5rem] border-4 border-brand-900 bg-white p-3 shadow-sm">
                        <div class="flex items-center justify-between border-b border-brand-100 pb-3">
                            <span class="text-sm font-extrabold text-brand-950">mun<span class="text-accent-600">yopir</span></span>
                            <span class="relative grid size-9 place-items-center rounded-xl bg-brand-50 text-brand-900">
                                <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M18 9a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <span class="absolute -right-1 -top-1 grid h-4 min-w-4 place-items-center rounded-full bg-accent-600 px-1 text-[9px] font-bold text-white" aria-hidden="true">3</span>
                            </span>
                        </div>
                        <div class="mt-3 grid grid-cols-5 gap-1 text-center text-[9px] font-semibold text-brand-700">
                            <span class="rounded-lg bg-brand-50 px-1 py-2">Beranda</span>
                            <span class="px-1 py-2">Perjalanan</span>
                            <span class="px-1 py-2">Biaya</span>
                            <span class="px-1 py-2">Rawat</span>
                            <span class="px-1 py-2">Mobil</span>
                        </div>
                    </div>
                    <p class="mt-3 text-xs leading-5 text-brand-700/70">Lonceng berada di header ponsel, sementara menu kerja berada di navigasi bawah.</p>
                </div>
            </div>
        </section>

        <section id="fitur" class="scroll-mt-6 space-y-5">
            <div class="max-w-2xl">
                <p class="text-sm font-semibold uppercase tracking-[0.14em] text-accent-700">Panduan fitur</p>
                <h2 class="mt-2 text-2xl font-bold tracking-tight text-brand-950 sm:text-3xl">Apa yang bisa Anda lakukan</h2>
            </div>

            <article class="grid gap-5 overflow-hidden rounded-3xl border border-brand-100 bg-white shadow-sm md:grid-cols-[0.8fr_1.2fr]">
                <div class="bg-brand-900 p-6 text-white sm:p-8">
                    <span class="grid size-12 place-items-center rounded-2xl bg-sky-300 text-brand-950" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" class="size-6" stroke="currentColor" stroke-width="1.8"><path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1V10Z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                    <p class="mt-5 text-xs font-bold uppercase tracking-[0.14em] text-sky-300">01 · Ringkasan</p>
                    <h3 class="mt-2 text-2xl font-bold">Beranda</h3>
                    <p class="mt-3 text-sm leading-6 text-brand-100/80">Gunakan Beranda sebagai pusat aktivitas harian.</p>
                    <a href="{{ route('dashboard') }}" class="mt-5 inline-flex min-h-11 items-center rounded-xl bg-white px-4 py-2.5 text-sm font-bold text-brand-900 transition hover:bg-brand-50">Buka Beranda</a>
                </div>
                <div class="p-6 sm:p-8">
                    <div class="grid gap-3 sm:grid-cols-3">
                        <div class="rounded-2xl bg-brand-50 p-4"><span class="text-xs font-semibold text-brand-700">Aksi cepat</span><p class="mt-2 text-sm font-bold text-brand-950">Tambah perjalanan</p></div>
                        <div class="rounded-2xl bg-sky-50 p-4"><span class="text-xs font-semibold text-brand-700">Agenda</span><p class="mt-2 text-sm font-bold text-brand-950">Perjalanan mendatang</p></div>
                        <div class="rounded-2xl bg-emerald-50 p-4"><span class="text-xs font-semibold text-brand-700">Kendaraan</span><p class="mt-2 text-sm font-bold text-brand-950">Rekomendasi perawatan</p></div>
                    </div>
                    <ul class="mt-5 grid gap-2 text-sm leading-6 text-brand-700 sm:grid-cols-2">
                        <li>• Lihat jadwal terdekat dan pintasan membuat catatan.</li>
                        <li>• Periksa kendaraan dan saran perawatan yang perlu ditindaklanjuti.</li>
                    </ul>
                </div>
            </article>

            <article class="grid gap-5 overflow-hidden rounded-3xl border border-brand-100 bg-white shadow-sm md:grid-cols-[1.2fr_0.8fr]">
                <div class="p-6 sm:p-8">
                    <p class="text-xs font-bold uppercase tracking-[0.14em] text-accent-700">02 · Jadwal</p>
                    <h3 class="mt-2 text-2xl font-bold text-brand-950">Perjalanan</h3>
                    <p class="mt-3 max-w-2xl text-sm leading-6 text-brand-700">Buat rencana dengan tujuan, lokasi penjemputan, dan waktu jemput. Ubah jadwal bila ada perubahan, lalu tandai selesai atau batal setelah statusnya berubah.</p>
                    <div class="mt-5 flex flex-wrap items-center gap-2 text-xs font-bold">
                        <span class="rounded-full bg-brand-50 px-3 py-2 text-brand-800">Terjadwal</span><span class="text-brand-400">→</span>
                        <span class="rounded-full bg-sky-50 px-3 py-2 text-brand-800">Berubah</span><span class="text-brand-400">→</span>
                        <span class="rounded-full bg-emerald-50 px-3 py-2 text-emerald-800">Selesai</span>
                        <span class="rounded-full bg-slate-100 px-3 py-2 text-slate-700">Batal</span>
                    </div>
                    <a href="{{ route('trips.index') }}" class="mt-5 inline-flex min-h-11 items-center rounded-xl bg-brand-900 px-4 py-2.5 text-sm font-bold text-white hover:bg-brand-800">Kelola perjalanan</a>
                </div>
                <div class="flex items-center bg-sky-50 p-6 sm:p-8">
                    <div class="w-full rounded-2xl border border-brand-100 bg-white p-4 shadow-sm">
                        <div class="flex items-center justify-between gap-3"><span class="text-sm font-bold text-brand-950">Perjalanan mendatang</span><span class="rounded-full bg-brand-50 px-2.5 py-1 text-[10px] font-bold text-brand-800">Terjadwal</span></div>
                        <div class="mt-4 space-y-3"><div class="h-2 w-4/5 rounded-full bg-brand-100"></div><div class="h-2 w-3/5 rounded-full bg-brand-100"></div></div>
                        <div class="mt-4 flex items-center justify-between border-t border-brand-100 pt-3 text-xs"><span class="text-brand-700/70">Waktu penjemputan</span><span class="font-bold text-brand-900">08.30</span></div>
                    </div>
                </div>
            </article>

            <article class="grid gap-5 overflow-hidden rounded-3xl border border-brand-100 bg-white shadow-sm md:grid-cols-[0.8fr_1.2fr]">
                <div class="bg-emerald-700 p-6 text-white sm:p-8">
                    <span class="grid size-12 place-items-center rounded-2xl bg-white/15" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" class="size-6" stroke="currentColor" stroke-width="1.8"><path d="M5 4h14v16H5zM8 8h8M8 12h8M8 16h4" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                    <p class="mt-5 text-xs font-bold uppercase tracking-[0.14em] text-emerald-100">03 · Biaya operasional</p>
                    <h3 class="mt-2 text-2xl font-bold">Pengeluaran & rekap</h3>
                    <p class="mt-3 text-sm leading-6 text-white/80">Simpan biaya perjalanan dan lihat ringkasannya per hari atau per bulan.</p>
                    <div class="mt-5 flex gap-2"><a href="{{ route('expenses.index') }}" class="inline-flex min-h-11 items-center rounded-xl bg-white px-4 py-2.5 text-sm font-bold text-emerald-800 hover:bg-emerald-50">Buka pengeluaran</a><a href="{{ route('expenses.report') }}" class="inline-flex min-h-11 items-center rounded-xl border border-white/30 px-4 py-2.5 text-sm font-bold text-white hover:bg-white/10">Lihat rekap</a></div>
                </div>
                <div class="p-6 sm:p-8">
                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
                        <span class="rounded-xl bg-brand-50 px-3 py-3 text-center text-xs font-bold text-brand-800">Bahan bakar</span>
                        <span class="rounded-xl bg-brand-50 px-3 py-3 text-center text-xs font-bold text-brand-800">Tol</span>
                        <span class="rounded-xl bg-brand-50 px-3 py-3 text-center text-xs font-bold text-brand-800">Parkir</span>
                        <span class="rounded-xl bg-brand-50 px-3 py-3 text-center text-xs font-bold text-brand-800">Makan & minum</span>
                        <span class="rounded-xl bg-brand-50 px-3 py-3 text-center text-xs font-bold text-brand-800">Perawatan</span>
                        <span class="rounded-xl bg-brand-50 px-3 py-3 text-center text-xs font-bold text-brand-800">Lainnya</span>
                    </div>
                    <p class="mt-4 text-sm leading-6 text-brand-700">Isi nominal dan tanggal, lalu hubungkan dengan perjalanan bila perlu. Foto nota opsional; gunakan JPG, PNG, atau WebP maksimal 2 MB.</p>
                    <div class="mt-4 flex items-center justify-between rounded-2xl bg-canvas p-4"><span class="text-sm font-semibold text-brand-700">Contoh total rekap</span><span class="text-lg font-extrabold text-brand-950">Rp 250.000</span></div>
                </div>
            </article>

            <article class="grid gap-5 overflow-hidden rounded-3xl border border-brand-100 bg-white shadow-sm md:grid-cols-[1.2fr_0.8fr]">
                <div class="p-6 sm:p-8">
                    <p class="text-xs font-bold uppercase tracking-[0.14em] text-accent-700">04 · Profil kendaraan</p>
                    <h3 class="mt-2 text-2xl font-bold text-brand-950">Kendaraan</h3>
                    <p class="mt-3 text-sm leading-6 text-brand-700">Simpan nama atau tipe kendaraan, nomor polisi, dan odometer. Informasi ini menjadi acuan saat Anda mengatur perawatan.</p>
                    <a href="{{ route('vehicles.show') }}" class="mt-5 inline-flex min-h-11 items-center rounded-xl bg-brand-900 px-4 py-2.5 text-sm font-bold text-white hover:bg-brand-800">Lihat profil kendaraan</a>
                </div>
                <div class="flex items-center bg-amber-50 p-6 sm:p-8">
                    <div class="w-full rounded-2xl border border-amber-100 bg-white p-5 shadow-sm">
                        <div class="flex items-center gap-3"><span class="grid size-11 place-items-center rounded-xl bg-amber-100 text-amber-800" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" class="size-6" stroke="currentColor" stroke-width="1.8"><path d="m3 13 1.5-5A2 2 0 0 1 6.4 6.5h11.2A2 2 0 0 1 19.5 8l1.5 5v5h-3v-2H6v2H3v-5Z" stroke-linecap="round" stroke-linejoin="round"/><path d="M4 13h16" stroke-linecap="round"/></svg></span><div><p class="text-sm font-bold text-brand-950">Kendaraan Anda</p><p class="text-xs text-brand-700/70">Nomor polisi tersimpan</p></div></div>
                        <div class="mt-5 rounded-xl bg-canvas p-4"><div class="flex justify-between text-xs"><span class="text-brand-700">Odometer</span><span class="font-bold text-brand-950">Perbarui berkala</span></div><div class="mt-3 h-2 rounded-full bg-amber-100"><div class="h-2 w-2/3 rounded-full bg-amber-500"></div></div></div>
                    </div>
                </div>
            </article>

            <article class="grid gap-5 overflow-hidden rounded-3xl border border-brand-100 bg-white shadow-sm md:grid-cols-[0.8fr_1.2fr]">
                <div class="bg-amber-500 p-6 text-brand-950 sm:p-8">
                    <span class="grid size-12 place-items-center rounded-2xl bg-white/40" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" class="size-6" stroke="currentColor" stroke-width="1.8"><path d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.36-6.36-1.42 1.42M7.06 16.94l-1.42 1.42m12.72 0-1.42-1.42M7.06 7.06 5.64 5.64" stroke-linecap="round"/><circle cx="12" cy="12" r="5"/></svg></span>
                    <p class="mt-5 text-xs font-bold uppercase tracking-[0.14em] text-brand-900/70">05 · Perawatan berkala</p>
                    <h3 class="mt-2 text-2xl font-bold">Perawatan</h3>
                    <p class="mt-3 text-sm leading-6 text-brand-900/80">Atur jadwal servis dari jarak tempuh atau tanggal, dan catat masa berlaku dokumen.</p>
                    <a href="{{ route('maintenance.index') }}" class="mt-5 inline-flex min-h-11 items-center rounded-xl bg-brand-900 px-4 py-2.5 text-sm font-bold text-white hover:bg-brand-800">Atur perawatan</a>
                </div>
                <div class="p-6 sm:p-8">
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 rounded-2xl border border-brand-100 p-4"><span class="grid size-9 place-items-center rounded-xl bg-amber-50 text-amber-800">KM</span><div class="min-w-0 flex-1"><p class="text-sm font-bold text-brand-950">Servis berkala</p><p class="text-xs text-brand-700/70">Interval kilometer atau hari</p></div><span class="rounded-full bg-amber-50 px-2.5 py-1 text-[10px] font-bold text-amber-800">Mendekati</span></div>
                        <div class="flex items-center gap-3 rounded-2xl border border-brand-100 p-4"><span class="grid size-9 place-items-center rounded-xl bg-sky-50 text-sky-800">ID</span><div class="min-w-0 flex-1"><p class="text-sm font-bold text-brand-950">Dokumen kendaraan</p><p class="text-xs text-brand-700/70">Tanggal masa berlaku</p></div><span class="rounded-full bg-brand-50 px-2.5 py-1 text-[10px] font-bold text-brand-800">Terpantau</span></div>
                    </div>
                    <p class="mt-4 text-sm leading-6 text-brand-700">Perbarui odometer di halaman Perawatan supaya jadwal berbasis kilometer tetap akurat.</p>
                </div>
            </article>

            <article class="grid gap-5 overflow-hidden rounded-3xl border border-brand-100 bg-white shadow-sm md:grid-cols-[1.2fr_0.8fr]">
                <div class="p-6 sm:p-8">
                    <p class="text-xs font-bold uppercase tracking-[0.14em] text-accent-700">06 · Pusat informasi</p>
                    <h3 class="mt-2 text-2xl font-bold text-brand-950">Pengingat</h3>
                    <p class="mt-3 text-sm leading-6 text-brand-700">Tekan ikon lonceng di navbar untuk melihat jadwal penjemputan, perawatan kendaraan, atau masa berlaku dokumen. Angka pada badge menunjukkan pengingat yang belum dibaca.</p>
                    <a href="{{ route('notifications.index') }}" class="mt-5 inline-flex min-h-11 items-center rounded-xl bg-brand-900 px-4 py-2.5 text-sm font-bold text-white hover:bg-brand-800">Buka pengingat</a>
                </div>
                <div class="flex items-center bg-violet-50 p-6 sm:p-8">
                    <div class="w-full rounded-2xl border border-violet-100 bg-white p-4 shadow-sm"><div class="flex items-start gap-3"><span class="grid size-10 shrink-0 place-items-center rounded-xl bg-violet-100 text-violet-800" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8"><path d="M18 9a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4" stroke-linecap="round" stroke-linejoin="round"/></svg></span><div><div class="flex flex-wrap items-center gap-2"><p class="text-sm font-bold text-brand-950">Jadwal servis mendekat</p><span class="rounded-full bg-accent-100 px-2 py-0.5 text-[10px] font-bold text-accent-800">Baru</span></div><p class="mt-1 text-xs leading-5 text-brand-700/80">Periksa jadwal kendaraan, lalu tandai pengingat sudah dibaca.</p></div></div><div class="mt-4 border-t border-brand-100 pt-3 text-xs font-semibold text-brand-700/60">Contoh tampilan pengingat</div></div>
                </div>
            </article>

            <article class="grid gap-5 overflow-hidden rounded-3xl border border-brand-100 bg-white shadow-sm md:grid-cols-[0.8fr_1.2fr]">
                <div class="bg-sky-700 p-6 text-white sm:p-8">
                    <span class="grid size-12 place-items-center rounded-2xl bg-white/15" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" class="size-6" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="8" r="3.5"/><path d="M5 20a7 7 0 0 1 14 0" stroke-linecap="round"/></svg></span>
                    <p class="mt-5 text-xs font-bold uppercase tracking-[0.14em] text-sky-100">07 · Profil</p>
                    <h3 class="mt-2 text-2xl font-bold">Pengaturan akun</h3>
                    <p class="mt-3 text-sm leading-6 text-white/80">Buka menu titik tiga untuk mengelola akun dan menemukan panduan ini lagi.</p>
                    <a href="{{ route('settings') }}" class="mt-5 inline-flex min-h-11 items-center rounded-xl bg-white px-4 py-2.5 text-sm font-bold text-sky-900 hover:bg-sky-50">Buka Pengaturan</a>
                </div>
                <div class="grid content-center gap-3 p-6 sm:p-8 sm:grid-cols-3">
                    <div class="rounded-2xl bg-sky-50 p-4"><p class="text-xs font-semibold text-brand-700">Profil</p><p class="mt-2 text-sm font-bold text-brand-950">Nama & email</p></div>
                    <div class="rounded-2xl bg-sky-50 p-4"><p class="text-xs font-semibold text-brand-700">Keamanan</p><p class="mt-2 text-sm font-bold text-brand-950">Ubah kata sandi</p></div>
                    <div class="rounded-2xl bg-red-50 p-4"><p class="text-xs font-semibold text-red-700">Sesi</p><p class="mt-2 text-sm font-bold text-red-900">Keluar akun</p></div>
                </div>
            </article>
        </section>

        <section class="grid gap-5 rounded-3xl border border-brand-100 bg-canvas p-6 sm:p-8 md:grid-cols-[1fr_auto] md:items-center">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.14em] text-accent-700">Tips agar data tetap berguna</p>
                <h2 class="mt-2 text-xl font-bold text-brand-950 sm:text-2xl">Biasakan mencatat setelah aktivitas</h2>
                <ul class="mt-3 space-y-2 text-sm leading-6 text-brand-700">
                    <li>• Hubungkan pengeluaran dengan perjalanan yang sesuai.</li>
                    <li>• Perbarui odometer setelah penggunaan kendaraan.</li>
                    <li>• Buka lonceng secara berkala dan tandai pengingat yang sudah ditindaklanjuti.</li>
                </ul>
            </div>
            <a href="{{ route('dashboard') }}" class="inline-flex min-h-12 items-center justify-center rounded-xl bg-brand-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-brand-800">Kembali ke Beranda</a>
        </section>
    </div>
@endsection
