@extends('layouts.app')

@section('title', 'Potensi Desa Gunung Sembung')

@section('content')

<header class="relative py-[80px] mb-[40px] text-center text-white bg-[url('https://cdn.pixabay.com/photo/2017/09/28/22/26/landscape-2797315_1280.jpg')] bg-cover bg-center">
    <div class="absolute inset-0 bg-primary/85 mix-blend-multiply"></div>

    <div class="container relative z-10 mx-auto px-5 max-w-6xl">
        <h1 class="m-0 mb-[15px] text-[30px] md:text-[40px] font-bold">Potensi & UMKM Desa Gunung Sembung</h1>
        <p class="text-[18px] max-w-[700px] mx-auto opacity-90">
            Eksplorasi hasil bumi unggulan, sentra perdagangan, serta kerajinan masyarakat yang menjadi urat nadi perekonomian desa kami.
        </p>
    </div>
</header>

<main class="container mx-auto px-5 max-w-6xl">
    <div class="flex justify-center flex-wrap gap-[15px] mb-[40px]">
        <button data-filter="all" class="filter-btn bg-primary text-white border border-primary px-[25px] py-[10px] rounded-full cursor-pointer font-semibold transition-all duration-300">
            Semua Potensi
        </button>
        <button data-filter="Pertanian Pangan" class="filter-btn bg-white text-text-muted border border-text-muted px-[25px] py-[10px] rounded-full cursor-pointer font-semibold transition-all duration-300 hover:bg-primary hover:text-white hover:border-primary">
            Pertanian & Pangan
        </button>
        <button data-filter="UMKM Kriya" class="filter-btn bg-white text-text-muted border border-text-muted px-[25px] py-[10px] rounded-full cursor-pointer font-semibold transition-all duration-300 hover:bg-primary hover:text-white hover:border-primary">
            UMKM & Kriya
        </button>
        <button data-filter="Jasa & Perdagangan" class="filter-btn bg-white text-text-muted border border-text-muted px-[25px] py-[10px] rounded-full cursor-pointer font-semibold transition-all duration-300 hover:bg-primary hover:text-white hover:border-primary">
            Jasa & Perdagangan
        </button>
    </div>

    <div class="grid grid-cols-[repeat(auto-fill,minmax(300px,1fr))] gap-[30px] mb-[60px]">

        @forelse($data as $potensi)
        <div data-category="{{ $potensi->kategori }}" class="potensi-card bg-white rounded-xl overflow-hidden shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] flex flex-col transition-transform duration-300 hover:-translate-y-1.5 hover:shadow-[0_10px_15px_-3px_rgba(0,0,0,0.1)]">
            @if($potensi->gambar)
            <img src="{{ asset('storage/' . $potensi->gambar) }}" alt="{{ $potensi->judul }}" class="w-full h-[220px] object-cover">
            @else
            <div class="w-full h-[220px] bg-[#E2E8F0] flex items-center justify-center text-[#94A3B8]">
                Tanpa Gambar
            </div>
            @endif

            <div class="p-[25px] flex flex-col flex-grow">
                <span class="text-[12px] font-bold text-primary-light uppercase tracking-[1px] mb-[10px] inline-block">
                    {{ $potensi->kategori }}
                </span>
                <h3 class="m-0 mb-[10px] text-[20px] text-text-main font-bold">
                    {{ $potensi->judul }}
                </h3>
                <p class="text-text-muted text-[14px] mb-[20px] flex-grow">
                    {{ Str::limit($potensi->deskripsi_singkat, 100) }}
                </p>

                <a href="{{ url('/potensi/' . $potensi->slug) }}" class="inline-block text-center py-[10px] border border-primary text-primary no-underline font-semibold rounded-md transition-all duration-200 hover:bg-primary hover:text-white">
                    Lihat Detail
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-[50px] px-5 text-text-muted bg-white rounded-xl border border-dashed border-border">
            Belum ada data potensi desa yang dipublikasikan.
        </div>
        @endforelse

    </div>

    <div class="bg-primary-light text-white p-[30px] md:p-[50px] rounded-2xl text-center mb-[60px] relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>

        <h2 class="relative z-10 mt-0 text-[28px] font-bold mb-4">Ingin Bermitra atau Membeli Produk Kami?</h2>
        <p class="relative z-10 text-[16px] opacity-90 max-w-3xl mx-auto mb-6">
            Dukung perputaran ekonomi lokal dengan menggunakan produk dan jasa dari warga Desa Gunung Sembung. BUMDes "Gunung Sembung Nanjung" siap memfasilitasi kebutuhan Anda.
        </p>
        <a href="{{ url('/kontak') }}" class="relative z-10 inline-block bg-white text-primary px-[30px] py-[12px] no-underline font-bold rounded-full mt-[15px] transition-transform duration-200 hover:scale-105">
            Hubungi BUMDes Sekarang
        </a>
    </div>
</main>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const cards = document.querySelectorAll('.potensi-card');

        // Tailwind classes untuk state Aktif/Tidak Aktif pada tombol
        const activeClasses = ['bg-primary', 'text-white', 'border-primary'];
        const inactiveClasses = ['bg-white', 'text-text-muted', 'border-text-muted'];

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // 1. Ubah Style Tombol
                filterBtns.forEach(b => {
                    b.classList.remove(...activeClasses);
                    b.classList.add(...inactiveClasses);
                });
                this.classList.remove(...inactiveClasses);
                this.classList.add(...activeClasses);

                // 2. Logika Filter Konten
                const filterValue = this.getAttribute('data-filter');

                cards.forEach(card => {
                    const cardCategory = card.getAttribute('data-category');

                    // Jika filter 'all' atau kategori card cocok dengan tombol yang diklik
                    if (filterValue === 'all' || filterValue === cardCategory) {
                        // Tampilkan card: Hapus class hidden, pastikan class flex ada
                        card.classList.remove('hidden');
                        card.classList.add('flex');

                        card.style.opacity = '0';
                        setTimeout(() => {
                            card.style.opacity = '1';
                        }, 50);
                    } else {
                        // Sembunyikan card: Tambahkan class hidden, hapus class flex
                        card.classList.add('hidden');
                        card.classList.remove('flex');
                    }
                });
            });
        });
    });
</script>
@endpush