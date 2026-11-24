<?php

use App\Http\Controllers\Peserta\AuthController;
use App\Http\Controllers\Peserta\DashboardController;
use App\Http\Controllers\Peserta\ParticipantController;
use App\Http\Controllers\Peserta\PasswordController;
use Illuminate\Support\Facades\Route;

// Halaman awal: arahkan ke dashboard (yang belum login otomatis dilempar ke /login).
Route::redirect('/', '/dashboard');

// Hanya untuk tamu (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1') // maksimal 5 percobaan per menit
        ->name('login.store');
});

// Hanya untuk user yang sudah login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Ganti password: hanya untuk akun yang sedang login (milik sendiri)
    Route::get('/password', [PasswordController::class, 'edit'])->name('password.edit');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');

    // Hanya untuk admin
    Route::middleware('role:admin')->group(function () {
        Route::resource('peserta', ParticipantController::class)
            ->parameters(['peserta' => 'participant'])
            ->names('participants');
    });
});
