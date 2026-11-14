@extends('layouts.app')

@section('title', 'Ubah perjalanan')

@section('content')
    <div class="mx-auto max-w-2xl">
        <a href="{{ route('trips.index') }}" class="text-sm font-semibold text-emerald-800 hover:underline">← Kembali ke perjalanan</a>
        <div class="mt-5 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-9">
            <p class="text-sm font-semibold uppercase tracking-[0.16em] text-emerald-800">Jadwal perjalanan</p>
            <h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-950">Ubah perjalanan</h1>
            <p class="mt-2 text-sm leading-6 text-slate-600">Perbarui rencana atau status perjalanan jika ada perubahan.</p>

            @include('trips.partials.form', [
                'action' => route('trips.update', $trip),
                'method' => 'PUT',
                'trip' => $trip,
                'statuses' => $statuses,
                'submitLabel' => 'Simpan perubahan',
            ])
        </div>
    </div>
@endsection
