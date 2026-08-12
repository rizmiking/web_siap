<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\AdministrasiController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\DashboardController;


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


    Route::get('/dashboard', DashboardController::class)
        ->middleware(['auth'])
        ->name('dashboard');
        
    // Route Resource Pelatihan
    Route::resource('pelatihan', PelatihanController::class);

    // Administrasi per Pelatihan
    Route::get('/pelatihan/{pelatihan}/administrasi', [AdministrasiController::class, 'index'])->name('pelatihan.administrasi.index');
    Route::post('/pelatihan/{pelatihan}/administrasi', [AdministrasiController::class, 'store'])->name('pelatihan.administrasi.store');

    Route::put('/administrasi/{administrasi}', [AdministrasiController::class, 'update'])->name('administrasi.update');
    Route::delete('/administrasi/{administrasi}', [AdministrasiController::class, 'destroy'])->name('administrasi.destroy');

    // Peserta per Pelatihan
    Route::get('/pelatihan/{pelatihan}/peserta', [PesertaController::class, 'index'])->name('pelatihan.peserta.index');
    Route::post('/pelatihan/{pelatihan}/peserta', [PesertaController::class, 'store'])->name('pelatihan.peserta.store');

    Route::put('/peserta/{peserta}', [PesertaController::class, 'update'])->name('peserta.update');
    Route::delete('/peserta/{peserta}', [PesertaController::class, 'destroy'])->name('peserta.destroy');
});

