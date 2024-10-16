<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ pageTitle($title ?? null) }}</title>

        <link rel="apple-touch-icon" href="{{asset('/images/logo.png')}}">
        <link rel="shortcut icon" href="{{asset('/images/logo.png')}}">
        <link rel="stylesheet" href="{{asset('/vendors/typicons.font/font/typicons.css')}}">
  <link rel="stylesheet" href="{{asset('/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('/css/vertical-layout-light/style.css')}}">

   
     </head>
     <body>
     <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-center py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="{{asset('/images/logo-ministere-sante.png')}}" alt="logo">
              </div>
              <h4>Gestion du Carburant</h4>
              <h6 class="font-weight-light">Connexion</h6>
                         
           @if(session()->has("Erreur"))
                <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                <span class="ti-alert"></span>  {{ session()->get("Erreur") }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
              <form class="pt-3" action="{{route('app_login_user')}}" method="POST">
                  @csrf
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Mote de passe" required>
                </div>
                <div class="mt-3">
                  <input type="submit" class="btn btn-block btn-warning btn-lg font-weight-medium auth-form-btn" value="SE CONNECTER">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>


  <script src="{{asset('/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{asset('/js/off-canvas.js')}}"></script>
  <script src="{{asset('/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('/js/template.js')}}"></script>
  <script src="{{asset('/js/settings.js')}}"></script>
  <script src="{{asset('/js/todolist.js')}}"></script>
     </body>

</html>
