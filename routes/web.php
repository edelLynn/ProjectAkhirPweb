<?php

use App\Http\Controllers\Kehadiran\AttendanceController;
use App\Http\Controllers\Kehadiran\ReportController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('kehadiran.')->group(function () {
        Route::get('/kehadiran', [AttendanceController::class, 'daftarKegiatan'])
            ->name('kegiatan');

        Route::get('/kehadiran/{event}', [AttendanceController::class, 'daftarPeserta'])
            ->name('peserta');

        Route::post('/kehadiran/{registration}', [AttendanceController::class, 'simpan'])
            ->name('simpan');

        Route::get('/laporan', [ReportController::class, 'tampilkan'])
            ->name('laporan');
    });