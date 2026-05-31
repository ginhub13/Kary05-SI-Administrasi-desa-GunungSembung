<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasPublik extends Model
{
    use HasFactory;

    protected $table = 'fasilitas_publik';

    protected $fillable = ['nama_fasilitas', 'lokasi', 'deskripsi'];
}