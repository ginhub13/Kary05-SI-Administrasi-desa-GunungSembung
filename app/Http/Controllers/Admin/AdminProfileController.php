<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilDesa;
use App\Models\FasilitasPublik;
use App\Models\PotensiDesa;
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
        $potensis = PotensiDesa::latest()->get();

        return view('admin.profil.index', compact('profil', 'fasilitas', 'potensis'));
    }

    /**
     * Memperbarui Data Profil Desa (Dinamis Berdasarkan ID Form)
     */
    public function updateProfil(Request $request)
    {
        $formId = $request->input('form_id');

        if (!in_array($formId, ['demografi', 'sejarah', 'aparatur'])) {
            return redirect()->back()->with('error', 'Form tidak valid.');
        }

        $profil = ProfilDesa::first() ?? new ProfilDesa();

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

        $validated = $request->validate($rules);

        if ($formId === 'demografi') {
            $validated['total_penduduk'] = $validated['penduduk_laki_laki'] + $validated['penduduk_perempuan'];
        }

        $profil->fill($validated);
        $profil->save();

        $activeTab = $formId; // demografi, sejarah, atau aparatur

        return redirect()->back()
            ->with('success', 'Data ' . ucfirst($formId) . ' berhasil diperbarui!')
            ->with('active_tab', $activeTab);
    }

    /**
     * Menambahkan Item Fasilitas Publik Baru
     */
    public function storeFasilitas(Request $request)
    {
        $validated = $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'lokasi'         => 'required|string|max:255',
            'deskripsi'      => 'required|string',
        ]);

        FasilitasPublik::create($validated);
        return redirect()->route('admin.profil.index')
            ->with('success', 'Fasilitas publik berhasil ditambahkan.')
            ->with('active_tab', 'fasilitas');
    }

    /**
     * Menampilkan form untuk mengedit data fasilitas publik. (tidak digunakan dengan modal)
     */
    public function editFasilitas($id)
    {
        $fasilitas = FasilitasPublik::findOrFail($id);
        return view('admin.fasilitas.edit', compact('fasilitas'));
    }

    /**
     * Memvalidasi dan memperbarui data fasilitas publik di database.
     */
    public function updateFasilitas(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'lokasi'         => 'required|string|max:255',
            'deskripsi'      => 'required|string',
        ], [
            'required' => ':attribute wajib diisi.',
        ]);

        $fasilitas = FasilitasPublik::findOrFail($id);

        try {
            $fasilitas->update($validated);
            return redirect()->route('admin.profil.index')
                ->with('success', 'Fasilitas publik berhasil diperbarui.')
                ->with('active_tab', 'fasilitas');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus item fasilitas publik dari database.
     */
    public function destroyFasilitas($id)
    {
        $fasilitas = FasilitasPublik::findOrFail($id);

        try {
            $fasilitas->delete();
            return redirect()->back()
                ->with('success', 'Fasilitas publik berhasil dihapus.')
                ->with('active_tab', 'fasilitas');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus fasilitas: ' . $e->getMessage());
        }
    }

    // ==================== BAGIAN POTENSI DESA ====================

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
        $request->validate([
            'judul'             => 'required|string|max:255|unique:potensi_desa,judul',
            'gambar'            => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi_singkat' => 'required|string|max:500',
            'status_publikasi'  => 'required|in:publish,draft',
        ], [
            'judul.unique' => 'Judul potensi ini sudah digunakan, silakan gunakan judul lain.'
        ]);

        $path = $request->file('gambar')->store('upload/images', 'public');

        $data = [
            'judul'             => $request->judul,
            'slug'              => Str::slug($request->judul),
            'gambar'            => $path,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'status_publikasi'  => $request->status_publikasi,
        ];

        if (PotensiDesa::create($data)) {
            return redirect()->route('admin.profil.index')
                ->with('success', 'Data potensi berhasil disimpan.')
                ->with('active_tab', 'potensi');
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
        $request->validate([
            'judul'             => 'required|string|max:255|unique:potensi_desa,judul,' . $id,
            'gambar'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi_singkat' => 'required|string|max:500',
            'status_publikasi'  => 'required|in:publish,draft',
        ], [
            'judul.unique' => 'Judul potensi ini sudah digunakan oleh data lain.'
        ]);

        $potensi = PotensiDesa::findOrFail($id);

        $dataUpdate = [
            'judul'             => $request->judul,
            'slug'              => Str::slug($request->judul),
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'status_publikasi'  => $request->status_publikasi,
        ];

        if ($request->hasFile('gambar')) {
            if ($potensi->gambar && Storage::disk('public')->exists($potensi->gambar)) {
                Storage::disk('public')->delete($potensi->gambar);
            }
            $path = $request->file('gambar')->store('upload/images', 'public');
            $dataUpdate['gambar'] = $path;
        }

        if ($potensi->update($dataUpdate)) {
            return redirect()->route('admin.profil.index')
                ->with('success', 'Data potensi berhasil diperbarui.')
                ->with('active_tab', 'potensi');
        }

        return redirect()->back()->with('error', 'Gagal memperbarui data potensi.');
    }

    /**
     * Menghapus data potensi desa dari database beserta file gambar yang terkait.
     */
    public function destroyPotensi($id)
    {
        $potensi = PotensiDesa::findOrFail($id);

        if ($potensi->gambar && Storage::disk('public')->exists($potensi->gambar)) {
            Storage::disk('public')->delete($potensi->gambar);
        }

        if ($potensi->delete()) {
            return redirect()->route('admin.profil.index')
                ->with('success', 'Data potensi berhasil dihapus.')
                ->with('active_tab', 'potensi');
        }

        return redirect()->route('admin.profil.index')
            ->with('error', 'Gagal menghapus data potensi.');
    }
}