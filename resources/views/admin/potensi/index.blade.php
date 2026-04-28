@extends('layouts.admin')

@section('title', 'Kelola Potensi Desa - SID Gunung Sembung')

@section('content')

<div class="flex justify-between items-center mb-[30px]">
    <h1 class="m-0 text-[24px] text-text-main font-bold">Kelola Potensi Desa</h1>

    <a href="{{ route('admin.potensi.create') }}" class="bg-primary text-white px-[20px] py-[10px] rounded-[8px] font-semibold flex items-center gap-[8px] transition-colors duration-300 hover:bg-[#0F766E] no-underline">
        <span>+</span> Tambah Potensi Baru
    </a>
</div>

@if(session('success'))
<div class="bg-[#DCFCE7] text-[#16A34A] p-[15px] rounded-[8px] mb-[20px] border border-[#BBF7D0]">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-[12px] shadow-[0_1px_3px_rgba(0,0,0,0.05)] border border-border overflow-hidden overflow-x-auto">
    <table class="w-full border-collapse text-left min-w-max">
        <thead>
            <tr class="bg-[#F8FAFC] border-b border-border">
                <th class="w-[5%] px-[20px] py-[15px] text-text-muted font-semibold text-[13px] uppercase tracking-wide">No</th>
                <th class="w-[10%] px-[20px] py-[15px] text-text-muted font-semibold text-[13px] uppercase tracking-wide">Gambar</th>
                <th class="w-[30%] px-[20px] py-[15px] text-text-muted font-semibold text-[13px] uppercase tracking-wide">Judul Potensi</th>
                <th class="w-[20%] px-[20px] py-[15px] text-text-muted font-semibold text-[13px] uppercase tracking-wide">Kategori</th>
                <th class="w-[15%] px-[20px] py-[15px] text-text-muted font-semibold text-[13px] uppercase tracking-wide">Status</th>
                <th class="w-[20%] px-[20px] py-[15px] text-text-muted font-semibold text-[13px] uppercase tracking-wide">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $potensi)
            <tr class="border-b border-border last:border-none transition-colors duration-200 hover:bg-[#F8FAFC]">
                <td class="px-[20px] py-[15px] text-[14px] align-middle">{{ $index + 1 }}</td>
                <td class="px-[20px] py-[15px] align-middle">
                    @if($potensi->gambar)
                        <img src="{{ asset('storage/' . $potensi->gambar) }}" alt="{{ $potensi->judul }}" class="w-[60px] h-[40px] object-cover rounded-[6px]">
                    @else
                        <div class="w-[60px] h-[40px] bg-[#E2E8F0] rounded-[6px] flex items-center justify-center text-[10px] text-[#94A3B8]">
                            No Img
                        </div>
                    @endif
                </td>
                <td class="px-[20px] py-[15px] align-middle">
                    <strong class="text-text-main text-[15px] font-bold">{{ $potensi->judul }}</strong><br>
                    <span class="text-[12px] text-text-muted mt-[2px] inline-block">Pengelola: {{ $potensi->pengelola ?? '-' }}</span>
                </td>
                <td class="px-[20px] py-[15px] text-[14px] align-middle">{{ $potensi->kategori }}</td>
                <td class="px-[20px] py-[15px] align-middle">
                    <span class="px-[10px] py-[5px] rounded-full text-[12px] font-semibold inline-block {{ $potensi->status_publikasi == 'publish' ? 'bg-[#DCFCE7] text-[#16A34A]' : 'bg-[#F1F5F9] text-[#64748B]' }}">
                        {{ ucfirst($potensi->status_publikasi) }}
                    </span>
                </td>
                <td class="px-[20px] py-[15px] align-middle">
                    <a href="{{ route('admin.potensi.edit', $potensi->id) }}" class="mr-[15px] text-[#0284C7] no-underline font-semibold text-[13px] hover:underline">
                        Edit
                    </a>

                    <form action="{{ route('admin.potensi.destroy', $potensi->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-[#EF4444] cursor-pointer border-none bg-transparent p-0 font-sans font-semibold text-[13px] hover:underline">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center p-[30px] text-text-muted text-[14px]">Belum ada data potensi desa.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection