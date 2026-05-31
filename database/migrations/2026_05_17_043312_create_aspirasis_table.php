<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aspirasi', function (Blueprint $table) {
            $table->id();
            
            // Data Pelapor
            $table->string('nama_pengirim');
            $table->string('nik', 16);
            $table->string('no_hp', 15);

            // Detail Aspirasi
            $table->string('kategori'); // Infrastruktur, Pelayanan Publik, Keamanan, dll
            $table->string('judul');
            $table->text('pesan');
            $table->string('foto_lampiran')->nullable(); // Opsional jika warga ingin unggah bukti foto

            // Status & Tindak Lanjut Petugas
            $table->enum('status', ['Menunggu', 'Diproses', 'Selesai', 'Ditolak'])->default('Menunggu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aspirasi');
    }
};