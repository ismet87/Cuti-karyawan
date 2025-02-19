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
            margin-top: 30px; /* Menambahkan jarak antara tabel dan bagian atas */
        }

        table, th, td {
            border: 1px solid black;
        }
        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }
        .info {
            text-align: center;
            margin-top: 5px;
            font-size: 12px;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        .invoice h4 {
            margin-top: 0;
        }

        .no-print {
            margin-top: 20px;
        }

        .signature {
            text-align: center;
            margin-top: 100px; /* Menambahkan jarak lebih jauh agar lebih ke bawah */
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
            margin-top: 200px; /* Jarak antara tabel dan tanda tangan */
        }

        .signature-container .signature-column {
            display: inline-block;
            width: 30%;
            text-align: center;
        }

        .btn-generate-pdf {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }
    </style>
</head>
<body>
<div class="header">
<div style="text-align: center;">
    <img src="{{ public_path('storage/asset/aslamindo.png') }}" 
         alt="Logo Perusahaan" 
         style="width: 250px; height: auto; margin-bottom: 40px;">
    
    <h2 style="margin: 0;">REKAP CUTI KARYAWAN</h2>
    
    <p style="margin: 5px 0;">
        PT. Aslamindo, Inc. <br>
        Jl. Sriwijaya, Ruko Sriwijaya Center Kav.2, Jember <br>
        Phone: +62 881-5080-5555 | https://www.facebook.com/javapaypulsa/
    </p>
    <small class="float-right">Date: {{ date('d/m/Y') }}</small>
</div>


    <!-- Rekap Cuti Section (before invoice) -->
    <!-- <h2>Rekap Cuti Karyawan</h2>  -->
    <!-- <img src="{{ public_path('storage/asset/logo.png') }}" alt="Logo Perusahaan"> -->

    <!-- Invoice Section -->
    <!-- <section class="content">
        <div class="container-fluid">
            <div class="invoice">
                <div class="row">
                    <div class="col-12">
                        <h4>
                            <i class="fas fa-globe"></i> PT.Aslamindo, Inc.
                            <small class="float-right">Date: {{ date('d/m/Y') }}</small>
                        </h4>
                    </div>
                </div> -->
                <!-- <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        From
                        <address>
                            <strong>PT.Aslamindo, Inc.</strong><br>
                            Jl.Sriwijaya, Ruko Sriwijaya Center Kav.2, Jember<br>
                            Kalioktak, Sriwijaya<br>
                            Phone: +62 881-5080-555<br>
                            Email: info@example.com
                        </address>
                    </div> -->
                <!-- </div> -->
            <!-- </div>
        </div>
    </section> -->

    <!-- Rekap Cuti Table Section -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                
                <th>Jenis Cuti</th>
                <th>Tanggal Awal</th>
                <th>Tanggal Akhir</th>
                <th>Lama Cuti</th>
                <th>status</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cutis as $index => $cuti)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $karyawan->nama }}</td>
               
                <td>{{ $cuti->jenis_cuti_name }}</td>
                <td>{{ \Carbon\Carbon::parse($cuti->tgl_awal)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($cuti->tgl_akhir)->format('d-m-Y') }}</td>
                <td>{{ $cuti->lama_cuti }}</td>
                <td>
                        @if (strtolower($cuti->status) == 'pending')

        <form action="{{ route('cuti.approve', $cuti->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-success btn-sm">Setujui</button>
        </form>

        <form action="{{ route('cuti.reject', $cuti->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
        </form>
    @else
        <span class="badge {{ $cuti->status == 'disetujui' ? 'badge-success' : 'badge-danger' }}">
            {{ ucfirst($cuti->status) }}
        </span>
    @endif
</td>
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

    <!-- Tombol Generate PDF -->
    <!-- <button type="button" class="btn btn-primary btn-generate-pdf">
        <i class="fas fa-download"></i> Generate PDF
    </button> -->

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
