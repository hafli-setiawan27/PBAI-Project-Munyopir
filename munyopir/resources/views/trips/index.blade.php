@extends('layouts.app')

@section('title', 'Perjalanan')

@section('content')
    <section class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-accent-700 hover:underline">← Kembali ke beranda</a>
            <p class="mt-5 text-sm font-semibold uppercase tracking-[0.14em] text-accent-700">Manajemen perjalanan</p>
            <h1 class="mt-2 text-3xl font-bold tracking-tight text-brand-950">Jadwal perjalanan</h1>
            <p class="mt-2 text-sm leading-6 text-brand-800/80">Catat rencana penjemputan dan perbarui status saat jadwal berubah.</p>
        </div>
        <a href="{{ route('trips.create') }}" class="inline-flex min-h-11 items-center justify-center rounded-xl bg-brand-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-brand-800 focus:outline-none focus:ring-4 focus:ring-sky-400/40">
            + Tambah perjalanan
        </a>
    </section>

    <section class="mt-7 space-y-4" aria-label="Daftar perjalanan">
        @forelse ($trips as $trip)
            <article class="rounded-2xl border border-brand-100 bg-white p-5 shadow-sm sm:p-6">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div class="min-w-0">
                        <div class="flex flex-wrap items-center gap-3">
                            <h2 class="text-lg font-bold text-brand-950">{{ $trip->destination }}</h2>
                            <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $trip->status->badgeClasses() }}">
                                {{ $trip->status->label() }}
                            </span>
                        </div>
                        <p class="mt-2 text-sm text-brand-800/80">Jemput di <span class="font-semibold text-brand-900">{{ $trip->pickup_location }}</span></p>
                        <p class="mt-3 text-sm font-semibold text-brand-700">{{ $trip->pickup_at->format('d/m/Y, H:i') }} WIB</p>
                    </div>

                    <div class="flex shrink-0 items-center gap-2">
                        @foreach ($trip->status->nextStatuses() as $nextStatus)
                            <form method="POST" action="{{ route('trips.status', $trip) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="{{ $nextStatus->value }}">
                                <button type="submit" class="min-h-11 rounded-lg border border-accent-200 bg-accent-50 px-3 py-2 text-sm font-semibold text-accent-800 transition hover:bg-accent-100">
                                    {{ match ($nextStatus) { \App\Enums\TripStatus::Changed => 'Tandai berubah', \App\Enums\TripStatus::Completed => 'Tandai selesai', \App\Enums\TripStatus::Cancelled => 'Batalkan', default => $nextStatus->label() } }}
                                </button>
                            </form>
                        @endforeach
                        <a href="{{ route('trips.edit', $trip) }}" class="rounded-lg border border-brand-200 px-3 py-2 text-sm font-semibold text-brand-800 transition hover:border-accent-600 hover:text-accent-700">
                            Ubah
                        </a>
                        <form method="POST" action="{{ route('trips.destroy', $trip) }}" onsubmit="return confirm('Hapus jadwal perjalanan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-lg border border-sky-200 bg-sky-50 px-3 py-2 text-sm font-semibold text-brand-900 hover:bg-sky-100">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div class="rounded-2xl border border-dashed border-brand-200 bg-white px-6 py-12 text-center">
                <h2 class="text-lg font-bold text-brand-950">Belum ada jadwal perjalanan</h2>
                <p class="mt-2 text-sm text-brand-800/80">Tambahkan perjalanan pertama agar rencana penjemputan tersimpan.</p>
                <a href="{{ route('trips.create') }}" class="mt-5 inline-flex min-h-11 items-center justify-center rounded-xl bg-brand-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-brand-800 focus:outline-none focus:ring-4 focus:ring-sky-400/40">
                    Tambah perjalanan
                </a>
            </div>
        @endforelse
    </section>

    @if ($trips->hasPages())
        <div class="mt-6">
            {{ $trips->links() }}
        </div>
    @endif
@endsection
