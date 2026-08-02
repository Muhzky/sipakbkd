@extends('layouts.main')

@section('title', 'Dashboard Pegawai')

@push('styles')
<style>
    .row + .row {
        margin-top: 20px;
    }

    @media (min-width: 300px) {
        .row + .row {
            margin-top: 0;
        }
        .row > [class*="col-"] {
            margin-bottom: 19px;
        }
        .menu-cepat-btn {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            text-align: center;
        }
        .menu-cepat-btn:last-child {
            margin-bottom: 0;
        }
    }
</style>
@endpush

@section('content')
<div class="section-header">
    <h1>Dashboard</h1>
    <div class="section-header-breadcrumb">
        <span>Selamat datang, {{ Auth::user()->nama }}</span>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="statistic-card bg-primary-stat">
            <div class="statistic-icon"><i class="fas fa-file-alt"></i></div>
            <div class="statistic-label">Total Pengajuan</div>
            <div class="statistic-value">{{ $pengajuans->count() }}</div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="statistic-card bg-warning-stat">
            <div class="statistic-icon"><i class="fas fa-clock"></i></div>
            <div class="statistic-label">Menunggu Verifikasi</div>
            <div class="statistic-value">{{ $totalMenunggu }}</div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="statistic-card bg-info-stat">
            <div class="statistic-icon"><i class="fas fa-spinner"></i></div>
            <div class="statistic-label">Diproses</div>
            <div class="statistic-value">{{ $totalDiproses }}</div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="statistic-card bg-success-stat">
            <div class="statistic-icon"><i class="fas fa-check-circle"></i></div>
            <div class="statistic-label">Disetujui</div>
            <div class="statistic-value">{{ $totalDisetujui }}</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="statistic-card bg-danger-stat">
            <div class="statistic-icon"><i class="fas fa-times-circle"></i></div>
            <div class="statistic-label">Ditolak</div>
            <div class="statistic-value">{{ $totalDitolak }}</div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Menu Cepat</h4>
            </div>
            <div class="card-body">
                <a href="{{ route('pegawai.pengajuan.create') }}" class="btn btn-primary menu-cepat-btn">
                    <i class="fas fa-plus-circle me-2"></i>Ajukan Kenaikan Pangkat
                </a>
                <a href="{{ route('pegawai.riwayat') }}" class="btn btn-info text-white menu-cepat-btn">
                    <i class="fas fa-history me-2"></i>Riwayat Pengajuan
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
