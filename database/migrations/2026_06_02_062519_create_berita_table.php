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
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key ke tabel petugas (penulis artikel)
            $table->foreignId('penulis_id')->constrained('users')->onDelete('cascade');
            
            // Judul artikel
            $table->string('judul');
            
            // Slug untuk URL SEO-friendly, sifatnya harus unik
            $table->string('slug')->unique();
            
            // Isi artikel, menggunakan tipe data 'text' atau 'longText' karena bisa sangat panjang (format HTML)
            $table->longText('konten');
            
            // Kategori berita/pengumuman
            $table->string('kategori');
            
            // Path gambar sampul, bersifat nullable karena gambar bersifat opsional
            $table->string('gambar_sampul_url')->nullable();
            
            // Status publikasi
            $table->enum('status_terbit', ['Draft', 'Terbit'])->default('Draft');
            
            // Otomatis men-generate created_at dan updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};