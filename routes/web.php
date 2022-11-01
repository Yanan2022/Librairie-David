<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

use App\Http\Controllers\articleController;
use App\Http\Controllers\catEntrepriseController;
use App\Http\Controllers\CmdLivController;
use App\Http\Controllers\entrepriseController;
use App\Http\Controllers\coutController;
use App\Http\Controllers\articles;
use App\Http\Controllers\typearticleController;
use App\Http\Controllers\paysController;
use App\Http\Controllers\typevehiculeController;
use App\Http\Controllers\vehiculeController;
use App\Http\Controllers\TypeColisController;
use App\Http\Controllers\livraisonController;
use App\Http\Controllers\listeEntrepController;
use App\Http\Controllers\catalogueController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\CommandeController;

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
    return view('welcome');
});
Route::get('/article', [articles::class, 'index']);

//Route::get('/articles', [articleController::class,'store']);

Route::get('/categorie', [catEntrepriseController::class, 'index']);

Route::get('/cmd', [CmdLivController::class, 'index']);

Route::get('/entreprise', [entrepriseController::class, 'index']);

Route::get('/cout', [coutController::class, 'index']);

Route::get('/catArt', [typearticleController::class, 'index']);

Route::get('/pays', [paysController::class, 'index']);
Route::get('/Tvehicule', [typevehiculeController::class, 'index']);
Route::get('/vehicule', [vehiculeController::class, 'index']);

Route::get('/TColis', [TypeColisController::class, 'index']);
Route::get('/liv', [livraisonController::class, 'index']);
Route::get('/liv/{id}', [livraisonController::class, 'show']);
Route::get('/liv/{id}/edit', [livraisonController::class, 'edit']);
Route::get('/listeEnt', [listeEntrepController::class, 'index']);

Route::get('/listeEntr/{id}', [listeEntrepController::class, 'show']);
Route::get('/catal', [catalogueController::class, 'index']);

Route::resource('articles', articles::class);
Route::resource('categories', catEntrepriseController::class);
Route::resource('entreprises', entrepriseController::class);
Route::resource('catArts', typearticleController::class);
Route::resource('pays', paysController::class);
Route::resource('Tvehicules', typevehiculeController::class);
Route::resource('vehicules', vehiculeController::class);
Route::resource('TColi', TypeColisController::class);
Route::resource('livs', livraisonController::class);
Route::resource('cat', catalogueController::class);
Route::resource('commandes', CommandeController::class);
Route::post("/commandes/{commande}/validate", [CommandeController::class, 'valider'])->name("commandes.validate");
Route::match(['get', 'post'], "/commandes/{commande}/delivery-mode", [CommandeController::class, 'choisirLivreur'])->name("commandes.choose-delivery-mode");

Route::get('article/{article}/ajouter-au-panier', [PanierController::class, 'ajouterArticle'])->name("panier.ajouter-article");
Route::get('article/{article}/retirer-du-panier', [PanierController::class, 'retirerArticle'])->name("panier.retirer-article");
Route::get('panier', [PanierController::class, 'index'])->name("panier.index");
Route::get('panier/vider', [PanierController::class, 'vider'])->name("panier.vider");


