<?php

use App\Http\Controllers\Kehadiran\AttendanceController;
use App\Http\Controllers\Kehadiran\ReportController;
use Illuminate\Support\Facades\Route;

// File ini memuat route per modul.
require __DIR__ . '/kegiatan.php';
require __DIR__ . '/peserta.php';
require __DIR__ . '/pendaftaran.php';
require __DIR__ . '/kehadiran.php';

Route::prefix('admin')->name('kehadiran.')->group(function () {
    Route::get('/kehadiran', [AttendanceController::class, 'daftarKegiatan'])->name('kegiatan');
    Route::get('/kehadiran/{event}', [AttendanceController::class, 'daftarPeserta'])->name('peserta');
    Route::post('/kehadiran/{registration}', [AttendanceController::class, 'simpan'])->name('simpan');
    Route::get('/laporan', [ReportController::class, 'tampilkan'])->name('laporan');
});
