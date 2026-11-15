<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Carbon\CarbonImmutable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function index(Request $request): View
    {
        return view('notifications.index', [
            'notifications' => $request->user()->notifications()->latest()->paginate(15),
        ]);
    }

    public function markRead(Request $request, Notification $notification): RedirectResponse
    {
        $notification = $request->user()->notifications()->findOrFail($notification->getKey());
        $notification->update(['read_at' => CarbonImmutable::now()]);

        return redirect()->route('notifications.index')->with('status', 'Pengingat ditandai sudah dibaca.');
    }
}
