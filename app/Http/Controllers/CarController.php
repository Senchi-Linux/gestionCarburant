<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Car;
use App\Models\Enregistrement;

class CarController extends Controller
{
    public function create(){
        $vehicules=Car::all();
        return view('pages.vehicule', compact('vehicules'));
    }

    public function add(Request $request){

        if(Car::where('immatriculation',$request->immatricul)->exists()){
            return back()->with('Erreur', 'Un véhicule avec l\'immatriculation "'.$request->immatricul.'" existe déjà !!');

        }else{
            Car::create([
                'designation'=>$request->designation,
                'immatriculation'=>$request->immatricul
            ]);
         return back();
        }
    }

    public function edit(Car $vehicule){
        return view('pages.edit_vehicule', compact('vehicule'));
    }

    public function update(Request $request , Car $vehicule){
        
        if(Car::where('immatriculation',$request->immatricul)->where('id','!=',$vehicule->id)->exists()){
            return back()->with('Erreur', 'Un véhicule avec l\'immatriculation "'.$request->immatricul.'" existe déjà !!');

        }else{
            $vehicule->update([
                'designation'=>$request->designation,
                'immatriculation'=>$request->immatricul
            ]);
         return redirect('vehicules');
        }
    }

    public function delete(Car $vehicule){
         $vehicule->delete();
         return back()->with('SuccessDelete', 'Véhicule supprimé avec succès !!');

    }

    Public function activer(Car $vehicule){
        if($vehicule->etat == 1){
            $vehicule->update([
                'etat'=>0,
            ]);
        }elseif ($vehicule->etat == 0) {
            $vehicule->update([
                'etat'=>1,
            ]);
        }
        return back()->with('SuccessAdd', '');

    }

    public function detail(Car $vehicule){
        $records=Enregistrement::select('*')->orderBy('dateEnregistrement')->where('car_id', $vehicule->id)->get();
        return view('pages.detail_vehicule', compact('vehicule','records'));
    }
}
