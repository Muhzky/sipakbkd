@extends('layouts.main')

@section('title', 'Data Pegawai')

@push('styles')
<style>
    #tablePegawai thead th {
        background-color: var(--primary);
        color: white;
        border: 1px solid #ccc;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        text-align: center;
        white-space: nowrap;
    }
    #tablePegawai tbody td {
        border: 1px solid #ccc;
    }
</style>
@endpush

@section('content')
<div class="section-header">
    <h1>Data Pegawai</h1>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Pegawai</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.pegawai.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Pegawai
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.pegawai.index') }}" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama, NIP, email, atau eselon..." value="{{ $search }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Cari
                        </button>
                        @if($search)
                            <a href="{{ route('admin.pegawai.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Reset
                            </a>
                        @endif
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-striped" id="tablePegawai">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Jabatan</th>
                                <th>Pangkat</th>
                                <th>Eselon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pegawais as $p)
                            <tr>
                                <td>{{ ($pegawais->currentPage() - 1) * $pegawais->perPage() + $loop->iteration }}</td>
                                <td>{{ $p->user->nip }}</td>
                                <td>{{ $p->user->nama }}</td>
                                <td>{{ $p->user->email }}</td>
                                <td>{{ $p->jabatan->nama_jabatan ?? '-' }}</td>
                                <td>{{ $p->pangkat ? $p->pangkat->golongan . ' - ' . $p->pangkat->nama_pangkat : '-' }}</td>
                                <td>{{ $p->eselon ?? '-' }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.pegawai.edit', $p) }}" class="btn btn-sm btn-warning text-white">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.pegawai.destroy', $p) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $pegawais->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Pagination menggunakan Laravel server-side
</script>
@endpush
