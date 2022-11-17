<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class UserController extends Controller
{
   public function profil(){
       return view('pages.profil');
   }
   public function create(){
       return view('pages.new_user');
    }

    public function register(Request $request){
        $request->validate([
            'login' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ],
            ['email.unique'=>'L\'dresse Email "'.$request->email.'" est déjà utilisée !!']
        );
        if(User::where('email',$request->email)->exists()){
            return back()->with('Erreur','Cette Adresse email existe déjà');
        }else{
            User::create([ 
                'name'=>$request->login,
                'email'=>$request->email,
                'password'=>Hash::make($request->motpasse),
                ]);
            return redirect('/');
        }
        
    }

   public function login(Request $request){
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)) {
            return redirect('home');
        }else{
        return back()->with('Erreur','Votre email ou votre mot de passe est incorrect!!');
        }
    }

    public function logout(){
        Auth::logout();
            return redirect('/');
        
    }
    
    public function update_motPasse(Request $req, User $user){

        if($req->password == $req->passwordconfirmed){
            $user->update([ 
                'password'=>Hash::make($req->password)]);
        }else{
            return back()->with('Erreur','Veuillez bien confirmer votre nouveau mot de passe ');
        }
       
    }
    public function update_profil(Request $req){
        $user=User::where('id',auth()->user()->id)->first();
       $req->validate([
            'login' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
             ]);
            if(User::where('email',$req->email)->where('id','!=',auth()->user()->id)->exists()){
                return back()->with('Erreur','Cette Adresse email existe déjà');
            }else{
                if($req->password != NULL){
                   $user->update(['name'=>$req->login,'email'=>$req->email]);
                   $this->update_motPasse($req, $user);
                }else{
                    $user->update(['name'=>$req->login,'email'=>$req->email]);
                }
                return back()->with('Success', 'Vos informations ont été modifiés avec succès');
            }
    }
}
