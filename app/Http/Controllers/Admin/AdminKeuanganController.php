<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminKeuanganController extends Controller
{
    /**
     * Menampilkan daftar dokumen keuangan
     */
    public function index()
    {
        // Hanya mengambil dokumen dengan kategori keuangan
        $kategoriKeuangan = ['APBDes', 'Realisasi', 'LKPJ'];
        $dokumenKeuangan = Dokumen::whereIn('kategori_dokumen', $kategoriKeuangan)
                                  ->orderBy('tahun', 'desc')
                                  ->orderBy('created_at', 'desc')
                                  ->get();

        return view('admin.keuangan.index', compact('dokumenKeuangan'));
    }

    /**
     * Mengunggah dokumen keuangan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_dokumen' => 'required|string|max:255',
            'kategori_dokumen' => 'required|in:APBDes,Realisasi,LKPJ',
            'tahun' => 'required|string|size:4',
            'file_dokumen' => 'required|file|mimes:pdf|max:5120', // Maksimal 5MB
        ]);

        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            // Simpan ke storage/app/public/dokumen_keuangan
            $path = $file->store('dokumen_keuangan', 'public');
            $ukuranFileKb = round($file->getSize() / 1024); // Konversi ke KB

            Dokumen::create([
                'petugas_id' => Auth::id(),
                'judul_dokumen' => $request->judul_dokumen,
                'kategori_dokumen' => $request->kategori_dokumen,
                'tahun' => $request->tahun,
                'file_path' => $path,
                'ukuran_file_kb' => $ukuranFileKb,
            ]);

            return redirect()->route('admin.keuangan.index')->with('success', 'Dokumen laporan keuangan berhasil diunggah.');
        }

        return back()->with('error', 'Gagal mengunggah dokumen. Pastikan file valid.');
    }

    /**
     * Menghapus dokumen keuangan
     */
    public function destroy(string $id)
    {
        $dokumen = Dokumen::findOrFail($id);
        
        // Hapus file fisik dari server
        if (Storage::disk('public')->exists($dokumen->file_path)) {
            Storage::disk('public')->delete($dokumen->file_path);
        }

        // Hapus data dari database
        $dokumen->delete();
        
        return back()->with('success', 'Dokumen ' . $dokumen->kategori_dokumen . ' berhasil dihapus.');
    }
}