@extends ('pages.layouts.base',['title'=>'Gestion du Carburant_ Statistiques'])

@section('content')


  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-header  d-flex">
        <h4 class="card-title col-6 mt-3">Comparaison de la consommation des véhicules par mois</h4>
        <div class="col-md-6">
            <input type="month" class="form-control"  id="mois_year_comparateur"/>
        </div>
      </div>
      <div class="card-body">
              
        <div class="d-flex offset-4">
            <div class="col-5 font-weight-bold">Mois / Année : <span id='mois_year_selected'>  </span> </div>
            <div class="col-7 font-weight-bold">Total de Consommation : <span id='totalConsommationVehicules_par_mois'> </span> DHs</div>
        </div>
        <div id="comparateur_vehicule_mois"> </div>
      </div>
    </div>
  </div>

  
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-header  d-flex">
        <h4 class="card-title col-6 mt-3">Comparaison de la consommation des véhicules par Année</h4>
        <div class="col-md-6">
            <input type="text" class="form-control"  id="year_comparateur"/>
        </div>
      </div>
      <div class="card-body">
               
        <div class="d-flex offset-4">
            <div class="col-5 font-weight-bold">Année : <span id='year_selected'>  </span> </div>
            <div class="col-7 font-weight-bold">Total de Consommation : <span id='totalConsommationVehicules_par_annee'> </span> DHs</div>
        </div>
        <div id="comparateur_vehicule_annee"> </div>
      </div>
    </div>
  </div>
@endsection
