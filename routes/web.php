<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PotensiController;
use App\Http\Controllers\AuthController;

Route::get('/', [ProfileController::class, 'index'])->name('profile');
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.detail');
Route::get('/potensi-desa', [ProfileController::class, 'potensiDesa'])->name('potensi-desa');
Route::get('/potensi/{slug}', [ProfileController::class, 'showPotensi'])->name('potensi.show');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::group(['prefix' => 'potensi', 'as' => 'potensi.'], function () {
            Route::get('/', [PotensiController::class, 'index'])->name('index');
            Route::get('/create', [PotensiController::class, 'create'])->name('create');
            Route::post('/', [PotensiController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [PotensiController::class, 'edit'])->name('edit');
            Route::put('/{id}', [PotensiController::class, 'update'])->name('update');
            Route::delete('/{id}', [PotensiController::class, 'destroy'])->name('destroy');
        });
    });
});