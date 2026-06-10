<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminPemerintahanController extends Controller
{
    /**
     * Menampilkan daftar dokumen Laporan Pemerintahan
     */
    public function index()
    {
        $kategoriPemerintahan = ['LPPD', 'LKPPD', 'ILPPD'];
        $dokumenPemerintahan = Dokumen::whereIn('kategori_dokumen', $kategoriPemerintahan)
                                      ->orderBy('tahun', 'desc')
                                      ->orderBy('created_at', 'desc')
                                      ->get();

        return view('admin.pemerintahan.index', compact('dokumenPemerintahan'));
    }

    /**
     * Mengunggah dokumen Laporan Pemerintahan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_dokumen' => 'required|string|max:255',
            'kategori_dokumen' => 'required|in:LPPD,LKPPD,ILPPD',
            'tahun' => 'required|string|size:4',
            'file_dokumen' => 'required|file|mimes:pdf|max:5120', // Maks 5MB
        ]);

        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            $path = $file->store('dokumen_pemerintahan', 'public');
            $ukuranFileKb = round($file->getSize() / 1024);

            Dokumen::create([
                'petugas_id' => Auth::id(),
                'judul_dokumen' => $request->judul_dokumen,
                'kategori_dokumen' => $request->kategori_dokumen,
                'tahun' => $request->tahun,
                'file_path' => $path,
                'ukuran_file_kb' => $ukuranFileKb,
            ]);

            return redirect()->route('admin.pemerintahan.index')->with('success', 'Dokumen laporan pemerintahan berhasil diunggah.');
        }

        return back()->with('error', 'Gagal mengunggah dokumen.');
    }

    /**
     * Menghapus dokumen
     */
    public function destroy(string $id)
    {
        $dokumen = Dokumen::findOrFail($id);
        
        if (Storage::disk('public')->exists($dokumen->file_path)) {
            Storage::disk('public')->delete($dokumen->file_path);
        }

        $dokumen->delete();
        return back()->with('success', 'Dokumen ' . $dokumen->kategori_dokumen . ' berhasil dihapus.');
    }
}