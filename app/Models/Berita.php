<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Berita extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit (karena tidak menggunakan plural bahasa Inggris)
    protected $table = 'berita';

    // Kolom yang diizinkan untuk diisi secara massal (Mass Assignment)
    protected $fillable = [
        'penulis_id',
        'judul',
        'slug',
        'konten',
        'kategori',
        'gambar_sampul_url',
        'status_terbit',
    ];

    /**
     * Relasi ke model Petugas
     * Satu berita ditulis oleh satu petugas (admin)
     */
    public function penulis(): BelongsTo
    {
        return $this->belongsTo(User::class, 'penulis_id');
    }

    /**
     * (Opsional) Scope untuk memfilter hanya berita yang berstatus 'Terbit'
     * Sangat berguna saat menampilkan data di halaman publik (pengunjung)
     * Cara panggil: Berita::terbit()->latest()->get();
     */
    public function scopeTerbit($query)
    {
        return $query->where('status_terbit', 'Terbit');
    }
}