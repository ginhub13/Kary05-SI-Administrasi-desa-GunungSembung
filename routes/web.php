<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PotensiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HakMasyarakatController;

// ================= ROUTE PUBLIK (PENGUNJUNG) =================
Route::get('/', [ProfileController::class, 'index'])->name('profile');
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.detail');
Route::get('/potensi-desa', [ProfileController::class, 'potensiDesa'])->name('potensi-desa');
Route::get('/potensi/{slug}', [ProfileController::class, 'showPotensi'])->name('potensi.show');
Route::get('/kontak', [ProfileController::class, 'kontak'])->name('kontak');


// Route Hak Masyarakat & Informasi Layanan (Pure Publikasi)
Route::get('/hak-masyarakat', [HakMasyarakatController::class, 'index'])->name('publik.hak-masyarakat');

// Route Aspirasi Masyarakat
Route::get('/aspirasi', [App\Http\Controllers\ProfileController::class, 'aspirasi'])->name('publik.aspirasi');
Route::post('/aspirasi', [App\Http\Controllers\ProfileController::class, 'kirimAspirasi'])->name('publik.aspirasi.kirim');


// ================= ROUTE ADMIN (DASHBOARD) =================
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
        // Route Kelola Profil Desa & Fasilitas Publik
        Route::get('/profil-desa', [App\Http\Controllers\ProfilDesaController::class, 'index'])->name('profil.index');
        Route::post('/profil-desa', [App\Http\Controllers\ProfilDesaController::class, 'updateProfil'])->name('profil.update');
        Route::post('/fasilitas-publik', [App\Http\Controllers\ProfilDesaController::class, 'storeFasilitas'])->name('fasilitas.store');
        Route::delete('/fasilitas-publik/{id}', [App\Http\Controllers\ProfilDesaController::class, 'destroyFasilitas'])->name('fasilitas.destroy');

        // Route Kelola Aspirasi Masyarakat
        Route::get('/aspirasi', [App\Http\Controllers\AspirasiController::class, 'index'])->name('aspirasi.index');
        Route::put('/aspirasi/{id}', [App\Http\Controllers\AspirasiController::class, 'updateStatus'])->name('aspirasi.update');
        Route::delete('/aspirasi/{id}', [App\Http\Controllers\AspirasiController::class, 'destroy'])->name('aspirasi.destroy');   


    });
});
