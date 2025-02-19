@extends('dashboardd')

@section('styles')
    <style>
        #calendar {
            max-width: 90%;
            height: 500px;
            margin: 20px auto;
        }

        .fc-toolbar {
            font-size: 1.2em;
        }

        .fc-daygrid-day-number {
            font-size: 1.1em;
        }

        .fc-event {
            font-size: 1.1em;
        }
    </style>
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet"> -->
@endsection

@section('isi')
<div class="container py-4">
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">Rekap Shift Karyawan</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('rekap.shift.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="nama" class="form-label">Nama Karyawan</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Cari Nama Karyawan" value="{{ request()->nama }}">
                </div>
                <div class="col-md-3">
                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                    <input type="text" name="start_date" id="start_date" class="form-control datepicker" placeholder="Pilih Tanggal Mulai" value="{{ request()->start_date }}">
                </div>
                <div class="col-md-3">
                    <label for="end_date" class="form-label">Tanggal Akhir</label>
                    <input type="text" name="end_date" id="end_date" class="form-control datepicker" placeholder="Pilih Tanggal Akhir" value="{{ request()->end_date }}">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fa fa-filter"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table to display shifts -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Shift Karyawan</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Karyawan</th>
                        <th>Lama Kerja</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rekapshifts as $shift)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $shift->karyawan_name ?? 'Tidak Ditemukan' }}</td>
                            <td>{{ $shift->total_menit }} jam</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="calendar"></div>
</div>
@endsection

@section('javascript')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> -->
<script>
    $(document).ready(function() {
        // Initialize Bootstrap Datepicker
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd', // Format YYYY-MM-DD
            autoclose: true,     // Close on date select
            todayHighlight: true // Highlight today's date
        });

        var Calendar = FullCalendar.Calendar;

        var calendarEl = document.getElementById('calendar');
        var calendar = new Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            themeSystem: 'bootstrap',
            events: [
                @foreach ($rekapshifts2 as $shift)
                {
                    title: '{{ $shift->karyawan->nama ?? 'Tidak Ditemukan' }}',
                    start: '{{ $shift->tanggal_shift }}T{{ $shift->jam_masuk }}',
                    end: '{{ $shift->tanggal_shift }}T{{ $shift->jam_keluar }}',
                    allDay: false,
                    backgroundColor: '#f56954',
                    borderColor: '#f56954',
                },
                @endforeach
            ]
        });

        calendar.render();
    });
</script>
@endsection
