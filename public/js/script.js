function validerSup(params){
    swal({
            title: 'Voulez-vous vraiment effectuer cette suppression ?',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    params.submit(); 
            }
    });
  };

  function validerActivation(params){
    swal({
            title: 'Voulez-vous vraiment effectuer cette Opération?',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            })
            .then((willActivy) => {
                if (willActivy) {
                    params.submit(); 
            }
    });
  };
  let url_variable="http://127.0.0.1:8000";
 $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
$(document).ready(function () {
  let monthNames = ["Janvier", "Février", "Mars", "Avril", "Mai","Juin","Juillet", "Août", "Septembre", "Octobre", "Novembre","Décembre"];

    $('#mois').on('change',function(ev){
      $('#totalCons_car').val('');
      $('#totalConsommationVehicule').html('');
      $('#totalBon_car').val('');
      $('#totalBonVehicule').html('');
      $('#records_car').html('');
      $('#selctedMonth').html('');
      $('#selctedYear').html('');
      $('#consommation-mensuelle-dun-vehicule').html('');
      $('#consommation-annuelle-dun-vehicule').html('');

      let obj =[];
      let objYear =[];
      var tableauVal=[];
      var tableauValYear=[];

      dateprecisee=ev.target.value;
      car=$('#car').val();

      $.ajax({
        url: url_variable+'statics_mensuel',
        method:'get', 
        data:{
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          dateprecisee: dateprecisee,
          car:car
        },
        success: function(result){
           $('#records_car').html(result.tableau);
           $('#selctedMonth').html(monthNames[(result.mois)-1]);
           $('#selctedYear').html(result.yeard);

           nombreJourParMois=daysInMonth(result.mois, result.yeard);

           var totalConsomVehicule=$('#totalCons_car').val();
           $('#totalConsommationVehicule').html(totalConsomVehicule);
           var totalBonVehicule=$('#totalBon_car').val();
           $('#totalBonVehicule').html(totalBonVehicule);
           
            $.each(result.compteur_mois, function(index, value) {
                obj[value.indice]=value.compteur;
            });

            $.each(result.results, function(indexx, valuue) {
              objYear.push(indexx);
              tableauValYear.push(valuue);
            });
            
              var jourMois=[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31];
              var monthOfYear=[1,2,3,4,5,6,7,8,9,10,11,12];


                for(var k=1; k<=obj.length;k++){
                  if(jourMois[k-1]==k){
                    tableauVal.push(obj[k]);
                  }else{
                    tableauVal.push(0);
                  }            
                };

               
                $('#consommation-mensuelle-dun-vehicule').append('<canvas id="barChart-car"></canvas>');
                $('#consommation-annuelle-dun-vehicule').append('<canvas id="barChartYear-car"></canvas>');

                chartBar(jourMois, tableauVal,$("#barChart-car"));
                chartBar(objYear, tableauValYear,$("#barChartYear-car"));     
       
          }
      });
    });

    var totalConsomVehicule=$('#totalCons_car').val();
    $('#totalConsommationVehicule').html(totalConsomVehicule);

    var totalBonVehicule=$('#totalBon_car').val();
    $('#totalBonVehicule').html(totalBonVehicule);


  $('#par_mois_all_cars').on('change',function(v){
    dateprecisee=v.target.value;
    $("#consommation_mensuelle_tous_vehicules").html('');
    $("#total_consommation_mensuelle_tous_vehicules").html('');
    $.ajax({
      url: url_variable+'statics_mensuel_all_cars',
      method:'get', 
      data:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        dateprecisee: dateprecisee,
      },
      success: function(result){
          $("#consommation_mensuelle_tous_vehicules").append('<canvas id="barChartMonth-all-cars"></canvas>');
          objMonth=[];
          tableauVal=[];
          $.each(result.results, function(indexx, valuue){
            objMonth.push(indexx);
            tableauVal.push(valuue);
          });  
          console.log(result.total);        
          $("#total_consommation_mensuelle_tous_vehicules").html((result.total).toFixed(2));
          chartBar(objMonth, tableauVal,$("#barChartMonth-all-cars"));
      }
    });
  });


  $('#parAnnes_all_cars').on('change',function (ev) {
    let objYear =[];
    var tableauValYear=[];
    dateprecisee=ev.target.value;
    $("#consommation_annuelle_tous_vehicules").html('');
    $("#total_consommation_annuelle_tous_vehicules").html('');

    var monthNames = ["Janvier", "Février", "Mars", "Avril", "Mai","Juin","Juillet", "Août", "Septembre", "Octobre", "Novembre","Décembre"];

    $.ajax({
      url: url_variable+'statics_annuel_all_cars',
      method:'get', 
      data:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        dateprecisee: dateprecisee,
      },
      success: function(result) {
        $("#consommation_annuelle_tous_vehicules").append('<canvas id="barChartYear-all-cars"></canvas>');
      
          $.each(result.results, function(indexx, valuue) {
            objYear.push(indexx);
            tableauValYear.push(valuue);
          });

          $("#total_consommation_annuelle_tous_vehicules").html((result.total).toFixed(2));

                chartBar(objYear, tableauValYear,$("#barChartYear-all-cars") );

        }
    });
  });



  $("#parAnnes_all_cars").datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years"
  });

  $("#year_comparateur").datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years"
  });
  
  $('#mois_year_comparateur').on('change', function (e) {
    $("#comparateur_vehicule_mois").html('');
    $("#totalConsommationVehicules_par_mois").html('');
    $('#mois_year_selected').html('');
    mois_comparaison=e.target.value;
    tableCars=[];
    tableCompteur=[];
    tableIdCars=[];

    $.ajax({
      url: url_variable+'statics_comparateur_cosommation_mensuel_cars',
      method:'get', 
      data:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        mois_comparaison: mois_comparaison,
      },
      success: function(result) {
          $.each(result.resultat, function(index, value) {
            tableCars.push(index);
            tableCompteur.push(value);
            });

        $("#comparateur_vehicule_mois").append('<canvas id="barChartMonth-comparateur-all-cars"></canvas>');
        $("#totalConsommationVehicules_par_mois").html((result.compteur_m).toFixed(2));
        $('#mois_year_selected').html(monthNames[(result.mois)-1]+' / '+result.yeard);

        chartBar(tableCars, tableCompteur,$("#barChartMonth-comparateur-all-cars") );
      }
    });
    
  });


  $('#year_comparateur').on('change', function (e) {
    $("#comparateur_vehicule_annee").html('');
    $("#totalConsommationVehicules_par_annee").html('');
    $('#year_selected').html('');
    an_comparaison=e.target.value;
    tableCars=[];
    tableCompteur=[];

    $.ajax({
      url: url_variable+'statics_comparateur_cosommation_annuel_cars',
      method:'get', 
      data:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        an_comparaison: an_comparaison,
      },
      success: function(result) {
       
        $.each(result.resultaty, function(index, value) {
          tableCars.push(index);
          tableCompteur.push(value);
          });

        $("#comparateur_vehicule_annee").append('<canvas id="barChartYear-comparateur-all-cars"></canvas>');
        $("#totalConsommationVehicules_par_annee").html((result.compteur_y).toFixed(2));
        $('#year_selected').html(+result.yeard);

        chartBar(tableCars, tableCompteur,$("#barChartYear-comparateur-all-cars") );
      }
    });
    
  });
  
  consommationParAnTousVehicules();
});


function daysInMonth (month, year) {
  return new Date(year, month, 0).getDate();
}

function consommationParAnTousVehicules(){
  $.ajax({
    url: url_variable+'statics_par_an_all_cars',
    method:'get', 
    data:{
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
    success: function(result){
        $("#consommation_par_an_tous_vehicules").append('<canvas id="barChart-at-year-all-cars"></canvas>');
        objMonth=[];
        tableauVal=[];
        $.each(result.results, function(index, value){
          objMonth.push(index);
          tableauVal.push(value);
        });  

        chartBar(objMonth, tableauVal,$("#barChart-at-year-all-cars"));
    }
  });
}

function chartBar(X, Y, zone){

  'use strict';
  var data = {
   labels: X,
    datasets: [{
      label: 'consomation en (DH)',
      data: Y,
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 70, 132, 0.2)',
        'rgba(54, 172, 235, 0.2)',
        'rgba(255, 216, 86, 0.2)',
        'rgba(75, 102, 192, 0.2)',
        'rgba(153, 192, 255, 0.2)',
        'rgba(255, 169, 64, 0.2)',
        'rgba(255, 10, 132, 0.2)',
        'rgba(54, 152, 235, 0.2)',
        'rgba(255, 226, 86, 0.2)',
        'rgba(75, 112, 192, 0.2)',
        'rgba(153, 132, 255, 0.2)',
        'rgba(255, 169, 64, 0.2)',
        'rgba(255, 79, 132, 0.2)',
        'rgba(54, 192, 235, 0.2)',
        'rgba(255, 246, 86, 0.2)',
        'rgba(75, 132, 192, 0.2)',
        'rgba(153, 12, 255, 0.2)',
        'rgba(255, 19, 64, 0.2)',
        'rgba(255, 199, 132, 0.2)',
        'rgba(54, 62, 235, 0.2)',
        'rgba(255, 26, 86, 0.2)',
        'rgba(75, 182, 192, 0.2)',
        'rgba(153, 142, 255, 0.2)',
        'rgba(255, 59, 64, 0.2)',
        'rgba(75, 62, 192, 0.2)',
        
      ],
      borderColor: [
        'rgba(255, 99, 132,1)',
        'rgba(54, 162, 235,1)',
        'rgba(255, 206, 86,1)',
        'rgba(75, 192, 192,1)',
        'rgba(153, 102, 255,1)',
        'rgba(255, 159, 64,1)',
        'rgba(255, 70, 132,1)',
        'rgba(54, 172, 235,1)',
        'rgba(255, 216, 86,1)',
        'rgba(75, 102, 192,1)',
        'rgba(153, 192, 255,1)',
        'rgba(255, 169, 64,1)',
        'rgba(255, 10, 132,1)',
        'rgba(54, 152, 235,1)',
        'rgba(255, 226, 86,1)',
        'rgba(75, 112, 192,1)',
        'rgba(153, 132, 255,1)',
        'rgba(255, 169, 64,1)',
        'rgba(255, 79, 132,1)',
        'rgba(54, 192, 235,1)',
        'rgba(255, 246, 86,1)',
        'rgba(75, 132, 192,1)',
        'rgba(153, 12, 255,1)',
        'rgba(255, 19, 64,1)',
        'rgba(255, 199, 132,1)',
        'rgba(54, 62, 235,1)',
        'rgba(255, 26, 86,1)',
        'rgba(75, 182, 192,1)',
        'rgba(153, 142, 255,1)',
        'rgba(255, 59, 64,1)',
        'rgba(75, 62, 192,1)',
      ],
      borderWidth: 1,
      fill: false
    }]
  };

  var options = {
   scales: {
     yAxes: [{
       ticks: {
         beginAtZero: true
       }
     }]
   },
   legend: {
     display: false
   },
   elements: {
     point: {
       radius: 0
     }
   }

 };

 if (zone.length) {
   var barChartCanvas = zone.get(0).getContext("2d");
   var barChart = new Chart(barChartCanvas, {
     type: 'bar',
     data: data,
     options: options
   });
 }
}