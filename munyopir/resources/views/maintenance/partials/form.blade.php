<form method="POST" action="{{ $action }}" class="mt-6 space-y-5 rounded-2xl border border-brand-100 bg-white p-5 shadow-sm sm:p-7">
    @csrf
    @if ($method !== 'POST')@method($method)@endif
    <div>
        <label for="name" class="mb-2 block text-sm font-semibold text-brand-800">Nama perawatan atau dokumen</label>
        <input id="name" name="name" value="{{ old('name', $rule?->name) }}" maxlength="100" required placeholder="Contoh: Ganti oli, STNK, atau KIR" class="min-h-12 w-full rounded-xl border border-brand-200 px-4 text-base outline-none focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
        @error('name')<p class="mt-2 text-sm text-accent-700" role="alert">{{ $message }}</p>@enderror
    </div>

    <fieldset class="space-y-4 rounded-xl border border-brand-100 p-4">
        <legend class="px-2 text-sm font-bold text-brand-900">Pengingat berdasarkan odometer</legend>
        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="interval_km" class="mb-2 block text-sm font-semibold text-brand-800">Interval servis (km)</label>
                <input id="interval_km" name="interval_km" type="number" min="1" max="4294967295" value="{{ old('interval_km', $rule?->interval_km) }}" inputmode="numeric" class="min-h-12 w-full rounded-xl border border-brand-200 px-4 text-base outline-none focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
                @error('interval_km')<p class="mt-2 text-sm text-accent-700" role="alert">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="last_service_odometer" class="mb-2 block text-sm font-semibold text-brand-800">Odometer servis terakhir (km)</label>
                <input id="last_service_odometer" name="last_service_odometer" type="number" min="0" max="4294967295" value="{{ old('last_service_odometer', $rule?->last_service_odometer) }}" inputmode="numeric" class="min-h-12 w-full rounded-xl border border-brand-200 px-4 text-base outline-none focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
                @error('last_service_odometer')<p class="mt-2 text-sm text-accent-700" role="alert">{{ $message }}</p>@enderror
            </div>
        </div>
    </fieldset>

    <fieldset class="space-y-4 rounded-xl border border-brand-100 p-4">
        <legend class="px-2 text-sm font-bold text-brand-900">Pengingat berdasarkan tanggal</legend>
        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="interval_days" class="mb-2 block text-sm font-semibold text-brand-800">Interval servis (hari)</label>
                <input id="interval_days" name="interval_days" type="number" min="1" max="65535" value="{{ old('interval_days', $rule?->interval_days) }}" inputmode="numeric" class="min-h-12 w-full rounded-xl border border-brand-200 px-4 text-base outline-none focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
                @error('interval_days')<p class="mt-2 text-sm text-accent-700" role="alert">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="last_service_date" class="mb-2 block text-sm font-semibold text-brand-800">Tanggal servis terakhir</label>
                <input id="last_service_date" name="last_service_date" type="date" value="{{ old('last_service_date', $rule?->last_service_date?->toDateString()) }}" class="min-h-12 w-full rounded-xl border border-brand-200 px-4 text-base outline-none focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
                @error('last_service_date')<p class="mt-2 text-sm text-accent-700" role="alert">{{ $message }}</p>@enderror
            </div>
            <div class="sm:col-span-2">
                <label for="expires_at" class="mb-2 block text-sm font-semibold text-brand-800">Tanggal kedaluwarsa dokumen (opsional)</label>
                <input id="expires_at" name="expires_at" type="date" value="{{ old('expires_at', $rule?->expires_at?->toDateString()) }}" class="min-h-12 w-full rounded-xl border border-brand-200 px-4 text-base outline-none focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
                @error('expires_at')<p class="mt-2 text-sm text-accent-700" role="alert">{{ $message }}</p>@enderror
            </div>
        </div>
    </fieldset>

    <button type="submit" class="min-h-12 w-full rounded-xl bg-brand-900 px-5 py-3 text-sm font-bold text-white hover:bg-brand-800 sm:w-auto">{{ $submitLabel }}</button>
</form>
