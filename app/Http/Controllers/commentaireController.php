<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commentaire;
use Illuminate\Support\Facades\DB;

class commentaireController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    //
    public function index()
    {
        $Commentaires = Commentaire::all();
        return view('commentaire.index', compact('Commentaires'));
    }

    public function create()
    {
        return view("commentaire.create");
    }



     //Enregistrement d'un article
     public function store(Request $request)
     {
         $request->validate([
             'description' => 'required',
         ]);
         $input = $request->all();

        $article = new Commentaire($input);
        $article->save();
        return redirect()->route('accueil')
                         ->with('success','Création effectuée.');
     }

}
