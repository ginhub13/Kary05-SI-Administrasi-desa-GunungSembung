<?php

namespace App\Http\Controllers\Publik;
use App\Http\Controllers\Controller;
use App\Models\Dokumen;


class PublikPemerintahController extends Controller
{

    public function indexPemerintahan()
    {
    $kategoriPemerintahan = ['LPPD', 'LKPPD', 'ILPPD'];
    $dokumenPemerintahan = Dokumen::whereIn('kategori_dokumen', $kategoriPemerintahan)
                                  ->orderBy('tahun', 'desc')
                                  ->orderBy('created_at', 'desc')
                                  ->get();
    
    return view('publik.pemerintahan.index', compact('dokumenPemerintahan'));
    }
}


