<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        if($req->responsable==NULL){
            return back()->with('Erreur','Veuillez désigner le responsable qui a signé le bon de commande ');

        }elseif (Enregistrement::where('numBon',$req->bon)->exists()) {
            return back()->with('Erreur','le Bon N° '.$req->bon.'existe déjà');
        }else{
            Enregistrement::create([
                'numOrdre'=>($numOrdre+1),
                'dateEnregistrement'=>$req->dateEnregistrement,
                'car_id'=>$req->vehicule,
                'driver'=>$req->conducteur,
                //'driver_id'=>$req->conducteur,
                'km'=>$req->km,
                'numBon'=>$req->bon,
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
        if($req->responsable==NULL){
            return back()->with('Erreur','Veuillez désigner le responsable qui a signé le bon de commande ');

        }elseif (Enregistrement::where('numBon',$req->bon)->where('id','!=',$record->id)->exists()) {
            return back()->with('Erreur','le Bon N° '.$req->bon.' existe déjà');
        }else{
            $record->update([
                'dateEnregistrement'=>$req->dateEnregistrement,
                'car_id'=>$req->vehicule,
                'driver'=>$req->conducteur,
                //'driver_id'=>$req->conducteur,
                'km'=>$req->km,
                'numBon'=>$req->bon,
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
