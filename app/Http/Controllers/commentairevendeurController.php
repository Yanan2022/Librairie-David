<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commentaire;
use App\Models\Commentairevendeur;
use Illuminate\Support\Facades\DB;

class commentairevendeurController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    //
    public function index()
    {
        $CommentaireVendeurs = Commentairevendeur::all();
        return view('commentaire-vendeur.index', compact('CommentaireVendeurs'));
    }

    public function create()
    {
        return view("commentaire-vendeur.create");
    }



     //Enregistrement d'un article
     public function store(Request $request)
     {
         $request->get('description');
         $request->validate([
             'description' => 'required',
         ]);
        $input = $request->all();

        $CommentaireVendeurs = new Commentairevendeur($input);
        $CommentaireVendeurs->save();
        return redirect()->route('commentairevendeurs.index')
                         ->with('success','Création effectuée.');
     }

}
