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
  <!-- Select2 CSS -->
  <link rel="stylesheet" href="{{ ENV('APP_URL') }}/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{ ENV('APP_URL') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- <link rel="stylesheet" href="{{ asset('asset/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}"> -->
  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{ ENV('APP_URL') }}/plugins/fullcalendar/main.css">
  <link rel="stylesheet" href="{{ ENV('APP_URL') }}/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <!-- Theme style -->
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="http://localhost/kasir-ci4/assets/image/1715744025_7b68dfa118844ea98c02.png" 
                        alt="AdminLTE Logo" class="mx-auto" style="width: 200px; height: auto;">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
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
    <span class="d-none d-md-inline"> {{ Auth::user()->name ?? 'Guest' }}</span>
  </a>
  <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    <!-- User image -->
    <li class="user-header bg-primary">
      <img src="{{ ENV('APP_URL') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      <p>
      {{ Auth::user()->name ?? 'Guest' }}
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
    <a href="{{ ENV('APP_URL')}}/index3.html" class="brand-link" style="background-color: white;">
  <img src="http://localhost/kasir-ci4/assets/image/1715744025_7b68dfa118844ea98c02.png" 
  alt="AdminLTE Logo" class="mx-auto" style="width: 100px; height: auto;">
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

          <a href="{{ ENV('APP_URL')}}/" class="d-block"> {{ Auth::user()->name ?? 'Guest' }}</a>
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
        <!-- Dashboard -->
        <li class="nav-item">
            <a href="{{ ENV('APP_URL')}}/home" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        
        <!-- Karyawan -->
        <li class="nav-item">
            <a href="{{ ENV('APP_URL')}}/karyawans" class="nav-link {{ Request::is('karyawans') ? 'active' : '' }}">
                <i class="fas fa-users nav-icon"></i>
                <p>Karyawan</p>
            </a>
        </li>
        
        <!-- Jenis Cuti -->
        <li class="nav-item">
            <a href="{{ ENV('APP_URL')}}/jenis_cuti" class="nav-link {{ Request::is('jenis_cuti') ? 'active' : '' }}">
                <i class="fas fa-calendar-check nav-icon"></i>
                <p>Jenis Cuti</p>
            </a>
        </li>
        
        <!-- Pengajuan Cuti -->
        <li class="nav-item">
            <a href="{{ ENV('APP_URL')}}/cuti" class="nav-link {{ Request::is('cuti') ? 'active' : '' }}">
                <i class="fas fa-suitcase nav-icon"></i>
                <p>Pengajuan Cuti</p>
            </a>
        </li>
        
        <!-- Rekap Cuti -->
        <li class="nav-item">
            <a href="{{ ENV('APP_URL')}}/history_cuti" class="nav-link {{ Request::is('history_cuti') ? 'active' : '' }}">
                <i class="fas fa-history nav-icon"></i>
                <p>Rekap Cuti</p>
            </a>
        </li>
        
        <!-- Shift -->
        <li class="nav-item">
            <a href="{{ ENV('APP_URL')}}/shifts" class="nav-link {{ Request::is('shifts') ? 'active' : '' }}">
                <i class="fas fa-clock nav-icon"></i>
                <p>Shift</p>
            </a>
        </li>
        
        <!-- Rekap Shift -->
        <li class="nav-item">
            <a href="{{ route('rekap.shift.index') }}" class="nav-link {{ Request::is('rekap-shift') ? 'active' : '' }}">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>Rekap Shift</p>
            </a>
        </li>
        
        <!-- Layout Options -->
        <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    Layout Options
                    <i class="fas fa-angle-left right"></i>
                    <span class="badge badge-info right">6</span>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{ ENV('APP_URL')}}/karyawans" class="nav-link {{ Request::is('karyawans') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Top Navigation</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ ENV('APP_URL')}}/jenis_cuti" class="nav-link {{ Request::is('jenis_cuti') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Top Navigation + Sidebar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/layout/boxed.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Boxed</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Fixed Sidebar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/layout/fixed-sidebar-custom.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Fixed Sidebar <small>+ Custom Area</small></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/layout/fixed-topnav.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Fixed Navbar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/layout/fixed-footer.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Fixed Footer</p>
                    </a>
                </li>
            </ul>
        </li> -->
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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home">Home</a></li>
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
      </div>
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
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
        <!-- /.row (main row) -->
      </div>
      <!-- /.container-fluid -->
</div> 
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved. 
  </footer>
   <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>

<!-- jQuery -->
<script src="{{ ENV('APP_URL') }}/plugins/jquery/jquery.min.js"></script>
<!-- Select2 JS -->
<script src="{{ ENV('APP_URL') }}/plugins/select2/js/select2.full.min.js"></script>
<!-- <script src="{{ asset('asset/plugins/select2/js/select2.full.min.js') }}"></script> -->
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
<script src="{{ ENV('APP_URL') }}/dist/js/adminlte.min.js"></script>

<script src="{{ ENV('APP_URL') }}/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script>
  $(document).ready(function () {
    $('[data-widget="pushmenu"]').on('click', function (e) {
        e.preventDefault();
        $('.main-sidebar').toggleClass('sidebar-collapse');
    });
});

</script>


@yield('javascript')


</body>
</html>
