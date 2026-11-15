<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehicleController extends Controller
{
    public function show(Request $request): View|RedirectResponse
    {
        $vehicle = $request->user()->vehicle()->first();

        if ($vehicle === null) {
            return redirect()->route('vehicles.create');
        }

        return view('vehicles.show', ['vehicle' => $vehicle]);
    }

    public function create(Request $request): View|RedirectResponse
    {
        if ($request->user()->vehicle()->exists()) {
            return redirect()->route('vehicles.show');
        }

        return view('vehicles.create');
    }

    public function store(StoreVehicleRequest $request): RedirectResponse
    {
        if ($request->user()->vehicle()->exists()) {
            return redirect()
                ->route('vehicles.show')
                ->with('status', 'Akun ini sudah memiliki kendaraan. Data kendaraan yang ada dapat diperbarui.');
        }

        $request->user()->vehicle()->create($request->validated());

        return redirect()
            ->route('dashboard')
            ->with('status', 'Profil kendaraan berhasil disimpan.');
    }

    public function edit(Request $request): View|RedirectResponse
    {
        $vehicle = $request->user()->vehicle()->first();

        if ($vehicle === null) {
            return redirect()->route('vehicles.create');
        }

        return view('vehicles.edit', ['vehicle' => $vehicle]);
    }

    public function update(UpdateVehicleRequest $request): RedirectResponse
    {
        $vehicle = $request->user()->vehicle()->first();

        abort_if($vehicle === null, 404);

        $vehicle->update($request->validated());

        return redirect()
            ->route('vehicles.show')
            ->with('status', 'Profil kendaraan berhasil diperbarui.');
    }
}
