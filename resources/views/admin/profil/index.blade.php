{{-- resources/views/admin/profil/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Profil & Data Desa - SID')

@section('content')
<div class="flex flex-col gap-[25px]">
    @if(session('success'))
        <div class="bg-green-50 border-l-[4px] border-green-500 p-[15px] rounded-[8px] text-green-700 text-[14px] font-medium shadow-sm">
            ✅ {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-50 border-l-[4px] border-red-500 p-[15px] rounded-[8px] text-red-700 text-[14px] font-medium shadow-sm">
            ❌ {{ session('error') }}
        </div>
    @endif

    <div>
        <h1 class="text-[24px] font-bold text-text-main">Profil & Data Pokok Desa</h1>
        <p class="text-text-muted text-[14px]">Perbarui informasi geografis, angka demografi kependudukan, aparatur, fasilitas, dan potensi desa secara terpisah.</p>
    </div>

    <div class="bg-gray-100 p-[5px] rounded-[10px] w-max flex flex-wrap border border-border">
        <button onclick="switchTab('demografi')" id="tab-demografi" class="tab-btn px-[20px] py-[8px] rounded-[6px] text-text-muted font-bold text-[14px] bg-transparent border-0 cursor-pointer transition-all">📊 Kependudukan</button>
        <button onclick="switchTab('sejarah')" id="tab-sejarah" class="tab-btn px-[20px] py-[8px] rounded-[6px] text-text-muted font-bold text-[14px] bg-transparent border-0 cursor-pointer transition-all">🗺️ Sejarah & Batas</button>
        <button onclick="switchTab('aparatur')" id="tab-aparatur" class="tab-btn px-[20px] py-[8px] rounded-[6px] text-text-muted font-bold text-[14px] bg-transparent border-0 cursor-pointer transition-all">🏛️ Pimpinan</button>
        <button onclick="switchTab('fasilitas')" id="tab-fasilitas" class="tab-btn px-[20px] py-[8px] rounded-[6px] text-text-muted font-bold text-[14px] bg-transparent border-0 cursor-pointer transition-all">🏥 Fasilitas Publik</button>
        <button onclick="switchTab('potensi')" id="tab-potensi" class="tab-btn px-[20px] py-[8px] rounded-[6px] text-text-muted font-bold text-[14px] bg-transparent border-0 cursor-pointer transition-all">🌾 Potensi Desa</button>
    </div>

    {{-- ================== TAB DEMOGRAFI ================== --}}
    <div id="form-section-demografi" class="tab-content block">
        {{-- ... (form demografi tidak berubah) ... --}}
        <form action="{{ route('admin.profil.update') }}" method="POST" class="bg-white rounded-[12px] border border-border p-[30px] shadow-sm flex flex-col gap-[20px]">
            @csrf
            <input type="hidden" name="form_id" value="demografi">
            
            <h3 class="text-[16px] font-bold text-primary border-b pb-[8px] m-0">Statistik Utama (Top Cards)</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-[20px]">
                <div>
                    <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Total Penduduk (Jiwa)</label>
                    <input type="number" id="total_penduduk" name="total_penduduk" value="{{ old('total_penduduk', $profil->total_penduduk) }}" class="w-full bg-gray-100 border p-[10px] rounded-md text-[14px] font-bold text-primary cursor-not-allowed " readonly>
                    <span class="block text-[11px] text-text-muted mb-[4px]">Jumlah total penduduk tidak perlu diisi manual, karena akan dihitung otomatis berdasarkan jumlah penduduk laki-laki dan perempuan.</span>
                    @error('total_penduduk')<span class="text-red-500 text-[11px]">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Luas Wilayah (Hektar)</label>
                    <input type="number" step="0.01" name="luas_wilayah" value="{{ old('luas_wilayah', $profil->luas_wilayah) }}" class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]">
                </div>
                <div>
                    <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Jumlah RW</label>
                    <input type="number" name="jumlah_rw" value="{{ old('jumlah_rw', $profil->jumlah_rw) }}" class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]">
                </div>
                <div>
                    <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Jumlah RT</label>
                    <input type="number" name="jumlah_rt" value="{{ old('jumlah_rt', $profil->jumlah_rt) }}" class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]">
                </div>
            </div>

            <h3 class="text-[16px] font-bold text-primary border-b pb-[8px] m-0 mt-[10px]">Rincian Kependudukan</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-[20px]">
                <div>
                    <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Total KK</label>
                    <input type="number" name="total_kk" value="{{ old('total_kk', $profil->total_kk) }}" class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]">
                </div>
                <div>
                    <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Jumlah Dusun</label>
                    <input type="number" name="jumlah_dusun" value="{{ old('jumlah_dusun', $profil->jumlah_dusun) }}" class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]">
                </div>
                <div>
                    <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Penduduk Laki-laki</label>
                    <input type="number" id="penduduk_laki_laki" name="penduduk_laki_laki" value="{{ old('penduduk_laki_laki', $profil->penduduk_laki_laki) }}" class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]">
                </div>
                <div>
                    <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Penduduk Perempuan</label>
                    <input type="number" id="penduduk_perempuan" name="penduduk_perempuan" value="{{ old('penduduk_perempuan', $profil->penduduk_perempuan) }}" class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]">
                </div>
            </div>

            <h3 class="text-[16px] font-bold text-primary border-b pb-[8px] m-0 mt-[10px]">Luas Lahan (Hektar)</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-[20px]">
                <div>
                    <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Luas Pemukiman</label>
                    <input type="number" step="0.01" name="luas_pemukiman" value="{{ old('luas_pemukiman', $profil->luas_pemukiman) }}" class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]">
                </div>
                <div>
                    <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Luas Persawahan</label>
                    <input type="number" step="0.01" name="luas_persawahan" value="{{ old('luas_persawahan', $profil->luas_persawahan) }}" class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]">
                </div>
                <div>
                    <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Luas Perkebunan</label>
                    <input type="number" step="0.01" name="luas_perkebunan" value="{{ old('luas_perkebunan', $profil->luas_perkebunan) }}" class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]">
                </div>
            </div>

            <div>
                <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Deskripsi Demografi</label>
                <textarea name="deskripsi_demografi" rows="3" class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]">{{ old('deskripsi_demografi', $profil->deskripsi_demografi) }}</textarea>
            </div>

            <div class="pt-[15px] border-t flex justify-end mt-[10px]">
                <button type="submit" class="bg-primary-light text-white px-[25px] py-[10px] rounded-[8px] font-semibold text-[14px] cursor-pointer">💾 Simpan Kependudukan</button>
            </div>
        </form>
    </div>

    {{-- ================== TAB SEJARAH ================== --}}
    <div id="form-section-sejarah" class="tab-content hidden">
        {{-- ... (form sejarah tidak berubah) ... --}}
        <form action="{{ route('admin.profil.update') }}" method="POST" class="bg-white rounded-[12px] border border-border p-[30px] shadow-sm flex flex-col gap-[20px]">
            @csrf
            <input type="hidden" name="form_id" value="sejarah">

            <h3 class="text-[16px] font-bold text-primary border-b pb-[8px] m-0">Batas Geografis Wilayah</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-[20px]">
                <div>
                    <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Batas Utara</label>
                    <input type="text" name="batas_utara" value="{{ old('batas_utara', $profil->batas_utara) }}" class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]">
                </div>
                <div>
                    <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Batas Selatan</label>
                    <input type="text" name="batas_selatan" value="{{ old('batas_selatan', $profil->batas_selatan) }}" class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]">
                </div>
                <div>
                    <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Batas Timur</label>
                    <input type="text" name="batas_timur" value="{{ old('batas_timur', $profil->batas_timur) }}" class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]">
                </div>
                <div>
                    <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Batas Barat</label>
                    <input type="text" name="batas_barat" value="{{ old('batas_barat', $profil->batas_barat) }}" class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]">
                </div>
            </div>

            <div>
                <h3 class="text-[16px] font-bold text-primary border-b pb-[8px] m-0 mb-[10px] mt-[10px]">Kronik Sejarah Desa</h3>
                <textarea name="sejarah_desa" rows="8" class="w-full bg-bg-color border p-[15px] rounded-md text-[14px] leading-relaxed">{{ old('sejarah_desa', $profil->sejarah_desa) }}</textarea>
            </div>

            <div class="pt-[15px] border-t flex justify-end mt-[10px]">
                <button type="submit" class="bg-primary-light text-white px-[25px] py-[10px] rounded-[8px] font-semibold text-[14px] cursor-pointer">💾 Simpan Sejarah</button>
            </div>
        </form>
    </div>

    {{-- ================== TAB APARATUR ================== --}}
    <div id="form-section-aparatur" class="tab-content hidden">
        {{-- ... (form aparatur tidak berubah) ... --}}
        <form action="{{ route('admin.profil.update') }}" method="POST" class="bg-white rounded-[12px] border border-border p-[30px] shadow-sm flex flex-col gap-[20px]">
            @csrf
            <input type="hidden" name="form_id" value="aparatur">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-[30px]">
                <div class="flex flex-col gap-[12px]">
                    <h3 class="text-[16px] font-bold text-primary border-b pb-[8px] m-0">Profil Kepala Desa</h3>
                    <div>
                        <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Nama Kepala Desa</label>
                        <input type="text" name="nama_kades" value="{{ old('nama_kades', $profil->nama_kades) }}" class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]">
                    </div>
                    <div>
                        <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Visi Singkat</label>
                        <textarea name="bio_kades" rows="4" class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]">{{ old('bio_kades', $profil->bio_kades) }}</textarea>
                    </div>
                </div>

                <div class="flex flex-col gap-[12px]">
                    <h3 class="text-[16px] font-bold text-primary border-b pb-[8px] m-0">Profil Camat Pagaden</h3>
                    <div>
                        <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Nama Camat</label>
                        <input type="text" name="nama_camat" value="{{ old('nama_camat', $profil->nama_camat) }}" class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]">
                    </div>
                    <div>
                        <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Deskripsi Camat</label>
                        <textarea name="bio_camat" rows="4" class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]">{{ old('bio_camat', $profil->bio_camat) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="pt-[15px] border-t flex justify-end mt-[10px]">
                <button type="submit" class="bg-primary-light text-white px-[25px] py-[10px] rounded-[8px] font-semibold text-[14px] cursor-pointer">💾 Simpan Aparatur</button>
            </div>
        </form>
    </div>

    {{-- ================== TAB FASILITAS ================== --}}
    <div id="form-section-fasilitas" class="tab-content hidden flex flex-col gap-[20px]">
        {{-- ... (form fasilitas tidak berubah) ... --}}
        <div class="bg-white rounded-[12px] border border-border p-[30px] shadow-sm">
            <h3 class="text-[16px] font-bold text-text-main border-b pb-[8px] m-0 mb-[15px]">Tambah Fasilitas Publik</h3>
            <form action="{{ route('admin.fasilitas.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-[20px] items-end">
                @csrf
                <div>
                    <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Nama Fasilitas</label>
                    <input type="text" name="nama_fasilitas" required class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]">
                </div>
                <div>
                    <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Lokasi</label>
                    <input type="text" name="lokasi" required class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]">
                </div>
                <div>
                    <button type="submit" class="w-full bg-green-500 text-white py-[11px] font-bold rounded-md text-[14px] cursor-pointer hover:bg-green-600">➕ Tambah Sarana</button>
                </div>
                <div class="col-span-full">
                    <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Deskripsi</label>
                    <textarea name="deskripsi" rows="2" required class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]"></textarea>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-[12px] border border-border overflow-hidden shadow-sm">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b">
                        <th class="p-[15px_20px] text-[13px] font-bold uppercase">Nama Sarana</th>
                        <th class="p-[15px_20px] text-[13px] font-bold uppercase">Lokasi</th>
                        <th class="p-[15px_20px] text-[13px] font-bold uppercase text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[14px]">
                    @forelse($fasilitas as $f)
                    <tr class="border-b border-border">
                        <td class="p-[15px_20px] font-bold">{{ $f->nama_fasilitas }}</td>
                        <td class="p-[15px_20px] text-text-muted">{{ $f->lokasi }}</td>
                        <td class="p-[15px_20px] text-center">
                            <form action="{{ route('admin.fasilitas.destroy', $f->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 font-bold bg-transparent border-0 cursor-pointer">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="p-[25px] text-center text-text-muted">Belum ada fasilitas terdaftar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ================== TAB POTENSI DESA ================== --}}
    <div id="form-section-potensi" class="tab-content hidden flex flex-col gap-[20px]">
        {{-- Form Tambah Potensi Baru --}}
        <div class="bg-white rounded-[12px] border border-border p-[30px] shadow-sm">
            <h3 class="text-[16px] font-bold text-text-main border-b pb-[8px] m-0 mb-[15px]">Tambah Potensi Baru</h3>
            <form action="{{ route('admin.potensi.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-[20px] items-end">
                @csrf
                <div>
                    <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Judul Potensi *</label>
                    <input type="text" name="judul" required value="{{ old('judul') }}" class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]" placeholder="Masukkan judul potensi">
                    @error('judul')<span class="text-red-500 text-[11px]">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Gambar (Maks. 2MB) *</label>
                    <input type="file" name="gambar" required accept="image/*" class="w-full bg-bg-color border p-[10px] rounded-md text-[14px] file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-light file:text-white hover:file:bg-primary">
                    @error('gambar')<span class="text-red-500 text-[11px]">{{ $message }}</span>@enderror
                </div>
                <div class="col-span-full">
                    <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Deskripsi Singkat *</label>
                    <textarea name="deskripsi_singkat" rows="3" required class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]" maxlength="500" placeholder="Tulis ringkasan potensi (maks. 500 karakter)">{{ old('deskripsi_singkat') }}</textarea>
                    @error('deskripsi_singkat')<span class="text-red-500 text-[11px]">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Status Publikasi *</label>
                    <select name="status_publikasi" required class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]">
                        <option value="publish" {{ old('status_publikasi') == 'publish' ? 'selected' : '' }}>Publish (Tampilkan)</option>
                        <option value="draft" {{ old('status_publikasi') == 'draft' ? 'selected' : '' }}>Draft (Sembunyikan)</option>
                    </select>
                    @error('status_publikasi')<span class="text-red-500 text-[11px]">{{ $message }}</span>@enderror
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-green-500 text-white py-[11px] font-bold rounded-md text-[14px] cursor-pointer hover:bg-green-600">➕ Tambah Potensi</button>
                </div>
            </form>
        </div>

        {{-- Tabel Daftar Potensi --}}
        <div class="bg-white rounded-[12px] border border-border overflow-hidden shadow-sm overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-max">
                <thead>
                    <tr class="bg-gray-50 border-b border-border">
                        <th class="w-[5%] px-[20px] py-[15px] text-text-muted font-semibold text-[13px] uppercase tracking-wide">No</th>
                        <th class="w-[10%] px-[20px] py-[15px] text-text-muted font-semibold text-[13px] uppercase tracking-wide">Gambar</th>
                        <th class="w-[25%] px-[20px] py-[15px] text-text-muted font-semibold text-[13px] uppercase tracking-wide">Judul Potensi</th>
                        <th class="w-[30%] px-[20px] py-[15px] text-text-muted font-semibold text-[13px] uppercase tracking-wide">Deskripsi Singkat</th>
                        <th class="w-[15%] px-[20px] py-[15px] text-text-muted font-semibold text-[13px] uppercase tracking-wide">Status</th>
                        <th class="w-[15%] px-[20px] py-[15px] text-text-muted font-semibold text-[13px] uppercase tracking-wide">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($potensis as $index => $potensi)
                    <tr class="border-b border-border last:border-none transition-colors duration-200 hover:bg-[#F8FAFC]">
                        <td class="px-[20px] py-[15px] text-[14px] align-middle">{{ $index + 1 }}</td>
                        <td class="px-[20px] py-[15px] align-middle">
                            @if($potensi->gambar)
                                <img src="{{ asset('storage/' . $potensi->gambar) }}" alt="{{ $potensi->judul }}" class="w-[80px] h-[55px] object-cover rounded-[6px] border border-border">
                            @else
                                <div class="w-[80px] h-[55px] bg-[#E2E8F0] rounded-[6px] flex items-center justify-center text-[10px] text-[#94A3B8]">
                                    No Img
                                </div>
                            @endif
                        </td>
                        <td class="px-[20px] py-[15px] align-middle">
                            <strong class="text-text-main text-[15px] font-bold">{{ $potensi->judul }}</strong>
                        </td>
                        <td class="px-[20px] py-[15px] text-[14px] text-text-muted align-middle">
                            {{ Str::limit($potensi->deskripsi_singkat, 50, '...') }}
                        </td>
                        <td class="px-[20px] py-[15px] align-middle">
                            <span class="px-[10px] py-[5px] rounded-full text-[12px] font-semibold inline-block {{ $potensi->status_publikasi == 'publish' ? 'bg-[#DCFCE7] text-[#16A34A]' : 'bg-[#F1F5F9] text-[#64748B]' }}">
                                {{ ucfirst($potensi->status_publikasi) }}
                            </span>
                        </td>
                        <td class="px-[20px] py-[15px] align-middle">
                            {{-- Tombol Edit memicu modal --}}
                            <button type="button" onclick="openEditModal({{ $potensi->id }}, '{{ addslashes($potensi->judul) }}', '{{ addslashes($potensi->deskripsi_singkat) }}', '{{ $potensi->status_publikasi }}', '{{ $potensi->gambar ? asset('storage/' . $potensi->gambar) : '' }}')" class="mr-[15px] text-[#0284C7] bg-transparent border-none cursor-pointer font-semibold text-[13px] hover:underline">
                                Edit
                            </button>
                            <form action="{{ route('admin.potensi.destroy', $potensi->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus potensi ini?');">
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

        {{-- ================== MODAL EDIT POTENSI ================== --}}
        <div id="edit-potensi-modal" class="fixed inset-0 z-50 hidden bg-black/50 flex items-center justify-center">
            <div class="bg-white rounded-[12px] max-w-2xl w-full mx-4 p-[30px] shadow-lg border border-border max-h-[90vh] overflow-y-auto">
                <div class="flex justify-between items-center mb-[20px]">
                    <h3 class="text-[18px] font-bold text-text-main">Edit Potensi</h3>
                    <button onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700 text-[20px] leading-none">&times;</button>
                </div>
                <form id="edit-potensi-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-[15px]">
                        <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Judul Potensi *</label>
                        <input type="text" name="judul" id="edit-judul" required class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]">
                    </div>
                    <div class="mb-[15px]">
                        <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Ganti Foto (Opsional, Maks. 2MB)</label>
                        <input type="file" name="gambar" id="edit-gambar" accept="image/*" class="w-full bg-bg-color border p-[10px] rounded-md text-[14px] file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-light file:text-white hover:file:bg-primary">
                        <div id="current-image-preview" class="mt-[10px]"></div>
                    </div>
                    <div class="mb-[15px]">
                        <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Deskripsi Singkat *</label>
                        <textarea name="deskripsi_singkat" id="edit-deskripsi" rows="4" required maxlength="500" class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]"></textarea>
                    </div>
                    <div class="mb-[15px]">
                        <label class="block text-[12px] font-bold mb-[6px] uppercase text-text-main">Status Publikasi *</label>
                        <select name="status_publikasi" id="edit-status" required class="w-full bg-bg-color border p-[10px] rounded-md text-[14px]">
                            <option value="publish">Publish (Tampilkan)</option>
                            <option value="draft">Draft (Sembunyikan)</option>
                        </select>
                    </div>
                    <div class="flex gap-[15px] mt-[25px] pt-[15px] border-t justify-end">
                        <button type="button" onclick="closeEditModal()" class="bg-gray-200 text-gray-700 px-[25px] py-[10px] rounded-[8px] font-semibold text-[14px]">Batal</button>
                        <button type="submit" class="bg-primary text-white px-[25px] py-[10px] rounded-[8px] font-semibold text-[14px] hover:bg-[#0F766E]">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function switchTab(section) {
        document.querySelectorAll('.tab-content').forEach(el => {
            el.classList.remove('block', 'flex');
            el.classList.add('hidden');
        });
        
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('bg-white', 'text-primary', 'shadow-sm');
        });

        const activeSection = document.getElementById(`form-section-${section}`);
        activeSection.classList.remove('hidden');
        if (section === 'fasilitas' || section === 'potensi') {
            activeSection.classList.add('flex');
        } else {
            activeSection.classList.add('block');
        }
        
        document.getElementById(`tab-${section}`).classList.add('bg-white', 'text-primary', 'shadow-sm');
    }

    // Modal Edit
    function openEditModal(id, judul, deskripsi, status, imageUrl) {
        const modal = document.getElementById('edit-potensi-modal');
        const form = document.getElementById('edit-potensi-form');
        form.action = `/admin/potensi/${id}`; // route update
        
        document.getElementById('edit-judul').value = judul;
        document.getElementById('edit-deskripsi').value = deskripsi;
        document.getElementById('edit-status').value = status;
        
        const preview = document.getElementById('current-image-preview');
        if (imageUrl) {
            preview.innerHTML = `<p class="text-[12px] text-text-muted mb-[5px]">Foto Saat Ini:</p><img src="${imageUrl}" class="w-[120px] h-auto rounded-[6px] border border-border">`;
        } else {
            preview.innerHTML = '<p class="text-[12px] text-text-muted">Belum ada foto</p>';
        }
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    
    function closeEditModal() {
        const modal = document.getElementById('edit-potensi-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
    
    // Tutup modal jika klik di luar konten
    document.getElementById('edit-potensi-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditModal();
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        // Jika ada error validasi di potensi, buka tab potensi
        const potensiErrors = document.querySelectorAll('#form-section-potensi .text-red-500');
        if (potensiErrors.length > 0) {
            switchTab('potensi');
        } else {
            switchTab('demografi');
        }

        // Hitung total penduduk otomatis
        const inputLaki = document.getElementById('penduduk_laki_laki');
        const inputPerempuan = document.getElementById('penduduk_perempuan');
        const inputTotal = document.getElementById('total_penduduk');

        function hitungTotalPenduduk() {
            const laki = parseInt(inputLaki.value) || 0;
            const perempuan = parseInt(inputPerempuan.value) || 0;
            inputTotal.value = laki + perempuan;
        }

        if (inputLaki && inputPerempuan) {
            inputLaki.addEventListener('input', hitungTotalPenduduk);
            inputPerempuan.addEventListener('input', hitungTotalPenduduk);
        }
    });
</script>
@endpush