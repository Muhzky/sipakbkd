@extends('layouts.main')

@section('title', 'Riwayat Pengajuan')

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
                {{-- ================= DAFTAR PENGAJUAN ================= --}}
                <h6 class="text-uppercase text-muted fw-bold mb-3" style="font-size: 11px; letter-spacing: .5px;">
                    <i class="fas fa-history me-1"></i> Daftar Pengajuan
                </h6>
                <div class="table-responsive">
                    <table class="table table-striped" id="tableRiwayat">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Pengajuan</th>
                                <th>Tanggal</th>
                                <th>Pangkat Lama</th>
                                <th>Pangkat Baru</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengajuans as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->nomor_pengajuan }}</td>
                                <td>{{ $p->tanggal->format('d/m/Y') }}</td>
                                <td>{{ $p->pangkat_lama }}</td>
                                <td>{{ $p->pangkat_baru }}</td>
                                <td>
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
                                <td>
                                    <a href="{{ route('pegawai.pengajuan.show', $p) }}" class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if(in_array($p->status, ['dokumen_tidak_lengkap', 'ditolak_operator']))
                                        <a href="{{ route('pegawai.pengajuan.edit-dokumen', $p) }}" class="btn btn-sm btn-warning text-white">
                                            <i class="fas fa-upload"></i> Upload Ulang
                                        </a>
                                    @endif
                                    @if($p->status == 'disetujui')
                                        <a href="{{ route('pegawai.pengajuan.download-sk', $p) }}" class="btn btn-sm btn-success text-white">
                                            <i class="fas fa-file-pdf"></i> SK
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada pengajuan</td>
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

@push('scripts')
<script>
    $(document).ready(function() {
        $('#tableRiwayat').DataTable();
    });
</script>
@endpush