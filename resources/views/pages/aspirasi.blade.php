@extends('layouts.app')

@section('title', 'Layanan Aspirasi & Pengaduan - Desa Gunung Sembung')

@section('content')
<header class="relative py-[60px] mb-[40px] text-center text-white bg-gradient-to-r from-[#1E293B] to-[#334155]">
    <div class="container relative z-10 mx-auto px-5 max-w-6xl">
        <h1 class="m-0 mb-[10px] text-[28px] md:text-[36px] font-bold">Layanan Aspirasi & Pengaduan</h1>
        <p class="text-[16px] max-w-[600px] mx-auto opacity-90"> Sampaikan saran, kritik, atau aduan terkait infrastruktur dan pelayanan publik di lingkungan Desa Gunung Sembung. </p>
    </div>
</header>

<main class="container mx-auto px-5 max-w-3xl mb-[80px]">
    @if(session('success'))
        <div class="bg-green-50 border-l-[4px] border-green-500 text-green-800 p-[20px] rounded-r-xl mb-[30px] font-medium text-[15px] shadow-sm flex items-center gap-[15px]">
            <span class="text-[24px]">✅</span> 
            <div>
                <strong class="block">Laporan Berhasil Terkirim!</strong>
                <span class="text-[13px] opacity-90">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="bg-white border border-border rounded-xl p-[30px] shadow-sm relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-[4px] bg-primary"></div>
        
        <h2 class="text-[20px] font-bold text-text-main border-b border-border pb-[15px] mb-[25px]">Formulir Pelaporan</h2>
        @if(session('error'))
            <div class="bg-red-50 border-l-[4px] border-red-500 text-red-800 p-[20px] rounded-r-xl mb-[30px] font-medium text-[15px] shadow-sm flex items-center gap-[15px]">
                <span class="text-[24px]">❌</span> 
                <div>
                    <strong class="block">Gagal Mengirim Laporan!</strong>
                    <span class="text-[13px] opacity-90">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-orange-50 border-l-[4px] border-orange-500 text-orange-800 p-[20px] rounded-r-xl mb-[30px] shadow-sm">
                <strong class="block mb-[10px] text-[15px] font-bold">Mohon periksa kembali isian Anda:</strong>
                <ul class="m-0 pl-[20px] text-[14px] flex flex-col gap-[5px]">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('publik.aspirasi.kirim') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-[20px]">
            @csrf
            
            <div class="bg-gray-50 p-[15px] rounded-lg border border-border">
                <h3 class="text-[14px] font-bold text-text-main mb-[15px] flex items-center gap-[8px]"><span>👤</span> Identitas Pelapor</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-[15px]">
                    <div>
                        <label class="block text-[12px] font-bold mb-[6px] text-text-muted uppercase">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_pengirim" required value="{{ old('nama_pengirim') }}" class="w-full bg-white border border-border p-[10px] rounded-md text-[14px]">
                        @error('nama_pengirim')
                            <span class="text-red-500 text-[12px] font-medium mt-[5px] block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-[12px] font-bold mb-[6px] text-text-muted uppercase">NIK (KTP) <span class="text-red-500">*</span></label>
                        <input type="number" name="nik" required value="{{ old('nik') }}" class="w-full bg-white border border-border p-[10px] rounded-md text-[14px]">
                        
                        @error('nik')
                            <span class="text-red-500 text-[12px] font-medium mt-[5px] block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-[12px] font-bold mb-[6px] text-text-muted uppercase">No. HP / WhatsApp <span class="text-red-500">*</span></label>
                        <input type="number" name="no_hp" required value="{{ old('no_hp') }}" class="w-full bg-white border border-border p-[10px] rounded-md text-[14px]">
                        @error('no_hp')
                            <span class="text-red-500 text-[12px] font-medium mt-[5px] block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-[12px] font-bold mb-[6px] text-text-muted uppercase">Kategori Aduan <span class="text-red-500">*</span></label>
                <select name="kategori" required class="w-full bg-gray-50 border border-border p-[10px] rounded-md text-[14px]">
                    <option value="" disabled selected>-- Pilih Kategori --</option>
                    <option value="Infrastruktur & Fasilitas">Infrastruktur & Pembangunan</option>
                    <option value="Pelayanan Administrasi">Pelayanan Administrasi / Balai Desa</option>
                    <option value="Ketertiban & Keamanan">Ketertiban & Keamanan Warga</option>
                    <option value="Kesehatan & Lingkungan">Kesehatan & Lingkungan / Sampah</option>
                    <option value="Bantuan Sosial">Bantuan Sosial (Bansos)</option>
                    <option value="Lainnya">Lainnya / Usulan Umum</option>
                </select>
                @error('kategori')
                    <span class="text-red-500 text-[12px] font-medium mt-[5px] block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-[12px] font-bold mb-[6px] text-text-muted uppercase">Judul Laporan Singkat <span class="text-red-500">*</span></label>
                <input type="text" name="judul" required placeholder="Contoh: Lampu Jalan PJU Mati di RW 03" value="{{ old('judul') }}" class="w-full bg-gray-50 border border-border p-[10px] rounded-md text-[14px]">
                @error('judul')
                    <span class="text-red-500 text-[12px] font-medium mt-[5px] block">{{ $message }}</span>
                @enderror            
            </div>

            <div>
                <label class="block text-[12px] font-bold mb-[6px] text-text-muted uppercase">Isi Pesan / Rincian Aduan <span class="text-red-500">*</span></label>
                <textarea name="pesan" rows="5" required placeholder="Ceritakan detail aduan, lokasi kejadian, atau usulan Anda di sini..." class="w-full bg-gray-50 border border-border p-[10px] rounded-md text-[14px] leading-relaxed">{{ old('pesan') }}</textarea>
                @error('pesan')
                    <span class="text-red-500 text-[12px] font-medium mt-[5px] block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-[12px] font-bold mb-[6px] text-text-muted uppercase">Bukti Foto Laporan (Opsional)</label>
                <input type="file" name="foto_lampiran" accept="image/*" class="w-full bg-gray-50 border border-border p-[8px] rounded-md text-[13px] file:mr-[10px] file:border-0 file:bg-primary/10 file:text-primary file:font-semibold file:px-[12px] file:py-[4px] file:rounded">
                <span class="block text-[11px] text-text-muted mt-[4px]">*Format JPG/PNG maksimal 3MB.</span>
                @error('foto_lampiran')
                    <span class="text-red-500 text-[12px] font-medium mt-[5px] block">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="bg-primary text-white py-[14px] font-bold rounded-lg hover:brightness-110 transition-all cursor-pointer text-[15px] mt-[10px]">
                Kirim Aspirasi Sekarang
            </button>
        </form>
    </div>
</main>
@endsection