<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dokumen extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table = 'dokumen';

    // Kolom yang diizinkan untuk diisi secara massal (Mass Assignment)
    protected $fillable = [
        'petugas_id',
        'judul_dokumen',
        'kategori_dokumen',
        'tahun',
        'file_path',
        'ukuran_file_kb',
    ];

    // Konversi (casting) tipe data saat ditarik dari database
    protected $casts = [
        'ukuran_file_kb' => 'decimal:2',
    ];

    /**
     * Relasi ke model Petugas
     * Satu dokumen diunggah oleh satu petugas
     */
    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}