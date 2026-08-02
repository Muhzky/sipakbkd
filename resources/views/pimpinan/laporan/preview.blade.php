@extends('layouts.main')

@section('title', 'Preview Laporan')

@push('styles')
<style>
    .table-laporan thead th {
        background-color: var(--primary);
        color: white;
        border-bottom: 2px solid var(--primary-dark);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 13px;
    }
    .table-laporan tbody td {
        vertical-align: middle;
        font-size: 14px;
    }
    .table-laporan tfoot th {
        background-color: var(--mint);
        color: var(--primary-dark);
        font-weight: 700;
        font-size: 14px;
    }
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
                @if($params['bulan'] ?? false)
                    <p>Bulan: {{ \Carbon\Carbon::create()->month($params['bulan'])->format('F') }}</p>
                @endif
                @if($params['tahun'] ?? false)
                    <p>Tahun: {{ $params['tahun'] }}</p>
                @endif
                @if($params['status'] ?? false)
                    <p>Status: {{ ucfirst($params['status']) }}</p>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-laporan">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Pengajuan</th>
                                <th>Nama Pegawai</th>
                                <th>NIP</th>
                                <th>Tanggal</th>
                                <th>Pangkat Baru</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengajuans as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->nomor_pengajuan }}</td>
                                <td>{{ $p->pegawai->user->nama }}</td>
                                <td>{{ $p->pegawai->user->nip }}</td>
                                <td>{{ $p->tanggal->format('d/m/Y') }}</td>
                                <td>{{ $p->pangkat_baru }}</td>
                                <td>{{ ucfirst(str_replace('_', ' ', $p->status)) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="6" class="text-end">Total :</th>
                                <th>{{ $pengajuans->count() }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

