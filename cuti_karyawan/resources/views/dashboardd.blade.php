<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Master data</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ ENV('APP_URL') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ ENV('APP_URL') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ ENV('APP_URL') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ ENV('APP_URL') }}/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ ENV('APP_URL') }}/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ ENV('APP_URL') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ ENV('APP_URL') }}/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ ENV('APP_URL') }}/plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="{{ ENV('APP_URL') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{ ENV('APP_URL') }}/plugins/fullcalendar/main.css">
  <!-- Theme style -->
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ ENV('APP_URL') }}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="{{ ENV('APP_URL') }}/pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>
      </li>
      </li>
      </li>
    </ul>
    <!-- @if(auth()->check())
      <span class="nav-link">User ID : {{ auth()->user()->id }}</span>
    @else
      <span class="nav-link">Guest User ID</span>
    @endif -->
    
      <!-- <li class="user-footer text-center">
                            <form action="{{ route('logout') }}" method="GET" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-default btn-flat mx-auto">Log Out</button>
                            </form>
                        </li> -->
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
      <li class="nav-item dropdown user-menu" style="margin-left: auto;">
  <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
    <img src="{{ ENV('APP_URL') }}/dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">
    <span class="d-none d-md-inline">{{ auth()->check() ? auth()->user()->email : 'dwiarmansyah' }}</span>
  </a>
  <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    <!-- User image -->
    <li class="user-header bg-primary">
      <img src="{{ ENV('APP_URL') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      <p>
        {{ auth()->check() ? auth()->user()->email : 'dwiarmansyah' }} 
        <small>Member Development</small>
      </p>
      <!-- <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div> -->
    </li>
    <!-- Menu Footer -->
    <li class="user-footer">
      <a href="#" class="fas fa-sign-out-alt mr-2" 
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </li>
  </ul>
</li>

      <li class="nav-item">
        <!-- <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a> -->
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <!-- <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button> -->
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ ENV('APP_URL')}}/index3.html" class="brand-link">
      <img src="{{ ENV('APP_URL')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Cuti Karyawan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ ENV('APP_URL')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <!-- @if(session('user_email'))
    <span class="nav-link">{{ session('user_email') }}</span>
@else
    <span class="nav-link">Guest User</span>
@endif -->

          <a href="{{ ENV('APP_URL')}}/#" class="d-block">dwiarmansyah</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{ ENV('APP_URL')}}/#" class="nav-link active">
            <i class="nav-icon fas fa-th"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ ENV('APP_URL')}}/karyawans"  class="nav-link {{ Request::is('karyawans') ? 'active' : '' }}">
                <i class="fas fa-users nav-icon"></i> <!-- Ikon untuk Karyawan -->
                  <p>Karyawan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ ENV('APP_URL')}}/jenis_cuti"  class="nav-link {{ Request::is('jenis_cuti') ? 'active' : '' }}">
                <i class="fas fa-calendar-check nav-icon"></i> <!-- Ikon untuk Jenis Cuti -->
                  <p>Jenis Cuti</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ ENV('APP_URL')}}/cuti"  class="nav-link {{ Request::is('cuti') ? 'active' : '' }}">
                <i class="fas fa-suitcase nav-icon"></i> <!-- Ikon untuk Cuti -->
                  <p>Cuti</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ ENV('APP_URL')}}/history_cuti"  class="nav-link {{ Request::is('history_cuti') ? 'active' : '' }}">
                <i class="fas fa-history nav-icon"></i> <!-- Ikon untuk Cuti -->
                  <p>Rekap Cuti</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ ENV('APP_URL')}}/shifts"  class="nav-link {{ Request::is('shifts') ? 'active' : '' }}">
                <i class="fas fa-clock nav-icon"></i><!-- Ikon untuk Cuti -->
                  <p>Shift</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('rekap.shift.index') }}" class="nav-link  {{ Request::is('rekap-shift') ? 'active' : '' }}">
                <i class="nav-icon fas fa-calendar-alt"></i>
                   <p>Rekap Shift</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Master Data</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ ENV('APP_URL')}}/#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
            <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
             </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="row">
            @yield('isi')
          <div class="col-md-3">
            <div class="sticky-top mb-3">
              <div class="card">
                  <!-- the events -->
                  <div id="external-events">
                    <div class="checkbox"> 
                    </div>
                  </div>
              </div>
              <!-- /.card -->
                </div>
              </div>
            </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
          <section class="col-lg-7 connectedSortable">
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
  
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ ENV('APP_URL') }}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ ENV('APP_URL') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ ENV('APP_URL') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{ ENV('APP_URL') }}/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{ ENV('APP_URL') }}/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{ ENV('APP_URL') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ ENV('APP_URL') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ ENV('APP_URL') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ ENV('APP_URL') }}/plugins/moment/moment.min.js"></script>
<script src="{{ ENV('APP_URL') }}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ ENV('APP_URL') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{ ENV('APP_URL') }}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ ENV('APP_URL') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ ENV('APP_URL') }}/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ ENV('APP_URL') }}/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ ENV('APP_URL') }}/dist/js/pages/dashboard.js"></script>
<!-- jQuery UI -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js?v=3.2.0"></script>
<!-- fullCalendar 2.2.5 -->
<script src="{{ ENV('APP_URL') }}/plugins/moment/moment.min.js"></script>
<script src="{{ ENV('APP_URL') }}/plugins/fullcalendar/main.js"></script>

@yield('javascript')
<script>
 
</script>

</body>
</html>
