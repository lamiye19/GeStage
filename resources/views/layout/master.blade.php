<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administration- {{ config('app.name', 'GeStage') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{mix("css/app.css")}}">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('admin') }}" class="brand-link">
        <img src="" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">{{ config('app.name', 'GeStage') }}</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            @if (Auth::user()->is_admin)
            <img src="/users-icons/admin.ico" class="img-circle bg-white elevation-2" alt="Icône Admin">
            @else
            <img src="/users-icons/maitre.jpeg" class="img-circle bg-white elevation-2" alt="Icône maitre">
            @endif
          </div>
          <div class="info">
            <a href="#" class="d-inline justify-content-around">              
              <li class="nav-item">

                <strong>{{ Auth::user()->name }}</strong>&nbsp;

                <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                  <i class="fa fa-sign-out-alt text-danger"></i>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </li>
            </a>
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
            <li class="nav-item">
              <a href="{{route('admin')}}" class="nav-link active">
                <i class="nav-icon fas fa-home"></i>
                <p> Accueil </p>
              </a>
            </li>
            
            @if (Auth::user()->is_admin)

            <li class="nav-item">
              <a href="{{route('demandes')}}" class="nav-link">
                <i class="nav-icon fas fa-question-circle"></i>
                <p> Demandes </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('renouvellement')}}" class="nav-link">
                <i class="nav-icon fas fa-sync"></i>
                <p> Renouvellement </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('stagiaires')}}" class="nav-link">
                <i class="fa fa-users nav-icon"></i>
                <p>Stagiares</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('stages')}}" class="nav-link">
                <i class="far fa-folder-open nav-icon"></i>
                <p>Stages</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('maitres')}}" class="nav-link">
                <i class="fa fa-user-graduate nav-icon"></i>
                <p>Maitres de stages</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('services')}}" class="nav-link">
                <i class="far fa-building nav-icon"></i>
                <p>Services</p>
              </a>
            </li>
            @else
            <li class="nav-item">
              <a href="{{route('mes-stages', ['user' => Auth::user() ])}}" class="nav-link">
                <i class="far fa-folder-open nav-icon"></i>
                <p>Stages Suivi</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('mes-stagiaires', ['user' => Auth::user() ])}}" class="nav-link">
                <i class="fa fa-users nav-icon"></i>
                <p>Mes Stagiares</p>
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
        <div class="container-fluid">
          <div class="text-center mb-2">
            <h1 class="m-0">@yield("titre")</h1>
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col"></div>
            <div class="col-12">
              
              @yield("contenu")
            </div>
            <div class="col"></div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        <a class="text-black text-dark" data-widget="fullscreen" href="#" role="button" title="plein ecran">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2020-2021 <a href="">Lamiye</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <script src="{{mix('js/app.js')}}"></script>


</body>

</html>