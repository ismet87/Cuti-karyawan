@extends('dashboardd')
@section('isi')

<!-- Main content -->
<!-- <div class="container mt-4"> -->
    <!-- Header -->
    <!-- <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Cuti Karyawan</h4>
        <a href="{{ route('cuti.create') }}" class="btn btn-primary">Tambah Cuti</a>
    </div> -->

    <!-- Table for displaying leave data -->
    <div class="card">
        <div class="card-header">
        <a href="{{ route('cuti.create') }}" class="btn btn-primary"> <i class="fas fa-plus"></i> Tambah Cuti</a>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <form action="{{ route('cuti.index') }}" method="GET" class="d-flex">
                    <td colspan="8" class="text-end">
                        <input type="text" name="search" class="form-control" placeholder="Cari Nama Karyawan" value="{{ request()->search }}">
                    </td>
                    <td class="text-center">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </td>
                </form>
                    <tr>
                        <th>No</th>
                        <th>Karyawan</th>
                        <th>Tgl_Awal</th>
                        <th>Tgl_Akhir</th>
                        <th>Lama Cuti</th>
                        <th>Keterangan</th>
                        <th>Jenis Cuti</th>
                        <th>Sisa Cuti</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cutis as $cuti)
                        <tr>
                            <td>{{ $loop->iteration + ($cutis->currentPage() - 1) * $cutis->perPage() }}</td>
                            <td>{{ $cuti->karyawan_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($cuti->tgl_awal)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($cuti->tgl_akhir)->format('d-m-Y') }}</td>
                            <td>{{ $cuti->lama_cuti }} hari</td>
                            <td>{{ $cuti->keterangan }}</td>
                            <td>{{ $cuti->jenis_cuti_name }}</td>
                            <td>{{ $cuti->sisa_cuti }}</td>
                            <td>
                                <form action="{{ route('cuti.destroy', $cuti->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
    <div class="mt-3">
        {{ $cutis->links('pagination::bootstrap-4') }}
    </div>
        </div>
    </div>

    <!-- Pagination -->
    <!-- <div class="mt-3">
        {{ $cutis->links('pagination::bootstrap-4') }}
    </div> -->
@endsection
