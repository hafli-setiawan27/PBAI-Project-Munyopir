<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehicleController extends Controller
{
    public function create(Request $request): View|RedirectResponse
    {
        if ($request->user()->vehicle()->exists()) {
            return redirect()->route('vehicles.edit');
        }

        return view('vehicles.create');
    }

    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->vehicle()->exists()) {
            return redirect()
                ->route('vehicles.edit')
                ->with('status', 'Akun ini sudah memiliki kendaraan. Data kendaraan yang ada dapat diperbarui.');
        }

        $validated = $request->validate($this->vehicleRules(), [
            'name.required' => 'Nama kendaraan wajib diisi.',
            'plate_number.required' => 'Nomor polisi wajib diisi.',
            'current_odometer.required' => 'Odometer wajib diisi.',
            'current_odometer.integer' => 'Odometer harus berupa angka.',
            'current_odometer.min' => 'Odometer tidak boleh kurang dari 0.',
            'current_odometer.max' => 'Odometer terlalu besar.',
        ]);

        $request->user()->vehicle()->create($validated);

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

    public function update(Request $request): RedirectResponse
    {
        $vehicle = $request->user()->vehicle()->first();

        abort_if($vehicle === null, 404);

        $vehicle->update($request->validate($this->vehicleRules(), [
            'name.required' => 'Nama kendaraan wajib diisi.',
            'plate_number.required' => 'Nomor polisi wajib diisi.',
            'current_odometer.required' => 'Odometer wajib diisi.',
            'current_odometer.integer' => 'Odometer harus berupa angka.',
            'current_odometer.min' => 'Odometer tidak boleh kurang dari 0.',
            'current_odometer.max' => 'Odometer terlalu besar.',
        ]));

        return redirect()
            ->route('dashboard')
            ->with('status', 'Profil kendaraan berhasil diperbarui.');
    }

    /**
     * @return array<string, array<int, string>>
     */
    private function vehicleRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'plate_number' => ['required', 'string', 'max:20'],
            'current_odometer' => ['required', 'integer', 'min:0', 'max:4294967295'],
        ];
    }
}
