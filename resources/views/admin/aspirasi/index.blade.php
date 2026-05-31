@extends('layouts.admin')

@section('title', 'Kelola Aspirasi Warga - SID')

@section('content')
<div class="flex flex-col gap-[25px]">
    @if(session('success'))
        <div class="bg-green-50 border-l-[4px] border-green-500 p-[15px] rounded-[8px] text-green-700 text-[14px] font-medium shadow-sm">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div>
        <h1 class="text-[24px] font-bold text-text-main">Aspirasi & Pengaduan Masuk</h1>
        <p class="text-text-muted text-[14px]">Tinjau dan tindak lanjuti laporan serta usulan dari masyarakat desa.</p>
    </div>

    <div class="bg-white rounded-[12px] shadow-sm border border-border overflow-hidden">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-[15px] mb-[20px] mt-[15px] bg-white p-[15px] rounded-[12px] border border-border shadow-sm">
    
            <div class="flex flex-wrap gap-[8px]">
                <a href="{{ request()->fullUrlWithQuery(['status' => 'Semua']) }}" 
                class="px-[12px] py-[6px] rounded-md text-[12px] font-bold transition-all no-underline border flex items-center gap-[6px]
                {{ $statusAktif == 'Semua' ? 'bg-primary text-white border-primary shadow-sm' : 'bg-gray-50 text-text-muted border-border hover:bg-gray-100' }}">
                    Semua <span class="bg-black/10 px-[6px] py-[2px] rounded text-[10px]">{{ $countSemua }}</span>
                </a>

                <a href="{{ request()->fullUrlWithQuery(['status' => 'Menunggu']) }}" 
                class="px-[12px] py-[6px] rounded-md text-[12px] font-bold transition-all no-underline border flex items-center gap-[6px]
                {{ $statusAktif == 'Menunggu' ? 'bg-yellow-500 text-white border-yellow-500 shadow-sm' : 'bg-white text-text-muted border-border hover:bg-yellow-50 hover:text-yellow-600' }}">
                    🟠 Menunggu <span class="bg-black/10 px-[6px] py-[2px] rounded text-[10px]">{{ $countMenunggu }}</span>
                </a>

                <a href="{{ request()->fullUrlWithQuery(['status' => 'Diproses']) }}" 
                class="px-[12px] py-[6px] rounded-md text-[12px] font-bold transition-all no-underline border flex items-center gap-[6px]
                {{ $statusAktif == 'Diproses' ? 'bg-blue-500 text-white border-blue-500 shadow-sm' : 'bg-white text-text-muted border-border hover:bg-blue-50 hover:text-blue-600' }}">
                    🔵 Diproses <span class="bg-black/10 px-[6px] py-[2px] rounded text-[10px]">{{ $countDiproses }}</span>
                </a>

                <a href="{{ request()->fullUrlWithQuery(['status' => 'Selesai']) }}" 
                class="px-[12px] py-[6px] rounded-md text-[12px] font-bold transition-all no-underline border flex items-center gap-[6px]
                {{ $statusAktif == 'Selesai' ? 'bg-green-500 text-white border-green-500 shadow-sm' : 'bg-white text-text-muted border-border hover:bg-green-50 hover:text-green-600' }}">
                    🟢 Selesai <span class="bg-black/10 px-[6px] py-[2px] rounded text-[10px]">{{ $countSelesai }}</span>
                </a>

                <a href="{{ request()->fullUrlWithQuery(['status' => 'Ditolak']) }}" 
                class="px-[12px] py-[6px] rounded-md text-[12px] font-bold transition-all no-underline border flex items-center gap-[6px]
                {{ $statusAktif == 'Ditolak' ? 'bg-red-500 text-white border-red-500 shadow-sm' : 'bg-white text-text-muted border-border hover:bg-red-50 hover:text-red-600' }}">
                    🔴 Ditolak <span class="bg-black/10 px-[6px] py-[2px] rounded text-[10px]">{{ $countDitolak }}</span>
                </a>
            </div>

            <div class="flex items-center gap-[10px] w-full md:w-auto border-t md:border-t-0 md:border-l border-border pt-[10px] md:pt-0 md:pl-[15px]">
                <label class="text-[12px] font-bold text-text-muted uppercase shrink-0">Kategori :</label>
                <select onchange="window.location.href=this.value" class="w-full md:w-[220px] bg-gray-50 border border-border p-[8px] rounded-md text-[13px] font-medium outline-none cursor-pointer focus:border-primary">
                    <option value="{{ request()->fullUrlWithQuery(['kategori' => 'Semua']) }}" {{ $kategoriAktif == 'Semua' ? 'selected' : '' }}>
                        Semua Kategori (Global)
                    </option>
                    @foreach($listKategori as $kat)
                        <option value="{{ request()->fullUrlWithQuery(['kategori' => $kat]) }}" {{ $kategoriAktif == $kat ? 'selected' : '' }}>
                            {{ $kat }}
                        </option>
                    @endforeach
                </select>
            </div>
            
        </div>              
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-border">
                    <th class="p-[15px_20px] text-[13px] font-bold text-text-main uppercase w-[25%]">Pelapor & Kontak</th>
                    <th class="p-[15px_20px] text-[13px] font-bold text-text-main uppercase w-[40%]">Judul & Kategori</th>
                    <th class="p-[15px_20px] text-[13px] font-bold text-text-main uppercase text-center w-[15%]">Status</th>
                    <th class="p-[15px_20px] text-[13px] font-bold text-text-main uppercase text-center w-[20%]">Tindak Lanjut</th>
                </tr>
            </thead>
            <tbody class="text-[14px]">
                @forelse($dataAspirasi as $item)
                <tr class="border-b border-border hover:bg-gray-50 transition-all">
                    <td class="p-[15px_20px]">
                        @if($item->is_anonim)
                            <strong class="text-text-main block">👻 Warga (Anonim)</strong>
                        @else
                            <strong class="text-text-main block">{{ $item->nama_pengirim }}</strong>
                        @endif
                        <span class="text-[12px] text-text-muted block">NIK: {{ $item->nik }}</span>
                        <span class="text-[12px] text-text-muted block">No. HP/WhatsApp: {{ $item->no_hp }}</span>
                    </td>
                    <td class="p-[15px_20px]">
                        <span class="bg-blue-50 text-blue-600 border border-blue-200 px-[8px] py-[2px] rounded-[4px] text-[10px] font-bold uppercase tracking-wide mb-[5px] inline-block">
                            {{ $item->kategori }}
                        </span>
                        <h3 class="m-0 text-[14px] font-bold text-text-main leading-snug line-clamp-2">{{ $item->judul }}</h3>
                        <p class="m-0 text-[12px] text-text-muted mt-[4px]">{{ $item->created_at->diffForHumans() }}</p>
                    </td>
                    <td class="p-[15px_20px] text-center">
                        @php
                            $badge = 'bg-gray-100 text-gray-700';
                            if($item->status == 'Menunggu') $badge = 'bg-yellow-100 text-yellow-700';
                            elseif($item->status == 'Diproses') $badge = 'bg-blue-100 text-blue-700';
                            elseif($item->status == 'Selesai') $badge = 'bg-green-100 text-green-700';
                            elseif($item->status == 'Ditolak') $badge = 'bg-red-100 text-red-700';
                        @endphp
                        <span class="{{ $badge }} px-[10px] py-[5px] rounded-[6px] text-[12px] font-bold">{{ $item->status }}</span>
                    </td>
                    <td class="p-[15px_20px]">
                        <div class="flex justify-center gap-[10px]">
                            <button onclick="openModalAspirasi({{ json_encode($item) }})" class="bg-primary-light text-white px-[12px] py-[6px] rounded-[6px] text-[12px] font-bold cursor-pointer hover:brightness-110">
                                Buka / Respon
                            </button>
                            <form action="{{ route('admin.aspirasi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus laporan ini permanen?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-red-50 text-red-600 px-[10px] py-[6px] rounded-[6px] text-[12px] font-bold cursor-pointer hover:bg-red-100 border border-red-200">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="p-[30px] text-center text-text-muted">Tidak ada data aspirasi masuk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="aspirasiModal" class="fixed inset-0 bg-black/60 z-[100] hidden items-center justify-center opacity-0 transition-opacity duration-300 p-[20px]">
    <div class="bg-white rounded-[12px] w-full max-w-[600px] max-h-[90vh] shadow-xl flex flex-col overflow-hidden">
        
        <div class="flex justify-between items-center p-[20px] border-b bg-gray-50">
            <h2 class="text-[16px] font-bold text-text-main">Detail Laporan Warga</h2>
            <button onclick="closeModalAspirasi()" class="text-[#94A3B8] text-[24px] leading-none hover:text-red-500 cursor-pointer">&times;</button>
        </div>

        <div class="overflow-y-auto p-[20px] flex-1 custom-scrollbar">
            <div class="mb-[20px]">
                <h3 id="modalJudul" class="text-[18px] font-bold text-text-main leading-snug m-0">Judul Aspirasi</h3>
                <p class="text-[12px] text-text-muted mt-[5px]">Oleh: <span id="modalPengirim" class="font-bold text-primary">Nama</span> | <span id="modalTanggal">Tgl</span></p>
            </div>

            <div class="bg-yellow-50 p-[15px] rounded-lg border border-yellow-200 mb-[20px]">
                <strong class="block text-[13px] text-yellow-800 mb-[5px]">Rincian Pesan / Aduan:</strong>
                <p id="modalPesan" class="text-[14px] text-text-main leading-relaxed m-0 whitespace-pre-line">Isi pesan...</p>
            </div>

            <div id="modalLampiranContainer" class="mb-[20px] hidden">
                <strong class="block text-[13px] text-text-main mb-[10px]">📷 Foto Lampiran Warga:</strong>
                <img id="modalLampiranImg" src="" alt="Bukti Lampiran" class="w-full max-h-[250px] object-cover rounded-lg border border-border">
            </div>

            <hr class="border-border my-[20px]">

            <form id="formRespon" method="POST" class="flex flex-col gap-[15px]">
                @csrf @method('PUT')
                
                <div>
                    <label class="block text-[13px] font-bold mb-[5px] text-primary">TINDAK LANJUT / UBAH STATUS</label>
                    <select name="status" id="modalStatus" class="w-full bg-gray-50 border border-border p-[10px] rounded-md text-[14px] font-semibold">
                        <option value="Menunggu">🟠 Menunggu Antrean</option>
                        <option value="Diproses">🔵 Sedang Diproses / Survey Lokasi</option>
                        <option value="Selesai">🟢 Selesai / Ditangani</option>
                        <option value="Ditolak">🔴 Ditolak / Tidak Valid</option>
                    </select>
                </div>



                <div class="flex justify-end gap-[10px] pt-[10px]">
                    <button type="submit" class="bg-primary text-white px-[20px] py-[10px] rounded-md font-bold text-[13px] cursor-pointer hover:brightness-110">Simpan Respon</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const modalAspirasi = document.getElementById('aspirasiModal');
    
    function openModalAspirasi(data) {
        document.getElementById('formRespon').action = `/admin/aspirasi/${data.id}`;
        
        document.getElementById('modalJudul').innerText = data.judul;
        document.getElementById('modalPengirim').innerText = data.nama_pengirim;
        document.getElementById('modalTanggal').innerText = new Date(data.created_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
        document.getElementById('modalPesan').innerText = data.pesan;
        
        // Handle Foto Lampiran
        const lampiranContainer = document.getElementById('modalLampiranContainer');
        const lampiranImg = document.getElementById('modalLampiranImg');
        if (data.foto_lampiran) {
            lampiranImg.src = `/storage/${data.foto_lampiran}`;
            lampiranContainer.classList.remove('hidden');
        } else {
            lampiranContainer.classList.add('hidden');
            lampiranImg.src = '';
        }

        // Setup Form Values
        document.getElementById('modalStatus').value = data.status;
        
        modalAspirasi.classList.remove('hidden'); 
        modalAspirasi.classList.add('flex');
        setTimeout(() => { modalAspirasi.classList.add('opacity-100'); }, 10);
    }

    function closeModalAspirasi() {
        modalAspirasi.classList.remove('opacity-100');
        setTimeout(() => { modalAspirasi.classList.add('hidden'); modalAspirasi.classList.remove('flex'); }, 300);
    }
</script>
@endpush