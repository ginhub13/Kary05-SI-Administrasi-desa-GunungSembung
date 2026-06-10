@extends('layouts.app')

@section('title', 'Transparansi Pembangunan - Desa Gunung Sembung')

@section('content')

<header class="relative py-[80px] mb-[40px] text-center text-white bg-[url('https://cdn.pixabay.com/photo/2018/03/11/20/29/construction-3218641_1280.jpg')] bg-cover bg-center">
    <div class="absolute inset-0 bg-[#0F172A]/85 mix-blend-multiply"></div> 

    <div class="container relative z-10 mx-auto px-5 max-w-6xl">
        <h1 class="m-0 mb-[15px] text-[30px] md:text-[40px] font-bold">Transparansi Pembangunan</h1>
        <p class="text-[18px] max-w-[700px] mx-auto opacity-90">
            Akses dan unduh dokumen perencanaan pembangunan desa seperti RPJMDes dan RKPDes secara terbuka.
        </p>
    </div>
</header>

<main class="container mx-auto px-5 max-w-6xl mb-[80px]">

    {{-- Filter Kategori --}}
    <div class="flex justify-center flex-wrap gap-[15px] mb-[40px]">
        <button data-filter="all" class="filter-btn bg-primary text-white border border-primary px-[25px] py-[10px] rounded-full cursor-pointer font-semibold transition-all duration-300 shadow-sm">
            Semua Dokumen
        </button>
        <button data-filter="RPJMDes" class="filter-btn bg-white text-text-muted border border-text-muted px-[25px] py-[10px] rounded-full cursor-pointer font-semibold transition-all duration-300 hover:bg-primary hover:text-white hover:border-primary">
            RPJMDes
        </button>
        <button data-filter="RKPDes" class="filter-btn bg-white text-text-muted border border-text-muted px-[25px] py-[10px] rounded-full cursor-pointer font-semibold transition-all duration-300 hover:bg-primary hover:text-white hover:border-primary">
            RKPDes
        </button>
    </div>

    {{-- Grid Dokumen --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[25px]">
        @forelse($dokumenPembangunan as $dokumen)
        <div data-category="{{ $dokumen->kategori_dokumen }}" class="dokumen-card bg-white border border-border rounded-[16px] p-[25px] shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 flex flex-col justify-between group">
            
            <div class="flex items-start gap-[15px]">
                <div class="bg-red-50 text-red-500 w-[50px] h-[50px] rounded-[12px] flex items-center justify-center text-[24px] shrink-0 group-hover:bg-red-500 group-hover:text-white transition-colors duration-300">
                    📄
                </div>
                <div>
                    <div class="flex flex-wrap items-center gap-[8px] mb-[8px]">
                        <span class="bg-primary-light/10 text-primary-light border border-primary-light/20 px-[8px] py-[2px] rounded-[6px] text-[11px] font-bold uppercase tracking-wide">
                            {{ $dokumen->kategori_dokumen }}
                        </span>
                        <span class="text-[12px] text-text-muted font-bold border-l border-border pl-[8px]">
                            Th. {{ $dokumen->tahun }}
                        </span>
                    </div>
                    <h3 class="text-[16px] font-bold text-text-main line-clamp-2 leading-snug mb-[5px] group-hover:text-primary transition-colors">
                        {{ $dokumen->judul_dokumen }}
                    </h3>
                    <p class="text-[12px] text-text-muted font-medium m-0">Ukuran file: {{ $dokumen->ukuran_file_kb }} KB</p>
                </div>
            </div>
            
            <div class="mt-[20px] pt-[20px] border-t border-border border-dashed">
                <a href="{{ asset('storage/' . $dokumen->file_path) }}" target="_blank" class="flex items-center justify-center gap-[8px] w-full bg-gray-50 border border-border text-text-main py-[10px] rounded-[8px] font-semibold text-[13px] hover:bg-primary hover:text-white hover:border-primary transition-all duration-300">
                    <span>⬇️</span> Unduh Dokumen PDF
                </a>
            </div>

        </div>
        @empty
        <div class="col-span-full py-[60px] text-center bg-gray-50 rounded-[16px] border border-dashed border-border">
            <span class="text-[40px] block mb-[10px]">📭</span>
            <h3 class="text-[18px] font-bold text-text-main mb-[5px]">Belum Ada Dokumen Perencanaan</h3>
            <p class="text-text-muted text-[14px]">Dokumen transparansi pembangunan akan segera dipublikasikan di sini.</p>
        </div>
        @endforelse
    </div>

</main>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const cards = document.querySelectorAll('.dokumen-card');

        const activeClasses = ['bg-primary', 'text-white', 'border-primary', 'shadow-sm'];
        const inactiveClasses = ['bg-white', 'text-text-muted', 'border-text-muted'];

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Hapus style aktif dari semua tombol
                filterBtns.forEach(b => {
                    b.classList.remove(...activeClasses);
                    b.classList.add(...inactiveClasses);
                });
                
                // Tambahkan style aktif ke tombol yang diklik
                this.classList.remove(...inactiveClasses);
                this.classList.add(...activeClasses);

                // Logika Filter
                const filterValue = this.getAttribute('data-filter');

                cards.forEach(card => {
                    const cardCategory = card.getAttribute('data-category');

                    if (filterValue === 'all' || filterValue === cardCategory) {
                        card.classList.remove('hidden');
                        card.classList.add('flex');
                        card.style.opacity = '0';
                        setTimeout(() => { card.style.opacity = '1'; }, 50);
                    } else {
                        card.classList.add('hidden');
                        card.classList.remove('flex');
                    }
                });
            });
        });
    });
</script>
@endpush