@extends('dashboardd')
@section('isi')

<!-- Form Table -->
<div class="container mt-4">
    <form action="{{ route('cuti.store') }}" method="POST">
        @csrf
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="w-25"><label for="karyawan_id">Karyawan</label></td>
                    <td>
                        <div class="form-group">
                          <select name="karyawan_id" id="karyawan_id" class="form-control select2" style="width: 100%;" required>
                            <option value="" selected="selected" disabled>Pilih Karyawan</option>
                              @foreach ($karyawans as $karyawan)
                            <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                              @endforeach
                          </select>
                       </div>
                    </td>
                </tr>
                <tr>
                    <td><label for="tgl_awal">Tanggal Awal</label></td>
                    <td><input type="date" name="tgl_awal" id="tgl_awal" class="form-control" onchange="cek_selisih()" required></td>
                </tr>
                <tr>
                    <td><label for="tgl_akhir">Tanggal Akhir</label></td>
                    <td><input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" onchange="cek_selisih()" required></td>
                </tr>
                <tr>
                   <td><label for="lama_cuti">Lama Cuti (Hari)</label></td>
                   <td><input type="number" name="lama_cuti" id="lama_cuti" class="form-control" required readonly></td>
               </tr>
                <tr>
                    <td><label for="keterangan">Keterangan</label></td>
                    <td><textarea name="keterangan" id="keterangan" class="form-control"></textarea></td>
                </tr>
                <tr>
                    <td><label for="jenis_cuti_id">Jenis Cuti</label></td>
                    <td>
                        <select name="jenis_cuti_id" id="jenis_cuti_id" class="form-control" required>
                            <option value="">Pilih Jenis Cuti</option>
                            @foreach ($jenis_cutis as $jenis_cuti)
                                <option value="{{ $jenis_cuti->id }}">{{ $jenis_cuti->nama }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <!-- Hidden input for tgl_entri -->
                <tr style="display:none;">
                    <td><label for="tgl_entri">Tanggal Entri</label></td>
                    <td><input type="hidden" name="tgl_entri" value="{{ now()->toDateTimeString() }}"></td>
                </tr>
            </tbody>
        </table>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
</div>
@endsection
@section('javascript')
<script type="text/javascript">
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });

  });

    function cek_selisih() {
        // Ambil nilai dari input tanggal awal dan akhir
        let tglAwal = document.getElementById('tgl_awal').value;
        let tglAkhir = document.getElementById('tgl_akhir').value;

        if (tglAwal && tglAkhir) {
            // Konversi tanggal ke format Date
            let tanggalAwal = new Date(tglAwal);
            let tanggalAkhir = new Date(tglAkhir);

            // Hitung selisih dalam milidetik
            let selisihWaktu = tanggalAkhir - tanggalAwal;

            // Konversi milidetik ke hari
            let selisihHari = selisihWaktu / (1000 * 60 * 60 * 24);

            if (selisihHari >= 0) {
                // Set nilai lama cuti
                document.getElementById('lama_cuti').value = selisihHari + 1; // +1 untuk inklusif
            } else {
                alert("Tanggal Akhir harus lebih besar atau sama dengan Tanggal Awal.");
                document.getElementById('tgl_akhir').value = ""; // Reset tanggal akhir
                document.getElementById('lama_cuti').value = ""; // Reset lama cuti
            }
        }
    }
</script>

@endsection