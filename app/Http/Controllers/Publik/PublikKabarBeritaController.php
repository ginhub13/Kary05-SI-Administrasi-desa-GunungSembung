<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Models\Berita;

class PublikKabarBeritaController extends Controller
{
    /**
     * Menampilkan Halaman Daftar Berita
     */
    public function indexBerita()
    {
        $dataBerita = Berita::terbit()
                            ->latest()
                            ->paginate(9);

        return view('publik.berita.index', compact('dataBerita'));
    }

    /**
     * Menampilkan Halaman Detail Berita
     */
    public function showBerita($slug)
    {
        $berita = Berita::terbit()->where('slug', $slug)->firstOrFail();

        $beritaLainnya = Berita::terbit()
                                ->where('id', '!=', $berita->id)
                                ->latest()
                                ->take(4)
                                ->get();

        return view('publik.berita.show', compact('berita', 'beritaLainnya'));
    }
}