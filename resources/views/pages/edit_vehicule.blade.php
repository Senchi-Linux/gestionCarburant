@extends ('pages.layouts.base',['title'=>'Mise à jour du Véhicule'])

@section('content')
        <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Mise à Jour du Véhicule : </h4>
                 
                  <form class="form-inline" method="POST" action="{{route('app_update_car',['vehicule'=>$vehicule->id])}}">
                    @csrf
                    <label class="sr-only" >Véhicule</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" name="designation"  placeholder="Véhicule" required value="{{$vehicule->designation}}">
                  
                    <label class="sr-only" >Immatriculation</label>
                    <div class="input-group mb-2 mr-sm-2">
                      <input type="text" class="form-control" placeholder="Immatriculation" name="immatricul" required value="{{$vehicule->immatriculation}}">
                    </div>
                   
                    <button type="submit" class="btn btn-warning mb-2">Valider</button>
                  </form>
                </div>
              </div>
        </div>
@endsection
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

