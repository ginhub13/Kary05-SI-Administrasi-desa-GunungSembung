<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_desa', function (Blueprint $table) {
            $table->id();
            
            // 1. Statistik Kependudukan Utama (Top Cards)
            $table->integer('total_penduduk')->default(0);
            $table->decimal('luas_wilayah', 10, 2)->default(0);
            $table->integer('jumlah_rt')->default(0);
            $table->integer('jumlah_rw')->default(0);
            $table->integer('jumlah_dusun')->default(0);
            $table->integer('total_kk')->default(0);
            $table->integer('penduduk_laki_laki')->default(0);
            $table->integer('penduduk_perempuan')->default(0);

            // 2. Alokasi Pemanfaatan Lahan (Hektar)
            $table->decimal('luas_pemukiman', 10, 2)->default(0);
            $table->decimal('luas_persawahan', 10, 2)->default(0);
            $table->decimal('luas_perkebunan', 10, 2)->default(0);

            // 3. Teks Informasi & Sejarah
            $table->text('deskripsi_demografi')->nullable();
            $table->text('deskripsi_fasilitas')->nullable();
            $table->longText('sejarah_desa')->nullable();

            // 4. Batas Wilayah Geografis
            $table->string('batas_utara')->nullable();
            $table->string('batas_selatan')->nullable();
            $table->string('batas_timur')->nullable();
            $table->string('batas_barat')->nullable();

            // 5. Struktur Pemerintahan (Kades & Camat)
            $table->string('nama_kades')->nullable();
            $table->text('bio_kades')->nullable();
            $table->string('nama_camat')->nullable();
            $table->text('bio_camat')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_desa');
    }
};