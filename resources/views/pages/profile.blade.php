@extends('layouts.app')

@section('title', 'Data & Profil Desa Gunung Sembung')

@section('content')

    <header class="bg-gradient-to-br from-primary to-[#0F766E] text-white py-[60px] text-center mb-[40px]">
        <div class="container mx-auto px-5 max-w-6xl">
            <h1 class="m-0 mb-[10px] text-[30px] md:text-[36px] font-bold">Data Wilayah & Kependudukan</h1>
            <p class="m-0 text-[16px] md:text-[18px] opacity-90">Desa Gunung Sembung, Kecamatan Pagaden, Kabupaten Subang</p>
        </div>
    </header>

    <main class="container mx-auto px-5 max-w-6xl">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-[20px] mb-[40px]">
            <div class="bg-white p-[25px_20px] rounded-[12px] shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] border-t-[4px] border-secondary text-center">
                <h3 class="text-[32px] color-primary text-primary m-0 mb-[10px] leading-none font-bold">5.491</h3>
                <p class="text-[14px] text-text-muted m-0 font-semibold uppercase tracking-[0.5px]">Total Penduduk (Jiwa)</p>
            </div>
            <div class="bg-white p-[25px_20px] rounded-[12px] shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] border-t-[4px] border-secondary text-center">
                <h3 class="text-[32px] color-primary text-primary m-0 mb-[10px] leading-none font-bold">449,28</h3>
                <p class="text-[14px] text-text-muted m-0 font-semibold uppercase tracking-[0.5px]">Luas Wilayah (Hektar)</p>
            </div>
            <div class="bg-white p-[25px_20px] rounded-[12px] shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] border-t-[4px] border-secondary text-center">
                <h3 class="text-[32px] color-primary text-primary m-0 mb-[10px] leading-none font-bold">24</h3>
                <p class="text-[14px] text-text-muted m-0 font-semibold uppercase tracking-[0.5px]">Jumlah RT dari 9 RW</p>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-[40px] mb-[60px]">

            <div class="lg:w-2/3">

                <div class="bg-white rounded-[12px] p-[30px] shadow-[0_1px_3px_rgba(0,0,0,0.05)] border border-[#E2E8F0] mb-[30px]">
                    <h2 class="text-primary text-[22px] md:text-[24px] mt-0 pb-[15px] border-b-[2px] border-[#F1F5F9] flex items-center gap-[10px] font-bold">
                        📝 Demografi & Luas Wilayah
                    </h2>
                    <p class="text-[15px] text-text-muted mb-[20px] mt-[15px] leading-relaxed">
                        Desa Gunung Sembung berada di topografi dataran rendah dengan ketinggian rata-rata 25 meter di atas permukaan laut (mdpl). Sebagian besar lahan desa dimanfaatkan untuk sektor agribisnis.
                    </p>

                    <table class="w-full border-collapse mt-[15px] [&_th]:p-[12px_15px] [&_td]:p-[12px_15px] [&_th]:text-left [&_td]:text-left [&_th]:border-b [&_td]:border-b [&_th]:border-[#F1F5F9] [&_td]:border-[#F1F5F9] [&_th]:text-[15px] [&_td]:text-[15px] [&_th]:w-[40%] [&_th]:text-text-muted [&_th]:font-semibold [&_td]:font-medium [&_td]:text-text-main [&_tr:last-child_th]:border-none [&_tr:last-child_td]:border-none">
                        <tr>
                            <th>Total Kepala Keluarga (KK)</th>
                            <td>± 1.690 KK</td>
                        </tr>
                        <tr>
                            <th>Penduduk Laki-laki</th>
                            <td>2.752 Jiwa</td>
                        </tr>
                        <tr>
                            <th>Penduduk Perempuan</th>
                            <td>2.739 Jiwa</td>
                        </tr>
                        <tr>
                            <th>Pembagian Wilayah</th>
                            <td>4 Dusun, 9 Rukun Warga (RW), 24 Rukun Tetangga (RT)</td>
                        </tr>
                        <tr>
                            <th>Luas Pemukiman</th>
                            <td>62,28 Hektar</td>
                        </tr>
                        <tr>
                            <th>Luas Persawahan</th>
                            <td>258,00 Hektar (Mayoritas)</td>
                        </tr>
                        <tr>
                            <th>Luas Perkebunan</th>
                            <td>30,00 Hektar</td>
                        </tr>
                    </table>
                </div>

                <div class="bg-white rounded-[12px] p-[30px] shadow-[0_1px_3px_rgba(0,0,0,0.05)] border border-[#E2E8F0] mb-[30px]">
                    <h2 class="text-primary text-[22px] md:text-[24px] mt-0 pb-[15px] border-b-[2px] border-[#F1F5F9] flex items-center gap-[10px] font-bold">
                        🏥 Fasilitas Publik & Infrastruktur
                    </h2>
                    <p class="text-[15px] text-text-muted mb-[20px] mt-[15px] leading-relaxed">
                        Sebagai desa yang berkembang secara strategis, Gunung Sembung dilengkapi dengan berbagai fasilitas umum utama yang juga melayani area sekitar.
                    </p>

                    <ul class="list-none p-0 m-0 [&>li]:bg-[#F8FAFC] [&>li]:mb-[15px] [&>li]:p-[20px] [&>li]:rounded-[8px] [&>li]:border-l-[4px] [&>li]:border-primary-light">
                        <li>
                            <h4 class="m-0 mb-[5px] text-text-main text-[16px] font-bold">UPTD Puskesmas Gunung Sembung</h4>
                            <p class="m-0 text-text-muted text-[14px]"><strong>Lokasi:</strong> Jl. Raya Pagaden Km.08 (Kp. Cerelek).</p>
                            <p class="m-0 text-text-muted text-[14px] mt-[5px] leading-relaxed">Merupakan unit pelayanan kesehatan dasar terpadu tingkat pertama yang penting di Kecamatan Pagaden untuk penanganan kesehatan masyarakat dan penanganan masalah gizi (balita).</p>
                        </li>
                        <li>
                            <h4 class="m-0 mb-[5px] text-text-main text-[16px] font-bold">SD Negeri Gunung Sembung</h4>
                            <p class="m-0 text-text-muted text-[14px]"><strong>Lokasi:</strong> Jl. Cerelek RT.011 / RW.005, Desa Gunung Sembung.</p>
                            <p class="m-0 text-text-muted text-[14px] mt-[5px] leading-relaxed">Fasilitas pendidikan dasar negeri utama yang memfasilitasi kebutuhan wajib belajar anak-anak di lingkungan desa.</p>
                        </li>
                        <li>
                            <h4 class="m-0 mb-[5px] text-text-main text-[16px] font-bold">LKP Lambada & Fasilitas Pendidikan Lainnya</h4>
                            <p class="m-0 text-text-muted text-[14px]"><strong>Lokasi:</strong> Kp. Sembung 2 RT.009 / RW.004.</p>
                            <p class="m-0 text-text-muted text-[14px] mt-[5px] leading-relaxed">Terdapat lembaga kursus pendidikan, serta puluhan sarana ibadah (Masjid/Mushola) yang terintegrasi dengan tempat pendidikan santri binaan warga dan yayasan lokal.</p>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="lg:w-1/3">
                <div class="bg-white rounded-[12px] p-[30px] shadow-[0_1px_3px_rgba(0,0,0,0.05)] border border-[#E2E8F0] sticky top-[100px]">
                    <h2 class="text-primary text-[22px] mt-0 pb-[15px] border-b-[2px] border-[#F1F5F9] flex items-center gap-[10px] font-bold mb-[20px]">
                        🏛️ Struktur Pemerintahan
                    </h2>

                    <div class="bg-bg-color p-[20px] rounded-[12px] mb-[20px] text-center border border-[#E2E8F0]">
                        <div class="w-[80px] h-[80px] bg-primary rounded-full mx-auto mb-[15px] flex items-center justify-center text-white text-[24px] font-bold">
                            K
                        </div>
                        <h4 class="m-0 mb-[5px] text-text-main text-[18px] font-bold">Agus Apip Somantri</h4>
                        <span class="text-[13px] text-text-muted font-semibold block mb-[10px]">Kepala Desa Gunung Sembung Saat Ini</span>
                        <p class="text-[13px] text-[#475569] m-0 leading-[1.5]">
                            Dikenal akrab dengan sapaan Kang Agus. Berkomitmen kuat pada infrastruktur pedesaan, ketahanan pangan, pelestarian budaya lokal (Ngaruwat Bumi), serta kerukunan masyarakat desa.
                        </p>
                    </div>

                    <div class="bg-bg-color p-[20px] rounded-[12px] mb-[20px] text-center border border-[#E2E8F0]">
                        <div class="w-[80px] h-[80px] bg-primary-light rounded-full mx-auto mb-[15px] flex items-center justify-center text-white text-[24px] font-bold">
                            C
                        </div>
                        <h4 class="m-0 mb-[5px] text-text-main text-[18px] font-bold">Wawan Hermawan, S.STP., M.A.P.</h4>
                        <span class="text-[13px] text-text-muted font-semibold block mb-[10px]">Camat Pagaden Saat Ini</span>
                        <p class="text-[13px] text-[#475569] m-0 leading-[1.5]">
                            Mengemban amanah sebagai pimpinan wilayah di Kecamatan Pagaden. Membawahi 10 desa termasuk Desa Gunung Sembung dalam struktur administrasi Pemerintah Kabupaten Subang.
                        </p>
                    </div>

                </div>
            </div>

        </div>

        <p class="text-[12px] text-[#94A3B8] text-center mt-[40px] italic">
            *Data di atas dirangkum dari publikasi data BPS (Badan Pusat Statistik) Kabupaten Subang, Direktori Kecamatan Pemkab Subang, dan Data Kemendikbud Ristek RI.
        </p>
    </main>

@endsection