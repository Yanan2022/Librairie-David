<?php

namespace App\Http\Controllers;

use App\Models\EntrepriseModel;
use App\Models\Tb_articles;
use App\Models\Classe;
use App\Models\Encart;
use App\Models\typearticleModel;
use Illuminate\Http\Request;

class catalogueController extends Controller
{
    //
    public function index()
    {
        $produits =Tb_articles::whereIn('id',[3,4,5,6,7])->get();
        $classes = Classe::all();
        $encarts = Encart::all();
        $categories = typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get();
        $entreprises = EntrepriseModel::orderBy('LibelleEntreprise')->get();
         $articles = Tb_articles::with(['type', 'entreprise'])
                                 ->paginate(3);
        return view('front.catalogue.index', compact('produits','articles', 'categories', 'entreprises','classes','encarts'));
    }

    public function fourniture(){
        return view('front.catalogue.fourniture', [
            'categories' => typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get(),
            'entreprises' => EntrepriseModel::orderBy('LibelleEntreprise')->get(),
            'articles' => Tb_articles::with(['type', 'entreprise'])->get(),
        ]);
    }
}
