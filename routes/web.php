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
use App\Http\Controllers\HomeController;
use App\Http\Controllers\dashbordController;
use App\Http\Controllers\kitController;
use App\Http\Controllers\PanierkitController;

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
//administrateur
// Route::get('/admin', function () {
//     return view('welcome');
// });
Route::get('/admin', [dashbordController::class, 'index']);
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

//c'est le front
Route::get('/listeEntr/{id}', [listeEntrepController::class, 'show']);
Route::get('/', [catalogueController::class, 'index'])->name('accueil');
Route::get('/fourniture', [catalogueController::class, 'fourniture'])->name('fourniture');
Route::get('/accueil', [HomeController::class, 'index']);
Route::get('/speciale', [HomeController::class, 'commandeSpeciale'])->name('speciale');
Route::post('/searchSpeciale', [HomeController::class, 'searchSpeciale'])->name('searchSpeciale');

Route::post('/upload', [HomeController::class, 'upload'])->name('upload');

Route::get('/cp1', [HomeController::class, 'cp1'])->name('cp1');
Route::get('/cp2', [HomeController::class, 'cp2'])->name('cp2');
Route::get('/ce1', [HomeController::class, 'ce1'])->name('ce1');
Route::get('/ce2', [HomeController::class, 'ce2'])->name('ce2');
Route::get('/cm1', [HomeController::class, 'cm1'])->name('cm1');
Route::get('/cm2', [HomeController::class, 'cm2'])->name('cm2');
Route::get('/6ieme', [HomeController::class, '6ieme'])->name('6ieme');
Route::get('/5ieme', [HomeController::class, '5ieme'])->name('5ieme');
Route::get('/4ieme', [HomeController::class, '4ieme'])->name('4ieme');
Route::get('/3ieme', [HomeController::class, '3ieme'])->name('3ieme');
Route::get('/2nd', [HomeController::class, '2nd'])->name('2nd');
Route::get('/1ere', [HomeController::class, '1ere'])->name('1ere');
Route::get('/tle', [HomeController::class, 'tle'])->name('tle');

Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::resource('articles', articles::class);
Route::resource('kits', kitController::class);
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
Route::get('kit/{kit}/ajout-au-panier', [PanierkitController::class, 'ajouterKit'])->name("panier.ajouter-kit");
Route::get('article/{article}/retirer-du-panier', [PanierController::class, 'retirerArticle'])->name("panier.retirer-article");
Route::get('panier', [PanierController::class, 'index'])->name("panier.index");
Route::get('panier/vider', [PanierController::class, 'vider'])->name("panier.vider");
Route::get('kitcommande/{id}', [PanierkitController::class, 'create'])->name("kitcommande");
Route::post('kitStore', [PanierkitController::class, 'store'])->name("kitStore");



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
