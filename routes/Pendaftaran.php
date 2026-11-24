<?php

use App\Http\Controllers\Pendaftaran\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {
    Route::get('/', [RegistrationController::class, 'index'])->name('index');
    Route::post('/', [RegistrationController::class, 'store'])->name('store');
    Route::patch('/{registration}/status', [RegistrationController::class, 'updateStatus'])->name('updateStatus');
    Route::delete('/{registration}', [RegistrationController::class, 'destroy'])->name('destroy');
});