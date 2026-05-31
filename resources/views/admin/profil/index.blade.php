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
        <p class="text-text-muted text-[14px]">Perbarui informasi geografis, angka demografi kependudukan, aparatur, dan fasilitas desa secara terpisah.</p>
    </div>

    <div class="bg-gray-100 p-[5px] rounded-[10px] w-max flex border border-border">
        <button onclick="switchTab('demografi')" id="tab-demografi" class="tab-btn px-[20px] py-[8px] rounded-[6px] text-text-muted font-bold text-[14px] bg-transparent border-0 cursor-pointer transition-all">📊 Kependudukan</button>
        <button onclick="switchTab('sejarah')" id="tab-sejarah" class="tab-btn px-[20px] py-[8px] rounded-[6px] text-text-muted font-bold text-[14px] bg-transparent border-0 cursor-pointer transition-all">🗺️ Sejarah & Batas</button>
        <button onclick="switchTab('aparatur')" id="tab-aparatur" class="tab-btn px-[20px] py-[8px] rounded-[6px] text-text-muted font-bold text-[14px] bg-transparent border-0 cursor-pointer transition-all">🏛️ Pimpinan</button>
        <button onclick="switchTab('fasilitas')" id="tab-fasilitas" class="tab-btn px-[20px] py-[8px] rounded-[6px] text-text-muted font-bold text-[14px] bg-transparent border-0 cursor-pointer transition-all">🏥 Fasilitas Publik</button>
    </div>

    <div id="form-section-demografi" class="tab-content block">
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

    <div id="form-section-sejarah" class="tab-content hidden">
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

    <div id="form-section-aparatur" class="tab-content hidden">
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


    <div id="form-section-fasilitas" class="tab-content hidden flex flex-col gap-[20px]">
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
</div>
@endsection

@push('scripts')
<script>
    function switchTab(section) {
        // Sembunyikan semua section
        document.querySelectorAll('.tab-content').forEach(el => {
            el.classList.remove('block');
            el.classList.add('hidden');
        });
        
        // Reset warna semua tombol
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('bg-white', 'text-primary', 'shadow-sm');
        });

        // Tampilkan section yang dipilih
        document.getElementById(`form-section-${section}`).classList.remove('hidden');
        document.getElementById(`form-section-${section}`).classList.add('block');
        
        // Tandai tombol yang aktif
        document.getElementById(`tab-${section}`).classList.add('bg-white', 'text-primary', 'shadow-sm');
    }
    document.addEventListener('DOMContentLoaded', () => {
    // Jalankan fungsi tab default Anda sebelumnya...
    switchTab('demografi');

    // Ambil elemen input
    const inputLaki = document.getElementById('penduduk_laki_laki');
    const inputPerempuan = document.getElementById('penduduk_perempuan');
    const inputTotal = document.getElementById('total_penduduk');

    function hitungTotalPenduduk() {
        // Ambil nilai angka, jika kosong jadikan 0
        const laki = parseInt(inputLaki.value) || 0;
        const perempuan = parseInt(inputPerempuan.value) || 0;
        
        // Masukkan hasil penjumlahan ke input total
        inputTotal.value = laki + perempuan;
    }

    // Dengarkan ketikan user di kedua input tersebut
    if (inputLaki && inputPerempuan) {
        inputLaki.addEventListener('input', hitungTotalPenduduk);
        inputPerempuan.addEventListener('input', hitungTotalPenduduk);
    }
});
</script>
@endpush