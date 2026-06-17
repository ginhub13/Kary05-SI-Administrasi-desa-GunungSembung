@extends('layouts.admin')

@section('title', 'Laporan Pemerintahan - SID Gunung Sembung')

@section('content')
<div class="flex flex-col gap-[25px]">
    
    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="bg-green-50 border-l-[4px] border-green-500 p-[15px] rounded-[8px] text-green-700 text-[14px] font-medium shadow-sm flex items-center gap-[10px]">
            <span>✅</span> {{ session('success') }}
        </div>
    @endif

    {{-- Notifikasi Error --}}
    @if(session('error'))
        <div class="bg-red-50 border-l-[4px] border-red-500 p-[15px] rounded-[8px] text-red-700 text-[14px] font-medium shadow-sm flex items-center gap-[10px]">
            <span>❌</span> {{ session('error') }}
        </div>
    @endif

    {{-- Error Validasi --}}
    @if($errors->any())
        <div class="bg-red-50 border-l-[4px] border-red-500 p-[15px] rounded-[8px] text-red-700 text-[14px] font-medium shadow-sm flex flex-col gap-[5px]">
            @foreach($errors->all() as $error)
                <span>❌ {{ $error }}</span>
            @endforeach
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-[15px]">
        <div>
            <h1 class="text-[24px] font-bold text-text-main">Laporan Pemerintahan</h1>
            <p class="text-text-muted text-[14px]">Kelola dokumen LPPD, LKPPD, dan ILPPD desa.</p>
        </div>
        
        <button onclick="openModal()" class="bg-primary-light text-white px-[20px] py-[10px] rounded-[8px] font-semibold text-[14px] hover:brightness-110 transition-all flex items-center gap-[8px] cursor-pointer shadow-sm">
            <span>📄</span> Unggah Laporan
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[20px]">
        @forelse($dokumenPemerintahan as $dokumen)
        <div class="bg-white border border-border rounded-[12px] p-[20px] shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">
            <div class="flex items-start gap-[15px]">
                <div class="bg-red-50 text-red-500 w-[45px] h-[45px] rounded-[10px] flex items-center justify-center text-[24px] shrink-0 border border-blue-100">
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
                    <span>⬇️</span> Lihat
                </a>
                <form action="{{ route('admin.pemerintahan.destroy', $dokumen->id) }}" method="POST" onsubmit="return confirm('Hapus dokumen ini?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700 text-[13px] font-semibold flex items-center gap-[5px] bg-transparent border-none cursor-pointer">
                        <span>🗑️</span> Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-gray-50 border border-border border-dashed rounded-[12px] p-[50px] text-center">
            <span class="text-[40px] block mb-[10px]">📭</span>
            <h3 class="text-[16px] font-bold text-text-main mb-[5px]">Belum Ada Dokumen</h3>
            <p class="text-text-muted text-[14px]">Klik tombol "Unggah Laporan" untuk menambahkan dokumen baru.</p>
        </div>
        @endforelse
    </div>
</div>

{{-- Modal Unggah --}}
<div id="uploadModal" class="fixed inset-0 bg-black/60 z-[100] hidden items-center justify-center opacity-0 transition-opacity duration-300 backdrop-blur-sm">
    <div id="modalContent" class="bg-white rounded-[12px] w-full max-w-[500px] shadow-xl transform scale-95 transition-transform duration-300 mx-[20px]">
        <div class="flex justify-between items-center p-[20px] border-b border-border">
            <div>
                <h2 class="text-[18px] font-bold text-text-main">Unggah Laporan Pemerintahan</h2>
                <p class="text-[12px] text-text-muted mt-[2px]">Format yang diizinkan hanya .PDF (Maks. 5MB)</p>
            </div>
            <button onclick="closeModal()" class="text-[#94A3B8] hover:text-red-500 text-[28px] leading-none cursor-pointer">&times;</button>
        </div>
        <form action="{{ route('admin.pemerintahan.store') }}" method="POST" enctype="multipart/form-data" class="p-[20px] flex flex-col gap-[15px]">
            @csrf
            <div>
                <label class="block text-[13px] font-bold mb-[8px] uppercase">Judul Dokumen <span class="text-red-500">*</span></label>
                <input type="text" name="judul_dokumen" value="{{ old('judul_dokumen') }}" required placeholder="Contoh: LKPPD Kepala Desa Tahun 2024" class="w-full bg-bg-color border border-border px-[15px] py-[10px] rounded-[8px] text-[14px]">
                @error('judul_dokumen')
                    <p class="text-red-500 text-[12px] mt-[5px] font-medium">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex gap-[15px]">
                <div class="flex-1">
                    <label class="block text-[13px] font-bold mb-[8px] uppercase">Kategori <span class="text-red-500">*</span></label>
                    <select name="kategori_dokumen" required class="w-full bg-bg-color border border-border px-[15px] py-[10px] rounded-[8px] text-[14px]">
                        <option value="" disabled {{ old('kategori_dokumen') ? '' : 'selected' }}>-- Pilih --</option>
                        <option value="LPPD" {{ old('kategori_dokumen') == 'LPPD' ? 'selected' : '' }}>LPPD</option>
                        <option value="LKPPD" {{ old('kategori_dokumen') == 'LKPPD' ? 'selected' : '' }}>LKPPD</option>
                        <option value="ILPPD" {{ old('kategori_dokumen') == 'ILPPD' ? 'selected' : '' }}>ILPPD</option>
                    </select>
                    @error('kategori_dokumen')
                        <p class="text-red-500 text-[12px] mt-[5px] font-medium">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-[120px]">
                    <label class="block text-[13px] font-bold mb-[8px] uppercase">Tahun <span class="text-red-500">*</span></label>
                    <input type="number" name="tahun" value="{{ old('tahun', date('Y')) }}" required class="w-full bg-bg-color border border-border px-[15px] py-[10px] rounded-[8px] text-[14px] text-center">
                    @error('tahun')
                        <p class="text-red-500 text-[12px] mt-[5px] font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div>
                <label class="block text-[13px] font-bold mb-[8px] uppercase">File (PDF) <span class="text-red-500">*</span></label>
                <input type="file" name="file_dokumen" accept=".pdf" required class="w-full bg-bg-color border border-border px-[15px] py-[8px] rounded-[8px] text-[14px] file:mr-[15px] file:py-[6px] file:px-[15px] file:rounded-[6px] file:border-0 file:bg-primary-light file:text-white cursor-pointer">
                @error('file_dokumen')
                    <p class="text-red-500 text-[12px] mt-[5px] font-medium">{{ $message }}</p>
                @enderror
            </div>
            <div class="pt-[15px] border-t border-border flex justify-end gap-[10px] mt-[5px]">
                <button type="button" onclick="closeModal()" class="bg-white border border-border px-[20px] py-[10px] rounded-[8px] font-semibold text-[14px]">Batal</button>
                <button type="submit" class="bg-primary-light text-white px-[25px] py-[10px] rounded-[8px] font-semibold text-[14px]">Unggah</button>
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
        modal.classList.remove('hidden'); modal.classList.add('flex');
        setTimeout(() => { modal.classList.remove('opacity-0'); modalContent.classList.remove('scale-95'); }, 10);
    }

    function closeModal() {
        modal.classList.add('opacity-0'); modalContent.classList.add('scale-95');
        setTimeout(() => { modal.classList.add('hidden'); modal.classList.remove('flex'); }, 300);
    }
</script>
@endpush