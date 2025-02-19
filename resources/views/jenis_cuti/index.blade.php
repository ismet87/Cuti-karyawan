@extends('dashboardd')
@section('isi')

<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Jenis Cuti</h2>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between mb-4">
                <button class="btn btn-primary btn-sm" id="addJenisCuti">
                    <i class="fas fa-plus"></i> Tambah Jenis Cuti
                </button>
            </div>
            <div class="table-responsive-lg">
            <table id="jenisCutiTable" class="table table-bordered table-striped table-hover">
    <thead class="table-primary">
        <tr>
            <th class="text-center">No</th>
            <th>Nama</th>
            <th>Wajib</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($jenisCuti as $cuti)
        <tr data-id="{{ $cuti->id }}">
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $cuti->nama }}</td>
            <td>{{ $cuti->is_wajib ? 'Ya' : 'Tidak' }}</td>
            <td>{{ $cuti->keterangan }}</td>
            <td>
                <button class="btn btn-warning btn-sm editJenisCuti" data-id="{{ $cuti->id }}">
                    <i class="fas fa-edit"></i> Edit
                </button>
                <button class="btn btn-danger btn-sm deleteButton" data-id="{{ $cuti->id }}">
                    <i class="fas fa-trash-alt"></i> Hapus
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
            <!-- <div class="d-flex justify-content-between mt-3">
                <div>
                    Showing {{ $jenisCuti->firstItem() }} to {{ $jenisCuti->lastItem() }} of {{ $jenisCuti->total() }} entries
                </div>
                <div>
                    {{ $jenisCuti->links('pagination::bootstrap-4') }}
                </div>
            </div> -->
            </div> 
        </div>
    </div>
</div>
<!-- SweetAlert2 JS -->
</body>
</html>


<!-- Modal -->
<div class="modal fade" id="jenisCutiModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Data</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <form id="jenisCutiForm">
                    @csrf
                    <input type="hidden" id="jenisCutiId" name="id">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="is_wajib" class="form-label">Wajib</label>
                        <select class="form-select" id="is_wajib" name="is_wajib" required>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" id="closeModalButton">Tutup</button> -->
                <button type="submit" class="btn btn-primary" id="saveJenisCuti">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
   document.addEventListener('DOMContentLoaded', function () {
    const modal = new bootstrap.Modal(document.getElementById('jenisCutiModal'));
    const form = document.getElementById('jenisCutiForm');
    const table = document.querySelector('#jenisCutiTable tbody');

    // Tombol tambah jenis cuti
    document.getElementById('addJenisCuti').addEventListener('click', function () {
    document.getElementById('modalTitle').textContent = 'Tambah Jenis Cuti';
    form.reset();
    document.getElementById('jenisCutiId').value = '';
    modal.show();
});

// Fungsi untuk membuat HTML baris tabel dengan nomor urut
function generateRow(data, index) {
    return `
        <td class="text-center">${index + 1}</td> <!-- Menampilkan nomor urut -->
        <td>${data.nama}</td>
        <td>${data.is_wajib ? 'Ya' : 'Tidak'}</td>
        <td>${data.keterangan}</td>
        <td>
            <button class="btn btn-warning btn-sm editJenisCuti" data-id="${data.id}">
                <i class="fas fa-edit"></i> Edit
            </button>
            <button class="btn btn-danger btn-sm deleteButton" data-id="${data.id}">
                <i class="fas fa-trash-alt"></i> Hapus
            </button>
        </td>`;
}

document.getElementById('saveJenisCuti').addEventListener('click', function (event) {
    event.preventDefault(); // Mencegah submit default

    const form = document.getElementById('jenisCutiForm'); // Pastikan form sudah terdefinisi
    const formData = new FormData(form);
    const id = document.getElementById('jenisCutiId').value;

    // Gunakan POST dengan parameter _method jika ID tersedia (update), POST jika tidak (tambah)
    const method = 'POST';
    const url = id ? `/jenis_cuti/${id}` : '/jenis_cuti';

    if (id) {
        formData.append('_method', 'PUT');
    }

    fetch(url, {
        method: method,
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        }
    })
    .then(response => {
        // Cek apakah response berhasil (status code 200-299)
        if (!response.ok) {
            return response.json().then(err => {
                throw new Error(err.message || `HTTP error! Status: ${response.status}`);
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            if (id) {
                // Update baris tabel untuk data yang diupdate
                const row = document.querySelector(`tr[data-id="${id}"]`);
                const index = Array.from(row.parentNode.children).indexOf(row) + 1; // Nomor urut
                row.innerHTML = generateRow(data.data, index);
            } else {
                // Tambahkan baris baru untuk data yang ditambah
                const newRow = document.createElement('tr');
                newRow.setAttribute('data-id', data.data.id);
                const index = document.querySelectorAll('tr[data-id]').length + 1; // Nomor urut
                newRow.innerHTML = generateRow(data.data, index);
                document.querySelector('#jenisCutiTable tbody').appendChild(newRow);
            }

            // Tutup modal
            modal.hide();

            // Menampilkan SweetAlert setelah data berhasil disimpan
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data berhasil disimpan!',
                showConfirmButton: false,
                timer: 1500
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: data.message || 'Terjadi kesalahan saat menyimpan data.',
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan!',
            text: error.message || 'Terjadi kesalahan saat menyimpan data.',
        });
    });
});


    // Tombol edit jenis cuti
    document.querySelectorAll('.editJenisCuti').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;

            fetch(`/jenis_cuti/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modalTitle').textContent = 'Edit Jenis Cuti';
                    document.getElementById('jenisCutiId').value = data.id;
                    document.getElementById('nama').value = data.nama;
                    document.getElementById('is_wajib').value = data.is_wajib;
                    document.getElementById('keterangan').value = data.keterangan;
                    modal.show();
                });
        });
    });

    // Tombol hapus jenis cuti
    document.querySelectorAll('.deleteButton').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;

            if (confirm('Yakin ingin menghapus data ini?')) {
                fetch(`/jenis_cuti/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const row = document.querySelector(`tr[data-id="${id}"]`);
                        row.remove(); // Hapus baris dari tabel
                        alert('Data berhasil dihapus!');
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });
});
</script>
@endsection