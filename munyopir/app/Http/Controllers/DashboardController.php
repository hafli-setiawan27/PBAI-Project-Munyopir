<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View|RedirectResponse
    {
        $vehicle = $request->user()->vehicle()->first();

        if ($vehicle === null) {
            return redirect()->route('vehicles.create');
        }

        return view('dashboard', [
            'user' => $request->user(),
            'vehicle' => $vehicle,
        ]);
    }
}
