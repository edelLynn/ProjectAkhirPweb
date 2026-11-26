<?php

use App\Http\Controllers\Mahasiswa\StudentEventController;
use Illuminate\Support\Facades\Route;

//baru
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    //baru
    Route::get('/kegiatan', [StudentEventController::class, 'index'])->name('kegiatan.index');
    //baru
    Route::post('/kegiatan/{event}/daftar', [StudentEventController::class, 'store'])->name('kegiatan.store');
    //baru
    Route::delete('/kegiatan/{event}/daftar', [StudentEventController::class, 'destroy'])->name('kegiatan.destroy');
});
