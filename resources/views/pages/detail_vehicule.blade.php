@extends ('pages.layouts.base',['title'=>'Détails du Véhicule'])


@section('content')
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Véhicule : <span class="title_specif">{{$vehicule->designation}} | {{$vehicule->immatriculation}}</span> </h4>
                </div>
            </div>
        </div>
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-header d-flex">
              <h4 class="card-title col-6 mt-3">État Mensuelle du Véhicule</h4>
              
              <input type="month" class="form-control col-6" id="mois">

              <input type="hidden" id="car" value="{{$vehicule->id}}">
            </div>
            <div class="card-body">
              <div class="col-12 grid-margin">
                <div class="d-flex offset-4">
                  <div class="col-5 font-weight-bold">Nombre de Bon : <span id='totalBonVehicule'>  </span> </div>
                  <div class="col-7 font-weight-bold">Total de Consommation : <span id='totalConsommationVehicule'> </span> DHs</div>
                </div>
                <div class="table-responsive pt-3">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>N° Bon</th>
                        <th>Signé par</th>
                        <th>Ancien Index (Km)</th>
                        <th>Nouveau Index (Km)</th>
                        <th>Distance Parcourue (Km)</th>
                        <th>Montant (DH)</th>
                      </tr>
                    </thead>
                    <tbody id="records_car">
                      <?php
                      $totalConsom=0;
                      $cpt=0;
                      $kml=0;
                      ?>
                      @foreach($records as $record)
                      <?php $kml=($record->km)-$cpt;if($kml==$record->km){$kml='-'; $cpt='-'; }?>
                      <tr>
                        <td width="20%">{{date('d-m-Y',strtotime($record->date_enregistrement))}}</td>
                        <td width="10%">{{$record->numBon}}</td>
                        <td width="20%">@if($record->responsable=="Delegue")
                          DR Hicham Alaoui Ismaili
                          @else
                          Mr Adil El Aissaoui
                          @endif
                        </td>
                        <td>{{$cpt}}</td>
                        <td>{{$record->km}}</td>
                        <td>{{$kml}}</td>
                        <td>{{number_format($record->montant, 2)}}</td>
                      </tr>
                      <?php 
                      $totalConsom +=(number_format($record->montant, 2));
                      $cpt=$record->km;
                      ?>
                      @endforeach
                      <input type="hidden" id="totalCons_car" value="{{number_format($totalConsom, 2)}}">
                      <input type="hidden" id="totalBon_car" value=" {{count($records)}}">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 grid-margin stretch-card">
          <div class="card">
          <div class="card-header d-flex">
                <h4 class="card-title col-6 mt-3">Consommation Mensuelle du Véhicule</h4>
                <span id="selctedMonth" class="form-control col-6"></span>
                </div>
            <div class="card-body">
            <div class="col-12 grid-margin" id="consommation-mensuelle-dun-vehicule">
                    
                  </div>
            </div>
          </div>
        </div> 
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
          <div class="card-header d-flex">
                <h4 class="card-title col-6 mt-3">Consommation Annuelle du Véhicule</h4>
                <span id="selctedYear" class="form-control col-6"></span>
                </div>
            <div class="card-body">
            <div class="col-12 grid-margin"  id="consommation-annuelle-dun-vehicule">
                    
                  </div>
            </div>
          </div>
        </div> 
@endsection

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
