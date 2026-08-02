@extends('layouts.main')

@section('title', 'Ajukan Kenaikan Pangkat')

@section('content')
<div class="section-header">
    <h1>Ajukan Kenaikan Pangkat</h1>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Form Pengajuan</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('pegawai.pengajuan.store') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- ================= INFORMASI PENGAJUAN ================= --}}
                    <h6 class="text-uppercase text-muted fw-bold mb-3" style="font-size: 11px; letter-spacing: .5px;">
                        <i class="fas fa-file-alt me-1"></i> Informasi Pengajuan
                    </h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Pengajuan</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Kenaikan Pangkat</label>
                            <select name="jenis_kenaikan" class="form-select" required>
                                <option value="">-- Pilih --</option>
                                <option value="Reguler" {{ old('jenis_kenaikan') == 'Reguler' ? 'selected' : '' }}>Reguler</option>
                                <option value="Pilihan" {{ old('jenis_kenaikan') == 'Pilihan' ? 'selected' : '' }}>Pilihan</option>
                                <option value="Struktural" {{ old('jenis_kenaikan') == 'Struktural' ? 'selected' : '' }}>Struktural</option>
                                <option value="Fungsional" {{ old('jenis_kenaikan') == 'Fungsional' ? 'selected' : '' }}>Fungsional</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pangkat Lama</label>
                            <select name="pangkat_lama" class="form-select" required>
                                <option value="">-- Pilih --</option>
                                @foreach($pangkats as $p)
                                    <option value="{{ $p->golongan }} - {{ $p->nama_pangkat }}" {{ old('pangkat_lama') == ($p->golongan.' - '.$p->nama_pangkat) ? 'selected' : '' }}>{{ $p->golongan }} - {{ $p->nama_pangkat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pangkat Baru</label>
                            <select name="pangkat_baru" class="form-select" required>
                                <option value="">-- Pilih --</option>
                                @foreach($pangkats as $p)
                                    <option value="{{ $p->golongan }} - {{ $p->nama_pangkat }}" {{ old('pangkat_baru') == ($p->golongan.' - '.$p->nama_pangkat) ? 'selected' : '' }}>{{ $p->golongan }} - {{ $p->nama_pangkat }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan') }}</textarea>
                    </div>

                    <hr class="my-4">

                    {{-- ================= DOKUMEN PERSYARATAN ================= --}}
                    <h6 class="text-uppercase text-muted fw-bold mb-3" style="font-size: 11px; letter-spacing: .5px;">
                        <i class="fas fa-folder-open me-1"></i> Dokumen Persyaratan
                    </h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">SK Pangkat Terakhir</label>
                            <input type="file" name="sk_pangkat" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            <small class="text-muted">Format: PDF, JPG, JPEG, PNG. Maks: 5MB</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">SKP</label>
                            <input type="file" name="skp" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            <small class="text-muted">Format: PDF, JPG, JPEG, PNG. Maks: 5MB</small>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label">Ijazah</label>
                            <input type="file" name="ijazah" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            <small class="text-muted">Format: PDF, JPG, JPEG, PNG. Maks: 5MB</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Dokumen Pendukung</label>
                            <input type="file" name="dokumen_pendukung" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            <small class="text-muted">Format: PDF, JPG, JPEG, PNG. Maks: 5MB</small>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-2"></i>Ajukan
                    </button>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection