@extends('dashboardd')

@section('isi')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jenis Cuti</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Edit Jenis Cuti</h4>
                    </div>
                    <div class="card-body">
                        <form id="edit-jenis-cuti-form" action="{{ route('jenis_cuti.update', $jenisCuti->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td><label for="nama" class="form-label">Nama</label></td>
                                        <td>
                                            <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', $jenisCuti->nama) }}" required>
                                            @error('nama')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="is_wajib" class="form-label">Wajib</label></td>
                                        <td>
                                            <select id="is_wajib" name="is_wajib" class="form-select" required>
                                                <option value="1" {{ old('is_wajib', $jenisCuti->is_wajib) == '1' ? 'selected' : '' }}>Ya</option>
                                                <option value="0" {{ old('is_wajib', $jenisCuti->is_wajib) == '0' ? 'selected' : '' }}>Tidak</option>
                                            </select>
                                            @error('is_wajib')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="keterangan" class="form-label">Keterangan</label></td>
                                        <td>
                                            <textarea id="keterangan" name="keterangan" class="form-control" rows="3">{{ old('keterangan', $jenisCuti->keterangan) }}</textarea>
                                            @error('keterangan')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Perbarui</button>
                                <a href="{{ route('jenis_cuti.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Handling form submission with AJAX
        $('#edit-jenis-cuti-form').submit(function(e) {
    e.preventDefault(); // Prevent the form from submitting normally

    var form = $(this);
    var formData = form.serialize(); // Serialize the form data

    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: formData,
        success: function(response) {
            console.log(response); // Debugging: melihat isi response
            if (response && response.success !== undefined) { // Pastikan response valid
                if (response.success) {
                    alert(response.message); // Tampilkan pesan sukses
                    window.location.href = '{{ route('jenis_cuti.index') }}'; // Redirect ke halaman daftar
                } else {
                    alert(response.message); // Tampilkan pesan error
                }
            } else {
                alert('Terjadi kesalahan dalam respon server.');
            }
        },
        error: function(xhr, status, error) {
            alert('Terjadi kesalahan. Mohon coba lagi.');
        }
    });
});

</script>
@endsection