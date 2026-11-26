<?php

use App\Http\Controllers\Pendaftaran\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:mahasiswa'])->prefix('pendaftaran')->name('pendaftaran.')->group(function () {
    Route::get('/', [RegistrationController::class, 'index'])->name('index');
    Route::post('/', [RegistrationController::class, 'store'])->name('store');
});
