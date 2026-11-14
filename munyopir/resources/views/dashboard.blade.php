@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <section class="rounded-3xl bg-emerald-950 px-6 py-8 text-white sm:px-9 sm:py-10">
        <p class="text-sm font-semibold text-emerald-300">Ruang kerja sopir pribadi</p>
        <h1 class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl">Halo, {{ $user->name }}.</h1>
        <p class="mt-3 max-w-2xl text-sm leading-6 text-emerald-100/80 sm:text-base">Satu tempat untuk menjaga aktivitas dan kendaraan tetap siap menemani perjalanan.</p>
    </section>

    <section class="mt-8">
        <div class="flex flex-wrap items-end justify-between gap-3">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.14em] text-emerald-800">Kendaraan Anda</p>
                <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-950">Profil kendaraan</h2>
            </div>
            <a href="{{ route('vehicles.edit') }}" class="rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 hover:border-emerald-700 hover:text-emerald-800">
                Ubah data
            </a>
        </div>

        <div class="mt-5 grid gap-4 sm:grid-cols-3">
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:col-span-2">
                <p class="text-sm text-slate-500">Kendaraan</p>
                <p class="mt-2 text-xl font-bold text-slate-950">{{ $vehicle->name }}</p>
                <p class="mt-1 text-sm font-medium uppercase tracking-wide text-slate-600">{{ $vehicle->plate_number }}</p>
            </article>
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-slate-500">Odometer terakhir</p>
                <p class="mt-2 text-xl font-bold text-slate-950">{{ number_format($vehicle->current_odometer, 0, ',', '.') }} <span class="text-sm font-semibold text-slate-500">km</span></p>
                <p class="mt-1 text-sm text-slate-500">Perbarui setelah mencatat jarak tempuh.</p>
            </article>
        </div>
    </section>

    <section class="mt-8 rounded-2xl border border-dashed border-slate-300 bg-white p-6 sm:p-8">
        <p class="text-sm font-semibold text-emerald-800">Fondasi Munyopir sudah siap</p>
        <h2 class="mt-2 text-xl font-bold text-slate-950">Berikutnya: perjalanan, pengeluaran, dan perawatan</h2>
        <p class="mt-2 max-w-3xl text-sm leading-6 text-slate-600">Modul berikutnya akan membantu mencatat jadwal penjemputan, menyimpan foto nota untuk rekap reimbursement, dan mengingatkan perawatan kendaraan.</p>
    </section>
@endsection
