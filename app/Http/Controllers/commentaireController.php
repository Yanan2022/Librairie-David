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

    public function show(Tb_articles $article)
    {
        //return $article;
        return view("front.article.detail", compact('article'));
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


     public function edit(Tb_articles $article)
     {
         return view("articles.edit", compact('article'));
     }


     public function update(Request $request, Tb_articles $article)
     {
         $article->fill($request->all());

         if ($image = $request->file('ImageArticle')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $article->ImageArticle = "$profileImage";
        }
        $article->classe = $request->get('classe');
        $article->idkitscolaire = $request->get('idkitscolaire');
        $article->quantite = $request->get('quantite');
        $article->update();

        return redirect()->route("articles.index");
     }


     public function destroy(Tb_articles $article)
     {
         $article->delete();

         return response()->json([
             "message" => "Article supprimé !",
         ]);
     }
}
