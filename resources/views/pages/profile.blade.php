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
                <h3 class="text-[32px] text-primary m-0 mb-[10px] leading-none font-bold">
                    {{ number_format($profil->total_penduduk, 0, ',', '.') }}
                </h3>
                <p class="text-[14px] text-text-muted m-0 font-semibold uppercase tracking-[0.5px]">Total Penduduk (Jiwa)</p>
            </div>
            <div class="bg-white p-[25px_20px] rounded-[12px] shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] border-t-[4px] border-secondary text-center">
                <h3 class="text-[32px] text-primary m-0 mb-[10px] leading-none font-bold">
                    {{ str_replace('.', ',', $profil->luas_wilayah) }}
                </h3>
                <p class="text-[14px] text-text-muted m-0 font-semibold uppercase tracking-[0.5px]">Luas Wilayah (Hektar)</p>
            </div>
            <div class="bg-white p-[25px_20px] rounded-[12px] shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] border-t-[4px] border-secondary text-center">
                <h3 class="text-[32px] text-primary m-0 mb-[10px] leading-none font-bold">
                    {{ $profil->jumlah_rt }}
                </h3>
                <p class="text-[14px] text-text-muted m-0 font-semibold uppercase tracking-[0.5px]">Jumlah RT dari {{ $profil->jumlah_rw }} RW</p>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-[40px] mb-[60px]">

            <div class="lg:w-2/3 flex flex-col gap-[30px]">

                <div class="bg-white rounded-[12px] p-[30px] shadow-[0_1px_3px_rgba(0,0,0,0.05)] border border-[#E2E8F0]">
                    <h2 class="text-primary text-[22px] md:text-[24px] mt-0 pb-[15px] border-b-[2px] border-[#F1F5F9] flex items-center gap-[10px] font-bold">
                        📝 Demografi & Luas Wilayah
                    </h2>
                    <p class="text-[15px] text-text-muted mb-[20px] mt-[15px] leading-relaxed">
                        {{ $profil->deskripsi_demografi }}
                    </p>

                    <table class="w-full border-collapse mt-[15px] [&_th]:p-[12px_15px] [&_td]:p-[12px_15px] [&_th]:text-left [&_td]:text-left [&_th]:border-b [&_td]:border-b [&_th]:border-[#F1F5F9] [&_td]:border-[#F1F5F9] [&_th]:text-[15px] [&_td]:text-[15px] [&_th]:w-[40%] [&_th]:text-text-muted [&_th]:font-semibold [&_td]:font-medium [&_td]:text-text-main [&_tr:last-child_th]:border-none [&_tr:last-child_td]:border-none">
                        <tr>
                            <th>Total Kepala Keluarga (KK)</th>
                            <td>± {{ number_format($profil->total_kk, 0, ',', '.') }} KK</td>
                        </tr>
                        <tr>
                            <th>Penduduk Laki-laki</th>
                            <td>{{ number_format($profil->penduduk_laki_laki, 0, ',', '.') }} Jiwa</td>
                        </tr>
                        <tr>
                            <th>Penduduk Perempuan</th>
                            <td>{{ number_format($profil->penduduk_perempuan, 0, ',', '.') }} Jiwa</td>
                        </tr>
                        <tr>
                            <th>Pembagian Wilayah</th>
                            <td>{{ $profil->jumlah_dusun }} Dusun, {{ $profil->jumlah_rw }} Rukun Warga (RW), {{ $profil->jumlah_rt }} Rukun Tetangga (RT)</td>
                        </tr>
                        <tr>
                            <th>Luas Pemukiman</th>
                            <td>{{ str_replace('.', ',', $profil->luas_pemukiman) }} Hektar</td>
                        </tr>
                        <tr>
                            <th>Luas Persawahan</th>
                            <td>{{ str_replace('.', ',', $profil->luas_persawahan) }} Hektar</td>
                        </tr>
                        <tr>
                            <th>Luas Perkebunan</th>
                            <td>{{ str_replace('.', ',', $profil->luas_perkebunan) }} Hektar</td>
                        </tr>
                    </table>
                </div>

                @if($profil->batas_utara || $profil->batas_selatan)
                <div class="bg-white rounded-[12px] p-[30px] shadow-[0_1px_3px_rgba(0,0,0,0.05)] border border-[#E2E8F0]">
                    <h2 class="text-primary text-[22px] md:text-[24px] mt-0 pb-[15px] border-b-[2px] border-[#F1F5F9] flex items-center gap-[10px] font-bold">
                        🗺️ Batas Geografis Wilayah
                    </h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-[15px] mt-[20px]">
                        <div class="bg-gray-50 p-[15px] rounded-lg text-center border">
                            <span class="block text-[11px] font-bold uppercase tracking-wider text-text-muted mb-[5px]">Utara</span>
                            <span class="font-semibold text-text-main text-[14px]">{{ $profil->batas_utara ?? '-' }}</span>
                        </div>
                        <div class="bg-gray-50 p-[15px] rounded-lg text-center border">
                            <span class="block text-[11px] font-bold uppercase tracking-wider text-text-muted mb-[5px]">Selatan</span>
                            <span class="font-semibold text-text-main text-[14px]">{{ $profil->batas_selatan ?? '-' }}</span>
                        </div>
                        <div class="bg-gray-50 p-[15px] rounded-lg text-center border">
                            <span class="block text-[11px] font-bold uppercase tracking-wider text-text-muted mb-[5px]">Timur</span>
                            <span class="font-semibold text-text-main text-[14px]">{{ $profil->batas_timur ?? '-' }}</span>
                        </div>
                        <div class="bg-gray-50 p-[15px] rounded-lg text-center border">
                            <span class="block text-[11px] font-bold uppercase tracking-wider text-text-muted mb-[5px]">Barat</span>
                            <span class="font-semibold text-text-main text-[14px]">{{ $profil->batas_barat ?? '-' }}</span>
                        </div>
                    </div>
                </div>
                @endif

                @if($profil->sejarah_desa)
                <div class="bg-white rounded-[12px] p-[30px] shadow-[0_1px_3px_rgba(0,0,0,0.05)] border border-[#E2E8F0]">
                    <h2 class="text-primary text-[22px] md:text-[24px] mt-0 pb-[15px] border-b-[2px] border-[#F1F5F9] flex items-center gap-[10px] font-bold">
                        📜 Asal Usul & Sejarah Desa
                    </h2>
                    <p class="text-[15px] text-text-muted mt-[15px] leading-relaxed whitespace-pre-line">
                        {{ $profil->sejarah_desa }}
                    </p>
                </div>
                @endif

                <div class="bg-white rounded-[12px] p-[30px] shadow-[0_1px_3px_rgba(0,0,0,0.05)] border border-[#E2E8F0]">
                    <h2 class="text-primary text-[22px] md:text-[24px] mt-0 pb-[15px] border-b-[2px] border-[#F1F5F9] flex items-center gap-[10px] font-bold">
                        🏥 Fasilitas Publik & Infrastruktur
                    </h2>
                    <p class="text-[15px] text-text-muted mb-[20px] mt-[15px] leading-relaxed">
                        {{ $profil->deskripsi_fasilitas }}
                    </p>

                    <ul class="list-none p-0 m-0 flex flex-col gap-[15px]">
                        @forelse($dataFasilitas as $f)
                        <li class="bg-[#F8FAFC] p-[20px] rounded-[8px] border-l-[4px] border-primary-light">
                            <h4 class="m-0 mb-[5px] text-text-main text-[16px] font-bold">{{ $f->nama_fasilitas }}</h4>
                            <p class="m-0 text-text-muted text-[14px]"><strong>Lokasi:</strong> {{ $f->lokasi }}</p>
                            <p class="m-0 text-text-muted text-[14px] mt-[5px] leading-relaxed">{{ $f->deskripsi }}</p>
                        </li>
                        @empty
                        <li class="bg-[#F8FAFC] p-[20px] rounded-[8px] border-l-[4px] border-gray-400 italic text-[14px] text-text-muted">
                            Belum ada rincian fasilitas eksternal khusus yang dimasukkan petugas.
                        </li>
                        @endforelse
                    </ul>
                </div>
                

            </div>

            <div class="lg:w-1/3">
                <div class="bg-white rounded-[12px] p-[30px] shadow-[0_1px_3px_rgba(0,0,0,0.05)] border border-[#E2E8F0] sticky top-[100px] flex flex-col gap-[20px]">
                    <h2 class="text-primary text-[22px] mt-0 pb-[15px] border-b-[2px] border-[#F1F5F9] flex items-center gap-[10px] font-bold m-0">
                        🏛️ Struktur Pemerintahan
                    </h2>

                    @if($profil->nama_kades)
                    <div class="bg-bg-color p-[20px] rounded-[12px] text-center border border-[#E2E8F0]">
                        <div class="w-[80px] h-[80px] bg-primary rounded-full mx-auto mb-[15px] flex items-center justify-center text-white text-[24px] font-bold uppercase">
                            {{ substr($profil->nama_kades, 0, 1) }}
                        </div>
                        <h4 class="m-0 mb-[5px] text-text-main text-[18px] font-bold">{{ $profil->nama_kades }}</h4>
                        <span class="text-[13px] text-text-muted font-semibold block mb-[10px]">Kepala Desa Saat Ini</span>
                        <p class="text-[13px] text-[#475569] m-0 leading-[1.5]">
                            {{ $profil->bio_kades }}
                        </p>
                    </div>
                    @endif

                    @if($profil->nama_camat)
                    <div class="bg-bg-color p-[20px] rounded-[12px] text-center border border-[#E2E8F0]">
                        <div class="w-[80px] h-[80px] bg-primary-light rounded-full mx-auto mb-[15px] flex items-center justify-center text-white text-[24px] font-bold uppercase">
                            {{ substr($profil->nama_camat, 0, 1) }}
                        </div>
                        <h4 class="m-0 mb-[5px] text-text-main text-[18px] font-bold">{{ $profil->nama_camat }}</h4>
                        <span class="text-[13px] text-text-muted font-semibold block mb-[10px]">Camat Pagaden Saat Ini</span>
                        <p class="text-[13px] text-[#475569] m-0 leading-[1.5]">
                            {{ $profil->bio_camat }}
                        </p>
                    </div>
                    @endif

                </div>
                
            </div>

        </div>

        <p class="text-[12px] text-[#94A3B8] text-center mt-[40px] italic">
            *Data di atas dirangkum dari publikasi data BPS (Badan Pusat Statistik) Kabupaten Subang, Direktori Kecamatan Pemkab Subang, dan Data Pokok SID Desa Gunung Sembung.
        </p>
    </main>

@endsection