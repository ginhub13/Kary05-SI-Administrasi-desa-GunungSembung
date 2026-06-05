@extends('layouts.admin')

@section('title', 'Kelola Berita & Pengumuman - SID Gunung Sembung')

@section('content')
<div class="flex flex-col gap-[25px]">
    
    @if(session('success'))
        <div class="bg-green-50 border-l-[4px] border-green-500 p-[15px] rounded-[8px] text-green-700 text-[14px] font-medium shadow-sm">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-[24px] font-bold text-text-main">Berita & Pengumuman</h1>
            <p class="text-text-muted text-[14px]">Kelola artikel publikasi, informasi desa, dan pengumuman masyarakat.</p>
        </div>
        <a href="{{ route('admin.berita.create') }}" class="bg-primary-light text-white px-[20px] py-[10px] rounded-[8px] font-semibold text-[14px] hover:brightness-110 transition-all flex items-center gap-[8px]">
            <span>+</span> Tulis Artikel
        </a>
    </div>

    <div class="bg-white rounded-[12px] shadow-sm border border-border overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-border">
                    <th class="p-[15px_20px] text-[13px] font-bold text-text-main uppercase w-[40%]">Judul Artikel</th>
                    <th class="p-[15px_20px] text-[13px] font-bold text-text-main uppercase">Kategori</th>
                    <th class="p-[15px_20px] text-[13px] font-bold text-text-main uppercase text-center">Status</th>
                    <th class="p-[15px_20px] text-[13px] font-bold text-text-main uppercase">Tanggal Pembaruan</th>
                    <th class="p-[15px_20px] text-[13px] font-bold text-text-main uppercase text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-[14px]">
                @forelse($dataBerita ?? [] as $berita)
                <tr class="border-b border-border hover:bg-gray-50 transition-all">
                    <td class="p-[15px_20px]">
                        <div class="flex items-center gap-[15px]">
                            <div class="w-[60px] h-[45px] rounded-[6px] overflow-hidden bg-gray-200 shrink-0">
                                @if($berita->gambar_sampul_url)
                                    <img src="{{ asset('storage/' . $berita->gambar_sampul_url) }}" alt="Sampul" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400 text-[20px]">📰</div>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-bold text-text-main line-clamp-1 leading-snug">{{ $berita->judul }}</h3>
                                <p class="text-[12px] text-[#94A3B8] line-clamp-1">/berita/{{ $berita->slug }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="p-[15px_20px]">
                        <span class="bg-gray-100 text-gray-700 px-[10px] py-[4px] rounded-[6px] text-[12px] font-semibold border border-gray-200">
                            {{ $berita->kategori }}
                        </span>
                    </td>
                    <td class="p-[15px_20px] text-center">
                        @if($berita->status_terbit == 'Terbit')
                            <span class="bg-green-100 text-green-700 px-[10px] py-[4px] rounded-full text-[12px] font-bold">Terbit</span>
                        @else
                            <span class="bg-yellow-100 text-yellow-700 px-[10px] py-[4px] rounded-full text-[12px] font-bold">Draft</span>
                        @endif
                    </td>
                    <td class="p-[15px_20px] text-text-muted text-[13px]">
                        {{ $berita->updated_at->format('d M Y, H:i') }}
                    </td>
                    <td class="p-[15px_20px]">
                        <div class="flex justify-center gap-[15px]">
                            <a href="{{ route('admin.berita.edit', $berita->id) }}" class="text-blue-500 hover:text-blue-700 flex items-center gap-1 font-medium">
                                <span>✏️</span> Edit
                            </a>
                            <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus artikel ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 flex items-center gap-1 font-medium bg-transparent border-none cursor-pointer">
                                    <span>🗑️</span> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-[40px] text-center text-text-muted">
                        <span class="text-[30px] block mb-[10px]">📝</span>
                        Belum ada artikel berita atau pengumuman.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection