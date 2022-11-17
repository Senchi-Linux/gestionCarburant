@extends ('pages.layouts.base',['title'=>'Conducteurs'])


@section('content')
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Ajouter Conducteur </h4>
                  <div class="col-12 grid-margin">
                  <form class="form-sample" method="POST" action="{{route('app_add_driver')}}">
                    @csrf
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nom</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="nom">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Prénom</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="prenom">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">CIN</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="text" name="cin">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Téléphone</label>
                          <div class="col-sm-9">
                          <input class="form-control" name="phone" type="tel">
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-warning mr-2">Ajouter</button>
                    <button type="reset" class="btn btn-light mr-2">Annuler</button>
                  </form>
                  </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Liste des Conducteurs</h4>
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                            #
                          </th>
                          <th>
                            CIN
                          </th>
                          <th>
                            Nom et Prénom
                          </th>
                          <th>Téléphone</th>
                          <th>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($conducteurs as $conducteur)
                     <tr>
                         <td>{{$conducteur->id}}</td>
                         <td>{{$conducteur->cin}}</td>
                         <td>{{$conducteur->nom}} {{$conducteur->prenom}}</td>
                         <td>{{$conducteur->phone}}</td>
                         <td class='d-flex'>
                           <a href="{{route('app_edit_driver',['conducteur'=>$conducteur->id])}}" class="myicon"><i class="mdi mdi-pen"  title="Modifier Conducteur"></i></a>
                           <a href="#" onclick="validerSup(formDelete{{$conducteur->id}});" class="myicon"><i class="typcn typcn-trash"  title="Supprimer Conducteur"></i></a>
                           <form id="formDelete{{$conducteur->id}}" action="{{route('app_delete_driver',['conducteur'=>$conducteur->id])}}" method="POST">
                                 @csrf
                                 <input type="hidden" name="_method" value="delete">
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