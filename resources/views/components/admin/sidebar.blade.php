<aside class="w-[260px] bg-sidebar-bg text-white flex flex-col transition-all duration-300 z-10 shrink-0">

    <a href="{{ url('/admin') }}" class="p-[25px_20px] text-[18px] font-bold text-white no-underline border-b border-white/10 flex items-center gap-[10px]">
        <span class="bg-primary-light text-sidebar-bg rounded-[6px] py-[2px] px-[6px] text-[16px]">S</span>
        SID Gn. Sembung
    </a>

    <ul class="list-none p-[20px_0] m-0 flex-grow overflow-y-auto">
        <div class="px-[20px] pb-[10px] text-[11px] uppercase tracking-[1px] text-[#94A3B8] font-semibold">
            Menu Utama
        </div>

        <li>
            <a href="{{ url('/admin/dashboard') }}" class="flex items-center p-[12px_20px] no-underline font-medium text-[14px] transition-all duration-200 border-l-[3px] {{ request()->is('admin') ? 'bg-[#14B8A61A] text-primary-light !border-primary-light' : 'text-[#CBD5E1] border-transparent hover:bg-sidebar-hover hover:text-white' }}">
                <span class="w-[24px] mr-[10px] text-[18px] text-center">⊞</span> Dashboard
            </a>
        </li>

        <li>
            <a href="#" class="flex items-center p-[12px_20px] no-underline font-medium text-[14px] transition-all duration-200 border-l-[3px] {{ request()->is('admin/penduduk*') ? 'bg-[#14B8A61A] text-primary-light !border-primary-light' : 'text-[#CBD5E1] border-transparent hover:bg-sidebar-hover hover:text-white' }}">
                <span class="w-[24px] mr-[10px] text-[18px] text-center">👥</span> Data Penduduk
            </a>
        </li>

        <li>
            <a href="{{ route('admin.potensi.index') }}" class="flex items-center p-[12px_20px] no-underline font-medium text-[14px] transition-all duration-200 border-l-[3px] {{ request()->is('admin/potensi*') ? 'bg-[#14B8A61A] text-primary-light !border-primary-light' : 'text-[#CBD5E1] border-transparent hover:bg-sidebar-hover hover:text-white' }}">
                <span class="w-[24px] mr-[10px] text-[18px] text-center">🌱</span> Potensi Desa
            </a>
        </li>
    </ul>

    <div class="p-[20px] border-t border-white/10">
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="w-full block text-center text-[#F87171] bg-transparent cursor-pointer font-semibold p-[10px] border border-[#F871714D] rounded-[8px] transition-all duration-200 hover:bg-[#F871711A]">
                Keluar Sistem
            </button>
        </form>
    </div>
</aside>