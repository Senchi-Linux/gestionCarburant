@extends ('pages.layouts.base',['title'=>'Gestion du Carburant _ Profil'])

@section('content')

  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-header d-flex">
        <h4 class="card-title col-6 mt-3">Profil : {{auth()->user()->name}}</h4>
      </div>
     
      <div class="card-body">
      @if(session()->has("Erreur"))
                <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                <span class="ti-alert"></span>  {{ session()->get("Erreur") }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
      @elseif(session()->has("Success"))  
      <div class="alert  alert-success alert-dismissible fade show" role="alert">
                <span class="ti-alert"></span>  {{ session()->get("Success") }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>      
       @endif
      <form class="col-md-8 pt-3" action="{{route('app_update_user',['user'=>auth()->user()->id])}}" method="POST">
                  @csrf
                  <div class="form-group">
                  <input type="text" name="login" class="form-control form-control-lg"  value="{{auth()->user()->name}}" required>
                </div>
                <div class="form-group">
                  <input type="email"  name="email" class="form-control form-control-lg"  value="{{auth()->user()->email}}"  required>
                </div>
                <div class="form-group">
                  <input type="password"  name="password" class="form-control form-control-lg"  placeholder="Nouveau mot de passe" >
                </div>
                <div class="form-group">
                  <input type="password"  name="passwordconfirmed" class="form-control form-control-lg"  placeholder="Confirmer le nouveau mot de passe" >
                </div>
                <div class="col-md-4 col-sm-3 mt-3">
                  <input type="submit" class="btn btn-block btn-warning font-weight-medium auth-form-btn" value="Valider">
                </div>
              </form>
      </div>
    </div>
  </div>

  
@endsection
