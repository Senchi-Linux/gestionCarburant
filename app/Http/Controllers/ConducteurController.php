<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Conducteur;

class ConducteurController extends Controller
{
    public function create(){
        $conducteurs=Conducteur::all();
        return view('pages.conducteur',compact('conducteurs'));
    }

    public function add(Request $req){
        if(Conducteur::where('cin',$req->cin)->exists()){
            return back()->with('Erreur','Il existe un conducteur avec ce numéro de CIN');
        }else{
            Conducteur::create([
                'nom'=>$req->nom,
                'prenom'=>$req->prenom,
                'cin'=>$req->cin,
                'phone'=>$req->phone
            ]);
            return redirect('conducteurs');

        }
    }

    public function edit(Conducteur $conducteur){
        return view('pages.edit_conducteur', compact('conducteur'));
    }

    public function update(Request $req, Conducteur $conducteur){
        if(Conducteur::where('cin',$req->cin)->where('id','!=', $conducteur->id)->exists()){
            return back()->with('Erreur','Il existe un conducteur avec ce numéro de CIN');

        }else{
            $conducteur->update([
                'nom'=>$req->nom,
                'prenom'=>$req->prenom,
                'cin'=>$req->cin,
                'phone'=>$req->phone
            ]);
            return redirect('conducteurs');
        }
    }

    public function delete(Conducteur $conducteur){
        $conducteur->delete();
        return back()->with('SuccessDelete', 'Conducteur supprimé avec succès !!');

    }
}
