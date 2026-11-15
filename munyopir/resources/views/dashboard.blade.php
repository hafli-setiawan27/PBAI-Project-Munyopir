@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <section data-feature-carousel role="region" aria-label="Informasi fitur Munyopir" aria-roledescription="carousel">
        <h2 class="sr-only">Fitur Munyopir</h2>
        <div class="feature-carousel-viewport mx-auto w-full max-w-6xl snap-x snap-mandatory overflow-x-auto" data-carousel-viewport>
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

        <div class="mx-auto mt-4 flex w-full max-w-6xl items-center justify-between gap-3">
            <div class="flex items-center gap-2" role="group" aria-label="Pilih fitur">
                <button class="grid size-9 place-items-center rounded-full focus:outline-none focus-visible:ring-4 focus-visible:ring-accent-600/20" type="button" data-carousel-indicator aria-label="Tampilkan fitur perjalanan" aria-pressed="true"><span class="size-3 rounded-full bg-brand-900 transition" aria-hidden="true"></span></button>
                <button class="grid size-9 place-items-center rounded-full focus:outline-none focus-visible:ring-4 focus-visible:ring-accent-600/20" type="button" data-carousel-indicator aria-label="Tampilkan fitur pengeluaran" aria-pressed="false"><span class="size-3 rounded-full bg-brand-200 transition" aria-hidden="true"></span></button>
                <button class="grid size-9 place-items-center rounded-full focus:outline-none focus-visible:ring-4 focus-visible:ring-accent-600/20" type="button" data-carousel-indicator aria-label="Tampilkan fitur kendaraan" aria-pressed="false"><span class="size-3 rounded-full bg-brand-200 transition" aria-hidden="true"></span></button>
                <button class="grid size-9 place-items-center rounded-full focus:outline-none focus-visible:ring-4 focus-visible:ring-accent-600/20" type="button" data-carousel-indicator aria-label="Tampilkan fitur status perjalanan" aria-pressed="false"><span class="size-3 rounded-full bg-brand-200 transition" aria-hidden="true"></span></button>
            </div>
            <button class="inline-flex min-h-10 shrink-0 items-center rounded-lg px-3 py-2 text-xs font-semibold text-brand-700 transition hover:bg-brand-50 focus:outline-none focus-visible:ring-4 focus-visible:ring-accent-600/10 sm:text-sm" type="button" data-carousel-toggle aria-pressed="false">
                Jeda otomatis
            </button>
        </div>
    </section>

    <section class="mt-8">
        <div class="flex flex-wrap items-end justify-between gap-3">
            <div>
                <p class="text-sm font-semibold text-accent-700">Kendaraan Anda</p>
                <h2 class="mt-1 text-2xl font-bold leading-tight text-brand-950 sm:text-3xl">Informasi kendaraan</h2>
            </div>
            <a href="{{ route('vehicles.show') }}" class="inline-flex min-h-11 items-center gap-2 rounded-xl border border-brand-200 bg-white px-4 py-2.5 text-sm font-semibold text-brand-800 transition hover:border-accent-600 hover:text-accent-700">
                <svg viewBox="0 0 24 24" fill="none" class="size-4" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/>
                    <circle cx="12" cy="12" r="2.5"/>
                </svg>
                Lihat profil
            </a>
        </div>

        <div class="mt-5 grid gap-4 lg:grid-cols-[minmax(0,1.7fr)_minmax(15rem,0.8fr)]">
            <article class="overflow-hidden rounded-3xl border border-brand-100 bg-white shadow-sm">
                <div class="grid h-full md:grid-cols-2">
                    <div class="p-5 sm:p-7">
                        <p class="text-sm text-brand-700/70">Tipe kendaraan</p>
                        <h3 class="mt-2 text-xl font-bold text-brand-950">{{ $vehicle->name }}</h3>
                        <p class="mt-5 text-sm font-medium text-brand-700/80">Nomor polisi</p>
                        <div class="mt-2 inline-flex min-h-11 items-center rounded-lg border-2 border-brand-200 bg-white px-3 py-2 shadow-sm">
                            <span class="font-mono text-base font-bold tracking-widest text-brand-950">{{ $vehicle->plate_number }}</span>
                        </div>
                    </div>

                    <div class="flex min-h-44 items-center justify-center bg-sky-50 px-5 py-7 sm:min-h-56">
                        <x-vehicle-illustration class="max-w-[18rem]" />
                    </div>
                </div>
            </article>

            <article class="rounded-3xl border border-brand-100 bg-white p-5 shadow-sm sm:p-6">
                <div class="flex size-11 items-center justify-center rounded-xl bg-accent-50 text-accent-700" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" class="size-5" stroke="currentColor" stroke-width="1.8">
                        <path d="M4 17a8 8 0 1 1 16 0M12 13l4-4M7 17h10" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="12" cy="17" r="1"/>
                    </svg>
                </div>
                <p class="mt-5 text-sm font-medium text-brand-700/70">Odometer saat ini</p>
                <p class="mt-1 text-3xl font-bold leading-tight text-brand-950">
                    {{ number_format($vehicle->current_odometer, 0, ',', '.') }}
                    <span class="text-base font-semibold text-brand-700/70">km</span>
                </p>
                <p class="mt-3 text-sm leading-6 text-brand-800/80">Perbarui angka kilometer melalui profil kendaraan.</p>
            </article>
        </div>
    </section>

    <section class="mt-9">
        <div class="flex flex-wrap items-end justify-between gap-3">
            <div>
                <p class="text-sm font-semibold text-accent-700">Rencana berikutnya</p>
                <h2 class="mt-1 text-2xl font-bold leading-tight text-brand-950 sm:text-3xl">Perjalanan mendatang</h2>
            </div>
            <a href="{{ route('trips.index') }}" class="rounded-xl border border-brand-200 bg-white px-4 py-2.5 text-sm font-semibold text-brand-800 transition hover:border-accent-600 hover:text-accent-700">
                Semua perjalanan
            </a>
        </div>

        <div class="mt-5 space-y-3">
            @forelse ($upcomingTrips as $trip)
                <article class="flex flex-wrap items-center justify-between gap-3 rounded-2xl border border-brand-100 bg-white p-4 shadow-sm sm:p-5">
                    <div class="min-w-0">
                        <h3 class="truncate font-bold text-brand-950">{{ $trip->destination }}</h3>
                        <p class="mt-1 truncate text-sm text-brand-800/80">Jemput di {{ $trip->pickup_location }}</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-semibold text-brand-800">{{ $trip->pickup_at->format('d/m/Y, H:i') }}</span>
                        <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $trip->status->badgeClasses() }}">
                            {{ $trip->status->label() }}
                        </span>
                    </div>
                </article>
            @empty
                <div class="rounded-2xl border border-dashed border-brand-200 bg-white p-6">
                    <p class="font-semibold text-brand-950">Belum ada perjalanan mendatang</p>
                    <p class="mt-1 text-sm text-brand-800/80">Tambahkan jadwal agar rencana penjemputan mudah dipantau.</p>
                </div>
            @endforelse
        </div>

        <a href="{{ route('trips.create') }}" class="mt-4 inline-flex min-h-11 items-center justify-center rounded-xl bg-brand-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-brand-800 focus:outline-none focus:ring-4 focus:ring-sky-400/40">
            + Tambah perjalanan
        </a>
    </section>
@endsection
