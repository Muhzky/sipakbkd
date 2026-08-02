@extends('layouts.main')

@section('title', 'Data Pegawai')

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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pegawais as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->user->nip }}</td>
                                <td>{{ $p->user->nama }}</td>
                                <td>{{ $p->user->email }}</td>
                                <td>{{ $p->jabatan->nama_jabatan ?? '-' }}</td>
                                <td>{{ $p->pangkat ? $p->pangkat->golongan . ' - ' . $p->pangkat->nama_pangkat : '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.pegawai.edit', $p) }}" class="btn btn-sm btn-warning text-white">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.pegawai.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data</td>
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
    $(document).ready(function() {
        $('#tablePegawai').DataTable();
    });
</script>
@endpush
