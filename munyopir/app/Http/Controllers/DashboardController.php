<?php

namespace App\Http\Controllers;

use App\Enums\TripStatus;
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
            'upcomingTrips' => $request->user()->trips()
                ->where('pickup_at', '>=', now())
                ->whereIn('status', [TripStatus::Scheduled->value, TripStatus::Changed->value])
                ->orderBy('pickup_at')
                ->limit(5)
                ->get(),
        ]);
    }
}
