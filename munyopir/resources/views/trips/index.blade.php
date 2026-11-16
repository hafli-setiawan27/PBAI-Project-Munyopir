@extends('layouts.app')

@section('title', 'Perjalanan')

@section('content')
    <section class="flex flex-col items-start gap-5 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-accent-700 hover:underline">
                <svg viewBox="0 0 20 20" fill="none" class="size-4" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path d="M16 10H4m0 0 5-5m-5 5 5 5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Kembali ke beranda
            </a>
            <p class="mt-6 text-xs font-bold uppercase tracking-[0.14em] text-accent-700">Manajemen perjalanan</p>
            <h1 class="mt-1.5 text-3xl font-bold leading-tight tracking-tight text-brand-950">Jadwal perjalanan</h1>
            <p class="mt-2 max-w-md text-sm leading-5 text-brand-800/80">Atur jadwal penjemputan dan perbarui status perjalanan.</p>
        </div>
        <a href="{{ route('trips.create') }}" class="inline-flex min-h-11 shrink-0 items-center justify-center rounded-xl bg-brand-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-brand-800 focus:outline-none focus:ring-4 focus:ring-sky-400/40">
            + Tambah perjalanan
        </a>
    </section>

    <section class="mt-7" aria-label="Daftar perjalanan">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
            @forelse ($trips as $trip)
                <article class="w-full overflow-hidden rounded-3xl border border-brand-100 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="relative grid h-32 place-items-center overflow-hidden bg-sky-50 px-5 sm:h-36">
                        <span class="absolute -left-5 -top-8 size-24 rounded-full bg-white/70" aria-hidden="true"></span>
                        <span class="absolute -bottom-10 right-0 size-28 rounded-full bg-sky-100/80" aria-hidden="true"></span>
                        <svg viewBox="0 0 180 100" class="relative z-10 h-24 w-full max-w-[17rem]" aria-hidden="true">
                            <path d="M25 72c20-33 39-35 58-5s36 31 54 0" fill="none" stroke="#BFD5FF" stroke-linecap="round" stroke-width="9" stroke-dasharray="1 13" />
                            <path d="M25 72c20-33 39-35 58-5s36 31 54 0" fill="none" stroke="#527BF0" stroke-linecap="round" stroke-width="3" />
                            <circle cx="25" cy="72" r="11" fill="#FFFFFF" stroke="#527BF0" stroke-width="3" />
                            <path d="M25 68v8m-4-4h8" stroke="#527BF0" stroke-linecap="round" stroke-width="2" />
                            <path d="M149 52c0 10-13 24-13 24s-13-14-13-24a13 13 0 1 1 26 0Z" fill="#5B3DF5" />
                            <circle cx="136" cy="52" r="4" fill="#FFFFFF" />
                        </svg>
                        <span class="absolute left-3 top-3 rounded-full bg-white/90 px-2.5 py-1 text-[10px] font-bold text-brand-800 shadow-sm">{{ $trip->pickup_at->format('d M') }}</span>
                        <span class="absolute right-3 top-3 inline-flex items-center rounded-full px-2.5 py-1 text-[10px] font-semibold ring-1 ring-inset {{ $trip->status->badgeClasses() }}">{{ $trip->status->label() }}</span>
                    </div>

                    <div class="p-4 sm:p-5">
                        <h2 class="truncate text-base font-bold text-brand-950">{{ $trip->destination }}</h2>
                        <p class="mt-1 truncate text-xs text-brand-700">Jemput di <span class="font-semibold text-brand-900">{{ $trip->pickup_location }}</span></p>
                        <p class="mt-3 text-sm font-bold text-brand-900">{{ $trip->pickup_at->format('d/m/Y, H:i') }} <span class="text-xs font-medium text-brand-600">WIB</span></p>

                        <div class="mt-4 flex flex-wrap gap-2 border-t border-brand-100 pt-3">
                            @foreach ($trip->status->nextStatuses() as $nextStatus)
                                <form method="POST" action="{{ route('trips.status', $trip) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="{{ $nextStatus->value }}">
                                    <button type="submit" class="min-h-9 rounded-lg border border-accent-200 bg-accent-50 px-2.5 py-1.5 text-[11px] font-semibold text-accent-800 transition hover:bg-accent-100 sm:text-xs">
                                        {{ match ($nextStatus) { \App\Enums\TripStatus::Changed => 'Tandai berubah', \App\Enums\TripStatus::Completed => 'Tandai selesai', \App\Enums\TripStatus::Cancelled => 'Batalkan', default => $nextStatus->label() } }}
                                    </button>
                                </form>
                            @endforeach
                            <a href="{{ route('trips.edit', $trip) }}" class="inline-flex min-h-9 items-center rounded-lg border border-brand-200 px-2.5 py-1.5 text-[11px] font-semibold text-brand-800 transition hover:border-accent-600 hover:text-accent-700 sm:text-xs">
                                Ubah
                            </a>
                            <form method="POST" action="{{ route('trips.destroy', $trip) }}" onsubmit="return confirm('Hapus jadwal perjalanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="min-h-9 rounded-lg border border-sky-200 bg-sky-50 px-2.5 py-1.5 text-[11px] font-semibold text-brand-900 transition hover:bg-sky-100 sm:text-xs">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @empty
                <div class="rounded-3xl border border-dashed border-brand-200 bg-white px-6 py-12 text-center sm:col-span-2 xl:col-span-3">
                    <h2 class="text-lg font-bold text-brand-950">Belum ada jadwal perjalanan</h2>
                    <p class="mt-2 text-sm text-brand-800/80">Tambahkan perjalanan pertama agar rencana penjemputan tersimpan.</p>
                    <a href="{{ route('trips.create') }}" class="mt-5 inline-flex min-h-11 items-center justify-center rounded-xl bg-brand-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-brand-800 focus:outline-none focus:ring-4 focus:ring-sky-400/40">
                        Tambah perjalanan
                    </a>
                </div>
            @endforelse
        </div>
    </section>

    @if ($trips->hasPages())
        <div class="mt-6">
            {{ $trips->links() }}
        </div>
    @endif
@endsection
