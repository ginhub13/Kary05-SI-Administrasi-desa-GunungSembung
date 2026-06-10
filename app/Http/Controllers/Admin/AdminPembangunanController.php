<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KegiatanPembangunan;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminPembangunanController extends Controller
{
    /**
     * Skenario Index: Menampilkan daftar kegiatan pembangunan
     */
    public function index()
    {        
        // Mengambil dokumen pembangunan untuk ditampilkan di index 
        $dokumenPembangunan = Dokumen::whereIn('kategori_dokumen', ['RPJMDes', 'RKPDes'])->get();

        return view('admin.pembangunan.index', compact('dokumenPembangunan'));
    }

    /**
     * Skenario Unggah Dokumen: Menyimpan file PDF RPJMDes / RKPDes
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_dokumen' => 'required|string|max:255',
            'kategori_dokumen' => 'required|in:RPJMDes,RKPDes',
            'tahun' => 'required|string|size:4',
            'file_dokumen' => 'required|file|mimes:pdf|max:5120', // Maks 5MB, format PDF
        ], [
            'file_dokumen.mimes' => 'Dokumen wajib berformat PDF.',
            'file_dokumen.max' => 'Ukuran file maksimal 5MB.',
        ]);

        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            
            // Menyimpan file ke storage/app/public/dokumen_pembangunan
            $path = $file->store('dokumen_pembangunan', 'public');
            
            // Konversi byte ke KB
            $ukuranFileKb = $file->getSize() / 1024;

            Dokumen::create([
                'petugas_id' => Auth::id(),
                'judul_dokumen' => $request->judul_dokumen,
                'kategori_dokumen' => $request->kategori_dokumen,
                'tahun' => $request->tahun,
                'file_path' => $path,
                'ukuran_file_kb' => $ukuranFileKb,
            ]);

            return redirect()->route('admin.pembangunan.index')
                             ->with('success', 'Dokumen perencanaan berhasil diunggah.');
        }

        return back()->with('error', 'Gagal mengunggah dokumen.');
    }

    /**
     * Skenario Hapus Dokumen: Menghapus file PDF dari server dan data dari database
     */
    public function destroy(string $id)
    {
        $dokumen = Dokumen::findOrFail($id);
        
        // Hapus file fisik PDF dari storage (storage/app/public/...)
        if (Storage::disk('public')->exists($dokumen->file_path)) {
            Storage::disk('public')->delete($dokumen->file_path);
        }

        // Hapus data dari database
        $dokumen->delete();

        return back()->with('success', 'Dokumen ' . $dokumen->kategori_dokumen . ' berhasil dihapus dari sistem.');
    }
}