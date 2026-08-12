<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelatihanController;


// Redirect root URL ke halaman login jika belum login
Route::get('/', function () {
    return redirect()->route('login');
});

// Guest Routes (Hanya bisa diakses jika belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

});

// Authenticated Routes (Hanya bisa diakses setelah login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route Resource Pelatihan
    Route::resource('pelatihan', PelatihanController::class);
});

