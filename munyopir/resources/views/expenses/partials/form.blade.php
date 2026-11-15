<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="mt-8 space-y-5" data-receipt-form>
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div>
        <label for="category" class="mb-2 block text-sm font-semibold text-brand-800">Kategori</label>
        <select id="category" name="category" required
            class="w-full rounded-xl border border-brand-200 bg-white px-4 py-3 text-base outline-none transition focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
            <option value="">Pilih kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->value }}" @selected(old('category', $expense?->category?->value) === $category->value)>
                    {{ $category->label() }}
                </option>
            @endforeach
        </select>
        @error('category')
            <p class="mt-2 text-sm text-accent-700" role="alert">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="amount" class="mb-2 block text-sm font-semibold text-brand-800">Nominal (rupiah)</label>
        <div class="flex items-center rounded-xl border border-brand-200 focus-within:border-accent-600 focus-within:ring-4 focus-within:ring-accent-600/10">
            <span class="pl-4 text-sm font-semibold text-brand-700">Rp</span>
            <input id="amount" name="amount" type="number" value="{{ old('amount', $expense?->amount) }}" required min="1" step="1" inputmode="numeric"
                placeholder="Contoh: 150000"
                class="w-full rounded-xl border-0 bg-transparent px-3 py-3 text-base outline-none">
        </div>
        @error('amount')
            <p class="mt-2 text-sm text-accent-700" role="alert">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="expense_date" class="mb-2 block text-sm font-semibold text-brand-800">Tanggal pengeluaran</label>
        <input id="expense_date" name="expense_date" type="date" value="{{ old('expense_date', $expense?->expense_date?->format('Y-m-d')) }}" required
            class="w-full rounded-xl border border-brand-200 px-4 py-3 text-base outline-none transition focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
        @error('expense_date')
            <p class="mt-2 text-sm text-accent-700" role="alert">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="trip_id" class="mb-2 block text-sm font-semibold text-brand-800">Perjalanan terkait <span class="font-normal text-brand-700/70">(opsional)</span></label>
        <select id="trip_id" name="trip_id"
            class="w-full rounded-xl border border-brand-200 bg-white px-4 py-3 text-base outline-none transition focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">
            <option value="">Tidak terkait perjalanan</option>
            @foreach ($trips as $trip)
                <option value="{{ $trip->id }}" @selected((string) old('trip_id', $expense?->trip_id) === (string) $trip->id)>
                    {{ $trip->destination }} — {{ $trip->pickup_at->format('d/m/Y') }}
                </option>
            @endforeach
        </select>
        @error('trip_id')
            <p class="mt-2 text-sm text-accent-700" role="alert">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="mb-2 block text-sm font-semibold text-brand-800">Catatan <span class="font-normal text-brand-700/70">(opsional)</span></label>
        <textarea id="description" name="description" rows="3" maxlength="1000"
            placeholder="Tambahkan keterangan pengeluaran"
            class="w-full rounded-xl border border-brand-200 px-4 py-3 text-base outline-none transition focus:border-accent-600 focus:ring-4 focus:ring-accent-600/10">{{ old('description', $expense?->description) }}</textarea>
        @error('description')
            <p class="mt-2 text-sm text-accent-700" role="alert">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="receipt" class="mb-2 block text-sm font-semibold text-brand-800">Foto nota <span class="font-normal text-brand-700/70">(opsional, maksimal 2 MB)</span></label>
        @if ($expense?->receipt_path)
            <a href="{{ route('expenses.receipt', $expense) }}" class="mb-3 inline-flex min-h-11 items-center text-sm font-semibold text-accent-700 hover:underline">Lihat nota tersimpan</a>
        @endif
        <input id="receipt" name="receipt" type="file" accept="image/jpeg,image/png,image/webp" data-receipt-input
            class="block w-full rounded-xl border border-brand-200 bg-white px-3 py-3 text-sm text-brand-800 file:mr-4 file:rounded-lg file:border-0 file:bg-brand-50 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-brand-900">
        <p class="mt-2 hidden text-sm text-brand-700" data-receipt-compression-status aria-live="polite"></p>
        @error('receipt')
            <p class="mt-2 text-sm text-accent-700" role="alert">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="w-full rounded-xl bg-brand-900 px-5 py-3.5 text-sm font-bold text-white transition hover:bg-brand-800 focus:outline-none focus:ring-4 focus:ring-sky-400/40 sm:w-auto">
        {{ $submitLabel }}
    </button>
</form>
