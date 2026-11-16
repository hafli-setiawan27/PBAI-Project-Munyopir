@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <section data-feature-carousel role="region" aria-label="Informasi fitur Munyopir" aria-roledescription="carousel">
        <h2 class="sr-only">Fitur Munyopir</h2>
        <div class="relative mx-auto w-full max-w-6xl">
            <div class="feature-carousel-viewport w-full snap-x snap-mandatory overflow-x-auto" data-carousel-viewport>
                <div class="feature-carousel-track flex w-max gap-4">
                    <article class="relative flex min-h-64 w-[min(88vw,52rem)] shrink-0 snap-center items-center gap-2 overflow-hidden rounded-3xl bg-brand-900 p-5 text-white shadow-lg shadow-brand-900/10 sm:min-h-72 sm:w-[min(76vw,60rem)] sm:gap-6 sm:p-8 lg:min-h-80 lg:w-[min(82vw,64rem)] lg:p-10" data-carousel-slide role="group" aria-roledescription="slide" aria-label="1 dari 4">
                        <div class="relative z-10 min-w-0 w-[68%]">
                            <p class="text-sm font-semibold tracking-wide text-sky-300">Perjalanan</p>
                            <h3 class="mt-2 text-2xl font-bold leading-tight sm:text-3xl lg:text-4xl">Atur jadwal perjalanan</h3>
                            <p class="mt-3 text-sm leading-6 text-brand-100/90 sm:text-base sm:leading-7">Catat lokasi jemput, tujuan, dan waktu perjalanan dengan rapi.</p>
                        </div>
                        <div class="pointer-events-none grid w-[30%] shrink-0 place-items-center" aria-hidden="true">
                            <svg viewBox="0 0 140 140" class="size-20 sm:size-32 lg:size-44">
                                <circle cx="70" cy="70" r="62" fill="#17284C"/>
                                <path d="M70 116s38-30 38-64a38 38 0 1 0-76 0c0 34 38 64 38 64Z" fill="#7398FA" opacity=".92"/>
                                <circle cx="70" cy="51" r="13" fill="#0E1A3A"/>
                                <path d="M29 112h82" stroke="#8F7CFF" stroke-linecap="round" stroke-width="5"/>
                            </svg>
                        </div>
                    </article>

                    <article class="relative flex min-h-64 w-[min(88vw,52rem)] shrink-0 snap-center items-center gap-2 overflow-hidden rounded-3xl bg-accent-700 p-5 text-white shadow-lg shadow-accent-900/10 sm:min-h-72 sm:w-[min(76vw,60rem)] sm:gap-6 sm:p-8 lg:min-h-80 lg:w-[min(82vw,64rem)] lg:p-10" data-carousel-slide role="group" aria-roledescription="slide" aria-label="2 dari 4">
                        <div class="relative z-10 min-w-0 w-[68%]">
                            <p class="text-sm font-semibold tracking-wide text-accent-100">Pengeluaran</p>
                            <h3 class="mt-2 text-2xl font-bold leading-tight sm:text-3xl lg:text-4xl">Catat biaya operasional</h3>
                            <p class="mt-3 text-sm leading-6 text-white/90 sm:text-base sm:leading-7">Simpan jumlah dan bukti transaksi agar pengeluaran mudah ditinjau.</p>
                        </div>
                        <div class="pointer-events-none grid w-[30%] shrink-0 place-items-center" aria-hidden="true">
                            <svg viewBox="0 0 140 140" class="size-20 sm:size-32 lg:size-44">
                                <circle cx="70" cy="70" r="62" fill="#3923AB"/>
                                <path d="M43 31h42l16 16v62H43z" fill="#F5F8FF"/>
                                <path d="M85 31v18h16M55 65h33M55 78h33M55 91h19" fill="none" stroke="#5B3DF5" stroke-linecap="round" stroke-linejoin="round" stroke-width="5"/>
                                <circle cx="91" cy="96" r="21" fill="#7398FA"/>
                                <path d="M91 85v22m7-16c0-3-3-5-7-5s-7 2-7 5 3 5 7 5 7 2 7 5-3 5-7 5-7-2-7-5" fill="none" stroke="#0E1A3A" stroke-linecap="round" stroke-width="3"/>
                            </svg>
                        </div>
                    </article>

                    <article class="relative flex min-h-64 w-[min(88vw,52rem)] shrink-0 snap-center items-center gap-2 overflow-hidden rounded-3xl bg-sky-700 p-5 text-white shadow-lg shadow-sky-900/10 sm:min-h-72 sm:w-[min(76vw,60rem)] sm:gap-6 sm:p-8 lg:min-h-80 lg:w-[min(82vw,64rem)] lg:p-10" data-carousel-slide role="group" aria-roledescription="slide" aria-label="3 dari 4">
                        <div class="relative z-10 min-w-0 w-[68%]">
                            <p class="text-sm font-semibold tracking-wide text-sky-100">Kendaraan</p>
                            <h3 class="mt-2 text-2xl font-bold leading-tight sm:text-3xl lg:text-4xl">Pantau informasi kendaraan</h3>
                            <p class="mt-3 text-sm leading-6 text-white/90 sm:text-base sm:leading-7">Lihat profil kendaraan dan perbarui odometer saat diperlukan.</p>
                        </div>
                        <div class="pointer-events-none grid w-[30%] shrink-0 place-items-center" aria-hidden="true">
                            <svg viewBox="0 0 140 140" class="size-20 sm:size-32 lg:size-44">
                                <circle cx="70" cy="70" r="62" fill="#324FA8"/>
                                <path d="m26 82 7-21c2-6 7-10 14-10h48c7 0 12 3 16 9l9 15 7 3v22H24V85z" fill="#DFEBFF"/>
                                <path d="m44 57-8 22h68L91 57H44Z" fill="#98B9FF"/>
                                <circle cx="47" cy="98" r="11" fill="#08122B"/>
                                <circle cx="103" cy="98" r="11" fill="#08122B"/>
                                <path d="M29 88h82" stroke="#5B3DF5" stroke-linecap="round" stroke-width="4"/>
                            </svg>
                        </div>
                    </article>

                    <article class="relative flex min-h-64 w-[min(88vw,52rem)] shrink-0 snap-center items-center gap-2 overflow-hidden rounded-3xl bg-sky-800 p-5 text-white shadow-lg shadow-sky-900/10 sm:min-h-72 sm:w-[min(76vw,60rem)] sm:gap-6 sm:p-8 lg:min-h-80 lg:w-[min(82vw,64rem)] lg:p-10" data-carousel-slide role="group" aria-roledescription="slide" aria-label="4 dari 4">
                        <div class="relative z-10 min-w-0 w-[68%]">
                            <p class="text-sm font-semibold tracking-wide text-sky-100">Status perjalanan</p>
                            <h3 class="mt-2 text-2xl font-bold leading-tight sm:text-3xl lg:text-4xl">Pantau perubahan jadwal</h3>
                            <p class="mt-3 text-sm leading-6 text-white/90 sm:text-base sm:leading-7">Lihat perjalanan yang terjadwal, berubah, selesai, atau dibatalkan.</p>
                        </div>
                        <div class="pointer-events-none grid w-[30%] shrink-0 place-items-center" aria-hidden="true">
                            <svg viewBox="0 0 140 140" class="size-20 sm:size-32 lg:size-44">
                                <circle cx="70" cy="70" r="62" fill="#17284C"/>
                                <rect x="39" y="30" width="62" height="80" rx="10" fill="#F5F8FF"/>
                                <path d="M53 51h34M53 65h34M53 79h18" stroke="#527BF0" stroke-linecap="round" stroke-width="5"/>
                                <circle cx="91" cy="91" r="20" fill="#98B9FF"/>
                                <path d="m82 91 6 6 12-13" fill="none" stroke="#0E1A3A" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"/>
                            </svg>
                        </div>
                    </article>
                </div>
            </div>
            <button class="absolute left-0 top-1/2 z-10 grid size-7 -translate-y-1/2 place-items-center rounded-full border border-white/60 bg-white/75 text-brand-700/80 shadow-sm transition hover:bg-white focus:outline-none focus-visible:ring-4 focus-visible:ring-accent-600/20" type="button" data-carousel-previous aria-label="Fitur sebelumnya">
                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m15 18-6-6 6-6" /></svg>
            </button>
            <button class="absolute right-0 top-1/2 z-10 grid size-7 -translate-y-1/2 place-items-center rounded-full border border-white/60 bg-white/75 text-brand-700/80 shadow-sm transition hover:bg-white focus:outline-none focus-visible:ring-4 focus-visible:ring-accent-600/20" type="button" data-carousel-next aria-label="Fitur berikutnya">
                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m9 18 6-6-6-6" /></svg>
            </button>
        </div>

        <div class="mx-auto mt-4 flex w-full max-w-6xl justify-end gap-3">
            <button class="inline-flex min-h-10 shrink-0 items-center rounded-lg px-3 py-2 text-xs font-semibold text-brand-700 transition hover:bg-brand-50 focus:outline-none focus-visible:ring-4 focus-visible:ring-accent-600/10 sm:text-sm" type="button" data-carousel-toggle aria-pressed="false">
                Jeda otomatis
            </button>
        </div>
    </section>

    <div class="mt-6 space-y-8 sm:mt-8 sm:space-y-10">
        <section aria-labelledby="quick-actions-title">
            <div class="mb-4 flex items-center justify-between gap-3">
                <h2 id="quick-actions-title" class="text-lg font-bold text-brand-950 sm:text-xl">Aksi cepat</h2>
            </div>

            <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
                <a href="{{ route('trips.create') }}" class="group flex min-h-28 items-center gap-3 rounded-2xl border border-brand-100 bg-white p-3 shadow-sm transition hover:-translate-y-0.5 hover:border-sky-200 hover:shadow-md focus:outline-none focus-visible:ring-4 focus-visible:ring-accent-600/15 sm:min-h-32 sm:flex-col sm:items-start sm:justify-center sm:gap-3 sm:rounded-3xl sm:p-4">
                    <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-sky-50 text-sky-700 transition group-hover:bg-sky-100 sm:size-12 sm:rounded-2xl">
                        <svg viewBox="0 0 24 24" fill="none" class="size-5 sm:size-6" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path d="M4 19V5m0 14h16M7 15l4-4 3 2 5-7" stroke-linecap="round" stroke-linejoin="round" />
                            <circle cx="7" cy="15" r="1" fill="currentColor" />
                            <circle cx="11" cy="11" r="1" fill="currentColor" />
                            <circle cx="14" cy="13" r="1" fill="currentColor" />
                            <circle cx="19" cy="6" r="1" fill="currentColor" />
                        </svg>
                    </span>
                    <span class="min-w-0 text-left">
                        <span class="block text-xs font-bold leading-tight text-brand-900 sm:text-sm">Buat jadwal</span>
                        <span class="mt-1 block text-[10px] leading-tight text-brand-600 sm:text-xs">Atur waktu jemput</span>
                    </span>
                </a>

                <a href="{{ route('expenses.create') }}" class="group flex min-h-28 items-center gap-3 rounded-2xl border border-brand-100 bg-white p-3 shadow-sm transition hover:-translate-y-0.5 hover:border-violet-200 hover:shadow-md focus:outline-none focus-visible:ring-4 focus-visible:ring-accent-600/15 sm:min-h-32 sm:flex-col sm:items-start sm:justify-center sm:gap-3 sm:rounded-3xl sm:p-4">
                    <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-accent-50 text-accent-700 transition group-hover:bg-accent-100 sm:size-12 sm:rounded-2xl">
                        <svg viewBox="0 0 24 24" fill="none" class="size-5 sm:size-6" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <rect x="3.5" y="6" width="17" height="13" rx="2.5" />
                            <path d="M3.5 10h17M7 15h3" stroke-linecap="round" />
                            <path d="M7 6V4.5h10V6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <span class="min-w-0 text-left">
                        <span class="block text-xs font-bold leading-tight text-brand-900 sm:text-sm">Catat biaya</span>
                        <span class="mt-1 block text-[10px] leading-tight text-brand-600 sm:text-xs">Simpan transaksi</span>
                    </span>
                </a>

                <a href="{{ route('maintenance.create') }}" class="group flex min-h-28 items-center gap-3 rounded-2xl border border-brand-100 bg-white p-3 shadow-sm transition hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-md focus:outline-none focus-visible:ring-4 focus-visible:ring-accent-600/15 sm:min-h-32 sm:flex-col sm:items-start sm:justify-center sm:gap-3 sm:rounded-3xl sm:p-4">
                    <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-emerald-50 text-emerald-700 transition group-hover:bg-emerald-100 sm:size-12 sm:rounded-2xl">
                        <svg viewBox="0 0 24 24" fill="none" class="size-5 sm:size-6" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path d="M12 3.5v2m0 13v2m8.5-8.5h-2m-13 0h-2m14.51-6.01-1.42 1.42m-9.18 9.18-1.42 1.42m12.02 0-1.42-1.42m-9.18-9.18L7 5.99" stroke-linecap="round" />
                            <circle cx="12" cy="12" r="4" />
                            <circle cx="12" cy="12" r="1" fill="currentColor" />
                        </svg>
                    </span>
                    <span class="min-w-0 text-left">
                        <span class="block text-xs font-bold leading-tight text-brand-900 sm:text-sm">Tambah servis</span>
                        <span class="mt-1 block text-[10px] leading-tight text-brand-600 sm:text-xs">Atur perawatan rutin</span>
                    </span>
                </a>

                <a href="{{ route('maintenance.index') }}" class="group flex min-h-28 items-center gap-3 rounded-2xl border border-brand-100 bg-white p-3 shadow-sm transition hover:-translate-y-0.5 hover:border-amber-200 hover:shadow-md focus:outline-none focus-visible:ring-4 focus-visible:ring-accent-600/15 sm:min-h-32 sm:flex-col sm:items-start sm:justify-center sm:gap-3 sm:rounded-3xl sm:p-4">
                    <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-amber-50 text-amber-700 transition group-hover:bg-amber-100 sm:size-12 sm:rounded-2xl">
                        <svg viewBox="0 0 24 24" fill="none" class="size-5 sm:size-6" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path d="m3 13 1.5-5A2 2 0 0 1 6.4 6.5h11.2A2 2 0 0 1 19.5 8l1.5 5v5h-3v-2H6v2H3v-5Z" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4 13h16M7 10h.01M17 10h.01" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <span class="min-w-0 text-left">
                        <span class="block text-xs font-bold leading-tight text-brand-900 sm:text-sm">Perbarui km</span>
                        <span class="mt-1 block text-[10px] leading-tight text-brand-600 sm:text-xs">Catat odometer</span>
                    </span>
                </a>
            </div>
        </section>

        <section aria-labelledby="vehicle-summary-title">
            <div class="mb-4">
                <h2 id="vehicle-summary-title" class="text-lg font-bold text-brand-950 sm:text-xl">Informasi kendaraan</h2>
            </div>

            <div class="grid grid-cols-1 gap-3 sm:max-w-2xl sm:gap-4">
                <article class="w-full overflow-hidden rounded-3xl border border-brand-100 bg-white shadow-sm">
                    <div class="grid h-32 place-items-center bg-sky-50 px-5 sm:h-36">
                        <x-vehicle-illustration class="h-28 w-full max-w-[17rem]" />
                    </div>
                    <div class="p-4 sm:p-5">
                        <div class="flex items-center justify-between gap-2">
                            <p class="text-xs font-semibold text-emerald-700">Kendaraan Anda</p>
                            <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2 py-1 text-[10px] font-semibold text-emerald-700">
                                <span class="size-1.5 rounded-full bg-emerald-500" aria-hidden="true"></span>
                                Terpantau
                            </span>
                        </div>
                        <h3 class="mt-2 truncate text-base font-bold text-brand-950 sm:text-lg">{{ $vehicle->name }}</h3>
                        <div class="mt-3 flex items-end justify-between gap-3">
                            <div>
                                <p class="text-[11px] text-brand-600">Odometer</p>
                                <p class="mt-0.5 text-sm font-bold text-brand-900">{{ number_format($vehicle->current_odometer, 0, ',', '.') }} <span class="text-xs font-medium text-brand-600">km</span></p>
                            </div>
                            <span class="rounded-lg border border-brand-100 bg-brand-50 px-2 py-1 font-mono text-[11px] font-bold tracking-wider text-brand-800">{{ $vehicle->plate_number }}</span>
                        </div>
                        <a href="{{ route('vehicles.show') }}" class="mt-4 inline-flex min-h-10 w-full items-center justify-center rounded-xl bg-brand-900 px-4 py-2 text-xs font-bold text-white transition hover:bg-brand-800 focus:outline-none focus-visible:ring-4 focus-visible:ring-sky-400/40 sm:text-sm">
                            Lihat kendaraan
                        </a>
                    </div>
                </article>

            </div>
        </section>

        <section aria-labelledby="upcoming-trips-title">
            <div class="flex flex-wrap items-end justify-between gap-3">
                <div>
                    <p class="text-sm font-semibold text-accent-700">Jadwal Anda</p>
                    <h2 id="upcoming-trips-title" class="mt-1 text-xl font-bold leading-tight text-brand-950 sm:text-2xl">Perjalanan mendatang</h2>
                </div>
                <a href="{{ route('trips.index') }}" class="text-sm font-semibold text-brand-700 transition hover:text-accent-700">Semua perjalanan</a>
            </div>

            <div class="mt-4 grid grid-cols-2 gap-3 sm:gap-4">
                @forelse ($upcomingTrips as $trip)
                    <article class="overflow-hidden rounded-2xl border border-brand-100 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md sm:rounded-3xl">
                        <div class="relative grid h-28 place-items-center overflow-hidden bg-sky-50 px-3 sm:h-36 sm:px-5" aria-hidden="true">
                            <span class="absolute -left-5 -top-8 size-24 rounded-full bg-white/70"></span>
                            <span class="absolute -bottom-10 right-0 size-28 rounded-full bg-sky-100/80"></span>
                            <svg viewBox="0 0 180 100" class="relative z-10 h-20 w-full max-w-[15rem] sm:h-24">
                                <path d="M25 72c20-33 39-35 58-5s36 31 54 0" fill="none" stroke="#BFD5FF" stroke-linecap="round" stroke-width="9" stroke-dasharray="1 13" />
                                <path d="M25 72c20-33 39-35 58-5s36 31 54 0" fill="none" stroke="#527BF0" stroke-linecap="round" stroke-width="3" />
                                <circle cx="25" cy="72" r="11" fill="#FFFFFF" stroke="#527BF0" stroke-width="3" />
                                <path d="M25 68v8m-4-4h8" stroke="#527BF0" stroke-linecap="round" stroke-width="2" />
                                <path d="M149 52c0 10-13 24-13 24s-13-14-13-24a13 13 0 1 1 26 0Z" fill="#5B3DF5" />
                                <circle cx="136" cy="52" r="4" fill="#FFFFFF" />
                            </svg>
                            <span class="absolute right-2 top-2 rounded-full px-2 py-1 text-[9px] font-bold ring-1 ring-inset sm:right-3 sm:top-3 sm:text-[10px] {{ $trip->status->badgeClasses() }}">{{ $trip->status->label() }}</span>
                        </div>
                        <div class="p-3 sm:p-4">
                            <h3 class="truncate text-sm font-bold text-brand-950 sm:text-base">{{ $trip->destination }}</h3>
                            <p class="mt-1 truncate text-[10px] text-brand-700 sm:text-xs">Jemput di {{ $trip->pickup_location }}</p>
                            <p class="mt-3 border-t border-brand-100 pt-2 text-[10px] font-semibold text-brand-800 sm:text-xs">{{ $trip->pickup_at->format('d/m/Y, H:i') }}</p>
                            <a href="{{ route('trips.edit', $trip) }}" class="mt-3 inline-flex min-h-9 w-full items-center justify-center rounded-lg bg-brand-50 px-3 py-2 text-[10px] font-bold text-brand-800 transition hover:bg-brand-100 focus:outline-none focus-visible:ring-4 focus-visible:ring-accent-600/15 sm:text-xs">
                                Lihat jadwal
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-2 rounded-2xl border border-dashed border-brand-200 bg-white p-5 sm:p-6">
                        <p class="font-semibold text-brand-950">Belum ada perjalanan terjadwal</p>
                        <p class="mt-1 text-sm text-brand-800/80">Buat jadwal untuk melihat tujuan dan waktu penjemputan di sini.</p>
                    </div>
                @endforelse
            </div>

                <a href="{{ route('trips.create') }}" class="mt-4 inline-flex min-h-11 items-center justify-center rounded-xl border border-brand-200 bg-white px-4 py-2.5 text-sm font-bold text-brand-800 transition hover:border-accent-300 hover:bg-brand-50 focus:outline-none focus-visible:ring-4 focus-visible:ring-accent-600/15">
                    + Tambah perjalanan
                </a>
        </section>
    </div>
@endsection
