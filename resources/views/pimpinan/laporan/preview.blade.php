@extends('layouts.main')

@section('title', 'Preview Laporan')

@push('styles')
<style>
    .table-laporan {
        border-collapse: collapse;
        width: 100%;
    }
    .table-laporan thead th {
        background-color: var(--primary);
        color: white;
        border: 1px solid var(--primary-dark);
        padding: 10px 12px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
        text-align: center;
        white-space: nowrap;
    }
    .table-laporan tbody td {
        border: 1px solid #dee2e6;
        padding: 8px 12px;
        font-size: 13px;
        vertical-align: middle;
    }
    .table-laporan tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }
    .table-laporan tbody tr:hover {
        background-color: #e9ecef;
    }
    .table-laporan tfoot th {
        background-color: var(--mint);
        color: var(--primary-dark);
        border: 1px solid var(--primary-dark);
        padding: 10px 12px;
        font-weight: 700;
        font-size: 13px;
    }
    .col-no { width: 40px; text-align: center; }
    .col-nomor { min-width: 140px; }
    .col-nama { min-width: 180px; }
    .col-nip { min-width: 140px; text-align: center; }
    .col-eselon { width: 70px; text-align: center; }
    .col-tanggal { width: 100px; text-align: center; }
    .col-pangkat { min-width: 150px; }
    .col-status { width: 140px; text-align: center; }
</style>
@endpush

@section('content')
<div class="section-header">
    <h1>Preview Laporan</h1>
    <div class="section-header-breadcrumb">
        <a href="{{ route('pimpinan.laporan.index') }}" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Laporan Pengajuan Kenaikan Pangkat</h4>
            </div>
            <div class="card-body">
                <div class="d-flex gap-3 mb-3 flex-wrap">
                    @if($params['bulan'] ?? false)
                        <span class="badge bg-primary">Bulan: {{ \Carbon\Carbon::create()->month($params['bulan'])->format('F') }}</span>
                    @endif
                    @if($params['tahun'] ?? false)
                        <span class="badge bg-info">Tahun: {{ $params['tahun'] }}</span>
                    @endif
                    @if($params['status'] ?? false)
                        <span class="badge bg-secondary">Status: {{ ucfirst(str_replace('_', ' ', $params['status'])) }}</span>
                    @endif
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-laporan">
                        <thead>
                            <tr>
                                <th class="col-no">No</th>
                                <th class="col-nomor">Nomor Pengajuan</th>
                                <th class="col-nama">Nama Pegawai</th>
                                <th class="col-nip">NIP</th>
                                <th class="col-eselon">Eselon</th>
                                <th class="col-tanggal">Tanggal</th>
                                <th class="col-pangkat">Pangkat Baru</th>
                                <th class="col-status">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengajuans as $p)
                            <tr>
                                <td class="col-no">{{ $loop->iteration }}</td>
                                <td class="col-nomor">{{ $p->nomor_pengajuan }}</td>
                                <td class="col-nama">{{ $p->pegawai->user->nama }}</td>
                                <td class="col-nip">{{ $p->pegawai->user->nip }}</td>
                                <td class="col-eselon">{{ $p->pegawai->eselon ?? '-' }}</td>
                                <td class="col-tanggal">{{ $p->tanggal->format('d/m/Y') }}</td>
                                <td class="col-pangkat">{{ $p->pangkat_baru }}</td>
                                <td class="col-status">
                                    @php
                                        $statusClass = match($p->status) {
                                            'disetujui' => 'success',
                                            'ditolak', 'ditolak_operator' => 'danger',
                                            'menunggu', 'menunggu_verifikasi' => 'warning',
                                            'terverifikasi' => 'info',
                                            'dokumen_tidak_lengkap' => 'secondary',
                                            default => 'secondary'
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $statusClass }}">{{ ucfirst(str_replace('_', ' ', $p->status)) }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="7" class="text-end">Total :</th>
                                <th class="col-status">{{ $pengajuans->count() }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
