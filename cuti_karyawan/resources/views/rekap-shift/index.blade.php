@extends('dashboardd')

@section('styles')
    <style>
        #calendar {
            max-width: 100%;
            height: 700px; /* Adjust the height here */
            margin: 0 auto;
        }

        .fc-toolbar {
            font-size: 1.2em; /* Adjust the toolbar font size */
        }

        .fc-daygrid-day-number {
            font-size: 1.1em; /* Make day numbers larger */
        }

        .fc-event {
            font-size: 1.1em; /* Increase font size of event titles */
        }
    </style>
@endsection

@section('isi')
<?php
$jam_masuk = '08:00';
$jam_keluar = '10:00';
$tgl = date("Y-m-d");
$masuk  = strtotime($tgl.' '.$jam_masuk.':00');
$keluar = strtotime($tgl.' '.$jam_keluar.':00');
$selisih  = $keluar - $masuk;
$menit = floor($selisih/60);
?>
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
        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request()->start_date }}">
    </div>
    <div class="col-md-3">
        <label for="end_date" class="form-label">Tanggal Akhir</label>
        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request()->end_date }}">
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
                            <td>{{ $loop->iteration  }}</td>
                            <td>{{ $shift->karyawan_name ?? 'Tidak Ditemukan' }}</td> 
                            <td>{{ $shift->total_menit }}</td>
                            <td>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <div id="calendar"></div> <!-- Calendar container -->
</div>

@endsection

@section('javascript')
<script>
  $(function () {

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    new Draggable(containerEl, {
      itemSelector: '.external-event',
      eventData: function(eventEl) {
        return {
          title: eventEl.innerText,
          backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
        };
      }
    });

    var date = new Date()
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear(); 

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
          start: new Date({{ date("Y",strtotime($shift->tanggal_shift)) }}, ({{ date("m",strtotime($shift->tanggal_shift)) }}-1), {{ date("j",strtotime($shift->tanggal_shift)) }}, {{ date("H",strtotime($shift->jam_masuk)) }}, {{ date("i",strtotime($shift->jam_masuk)) }}),
          end: new Date({{ date("Y",strtotime($shift->tanggal_shift)) }}, ({{ date("m",strtotime($shift->tanggal_shift)) }}-1), {{ date("j",strtotime($shift->tanggal_shift)) }}, {{ date("H",strtotime($shift->jam_keluar)) }}, {{ date("i",strtotime($shift->jam_keluar)) }}),
          allDay: false,
          backgroundColor: '#f56954',
          borderColor: '#f56954',
        },
        @endforeach
      ],
      editable: true,
      droppable: true,
      drop: function(info) {
        if (checkbox.checked) {
          info.draggedEl.parentNode.removeChild(info.draggedEl);
        }
      }
    });

    calendar.render();
  });
</script>
@endsection
