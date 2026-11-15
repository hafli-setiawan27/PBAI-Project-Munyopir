@extends('layouts.app')

@section('title', 'Pengingat')

@section('content')
    <div class="mx-auto max-w-4xl space-y-6">
        <header>
            <p class="text-sm font-semibold uppercase tracking-[0.14em] text-accent-700">Pusat informasi</p>
            <h1 class="mt-2 text-3xl font-bold tracking-tight text-brand-950">Pengingat</h1>
            <p class="mt-2 text-sm text-brand-700">Jadwal penjemputan, perawatan kendaraan, dan masa berlaku dokumen.</p>
        </header>

        @forelse ($notifications as $notification)
            <article @class([
                'flex flex-col gap-4 rounded-2xl border p-5 sm:flex-row sm:items-start sm:justify-between',
                'border-brand-100 bg-white' => $notification->read_at !== null,
                'border-accent-200 bg-accent-50/60' => $notification->read_at === null,
            ])>
                <div>
                    <div class="flex flex-wrap items-center gap-2">
                        <h2 class="font-bold text-brand-950">{{ $notification->title }}</h2>
                        @if ($notification->read_at === null)
                            <span class="rounded-full bg-accent-100 px-2.5 py-1 text-xs font-bold text-accent-800">Baru</span>
                        @endif
                    </div>
                    <p class="mt-2 text-sm leading-6 text-brand-800">{{ $notification->message }}</p>
                    <p class="mt-2 text-xs text-brand-700/70">{{ $notification->created_at->translatedFormat('d F Y, H:i') }}</p>
                </div>
                @if ($notification->read_at === null)
                    <form method="POST" action="{{ route('notifications.read', $notification) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="min-h-11 shrink-0 rounded-xl border border-brand-200 px-4 py-2 text-sm font-bold text-brand-900 hover:bg-white">Tandai dibaca</button>
                    </form>
                @endif
            </article>
        @empty
            <section class="rounded-3xl border border-dashed border-brand-200 bg-white px-6 py-12 text-center">
                <h2 class="text-lg font-bold text-brand-950">Belum ada pengingat</h2>
                <p class="mt-2 text-sm text-brand-700">Pengingat baru akan muncul di sini saat jadwal mendekat.</p>
            </section>
        @endforelse

        {{ $notifications->links() }}
    </div>
@endsection
