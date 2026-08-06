@extends('layouts.main')

@section('title', 'Riwayat Pengajuan')

@push('styles')
<style>
    .table-riwayat {
        border-collapse: collapse;
        width: 100%;
    }
    .table-riwayat thead th {
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
    .table-riwayat tbody td {
        border: 1px solid #dee2e6;
        padding: 8px 12px;
        font-size: 13px;
        vertical-align: middle;
    }
    .table-riwayat tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }
    .table-riwayat tbody tr:hover {
        background-color: #e9ecef;
    }
    .col-no { width: 40px; text-align: center; }
    .col-nomor { min-width: 150px; }
    .col-tanggal { width: 100px; text-align: center; }
    .col-pangkat { min-width: 140px; }
    .col-eselon { width: 70px; text-align: center; }
    .col-status { width: 160px; text-align: center; }
    .col-aksi { width: 120px; text-align: center; }

    .badge-menunggu, .badge-dokumen_tidak_lengkap { background-color: #ffc107; color: #000; }
    .badge-menunggu_verifikasi, .badge-terverifikasi { background-color: #17a2b8; }
    .badge-ditolak_operator, .badge-ditolak { background-color: #dc3545; }
    .badge-disetujui { background-color: #28a745; }
</style>
@endpush

@section('content')
<div class="section-header">
    <h1>Riwayat Pengajuan</h1>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Pengajuan Kenaikan Pangkat</h4>
                <div class="card-header-action">
                    <a href="{{ route('pegawai.pengajuan.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Ajukan Baru
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table-riwayat">
                        <thead>
                            <tr>
                                <th class="col-no">No</th>
                                <th class="col-nomor">Nomor Pengajuan</th>
                                <th class="col-tanggal">Tanggal</th>
                                <th class="col-pangkat">Pangkat Lama</th>
                                <th class="col-pangkat">Pangkat Baru</th>
                                <th class="col-eselon">Eselon</th>
                                <th class="col-status">Status</th>
                                <th class="col-aksi">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengajuans as $p)
                            <tr>
                                <td class="col-no">{{ $loop->iteration }}</td>
                                <td class="col-nomor">{{ $p->nomor_pengajuan }}</td>
                                <td class="col-tanggal">{{ $p->tanggal->format('d/m/Y') }}</td>
                                <td class="col-pangkat">{{ $p->pangkat_lama }}</td>
                                <td class="col-pangkat">{{ $p->pangkat_baru }}</td>
                                <td class="col-eselon">{{ Auth::user()->pegawai->eselon ?? '-' }}</td>
                                <td class="col-status">
                                    <span class="badge badge-{{ $p->status }}">
                                        @switch($p->status)
                                            @case('menunggu') Menunggu Pemeriksaan @break
                                            @case('dokumen_tidak_lengkap') Dokumen Tidak Lengkap @break
                                            @case('menunggu_verifikasi') Menunggu Verifikasi @break
                                            @case('ditolak_operator') Ditolak Operator @break
                                            @case('terverifikasi') Terverifikasi @break
                                            @case('disetujui') Disetujui @break
                                            @case('ditolak') Ditolak @break
                                            @default {{ ucfirst($p->status) }}
                                        @endswitch
                                    </span>
                                </td>
                                <td class="col-aksi">
                                    <a href="{{ route('pegawai.pengajuan.show', $p) }}" class="btn btn-sm btn-info text-white" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if(in_array($p->status, ['dokumen_tidak_lengkap', 'ditolak_operator']))
                                        <a href="{{ route('pegawai.pengajuan.edit-dokumen', $p) }}" class="btn btn-sm btn-warning text-white" title="Upload Ulang Dokumen">
                                            <i class="fas fa-upload"></i>
                                        </a>
                                    @endif
                                    @if($p->status == 'disetujui')
                                        <a href="{{ route('pegawai.pengajuan.download-sk', $p) }}" class="btn btn-sm btn-success text-white" title="Download SK">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Belum ada pengajuan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
