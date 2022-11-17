@extends ('pages.layouts.base',['title'=>'Mise à jour Conducteur'])


@section('content')
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Mise à jour Conducteur </h4>
                  <div class="col-12 grid-margin">
                  <form class="form-sample" method="POST" action="{{route('app_update_driver',['conducteur'=>$conducteur->id])}}">
                    @csrf
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nom</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="nom" value="{{$conducteur->nom}}">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Prénom</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="prenom" value="{{$conducteur->prenom}}">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">CIN</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="text" name="cin" value="{{$conducteur->cin}}">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Téléphone</label>
                          <div class="col-sm-9">
                          <input class="form-control" name="phone" type="tel" value="{{$conducteur->phone}}">
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-warning mr-2">Valider</button>
                  </form>
                  </div>
                </div>
            </div>
        </div>

      
           
@endsection

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>