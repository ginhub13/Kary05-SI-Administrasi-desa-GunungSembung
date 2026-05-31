<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProfilDesa;
use App\Models\Dokumen;
use App\Models\FasilitasPublik;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProfilDesaController extends Controller
{
    public function index()
    {
        $profil = ProfilDesa::first() ?? new ProfilDesa();
        $fasilitas = FasilitasPublik::latest()->get();


        return view('admin.profil.index', compact('profil', 'fasilitas'));
    }

    /**
     * Memperbarui Data Profil Desa (Dinamis Berdasarkan ID Form)
     */
    public function updateProfil(Request $request)
    {
        $formId = $request->input('form_id');
        
        // 1. Cek validitas form_id di awal untuk mencegah form tidak dikenali
        if (!in_array($formId, ['demografi', 'sejarah', 'aparatur', 'peta'])) {
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem, form tidak valid.');
        }

        // 2. Ambil data profil hanya 1 kali di sini
        $profil = ProfilDesa::first() ?? new ProfilDesa();

        // 4. JIKA FORM LAINNYA (Demografi, Sejarah, Aparatur) - Satukan Aturan Validasi ke $rules
        $rules = [];
        if ($formId === 'demografi') {
            $rules = [
                'luas_wilayah' => 'required|numeric|min:0',
                'jumlah_rt' => 'required|integer|min:0',
                'jumlah_rw' => 'required|integer|min:0',
                'jumlah_dusun' => 'required|integer|min:0',
                'total_kk' => 'required|integer|min:0',
                'penduduk_laki_laki' => 'required|integer|min:0',
                'penduduk_perempuan' => 'required|integer|min:0',
                'luas_pemukiman' => 'required|numeric|min:0',
                'luas_persawahan' => 'required|numeric|min:0',
                'luas_perkebunan' => 'required|numeric|min:0',
                'deskripsi_demografi' => 'nullable|string',
            ];
        } elseif ($formId === 'sejarah') {
            $rules = [
                'batas_utara' => 'nullable|string|max:255',
                'batas_selatan' => 'nullable|string|max:255',
                'batas_timur' => 'nullable|string|max:255',
                'batas_barat' => 'nullable|string|max:255',
                'sejarah_desa' => 'nullable|string',
            ];
        } elseif ($formId === 'aparatur') {
            $rules = [
                'nama_kades' => 'nullable|string|max:255',
                'bio_kades' => 'nullable|string',
                'nama_camat' => 'nullable|string|max:255',
                'bio_camat' => 'nullable|string',
            ];
        }

        // Eksekusi validasi secara terpusat
        $validated = $request->validate($rules);

        // Jika yang disubmit adalah demografi, tambahkan hitungan total_penduduk ke array $validated
        if ($formId === 'demografi') {
            $validated['total_penduduk'] = $validated['penduduk_laki_laki'] + $validated['penduduk_perempuan'];
        }

        // Tulis data ke database
        $profil->fill($validated);
        $profil->save();

        return redirect()->back()->with('success', 'Data ' . ucfirst($formId) . ' berhasil diperbarui!');
    }

    /**
     * Menambahkan Item Fasilitas Publik Baru
     */
    public function storeFasilitas(Request $request)
    {
        $validated = $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        FasilitasPublik::create($validated);
        return redirect()->back()->with('success', 'Fasilitas publik berhasil ditambahkan.');
    }

    /**
     * Hapus Item Fasilitas Publik
     */
    public function destroyFasilitas($id)
    {
        $f = FasilitasPublik::findOrFail($id);
        $f->delete();

        return redirect()->back()->with('success', 'Fasilitas publik berhasil dihapus.');
    }
}