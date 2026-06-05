@extends('layouts.app')

@section('title', 'Berita & Artikel Desa Gunung Sembung')

@section('content')

<header class="relative py-[80px] mb-[40px] text-center text-white bg-[url('https://cdn.pixabay.com/photo/2014/07/06/13/55/indonesia-385554_1280.jpg')] bg-cover bg-center">
    <div class="absolute inset-0 bg-primary/85 mix-blend-multiply"></div>

    <div class="container relative z-10 mx-auto px-5 max-w-6xl">
        <h1 class="m-0 mb-[15px] text-[30px] md:text-[40px] font-bold">Kabar Berita Desa</h1>
        <p class="text-[18px] max-w-[700px] mx-auto opacity-90">
            Ikuti perkembangan terbaru, kegiatan pembangunan, dan berbagai artikel menarik seputar aktivitas warga Desa Gunung Sembung.
        </p>
    </div>
</header>

<main class="container mx-auto px-5 max-w-5xl"> <div class="flex justify-center flex-wrap gap-[15px] mb-[40px]">
        <button data-filter="all" class="filter-btn bg-primary text-white border border-primary px-[25px] py-[10px] rounded-full cursor-pointer font-semibold transition-all duration-300">
            Semua Berita
        </button>
        <button data-filter="Pemerintahan" class="filter-btn bg-white text-text-muted border border-text-muted px-[25px] py-[10px] rounded-full cursor-pointer font-semibold transition-all duration-300 hover:bg-primary hover:text-white hover:border-primary">
            Pemerintahan
        </button>
        <button data-filter="Infrastruktur" class="filter-btn bg-white text-text-muted border border-text-muted px-[25px] py-[10px] rounded-full cursor-pointer font-semibold transition-all duration-300 hover:bg-primary hover:text-white hover:border-primary">
            Infrastruktur
        </button>
        <button data-filter="Sosial & Budaya" class="filter-btn bg-white text-text-muted border border-text-muted px-[25px] py-[10px] rounded-full cursor-pointer font-semibold transition-all duration-300 hover:bg-primary hover:text-white hover:border-primary">
            Sosial Budaya
        </button>
        <button data-filter="Ekonomi & BUMDes" class="filter-btn bg-white text-text-muted border border-text-muted px-[25px] py-[10px] rounded-full cursor-pointer font-semibold transition-all duration-300 hover:bg-primary hover:text-white hover:border-primary">
            Ekonomi & BUMDes
        </button>
    </div>

    <div class="flex flex-col gap-[30px] mb-[60px]">

        @forelse($dataBerita as $berita)
        <div data-category="{{ $berita->kategori }}" class="berita-list-item flex flex-col md:flex-row gap-[25px] bg-white rounded-xl p-[20px] border border-border shadow-sm hover:shadow-md transition-all duration-300 group">
            
            <a href="{{ url('/berita/' . $berita->slug) }}" class="w-full md:w-[320px] h-[200px] shrink-0 rounded-lg overflow-hidden relative block">
                @if($berita->gambar_sampul_url)
                <img src="{{ asset('storage/' . $berita->gambar_sampul_url) }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                <div class="w-full h-full bg-[#E2E8F0] flex flex-col items-center justify-center text-[#94A3B8]">
                    <span class="text-[40px] mb-2">📰</span>
                    <span class="font-medium text-[14px]">Tanpa Gambar</span>
                </div>
                @endif
                <span class="absolute top-[10px] left-[10px] bg-primary-light text-white text-[11px] font-bold px-[12px] py-[4px] rounded-md uppercase tracking-wider shadow-sm">
                    {{ $berita->kategori }}
                </span>
            </a>

            <div class="flex flex-col flex-1 justify-center">
                <div class="text-[13px] text-text-muted font-medium mb-[10px] flex items-center gap-[10px]">
                    <span class="flex items-center gap-[5px]">🗓️ {{ $berita->updated_at->format('d M Y') }}</span>
                    <span>•</span>
                    <span class="flex items-center gap-[5px]">✍️ {{ $berita->penulis->nama_lengkap ?? 'Admin' }}</span>
                </div>
                
                <a href="{{ url('/berita/' . $berita->slug) }}" class="no-underline">
                    <h3 class="m-0 mb-[12px] text-[22px] md:text-[24px] text-text-main font-bold line-clamp-2 group-hover:text-primary transition-colors leading-snug">
                        {{ $berita->judul }}
                    </h3>
                </a>
                
                <p class="text-text-muted text-[15px] mb-[20px] line-clamp-3 leading-relaxed">
                    {{ Str::limit(strip_tags($berita->konten), 180) }}
                </p>

                <div class="mt-auto">
                    <a href="{{ url('/berita/' . $berita->slug) }}" class="inline-flex items-center gap-[5px] text-primary font-semibold transition-all duration-200 hover:gap-[8px]">
                        Baca Artikel Lengkap <span>→</span>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-[60px] px-5 text-text-muted bg-gray-50 rounded-xl border border-dashed border-border">
            <span class="text-[50px] mb-[15px] block">📭</span>
            <h3 class="text-[20px] font-bold text-text-main">Belum ada berita</h3>
            <p>Berita dan artikel terbaru akan segera hadir di sini.</p>
        </div>
        @endforelse

    </div>

    <div class="mb-[60px] flex justify-center">
        {{ $dataBerita->links() }}
    </div>

</main>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const lists = document.querySelectorAll('.berita-list-item'); 

        const activeClasses = ['bg-primary', 'text-white', 'border-primary'];
        const inactiveClasses = ['bg-white', 'text-text-muted', 'border-text-muted'];

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                filterBtns.forEach(b => {
                    b.classList.remove(...activeClasses);
                    b.classList.add(...inactiveClasses);
                });
                this.classList.remove(...inactiveClasses);
                this.classList.add(...activeClasses);

                const filterValue = this.getAttribute('data-filter');

                lists.forEach(item => {
                    const itemCategory = item.getAttribute('data-category');

                    if (filterValue === 'all' || filterValue === itemCategory) {
                        item.classList.remove('hidden');
                        // Tetap gunakan flex karena base class-nya menggunakan flex (row/col)
                        item.classList.add('flex'); 
                        item.style.opacity = '0';
                        setTimeout(() => { item.style.opacity = '1'; }, 50);
                    } else {
                        item.classList.add('hidden');
                        item.classList.remove('flex');
                    }
                });
            });
        });
    });
</script>
@endpush