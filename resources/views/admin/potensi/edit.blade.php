@extends('layouts.admin')

@section('title', 'Edit Potensi - SID Gunung Sembung')

@section('content')

<div class="flex justify-between items-center mb-[30px]">
    <h1 class="m-0 text-[24px] text-text-main font-bold">Edit Data Potensi</h1>
    <a href="{{ route('admin.potensi.index') }}" class="bg-[#F1F5F9] text-text-muted px-[25px] py-[10px] rounded-[8px] no-underline font-semibold text-[15px] transition-colors duration-300 border border-border hover:bg-[#E2E8F0] hover:text-text-main">
        Kembali
    </a>
</div>

<div class="bg-white rounded-[12px] p-[30px] shadow-[0_1px_3px_rgba(0,0,0,0.05)] border border-border">
    <form action="{{ route('admin.potensi.update', $potensi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-[25px]">
            <label for="judul" class="block mb-[8px] font-semibold text-[14px] text-text-main">Judul Potensi *</label>
            <input type="text" name="judul" id="judul" class="w-full px-[15px] py-[12px] border border-border rounded-[8px] font-sans text-[14px] transition-all duration-300 bg-bg-color focus:outline-none focus:border-primary focus:bg-white focus:shadow-[0_0_0_3px_rgba(20,184,166,0.1)]" value="{{ old('judul', $potensi->judul) }}" placeholder="Masukkan Judul Potensi..." required>
            @error('judul') <span class="text-[#EF4444] text-[12px] mt-[5px] block">{{ $message }}</span> @enderror
        </div>

        <div class="mb-[15px]">
            <label class="block mb-[8px] font-semibold text-[14px] text-text-main">Foto Saat Ini</label>
            @if($potensi->gambar)
                <div class="relative w-[200px] h-[130px] rounded-[8px] overflow-hidden border border-border p-[5px] bg-white">
                    <img src="{{ asset('storage/' . $potensi->gambar) }}" alt="{{ $potensi->judul }}" class="w-full h-full object-cover rounded-[6px]">
                </div>
            @else
                <div class="w-[200px] h-[130px] bg-[#F1F5F9] rounded-[8px] border-2 border-dashed border-border flex flex-col items-center justify-center text-center p-[20px]">
                    <span class="text-[12px] text-[#94A3B8]">Belum ada foto</span>
                </div>
            @endif
        </div>

        <div class="mb-[25px]">
            <label for="gambar" class="block mb-[8px] font-semibold text-[14px] text-text-main">Ganti Foto (Opsional, Maks. 2MB)</label>
            <input type="file" name="gambar" id="gambar" class="w-full px-[15px] py-[12px] border border-border rounded-[8px] font-sans text-[14px] transition-all duration-300 bg-bg-color focus:outline-none focus:border-primary focus:bg-white focus:shadow-[0_0_0_3px_rgba(20,184,166,0.1)] file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-light file:text-white hover:file:bg-primary" accept="image/*">
            <span class="text-[12px] text-text-muted mt-[5px] block">Abaikan jika tidak ingin mengubah foto.</span>
            @error('gambar') <span class="text-[#EF4444] text-[12px] mt-[5px] block">{{ $message }}</span> @enderror
        </div>

        <div class="mb-[20px]">
            <label for="deskripsi_singkat" class="block mb-[8px] font-semibold text-[14px] text-text-main">Deskripsi Singkat *</label>
            <textarea name="deskripsi_singkat" id="deskripsi_singkat" class="w-full min-h-[120px] resize-y px-[15px] py-[12px] border border-border rounded-[8px] font-sans text-[14px] transition-all duration-300 bg-bg-color focus:outline-none focus:border-primary focus:bg-white focus:shadow-[0_0_0_3px_rgba(20,184,166,0.1)]" placeholder="Tuliskan ringkasan potensi di sini (maksimal 500 karakter)..." maxlength="500" required>{{ old('deskripsi_singkat', $potensi->deskripsi_singkat) }}</textarea>
            @error('deskripsi_singkat') <span class="text-[#EF4444] text-[12px] mt-[5px] block">{{ $message }}</span> @enderror
        </div>

        <div class="mb-[20px]">
            <label for="status_publikasi" class="block mb-[8px] font-semibold text-[14px] text-text-main">Status Publikasi *</label>
            <select name="status_publikasi" id="status_publikasi" class="w-full px-[15px] py-[12px] border border-border rounded-[8px] font-sans text-[14px] transition-all duration-300 bg-bg-color focus:outline-none focus:border-primary focus:bg-white focus:shadow-[0_0_0_3px_rgba(20,184,166,0.1)] cursor-pointer" required>
                <option value="publish" {{ old('status_publikasi', $potensi->status_publikasi) == 'publish' ? 'selected' : '' }}>Publish (Tampilkan)</option>
                <option value="draft" {{ old('status_publikasi', $potensi->status_publikasi) == 'draft' ? 'selected' : '' }}>Draft (Sembunyikan)</option>
            </select>
            @error('status_publikasi') <span class="text-[#EF4444] text-[12px] mt-[5px] block">{{ $message }}</span> @enderror
        </div>

        <div class="flex gap-[15px] mt-[40px] pt-[20px] border-t border-border">
            <button type="submit" class="bg-primary text-white border-none px-[30px] py-[12px] rounded-[8px] font-semibold text-[15px] cursor-pointer transition-colors duration-300 hover:bg-[#0F766E]">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.potensi.index') }}" class="bg-[#F1F5F9] text-text-muted px-[25px] py-[12px] rounded-[8px] no-underline font-semibold text-[15px] transition-colors duration-300 border border-border hover:bg-[#E2E8F0] hover:text-text-main">
                Batal
            </a>
        </div>

    </form>
</div>
@endsection