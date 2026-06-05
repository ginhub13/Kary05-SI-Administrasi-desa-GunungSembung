@extends('layouts.admin')

@section('title', 'Tulis Berita - SID Gunung Sembung')

@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    /* Kustomisasi tampilan editor agar senada dengan template */
    .ql-toolbar.ql-snow {
        border-color: #E2E8F0;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
        background-color: #F8FAFC;
    }
    .ql-container.ql-snow {
        border-color: #E2E8F0;
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
        background-color: #F8FAFC;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 14px;
        min-height: 300px;
    }
    .ql-editor {
        min-height: 300px;
    }
</style>
@endpush

@section('content')
<div class="flex flex-col gap-[25px] max-w-[900px] mx-auto w-full">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-[24px] font-bold text-text-main">Tulis Artikel Baru</h1>
            <p class="text-text-muted text-[14px]">Publikasikan berita atau kegiatan desa.</p>
        </div>
        <a href="{{ route('admin.berita.index') }}" class="bg-white border border-border text-text-main px-[20px] py-[10px] rounded-[8px] font-semibold text-[14px] hover:bg-gray-50 transition-all flex items-center gap-[8px]">
            <span>⬅️</span> Kembali
        </a>
    </div>

    <div class="bg-white rounded-[12px] shadow-sm border border-border p-[30px]">
        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-[20px]" id="formBerita">
            @csrf

            {{-- Judul --}}
            <div>
                <label class="block text-[13px] font-bold text-text-main mb-[8px] uppercase">Judul Artikel <span class="text-red-500">*</span></label>
                <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Jadwal Pembagian BLT Bulan Ini" class="w-full bg-bg-color border border-border px-[15px] py-[10px] rounded-[8px] text-[14px] text-text-main outline-none focus:border-primary-light transition-all">
                @error('judul') <p class="text-red-500 text-[12px] mt-[5px]">{{ $message }}</p> @enderror
            </div>

            {{-- Kategori & Status --}}
            <div class="flex flex-col md:flex-row gap-[20px]">
                <div class="flex-1">
                    <label class="block text-[13px] font-bold text-text-main mb-[8px] uppercase">Kategori <span class="text-red-500">*</span></label>
                    <select name="kategori" class="w-full bg-bg-color border border-border px-[15px] py-[10px] rounded-[8px] text-[14px] text-text-main outline-none focus:border-primary-light transition-all cursor-pointer">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Pemerintahan" {{ old('kategori') == 'Pemerintahan' ? 'selected' : '' }}>🏛️ Pemerintahan Desa</option>
                        <option value="Infrastruktur" {{ old('kategori') == 'Infrastruktur' ? 'selected' : '' }}>🏗️ Infrastruktur</option>
                        <option value="Sosial & Budaya" {{ old('kategori') == 'Sosial & Budaya' ? 'selected' : '' }}>🤝 Sosial & Budaya</option>
                        <option value="Ekonomi & BUMDes" {{ old('kategori') == 'Ekonomi & BUMDes' ? 'selected' : '' }}>💰 Ekonomi & BUMDes</option>
                        <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>📌 Lainnya</option>
                    </select>
                    @error('kategori') <p class="text-red-500 text-[12px] mt-[5px]">{{ $message }}</p> @enderror
                </div>
                
                <div class="w-full md:w-[250px]">
                    <label class="block text-[13px] font-bold text-text-main mb-[8px] uppercase">Status Terbit <span class="text-red-500">*</span></label>
                    <select name="status_terbit" class="w-full bg-bg-color border border-border px-[15px] py-[10px] rounded-[8px] text-[14px] text-text-main outline-none focus:border-primary-light transition-all cursor-pointer">
                        <option value="Draft" {{ old('status_terbit') == 'Draft' ? 'selected' : '' }}>Simpan sebagai Draft</option>
                        <option value="Terbit" {{ old('status_terbit') == 'Terbit' ? 'selected' : '' }}>Langsung Terbit (Publik)</option>
                    </select>
                    @error('status_terbit') <p class="text-red-500 text-[12px] mt-[5px]">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Gambar Sampul --}}
            <div>
                <label class="block text-[13px] font-bold text-text-main mb-[8px] uppercase">Gambar Sampul (Thumbnail)</label>
                <input type="file" name="gambar_sampul" accept="image/*" class="w-full bg-bg-color border border-border px-[15px] py-[8px] rounded-[8px] text-[14px] text-text-muted file:mr-[15px] file:py-[6px] file:px-[15px] file:rounded-[6px] file:border-0 file:text-[13px] file:font-semibold file:bg-primary-light file:text-white hover:file:bg-opacity-90 cursor-pointer">
                @error('gambar_sampul') <p class="text-red-500 text-[12px] mt-[5px]">{{ $message }}</p> @enderror
            </div>

            {{-- Konten --}}
            <div>
                <label class="block text-[13px] font-bold text-text-main mb-[8px] uppercase">Isi Konten <span class="text-red-500">*</span></label>
                
                <textarea name="konten" id="kontenAsli" class="hidden">{{ old('konten') }}</textarea>
                
                <div id="quillEditor">{!! old('konten') !!}</div>
                
                @error('konten') <p class="text-red-500 text-[12px] mt-[5px]">{{ $message }}</p> @enderror
            </div>

            {{-- Tombol --}}
            <div class="pt-[15px] border-t border-border flex justify-end gap-[15px] mt-[10px]">
                <button type="submit" class="bg-primary-light text-white px-[30px] py-[10px] rounded-[8px] font-semibold text-[14px] hover:brightness-110 transition-all cursor-pointer">
                    Simpan Artikel
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    // Konfigurasi Toolbar Quill
    var toolbarOptions = [
        [{ 'header': [1, 2, 3, false] }],
        ['bold', 'italic', 'underline', 'strike'],        // Toggled buttons
        ['blockquote', 'code-block'],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'align': [] }],
        ['link', 'image', 'video'],                        // Media
        ['clean']                                         // Remove formatting
    ];

    // Inisialisasi Quill pada div #quillEditor
    var quill = new Quill('#quillEditor', {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow',
        placeholder: 'Tulis isi berita di sini...'
    });

    // Menangkap event submit form
    var formBerita = document.getElementById('formBerita');
    var kontenAsli = document.getElementById('kontenAsli');

    formBerita.onsubmit = function(e) {
        // Pindahkan isi HTML dari Quill ke dalam textarea tersembunyi
        var htmlLengkap = quill.root.innerHTML;
        if (htmlLengkap === '<p><br></p>') {
            kontenAsli.value = '';
        } else {
            kontenAsli.value = htmlLengkap;
        }
    };
</script>
@endpush