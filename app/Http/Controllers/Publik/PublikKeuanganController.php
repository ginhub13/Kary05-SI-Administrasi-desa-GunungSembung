<?php

namespace App\Http\Controllers\Publik;
use App\Http\Controllers\Controller;
use App\Models\Dokumen;


class PublikKeuanganController extends Controller
{

    public function indexKeuangan()
        {
            // Kategori dokumen untuk halaman keuangan
            $kategoriKeuangan = ['APBDes', 'Realisasi', 'LKPJ'];
            
            $dokumenKeuangan = Dokumen::whereIn('kategori_dokumen', $kategoriKeuangan)
                                      ->orderBy('tahun', 'desc')
                                      ->orderBy('created_at', 'desc')
                                      ->get();
    
            return view('publik.keuangan.index', compact('dokumenKeuangan'));
        }
}

