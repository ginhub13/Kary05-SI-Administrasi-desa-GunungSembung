@extends('layouts.admin')

@section('title', 'Kelola Keuangan Desa - SID Gunung Sembung')

@section('content')
<div class="flex flex-col gap-[25px]">
    
    @if(session('success'))
        <div class="bg-green-50 border-l-[4px] border-green-500 p-[15px] rounded-[8px] text-green-700 text-[14px] font-medium shadow-sm flex items-center gap-[10px]">
            <span>✅</span> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-50 border-l-[4px] border-red-500 p-[15px] rounded-[8px] text-red-700 text-[14px] font-medium shadow-sm flex items-center gap-[10px]">
            <span>❌</span> {{ session('error') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-[15px]">
        <div>
            <h1 class="text-[24px] font-bold text-text-main">Laporan Keuangan Desa</h1>
            <p class="text-text-muted text-[14px]">Unggah dan kelola dokumen APBDes, Realisasi, dan LKPJ dalam format PDF.</p>
        </div>
        
        <button onclick="openModal()" class="bg-primary-light text-white px-[20px] py-[10px] rounded-[8px] font-semibold text-[14px] hover:brightness-110 transition-all flex items-center gap-[8px] cursor-pointer shadow-sm">
            <span>📄</span> Unggah Laporan Baru
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[20px]">
        @forelse($dokumenKeuangan as $dokumen)
        <div class="bg-white border border-border rounded-[12px] p-[20px] shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">
            <div class="flex items-start gap-[15px]">
                <div class="bg-red-50 text-red-500 w-[45px] h-[45px] rounded-[10px] flex items-center justify-center text-[24px] shrink-0 border border-red-100">
                    📄
                </div>
                <div>
                    <h3 class="text-[15px] font-bold text-text-main line-clamp-2 leading-tight mb-[8px]" title="{{ $dokumen->judul_dokumen }}">
                        {{ $dokumen->judul_dokumen }}
                    </h3>
                    <div class="flex items-center gap-[8px] mb-[5px]">
                        <span class="bg-primary-light/10 text-primary-light border border-primary-light/20 px-[8px] py-[2px] rounded-[4px] text-[11px] font-bold uppercase tracking-wide">
                            {{ $dokumen->kategori_dokumen }}
                        </span>
                        <span class="text-[12px] text-text-muted font-bold border-l border-border pl-[8px]">
                            Th. {{ $dokumen->tahun }}
                        </span>
                    </div>
                    <span class="text-[11px] text-text-muted font-medium">Ukuran: {{ $dokumen->ukuran_file_kb }} KB</span>
                </div>
            </div>
            
            <div class="mt-[20px] pt-[15px] border-t border-border flex justify-between items-center">
                <a href="{{ asset('storage/' . $dokumen->file_path) }}" target="_blank" class="text-blue-600 hover:text-blue-800 font-semibold text-[13px] flex items-center gap-[5px] transition-colors">
                    <span>⬇️</span> Unduh / Lihat
                </a>
                <form action="{{ route('admin.keuangan.destroy', $dokumen->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus dokumen laporan ini secara permanen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700 text-[13px] font-semibold flex items-center gap-[5px] bg-transparent border-none cursor-pointer transition-colors">
                        <span>🗑️</span> Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-gray-50 border border-border border-dashed rounded-[12px] p-[50px] text-center">
            <span class="text-[40px] block mb-[10px]">📭</span>
            <h3 class="text-[16px] font-bold text-text-main mb-[5px]">Belum Ada Dokumen Keuangan</h3>
            <p class="text-text-muted text-[14px]">Klik tombol "Unggah Laporan Baru" di sudut kanan atas untuk menambahkan file PDF.</p>
        </div>
        @endforelse
    </div>
</div>

<div id="uploadModal" class="fixed inset-0 bg-black/60 z-[100] hidden items-center justify-center opacity-0 transition-opacity duration-300 backdrop-blur-sm">
    <div id="modalContent" class="bg-white rounded-[12px] w-full max-w-[500px] shadow-xl transform scale-95 transition-transform duration-300 mx-[20px]">
        
        <div class="flex justify-between items-center p-[20px] border-b border-border">
            <div>
                <h2 class="text-[18px] font-bold text-text-main">Unggah Dokumen Keuangan</h2>
                <p class="text-[12px] text-text-muted mt-[2px]">Format yang diizinkan hanya .PDF (Maks. 5MB)</p>
            </div>
            <button onclick="closeModal()" class="text-[#94A3B8] hover:text-red-500 text-[28px] leading-none cursor-pointer transition-colors">&times;</button>
        </div>

        <form action="{{ route('admin.keuangan.store') }}" method="POST" enctype="multipart/form-data" class="p-[20px] flex flex-col gap-[15px]">
            @csrf
            
            <div>
                <label class="block text-[13px] font-bold mb-[8px] uppercase text-text-main">Judul Dokumen <span class="text-red-500">*</span></label>
                <input type="text" name="judul_dokumen" required placeholder="Contoh: Laporan Realisasi APBDes 2024" class="w-full bg-bg-color border border-border px-[15px] py-[10px] rounded-[8px] text-[14px] text-text-main outline-none focus:border-primary-light transition-colors">
            </div>
            
            <div class="flex flex-col md:flex-row gap-[15px]">
                <div class="flex-1">
                    <label class="block text-[13px] font-bold mb-[8px] uppercase text-text-main">Kategori Laporan <span class="text-red-500">*</span></label>
                    <select name="kategori_dokumen" required class="w-full bg-bg-color border border-border px-[15px] py-[10px] rounded-[8px] text-[14px] text-text-main outline-none focus:border-primary-light transition-colors cursor-pointer appearance-none">
                        <option value="" disabled selected>-- Pilih --</option>
                        <option value="APBDes">APBDes</option>
                        <option value="Realisasi">Laporan Realisasi</option>
                        <option value="LKPJ">LKPJ</option>
                    </select>
                </div>
                <div class="w-full md:w-[120px]">
                    <label class="block text-[13px] font-bold mb-[8px] uppercase text-text-main">Tahun <span class="text-red-500">*</span></label>
                    <input type="number" name="tahun" required value="{{ date('Y') }}" class="w-full bg-bg-color border border-border px-[15px] py-[10px] rounded-[8px] text-[14px] text-text-main outline-none focus:border-primary-light transition-colors text-center font-bold">
                </div>
            </div>

            <div>
                <label class="block text-[13px] font-bold mb-[8px] uppercase text-text-main">Pilih File (PDF) <span class="text-red-500">*</span></label>
                <input type="file" name="file_dokumen" accept=".pdf" required class="w-full bg-bg-color border border-border px-[15px] py-[8px] rounded-[8px] text-[14px] text-text-muted file:mr-[15px] file:py-[6px] file:px-[15px] file:rounded-[6px] file:border-0 file:text-[13px] file:font-semibold file:bg-primary-light file:text-white hover:file:bg-opacity-90 cursor-pointer transition-colors">
            </div>

            <div class="pt-[15px] border-t border-border flex justify-end gap-[10px] mt-[5px]">
                <button type="button" onclick="closeModal()" class="bg-white border border-border text-text-main px-[20px] py-[10px] rounded-[8px] font-semibold text-[14px] hover:bg-gray-50 transition-colors cursor-pointer">Batal</button>
                <button type="submit" class="bg-primary-light text-white px-[25px] py-[10px] rounded-[8px] font-semibold text-[14px] hover:brightness-110 transition-all cursor-pointer">Mulai Unggah</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const modal = document.getElementById('uploadModal');
    const modalContent = document.getElementById('modalContent');

    function openModal() {
        modal.classList.remove('hidden'); 
        modal.classList.add('flex');
        // Sedikit delay agar transisi CSS berjalan
        setTimeout(() => { 
            modal.classList.remove('opacity-0'); 
            modalContent.classList.remove('scale-95'); 
        }, 10);
    }

    function closeModal() {
        modal.classList.add('opacity-0'); 
        modalContent.classList.add('scale-95');
        // Tunggu animasi selesai sebelum menyembunyikan elemen
        setTimeout(() => { 
            modal.classList.add('hidden'); 
            modal.classList.remove('flex'); 
        }, 300);
    }

    // Menutup modal jika area gelap di luar form diklik
    modal.addEventListener('click', function(e) {
        if(e.target === modal) {
            closeModal();
        }
    });
</script>
@endpush