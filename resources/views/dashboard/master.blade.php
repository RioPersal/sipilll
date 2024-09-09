<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- <meta http-equiv="refresh"> --}}
  <title>CPLProdi | @yield('judul')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('dist/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('dist/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('dist/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('dist/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('dist/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('dist/plugins/summernote/summernote-bs4.min.css') }}">
  @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">



  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light text-sm">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">Home</a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            
            <a type="button" class="dropdown-item" href="#" data-toggle="modal" data-target="#ganti-pw">
              <i class="bi bi-file-person-fill"></i> Ganti Password
          </a>
          
          
          

            <form action="/logout" method="post">
              @csrf
              <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Log Out</button>
            </form>
          </div>
        </li>
        @endauth
      </ul>
  </nav>
  <div class="modal fade" id="ganti-pw" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ganti Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/ganti-password') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="current_password">Password Lama</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">Password Baru</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Ganti Password</button>
                        <button type="button" class="btn btn-default ml-1" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 text-sm">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{ asset('dist/img/logo_unri.png') }}" alt="AdminLTE Logo" class="brand-image">
      <span class="brand-text font-weight-light">CPL Program studi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          

              {{----------------------------------MAHASISWA---------------------------------}}
              @if (auth()->user()->level === 'mahasiswa')
                <li class="nav-item">
                  <a href="/home" class="nav-link @if(Request::is('home')) active @endif">
                    <i class="nav-icon fas fa-home nav-icon"></i>
                      <p>Home</p>
                    </a>
                </li>
              @endif

              {{------------------------------------DOSEN-----------------------------------}}
              @if (auth()->user()->level === 'dosen')
                <li class="nav-item">
                  <a href="/home" class="nav-link @if(Request::is('home')) active @endif">
                    <i class="nav-icon fas fa-home nav-icon"></i>
                      <p>Home</p>
                    </a>
                </li>
                <li class="nav-item">
                  <a href="/data-penilaian" class="nav-link @if(Request::is('data-penilaian')) active @endif">
                    <i class="fa-regular fa-square-plus nav-icon align-middle"></i>
                    <p class="align-middle">Tambah Penilaian</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/rps" class="nav-link @if(Request::is('rps')) active @endif">
                    <i class="fa-regular fa-file nav-icon align-middle"></i>
                    <p>RPS</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/sub-cpmk" class="nav-link @if(Request::is('sub-cpmk')) active @endif">
                    <i class="fa-regular fa-file nav-icon align-middle"></i>
                    <p>Sub-CPMK</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/rekap-mata-kuliah" class="nav-link @if(Request::is('rekap-mata-kuliah')) active @endif">
                    <i class="fa-solid fa-chart-column nav-icon align-middle"></i>
                    <p>Rekap Mata Kuliah</p>
                  </a>
                </li>
              @endif

              {{-----------------------------------KAPRODI----------------------------------}}
              @if (auth()->user()->level === 'kaprodi')
                <li class="nav-item">
                  <a href="/home" class="nav-link @if(Request::is('home')) active @endif">
                    <i class="nav-icon fas fa-home nav-icon"></i>
                      <p>Home</p>
                    </a>
                </li>
                
                <li class="nav-item">
                  <a href="/data-kelas" class="nav-link @if(Request::is('data-kelas')) active @endif">
                    <i class="fa-regular fa-file nav-icon align-middle"></i>
                    <p>Data Kelas</p>
                  </a>
                </li>
                
                <li class="nav-item">
                  <a href="/rps" class="nav-link @if(Request::is('rps')) active @endif">
                    <i class="fa-regular fa-file nav-icon align-middle"></i>
                    <p>RPS</p>
                  </a>
                </li>
                
                <li class="nav-item">
                  <a href="/pemetaan-matkul-dan-cpmk" class="nav-link @if(Request::is('pemetaan-matkul-dan-cpmk')) active @endif">
                    <i class="fa-regular fa-file nav-icon align-middle"></i>
                    <p>Pemetaan Matkul dan CPMK</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/cpmk" class="nav-link @if(Request::is('cpmk')) active @endif">
                    <i class="fa-regular fa-file nav-icon align-middle"></i>
                    <p>CPMK</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/cpl-prodi" class="nav-link @if(Request::is('cpl-prodi')) active @endif">
                    <i class="fa-regular fa-file nav-icon align-middle"></i>
                    <p>CPL Prodi</p>
                  </a>
                </li>
                
                <li class="nav-item has-treeview  @if(Request::is(['data-admin', 'data-kaprodi', 'data-dosen', 'data-mahasiswa', 'data-mata-kuliah'])) menu-open @endif">
                  <a href="#" class="nav-link align-middle @if(Request::is(['data-admin', 'data-kaprodi', 'data-dosen', 'data-mahasiswa', 'data-mata-kuliah'])) active @endif">
                    <i class="fa-solid fa-user nav-icon"></i>
                    <p>
                      Master Data
                    </p>
                    <i class="right fas fa-angle-left"></i>
                  </a>
                  <ul class="nav nav-treeview bg-secondary">
                    <li class="nav-item">
                      <a href="/data-mata-kuliah" class="nav-link @if(Request::is('data-mata-kuliah')) active @endif">
                        <i class="fa-solid fa-book-open nav-icon align-middle"></i>
                        <p>Data Mata Kuliah</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/data-mahasiswa" class="nav-link @if(Request::is('data-mahasiswa')) active @endif">
                        <i class="fa-solid fa-user nav-icon align-middle"></i>
                        <p>Data Mahasiswa</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/data-dosen" class="nav-link @if(Request::is('data-dosen')) active @endif">
                        <i class="fa-solid fa-user nav-icon align-middle"></i>
                        <p>Data Dosen</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/data-kaprodi" class="nav-link @if(Request::is('data-kaprodi')) active @endif">
                        <i class="fa-solid fa-user nav-icon align-middle"></i>
                        <p>Data Kaprodi</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/data-admin" class="nav-link @if(Request::is('data-admin')) active @endif">
                        <i class="fa-solid fa-user nav-icon align-middle"></i>
                        <p>Data Admin</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a href="/rekap-nilai-mahasiswa" class="nav-link @if(Request::is('rekap-nilai-mahasiswa')) active @endif">
                    <i class="fa-solid fa-chart-column nav-icon align-middle"></i>
                    <p>Rekap CPL Mahasiswa</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/rekap-mata-kuliah" class="nav-link @if(Request::is('rekap-mata-kuliah')) active @endif">
                    <i class="fa-solid fa-chart-column nav-icon align-middle"></i>
                    <p>Rekap Mata Kuliah</p>
                  </a>
                </li>
              @endif
              
              {{------------------------------------ADMIN-----------------------------------}}
              @if (auth()->user()->level === 'admin')
                <li class="nav-item">
                  <a href="/home" class="nav-link @if(Request::is('home')) active @endif">
                    <i class="nav-icon fas fa-home nav-icon"></i>
                      <p>Home</p>
                    </a>
                </li>
                
                <li class="nav-item">
                  <a href="/data-kelas" class="nav-link @if(Request::is('data-kelas')) active @endif">
                    <i class="fa-regular fa-file nav-icon align-middle"></i>
                    <p>Data Kelas</p>
                  </a>
                </li>
                
                <li class="nav-item">
                  <a href="/cpmk" class="nav-link @if(Request::is('cpmk')) active @endif">
                    <i class="fa-regular fa-file nav-icon align-middle"></i>
                    <p>CPMK</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/cpl-prodi" class="nav-link @if(Request::is('cpl-prodi')) active @endif">
                    <i class="fa-regular fa-file nav-icon align-middle"></i>
                    <p>CPL Prodi</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/data-mata-kuliah" class="nav-link @if(Request::is('data-mata-kuliah')) active @endif">
                    <i class="fa-solid fa-book-open nav-icon align-middle"></i>
                    <p>Data Mata Kuliah</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/data-mahasiswa" class="nav-link @if(Request::is('data-mahasiswa')) active @endif">
                    <i class="fa-solid fa-user nav-icon align-middle"></i>
                    <p>Data Mahasiswa</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/data-dosen" class="nav-link @if(Request::is('data-dosen')) active @endif">
                    <i class="fa-solid fa-user nav-icon align-middle"></i>
                    <p>Data Dosen</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/data-kaprodi" class="nav-link @if(Request::is('data-kaprodi')) active @endif">
                    <i class="fa-solid fa-user nav-icon align-middle"></i>
                    <p>Data Kaprodi</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/data-admin" class="nav-link @if(Request::is('data-admin')) active @endif">
                    <i class="fa-solid fa-user nav-icon align-middle"></i>
                    <p>Data Admin</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/rekap-nilai-mahasiswa" class="nav-link @if(Request::is('rekap-nilai-mahasiswa')) active @endif">
                    <i class="fa-solid fa-chart-column nav-icon align-middle"></i>
                    <p>Rekap CPL Mahasiswa</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/rekap-mata-kuliah" class="nav-link @if(Request::is('rekap-mata-kuliah')) active @endif">
                    <i class="fa-solid fa-chart-column nav-icon align-middle"></i>
                    <p>Rekap Mata Kuliah</p>
                  </a>
                </li>
              @endif


              
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
      <div class="container-fluid text-sm">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0"><span id="current-greeting"></span>, @if (isset(auth()->user()->gelar_depan)) {{ auth()->user()->gelar_depan . '.'}} @endif {{ auth()->user()->name }} @if (isset(auth()->user()->gelar_belakang)) {{ '.'. auth()->user()->gelar_belakang }} @endif</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid text-sm">
        <!-- Small boxes (Stat box) -->
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              </div>
          @elseif(session()->has('hapus'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('hapus') }}
              </div>
          @elseif(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              </div>
          @endif
        @yield('content')
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <strong>Copyright &copy; Program Studi Teknik Sipil S1</strong>
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
<script src="{{ asset('dist/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('dist/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('dist/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('dist/plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('dist/plugins/chart.js/Chart.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('dist/plugins/sparklines/sparkline.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('dist/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('dist/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('dist/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('dist/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('dist/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('dist/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<!-- Font Awesome Kit -->
<script src="https://kit.fontawesome.com/f06ebf004e.js" crossorigin="anonymous"></script>

<script>
  window.setTimeout(function() {
    $(".alert").fadeTo(700, 0).slideUp(700, function(){
      $(this).remove(); 
    });
  }, 2000);
</script>
<script>
  function displayTimeAndGreeting() {
      const now = new Date();
      const hours = now.getHours();

      let greeting;
      if (hours >= 0 && hours < 11) {
          greeting = 'Selamat Pagi';
      } else if (hours >= 11 && hours < 15) {
          greeting = 'Selamat Siang';
      } else if (hours >= 15 && hours < 18) {
          greeting = 'Selamat Sore';
      } else if (hours >= 18 && hours < 24) {
          greeting = 'Selamat Malam';
      }

      document.getElementById('current-greeting').textContent = greeting;
  }

  // Memanggil fungsi displayTimeAndGreeting setiap detik (1000 ms)
  setInterval(displayTimeAndGreeting, 1000);
</script>
@yield('js')
</body>
</html>
