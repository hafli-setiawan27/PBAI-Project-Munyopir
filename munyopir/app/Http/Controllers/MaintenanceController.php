<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMaintenanceRuleRequest;
use App\Http\Requests\UpdateMaintenanceRuleRequest;
use App\Http\Requests\UpdateVehicleOdometerRequest;
use App\Models\MaintenanceRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $vehicle = $request->user()->vehicle()->firstOrFail();
        Gate::authorize('viewAny', MaintenanceRule::class);

        return view('maintenance.index', [
            'vehicle' => $vehicle,
            'rules' => $vehicle->maintenanceRules()->orderBy('name')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        Gate::authorize('create', MaintenanceRule::class);

        return view('maintenance.create', ['rule' => null]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaintenanceRuleRequest $request): RedirectResponse
    {
        $request->user()->vehicle()->firstOrFail()->maintenanceRules()->create($request->validated());

        return redirect()->route('maintenance.index')->with('status', 'Jadwal perawatan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MaintenanceRule $maintenance): View
    {
        Gate::authorize('update', $maintenance);

        return view('maintenance.edit', ['rule' => $maintenance]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaintenanceRuleRequest $request, MaintenanceRule $maintenance): RedirectResponse
    {
        $maintenance->update($request->validated());

        return redirect()->route('maintenance.index')->with('status', 'Jadwal perawatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaintenanceRule $maintenance): RedirectResponse
    {
        Gate::authorize('delete', $maintenance);
        $maintenance->delete();

        return redirect()->route('maintenance.index')->with('status', 'Jadwal perawatan berhasil dihapus.');
    }

    public function updateOdometer(UpdateVehicleOdometerRequest $request): RedirectResponse
    {
        $request->user()->vehicle()->firstOrFail()->update($request->validated());

        return redirect()->route('maintenance.index')->with('status', 'Odometer berhasil diperbarui.');
    }
}
