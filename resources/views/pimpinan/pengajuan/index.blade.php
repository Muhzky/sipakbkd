@extends('layouts.main')

@section('title', 'Data Pengajuan')

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
                    <table class="table table-striped" id="tablePengajuan">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Pengajuan</th>
                                <th>Nama Pegawai</th>
                                <th>Tanggal</th>
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
                                <td>{{ $p->pegawai->user->nama }}</td>
                                <td>{{ $p->tanggal->format('d/m/Y') }}</td>
                                <td>{{ $p->pangkat_baru }}</td>
                                <td>
                                    <span class="badge badge-{{ $p->status }}">
                                        @switch($p->status)
                                            @case('terverifikasi') Menunggu Persetujuan @break
                                            @case('disetujui') Disetujui @break
                                            @case('ditolak') Ditolak @break
                                            @default {{ ucfirst($p->status) }}
                                        @endswitch
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('pimpinan.pengajuan.show', $p) }}" class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada pengajuan</td>
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
