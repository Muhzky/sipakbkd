@extends('layouts.main')

@section('title', 'Verifikasi Pengajuan')

@section('content')
<div class="section-header">
    <h1>Verifikasi Pengajuan</h1>
    <div class="section-header-breadcrumb">
        <a href="{{ route('admin.pengajuan.index') }}" class="btn btn-sm btn-secondary">
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
                        <label class="fw-bold">Nama Pegawai</label>
                        <p>{{ $pengajuan->pegawai->user->nama }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">NIP</label>
                        <p>{{ $pengajuan->pegawai->user->nip }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Jabatan</label>
                        <p>{{ $pengajuan->pegawai->jabatan->nama_jabatan ?? '-' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Unit Kerja</label>
                        <p>{{ $pengajuan->pegawai->unit_kerja ?? '-' }}</p>
                    </div>
                </div>
                <hr>
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
                                <div>
                                    <a href="{{ route('dokumen.download', [$pengajuan->dokumen->id, $field]) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-download"></i> Unduh
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="mb-3">
                                <label class="fw-bold">{{ $label }}</label>
                                <p class="text-muted"><em>Tidak diunggah</em></p>
                            </div>
                        @endif
                    @endforeach
                @else
                    <p class="text-muted">Tidak ada dokumen</p>
                @endif
            </div>
        </div>

        @if($pengajuan->status == 'menunggu_verifikasi')
        <div class="card">
            <div class="card-header">
                <h4>Verifikasi Pengajuan</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.pengajuan.update-status', $pengajuan) }}">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Keputusan Verifikasi</label>
                        <select name="status" class="form-select" id="statusSelect" required>
                            <option value="">-- Pilih --</option>
                            <option value="terverifikasi">Setujui (Lanjut ke Pimpinan)</option>
                            <option value="ditolak_operator">Tolak (Kembalikan ke Pegawai)</option>
                        </select>
                    </div>
                    <div class="mb-3" id="alasanGroup" style="display:none;">
                        <label class="form-label">Alasan Penolakan / Catatan Perbaikan <span class="text-danger">*</span></label>
                        <textarea name="alasan_penolakan" class="form-control" rows="3" placeholder="Jelaskan alasan penolakan atau catatan perbaikan untuk pegawai..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('statusSelect').addEventListener('change', function() {
        document.getElementById('alasanGroup').style.display = this.value === 'ditolak_operator' ? 'block' : 'none';
    });
</script>
@endpush
