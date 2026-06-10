<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAspirasiController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminKabarBeritaController;
use App\Http\Controllers\Admin\AdminKeuanganController;
use App\Http\Controllers\Admin\AdminPembangunanController;
use App\Http\Controllers\Admin\AdminPemerintahanController;
use App\Http\Controllers\Publik\PublikProfileController;
use App\Http\Controllers\Publik\HakMasyarakatController;
use App\Http\Controllers\Publik\PublikAspirasiController;
use App\Http\Controllers\Publik\PublikKontakController;
use App\Http\Controllers\Publik\PublikKabarBeritaController;
use App\Http\Controllers\Publik\PublikKeuanganController;
use App\Http\Controllers\Publik\PublikPembangunanController;
use App\Http\Controllers\Publik\PublikPemerintahController;

// ================= ROUTE PUBLIK (PENGUNJUNG) =================
// route beranda
Route::get('/', [PublikProfileController::class, 'index'])->name('profile');

// route untuk higlight potensi desa yang tampil di beranda
Route::get('/potensi-desa', [PublikProfileController::class, 'potensiDesa'])->name('potensi-desa');

// route profile
Route::get('/profile', [PublikProfileController::class, 'profile'])->name('profile.detail');

// route halaman kontak
Route::get('/kontak', [PublikKontakController::class, 'kontak'])->name('kontak');


// Route Hak Masyarakat & Informasi Layanan (Pure Publikasi)
Route::get('/hak-masyarakat', [HakMasyarakatController::class, 'index'])->name('publik.hak-masyarakat');

// Route Aspirasi Masyarakat
Route::get('/aspirasi', [PublikAspirasiController::class, 'aspirasi'])->name('publik.aspirasi');
Route::post('/aspirasi', [PublikAspirasiController::class, 'kirimAspirasi'])->name('publik.aspirasi.kirim');

// Route Berita
Route::get('/berita', [PublikKabarBeritaController::class, 'indexBerita'])->name('publik.berita.index');
Route::get('/berita/{slug}', [PublikKabarBeritaController::class, 'showBerita'])->name('publik.berita.show');

// Route Pembangunan (Publik)
Route::get('/publik-pembangunan', [PublikPembangunanController::class, 'indexPembangunan'])->name('publik.pembangunan.index');

// Route Keuangan (Publik)
Route::get('/publik-keuangan', [PublikKeuanganController::class, 'indexKeuangan'])->name('publik.keuangan.index');

// Route Dokumen Pemerintahan (Publik)
Route::get('/publik-pemerintahan', [PublikPemerintahController::class, 'indexPemerintahan'])->name('publik.pemerintahan.index');




// ================= ROUTE ADMIN (DASHBOARD) =================
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

        Route::middleware(['auth'])->group(function () {
            // Logout hanya untuk user yang sudah login
            Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

            Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        
            // Dashboard
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

            // Potensi Desa (CRUD manual via AdminProfileController)
            Route::prefix('potensi')->name('potensi.')->group(function () {
                Route::get('/create', [AdminProfileController::class, 'createPotensi'])->name('create');
                Route::post('/', [AdminProfileController::class, 'storePotensi'])->name('store');
                Route::get('/{id}/edit', [AdminProfileController::class, 'editPotensi'])->name('edit');
                Route::put('/{id}', [AdminProfileController::class, 'updatePotensi'])->name('update');
                Route::delete('/{id}', [AdminProfileController::class, 'destroyPotensi'])->name('destroy');
            });

            // Berita (Resource)
            Route::resource('berita', AdminKabarBeritaController::class);

            // Profil Desa & Fasilitas Publik
            Route::get('/profil-desa', [AdminProfileController::class, 'index'])->name('profil.index');
            Route::post('/profil-desa', [AdminProfileController::class, 'updateProfil'])->name('profil.update');
            Route::post('/fasilitas-publik', [AdminProfileController::class, 'storeFasilitas'])->name('fasilitas.store');
            Route::put('/fasilitas-publik/{id}', [AdminProfileController::class, 'updateFasilitas'])->name('fasilitas.update');
            Route::delete('/fasilitas-publik/{id}', [AdminProfileController::class, 'destroyFasilitas'])->name('fasilitas.destroy');

            // Route Kelola Aspirasi Masyarakat
            Route::get('/aspirasi', [AdminAspirasiController::class, 'index'])->name('aspirasi.index');
            Route::put('/aspirasi/{id}', [AdminAspirasiController::class, 'updateStatus'])->name('aspirasi.update');
            Route::delete('/aspirasi/{id}', [AdminAspirasiController::class, 'destroy'])->name('aspirasi.destroy');
            
            // Route kelola laporan keuangan
            Route::resource('keuangan',AdminKeuanganController::class);

            // Route kelola laporan pemerintah
            Route::resource('pemerintahan',AdminPemerintahanController::class);

            // route kelola laporan pembangunan
            Route::resource('pembangunan', AdminPembangunanController::class);
            });
        });
