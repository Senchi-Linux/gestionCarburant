@extends ('pages.layouts.base',['title'=>'Véhicules'])

@section('content')
        <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Ajouter Véhicule </h4>
                 
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

        <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Liste des Véhicules</h4>
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                            #
                          </th>
                          <th>
                            Véhicule
                          </th>
                          <th>
                            Immatriculation
                          </th>
                          <th>
                            État
                          </th> 
                          <th>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($vehicules as $vehicule)
                     <tr>
                         <td></td>
                         <td>{{$vehicule->designation}}</td>
                         <td>{{$vehicule->immatriculation}}</td>
                         <td> @if($vehicule->etat == 1)
                               <label class="badge badge-success">Actif</label>
                              @else
                               <label class="badge badge-danger">Inactif</label>
                              @endif
                            </td>
                         <td class='d-flex'>
                           <a href="{{route('app_detail_car',['vehicule'=>$vehicule->id])}}" class="myicon" title="Détails Véhicule"><i class="mdi mdi-file-document"></i></a>
                           <a href="{{route('app_edit_car',['vehicule'=>$vehicule->id])}}" class="myicon"><i class="mdi mdi-pen"  title="Modifier Véhicule"></i></a>
                           <a href="#" onclick="validerSup(formDelete{{$vehicule->id}});" class="myicon"><i class="typcn typcn-trash"  title="Supprimer Véhicule"></i></a>
                                
                           @if($vehicule->etat == 1)
                           <a href="#" onclick="validerActivation(formActiver{{$vehicule->id}});" class="myicon"><i class="mdi mdi-eye-off" title="Désactiver ce Véhicule"></i></a>
                           @else
                           <a href="#" onclick="validerActivation(formActiver{{$vehicule->id}});" class="myicon"><i class="mdi mdi-eye"  title="Activer ce Véhicule"></i></a>
                           @endif


                           <form id="formDelete{{$vehicule->id}}" action="{{route('app_delete_car',['vehicule'=>$vehicule->id])}}" method="POST">
                                 @csrf
                                 <input type="hidden" name="_method" value="delete">
                            </form>
                            <form id="formActiver{{$vehicule->id}}" action="{{route('app_activer_car',['vehicule'=>$vehicule->id])}}" method="POST">
                                 @csrf
                                 <input type="hidden" name="_method" value="put">
                            </form>
                           
                         </td>
                     </tr>
                     @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
@endsection
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>