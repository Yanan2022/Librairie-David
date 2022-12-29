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

    public function test(Request $request)
    {
        return "je suis la";
        // $request->validate([
        //     "image"=>"required|mimes:png,jpg,jpeg|max:10000"
        // ]);


        //     if ($image = $request->get('image')) {
        //         $destinationPath = 'images/';
        //         $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        //         return $fileNameTostore = $image->move($destinationPath, $profileImage);
        //         $input['ImageArticle'] = "$profileImage";
        //     }
        //     $tesseractOcr = new TesseractOCR($fileNameTostore);
        //     $text = $tesseractOcr->run();
        //     $pieces = array();
        //     $pieces = preg_split("/[\\r\\t\\n]+/i", $text);


        //     $resultat = collect();
        //     foreach($pieces as $piece){
        //         $query = $classe;
        //         $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~', '*'];
        //         $piece = str_replace($reservedSymbols, '', $piece);
        //         $piece = implode('+',explode(' ',$piece));
        //         $resultat = $resultat->merge($query->select('*')->selectRaw("MATCH (LibelleArticle) AGAINST (? IN BOOLEAN MODE) AS relevance_score", [$piece])
        //                 ->whereRaw("MATCH (LibelleArticle) AGAINST (? IN BOOLEAN MODE)", $piece)
        //                 ->orderByDesc('relevance_score')->get());
        //     }

        //     $resultat = $resultat->unique('id');

         //return $articles = response()->json($resultat);
    }
}
