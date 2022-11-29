<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;


use App\Models\Car;
use App\Models\Enregistrement;

class EnregistrementController extends Controller
{
    public function create(){
        $vehicules=Car::where('etat',1)->get();
        return view('pages.enregistrement', compact('vehicules'));
    }
    public function add(Request $req){
        $numOrdre=Enregistrement::count();
        $cyear =Carbon::now()->format('Y-m-d');
        $currentYear=Carbon::createFromFormat('Y-m-d', $cyear)->format('Y');
        $numBon=($req->bon).'/'.$currentYear;

        if($req->responsable==NULL){
            return back()->with('Erreur','Veuillez désigner le responsable qui a signé le bon de commande ');

        }elseif(Enregistrement::where('numBon',$numBon)->exists()) {
            return back()->with('Erreur','le Bon N° '.$numBon.'existe déjà');
        }else{
            Enregistrement::create([
                'numOrdre'=>($numOrdre+1),
                'date_enregistrement'=>$req->date_enregistrement,
                'car_id'=>$req->vehicule,
                'driver'=>$req->conducteur,
                //'driver_id'=>$req->conducteur,
                'km'=>$req->km,
                'numBon'=>$numBon,
                'responsable'=>$req->responsable,
                'montant'=>$req->montant
            ]);

            return back();
           // return redirect('/');
        }
    }

    public function edit(Enregistrement $record){
        $vehicules=Car::all();
        return view('pages.edit_enregistrement',compact('vehicules','record'));
    }

    public function update(Request $req,Enregistrement $record ){
        $cyear =Carbon::now()->format('Y-m-d');
        $currentYear=Carbon::createFromFormat('Y-m-d', $cyear)->format('Y');
        $numBon=($req->bon).'/'.$currentYear;

        if($req->responsable==NULL){
            return back()->with('Erreur','Veuillez désigner le responsable qui a signé le bon de commande ');

        }elseif (Enregistrement::where('numBon',$numBon)->where('id','!=',$record->id)->exists()) {
            return back()->with('Erreur','le Bon N° '.$numBon.' existe déjà');
        }else{
            $record->update([
                'date_enregistrement'=>$req->date_enregistrement,
                'car_id'=>$req->vehicule,
                'driver'=>$req->conducteur,
                //'driver_id'=>$req->conducteur,
                'km'=>$req->km,
                'numBon'=>$numBon,
                'responsable'=>$req->responsable,
                'montant'=>$req->montant
            ]);

            return redirect('/');
        }
    }


    public function delete(Enregistrement $record){
       $record->delete();
        return back()->with('SuccessDelete', '');

    }
}
