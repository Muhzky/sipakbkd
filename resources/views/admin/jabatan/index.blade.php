@extends('layouts.main')

@section('title', 'Data Jabatan')

@push('styles')
<style>
    .card-body .table thead th {
        background-color: var(--primary);
        color: white;
        border: 1px solid #ccc;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        text-align: center;
        white-space: nowrap;
    }
    .card-body .table tbody td {
        border: 1px solid #ccc;
    }
    .card-body .table tbody td:last-child {
        text-align: center;
    }
</style>
@endpush

@section('content')
<div class="section-header">
    <h1>Data Jabatan</h1>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Jabatan</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        <i class="fas fa-plus"></i> Tambah Jabatan
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Jabatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jabatans as $j)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $j->nama_jabatan }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $j->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('admin.jabatan.destroy', $j) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center">Tidak ada data</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.jabatan.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jabatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Jabatan</label>
                        <input type="text" name="nama_jabatan" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($jabatans as $j)
<div class="modal fade" id="modalEdit{{ $j->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.jabatan.update', $j) }}">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Jabatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Jabatan</label>
                        <input type="text" name="nama_jabatan" class="form-control" value="{{ $j->nama_jabatan }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
