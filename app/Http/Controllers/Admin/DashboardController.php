<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Aspirasi;
use App\Models\Dokumen;
use App\Models\ProfilDesa;


class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil statistik ringkas untuk kartu atas (Top Cards)
        $totalBerita = Berita::count();
        $aspirasiBaru = Aspirasi::where('status', 'Menunggu')->count();
        $totalDokumen = Dokumen::count();
        
        $profil = ProfilDesa::first();
        $totalPenduduk = $profil ? $profil->total_penduduk : 0;

        // Mengambil 5 aspirasi terbaru untuk ditampilkan di tabel cepat
        $aspirasiTerbaru = Aspirasi::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalBerita', 
            'aspirasiBaru', 
            'totalDokumen', 
            'totalPenduduk',
            'aspirasiTerbaru'
        ));
    }
}