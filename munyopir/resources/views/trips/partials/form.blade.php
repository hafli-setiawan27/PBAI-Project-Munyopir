<form method="POST" action="{{ $action }}" class="mt-8 space-y-5">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div>
        <label for="destination" class="mb-2 block text-sm font-semibold text-brand-800">Tujuan perjalanan</label>
        <input id="destination" name="destination" type="text" value="{{ old('destination', $trip?->destination) }}" required maxlength="150" autocomplete="off"
            placeholder="Contoh: Bandara Soekarno-Hatta"
            class="w-full rounded-xl border border-brand-200 px-4 py-3 text-base outline-none transition focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
        @error('destination')
            <p class="mt-2 text-sm text-red-700" role="alert">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="pickup_location" class="mb-2 block text-sm font-semibold text-brand-800">Lokasi penjemputan</label>
        <input id="pickup_location" name="pickup_location" type="text" value="{{ old('pickup_location', $trip?->pickup_location) }}" required maxlength="150" autocomplete="street-address"
            placeholder="Contoh: Rumah atau kantor"
            class="w-full rounded-xl border border-brand-200 px-4 py-3 text-base outline-none transition focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
        @error('pickup_location')
            <p class="mt-2 text-sm text-red-700" role="alert">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="pickup_at" class="mb-2 block text-sm font-semibold text-brand-800">Waktu penjemputan</label>
        <input id="pickup_at" name="pickup_at" type="datetime-local" value="{{ old('pickup_at', $trip?->pickup_at?->format('Y-m-d\TH:i')) }}" required
            class="w-full rounded-xl border border-brand-200 px-4 py-3 text-base outline-none transition focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
        @error('pickup_at')
            <p class="mt-2 text-sm text-red-700" role="alert">{{ $message }}</p>
        @enderror
    </div>

    @if ($trip)
        <div>
            <label for="status" class="mb-2 block text-sm font-semibold text-brand-800">Status perjalanan</label>
            <select id="status" name="status" required
                class="w-full rounded-xl border border-brand-200 bg-white px-4 py-3 text-base outline-none transition focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
                @foreach ($statuses as $status)
                    <option value="{{ $status->value }}" @selected(old('status', $trip->status->value) === $status->value)>
                        {{ $status->label() }}
                    </option>
                @endforeach
            </select>
            @error('status')
                <p class="mt-2 text-sm text-red-700" role="alert">{{ $message }}</p>
            @enderror
        </div>
    @endif

    <button type="submit" class="w-full rounded-xl bg-brand-900 px-5 py-3.5 text-sm font-bold text-white transition hover:bg-brand-800 focus:outline-none focus:ring-4 focus:ring-lime-400/40 sm:w-auto">
        {{ $submitLabel }}
    </button>
</form>
