@extends('layouts.admin')

@section('title', 'Tambah Potensi - SID Gunung Sembung')

@section('content')

<div class="flex justify-between items-center mb-[30px]">
    <h1 class="m-0 text-[24px] text-text-main font-bold">Tambah Potensi Baru</h1>
    <a href="{{ route('admin.potensi.index') }}" class="bg-[#F1F5F9] text-text-muted px-[25px] py-[10px] rounded-[8px] no-underline font-semibold text-[15px] transition-colors duration-300 border border-border hover:bg-[#E2E8F0] hover:text-text-main">
        Kembali
    </a>
</div>

<div class="bg-white rounded-[12px] p-[30px] shadow-[0_1px_3px_rgba(0,0,0,0.05)] border border-border">
    <form action="{{ route('admin.potensi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-[20px]">
            <div class="mb-[20px]">
                <label for="judul" class="block mb-[8px] font-semibold text-[14px] text-text-main">Judul Potensi / Produk *</label>
                <input type="text" name="judul" id="judul" class="w-full px-[15px] py-[12px] border border-border rounded-[8px] font-sans text-[14px] transition-all duration-300 bg-bg-color focus:outline-none focus:border-primary focus:bg-white focus:shadow-[0_0_0_3px_rgba(20,184,166,0.1)]" value="{{ old('judul') }}" placeholder="Contoh: Beras Premium Pagaden" required>
                @error('judul') <span class="text-[#EF4444] text-[12px] mt-[5px] block">{{ $message }}</span> @enderror
            </div>

            <div class="mb-[20px]">
                <label for="kategori" class="block mb-[8px] font-semibold text-[14px] text-text-main">Kategori *</label>
                <select name="kategori" id="kategori" class="w-full px-[15px] py-[12px] border border-border rounded-[8px] font-sans text-[14px] transition-all duration-300 bg-bg-color focus:outline-none focus:border-primary focus:bg-white focus:shadow-[0_0_0_3px_rgba(20,184,166,0.1)] cursor-pointer" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Pertanian Pangan" {{ old('kategori') == 'Pertanian Pangan' ? 'selected' : '' }}>Pertanian Pangan</option>
                    <option value="UMKM Kriya" {{ old('kategori') == 'UMKM Kriya' ? 'selected' : '' }}>UMKM Kriya</option>
                    <option value="Jasa & Perdagangan" {{ old('kategori') == 'Jasa & Perdagangan' ? 'selected' : '' }}>Jasa & Perdagangan</option>
                    <option value="Ekowisata" {{ old('kategori') == 'Ekowisata' ? 'selected' : '' }}>Ekowisata</option>
                </select>
                @error('kategori') <span class="text-[#EF4444] text-[12px] mt-[5px] block">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-[20px]">
            <label for="gambar" class="block mb-[8px] font-semibold text-[14px] text-text-main">Gambar Utama (Maks. 2MB)</label>
            <input type="file" name="gambar" id="gambar" class="w-full px-[15px] py-[12px] border border-border rounded-[8px] font-sans text-[14px] transition-all duration-300 bg-bg-color focus:outline-none focus:border-primary focus:bg-white focus:shadow-[0_0_0_3px_rgba(20,184,166,0.1)] file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-light file:text-white hover:file:bg-primary" accept="image/*">
            @error('gambar') <span class="text-[#EF4444] text-[12px] mt-[5px] block">{{ $message }}</span> @enderror
        </div>

        <div class="mb-[20px]">
            <label for="deskripsi_singkat" class="block mb-[8px] font-semibold text-[14px] text-text-main">Deskripsi Singkat (Tampil di halaman depan) *</label>
            <textarea name="deskripsi_singkat" id="deskripsi_singkat" class="w-full min-h-[100px] resize-y px-[15px] py-[12px] border border-border rounded-[8px] font-sans text-[14px] transition-all duration-300 bg-bg-color focus:outline-none focus:border-primary focus:bg-white focus:shadow-[0_0_0_3px_rgba(20,184,166,0.1)]" maxlength="200" placeholder="Tuliskan ringkasan maksimal 200 karakter..." required>{{ old('deskripsi_singkat') }}</textarea>
            @error('deskripsi_singkat') <span class="text-[#EF4444] text-[12px] mt-[5px] block">{{ $message }}</span> @enderror
        </div>

        <div class="mb-[20px]">
            <label for="deskripsi_lengkap" class="block mb-[8px] font-semibold text-[14px] text-text-main">Deskripsi Lengkap *</label>
            <textarea name="deskripsi_lengkap" id="deskripsi_lengkap" class="w-full min-h-[200px] resize-y px-[15px] py-[12px] border border-border rounded-[8px] font-sans text-[14px] transition-all duration-300 bg-bg-color focus:outline-none focus:border-primary focus:bg-white focus:shadow-[0_0_0_3px_rgba(20,184,166,0.1)]" placeholder="Tuliskan penjelasan detail di sini..." required>{{ old('deskripsi_lengkap') }}</textarea>
            @error('deskripsi_lengkap') <span class="text-[#EF4444] text-[12px] mt-[5px] block">{{ $message }}</span> @enderror
        </div>

        <h3 class="text-[16px] text-primary border-b border-border pb-[10px] mt-[30px] mb-[20px] font-bold">Informasi Pemesanan & Pengelola (Opsional)</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-[20px]">
            <div class="mb-[20px]">
                <label for="harga" class="block mb-[8px] font-semibold text-[14px] text-text-main">Harga</label>
                <input type="text" name="harga" id="harga" class="w-full px-[15px] py-[12px] border border-border rounded-[8px] font-sans text-[14px] transition-all duration-300 bg-bg-color focus:outline-none focus:border-primary focus:bg-white focus:shadow-[0_0_0_3px_rgba(20,184,166,0.1)]" value="{{ old('harga') }}" placeholder="Contoh: Rp 65.000 / 250 gram">
            </div>
            <div class="mb-[20px]">
                <label for="kondisi" class="block mb-[8px] font-semibold text-[14px] text-text-main">Kondisi Barang</label>
                <input type="text" name="kondisi" id="kondisi" class="w-full px-[15px] py-[12px] border border-border rounded-[8px] font-sans text-[14px] transition-all duration-300 bg-bg-color focus:outline-none focus:border-primary focus:bg-white focus:shadow-[0_0_0_3px_rgba(20,184,166,0.1)]" value="{{ old('kondisi') }}" placeholder="Contoh: Baru / Fresh">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-[20px]">
            <div class="mb-[20px]">
                <label for="status_stok" class="block mb-[8px] font-semibold text-[14px] text-text-main">Status Stok</label>
                <select name="status_stok" id="status_stok" class="w-full px-[15px] py-[12px] border border-border rounded-[8px] font-sans text-[14px] transition-all duration-300 bg-bg-color focus:outline-none focus:border-primary focus:bg-white focus:shadow-[0_0_0_3px_rgba(20,184,166,0.1)] cursor-pointer">
                    <option value="Tersedia" {{ old('status_stok') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Pre-Order" {{ old('status_stok') == 'Pre-Order' ? 'selected' : '' }}>Pre-Order</option>
                    <option value="Habis" {{ old('status_stok') == 'Habis' ? 'selected' : '' }}>Habis</option>
                </select>
            </div>
            <div class="mb-[20px]">
                <label for="pengelola" class="block mb-[8px] font-semibold text-[14px] text-text-main">Nama Pengelola / BUMDes</label>
                <input type="text" name="pengelola" id="pengelola" class="w-full px-[15px] py-[12px] border border-border rounded-[8px] font-sans text-[14px] transition-all duration-300 bg-bg-color focus:outline-none focus:border-primary focus:bg-white focus:shadow-[0_0_0_3px_rgba(20,184,166,0.1)]" value="{{ old('pengelola') }}" placeholder="Contoh: BUMDes Gn. Sembung">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-[20px]">
            <div class="mb-[20px]">
                <label for="nomor_wa" class="block mb-[8px] font-semibold text-[14px] text-text-main">Nomor WhatsApp (Gunakan 62)</label>
                <input type="text" name="nomor_wa" id="nomor_wa" class="w-full px-[15px] py-[12px] border border-border rounded-[8px] font-sans text-[14px] transition-all duration-300 bg-bg-color focus:outline-none focus:border-primary focus:bg-white focus:shadow-[0_0_0_3px_rgba(20,184,166,0.1)]" value="{{ old('nomor_wa') }}" placeholder="Contoh: 628123456789">
            </div>
            <div class="mb-[20px]">
                <label for="status_publikasi" class="block mb-[8px] font-semibold text-[14px] text-text-main">Status Publikasi *</label>
                <select name="status_publikasi" id="status_publikasi" class="w-full px-[15px] py-[12px] border border-border rounded-[8px] font-sans text-[14px] transition-all duration-300 bg-bg-color focus:outline-none focus:border-primary focus:bg-white focus:shadow-[0_0_0_3px_rgba(20,184,166,0.1)] cursor-pointer" required>
                    <option value="publish" {{ old('status_publikasi') == 'publish' ? 'selected' : '' }}>Publish (Tampilkan)</option>
                    <option value="draft" {{ old('status_publikasi') == 'draft' ? 'selected' : '' }}>Draft (Sembunyikan)</option>
                </select>
            </div>
        </div>

        <div class="flex gap-[15px] mt-[40px]">
            <button type="submit" class="bg-primary text-white border-none px-[25px] py-[12px] rounded-[8px] font-semibold text-[15px] cursor-pointer transition-colors duration-300 hover:bg-[#0F766E]">
                Simpan Data
            </button>
            <a href="{{ route('admin.potensi.index') }}" class="bg-[#F1F5F9] text-text-muted px-[25px] py-[12px] rounded-[8px] no-underline font-semibold text-[15px] transition-colors duration-300 border border-border hover:bg-[#E2E8F0] hover:text-text-main">
                Batal
            </a>
        </div>

    </form>
</div>
@endsection