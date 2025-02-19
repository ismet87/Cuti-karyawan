@extends('dashboardd')

@section('isi')
<?php
$jam_masuk = '08:00';
$jam_keluar = '10:00';
$tgl = date("Y-m-d");
$masuk  = strtotime($tgl.' '.$jam_masuk.':00');
$keluar = strtotime($tgl.' '.$jam_keluar.':00');
                                      
$selisih  = $keluar - $masuk;
$menit = floor($selisih/60);
// echo floor($selisih/60);      
// if($selisih > 0){
//   $jam   = floor($selisih / (60 * 60));
//   $menit = $selisih - ( $jam * (60 * 60) );
//   // echo $jam;
//   $detik = $selisih % 60;
//   // echo 'Budi terlambat : ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit, ' . $detik . ' detik';
// }else{
//   // echo "Bagus, Budi tidak terlambat.";
//   echo $selisih;
// }		
?>
<div class="container py-8">
    <div class="card">
        <div class="card-header" style="background-color: #007bff; color: white;">
            <h2 class="card-title">Shift Karyawan</h2>
        </div>

    <div class="card mt-4">
        <div class="card-header">
            <a href="{{ route('shifts.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Tambah Shift
            </a>
        </div>
     <div class="card-body">
        <table class="table table-bordered table-striped">
         <thead>
                    <tr>
                        <th>No</th>
                        <th>Karyawan</th>
                        <th>Tgl Shift</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Waktu Shift</th>
                        <th>Lama Kerja</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shifts as $shift)
                        <tr>
                            <td>{{ $loop->iteration + ($shifts->perPage() * ($shifts->currentPage() - 1)) }}</td>
                            <td>{{ $shift->karyawan->nama ?? 'Tidak Ditemukan' }}</td>
                            <td>{{ $shift->tanggal_shift }}</td>
                            <td>{{ $shift->jam_masuk }}</td>
                            <td>{{ $shift->jam_keluar }}</td>
                            <td>{{ $shift->waktu_shift }}</td>
                            <td>{{ $shift->lama_kerja }} jam</td>
                            <td>
                                <form action="{{ route('shifts.destroy', $shift->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="d-flex justify-content-between">
                <div>
                      Showing {{ $shifts->firstItem() }} to {{ $shifts->lastItem() }} of {{ $shifts->total() }} entries
                </div>
                <div>
                      {{ $shifts->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection