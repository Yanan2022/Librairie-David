<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\typearticleModel as TypeArticle;
use App\Models\Tb_articles as Article;

class TypeArticleController extends Controller
{
    public function index()
    {
        $types = TypeArticle::query();
        if(!empty(request("IdEntreprise"))) {
            $articles = Article::select("IdTypeArticle")->where("entreprise_id", request("IdEntreprise"))->get();
            $types = $types->whereIn("id", $articles->pluck("IdTypeArticle"));
        }
        if(!empty(request("IdTypeArticle"))) {
            $types = $types->where("type_parent_id", request("IdTypeArticle"));
        }

        return response()->json($types->get());
    }
}
