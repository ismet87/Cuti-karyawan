<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Cuti</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ ENV('APP_URL') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ ENV('APP_URL') }}/dist/css/adminlte.min.css?v=3.2.0">

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;  /* Menambahkan jarak antara tabel dan bagian atas */
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        .invoice {
            padding: 15px;
            margin-bottom: 30px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .invoice h4 {
            margin-top: 0;
        }

        .no-print {
            margin-top: 20px;
        }

        .signature {
            text-align: center;
            margin-top: 100px;  /* Menambahkan jarak lebih jauh agar lebih ke bawah */
            margin-bottom: 500px;
        }

        .signature-line {
            border-bottom: 1px solid black;
            width: 100%;
            margin-top: 40px;
        }

        .signature-title {
            margin-top: 10px;
        }

        .signature-container {
            margin-top: 100px; /* Jarak antara tabel dan tanda tangan */
        }

        .signature-container .signature-column {
            display: inline-block;
            width: 30%;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Rekap Cuti Section (before invoice) -->
    <h2>Rekap Cuti Karyawan</h2> <!-- Judul Rekap Cuti Karyawan -->

    <!-- Invoice Section -->
    <section class="content">
        <div class="container-fluid">
            <div class="invoice">
                <div class="row">
                    <div class="col-12">
                        <h4>
                            <i class="fas fa-globe"></i> PT.Aslamindo, Inc.
                            <small class="float-right">Date: {{ date('d/m/Y') }}</small>
                        </h4>
                    </div>
                </div>
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        From
                        <address>
                            <strong>PT.Aslamindo, Inc.</strong><br>
                            Jl.Sriwijaya, Ruko Sriwijaya Center Kav.2, Jember<br>
                            Kalioktak, Sriwijaya<br>
                            Phone: +62 881-5080-555<br>
                            Email: info@example.com
                        </address>
                    </div>
                    <!-- <div class="col-sm-4 invoice-col">
                        To
                        <address>
                            <strong>{{ $karyawan->nama }}</strong><br>
                            NIK: {{ $karyawan->nik }}<br>
                        </address>
                    </div> -->
                    <!-- <div class="col-sm-4 invoice-col">
                        <b>Invoice #{{ str_pad($karyawan->id, 6, '0', STR_PAD_LEFT) }}</b><br>
                        <b>Account:</b> Admin
                    </div> -->
                </div>
            </div>
        </div>
    </section>

    <!-- Rekap Cuti Table Section -->
    <!-- <h2> {{ $karyawan->nama }}</h2> Judul Rekap Cuti Karyawan -->
    <!-- <p>NIK: {{ $karyawan->nik }}</p> -->

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>nama</th>
                <th>nik</th>
                <th>Jenis Cuti</th>
                <th>Tanggal Awal</th>
                <th>Tanggal Akhir</th>
                <th>Lama Cuti</th>
                <th>Sisa Cuti</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cutis as $index => $cuti)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $karyawan->nama }}</td>
                <td>{{ $karyawan->nik }}</td>
                <td>{{ $cuti->jenis_cuti_name }}</td>
                <td>{{ \Carbon\Carbon::parse($cuti->tgl_awal)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($cuti->tgl_akhir)->format('d-m-Y') }}</td>
                <td>{{ $cuti->lama_cuti }}</td>
                <td>{{ $cuti->sisa_cuti }}</td>
                <td>{{ $cuti->keterangan }}</td> 
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Signature Section Below Table -->
    <div class="signature-container">
        <div class="signature-column">
            <div class="signature-line"></div>
            <div class="signature-title">Disetujui Oleh</div>
        </div>
        <div class="signature-column"></div>
        <div class="signature-column">
            <div class="signature-line"></div>
            <div class="signature-title">Dibuat Oleh</div>
        </div>
    </div>
       

    <!-- Print Button -->
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ ENV('APP_URL') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ ENV('APP_URL') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ ENV('APP_URL') }}/dist/js/adminlte.min.js?v=3.2.0"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ ENV('APP_URL') }}/dist/js/demo.js"></script>
</body>
</html>
