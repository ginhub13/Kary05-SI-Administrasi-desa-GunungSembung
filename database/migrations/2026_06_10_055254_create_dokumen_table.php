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
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key ke tabel petugas sebagai audit trail (siapa yang mengunggah)
            $table->foreignId('petugas_id')->constrained('users')->onDelete('cascade');
            
            // Nama atau judul spesifik dokumen
            $table->string('judul_dokumen');
            
            // Kategori dokumen menggunakan ENUM agar data terstandarisasi
            $table->enum('kategori_dokumen', [
                'RPJMDes', 
                'RKPDes', 
                'APBDes', 
                'Realisasi', 
                'LPPD', 
                'LKPPD', 
                'ILPPD', 
                'LKPJ'
            ]);
            
            // Tahun dokumen (misal: "2024", "2025")
            $table->string('tahun', 4);
            
            // Path atau lokasi file PDF yang disimpan di storage server
            $table->string('file_path');
            
            // Ukuran file dalam Kilobyte (KB) untuk informasi di halaman publik
            // Menggunakan decimal dengan total 10 digit dan 2 digit di belakang koma
            $table->decimal('ukuran_file_kb', 10, 2);
            
            // Otomatis men-generate created_at dan updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen');
    }
};