<?php

namespace App\Http\Controllers;

use App\Enums\TripStatus;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Http\Requests\UpdateTripStatusRequest;
use App\Models\Trip;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class TripController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('viewAny', Trip::class);

        return view('trips.index', [
            'trips' => $request->user()->trips()->orderByDesc('pickup_at')->paginate(10),
        ]);
    }

    public function create(): View
    {
        Gate::authorize('create', Trip::class);

        return view('trips.create');
    }

    public function store(StoreTripRequest $request): RedirectResponse
    {
        $request->user()->trips()->create($request->validated());

        return redirect()
            ->route('trips.index')
            ->with('status', 'Jadwal perjalanan berhasil ditambahkan.');
    }

    public function edit(Trip $trip): View
    {
        Gate::authorize('view', $trip);

        return view('trips.edit', [
            'trip' => $trip,
        ]);
    }

    public function update(UpdateTripRequest $request, Trip $trip): RedirectResponse
    {
        $trip->update($request->validated());

        return redirect()
            ->route('trips.index')
            ->with('status', 'Jadwal perjalanan berhasil diperbarui.');
    }

    public function destroy(Trip $trip): RedirectResponse
    {
        Gate::authorize('delete', $trip);
        $trip->delete();

        return redirect()
            ->route('trips.index')
            ->with('status', 'Jadwal perjalanan berhasil dihapus.');
    }

    public function updateStatus(UpdateTripStatusRequest $request, Trip $trip): RedirectResponse
    {
        $trip->update(['status' => $request->enum('status', TripStatus::class)]);

        return redirect()
            ->route('trips.index')
            ->with('status', 'Status perjalanan berhasil diperbarui.');
    }
}
