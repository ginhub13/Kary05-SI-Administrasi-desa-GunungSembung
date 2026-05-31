@extends('layouts.app')

@section('title', 'Profil Desa Gunung Sembung - Pagaden, Subang')

@section('content')

<section style="background-image: url('/images/bg-sawah2.png')" class="relative h-[500px] flex items-center text-center text-white bg-cover bg-center">
    <div class="absolute inset-0 bg-gradient-to-b from-primary/80 to-primary/60"></div>

    <div class="container relative z-10 mx-auto px-5 max-w-6xl">
        <h1 class="text-4xl md:text-[48px] font-bold mb-2.5">Desa Gunung Sembung</h1>
        <p class="text-[18px] md:text-[22px] mb-5 italic text-secondary font-semibold">
            "Hirup Sauyunan, Gawe Rancage Babarengan, Ngawujudken Gunung Sembung Nanjung"
        </p>
        <p class="text-base md:text-[18px] mb-[30px] opacity-90 max-w-[700px] mx-auto">
            Kecamatan Pagaden, Kabupaten Subang, Jawa Barat. Membangun desa mandiri dengan mengoptimalkan potensi agribisnis dan letak strategis daerah.
        </p>
        <a href="#about" class="inline-block bg-secondary text-white px-[30px] py-[12px] rounded-full font-bold transition duration-300 hover:bg-[#D97706]">
            Mengenal Desa Kami
        </a>
    </div>
</section>

<section id="about" class="container mx-auto px-5 max-w-6xl py-20 flex flex-col md:flex-row gap-12 items-center">
    <div class="flex-1">
        <h2 class="text-primary text-3xl md:text-4xl font-bold mt-0 mb-4">Profil Wilayah</h2>
        
        <p class="text-base text-text-muted mb-4 whitespace-pre-line text-justify">
            {{ $profil->deskripsi_demografi ?? 'Informasi profil wilayah desa sedang dalam tahap pembaruan oleh pemerintah desa.' }}
        </p>

        <div class="flex flex-col sm:flex-row gap-5 mt-[30px]">
            <div class="bg-bg-color p-[15px] rounded-lg border-l-4 border-primary flex-1">
                <h4 class="m-0 mb-1 text-[20px] text-primary font-bold">{{ $profil->jumlah_dusun ?? '0' }} Dusun</h4>
                <p class="m-0 text-[13px] text-text-muted">Terbagi dalam {{ $profil->jumlah_rw ?? '0' }} RW dan {{ $profil->jumlah_rt ?? '0' }} RT.</p>
            </div>
            
            <div class="bg-bg-color p-[15px] rounded-lg border-l-4 border-primary flex-1">
                <h4 class="m-0 mb-1 text-[20px] text-primary font-bold">± {{ number_format($profil->total_penduduk ?? 0, 0, ',', '.') }}</h4>
                <p class="m-0 text-[13px] text-text-muted">Total populasi jiwa penduduk.</p>
            </div>
            
            <div class="bg-bg-color p-[15px] rounded-lg border-l-4 border-primary flex-1">
                <h4 class="m-0 mb-1 text-[20px] text-primary font-bold">{{ str_replace('.', ',', $profil->luas_wilayah ?? 0) }} Ha</h4>
                <p class="m-0 text-[13px] text-text-muted">Luas total wilayah desa.</p>
            </div>
        </div>
    </div>

    <div class="flex-1 relative w-full">
        <img src="{{ asset('images/bg-sawah.jpg') }}" alt="Lahan Pertanian dan Pemukiman" class="w-full rounded-2xl shadow-[0_10px_20px_rgba(0,0,0,0.1)]">
    </div>
</section>

<section class="bg-white py-20">
    <div class="container mx-auto px-5 max-w-6xl">
        <h2 class="text-center text-primary text-3xl md:text-[36px] font-bold mt-0 mb-2.5">Potensi Desa</h2>
        <p class="text-center text-text-muted mb-10">Mengoptimalkan kekayaan alam dan sumber daya manusia Gunung Sembung</p>

        <div class="grid grid-cols-[repeat(auto-fit,minmax(300px,380px))] justify-center gap-[30px]">

            @forelse($dataPotensi as $potensi)
            <div class="bg-bg-color rounded-xl overflow-hidden shadow-sm transition duration-300 hover:-translate-y-2.5 hover:shadow-md flex flex-col">
                @if($potensi->gambar)
                    <img src="{{ asset('storage/' . $potensi->gambar) }}" alt="{{ $potensi->judul }}" class="w-full h-[200px] object-cover">
                @else
                    <div class="w-full h-[200px] bg-slate-200 flex items-center justify-center text-slate-400">
                        Tanpa Gambar
                    </div>
                @endif

                <div class="p-[25px] flex-grow">
                    <h3 class="m-0 mt-1.5 mb-2.5 text-primary text-[20px] font-bold">{{ $potensi->judul }}</h3>
                    <p class="text-text-muted m-0 text-[14px]">
                        {{ Str::limit($potensi->deskripsi_singkat, 90) }}
                    </p>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center text-text-muted py-10">
                Data potensi desa sedang dalam tahap pembaruan.
            </div>
            @endforelse

        </div>
    </div>
</section>

@endsection