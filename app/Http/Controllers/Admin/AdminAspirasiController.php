<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use Illuminate\Http\Request;


class AdminAspirasiController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        // 1. Inisialisasi Query Dasar
        $query = \App\Models\Aspirasi::latest();

        // 2. Filter Berdasarkan Kategori (Terapkan lebih dulu)
        if ($request->filled('kategori') && $request->kategori !== 'Semua') {
            $query->where('kategori', $request->kategori);
        }

        // 3. Filter Berdasarkan Status
        if ($request->filled('status') && $request->status !== 'Semua') {
            $query->where('status', $request->status);
        }

        // 4. Eksekusi Query Final
        $dataAspirasi = $query->get();
        
        // 5. Cek Parameter yang Sedang Aktif
        $statusAktif = $request->status ?? 'Semua';
        $kategoriAktif = $request->kategori ?? 'Semua';

        // 6. Daftar Kategori Statis (Sesuai form opsi yang dibuat sebelumnya)
        $listKategori = [
            'Infrastruktur & Fasilitas',
            'Pelayanan Administrasi',
            'Ketertiban & Keamanan',
            'Kesehatan & Lingkungan',
            'Bantuan Sosial',
            'Lainnya'
        ];

        // 7. Hitung Jumlah Lencana (Badge) yang merespon pada Kategori Aktif
        $baseCountQuery = \App\Models\Aspirasi::query();
        if ($kategoriAktif !== 'Semua') {
            $baseCountQuery->where('kategori', $kategoriAktif);
        }

        $countSemua = (clone $baseCountQuery)->count();
        $countMenunggu = (clone $baseCountQuery)->where('status', 'Menunggu')->count();
        $countDiproses = (clone $baseCountQuery)->where('status', 'Diproses')->count();
        $countSelesai = (clone $baseCountQuery)->where('status', 'Selesai')->count();
        $countDitolak = (clone $baseCountQuery)->where('status', 'Ditolak')->count();

        return view('admin.aspirasi.index', compact(
            'dataAspirasi', 'statusAktif', 'kategoriAktif', 'listKategori',
            'countSemua', 'countMenunggu', 'countDiproses', 'countSelesai', 'countDitolak'
        ));
    }

public function updateStatus(Request $request, $id)
{
    $aspirasi = Aspirasi::findOrFail($id);

    $request->validate([
        'status' => 'required|in:Menunggu,Diproses,Selesai,Ditolak'
    ]);

    $aspirasi->status = $request->status;
    $aspirasi->save();

    return redirect()->back()->with('success', 'Status berhasil diperbarui.');
}

    public function destroy($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
        
        // Hapus file foto jika ada
        if ($aspirasi->foto_lampiran && \Illuminate\Support\Facades\Storage::disk('public')->exists($aspirasi->foto_lampiran)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($aspirasi->foto_lampiran);
        }
        
        $aspirasi->delete();
        return redirect()->back()->with('success', 'Data aspirasi berhasil dihapus.');
    }
}