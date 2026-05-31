@extends('layouts.app')

@section('title', 'Hak & Kewajiban Masyarakat - Desa Gunung Sembung')

@section('content')
<header class="relative py-[80px] mb-[40px] text-center text-white bg-[url('https://cdn.pixabay.com/photo/2019/03/12/12/47/indonesian-flag-4050739_1280.jpg')] bg-cover bg-center">
    <div class="absolute inset-0 bg-primary/85 mix-blend-multiply"></div>
    <div class="container relative z-10 mx-auto px-5 max-w-6xl">
        <h1 class="m-0 mb-[15px] text-[30px] md:text-[40px] font-bold">Hak Masyarakat</h1>
        <p class="text-[18px] max-w-[700px] mx-auto opacity-90"> hak masyarakat menurut Undang-undang yang harus dipenuhi oleh pemerintah dalam konteks informasi, pelayanan, dan partisipasi kegiatan desa. </p>
    </div>
</header>

<main class="container mx-auto px-5 max-w-4xl mb-[80px]">
    <div class="bg-white rounded-2xl p-[30px] md:p-[50px] border border-border shadow-sm flex flex-col gap-[35px]">
        
        <p class="text-[15px] text-text-muted leading-relaxed text-justify m-0">
            Hak masyarakat desa terhadap informasi, pelayanan, dan partisipasi dijamin dalam <strong class="text-text-main">Pasal 68 ayat (1) huruf a, huruf b, dan huruf c Undang-Undang Nomor 6 Tahun 2014 tentang Desa.</strong>
        </p>

        <div>
            <h2 class="text-[20px] md:text-[24px] font-bold text-text-main border-l-4 border-primary pl-[15px] mb-[20px]">
                Pasal 68 ayat (1)
                <span class="block text-[16px] font-normal text-text-muted mt-[5px]">Masyarakat Desa berhak:</span>
            </h2>
            
            <ul class="list-none p-0 m-0 flex flex-col gap-[15px] text-[15px] text-text-muted leading-relaxed text-justify">
                <li class="flex gap-[15px] items-start">
                    <span class="text-primary text-[18px] font-bold">a.</span>
                    <div>
                        meminta dan mendapatkan informasi dari Pemerintah Desa serta mengawasi kegiatan penyelenggaraan Pemerintahan Desa, pelaksanaan Pembangunan Desa, pembinaan kemasyarakatan Desa, dan pemberdayaan masyarakat Desa;
                    </div>
                </li>
                <li class="flex gap-[15px] items-start">
                    <span class="text-primary text-[18px] font-bold">b.</span>
                    <div>
                        memperoleh pelayanan yang sama dan adil;
                    </div>
                </li>
                <li class="flex gap-[15px] items-start">
                    <span class="text-primary text-[18px] font-bold">c.</span>
                    <div>
                        menyampaikan aspirasi, saran, dan pendapat lisan atau tertulis secara bertanggung jawab tentang kegiatan penyelenggaraan Pemerintahan Desa, pelaksanaan Pembangunan Desa, pembinaan kemasyarakatan Desa, dan pemberdayaan masyarakat Desa.
                    </div>
                </li>
            </ul>
        </div>

        <hr class="border-border">

        <p class="text-[15px] text-text-muted leading-relaxed text-justify m-0">
            Pasal ini memberikan tiga hak fundamental kepada masyarakat desa: hak atas informasi dan pengawasan, hak atas pelayanan yang adil, serta hak menyampaikan aspirasi. Pemenuhan hak-hak ini memerlukan sarana yang terbuka dan mudah dijangkau. Dengan ini desa harus dapat menyediakan informasi publik secara lengkap, saluran resmi untuk menyampaikan pendapat. Keberadaan <a href="{{ route('publik.aspirasi') }}" class="text-primary font-bold hover:underline">formulir aspirasi daring</a> juga menjadi wujud nyata dari hak partisipasi masyarakat.
        </p>

    </div>
</main>
@endsection