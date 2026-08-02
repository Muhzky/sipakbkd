@extends('layouts.main')

@section('title', 'Lengkapi Dokumen')

@section('content')
<div class="section-header">
    <h1>Lengkapi Dokumen</h1>
    <div class="section-header-breadcrumb">
        <a href="{{ route('pegawai.riwayat') }}" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ $pengajuan->nomor_pengajuan }}</h4>
            </div>
            <div class="card-body">
                @if($pengajuan->alasan_penolakan)
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong>Catatan:</strong> {{ $pengajuan->alasan_penolakan }}
                </div>
                @endif

                <form method="POST" action="{{ route('pegawai.pengajuan.update-dokumen', $pengajuan) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">SK Pangkat Terakhir</label>
                            <input type="file" name="sk_pangkat" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            <small class="text-muted">Format: PDF, JPG, JPEG, PNG. Maks: 5MB</small>
                            @if($pengajuan->dokumen && $pengajuan->dokumen->sk_pangkat)
                                <p class="text-success mt-1"><i class="fas fa-check-circle"></i> Sudah terunggah</p>
                            @else
                                <p class="text-danger mt-1"><i class="fas fa-times-circle"></i> Belum diunggah</p>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">SKP</label>
                            <input type="file" name="skp" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            <small class="text-muted">Format: PDF, JPG, JPEG, PNG. Maks: 5MB</small>
                            @if($pengajuan->dokumen && $pengajuan->dokumen->skp)
                                <p class="text-success mt-1"><i class="fas fa-check-circle"></i> Sudah terunggah</p>
                            @else
                                <p class="text-danger mt-1"><i class="fas fa-times-circle"></i> Belum diunggah</p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ijazah</label>
                            <input type="file" name="ijazah" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            <small class="text-muted">Format: PDF, JPG, JPEG, PNG. Maks: 5MB</small>
                            @if($pengajuan->dokumen && $pengajuan->dokumen->ijazah)
                                <p class="text-success mt-1"><i class="fas fa-check-circle"></i> Sudah terunggah</p>
                            @else
                                <p class="text-danger mt-1"><i class="fas fa-times-circle"></i> Belum diunggah</p>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Dokumen Pendukung</label>
                            <input type="file" name="dokumen_pendukung" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            <small class="text-muted">Format: PDF, JPG, JPEG, PNG. Maks: 5MB</small>
                            @if($pengajuan->dokumen && $pengajuan->dokumen->dokumen_pendukung)
                                <p class="text-success mt-1"><i class="fas fa-check-circle"></i> Sudah terunggah</p>
                            @else
                                <p class="text-danger mt-1"><i class="fas fa-times-circle"></i> Belum diunggah</p>
                            @endif
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">
                        <i class="fas fa-save me-2"></i>Simpan & Kirim Ulang
                    </button>
                    <a href="{{ route('pegawai.riwayat') }}" class="btn btn-secondary mt-3">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
