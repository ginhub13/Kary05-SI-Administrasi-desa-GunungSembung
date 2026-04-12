@extends('layouts.admin')

@section('title', 'Kelola Potensi Desa - SID Gunung Sembung')

@push('styles')
<style>
    .table-section {
        background-color: var(--white);
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border);
        overflow: hidden;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    th {
        padding: 15px 20px;
        background-color: #F8FAFC;
        color: var(--text-muted);
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
        border-bottom: 1px solid var(--border);
    }

    td {
        padding: 15px 20px;
        border-bottom: 1px solid var(--border);
        font-size: 14px;
        vertical-align: middle;
    }

    tr:hover td {
        background-color: #F8FAFC;
    }

    .status {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .publish {
        background-color: #DCFCE7;
        color: #16A34A;
    }

    .draft {
        background-color: #F1F5F9;
        color: #64748B;
    }

    .img {
        width: 60px;
        height: 40px;
        background: #e2e8f0;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        color: #94a3b8;
    }

    .action a {
        margin-right: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 13px;
    }

    .edit { color: #0284c7; }
    .delete { color: #ef4444; }
</style>
@endpush

@section('content')
<div class="page-header">
    <h1>Kelola Potensi Desa</h1>
    <a href="#" class="btn-action">+ Tambah Potensi Baru</a>
</div>

<div class="table-section">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Judul Potensi</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

            <!-- DATA DUMMY 1 -->
            <tr>
                <td>1</td>
                <td><div class="img">IMG</div></td>
                <td>
                    <strong>Contoh Produk UMKM</strong><br>
                    <small style="color:#94a3b8;">Pengelola: BUMDes</small>
                </td>
                <td>UMKM</td>
                <td><span class="status publish">Publish</span></td>
                <td class="action">
                    <a href="#" class="edit">Edit</a>
                    <a href="#" class="delete">Hapus</a>
                </td>
            </tr>

            <!-- DATA DUMMY 2 -->
            <tr>
                <td>2</td>
                <td><div class="img">IMG</div></td>
                <td>
                    <strong>Hasil Pertanian Desa</strong><br>
                    <small style="color:#94a3b8;">Pengelola: Kelompok Tani</small>
                </td>
                <td>Pertanian</td>
                <td><span class="status draft">Draft</span></td>
                <td class="action">
                    <a href="#" class="edit">Edit</a>
                    <a href="#" class="delete">Hapus</a>
                </td>
            </tr>

        </tbody>
    </table>
</div>
@endsection