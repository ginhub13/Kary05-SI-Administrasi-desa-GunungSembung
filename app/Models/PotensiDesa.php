<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PotensiDesa extends Model
{
    use HasFactory;

    protected $table = 'potensi_desa';

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'gambar',
        'deskripsi_singkat',
        'deskripsi_lengkap',
        'harga',
        'kondisi',
        'status_stok',
        'pengelola',
        'nomor_wa',
        'status_publikasi',
    ];

    /**
     * Scope untuk hanya menampilkan data yang berstatus 'publish' di halaman pengunjung
     */
    public function scopePublished($query)
    {
        return $query->where('status_publikasi', 'publish');
    }

    public function getAllPotensiDesa()
    {
        return $this->published()->orderBy('created_at', 'desc')->get();
    }
}