@extends('layouts.main')

@section('title', 'Dashboard Admin')

@push('styles')
<style>
    :root {
        --sipak-primary: #12A150;
        --sipak-primary-dark: #0B5C33;
        --sipak-mint: #EAF7EF;
        --sipak-text: #34395E;
        --sipak-border: #E4E6EF;
        --sipak-warning: #E8A33D;
        --sipak-danger: #D9534F;
        --sipak-info: #2F9E8F;
    }

    .section-header h1 {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        color: var(--sipak-text);
    }
    .section-header-breadcrumb span {
        color: #9095ac;
        font-size: 10pt;
    }

    .statistic-card {
        border: 1px solid var(--sipak-border);
        border-radius: 14px;
        box-shadow: 0 8px 20px rgba(52,57,94,0.05);
        padding: 22px;
        color: #fff;
        position: relative;
        overflow: hidden;
    }
    .statistic-icon {
        font-size: 20px;
        opacity: 0.9;
        margin-bottom: 8px;
    }
    .statistic-label {
        font-size: 9pt;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        opacity: 0.9;
    }
    .statistic-value {
        font-size: 26pt;
        font-weight: 700;
        font-family: 'Poppins', sans-serif;
    }

    .bg-primary-stat { background: linear-gradient(135deg, var(--sipak-primary), var(--sipak-primary-dark)); }
    .bg-info-stat    { background: linear-gradient(135deg, var(--sipak-info), #1f6e63); }
    .bg-warning-stat { background: linear-gradient(135deg, var(--sipak-warning), #c67f22); }
    .bg-success-stat { background: linear-gradient(135deg, #2FBE72, var(--sipak-primary-dark)); }
    .bg-danger-stat  { background: linear-gradient(135deg, var(--sipak-danger), #a83a37); }

    .card {
        border: 1px solid var(--sipak-border);
        border-radius: 14px;
        box-shadow: 0 12px 32px rgba(52,57,94,0.06);
    }
    .card-header {
        background: #fff;
        border-bottom: 1px solid var(--sipak-border);
        border-radius: 14px 14px 0 0;
    }
    .card-header h4 {
        font-family: 'Poppins', sans-serif;
        font-size: 12pt;
        font-weight: 600;
        color: var(--sipak-text);
        margin: 0;
    }

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
            <div class="statistic-label">Menunggu Verifikasi</div>
            <div class="statistic-value">{{ $menungguVerifikasi }}</div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="statistic-card bg-info-stat">
            <div class="statistic-icon"><i class="fas fa-check-circle"></i></div>
            <div class="statistic-label">Terverifikasi</div>
            <div class="statistic-value">{{ $terverifikasi }}</div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="statistic-card bg-warning-stat">
            <div class="statistic-icon"><i class="fas fa-exclamation-triangle"></i></div>
            <div class="statistic-label">Dokumen Tidak Lengkap</div>
            <div class="statistic-value">{{ $menunggu }}</div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="statistic-card bg-danger-stat">
            <div class="statistic-icon"><i class="fas fa-undo"></i></div>
            <div class="statistic-label">Ditolak Operator</div>
            <div class="statistic-value">{{ $ditolakOperator }}</div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="statistic-card bg-danger-stat">
            <div class="statistic-icon"><i class="fas fa-times-circle"></i></div>
            <div class="statistic-label">Ditolak</div>
            <div class="statistic-value">{{ $ditolak }}</div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
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
                <h4>Grafik Pengajuan Per Bulan ({{ date('Y') }})</h4>
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
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Jumlah Pengajuan',
                data: {!! json_encode($values) !!},
                backgroundColor: '#12A150',
                hoverBackgroundColor: '#0B5C33',
                borderRadius: 5,
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
