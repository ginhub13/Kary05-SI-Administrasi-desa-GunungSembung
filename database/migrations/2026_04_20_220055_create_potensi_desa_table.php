<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('potensi_desa', function (Blueprint $table) {
            $table->id();

            // Info Dasar
            $table->string('judul'); // Cth: Beras Premium Pagaden
            $table->string('slug')->unique(); // Cth: beras-premium-pagaden (untuk URL SEO Friendly)
            $table->string('kategori'); // Cth: Pertanian Pangan, UMKM Kriya
            $table->string('gambar')->nullable(); // Path/URL gambar utama

            // Konten
            $table->text('deskripsi_singkat'); // Muncul di Card halaman utama (max 150-200 karakter)
            $table->longText('deskripsi_lengkap'); // Muncul di halaman Detail Potensi

            // Info Sidebar / Pemesanan (Sesuai desain halaman Detail)
            $table->string('harga')->nullable(); // Cth: "Rp 65.000 / 250 gram" atau biarkan kosong jika bukan barang jualan
            $table->string('kondisi')->nullable(); // Cth: "Biji Roasting", "Baru", "Fresh"
            $table->string('status_stok')->nullable(); // Cth: "Tersedia", "Pre-Order"
            $table->string('pengelola')->nullable(); // Cth: "Kelompok Tani Mekar Jaya"
            $table->string('nomor_wa')->nullable(); // Cth: "628123456789" untuk tombol WhatsApp

            // Status Tayang
            $table->enum('status_publikasi', ['draft', 'publish'])->default('publish');

            $table->timestamps(); // created_at & updated_at otomatis
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('potensi_desa');
    }
};
