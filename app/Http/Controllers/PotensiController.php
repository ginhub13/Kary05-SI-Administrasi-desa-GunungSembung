<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\PotensiDesa;

class PotensiController extends Controller
{
    protected $modelPotensi;

    public function __construct()
    {
        $this->modelPotensi = new PotensiDesa();
    }

    public function index()
    {
        $data = $this->modelPotensi->getAllPotensiDesa();

        return view('admin.potensi.index', compact('data'));
    }

    public function create()
    {
        return view('admin.potensi.create');
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'judul' => 'required',
                'kategori' => 'required',
                'gambar' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
                'deskripsi_singkat' => 'required|max:255',
                'deskripsi_lengkap' => 'required',
                'status_stok' => 'required',
                'status_publikasi' => 'required',
            ]
        );

        $path = $request->file('gambar')->store('upload/images', 'public');
        $data = [
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'kategori' => $request->kategori,
            'gambar' => $path,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'deskripsi_lengkap' => $request->deskripsi_lengkap,
            'harga' => $request->harga,
            'kondisi' => $request->kondisi,
            'status_stok' => $request->status_stok,
            'pengelola' => $request->pengelola,
            'nomor_wa' => $request->nomor_wa,
            'status_publikasi' => $request->status_publikasi,
        ];

        if ($this->modelPotensi->create($data)) {
            return redirect()->route('admin.potensi.index')->with('success', 'Data potensi berhasil disimpan.');
        }
    }

    public function edit($id)
    {
        $potensi = $this->modelPotensi->find($id);
        return view('admin.potensi.edit', compact('potensi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'             => 'required',
            'kategori'          => 'required',
            'gambar'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Tambahkan validasi gambar
            'deskripsi_singkat' => 'required|max:255',
            'deskripsi_lengkap' => 'required',
            'status_publikasi'  => 'required',
        ]);

        $potensi = $this->modelPotensi->findOrFail($id);

        $dataUpdate = [
            'judul'             => $request->judul,
            'slug'              => Str::slug($request->judul),
            'kategori'          => $request->kategori,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'deskripsi_lengkap' => $request->deskripsi_lengkap,
            'harga'             => $request->harga,
            'kondisi'           => $request->kondisi,
            'status_stok'       => $request->status_stok,
            'pengelola'         => $request->pengelola,
            'nomor_wa'          => $request->nomor_wa,
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
            return redirect()->route('admin.potensi.index')->with('success', 'Data potensi berhasil diperbarui.');
        } else {
            return redirect()->route('admin.potensi.index')->with('error', 'Gagal memperbarui data potensi.');
        }
    }

    public function destroy($id)
    {
        $potensi = $this->modelPotensi->findOrFail($id);

        if ($potensi->gambar && Storage::disk('public')->exists($potensi->gambar)) {
            Storage::disk('public')->delete($potensi->gambar);
        }

        if ($potensi->delete()) {
            return redirect()->route('admin.potensi.index')->with('success', 'Data potensi berhasil dihapus.');
        } else {
            return redirect()->route('admin.potensi.index')->with('error', 'Gagal menghapus data potensi.');
        }
    }
}