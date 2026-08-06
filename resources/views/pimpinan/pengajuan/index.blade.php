@extends('layouts.main')

@section('title', 'Data Pengajuan')

@push('styles')
<style>
    .table-pengajuan {
        border-collapse: collapse;
        width: 100%;
    }
    .table-pengajuan thead th {
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
    .table-pengajuan tbody td {
        border: 1px solid #dee2e6;
        padding: 8px 12px;
        font-size: 13px;
        vertical-align: middle;
    }
    .table-pengajuan tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }
    .table-pengajuan tbody tr:hover {
        background-color: #e9ecef;
    }
    .col-no { width: 40px; text-align: center; }
    .col-nomor { min-width: 150px; }
    .col-nama { min-width: 180px; }
    .col-nip { min-width: 150px; text-align: center; }
    .col-eselon { width: 70px; text-align: center; }
    .col-tanggal { width: 100px; text-align: center; }
    .col-pangkat { min-width: 150px; }
    .col-status { width: 160px; text-align: center; }
    .col-aksi { width: 80px; text-align: center; }

    .badge-terverifikasi { background-color: #17a2b8; }
    .badge-disetujui { background-color: #28a745; }
    .badge-ditolak { background-color: #dc3545; }
</style>
@endpush

@section('content')
<div class="section-header">
    <h1>Data Pengajuan</h1>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Pengajuan Kenaikan Pangkat</h4>
            </div>
            <div class="card-body">
                <form method="GET" class="mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Status</option>
                                <option value="terverifikasi" {{ request('status') == 'terverifikasi' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                                <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table-pengajuan">
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
                                <th class="col-aksi">Aksi</th>
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
                                    <span class="badge badge-{{ $p->status }}">
                                        @switch($p->status)
                                            @case('terverifikasi') Menunggu Persetujuan @break
                                            @case('disetujui') Disetujui @break
                                            @case('ditolak') Ditolak @break
                                            @default {{ ucfirst($p->status) }}
                                        @endswitch
                                    </span>
                                </td>
                                <td class="col-aksi">
                                    @switch($p->status)
                                        @case('terverifikasi')
                                            <a href="{{ route('pimpinan.pengajuan.show', $p) }}" class="btn btn-sm btn-success text-white" title="Setujui/Tolak">
                                                <i class="fas fa-check-double"></i>
                                            </a>
                                            @break
                                        @case('disetujui')
                                            <a href="{{ route('pimpinan.pengajuan.show', $p) }}" class="btn btn-sm btn-info text-white" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @break
                                        @case('ditolak')
                                            <a href="{{ route('pimpinan.pengajuan.show', $p) }}" class="btn btn-sm btn-secondary" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @break
                                        @default
                                            <span class="text-muted">-</span>
                                    @endswitch
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada pengajuan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $pengajuans->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
