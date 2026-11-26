<?php

use App\Http\Controllers\Kegiatan\CategoryController;
use App\Http\Controllers\Kegiatan\EventController;
use Illuminate\Support\Facades\Route;

//baru
Route::middleware(['auth', 'role:admin'])->group(function () {
    //baru
    Route::resource('kegiatan', EventController::class)
        ->parameters(['kegiatan' => 'event'])
        ->except('show');
    //baru
    Route::resource('kategori', CategoryController::class)
        ->parameters(['kategori' => 'category'])
        ->except('show');
});
