<?php

namespace App\Http\Controllers;

use App\Models\EntrepriseModel;
use App\Models\Tb_articles;
use App\Models\typearticleModel;
use Illuminate\Http\Request;

class catalogueController extends Controller
{
    //
    public function index()
    {
        return view('catalogue.index', [
            'categories' => typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get(),
            'entreprises' => EntrepriseModel::orderBy('LibelleEntreprise')->get(),
            'articles' => Tb_articles::with(['type', 'entreprise'])->get(),
        ]);
    }
}
