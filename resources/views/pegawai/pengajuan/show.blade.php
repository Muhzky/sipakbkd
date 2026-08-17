@extends('layouts.main')

@section('title', 'Detail Pengajuan')

@section('content')
<div class="section-header">
    <h1>Detail Pengajuan</h1>
    <div class="section-header-breadcrumb">
        <a href="{{ route('pegawai.riwayat') }}" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4>{{ $pengajuan->nomor_pengajuan }}</h4>
                <div class="card-header-action">
                    <span class="badge badge-{{ $pengajuan->status }} fs-6">
                        @switch($pengajuan->status)
                            @case('menunggu') Menunggu Pemeriksaan @break
                            @case('dokumen_tidak_lengkap') Dokumen Tidak Lengkap @break
                            @case('menunggu_verifikasi') Menunggu Verifikasi @break
                            @case('ditolak_operator') Ditolak Operator @break
                            @case('terverifikasi') Terverifikasi @break
                            @case('disetujui') Disetujui @break
                            @case('ditolak') Ditolak @break
                            @default {{ ucfirst($pengajuan->status) }}
                        @endswitch
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Tanggal Pengajuan</label>
                        <p>{{ $pengajuan->tanggal->format('d F Y') }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Jenis Kenaikan</label>
                        <p>{{ $pengajuan->jenis_kenaikan }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Pangkat Lama</label>
                        <p>{{ $pengajuan->pangkat_lama }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Pangkat Baru</label>
                        <p>{{ $pengajuan->pangkat_baru }}</p>
                    </div>
                </div>
                @if($pengajuan->keterangan)
                <div class="mb-3">
                    <label class="fw-bold">Keterangan</label>
                    <p>{{ $pengajuan->keterangan }}</p>
                </div>
                @endif

                @if($pengajuan->alasan_penolakan)
                <div class="alert alert-danger">
                    <label class="fw-bold">Alasan / Catatan</label>
                    <p class="mb-0">{{ $pengajuan->alasan_penolakan }}</p>
                </div>
                @endif

                @if(in_array($pengajuan->status, ['dokumen_tidak_lengkap', 'ditolak_operator']))
                <div class="alert alert-warning mt-3">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Silakan <a href="{{ route('pegawai.pengajuan.edit-dokumen', $pengajuan) }}" class="fw-bold">unggah ulang dokumen</a> yang diperlukan.
                </div>
                @endif

                @if($pengajuan->status == 'disetujui')
                <div class="alert alert-success mt-3">
                    <i class="fas fa-check-circle me-2"></i>
                    Pengajuan telah disetujui.
                </div>
                <a href="{{ route('pegawai.pengajuan.download-sk', $pengajuan) }}" class="btn btn-success mb-3">
                    <i class="fas fa-file-pdf"></i> Unduh SK
                </a>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4>Dokumen</h4>
            </div>
            <div class="card-body">
                @if($pengajuan->dokumen)
                    @foreach(['sk_pangkat' => 'SK Pangkat', 'skp' => 'SKP', 'ijazah' => 'Ijazah', 'dokumen_pendukung' => 'Dok. Pendukung'] as $field => $label)
                        @if($pengajuan->dokumen->$field)
                            <div class="mb-3">
                                <label class="fw-bold">{{ $label }}</label>
                                <p class="text-success"><i class="fas fa-check-circle"></i> Terunggah</p>
                            </div>
                        @else
                            <div class="mb-3">
                                <label class="fw-bold">{{ $label }}</label>
                                <p class="text-danger"><i class="fas fa-times-circle"></i> Belum diunggah</p>
                            </div>
                        @endif
                    @endforeach
                @else
                    <p class="text-muted">Tidak ada dokumen</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
