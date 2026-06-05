<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\BookingController;

// Home page - redirects based on auth status
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
})->name('home');

// Public routes - accessible without login
Route::middleware('guest')->group(function () {
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');
});

// Authenticated routes - only accessible when logged in
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Properties
    Route::prefix('properties')->name('properties.')->group(function () {
        Route::get('/', [PropertyController::class, 'index'])
            ->name('index');

        Route::get('/create', [PropertyController::class, 'create'])
            ->name('create');

        Route::post('/', [PropertyController::class, 'store'])
            ->name('store');

        Route::get('/{id}', [PropertyController::class, 'show'])
            ->name('show');

        Route::get('/{id}/edit', [PropertyController::class, 'edit'])
            ->name('edit');

        Route::put('/{id}', [PropertyController::class, 'update'])
            ->name('update');

        Route::delete('/{id}', [PropertyController::class, 'destroy'])
            ->name('destroy');
    });

    // Bookings
    Route::prefix('bookings')->name('bookings.')->group(function () {
        Route::get('/', [BookingController::class, 'index'])
            ->name('index');

        Route::get('/create/{property_id}', [BookingController::class, 'create'])
            ->name('create');

        Route::post('/', [BookingController::class, 'store'])
            ->name('store');

        Route::get('/{id}', [BookingController::class, 'show'])
            ->name('show');

        Route::get('/{id}/edit', [BookingController::class, 'edit'])
            ->name('edit');

        Route::put('/{id}', [BookingController::class, 'update'])
            ->name('update');

        Route::delete('/{id}', [BookingController::class, 'destroy'])
            ->name('destroy');
    });

    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])
            ->name('edit');

        Route::patch('/', [ProfileController::class, 'update'])
            ->name('update');

        Route::delete('/', [ProfileController::class, 'destroy'])
            ->name('destroy');
    });
});

// Authentication routes (login, register, password reset)
require __DIR__.'/auth.php';
