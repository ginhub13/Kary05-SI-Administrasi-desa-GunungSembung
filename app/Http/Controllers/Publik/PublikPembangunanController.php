<?php

namespace App\Http\Controllers\Publik;
use App\Http\Controllers\Controller;
use App\Models\Dokumen;


class PublikPembangunanController extends Controller
{
    public function indexPembangunan()
        {
            // Mengambil dokumen khusus perencanaan pembangunan
            $kategoriDokumen = ['RPJMDes', 'RKPDes'];
            $dokumenPembangunan = Dokumen::whereIn('kategori_dokumen', $kategoriDokumen)
                                        ->latest()
                                        ->get();
            return view('publik.pembangunan.index', compact('dokumenPembangunan'));
        }
}
