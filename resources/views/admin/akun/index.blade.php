@extends('layouts.admin')

@section('title', 'Kelola Akun Petugas - SID')

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
    @if ($errors->any())
        <div class="bg-orange-50 border-l-[4px] border-orange-500 text-orange-800 p-[15px] rounded-[8px] shadow-sm text-[13px]">
            <ul class="m-0 pl-[20px]">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex justify-between items-center flex-wrap gap-[15px]">
        <div>
            <h1 class="text-[24px] font-bold text-text-main">Kelola Akun Petugas</h1>
            <p class="text-text-muted text-[14px]">Tambahkan perangkat desa lain sebagai pengelola sistem SID.</p>
        </div>
        <button onclick="openPetugasModal(null)" class="bg-primary-light text-white px-[20px] py-[10px] rounded-[8px] font-semibold text-[14px] hover:brightness-110 flex items-center gap-[8px] cursor-pointer shadow-sm">
            <span>+</span> Tambah Petugas
        </button>
    </div>

    <div class="bg-white rounded-[12px] shadow-sm border border-border overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-border">
                    <th class="p-[15px_20px] text-[13px] font-bold text-text-main uppercase w-[30%]">Nama Lengkap</th>
                    <th class="p-[15px_20px] text-[13px] font-bold text-text-main uppercase w-[25%]">Email Akses</th>
                    <th class="p-[15px_20px] text-[13px] font-bold text-text-main uppercase w-[20%]">Terdaftar Sejak</th>
                    <th class="p-[15px_20px] text-[13px] font-bold text-text-main uppercase text-center w-[25%]">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-[14px]">
                @forelse($dataPetugas as $item)
                <tr class="border-b border-border hover:bg-gray-50 transition-all">
                    <td class="p-[15px_20px]">
                        <div class="flex items-center gap-[10px]">
                            <div class="w-[35px] h-[35px] rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-[14px] uppercase">
                                {{ substr($item->name, 0, 1) }}
                            </div>
                            <div>
                                <strong class="text-text-main block">{{ $item->name }}</strong>
                                @if($item->id == Auth::id())
                                    <span class="bg-green-100 text-green-700 px-[6px] py-[2px] rounded-[4px] text-[10px] font-bold uppercase mt-[3px] inline-block">Anda (Sedang Login)</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="p-[15px_20px] font-mono text-[13px] text-text-muted">
                        {{ $item->email }}
                    </td>
                    <td class="p-[15px_20px] text-text-muted text-[13px]">
                        {{ $item->created_at->format('d M Y') }}
                    </td>
                    <td class="p-[15px_20px]">
                        <div class="flex justify-center gap-[12px]">
                            <button onclick="openPetugasModal({{ json_encode($item) }})" class="text-blue-500 hover:text-blue-700 font-bold bg-transparent border-none cursor-pointer flex items-center gap-[4px] text-[13px]">
                                ✏️ Edit
                            </button>
                            
                            @if($item->id != Auth::id())
                                <form action="{{ route('admin.akun.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akses akun petugas ini permanen?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-bold bg-transparent border-none cursor-pointer flex items-center gap-[4px] text-[13px]">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-300 font-bold cursor-not-allowed flex items-center gap-[4px] text-[13px]" title="Tidak bisa menghapus akun sendiri">
                                    🗑️ Hapus
                                </span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-[30px] text-center text-text-muted">Tidak ada data petugas lain.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="petugasModal" class="fixed inset-0 bg-black/60 z-[100] hidden items-center justify-center opacity-0 transition-opacity duration-300 backdrop-blur-sm">
    <div class="bg-white rounded-[12px] w-full max-w-[400px] shadow-xl mx-[20px] overflow-hidden">
        <div class="flex justify-between items-center p-[20px] border-b">
            <div>
                <h2 id="modalTitle" class="text-[18px] font-bold text-text-main m-0">Tambah Petugas Baru</h2>
                <p id="modalSubtitle" class="text-[12px] text-text-muted m-0 mt-[2px]">Masukkan detail identitas dan akses login.</p>
            </div>
            <button onclick="closePetugasModal()" class="text-[#94A3B8] text-[28px] leading-none cursor-pointer hover:text-red-500">&times;</button>
        </div>

        <form id="petugasForm" method="POST" class="p-[20px] flex flex-col gap-[15px]">
            @csrf
            <input type="hidden" id="formMethod" name="_method" value="POST">
            
            <div>
                <label class="block text-[12px] font-bold mb-[5px] uppercase text-text-muted">Nama Lengkap (Asli) <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="formNama" required placeholder="Contoh: Budi Santoso" class="w-full bg-gray-50 border border-border p-[10px] rounded-md text-[14px]">
            </div>

            <div>
                <label class="block text-[12px] font-bold mb-[5px] uppercase text-text-muted">Email Login <span class="text-red-500">*</span></label>
                <input type="email" name="email" id="formUsername" required placeholder="Contoh: budi_desa@example.com" class="w-full bg-gray-50 border border-border p-[10px] rounded-md text-[14px] font-mono">
                <span class="block mt-[4px] text-[11px] text-text-muted">*Tanpa spasi, digunakan untuk masuk ke dashboard.</span>
            </div>

            <div>
                <label class="block text-[12px] font-bold mb-[5px] uppercase text-text-muted">Kata Sandi / Password <span id="pwdAsterisk" class="text-red-500">*</span></label>
                <div class="relative">
                    <input type="password" name="password" id="formPassword" placeholder="Minimal 6 karakter" class="w-full bg-gray-50 border border-border p-[10px] rounded-md text-[14px] pr-[40px]">
                    <button type="button" id="pwdToggle" onclick="togglePassword()" class="absolute right-[8px] top-1/2 -translate-y-1/2 text-[14px] text-text-muted">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
                <span id="pwdHelp" class="block mt-[4px] text-[11px] text-text-muted hidden text-orange-600 font-medium">*Kosongkan jika tidak ingin mengubah password lama.</span>
            </div>

            <div class="flex justify-end gap-[10px] border-t border-border pt-[15px] mt-[5px]">
                <button type="button" onclick="closePetugasModal()" class="bg-white border border-border p-[10px_20px] rounded-md font-bold text-[13px] hover:bg-gray-50 cursor-pointer">Batal</button>
                <button type="submit" class="bg-primary-light text-white p-[10px_25px] rounded-md font-bold text-[13px] hover:brightness-110 cursor-pointer">Simpan Data</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const m = document.getElementById('petugasModal');
    
    function openPetugasModal(data) {
        const formPwd = document.getElementById('formPassword');
        const pwdHelp = document.getElementById('pwdHelp');
        const pwdAsterisk = document.getElementById('pwdAsterisk');

        if(data) {
            // Mode Edit
            document.getElementById('modalTitle').innerText = 'Edit Akun Petugas';
            document.getElementById('modalSubtitle').innerText = 'Perbarui data atau ubah kata sandi akses.';
            document.getElementById('petugasForm').action = `/admin/akun/${data.id}`;
            document.getElementById('formMethod').value = 'PUT';
            
            document.getElementById('formNama').value = data.name;
            document.getElementById('formUsername').value = data.email;
            
            formPwd.removeAttribute('required'); // Tidak wajib diisi saat edit
            pwdHelp.classList.remove('hidden'); // Tampilkan info kosongkan
            pwdAsterisk.classList.add('hidden'); // Hilangkan tanda bintang
        } else {
            // Mode Tambah Baru
            document.getElementById('modalTitle').innerText = 'Tambah Petugas Baru';
            document.getElementById('modalSubtitle').innerText = 'Masukkan detail identitas dan akses login.';
            document.getElementById('petugasForm').action = "{{ route('admin.akun.store') }}";
            document.getElementById('formMethod').value = 'POST';
            
            document.getElementById('petugasForm').reset();
            
            formPwd.setAttribute('required', 'required'); // Wajib diisi saat buat baru
            pwdHelp.classList.add('hidden');
            pwdAsterisk.classList.remove('hidden');
        }

        m.classList.remove('hidden'); m.classList.add('flex');
        setTimeout(() => { m.classList.add('opacity-100'); }, 10);
    }

    function closePetugasModal() {
        m.classList.remove('opacity-100');
        setTimeout(() => { m.classList.add('hidden'); m.classList.remove('flex'); }, 300);
    }

    function togglePassword() {
        const pwdInput = document.getElementById('formPassword');
        const pwdToggle = document.getElementById('pwdToggle').firstElementChild;

        if (pwdInput.type === 'password') {
            pwdInput.type = 'text';
            pwdToggle.classList.remove('fa-eye');
            pwdToggle.classList.add('fa-eye-slash');
        } else {
            pwdInput.type = 'password';
            pwdToggle.classList.remove('fa-eye-slash');
            pwdToggle.classList.add('fa-eye');
        }
    }
</script>
@endpush