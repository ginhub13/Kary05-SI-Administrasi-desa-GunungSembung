<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    use HasFactory;

    protected $table = 'profil_desa';

    // PASTIKAN SEMUA FIELD INI ADA DI SINI
    protected $fillable = [
        'total_penduduk', 
        'luas_wilayah', 
        'jumlah_rt', 
        'jumlah_rw', 
        'jumlah_dusun',
        'total_kk', 
        'penduduk_laki_laki', 
        'penduduk_perempuan',
        'luas_pemukiman', 
        'luas_persawahan', 
        'luas_perkebunan',
        'deskripsi_demografi', 
        'deskripsi_fasilitas', 
        'sejarah_desa',
        'peta_embed',
        'batas_utara', 
        'batas_selatan', 
        'batas_timur', 
        'batas_barat',
        'nama_kades', 
        'bio_kades', 
        'nama_camat', 
        'bio_camat'
    ];
}