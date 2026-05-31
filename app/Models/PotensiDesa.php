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
        'gambar',
        'deskripsi_singkat',
        'status_publikasi', // Ditambahkan kembali
    ];

    public function getAllPotensiDesa()
    {
        return $this->orderBy('created_at', 'desc')->get();
    }
}