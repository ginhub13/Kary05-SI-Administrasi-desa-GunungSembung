<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PotensiController;

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::prefix('potensi')->name('potensi.')->group(function () {

        Route::get('/', [PotensiController::class, 'index'])->name('index');
        Route::get('/create', [PotensiController::class, 'create'])->name('create');

    });

});