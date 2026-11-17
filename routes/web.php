<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\DriverSimulatorController;
use App\Http\Controllers\Web\LandingController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\PublicTrackingController;
use App\Http\Controllers\Web\VehicleController;
use Illuminate\Support\Facades\Route;

// Public Landing & Pricing
Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/pricing', [LandingController::class, 'pricing'])->name('landing.pricing');

// Public Cargo Tracking Portal (B2B Shipper Portal)
Route::get('/tracking', [PublicTrackingController::class, 'index'])->name('tracking.public');

// Authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt')->middleware('throttle:6,1');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Driver Field App / Simulator (Hardware-free GPS & E-POD)
Route::prefix('driver')->name('driver.')->middleware('auth')->group(function () {
    Route::get('/', [DriverSimulatorController::class, 'index'])->name('index');
    Route::post('/order/{order}/ping', [DriverSimulatorController::class, 'pingLocation'])->name('ping');
    Route::post('/order/{order}/upload-pod', [DriverSimulatorController::class, 'uploadPod'])->name('upload-pod');
});

// Admin Command Center & Profit Intelligence Dashboard
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/operational', [DashboardController::class, 'operational'])->name('operational');
    Route::get('/finance', [DashboardController::class, 'finance'])->name('finance');

    // Orders & Margins
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/invoice', [OrderController::class, 'showInvoice'])->name('orders.invoice.show');
    Route::post('/orders/{order}/generate-invoice', [OrderController::class, 'generateInvoice'])->name('orders.invoice');

    // Vehicles Fleet Management
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');

    // Quick Demo Persona Switcher (Arjuna <-> Innike)
    Route::post('/switch-persona', function (\Illuminate\Http\Request $request) {
        $targetEmail = auth()->user()->isFinance() ? 'admin@trackfleet.id' : 'innike@trackfleet.id';
        $targetUser = \App\Models\User::where('email', $targetEmail)->first();
        if ($targetUser) {
            \Illuminate\Support\Facades\Auth::login($targetUser);
            $targetRoute = $targetUser->isFinance() ? 'admin.finance' : 'admin.operational';
            return redirect()->route($targetRoute)->with('success', 'Beralih ke persona ' . $targetUser->name . ' (' . $targetUser->roleLabel() . ').');
        }
        return back();
    })->name('switch-persona');
});
