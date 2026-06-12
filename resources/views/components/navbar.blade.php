<nav class="bg-white py-[15px] shadow-sm sticky top-0 z-[100]">
    <div class="container mx-auto px-5 max-w-6xl flex flex-col md:flex-row justify-between items-center gap-[15px] md:gap-0">
        
        <a href="{{ url('/') }}" class="font-bold text-[24px] text-primary no-underline">
            Gunung Sembung.
        </a>

        <ul class="list-none flex items-center gap-5 m-0 p-0">
            <li>
                <a href="{{ url('/') }}" class="block py-[10px] text-[15px] no-underline font-semibold transition-colors duration-200 hover:text-primary {{ request()->is('/') ? 'text-primary' : 'text-text-muted' }}">
                    Beranda
                </a>
            </li>
            
            <li>
                <a href="{{ url('/profile') }}" class="block py-[10px] text-[15px] no-underline font-semibold transition-colors duration-200 hover:text-primary {{ request()->is('profile') || request()->is('profil') ? 'text-primary' : 'text-text-muted' }}">
                    Profil
                </a>
            </li>
            
            {{-- Dropdown Informasi Desa --}}
            <li class="relative group">
                <button id="dropdownButton"
                    class="flex items-center gap-[5px] text-[15px] font-semibold transition-colors duration-200 hover:text-primary py-[10px] bg-transparent border-none cursor-pointer {{ request()->is('berita*') || request()->is('pengumuman*') || request()->is('pembangunan*') || request()->is('keuangan-desa*') || request()->is('laporan-pemerintahan*') || request()->is('layanan-informasi*') || request()->is('hak-masyarakat*') ? 'text-primary' : 'text-text-muted' }}">
                    Informasi Desa
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div id="dropdownMenu"
                    class="absolute left-0 top-full w-[240px] bg-white border border-border rounded-[8px] shadow-lg opacity-0 invisible translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 z-50 overflow-hidden">
                    <ul class="flex flex-col m-0 p-0 list-none">
                        <li>
                            <a href="{{ route('publik.berita.index') }}" class="flex items-center gap-[10px] px-[20px] py-[12px] text-[14px] text-text-main no-underline border-b border-border hover:text-primary hover:bg-primary-light/5 transition-colors {{ request()->is('berita*') ? 'text-primary bg-primary-light/5' : '' }}">
                                <span class="text-[16px]">📰</span> Kabar Berita
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('publik.pembangunan.index') }}" class="flex items-center gap-[10px] px-[20px] py-[12px] text-[14px] text-text-main no-underline border-b border-border hover:text-primary hover:bg-primary-light/5 transition-colors {{ request()->is('pembangunan*') ? 'text-primary bg-primary-light/5' : '' }}">
                                <span class="text-[16px]">🏗️</span> Laporan Pembangunan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('publik.keuangan.index') }}" class="flex items-center gap-[10px] px-[20px] py-[12px] text-[14px] text-text-main no-underline border-b border-border hover:text-primary hover:bg-primary-light/5 transition-colors {{ request()->is('keuangan-desa*') ? 'text-primary bg-primary-light/5' : '' }}">
                                <span class="text-[16px]">💰</span> Laporan Keuangan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('publik.pemerintahan.index') }}" class="flex items-center gap-[10px] px-[20px] py-[12px] text-[14px] text-text-main no-underline border-b border-border hover:text-primary hover:bg-primary-light/5 transition-colors {{ request()->is('laporan-pemerintahan*') ? 'text-primary bg-primary-light/5' : '' }}">
                                <span class="text-[16px]">🏛️</span> Laporan Pemerintah
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('publik.hak-masyarakat') }}" class="flex items-center gap-[10px] px-[20px] py-[12px] text-[14px] text-text-main no-underline hover:text-primary hover:bg-primary-light/5 transition-colors {{ request()->is('hak-masyarakat*') ? 'text-primary bg-primary-light/5' : '' }}">
                                <span class="text-[16px]">⚖️</span> Hak Masyarakat
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <a href="{{ route('publik.aspirasi') }}" class="block py-[10px] text-[15px] no-underline font-semibold transition-colors duration-200 hover:text-primary {{ request()->is('aspirasi') ? 'text-primary' : 'text-text-muted' }}">
                    Aspirasi
                </a>
            </li>
            
            <li>
                <a href="{{ url('/kontak') }}" class="block py-[10px] text-[15px] no-underline font-semibold transition-colors duration-200 hover:text-primary {{ request()->is('kontak') ? 'text-primary' : 'text-text-muted' }}">
                    Kontak
                </a>
            </li>
        </ul>
        
    </div>
</nav>

{{-- JavaScript untuk toggle dropdown di mobile --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownBtn = document.getElementById('dropdownButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        if (dropdownBtn && dropdownMenu) {
            // Toggle saat tombol diklik
            dropdownBtn.addEventListener('click', function(e) {
                e.stopPropagation(); // mencegah event sampai ke document
                dropdownMenu.classList.toggle('opacity-0');
                dropdownMenu.classList.toggle('invisible');
                dropdownMenu.classList.toggle('translate-y-2');
                dropdownMenu.classList.toggle('opacity-100');
                dropdownMenu.classList.toggle('visible');
                dropdownMenu.classList.toggle('translate-y-0');
            });

            // Tutup dropdown jika klik di luar area tombol/dropdown
            document.addEventListener('click', function(event) {
                if (!dropdownBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('opacity-0', 'invisible', 'translate-y-2');
                    dropdownMenu.classList.remove('opacity-100', 'visible', 'translate-y-0');
                }
            });
        }
    });
</script>