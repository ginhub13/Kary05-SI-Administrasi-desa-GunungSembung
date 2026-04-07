@extends('layouts.admin')

@section('title', 'Dashboard - SID Gunung Sembung')

@push('styles')
<style>
    /* Styling khusus komponen di halaman Dashboard */
    .widgets {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }

    .card {
        background-color: var(--white);
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .card-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 24px;
    }

    .bg-blue {
        background-color: #E0F2FE;
        color: #0284C7;
    }

    .bg-green {
        background-color: #DCFCE7;
        color: #16A34A;
    }

    .bg-orange {
        background-color: #FFEDD5;
        color: #EA580C;
    }

    .bg-purple {
        background-color: #F3E8FF;
        color: #9333EA;
    }

    .card-info h3 {
        margin: 0 0 5px 0;
        font-size: 14px;
        color: var(--text-muted);
        font-weight: 500;
    }

    .card-info p {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
        color: var(--text-main);
    }

    .table-section {
        background-color: var(--white);
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border);
        overflow: hidden;
    }

    .table-header {
        padding: 20px;
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-header h2 {
        margin: 0;
        font-size: 16px;
    }

    .view-all {
        color: var(--primary);
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
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
    }

    tr:last-child td {
        border-bottom: none;
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

    .status.pending {
        background-color: #FEF3C7;
        color: #D97706;
    }

    .status.approved {
        background-color: #DCFCE7;
        color: #16A34A;
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <h1>Ringkasan SID Gunung Sembung</h1>
    <a href="#" class="btn-action"><span>+</span> Buat Surat Baru</a>
</div>

<div class="widgets">
    <div class="card">
        <div class="card-icon bg-blue">👥</div>
        <div class="card-info">
            <h3>Total Penduduk</h3>
            <p>5,421</p>
        </div>
    </div>
    <div class="card">
        <div class="card-icon bg-orange">📄</div>
        <div class="card-info">
            <h3>Permintaan Surat (Bulan Ini)</h3>
            <p>128</p>
        </div>
    </div>
    <div class="card">
        <div class="card-icon bg-green">💰</div>
        <div class="card-info">
            <h3>Dana Desa Terserap</h3>
            <p>68%</p>
        </div>
    </div>
    <div class="card">
        <div class="card-icon bg-purple">🌱</div>
        <div class="card-info">
            <h3>Potensi/UMKM Terdata</h3>
            <p>32</p>
        </div>
    </div>
</div>

<div class="table-section">
    <div class="table-header">
        <h2>Permintaan Layanan Surat Terbaru</h2>
        <a href="#" class="view-all">Lihat Semua</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>No. Tiket</th>
                <th>Nama Pemohon</th>
                <th>Jenis Surat</th>
                <th>Tanggal Request</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#SRT-20260404-01</td>
                <td>Asep Sunarya</td>
                <td>Surat Pengantar SKCK</td>
                <td>04 Apr 2026</td>
                <td><span class="status pending">Menunggu Diproses</span></td>
                <td><a href="#" style="color: #0284C7; text-decoration: none; font-weight: 600;">Proses</a></td>
            </tr>
            <tr>
                <td>#SRT-20260403-05</td>
                <td>Siti Aminah</td>
                <td>Surat Keterangan Usaha (SKU)</td>
                <td>03 Apr 2026</td>
                <td><span class="status approved">Selesai / Dicetak</span></td>
                <td><a href="#" style="color: #64748B; text-decoration: none;">Detail</a></td>
            </tr>
            <tr>
                <td>#SRT-20260403-04</td>
                <td>Rudi Hartono</td>
                <td>Surat Keterangan Domisili</td>
                <td>03 Apr 2026</td>
                <td><span class="status approved">Selesai / Dicetak</span></td>
                <td><a href="#" style="color: #64748B; text-decoration: none;">Detail</a></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection