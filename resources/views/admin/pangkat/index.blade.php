@extends('layouts.main')

@section('title', 'Data Pangkat')

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
    <h1>Data Pangkat</h1>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Pangkat</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        <i class="fas fa-plus"></i> Tambah Pangkat
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Golongan</th>
                                <th>Nama Pangkat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pangkats as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->golongan }}</td>
                                <td>{{ $p->nama_pangkat }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $p->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('admin.pangkat.destroy', $p) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center">Tidak ada data</td></tr>
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
            <form method="POST" action="{{ route('admin.pangkat.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pangkat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Golongan</label>
                        <input type="text" name="golongan" class="form-control" placeholder="Contoh: III/a" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Pangkat</label>
                        <input type="text" name="nama_pangkat" class="form-control" placeholder="Contoh: Penata Muda" required>
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

@foreach($pangkats as $p)
<div class="modal fade" id="modalEdit{{ $p->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.pangkat.update', $p) }}">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Pangkat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Golongan</label>
                        <input type="text" name="golongan" class="form-control" value="{{ $p->golongan }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Pangkat</label>
                        <input type="text" name="nama_pangkat" class="form-control" value="{{ $p->nama_pangkat }}" required>
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
