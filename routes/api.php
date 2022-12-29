<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LivraisonController;
use App\Http\Controllers\Api\CateEntrepriseController;
use App\Http\Controllers\Api\EntrepriseController;
use App\Http\Controllers\Api\EntController;
use App\Http\Controllers\Api\CommandeController;
use App\Http\Controllers\Api\CategorieEntrepriseController;
use App\Http\Controllers\Api\TypeArticleController;
use App\Http\Controllers\Api\ArticleController;

use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/CatEntre', [CateEntrepriseController::class, 'index'])->name('api.catent.index');

Route::get('/Entre', [EntrepriseController::class, 'index'])->name('api.entreprise.index');

Route::apiResource('EntreCat', EntController::class);


Route::get('/livraisons', [LivraisonController::class, 'index'])->name('api.livraisons.index');
Route::apiResource('commandes', CommandeController::class);
Route::get('categories-entreprises', [CategorieEntrepriseController::class, 'index']);
Route::get('entreprises', [EntrepriseController::class, 'index']);
Route::get('entreprises/{entreprise}', [EntrepriseController::class, 'show']);
Route::get('types-articles', [TypeArticleController::class, 'index']);
Route::get('articles', [ArticleController::class, 'index']);
Route::get('articles/{article}', [ArticleController::class, 'show']);

//api
Route::post('/upload', [HomeController::class, 'upload']);
Route::get('/test', [ArticleController::class, 'test']);
Route::get('/search', [HomeController::class, 'query_get_search_dynamique']);
