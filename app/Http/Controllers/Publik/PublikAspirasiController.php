<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublikAspirasiController extends Controller
{
/**
     * Menampilkan Halaman Formulir Aspirasi
     */
    public function aspirasi()
    {
        return view('pages.aspirasi');
    }

    /**
     * Memproses Pengiriman Aspirasi
     */
    public function kirimAspirasi(Request $request)
    {
        try {
            // 1. Validasi Data beserta Custom Pesan Error
            $validated = $request->validate([
                'nama_pengirim' => 'required|string|max:255',
                'nik'           => 'required|string|size:16',
                'no_hp'         => 'required|string|max:15',
                'kategori'      => 'required|string',
                'judul'         => 'required|string|max:255',
                'pesan'         => 'required|string',
                'foto_lampiran' => 'nullable|image|mimes:jpeg,png,jpg|max:10240', // Maks 10MB
            ], [
                // Kustomisasi pesan error agar lebih ramah untuk warga
                'nama_pengirim.required' => 'Kolom Nama Lengkap wajib diisi.',
                'nik.required'           => 'Kolom NIK wajib diisi.',
                'nik.size'               => 'NIK harus berjumlah tepat 16 digit.',
                'kategori.required'      => 'Silakan pilih Kategori Aduan.',
                'pesan.required'         => 'Isi Pesan/Rincian Aduan tidak boleh kosong.',
                'foto_lampiran.mimes'    => 'Format foto harus berupa JPG, JPEG, atau PNG.',
                'foto_lampiran.max'      => 'Ukuran foto lampiran maksimal 10MB.',
            ]);

            // Proses unggah foto bukti jika ada
            if ($request->hasFile('foto_lampiran')) {
                $validated['foto_lampiran'] = $request->file('foto_lampiran')->store('lampiran_aspirasi', 'public');
            }

            // Simpan ke database (Gunakan pemanggilan statis ::create secara langsung)
            \App\Models\Aspirasi::create($validated);

            return redirect()->back()->with('success', 'Aspirasi / Pengaduan Anda berhasil dikirim! Pemerintah Desa akan segera menindaklanjuti laporan Anda.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Jika validasi gagal, biarkan Laravel melempar kembali ke form beserta pesan errornya
            throw $e;
        } catch (\Exception $e) {
            // Jika terjadi kegagalan sistem (misal database down/error penyimpanan)
            // withInput() digunakan agar data yang sudah diketik warga tidak hilang
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan sistem: Gagal mengirim aspirasi. Silakan coba lagi nanti.');
        }
    }   
}