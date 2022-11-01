<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\typearticleModel as TypeArticle;
use App\Models\Tb_articles as Article;
use App\Models\EntrepriseModel as Entreprise;

class ArticleController extends Controller
{
    public function index()
    {
        // IdEntreprise, IdTypeArticle
        $articles = Article::query();
        $articles = $articles->with(["entreprise", "type"]);
        if(!empty(request("IdEntreprise")))
            $articles = $articles->where("entreprise_id", request("entreprise_id"));
        if(!empty(request("IdTypeArticle")))
            $articles = $articles->where("IdTypeArticle", request("IdTypeArticle"));
        $articles = $articles->latest("created_at")->get()->map(function($article) {
            $article->ImageArticle = asset("images/".$article->ImageArticle);
            $article->IdEntreprise = $article->entreprise_id;
            return $article;
        });

        return response()->json($articles);
    }


    public function show(Article $article)
    {
        $article->ImageArticle = asset("images/".$article->ImageArticle);
        $article->IdEntreprise = $article->entreprise_id;
        return response()->json($article->load(["type", "entreprise"]));
    }
}
