@extends('layouts.app')

@section('title', 'Perjalanan')

@section('content')
    <section class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-emerald-800 hover:underline">← Kembali ke beranda</a>
            <p class="mt-5 text-sm font-semibold uppercase tracking-[0.14em] text-emerald-800">Manajemen perjalanan</p>
            <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-950">Jadwal perjalanan</h1>
            <p class="mt-2 text-sm leading-6 text-slate-600">Catat rencana penjemputan dan perbarui status saat jadwal berubah.</p>
        </div>
        <a href="{{ route('trips.create') }}" class="inline-flex min-h-11 items-center justify-center rounded-xl bg-emerald-700 px-5 py-3 text-sm font-bold text-white transition hover:bg-emerald-800">
            + Tambah perjalanan
        </a>
    </section>

    <section class="mt-7 space-y-4" aria-label="Daftar perjalanan">
        @forelse ($trips as $trip)
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div class="min-w-0">
                        <div class="flex flex-wrap items-center gap-3">
                            <h2 class="text-lg font-bold text-slate-950">{{ $trip->destination }}</h2>
                            <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $trip->status->badgeClasses() }}">
                                {{ $trip->status->label() }}
                            </span>
                        </div>
                        <p class="mt-2 text-sm text-slate-600">Jemput di <span class="font-semibold text-slate-800">{{ $trip->pickup_location }}</span></p>
                        <p class="mt-3 text-sm font-semibold text-emerald-800">{{ $trip->pickup_at->format('d/m/Y, H:i') }} WIB</p>
                    </div>

                    <div class="flex shrink-0 items-center gap-2">
                        <a href="{{ route('trips.edit', $trip) }}" class="rounded-lg border border-slate-300 px-3 py-2 text-sm font-semibold text-slate-700 hover:border-emerald-700 hover:text-emerald-800">
                            Ubah
                        </a>
                        <form method="POST" action="{{ route('trips.destroy', $trip) }}" onsubmit="return confirm('Hapus jadwal perjalanan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-lg border border-red-200 px-3 py-2 text-sm font-semibold text-red-700 hover:bg-red-50">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-12 text-center">
                <h2 class="text-lg font-bold text-slate-950">Belum ada jadwal perjalanan</h2>
                <p class="mt-2 text-sm text-slate-600">Tambahkan perjalanan pertama agar rencana penjemputan tersimpan.</p>
                <a href="{{ route('trips.create') }}" class="mt-5 inline-flex min-h-11 items-center justify-center rounded-xl bg-emerald-700 px-5 py-3 text-sm font-bold text-white hover:bg-emerald-800">
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
