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
use App\Http\Controllers\classeController;
use App\Http\Controllers\encartController;
use App\Http\Controllers\banniereController;
use App\Http\Controllers\SuivicommandeController;
use App\Http\Controllers\kitscolaireController;
use App\Http\Controllers\livreurController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\codepromoController;
use App\Http\Controllers\commentaireController;
use App\Http\Controllers\couponController;
use App\Http\Controllers\VendeurController;
use App\Http\Controllers\commentairevendeurController;
use App\Http\Controllers\kitecoleController;
use App\Http\Controllers\EcoleController;

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

//Historique des commandes
Route::get('/historique-vendeur', [VendeurController::class, 'historique_vendeur'])->name('historique-vendeur');
Route::get('/commande-emportee/{id}', [VendeurController::class, 'commande_emportee'])->name('commande-emportee');
Route::get('/commande-livree', [VendeurController::class, 'commande_livree'])->name('commande-livree');

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
Route::get('/commandeEmporte/{id}', [livraisonController::class, 'commandeEmporte'])->name('commandeEmporte');
Route::get('/commandeLivre/{id}', [livraisonController::class, 'commandeLivre'])->name('commandeLivre');
Route::get('/liv/{id}', [livraisonController::class, 'show']);
Route::get('/liv/{id}/edit', [livraisonController::class, 'edit']);
Route::get('/listeEnt', [listeEntrepController::class, 'index']);

//c'est le front
Route::get('/listeEntr/{id}', [listeEntrepController::class, 'show']);
Route::get('/', [catalogueController::class, 'index'])->name('accueil');
Route::get('/detailCategories/{id}', [catalogueController::class, 'show'])->name('detailCategories');
Route::get('/fourniture', [catalogueController::class, 'fourniture'])->name('fourniture');
Route::get('/accueil', [HomeController::class, 'index']);
Route::get('/signup', [HomeController::class, 'signup'])->name('signup');
Route::get('/logout-client', [HomeController::class, 'logoutClient'])->name('logout-client');
Route::post('/acceder_compte', [HomeController::class, 'acceder_compte'])->name('acceder_compte');
Route::get('/login-client', [HomeController::class, 'login'])->name('login-client');
Route::post('/creerCompte', [HomeController::class, 'creerCompte'])->name('creerCompte');
Route::get('/speciale', [HomeController::class, 'commandeSpeciale'])->name('speciale');
Route::post('/searchSpeciale', [HomeController::class, 'searchSpeciale'])->name('searchSpeciale');
Route::post('/get-results', [HomeController::class, 'typeaheadSearch'])->name('get-results');
//Route::get('/get-results', 'HomeController@typeaheadSearch')->name('get-results');
Route::post('/upload', [HomeController::class, 'upload'])->name('upload');
Route::get('/listeCommande', [SuivicommandeController::class, 'listeCommande'])->name('listeCommande');
Route::get('/historiqueCommande', [SuivicommandeController::class, 'historiqueCommande'])->name('historiqueCommande');
Route::get('/annulerCommande/{id}', [SuivicommandeController::class, 'annulerCommande'])->name('annulerCommande');
Route::post('/storeCommentaire', [SuivicommandeController::class, 'storeCommentaire'])->name('storeCommentaire');
Route::get('/createCommentaire', [SuivicommandeController::class, 'createCommentaire'])->name('createCommentaire');
Route::get('/detailCommande/{commande}', [SuivicommandeController::class, 'detailCommande'])->name('detailCommande');
Route::get('/voir_pdf/{id}', [PdfController::class, 'voir_pdf'])->name('voir_pdf');
Route::get('/pdfs', [PdfController::class, 'index'])->name('index');
Route::resource('ecoles', EcoleController::class);

Route::get('/ps', [HomeController::class, 'ps'])->name('ps');
Route::get('/ms', [HomeController::class, 'ms'])->name('ms');
Route::get('/gs', [HomeController::class, 'gs'])->name('gs');
Route::get('/cp1', [HomeController::class, 'cp1'])->name('cp1');
Route::get('/cp2', [HomeController::class, 'cp2'])->name('cp2');
Route::get('/ce1', [HomeController::class, 'ce1'])->name('ce1');
Route::get('/ce2', [HomeController::class, 'ce2'])->name('ce2');
Route::get('/cm1', [HomeController::class, 'cm1'])->name('cm1');
Route::get('/cm2', [HomeController::class, 'cm2'])->name('cm2');
Route::get('/6ieme', [HomeController::class, 'sixieme'])->name('sixieme');
Route::get('/5ieme', [HomeController::class, 'cinquieme'])->name('cinquieme');
Route::get('/4ieme', [HomeController::class, 'quatrieme'])->name('quatrieme');
Route::get('/3ieme', [HomeController::class, 'troisieme'])->name('troisieme');
Route::get('/2nde', [HomeController::class, 'seconde'])->name('seconde');
Route::get('/1ere', [HomeController::class, 'premiere'])->name('premiere');
Route::get('/tle', [HomeController::class, 'terminal'])->name('terminal');

Route::get('/search', [HomeController::class, 'search'])->name('search');
// Ajoutez cette route dans votre fichier de routes web.php
Route::get('/autocomplete', 'HomeController@autocomplete')->name('autocomplete');


Route::resource('articles', articles::class);
Route::resource('commentaires', commentaireController::class);
Route::resource('commentairevendeurs', commentairevendeurController::class);
Route::resource('coupons', couponController::class);
Route::resource('codepromos', couponController::class);
//la liste des vendeurs
Route::resource('vendeurs', VendeurController::class);
Route::resource('livreurs', livreurController::class);
Route::resource('bannieres', banniereController::class);
Route::resource('encarts', encartController::class);
Route::resource('classes', classeController::class);
Route::resource('kits', kitController::class);
Route::resource('kitscolaires', kitscolaireController::class); //les kits scolaires
Route::resource('kitecoles', kitecoleController::class); //les kits école
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
Route::get("/commandes-annuler/{id}", [CommandeController::class, 'annuler'])->name("commandes.annuler");

Route::get('article/{article}/ajouter-au-panier', [PanierController::class, 'ajouterArticle'])->name("panier.ajouter-article");

Route::get('kitscolaire/{kitscolaire}/ajout-au-panier', [PanierkitController::class, 'ajouterKit'])->name("panier.ajouter-kit");
Route::get('kitscolaire/{kitscolaire}/retire-du-panier', [PanierkitController::class, 'retirerKit'])->name("panier.retirer-kit");
Route::get('panier/viderkit', [PanierkitController::class, 'vider'])->name("panier.viderkit");
Route::get('kits', [PanierkitController::class, 'index'])->name("kits.index");
Route::get('detail/{kitscolaire}', [PanierkitController::class, 'detail'])->name("kitscolaire.detail");

Route::get('article/{article}/retirer-du-panier', [PanierController::class, 'retirerArticle'])->name("panier.retirer-article");
Route::get('panier', [PanierController::class, 'index'])->name("panier.index");
Route::post('coupon', [PanierController::class, 'storeCoupon'])->name("panier.store.coupon"); //coupon
Route::delete('coupon', [PanierController::class, 'destroyCoupon'])->name("panier.destroy.coupon"); //coupon
Route::get('panierScanner', [PanierController::class, 'panierScanner'])->name("panier.scanner");
Route::get('panierkit', [PanierkitController::class, 'panierkit'])->name("panier.panierkit");
Route::get('panier/vider', [PanierController::class, 'vider'])->name("panier.vider");

Route::get('kitcommande/{id}', [PanierkitController::class, 'create'])->name("kitcommande");
Route::post('kitStore', [PanierkitController::class, 'store'])->name("kitStore");



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

