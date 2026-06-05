@extends('layouts.app')

@section('title', $berita->judul . ' - Desa Gunung Sembung')

@section('content')

<div class="bg-gray-50 border-b border-border py-[15px]">
    <div class="container mx-auto px-5 max-w-6xl flex items-center gap-[10px] text-[14px] text-text-muted">
        <a href="{{ url('/') }}" class="hover:text-primary transition-colors">Beranda</a>
        <span>/</span>
        <a href="{{ route('publik.berita.index') }}" class="hover:text-primary transition-colors">Berita</a>
        <span>/</span>
        <span class="text-text-main font-semibold line-clamp-1">{{ $berita->judul }}</span>
    </div>
</div>

<main class="container mx-auto px-5 max-w-6xl py-[40px] md:py-[60px]">
    <div class="flex flex-col lg:flex-row gap-[40px]">
        
        <article class="flex-1 max-w-[800px]">
            
            <div class="mb-[30px]">
                <span class="inline-block bg-primary-light text-white text-[12px] font-bold px-[12px] py-[4px] rounded-md uppercase tracking-wider mb-[15px]">
                    {{ $berita->kategori }}
                </span>
                
                <h1 class="text-[28px] md:text-[36px] font-bold text-text-main leading-tight mb-[15px]">
                    {{ $berita->judul }}
                </h1>
                
                <div class="flex flex-wrap items-center gap-[15px] text-[14px] text-text-muted font-medium border-y border-border py-[12px]">
                    <span class="flex items-center gap-[5px]">🗓️ Diterbitkan: {{ $berita->updated_at->format('d M Y, H:i') }} WIB</span>
                    <span class="hidden md:inline">•</span>
                    <span class="flex items-center gap-[5px]">✍️ Oleh: {{ $berita->penulis->nama_lengkap ?? 'Admin Desa' }}</span>
                </div>
            </div>

            @if($berita->gambar_sampul_url)
            <div class="mb-[30px] rounded-xl overflow-hidden shadow-sm border border-border">
                <img src="{{ asset('storage/' . $berita->gambar_sampul_url) }}" alt="{{ $berita->judul }}" class="w-full object-cover max-h-[450px]">
            </div>
            @endif

            <div class="prose prose-lg max-w-none text-text-main leading-relaxed 
                        [&>p]:mb-[20px] 
                        [&>h2]:text-[24px] [&>h2]:font-bold [&>h2]:mt-[30px] [&>h2]:mb-[15px] 
                        [&>h3]:text-[20px] [&>h3]:font-bold [&>h3]:mt-[25px] [&>h3]:mb-[10px] 
                        [&>ul]:list-disc [&>ul]:pl-[20px] [&>ul]:mb-[20px] 
                        [&>ol]:list-decimal [&>ol]:pl-[20px] [&>ol]:mb-[20px] 
                        [&>li]:mb-[5px]
                        [&>blockquote]:border-l-[4px] [&>blockquote]:border-primary [&>blockquote]:pl-[15px] [&>blockquote]:italic [&>blockquote]:text-text-muted [&>blockquote]:mb-[20px]
                        [&>a]:text-blue-500 [&>a]:underline hover:[&>a]:text-blue-700">
                {!! $berita->konten !!}
            </div>

        </article>

        <aside class="w-full lg:w-[350px] shrink-0">
            <div class="bg-white rounded-xl border border-border p-[25px] sticky top-[20px]">
                <h3 class="text-[18px] font-bold text-text-main border-b-2 border-primary pb-[10px] mb-[20px] inline-block">
                    Berita Terbaru Lainnya
                </h3>
                
                <div class="flex flex-col gap-[20px]">
                    @forelse($beritaLainnya as $item)
                    <a href="{{ url('/berita/' . $item->slug) }}" class="flex gap-[15px] group">
                        <div class="w-[90px] h-[70px] shrink-0 rounded-md overflow-hidden bg-gray-100">
                            @if($item->gambar_sampul_url)
                            <img src="{{ asset('storage/' . $item->gambar_sampul_url) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400 text-[20px]">📰</div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h4 class="text-[14px] font-bold text-text-main line-clamp-2 leading-tight group-hover:text-primary transition-colors mb-[5px]">
                                {{ $item->judul }}
                            </h4>
                            <span class="text-[11px] text-text-muted font-medium">{{ $item->updated_at->format('d M Y') }}</span>
                        </div>
                    </a>
                    @empty
                    <p class="text-[13px] text-text-muted italic">Belum ada berita lainnya.</p>
                    @endforelse
                </div>

                <a href="{{ route('publik.berita.index') }}" class="block text-center mt-[25px] text-[14px] font-bold text-primary hover:underline">
                    Lihat Semua Berita →
                </a>
            </div>
        </aside>

    </div>
</main>
@endsection