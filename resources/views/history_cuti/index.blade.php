@extends('dashboardd')

@section('isi')
<div class="table-responsive p-0">
    <table class="table table-bordered table-striped">
        <thead>
            <form action="{{ route('history_cuti.index') }}" method="GET" class="d-flex">
                <td colspan="3" class="text-end">
                    <input type="text" name="search" class="form-control" placeholder="Cari Nama Karyawan" value="{{ request()->search }}">
                </td>
                <td>
                    <select name="tahun" id="tahun" class="form-control">
                        <option value="">Pilih Tahun</option>
                        @foreach ($tahunOptions as $option)
                            <option value="{{ $option }}" {{ $tahun == $option ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                </td>
                <td class="text-center">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </td>
            </form>
            <tr>
                <th>No</th>
                <th>Nik</th>
                <th class="col-3">Nama</th>
                <th class="col-3">Sisa Cuti</th>
                <th class="col-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cutis as $cuti)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $cuti->karyawan_nik }}</td>
                <td>{{ $cuti->karyawan_name }}</td>
                <td class="text-center">{{ $cuti->sisa_cuti }}</td>
                <td>
                    <a href="{{ route('rekap_cuti.generatePdf', $cuti->karyawan_id) }}" target="_blank" class="btn btn-primary btn-sm">
                       <i class="fas fa-eye"></i> Detail
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end mt-3">
        {{ $cutis->links() }} <!-- Pagination Links -->
    </div>
</div>
@endsection
