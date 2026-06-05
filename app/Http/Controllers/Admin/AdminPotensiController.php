<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\PotensiDesa;

class AdminPotensiController extends Controller
{
    /**
     * @var PotensiDesa
     */
    protected $modelPotensi;

    /**
     * Inisialisasi instance PotensiDesa.
     */
    public function __construct()
    {
        $this->modelPotensi = new PotensiDesa();
    }

    /**
     * Menampilkan daftar semua potensi desa.
     */
    public function index()
    {
        $data = $this->modelPotensi->getAllPotensiDesa();
        return view('admin.potensi.index', compact('data'));
    }

    /**
     * Menampilkan form untuk menambah potensi desa baru.
     */
    public function create()
    {
        return view('admin.potensi.create');
    }

    /**
     * Memvalidasi dan menyimpan data potensi desa baru ke database.
     */
    public function store(Request $request)
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
        if ($this->modelPotensi->create($data)) {
            return redirect()->route('admin.potensi.index')->with('success', 'Data potensi berhasil disimpan.');
        }

        return redirect()->back()->with('error', 'Gagal menyimpan data potensi.');
    }

    /**
     * Menampilkan form untuk mengedit data potensi desa berdasarkan ID.
     */
    public function edit($id)
    {
        $potensi = $this->modelPotensi->findOrFail($id);
        return view('admin.potensi.edit', compact('potensi'));
    }

    /**
     * Memvalidasi dan memperbarui data potensi desa di database.
     */
    public function update(Request $request, $id)
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

        $potensi = $this->modelPotensi->findOrFail($id);

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
            return redirect()->route('admin.potensi.index')->with('success', 'Data potensi berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Gagal memperbarui data potensi.');
    }

    /**
     * Menghapus data potensi desa dari database beserta file gambar yang terkait.
     */
    public function destroy($id)
    {
        $potensi = $this->modelPotensi->findOrFail($id);

        // Hapus file gambar terkait dari storage
        if ($potensi->gambar && Storage::disk('public')->exists($potensi->gambar)) {
            Storage::disk('public')->delete($potensi->gambar);
        }

        // Eksekusi penghapusan record dari database
        if ($potensi->delete()) {
            return redirect()->route('admin.potensi.index')->with('success', 'Data potensi berhasil dihapus.');
        }

        return redirect()->route('admin.potensi.index')->with('error', 'Gagal menghapus data potensi.');
    }
}