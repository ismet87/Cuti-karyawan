@extends('dashboardd')
@section('isi')

<!-- Table for displaying leave data -->
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <!-- Show Entries Dropdown -->
            <div class="col-md-4 col-sm-12 d-flex align-items-center mb-2 mb-md-0">
                <label class="mr-2">Show</label>
                <select id="entriesPerPage" class="custom-select custom-select-sm w-auto">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                <label class="ml-2">entries</label>
            </div>

            <!-- Search Input -->
            <div class="col-md-4 col-sm-12 mb-2 mb-md-0">
                <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Cari nama...">
            </div>

            <!-- Button Tambah Cuti -->
            <div class="col-md-4 col-sm-12 text-md-right text-center">
                <a href="{{ route('cuti.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Cuti
                </a>
            </div>
        </div>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover table-striped table-bordered text-nowrap" id="cutiTable">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal Cuti</th>
                    <th>Akhir Cuti</th>
                    <th>Lama Cuti</th>
                    <th>Keterangan</th>
                    <th>Sisa Cuti</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cutis as $cuti)
                    <tr>
                        <td>{{ $loop->iteration + ($cutis->currentPage() - 1) * $cutis->perPage() }}</td>
                        <td class="nama-karyawan">{{ $cuti->karyawan_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($cuti->tgl_awal)->format('Y-m-d') }}</td>
                        <td>{{ \Carbon\Carbon::parse($cuti->tgl_akhir)->format('Y-m-d') }}</td>
                        <td>{{ $cuti->lama_cuti }} hari</td>
                        <td>{{ $cuti->keterangan }}</td>
                        <td>{{ $cuti->sisa_cuti }}</td>
                        <td>
                            @if (strtolower($cuti->status) == 'pending')
                                <span class="badge badge-warning">Menunggu Konfirmasi</span>
                            @elseif (strtolower($cuti->status) == 'disetujui')
                                <span class="badge badge-success">Diterima</span>
                            @elseif (strtolower($cuti->status) == 'ditolak')
                                <span class="badge badge-danger">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    @if (strtolower($cuti->status) == 'pending')
                                        <form action="{{ route('cuti.approve', $cuti->id) }}" method="POST" class="dropdown-item">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success btn-sm">Terima</button>
                                        </form>
                                        <form action="{{ route('cuti.reject', $cuti->id) }}" method="POST" class="dropdown-item">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                        </form>
                                    @endif
                                    <a href="#" class="dropdown-item">Lihat Detail</a>
                                    <form action="{{ route('cuti.destroy', $cuti->id) }}" method="POST" class="dropdown-item">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
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

<!-- JavaScript for filtering and entries -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("searchInput");
        const tableRows = document.querySelectorAll("#cutiTable tbody tr");
        const entriesPerPage = document.getElementById("entriesPerPage");

        searchInput.addEventListener("keyup", function () {
            let filter = searchInput.value.toLowerCase();
            tableRows.forEach(row => {
                let name = row.querySelector(".nama-karyawan").textContent.toLowerCase();
                row.style.display = name.includes(filter) ? "" : "none";
            });
        });

        entriesPerPage.addEventListener("change", function () {
            let value = parseInt(entriesPerPage.value);
            tableRows.forEach((row, index) => {
                row.style.display = index < value ? "" : "none";
            });
        });
    });
</script>

@endsection
