@extends('dashboardd')

@section('isi')

@if(!session()->has('logged_in'))
    <script>window.location = "{{ route('login') }}";</script>
@endif
<div class="container py-8">
<div class="card shadow-sm">
    <div class="card-header" style="background-color: #007bff; color: white;">
        <h4 class="card-title">Data Karyawan</h4>
        <div class="card-tools">
            <a href="{{ route('karyawans.create') }}" class="btn btn-light btn-sm">
                <i class="fa fa-plus"></i> Tambah Karyawan
            </a>
        </div>
    </div>
        <div class="card-body">
        <div class="row">
            <div class="col-md-9">
                <form action="{{ route('karyawans.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control" placeholder="Cari Nama Karyawan" value="{{ request()->search }}">
                    <button type="submit" class="btn btn-primary ml-2">search</button>
                </form>
            </div>
            <div class="col-md-2 text-right">
                <form action="{{ route('karyawans.index') }}" method="GET" class="d-inline">
                    <label class="d-flex align-items-center">
                        <span>Show</span>
                        <select 
                            name="per_page" 
                            aria-controls="example1" 
                            class="custom-select custom-select-sm w-auto mx-2" 
                            onchange="this.form.submit()"
                        >
                            <option value="10" {{ request()->per_page == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request()->per_page == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request()->per_page == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request()->per_page == 100 ? 'selected' : '' }}>100</option>
                        </select>
                        <span>entries</span>
                    </label>
                </form>
            </div>
        </div>
        <table class="table table-bordered table-striped table-responsive w-100" style="font-size: 18px;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Tgl_Lahir</th>
                    
                    <th>Tgl_Masuk</th>
                    <th>S.Cuti</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($karyawans as $karyawan)
                <tr>
                    <td>{{ $loop->iteration + ($karyawans->perPage() * ($karyawans->currentPage() - 1)) }}</td>
                    <td>{{ $karyawan->nik }}</td>
                    <td>{{ $karyawan->nama }}</td>
                    <td>{{ $karyawan->tgl_lahir }}</td>
                    
                    <td>{{ $karyawan->tgl_masuk }}</td>
                    <td>{{ $karyawan->sisa_cuti }}</td>
                    <td>
                        <a href="{{ route('karyawans.edit', $karyawan->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('karyawans.destroy', $karyawan->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <div>
                Showing {{ $karyawans->firstItem() }} to {{ $karyawans->lastItem() }} of {{ $karyawans->total() }} entries
            </div>
            <div>
                {{ $karyawans->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

@endsection
