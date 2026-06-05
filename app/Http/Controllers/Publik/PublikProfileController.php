<?php

namespace App\Http\Controllers\Publik;
use App\Http\Controllers\Controller;

class PublikProfileController extends Controller
{

    public function index()
    {
        // 1. Ambil Data Potensi Desa (Maksimal 3 untuk Landing Page)
        $modelPotensi = new \App\Models\PotensiDesa();
        // Karena status_publikasi dikembalikan, pastikan hanya memanggil yang berstatus 'publish' (jika Anda sudah membuat scope atau query where)
        $dataPotensi = $modelPotensi->where('status_publikasi', 'publish')->latest()->limit(3)->get();

        // 2. Ambil Data Profil Desa untuk Section About
        $profil = \App\Models\ProfilDesa::first();

        // Siapkan kerangka data bawaan (dummy default)
        $dummyData = [
            'total_penduduk' => 5491,
            'luas_wilayah' => 449.28,
            'jumlah_rt' => 24,
            'jumlah_rw' => 9,
            'jumlah_dusun' => 4,
            'total_kk' => 1690,
            'penduduk_laki_laki' => 2752,
            'penduduk_perempuan' => 2739,
            'luas_pemukiman' => 62.28,
            'luas_persawahan' => 258.00,
            'luas_perkebunan' => 30.00,
            'deskripsi_demografi' => 'Meskipun memiliki kata "Gunung" pada namanya, Desa Gunung Sembung sejatinya berada di topografi dataran rendah dengan ketinggian rata-rata 25 meter di atas permukaan laut (mdpl). Mayoritas lahan desa dimanfaatkan secara produktif untuk area persawahan dan pemukiman warga.' . "\n\n" . 'Secara demografi dan ekonomi, desa kami memiliki letak yang sangat strategis karena diapit oleh pusat Kecamatan Pagaden dan pusat Kabupaten Subang (berjarak ± 7,5 KM). Hal ini membuka akses ekonomi dan distribusi hasil pertanian warga dengan sangat baik.',
            'deskripsi_fasilitas' => 'Sebagai desa yang berkembang secara strategis, Gunung Sembung dilengkapi dengan berbagai fasilitas umum utama yang juga melayani area sekitar.',
            'sejarah_desa' => 'Sejarah singkat Desa Gunung Sembung bermula dari tatanan adat budaya lokal agraris yang kuat di Kabupaten Subang...',
            'batas_utara' => 'Desa Kidul', 
            'batas_selatan' => 'Desa Lor', 
            'batas_timur' => 'Kecamatan Sebelah', 
            'batas_barat' => 'Hutan Produksi',
            'nama_kades' => 'Agus Apip Somantri',
            'bio_kades' => 'Dikenal akrab dengan sapaan Kang Agus. Berkomitmen kuat pada infrastruktur pedesaan, ketahanan pangan, pelestarian budaya lokal (Ngaruwat Bumi), serta kerukunan masyarakat desa.',
            'nama_camat' => 'Wawan Hermawan, S.STP., M.A.P.',
            'bio_camat' => 'Mengemban amanah sebagai pimpinan wilayah di Kecamatan Pagaden. Membawahi 10 desa termasuk Desa Gunung Sembung dalam struktur administrasi Pemerintah Kabupaten Subang.',
            'peta_embed' => null,
        ];

        // Logika Penambalan Data
        if (!$profil) {
            $profil = (object) $dummyData;
        } else {
            foreach ($dummyData as $key => $value) {
                if (is_null($profil->$key) || $profil->$key === '') {
                    $profil->$key = $value;
                }
            }
        }

        // Lempar $dataPotensi dan $profil ke view pages.index
        return view('pages.index', compact('dataPotensi', 'profil'));
    }

/**
     * Menampilkan Halaman Profil Desa Secara Dinamis dengan Fallback Dummy
     */
    public function profile()
    {
        $profil = \App\Models\ProfilDesa::first();
        $dataFasilitas = \App\Models\FasilitasPublik::oldest()->get();

        // 1. Siapkan kerangka data bawaan (dummy default)
        $dummyData = [
            'total_penduduk' => 5491,
            'luas_wilayah' => 449.28,
            'jumlah_rt' => 24,
            'jumlah_rw' => 9,
            'jumlah_dusun' => 4,
            'total_kk' => 1690,
            'penduduk_laki_laki' => 2752,
            'penduduk_perempuan' => 2739,
            'luas_pemukiman' => 62.28,
            'luas_persawahan' => 258.00,
            'luas_perkebunan' => 30.00,
            'deskripsi_demografi' => 'Desa Gunung Sembung berada di topografi dataran rendah dengan ketinggian rata-rata 25 meter di atas permukaan laut (mdpl). Sebagian besar lahan desa dimanfaatkan untuk sektor agribisnis.',
            'deskripsi_fasilitas' => 'Sebagai desa yang berkembang secara strategis, Gunung Sembung dilengkapi dengan berbagai fasilitas umum utama yang juga melayani area sekitar.',
            'sejarah_desa' => 'Sejarah singkat Desa Gunung Sembung bermula dari tatanan adat budaya lokal agraris yang kuat di Kabupaten Subang...',
            'batas_utara' => 'Desa Kidul', 
            'batas_selatan' => 'Desa Lor', 
            'batas_timur' => 'Kecamatan Sebelah', 
            'batas_barat' => 'Hutan Produksi',
            'nama_kades' => 'Agus Apip Somantri',
            'bio_kades' => 'Dikenal akrab dengan sapaan Kang Agus. Berkomitmen kuat pada infrastruktur pedesaan, ketahanan pangan, pelestarian budaya lokal (Ngaruwat Bumi), serta kerukunan masyarakat desa.',
            'nama_camat' => 'Wawan Hermawan, S.STP., M.A.P.',
            'bio_camat' => 'Mengemban amanah sebagai pimpinan wilayah di Kecamatan Pagaden. Membawahi 10 desa termasuk Desa Gunung Sembung dalam struktur administrasi Pemerintah Kabupaten Subang.',
            'peta_embed' => null, // Agar tidak error jika dipanggil
        ];

        // 2. Logika Penambalan Data
        if (!$profil) {
            // Jika tabel di database benar-benar masih kosong (belum disave admin sama sekali)
            $profil = (object) $dummyData;
        } else {
            // Jika data di database sudah ada, cek per kolom
            foreach ($dummyData as $key => $value) {
                // Jika kolom di DB bernilai null atau string kosong (''), timpa dengan data dummy
                // Kita tidak menggunakan empty() agar angka 0 (nol) yang sengaja diinput admin tidak tertimpa.
                if (is_null($profil->$key) || $profil->$key === '') {
                    $profil->$key = $value;
                }
            }
        }

        return view('pages.profile', compact('profil', 'dataFasilitas'));
    }
}