<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\CarController;
use App\Http\Controllers\ConducteurController;
use App\Http\Controllers\EnregistrementController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('ajouteruser',[UserController::class,'create'])->name('app_new_user');
Route::post('newuser',[UserController::class,'register'])->name('app_add_user');
Route::post('identification',[UserController::class,'login'])->name('app_login_user');

Route::middleware('auth')->group(function() {

Route::get('deconnecter_utilisateur',[UserController::class,'logout'])->name('app_logout_user');
Route::post('mettre_a_jour_profil_utilisateur',[UserController::class, 'update_profil'])->name('app_update_user');


Route::get('home',[StatistiqueController::class,'create'])->name('app_home_page');


Route::get('vehicules',[CarController::class,'create'])->name('app_page_vehicule');
Route::post('ajouter_vehicule',[CarController::class,'add'])->name('app_add_car');
Route::get('vehicule_page/{vehicule}',[CarController::class,'edit'])->name('app_edit_car');
Route::post('mise_a_jour_vehicule/{vehicule}',[CarController::class,'update'])->name('app_update_car');
Route::delete('supprimer_vehicule/{vehicule}',[CarController::class,'delete'])->name('app_delete_car');
Route::put('activation_vehicule/{vehicule}',[CarController::class,'activer'])->name('app_activer_car');
Route::get('details_vehicule/{vehicule}',[CarController::class,'detail'])->name('app_detail_car');


Route::get('conducteurs',[ConducteurController::class, 'create'])->name('app_page_conducteur');
Route::post('nouveau_conducteur',[ConducteurController::class, 'add'])->name('app_add_driver');
Route::get('conducteur_page/{conducteur}',[ConducteurController::class,'edit'])->name('app_edit_driver');
Route::post('mise_a_jour_conducteur/{conducteur}',[ConducteurController::class,'update'])->name('app_update_driver');
Route::delete('supprimer_conducteur/{conducteur}',[ConducteurController::class,'delete'])->name('app_delete_driver');


Route::get('nouveau_enregistrement',[EnregistrementController::class,'create'])->name('app_page_new_record');
Route::post('ajouter_nouveau_enregistrement',[EnregistrementController::class,'add'])->name('app_add_new_record');
Route::get('enregistrement/{record}',[EnregistrementController::class,'edit'])->name('app_edit_record');
Route::post('mise_a_jour_enregistrement/{record}',[EnregistrementController::class,'update'])->name('app_update_record');
Route::delete('supprimer_enregistrement/{record}',[EnregistrementController::class,'delete'])->name('app_delete_record');


Route::get('statics_mensuel',[StatistiqueController::class,'getConsByMonthOfCar'])->name('app_consommation_month_car');
Route::get('statics_mensuel_all_cars',[StatistiqueController::class,'getConsByMonthOfAllCars'])->name('app_consommation_month_all_cars');
Route::get('statics_annuel_all_cars',[StatistiqueController::class,'getConsByYearOfAllCars'])->name('app_consommation_year_all_cars');
Route::get('statistiques_comparaison_comsommation_des_vehicules',[StatistiqueController::class,'createC'])->name('app_comparateur_consommation_vehicules');
Route::get('statics_comparateur_cosommation_mensuel_cars',[StatistiqueController::class,'getConsoOfCarsInMonth'])->name('app_consommation_cars_mois');
Route::get('statics_comparateur_cosommation_annuel_cars',[StatistiqueController::class,'getConsoOfCarsInYear'])->name('app_consommation_cars_an');


Route::get('profil',[UserController::class,'profil'])->name('app_profil_page');
});