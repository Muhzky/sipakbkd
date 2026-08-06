@extends('layouts.main')

@section('title', 'Dashboard Pimpinan')

@push('styles')
<style>
    .row + .row {
        margin-top: 20px;
    }

    @media (max-width: 575.98px) {
        .row + .row {
            margin-top: 0;
        }
        .row > [class*="col-"] {
            margin-bottom: 19px;
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
            <div class="statistic-icon"><i class="fas fa-users"></i></div>
            <div class="statistic-label">Total Pegawai</div>
            <div class="statistic-value">{{ $totalPegawai }}</div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="statistic-card bg-warning-stat">
            <div class="statistic-icon"><i class="fas fa-clock"></i></div>
            <div class="statistic-label">Menunggu Persetujuan</div>
            <div class="statistic-value">{{ $menungguPersetujuan }}</div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="statistic-card bg-danger-stat">
            <div class="statistic-icon"><i class="fas fa-times-circle"></i></div>
            <div class="statistic-label">Ditolak</div>
            <div class="statistic-value">{{ $ditolak }}</div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="statistic-card bg-success-stat">
            <div class="statistic-icon"><i class="fas fa-check-circle"></i></div>
            <div class="statistic-label">Disetujui</div>
            <div class="statistic-value">{{ $disetujui }}</div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Grafik Statistik Pengajuan Per Bulan ({{ date('Y') }})</h4>
            </div>
            <div class="card-body">
                <canvas id="chartPengajuan" height="300"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    var ctx = document.getElementById('chartPengajuan').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Jumlah Pengajuan',
                data: {!! json_encode($values) !!},
                borderColor: '#6777ef',
                backgroundColor: 'rgba(103,119,239,0.1)',
                fill: true,
                tension: 0.4,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
</script>
@endpush
