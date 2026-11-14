<form method="POST" action="{{ $action }}" class="mt-8 space-y-5">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div>
        <label for="name" class="mb-2 block text-sm font-semibold text-brand-800">Nama / tipe kendaraan</label>
        <input id="name" name="name" type="text" value="{{ old('name', $vehicle?->name) }}" required maxlength="100" autocomplete="organization-title"
            placeholder="Contoh: Toyota Avanza"
            class="w-full rounded-xl border border-brand-200 px-4 py-3 text-base outline-none transition focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
        @error('name')
            <p class="mt-2 text-sm text-red-700" role="alert">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="plate_number" class="mb-2 block text-sm font-semibold text-brand-800">Nomor polisi</label>
        <input id="plate_number" name="plate_number" type="text" value="{{ old('plate_number', $vehicle?->plate_number) }}" required maxlength="20"
            placeholder="Contoh: B 1234 XYZ"
            class="w-full rounded-xl border border-brand-200 px-4 py-3 text-base uppercase outline-none transition focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
        @error('plate_number')
            <p class="mt-2 text-sm text-red-700" role="alert">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="current_odometer" class="mb-2 block text-sm font-semibold text-brand-800">Odometer saat ini (km)</label>
        <input id="current_odometer" name="current_odometer" type="number" value="{{ old('current_odometer', $vehicle?->current_odometer ?? 0) }}" required min="0" inputmode="numeric"
            class="w-full rounded-xl border border-brand-200 px-4 py-3 text-base outline-none transition focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
        @error('current_odometer')
            <p class="mt-2 text-sm text-red-700" role="alert">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="w-full rounded-xl bg-brand-900 px-5 py-3.5 text-sm font-bold text-white transition hover:bg-brand-800 focus:outline-none focus:ring-4 focus:ring-lime-400/40 sm:w-auto">
        {{ $submitLabel }}
    </button>
</form>
