<nav class="bg-white py-[15px] shadow-sm sticky top-0 z-[100]">
    <div class="container mx-auto px-5 max-w-6xl flex flex-col md:flex-row justify-between items-center gap-[15px] md:gap-0">
        <a href="{{ url('/') }}" class="font-bold text-[24px] text-primary no-underline">
            Gunung Sembung.
        </a>

        <ul class="list-none flex gap-5 m-0 p-0">
            <li>
                <a href="{{ url('/') }}" class="no-underline font-semibold transition-colors duration-200 hover:text-primary {{ request()->is('/') ? 'text-primary' : 'text-text-muted' }}">
                    Beranda
                </a>
            </li>
            <li>
                <a href="{{ url('/profile') }}" class="no-underline font-semibold transition-colors duration-200 hover:text-primary {{ request()->is('profile') || request()->is('profil') ? 'text-primary' : 'text-text-muted' }}">
                    Profil
                </a>
            </li>
            <li>
                <a href="{{ url('/potensi-desa') }}" class="no-underline font-semibold transition-colors duration-200 hover:text-primary {{ request()->is('potensi-desa') ? 'text-primary' : 'text-text-muted' }}">
                    Potensi
                </a>
            </li>
            <li>
                <a href="{{ url('/kontak') }}" class="no-underline font-semibold transition-colors duration-200 hover:text-primary {{ request()->is('kontak') ? 'text-primary' : 'text-text-muted' }}">
                    Kontak
                </a>
            </li>
        </ul>
    </div>
</nav>