@extends ('pages.layouts.base',['title'=>'Mise à jour Enregistrement'])


@section('content')
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Mise à jour Enregistrement : {{$record->numOrdre}}</h4>
                  <div class="col-12 grid-margin">
                  <form class="form-sample" method="POST" action="{{route('app_update_record',['record'=>$record->id])}}">
                  @csrf
                  <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Date </label>
                          <div class="col-sm-9">
                            <input type="date" name="date_enregistrement" class="form-control" required value="{{$record->date_enregistrement}}">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Véhicule</label>
                          <div class="col-sm-8">
                            <select class="form-control" name="vehicule" required>
                              <option></option>
                              @foreach($vehicules as $vehicule)
                              <option value="{{$vehicule->id}}" @if($record->car_id ==$vehicule->id) selected @endif>{{$vehicule->designation}} | {{$vehicule->immatriculation}}</option>
                              @endforeach
                            </select>
                          </div>
                          <a href="" data-toggle="modal" data-target="#add-car-modal" class="col-sm-1" title="Ajouter Véhicule">
                              <span  class="typcn typcn-plus myicon" ></span>
                          </a>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Conducteur</label>
                          <div class="col-sm-9">
                            <input type="text" name="conducteur" class="form-control" value="{{$record->driver}}">
                         
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Kilomètrage</label>
                          <div class="col-sm-9">
                          <input type="number" name="km" class="form-control" required value="{{$record->km}}">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">N° Bon</label>
                          <div class="col-sm-9">
                          <input type="number" name="bon" class="form-control" required value="{{$record->numBon}}">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Signé par </label>
                          <div class="col-sm-9">
                          <select class="form-control" name="responsable" required>
                              <option></option>
                              <option value="Delegue" @if($record->responsable == 'Delegue') selected @endif>DR Hicham Alaoui Ismaili</option>
                              <option value="Econome"  @if($record->responsable == 'Econome') selected @endif>Mr Adil El Aissaoui</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Montant (DH)</label>
                          <div class="col-sm-9">
                          <input type="number" name="montant" class="form-control" required value="{{$record->montant}}">
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