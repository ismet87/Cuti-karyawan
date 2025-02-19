@extends('dashboardd')

@section('isi')
<div class="container py-4">
    <h1 class="mb-4 text-center">Tambah Shift</h1>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('shifts.store') }}" method="POST">
                @csrf
                <table class="table table-bordered table-hover">
                    <tbody>
                        <!-- Pilih Karyawan -->
                        <tr>
                            <td class="w-25"><label for="karyawan_id" class="form-label">Pilih Karyawan</label></td>
                            <td>
                                <select id="karyawan_id" name="karyawan_id" class="form-select" required>
                                    <option value="">-- Pilih Karyawan --</option>
                                    @foreach ($karyawans as $karyawan)
                                        <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        <!-- Tanggal Shift -->
                        <tr>
                            <td><label for="tanggal_shift" class="form-label">Tanggal Shift</label></td>
                            <td><input type="date" id="tanggal_shift" name="tanggal_shift" class="form-control" required></td>
                        </tr>

                        <!-- Jam Masuk -->
                        <tr>
                            <td><label for="jam_masuk" class="form-label">Jam Masuk</label></td>
                            <td><input type="time" id="jam_masuk" name="jam_masuk" class="form-control" required></td>
                        </tr>

                        <!-- Jam Keluar -->
                        <tr>
                            <td><label for="jam_keluar" class="form-label">Jam Keluar</label></td>
                            <td><input type="time" id="jam_keluar" name="jam_keluar" class="form-control" required></td>
                        </tr>
                    </tbody>
                </table>

                <!-- Tombol Simpan dan Batal -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary px-5 py-2">Simpan</button>
                    <a href="{{ route('shifts.index') }}" class="btn btn-secondary px-5 py-2 ms-3">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
