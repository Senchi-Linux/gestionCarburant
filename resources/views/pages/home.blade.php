@extends ('pages.layouts.base',['title'=>'Gestion du Carburant'])

@section('content')

  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body row">
        <h4 class="card-title"></h4>
        <div class="col-xl-6 col-sm-6 col-12">
          <div class="card">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                   <div class="media-body text-left">
                     <h3 class="warning">{{$cars}}</h3>
                     <span>Véhicules</span>
                    </div>
                    <div class="align-self-center">
                      <i class="mdi mdi-car icon-home font-large-2 float-right"></i>
                    </div>
                </div>
                <div class="progress mt-1 mb-0" style="height: 7px;">
                   <div class="progress-bar bg-warning" role="progressbar" style="width: 35%" aria-valuenow="{{$cars}}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-sm-6 col-12">
          <div class="card">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                   <div class="media-body text-left">
                     <h3 class="warning">{{$consomAnnuelle}} DHS</h3>
                     <span>Consommation Annuelle : {{date("Y")}}</span>
                    </div>
                    <div class="align-self-center">
                      <i class="mdi mdi-ev-station icon-home font-large-2 float-right"></i>
                    </div>
                </div>
                <div class="progress mt-1 mb-0" style="height: 7px;">
                   <div class="progress-bar bg-warning" role="progressbar" style="width: 35%" aria-valuenow="{{$consomAnnuelle}}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
         <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Enregistrements</h4>
                  <div class="table-responsive pt-3">
                  <table id="order-listing" class="table dataTables_wrapper">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Date</th>
                          <th>Véhicule</th>
                          <th>Kilométrage</th> 
                          <th>N° Bon</th>
                          <th>Signé par</th>
                          <th>Montant (DH)</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($records as $record)
                     <tr>
                         <td>{{$record->numOrdre}}</td>
                         <td>{{date('d-m-Y',strtotime($record->date_enregistrement))}}</td>
                         <td>{{$record->car->designation}} | {{$record->car->immatriculation}}</td>
                         <td> {{$record->km}}</td>
                         <td> {{$record->numBon}}</td>
                         <td> @if($record->responsable=="Delegue")
                              DR Hicham Alaoui Ismaili
                              @else
                              Mr Adil El Aissaoui
                              @endif</td>
                         <td> {{number_format($record->montant, 2)}}</td>
                         <td class='d-flex'>
                           <a href="{{route('app_edit_record',['record'=>$record->id])}}" class="myicon"><i class="mdi mdi-pen"  title="Modifier Véhicule"></i></a>
                           <a href="#" onclick="validerSup(formDelete{{$record->id}});" class="myicon"><i class="typcn typcn-trash"  title="Supprimer Véhicule"></i></a>
                                
                          


                           <form id="formDelete{{$record->id}}" action="{{route('app_delete_record',['record'=>$record->id])}}" method="POST">
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


    <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-header  d-flex">
        <h4 class="card-title col-6 mt-3">Consommation Mensuelle Par tous les véhicules</h4>
        <input type="month" class="form-control"  id="par_mois_all_cars" />
      </div>
      <div class="d-flex offset-6 mt-4">
        <div class="col-7 font-weight-bold">Total de Consommation : <span id='total_consommation_mensuelle_tous_vehicules'> </span> DHs</div>
      </div>
      <div class="card-body" id="consommation_mensuelle_tous_vehicules">
       
      </div>
    </div>
  </div>

  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-header  d-flex">
        <h4 class="card-title col-6 mt-3">Consommation Annuelle Par tous les véhicules</h4>
        <input type="text" class="form-control"  id="parAnnes_all_cars" />
      </div>
      <div class="d-flex offset-6 mt-4">
        <div class="col-7 font-weight-bold">Total de Consommation : <span id='total_consommation_annuelle_tous_vehicules'> </span> DHs</div>
      </div>
      <div class="card-body" id="consommation_annuelle_tous_vehicules"></div>
    </div>
  </div>

  
@endsection
