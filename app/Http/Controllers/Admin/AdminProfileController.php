<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilDesa;
use App\Models\FasilitasPublik;
use App\Models\PotensiDesa;           // <-- tambahkan import model potensi
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends Controller
{
    /**
     * Halaman utama Profil & Data Pokok Desa
     * Menampilkan data profil, fasilitas, dan potensi dalam satu view bertab.
     */
    public function index()
    {
        $profil = ProfilDesa::first() ?? new ProfilDesa();
        $fasilitas = FasilitasPublik::latest()->get();
        $potensis = PotensiDesa::latest()->get();   // data potensi untuk tab 🌾

        return view('admin.profil.index', compact('profil', 'fasilitas', 'potensis'));
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


    // ####################################################################
    // ==================== BAGIAN POTENSI DESA ====================
    // ####################################################################

    /**
     * Menampilkan form untuk menambah potensi desa baru.
     */
    public function createPotensi()
    {
        return view('admin.potensi.create');
    }

    /**
     * Memvalidasi dan menyimpan data potensi desa baru ke database.
     */
    public function storePotensi(Request $request)
    {
        // Validasi input, memastikan 'judul' unik di tabel 'potensi_desa'
        $request->validate([
            'judul'             => 'required|string|max:255|unique:potensi_desa,judul',
            'gambar'            => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi_singkat' => 'required|string|max:500',
            'status_publikasi'  => 'required|in:publish,draft',
        ], [
            'judul.unique'      => 'Judul potensi ini sudah digunakan, silakan gunakan judul lain.'
        ]);

        // Menyimpan file gambar ke storage public
        $path = $request->file('gambar')->store('upload/images', 'public');
        
        $data = [
            'judul'             => $request->judul,
            'slug'              => Str::slug($request->judul),
            'gambar'            => $path,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'status_publikasi'  => $request->status_publikasi,
        ];

        // Eksekusi simpan ke database
        if (PotensiDesa::create($data)) {
            return redirect()->route('admin.profil.index')->with('success', 'Data potensi berhasil disimpan.');
        }

        return redirect()->back()->with('error', 'Gagal menyimpan data potensi.');
    }

    /**
     * Menampilkan form untuk mengedit data potensi desa berdasarkan ID.
     */
    public function editPotensi($id)
    {
        $potensi = PotensiDesa::findOrFail($id);
        return view('admin.potensi.edit', compact('potensi'));
    }

    /**
     * Memvalidasi dan memperbarui data potensi desa di database.
     */
    public function updatePotensi(Request $request, $id)
    {
        // Validasi input, pengecualian 'unique' untuk ID yang sedang diupdate agar tidak bentrok
        $request->validate([
            'judul'             => 'required|string|max:255|unique:potensi_desa,judul,' . $id,
            'gambar'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi_singkat' => 'required|string|max:500',
            'status_publikasi'  => 'required|in:publish,draft',
        ], [
            'judul.unique'      => 'Judul potensi ini sudah digunakan oleh data lain.'
        ]);

        $potensi = PotensiDesa::findOrFail($id);

        $dataUpdate = [
            'judul'             => $request->judul,
            'slug'              => Str::slug($request->judul),
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'status_publikasi'  => $request->status_publikasi,
        ];

        // Proses penggantian gambar jika user mengunggah file baru
        if ($request->hasFile('gambar')) {
            // Hapus file lama dari storage jika ada
            if ($potensi->gambar && Storage::disk('public')->exists($potensi->gambar)) {
                Storage::disk('public')->delete($potensi->gambar);
            }

            $path = $request->file('gambar')->store('upload/images', 'public');
            $dataUpdate['gambar'] = $path;
        }

        // Eksekusi pembaruan data ke database
        if ($potensi->update($dataUpdate)) {
            return redirect()->route('admin.profil.index')->with('success', 'Data potensi berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Gagal memperbarui data potensi.');
    }

    /**
     * Menghapus data potensi desa dari database beserta file gambar yang terkait.
     */
    public function destroyPotensi($id)
    {
        $potensi = PotensiDesa::findOrFail($id);

        // Hapus file gambar terkait dari storage
        if ($potensi->gambar && Storage::disk('public')->exists($potensi->gambar)) {
            Storage::disk('public')->delete($potensi->gambar);
        }

        // Eksekusi penghapusan record dari database
        if ($potensi->delete()) {
            return redirect()->route('admin.profil.index')->with('success', 'Data potensi berhasil dihapus.');
        }

        return redirect()->route('admin.profil.index')->with('error', 'Gagal menghapus data potensi.');
    }

}