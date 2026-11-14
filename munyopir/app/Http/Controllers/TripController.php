<?php

namespace App\Http\Controllers;

use App\Enums\TripStatus;
use App\Models\Trip;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TripController extends Controller
{
    public function index(Request $request): View
    {
        return view('trips.index', [
            'trips' => $request->user()->trips()->orderByDesc('pickup_at')->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('trips.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->user()->trips()->create($request->validate($this->tripRules()));

        return redirect()
            ->route('trips.index')
            ->with('status', 'Jadwal perjalanan berhasil ditambahkan.');
    }

    public function edit(Request $request, Trip $trip): View
    {
        return view('trips.edit', [
            'trip' => $this->ownedTrip($request, $trip),
            'statuses' => TripStatus::cases(),
        ]);
    }

    public function update(Request $request, Trip $trip): RedirectResponse
    {
        $trip = $this->ownedTrip($request, $trip);
        $trip->update($request->validate([
            ...$this->tripRules(),
            'status' => ['required', Rule::enum(TripStatus::class)],
        ], [
            'status.required' => 'Status perjalanan wajib dipilih.',
            'status.enum' => 'Pilih status perjalanan yang tersedia.',
        ]));

        return redirect()
            ->route('trips.index')
            ->with('status', 'Jadwal perjalanan berhasil diperbarui.');
    }

    public function destroy(Request $request, Trip $trip): RedirectResponse
    {
        $this->ownedTrip($request, $trip)->delete();

        return redirect()
            ->route('trips.index')
            ->with('status', 'Jadwal perjalanan berhasil dihapus.');
    }

    private function ownedTrip(Request $request, Trip $trip): Trip
    {
        return $request->user()->trips()->findOrFail($trip->getKey());
    }

    /**
     * @return array<string, array<int, string>>
     */
    private function tripRules(): array
    {
        return [
            'destination' => ['required', 'string', 'max:150'],
            'pickup_location' => ['required', 'string', 'max:150'],
            'pickup_at' => ['required', 'date_format:Y-m-d\TH:i'],
        ];
    }
}
