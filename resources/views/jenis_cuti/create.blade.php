@extends('dashboardd')

@section('isi')

<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Form Tambah Jenis Cuti</h4>
        </div>
        <div class="card-body">
            <form id="jenisCutiForm">
                @csrf
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th style="width: 15%;" class="bg-light  align-middle">Nama:</th>
                                <td>
                                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama" required>
                                    <small id="error-nama" class="text-danger"></small>
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light  align-middle">Wajib:</th>
                                <td>
                                    <select id="is_wajib" name="is_wajib" class="form-select" required>
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                    <small id="error-is_wajib" class="text-danger"></small>
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light  align-middle">Keterangan:</th>
                                <td>
                                    <textarea id="keterangan" name="keterangan" class="form-control" rows="3" placeholder="Masukkan keterangan" required></textarea>
                                    <small id="error-keterangan" class="text-danger"></small>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="button" id="saveJenisCuti" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('jenis_cuti.index') }}" class="btn btn-secondary ms-2">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('jenisCutiForm');

        document.getElementById('saveJenisCuti').addEventListener('click', function () {
            const formData = new FormData(form);

            fetch('{{ route('jenis_cuti.store') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.errors) {
                    // Display validation errors
                    for (const field in data.errors) {
                        document.getElementById(`error-${field}`).textContent = data.errors[field][0];
                    }
                } else if (data.success) {
                    // Redirect or show success message
                    alert('Data berhasil disimpan!');
                    window.location.href = '{{ route('jenis_cuti.index') }}';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
</script>

@endsection
