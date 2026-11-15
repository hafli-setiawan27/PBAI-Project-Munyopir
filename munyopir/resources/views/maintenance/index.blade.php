@extends('layouts.app')

@section('title', 'Perawatan kendaraan')

@section('content')
    <div class="mx-auto max-w-5xl space-y-6">
        <header class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.14em] text-accent-700">Kendaraan · {{ $vehicle->name }}</p>
                <h1 class="mt-2 text-3xl font-bold tracking-tight text-brand-950">Jadwal perawatan</h1>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-brand-700">Catat interval servis dan masa berlaku dokumen kendaraan. Pengingat otomatis tersedia setelah scheduler diaktifkan.</p>
            </div>
            <a href="{{ route('maintenance.create') }}" class="inline-flex min-h-12 items-center justify-center rounded-xl bg-brand-900 px-5 py-3 text-sm font-bold text-white hover:bg-brand-800">Tambah jadwal</a>
        </header>

        <form method="POST" action="{{ route('vehicles.odometer.update') }}" class="grid gap-4 rounded-2xl border border-brand-100 bg-white p-5 shadow-sm sm:grid-cols-[1fr_auto] sm:items-end">
            @csrf
            @method('PATCH')
            <div>
                <label for="current_odometer" class="mb-2 block text-sm font-semibold text-brand-800">Odometer saat ini</label>
                <div class="flex items-center gap-3">
                    <input id="current_odometer" name="current_odometer" type="number" min="{{ $vehicle->current_odometer }}" max="4294967295" value="{{ old('current_odometer', $vehicle->current_odometer) }}" required inputmode="numeric" class="min-h-12 w-full rounded-xl border border-brand-200 px-4 text-base outline-none focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
                    <span class="text-sm font-semibold text-brand-700">km</span>
                </div>
                @error('current_odometer')<p class="mt-2 text-sm text-accent-700" role="alert">{{ $message }}</p>@enderror
            </div>
            <button type="submit" class="min-h-12 rounded-xl border border-brand-200 px-5 py-3 text-sm font-bold text-brand-900 hover:bg-brand-50">Simpan odometer</button>
        </form>

        @if ($rules->isEmpty())
            <section class="rounded-3xl border border-dashed border-brand-200 bg-white px-6 py-12 text-center">
                <h2 class="text-lg font-bold text-brand-950">Belum ada jadwal perawatan</h2>
                <p class="mt-2 text-sm text-brand-700">Tambahkan jadwal servis oli, perawatan berkala, atau masa berlaku STNK/KIR.</p>
            </section>
        @else
            <div class="grid gap-4 md:grid-cols-2">
                @foreach ($rules as $rule)
                    @php($dueOdometer = $rule->dueOdometer())
                    @php($dueDate = $rule->dueDate())
                    <article class="rounded-2xl border border-brand-100 bg-white p-5 shadow-sm">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h2 class="text-lg font-bold text-brand-950">{{ $rule->name }}</h2>
                                @if ($rule->interval_km !== null)
                                    <p class="mt-2 text-sm text-brand-700">Servis berikutnya pada <strong>{{ number_format($dueOdometer, 0, ',', '.') }} km</strong>
                                        @if ($dueOdometer <= $vehicle->current_odometer + 500)<span class="ml-1 rounded-full bg-amber-50 px-2 py-1 text-xs font-bold text-amber-800">Mendekati</span>@endif
                                    </p>
                                @endif
                                @if ($dueDate !== null)
                                    <p class="mt-2 text-sm text-brand-700">Jadwal berikutnya {{ $dueDate->translatedFormat('d F Y') }}
                                        @if ($dueDate->lte(now()->addDays(14)))<span class="ml-1 rounded-full bg-amber-50 px-2 py-1 text-xs font-bold text-amber-800">Mendekati</span>@endif
                                    </p>
                                @endif
                                @if ($rule->expires_at !== null)
                                    <p class="mt-2 text-sm text-brand-700">Berlaku sampai {{ $rule->expires_at->translatedFormat('d F Y') }}
                                        @if ($rule->expires_at->lte(today()->addDays(30)))<span class="ml-1 rounded-full bg-amber-50 px-2 py-1 text-xs font-bold text-amber-800">Perlu diperpanjang</span>@endif
                                    </p>
                                @endif
                            </div>
                            <a href="{{ route('maintenance.edit', $rule) }}" class="inline-flex min-h-11 shrink-0 items-center rounded-xl px-3 text-sm font-bold text-accent-700 hover:bg-accent-50">Ubah</a>
                        </div>
                        <form method="POST" action="{{ route('maintenance.destroy', $rule) }}" class="mt-4 border-t border-brand-100 pt-3" onsubmit="return confirm('Hapus jadwal {{ $rule->name }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="min-h-11 text-sm font-semibold text-brand-600 hover:text-accent-700">Hapus jadwal</button>
                        </form>
                    </article>
                @endforeach
            </div>
            {{ $rules->links() }}
        @endif
    </div>
@endsection
