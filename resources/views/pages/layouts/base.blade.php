<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ pageTitle($title ?? null) }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('/css/monstyle.css')}}">

    <link rel="stylesheet" href="{{asset('/vendors/typicons.font/font/typicons.css')}}">
    <link rel="stylesheet" href="{{asset('/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <!-- endinject --> 
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('/css/vertical-layout-light/style.css')}}">
    <link rel="stylesheet" href="{{asset('/vendors/mdi/css/materialdesignicons.min.css')}}">

    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('/images/logo.png')}}" />
</head>

<body>
@if(session()->has("SuccessDelete"))
            <script>
            Swal.fire(
            'Suppression réussie','{{ session()->get("SuccessDelete") }}','success'
            )
            </script>
        @elseif(session()->has("Erreur"))
        <script>
            Swal.fire(
            'erreur','{{ session()->get("Erreur") }}','error'
            )
            </script>
             @elseif(session()->has("SuccessAdd"))
        <script>
            Swal.fire(
            'Opération Réussie','{{ session()->get("SuccessAdd") }}','success'
            )
            </script>
        @endif

<div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="brand-logo mon-logo" href="{{route('app_home_page')}}"><img src="{{asset('/images/logo.png')}}" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center d-none d-lg-flex" type="button" data-toggle="minimize">
            <span class="typcn typcn-th-menu"></span>
          </button>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <ul class="navbar-nav mr-lg-2">
            <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link" href="{{route('app_page_vehicule')}}">
                Véhicules
              </a>
            </li>
            <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link " href="{{route('app_page_conducteur')}}">
                Conducteurs
              </a>
            </li>
            <li class="nav-item  d-none d-lg-flex">
              <a class="nav-link" href="{{route('app_comparateur_consommation_vehicules')}}">
              Comparateur de Consommation des Véhicules
              </a>
            </li>
          </ul>
          <ul class="navbar-nav navbar-nav-right">
            
           
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle  pl-0 pr-0" href="#" data-toggle="dropdown" id="profileDropdown">
                <i class="typcn typcn-user-outline mr-0"></i>
                <span class="nav-profile-name">{{auth()->user()->name}}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="{{route('app_profil_page')}}">
                <i class="typcn typcn-user-outline text-primary"></i>
                Profil
                </a>
                <a class="dropdown-item" href="{{route('app_logout_user')}}">
                <i class="typcn typcn-power text-primary"></i>
                Se déconnecter
                </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="typcn typcn-th-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
       
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <div class="d-flex sidebar-profile">
                <div class="sidebar-profile-name">
                  <p class="sidebar-name text-center">
                    Délégation Provinciale de Santé et de la Protection Sociale _ GUERCIF
                  </p>
                </div>
              </div>
            
              <p class="sidebar-menu-titlee mb-4 text-uppercase">Gestion du Carburant</p>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('app_home_page')}}">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Tableau de Bord </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('app_page_vehicule')}}">
              <i class="mdi mdi-car menu-icon"></i>
              <span class="menu-title">Véhicules</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('app_page_conducteur')}}">
              <i class="typcn typcn-user menu-icon"></i>
              <span class="menu-title">Conducteurs </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('app_page_new_record')}}">
              <i class="mdi mdi-database menu-icon"></i>
              <span class="menu-title">Nouveau Enregistrement </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('app_comparateur_consommation_vehicules')}}">
              <i class="mdi mdi-ev-station menu-icon"></i>
              <span class="menu-title">Comparateur de </br>Consommation des Véhicules </span>
              </a>
            </li>
      
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
            @yield('content')

          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
</div>


    <div class="modal fade" id="add-car-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog ">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Nouveau Véhicule</h4>
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                  <form class="form-inline" method="POST" action="{{route('app_add_car')}}">
                    @csrf
                    <label class="sr-only" >Véhicule</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" name="designation"  placeholder="Véhicule" required>
                  
                    <label class="sr-only" >Immatriculation</label>
                    <div class="input-group mb-2 mr-sm-2">
                      <input type="text" class="form-control" placeholder="Immatriculation" name="immatricul" required>
                    </div>
                   
                    <button type="submit" class="btn btn-warning mb-2">Ajouter</button>
                  </form>
                </div>
              </div>
            </div>
    </div> 

     <!-- base:js -->
     <script src="{{asset('/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{asset('/js/off-canvas.js')}}"></script>
    <script src="{{asset('/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('/js/template.js')}}"></script>
    <script src="{{asset('/js/settings.js')}}"></script>
    <script src="{{asset('/js/todolist.js')}}"></script>
    <script src="{{asset('/js/script.js')}}"></script>
    <script src="{{asset('/js/data-table.js')}}"></script>
    <script src="{{asset('/js/paginate.js')}}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="{{asset('/vendors/progressbar.js/progressbar.min.js')}}"></script>
    <script src="{{asset('/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('/vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{asset('/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="{{asset('/js/dashboard.js')}}"></script>
    <!-- End custom js for this page-->
    <script src="{{asset('/js/chart.js')}}"></script>
    <script src="{{asset('/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <!--script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



</body>
</html>
