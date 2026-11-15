@extends('layouts.app')

@section('title', 'Tambah jadwal perawatan')

@section('content')
    <div class="mx-auto max-w-2xl">
        <a href="{{ route('maintenance.index') }}" class="text-sm font-semibold text-accent-700 hover:underline">← Kembali ke perawatan</a>
        <h1 class="mt-4 text-3xl font-bold tracking-tight text-brand-950">Tambah jadwal perawatan</h1>
        @include('maintenance.partials.form', ['rule' => null, 'action' => route('maintenance.store'), 'method' => 'POST', 'submitLabel' => 'Simpan jadwal'])
    </div>
@endsection
