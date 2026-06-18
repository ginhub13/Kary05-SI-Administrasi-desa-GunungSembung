<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminKabarBeritaController extends Controller
{
    /**
     * Menampilkan daftar berita dan pengumuman
     */
    public function index()
    {
        // Mengambil data berita, diurutkan dari yang terbaru
        $dataBerita = Berita::latest()->get();
        return view('admin.berita.index', compact('dataBerita'));
    }

    /**
     * Menampilkan formulir tambah artikel
     */
    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Memvalidasi dan menyimpan artikel baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'status_terbit' => 'required|in:Draft,Terbit',
            'gambar_sampul' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Maksimal 2MB
            'konten' => 'required|string',
        ], [
            'required' => ':attribute wajib diisi.',
            'image' => 'File sampul harus berupa gambar.',
            'mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // 1. Generate Slug Unik dari Judul
        $slug = Str::slug($request->judul);
        $originalSlug = $slug;
        $count = 1;
        // Cek apakah slug sudah ada di database, jika ada tambahkan angka di belakangnya
        while (Berita::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        // 2. Proses Upload Gambar Sampul (Jika Ada)
        $gambarPath = null;
        if ($request->hasFile('gambar_sampul')) {
            $gambarPath = $request->file('gambar_sampul')->store('gambar_berita', 'public');
        }

        // 3. Simpan ke Database
        Berita::create([
            'penulis_id' => Auth::id(), // Menyimpan ID petugas yang membuat
            'judul' => $request->judul,
            'slug' => $slug,
            'konten' => $request->konten,
            'kategori' => $request->kategori,
            'gambar_sampul_url' => $gambarPath,
            'status_terbit' => $request->status_terbit,
        ]);

        return redirect()->route('admin.berita.index')
                         ->with('success', 'Artikel berhasil diterbitkan.');
    }

    /**
     * Menampilkan formulir edit artikel
     */
    public function edit(string $id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    /**
     * Memvalidasi dan memperbarui artikel di database
     */
    public function update(Request $request, string $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'status_terbit' => 'required|in:Draft,Terbit',
            'gambar_sampul' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'konten' => 'required|string',
        ]);

        // 1. Cek dan Update Slug (Hanya jika judul berubah)
        $slug = $berita->slug;
        if ($request->judul !== $berita->judul) {
            $slug = Str::slug($request->judul);
            $originalSlug = $slug;
            $count = 1;
            while (Berita::where('slug', $slug)->where('id', '!=', $berita->id)->exists()) {
                $slug = "{$originalSlug}-{$count}";
                $count++;
            }
        }

        // 2. Proses Upload Gambar Sampul Baru (Jika Ada)
        $gambarPath = $berita->gambar_sampul_url;
        if ($request->hasFile('gambar_sampul')) {
            // Hapus gambar fisik lama dari server jika sebelumnya sudah ada
            if ($gambarPath && Storage::disk('public')->exists($gambarPath)) {
                Storage::disk('public')->delete($gambarPath);
            }
            
            // Simpan gambar fisik yang baru
            $gambarPath = $request->file('gambar_sampul')->store('gambar_berita', 'public');
        }

        // 3. Update Data di Database
        $berita->update([
            'penulis_id' => Auth::id(), // Memperbarui siapa yang terakhir mengedit
            'judul' => $request->judul,
            'slug' => $slug,
            'konten' => $request->konten,
            'kategori' => $request->kategori,
            'gambar_sampul_url' => $gambarPath,
            'status_terbit' => $request->status_terbit,
        ]);

        return redirect()->route('admin.berita.index')
                         ->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Menghapus artikel beserta gambar sampul fisiknya
     */
    public function destroy(string $id)
    {
        $berita = Berita::findOrFail($id);

        // Menghapus gambar fisik dari storage server jika ada
        if ($berita->gambar_sampul_url && Storage::disk('public')->exists($berita->gambar_sampul_url)) {
            Storage::disk('public')->delete($berita->gambar_sampul_url);
        }

        // Menghapus baris data dari database
        $berita->delete();

        return redirect()->route('admin.berita.index')
                         ->with('success', 'Artikel berhasil dihapus secara permanen.');
    }
}