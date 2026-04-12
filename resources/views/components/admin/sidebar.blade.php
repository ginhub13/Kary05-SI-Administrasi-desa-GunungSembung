<aside class="sidebar">
    <a href="{{ url('/admin/dashboard') }}" class="brand">
        <span class="brand-icon">S</span> SID Gn. Sembung
    </a>
    <ul class="menu">
        <div class="menu-title">Menu Utama</div>
        <li class="menu-item">
            <a href="{{ url('/admin/dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <span class="icon">⊞</span> Dashboard
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="{{ request()->is('admin/penduduk*') ? 'active' : '' }}">
                <span class="icon">👥</span> Data Penduduk
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="{{ request()->is('admin/surat*') ? 'active' : '' }}">
                <span class="icon">📄</span> Layanan Surat
            </a>
        </li>

        <div class="menu-title" style="margin-top: 20px;">Manajemen Desa</div>
        <li class="menu-item">
            <a href="{{ url('/admin/potensi') }}" class="{{ request()->is('admin/potensi*') ? 'active' : '' }}">
                <span class="icon">🌱</span> Potensi Desa
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="{{ request()->is('admin/keuangan*') ? 'active' : '' }}">
                <span class="icon">💰</span> Keuangan & BUMDes
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="{{ request()->is('admin/berita*') ? 'active' : '' }}">
                <span class="icon">📢</span> Berita & Pengumuman
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="{{ request()->is('admin/pengaturan*') ? 'active' : '' }}">
                <span class="icon">⚙️</span> Pengaturan
            </a>
        </li>
    </ul>
    <div class="logout">
        <a href="#">Keluar Sistem</a>
    </div>
</aside>