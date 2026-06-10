@extends('layouts.admin')

@section('title', 'Dashboard Utama - SID Gunung Sembung')

@section('content')
<div class="flex flex-col gap-[30px]">
    
    <div class="bg-gradient-to-r from-primary to-primary-light rounded-[16px] p-[30px] md:p-[40px] text-white shadow-md relative overflow-hidden">
        <div class="relative z-10">
            <h1 class="text-[24px] md:text-[32px] font-bold mb-[10px] m-0">Selamat datang, {{ Auth::user()->nama_lengkap ?? 'Petugas Desa' }}! 👋</h1>
            <p class="text-[14px] md:text-[16px] opacity-90 m-0 max-w-[600px] leading-relaxed">
                Ini adalah pusat kendali Sistem Informasi Desa (SID) Gunung Sembung. Kelola transparansi data, publikasi berita, hingga layanan pengaduan warga dari satu layar yang terintegrasi.
            </p>
        </div>
        <div class="absolute right-[-50px] top-[-50px] w-[250px] h-[250px] bg-white opacity-10 rounded-full blur-[40px]"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-[20px]">
        <div class="bg-white rounded-[12px] p-[20px] border border-border shadow-sm flex items-center gap-[15px]">
            <div class="w-[50px] h-[50px] bg-blue-50 text-blue-500 rounded-[10px] flex items-center justify-center text-[24px]">👥</div>
            <div>
                <p class="m-0 text-[12px] text-text-muted font-bold uppercase tracking-wide">Total Penduduk</p>
                <h3 class="m-0 text-[22px] font-bold text-text-main">{{ number_format($totalPenduduk, 0, ',', '.') }} <span class="text-[12px] font-medium text-text-muted">Jiwa</span></h3>
            </div>
        </div>

        <div class="bg-white rounded-[12px] p-[20px] border border-border shadow-sm flex items-center gap-[15px]">
            <div class="w-[50px] h-[50px] bg-yellow-50 text-yellow-500 rounded-[10px] flex items-center justify-center text-[24px]">💬</div>
            <div>
                <p class="m-0 text-[12px] text-text-muted font-bold uppercase tracking-wide">Aspirasi Menunggu</p>
                <h3 class="m-0 text-[22px] font-bold text-text-main">{{ $aspirasiBaru }} <span class="text-[12px] font-medium text-text-muted">Laporan</span></h3>
            </div>
        </div>

        <div class="bg-white rounded-[12px] p-[20px] border border-border shadow-sm flex items-center gap-[15px]">
            <div class="w-[50px] h-[50px] bg-green-50 text-green-500 rounded-[10px] flex items-center justify-center text-[24px]">📄</div>
            <div>
                <p class="m-0 text-[12px] text-text-muted font-bold uppercase tracking-wide">Dokumen Desa</p>
                <h3 class="m-0 text-[22px] font-bold text-text-main">{{ $totalDokumen }} <span class="text-[12px] font-medium text-text-muted">File</span></h3>
            </div>
        </div>

        <div class="bg-white rounded-[12px] p-[20px] border border-border shadow-sm flex items-center gap-[15px]">
            <div class="w-[50px] h-[50px] bg-purple-50 text-purple-500 rounded-[10px] flex items-center justify-center text-[24px]">📰</div>
            <div>
                <p class="m-0 text-[12px] text-text-muted font-bold uppercase tracking-wide">Kabar Berita</p>
                <h3 class="m-0 text-[22px] font-bold text-text-main">{{ $totalBerita }} <span class="text-[12px] font-medium text-text-muted">Artikel</span></h3>
            </div>
        </div>
    </div>

    <div>
        <h2 class="text-[18px] font-bold text-text-main mb-[15px] flex items-center gap-[8px]"><span>🚀</span> Jalan Pintas Pengelolaan</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-[15px]">
            
            <a href="{{ route('admin.profil.index') }}" class="bg-white border border-border p-[20px] rounded-[12px] text-center hover:shadow-md hover:border-primary transition-all no-underline group block">
                <div class="text-[32px] mb-[10px] group-hover:scale-110 transition-transform">📝</div>
                <h4 class="m-0 text-[14px] font-bold text-text-main group-hover:text-primary transition-colors">Profil & Data</h4>
                <p class="m-0 text-[11px] text-text-muted mt-[4px]">Update Penduduk</p>
            </a>

            <a href="{{ route('admin.aspirasi.index') }}" class="bg-white border border-border p-[20px] rounded-[12px] text-center hover:shadow-md hover:border-primary transition-all no-underline group block relative">
                @if($aspirasiBaru > 0)
                    <span class="absolute top-[10px] right-[10px] w-[12px] h-[12px] bg-red-500 rounded-full animate-pulse"></span>
                @endif
                <div class="text-[32px] mb-[10px] group-hover:scale-110 transition-transform">💬</div>
                <h4 class="m-0 text-[14px] font-bold text-text-main group-hover:text-primary transition-colors">Aspirasi Warga</h4>
                <p class="m-0 text-[11px] text-text-muted mt-[4px]">Kelola Pengaduan</p>
            </a>

            <a href="{{ route('admin.keuangan.index') }}" class="bg-white border border-border p-[20px] rounded-[12px] text-center hover:shadow-md hover:border-primary transition-all no-underline group block">
                <div class="text-[32px] mb-[10px] group-hover:scale-110 transition-transform">💰</div>
                <h4 class="m-0 text-[14px] font-bold text-text-main group-hover:text-primary transition-colors">Keuangan</h4>
                <p class="m-0 text-[11px] text-text-muted mt-[4px]">APBDes & Realisasi</p>
            </a>

            <a href="{{ route('admin.pemerintahan.index') }}" class="bg-white border border-border p-[20px] rounded-[12px] text-center hover:shadow-md hover:border-primary transition-all no-underline group block">
                <div class="text-[32px] mb-[10px] group-hover:scale-110 transition-transform">🏛️</div>
                <h4 class="m-0 text-[14px] font-bold text-text-main group-hover:text-primary transition-colors">Pemerintahan</h4>
                <p class="m-0 text-[11px] text-text-muted mt-[4px]">LPPD & LKPPD</p>
            </a>

            
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-[25px]">
        <div class="lg:col-span-2 bg-white rounded-[12px] shadow-sm border border-border overflow-hidden flex flex-col">
            <div class="p-[20px] border-b border-border flex justify-between items-center bg-gray-50">
                <h2 class="text-[16px] font-bold text-text-main m-0">Aspirasi Masuk Terbaru</h2>
                <a href="{{ route('admin.aspirasi.index') }}" class="text-[12px] font-bold text-primary hover:underline">Lihat Semua &rarr;</a>
            </div>
            <div class="p-[10px_20px]">
                @forelse($aspirasiTerbaru as $asp)
                <div class="py-[12px] border-b border-gray-100 last:border-0 flex justify-between items-start gap-[15px]">
                    <div>
                        <h4 class="text-[14px] font-bold text-text-main m-0 mb-[4px] leading-tight">{{ $asp->judul }}</h4>
                        <p class="text-[12px] text-text-muted m-0">Dari: {{ $asp->is_anonim ? 'Anonim' : $asp->nama_pengirim }} • {{ $asp->created_at->diffForHumans() }}</p>
                    </div>
                    <span class="px-[8px] py-[3px] rounded-[4px] text-[11px] font-bold {{ $asp->status == 'Menunggu' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-600' }}">
                        {{ $asp->status }}
                    </span>
                </div>
                @empty
                <div class="py-[30px] text-center text-text-muted text-[13px]">Belum ada aspirasi dari warga.</div>
                @endforelse
            </div>
        </div>

        <div class="bg-primary/5 rounded-[12px] border border-primary/20 p-[25px] flex flex-col justify-center">
            <div class="text-[40px] mb-[15px] text-center">💡</div>
            <h3 class="text-[16px] font-bold text-text-main mb-[10px] text-center">Tips Pengelolaan</h3>
            <p class="text-[13px] text-text-muted text-center leading-relaxed mb-[20px]">
                Pastikan Anda selalu merespon aspirasi warga yang berstatus <strong class="text-yellow-600">Menunggu</strong> agar transparansi dan pelayanan publik desa tetap terjaga dengan baik.
            </p>
            <a href="{{ url('/') }}" target="_blank" class="block w-full bg-white border border-primary text-primary text-center py-[10px] rounded-lg font-bold text-[13px] hover:bg-primary hover:text-white transition-colors">
                🌐 Kunjungi Web Publik
            </a>
        </div>
    </div>

</div>
@endsection