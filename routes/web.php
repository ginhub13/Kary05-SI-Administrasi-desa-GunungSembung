<?php

use App\Http\Controllers\Admin\AdminAspirasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminPotensiController;
use App\Http\Controllers\Admin\AdminKabarBeritaController;
use App\Http\Controllers\Publik\PublikProfileController;
use App\Http\Controllers\Publik\HakMasyarakatController;
use App\Http\Controllers\Publik\PublikAspirasiController;
use App\Http\Controllers\Publik\PublikKontakController;
use App\Http\Controllers\Publik\PublikPotensiDesaController;
use App\Http\Controllers\Publik\PublikKabarBeritaController;

// ================= ROUTE PUBLIK (PENGUNJUNG) =================
Route::get('/', [PublikProfileController::class, 'index'])->name('profile');
Route::get('/profile', [PublikProfileController::class, 'profile'])->name('profile.detail');
Route::get('/potensi-desa', [PublikPotensiDesaController::class, 'potensiDesa'])->name('potensi-desa');
Route::get('/kontak', [PublikKontakController::class, 'kontak'])->name('kontak');


// Route Hak Masyarakat & Informasi Layanan (Pure Publikasi)
Route::get('/hak-masyarakat', [HakMasyarakatController::class, 'index'])->name('publik.hak-masyarakat');

// Route Aspirasi Masyarakat
Route::get('/aspirasi', [PublikAspirasiController::class, 'aspirasi'])->name('publik.aspirasi');
Route::post('/aspirasi', [PublikAspirasiController::class, 'kirimAspirasi'])->name('publik.aspirasi.kirim');

// Route Berita
Route::get('/berita', [PublikKabarBeritaController::class, 'indexBerita'])->name('publik.berita.index');
Route::get('/berita/{slug}', [PublikKabarBeritaController::class, 'showBerita'])->name('publik.berita.show');



// ================= ROUTE ADMIN (DASHBOARD) =================
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        
        // Route admin dasboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Route kelola potensi
        Route::resource('potensi', AdminPotensiController::class);

        // Kelola BeritadanPengumuman
        Route::resource('berita', AdminKabarBeritaController::class)->except(['show']);


        // Route Kelola Profil Desa & Fasilitas Publik
        Route::get('/profil-desa', [AdminProfileController::class, 'index'])->name('profil.index');
        Route::post('/profil-desa', [AdminProfileController::class, 'updateProfil'])->name('profil.update');
        Route::post('/fasilitas-publik', [AdminProfileController::class, 'storeFasilitas'])->name('fasilitas.store');
        Route::delete('/fasilitas-publik/{id}', [AdminProfileController::class, 'destroyFasilitas'])->name('fasilitas.destroy');

        // Route Kelola Aspirasi Masyarakat
        Route::get('/aspirasi', [AdminAspirasiController::class, 'index'])->name('aspirasi.index');
        Route::put('/aspirasi/{id}', [AdminAspirasiController::class, 'updateStatus'])->name('aspirasi.update');
        Route::delete('/aspirasi/{id}', [AdminAspirasiController::class, 'destroy'])->name('aspirasi.destroy');
    });
});
