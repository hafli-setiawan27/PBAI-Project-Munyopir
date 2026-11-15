<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return view('landing');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware('throttle:login')
        ->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::view('/settings', 'settings')->name('settings');
    Route::view('/about-developer', 'about-developer')->name('about-developer');

    Route::get('/trips', [TripController::class, 'index'])->name('trips.index');
    Route::get('/trips/create', [TripController::class, 'create'])->name('trips.create');
    Route::post('/trips', [TripController::class, 'store'])->name('trips.store');
    Route::patch('/trips/{trip}/status', [TripController::class, 'updateStatus'])->name('trips.status');
    Route::get('/trips/{trip}/edit', [TripController::class, 'edit'])->name('trips.edit');
    Route::put('/trips/{trip}', [TripController::class, 'update'])->name('trips.update');
    Route::delete('/trips/{trip}', [TripController::class, 'destroy'])->name('trips.destroy');

    Route::get('/expenses/rekap', [ExpenseController::class, 'report'])->name('expenses.report');
    Route::get('/expenses/{expense}/receipt/preview', [ExpenseController::class, 'receiptPreview'])->name('expenses.receipt.preview');
    Route::get('/expenses/{expense}/receipt', [ExpenseController::class, 'receipt'])->name('expenses.receipt');
    Route::resource('expenses', ExpenseController::class);
    Route::patch('/vehicle/odometer', [MaintenanceController::class, 'updateOdometer'])->name('vehicles.odometer.update');
    Route::resource('maintenance', MaintenanceController::class)->except(['show']);
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markRead'])->name('notifications.read');

    Route::get('/vehicle', [VehicleController::class, 'show'])->name('vehicles.show');
    Route::get('/vehicle/create', [VehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicle', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::get('/vehicle/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
    Route::put('/vehicle', [VehicleController::class, 'update'])->name('vehicles.update');
});
