<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


use App\Models\Car;
use App\Models\Conducteur;
use App\Models\Enregistrement;

class StatistiqueController extends Controller
{
    public function create(){
        $records=Enregistrement::orderBy('numOrdre','DESC')->get();
        $cars=Car::count();
        $cyear =Carbon::now()->format('Y-m-d');
        $currentYear=Carbon::createFromFormat('Y-m-d', $cyear)->format('Y');
       // $currentYear=(int)$cyear;
        $consommationAnnuelle=Enregistrement::select(DB::raw("SUM(montant) AS compteur"))
                                            ->where(DB::raw("YEAR(date_enregistrement)"),$currentYear)
                                            ->first();
        
      //  $consomAnnuelle=$consommationAnnuelle[0]['compteur'];


var_dump($consommationAnnuelle);
        
       //return view('pages.home', compact('records','cars','consomAnnuelle'));
    }

    public function getConsByMonthOfCar(Request $req){
       
        $tableau=null;
     
        $km=0;
        $totalConsom=0;
       $monthd= date("m", strtotime($req->dateprecisee));
       $yeard= date("Y", strtotime($req->dateprecisee));

       $lastMonth=date("m", strtotime('-1 month', strtotime($req->dateprecisee)));


      $records_v=Enregistrement::where('car_id',$req->car)->where( DB::raw("MONTH(date_enregistrement)"),'=',$monthd)->where( DB::raw("YEAR(date_enregistrement)"),'=',$yeard)->orderBy('numOrdre')->get();
        $records_compteur_mois=Enregistrement::select(DB::raw("SUM(montant) AS compteur"), DB::raw("DAY(date_enregistrement) AS indice"))->where('car_id',$req->car)->where( DB::raw("MONTH(date_enregistrement)"),'=',$monthd)->where( DB::raw("YEAR(date_enregistrement)"),'=',$yeard)->groupBy(DB::raw("DAY(date_enregistrement)"))->get();
        $records_compteur_year=Enregistrement::select(DB::raw("SUM(montant) AS compteur_y"), DB::raw("MONTH(date_enregistrement) AS indicem"))->where('car_id',$req->car)->where( DB::raw("YEAR(date_enregistrement)"),'=',$yeard)->groupBy(DB::raw("MONTH(date_enregistrement)"))->get();
        $cpt=Enregistrement::select('km')->where('car_id',$req->car)->where( DB::raw("MONTH(date_enregistrement)"),'=',$lastMonth)->where( DB::raw("YEAR(date_enregistrement)"),'=',$yeard)->orderBy('numOrdre','DESC')->first();
       
        if($cpt!=null){
            $lastKm=$cpt->km;
        }else{
            $lastKm=0;
        }
        
        foreach ($records_v as $item){
            $km=($item->km)-$lastKm;
            if($km==$item->km){$km='-'; $lastKm='-'; }
            $tableau.='<tr><td width="20%">'.date('d-m-Y',strtotime($item->date_enregistrement)).'</td>
            <td width="10%">'.$item->numBon.'</td>
            <td width="20%">';
            if($item->responsable=="Delegue"){
                $tableau.= 'DR Hicham Alaoui Ismaili';
            }else{
                $tableau.= 'Mr Adil El Aissaoui';
            }
            $tableau.='</td><td>'.$lastKm.'</td><td>'.$item->km.'</td>
            <td>'.$km.'</td>
            <td>'.number_format($item->montant, 2).'</td></tr>';
            $lastKm=$item->km;
            $totalConsom +=(number_format($item->montant, 2));
        }

        $tableau.='<input type="hidden" id="totalCons_car" value="'.number_format($totalConsom, 2).'">';
        $tableau.='<input type="hidden" id="totalBon_car" value="'.count($records_v).'">';
       
        return response()->json([
            'tableau'=>$tableau,
            'compteur_mois'=>$records_compteur_mois,
            'compteur_annee'=>$records_compteur_year,
            'mois'=>$monthd,
            'yeard'=>$yeard
        ]);
    }

    public function getConsByMonthOfAllCars(Request $req){
    
        $results=[];
        $tableValue[]=[];
        $tableDaysMonth=[];

        $yeard= date("Y", strtotime($req->dateprecisee));
        $monthd= date("m", strtotime($req->dateprecisee));
        $number = cal_days_in_month(CAL_GREGORIAN, $monthd, $yeard);

        $consommationparmois=Enregistrement::select(DB::raw("SUM(montant) AS compteur"), DB::raw("DAY(date_enregistrement) AS indice"))
                                            ->where( DB::raw("MONTH(date_enregistrement)"),'=',$monthd)
                                            ->where( DB::raw("YEAR(date_enregistrement)"),'=',$yeard)
                                            ->groupBy(DB::raw("DAY(date_enregistrement)"))
                                            ->get();
        

            foreach ($consommationparmois as $value) {
                $tableValue[$value->indice]=$value->compteur;
                array_push($tableDaysMonth,$value->indice );
            }

            for($i=1; $i<=$number; $i++){
                if(in_array($i,$tableDaysMonth)){
                     $results[$i]=$tableValue[$i];
                }else{
                    $results[$i]=0;
                }
            }

        return response()->json([
            'results'=>$results
        ]);
    }


    public function getConsByYearOfAllCars(Request $req){

            
        $results=[];
        $tableValue[]=[];
        $tableMonths=[];
        $monthName=null;

        $consommationparannee=Enregistrement::select(DB::raw("SUM(montant) AS compteur_year"), DB::raw("MONTH(date_enregistrement) AS indicem"))
                                            ->where( DB::raw("YEAR(date_enregistrement)"),'=',$req->dateprecisee)
                                            ->groupBy(DB::raw("MONTH(date_enregistrement)"))
                                            ->get();

        
        foreach ($consommationparannee as $value) {
            $tableValue[$value->indicem]=$value->compteur_year;
            array_push($tableMonths,$value->indicem );
        }
        for($i=1; $i<=12; $i++){
            $date = Carbon::createFromFormat('m', $i);
            $monthName = $date->format('M');
            if(in_array($i,$tableMonths)){
            
                $results[$monthName]=$tableValue[$i];
            }else{
                $results[$monthName]=0;
            }
        }
        return response()->json([
            'results'=>$results
        ]);
    }


    public function createC(){

        return view('pages.comparateur');
    }

    public function getConsoOfCarsInMonth(Request $req){
        $yeard= date("Y", strtotime($req->mois_comparaison));
        $monthd= date("m", strtotime($req->mois_comparaison));
        $tableValue[]=[];
        $tableidCars=[];
        $valeeeur=[];
        $consommationparmois=Enregistrement::select(DB::raw("SUM(montant) AS compteur"), 'car_id as vehicule')
                                                ->where(DB::raw("MONTH(date_enregistrement)"),'=',$monthd)
                                                ->where(DB::raw("YEAR(date_enregistrement)"),'=',$yeard)
                                                ->groupBy('car_id')
                                                ->get();
        $cars= Car::select('*')->get();

     foreach ($consommationparmois as  $value) {
            $tableValue[$value->vehicule]=$value->compteur;
            array_push($tableidCars, $value->vehicule);
        }
        foreach($cars as $item){
            if(in_array($item->id,$tableidCars)){
               $valeeeur[$item->designation.' | '.$item->immatriculation]= $tableValue[$item->id];
            }else{
                $valeeeur[$item->designation.' | '.$item->immatriculation]=0;
            }
          
          }

        
           
      return response()->json([
            'resultat'=>$valeeeur,
            'mois'=>$monthd,
            'yeard'=>$yeard
        ]);

    }

    public function getConsoOfCarsInYear(Request $req){
       $yeard=$req->an_comparaison;
        $tableValue=[];
        $tableidCars=[];
        $valeeeur=[];
        $consommationparan=Enregistrement::select(DB::raw("SUM(montant) AS compteur"), 'car_id as vehicule')
                                                ->where( DB::raw("YEAR(date_enregistrement)"),'=',$yeard)
                                                ->groupBy('car_id')
                                                ->get();
        $cars= Car::select('*')->get();
        
       
        foreach ($consommationparan as  $value) {
            $tableValue[$value->vehicule]=$value->compteur;
            array_push($tableidCars, $value->vehicule);
        }
        foreach($cars as $item){
            if(in_array($item->id,$tableidCars)){
               $valeeeur[$item->designation.' | '.$item->immatriculation]= $tableValue[$item->id];
            }else{
                $valeeeur[$item->designation.' | '.$item->immatriculation]=0;
            }
          
          }
           
      return response()->json([
            'resultaty'=>$valeeeur,
            'yeard'=>$yeard
        ]);

    }

}



