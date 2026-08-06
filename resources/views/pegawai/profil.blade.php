@extends('layouts.main')

@section('title', 'Profil Saya')

@section('content')
<div class="section-header">
    <h1>Profil Saya</h1>
</div>

<div class="row">
    <div class="col-12 col-md-4">
        <div class="card">
            <div class="card-body text-center">
                @if($user->foto)
                    <img src="{{ supabase_storage_url($user->foto) }}" class="avatar-xl mb-3">
                @else
                    <div class="avatar-xl bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="font-size: 40px;">
                        <i class="fas fa-user"></i>
                    </div>
                @endif
                <h5>{{ $user->nama }}</h5>
                <p class="text-muted">NIP. {{ $user->nip }}</p>
                <span class="badge bg-primary">Pegawai</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Edit Profil</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('pegawai.profil') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- ================= DATA PRIBADI ================= --}}
                    <h6 class="text-uppercase text-muted fw-bold mb-3" style="font-size: 11px; letter-spacing: .5px;">
                        <i class="fas fa-id-badge me-1"></i> Data Pribadi
                    </h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" value="{{ old('nama', $user->nama) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select">
                                <option value="">-- Pilih --</option>
                                <option value="L" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $user->tempat_lahir) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" class="form-control" value="{{ old('tgl_lahir', $user->tgl_lahir ? $user->tgl_lahir->format('Y-m-d') : '') }}">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Foto</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                        <small class="text-muted">Format: jpg, jpeg, png. Maks: 2MB</small>
                    </div>

                    <hr class="my-4">

                    {{-- ================= DATA KEPEGAWAIAN ================= --}}
                    <h6 class="text-uppercase text-muted fw-bold mb-3" style="font-size: 11px; letter-spacing: .5px;">
                        <i class="fas fa-briefcase me-1"></i> Data Kepegawaian
                    </h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">NIP</label>
                            <input type="text" class="form-control" value="{{ $user->nip }}" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Unit Kerja</label>
                            <input type="text" name="unit_kerja" class="form-control" value="{{ old('unit_kerja', $pegawai->unit_kerja) }}">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label">Jabatan</label>
                            <select name="jabatan_id" class="form-select">
                                <option value="">-- Pilih --</option>
                                @foreach($jabatans as $j)
                                    <option value="{{ $j->id }}" {{ old('jabatan_id', $pegawai->jabatan_id) == $j->id ? 'selected' : '' }}>{{ $j->nama_jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Pangkat</label>
                            <select name="pangkat_id" class="form-select">
                                <option value="">-- Pilih --</option>
                                @foreach($pangkats as $p)
                                    <option value="{{ $p->id }}" {{ old('pangkat_id', $pegawai->pangkat_id) == $p->id ? 'selected' : '' }}>{{ $p->golongan }} - {{ $p->nama_pangkat }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr class="my-4">

                    {{-- ================= KONTAK ================= --}}
                    <h6 class="text-uppercase text-muted fw-bold mb-3" style="font-size: 11px; letter-spacing: .5px;">
                        <i class="fas fa-address-book me-1"></i> Kontak
                    </h6>
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $pegawai->no_hp) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection