<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tb_articles;
use Illuminate\Support\Facades\DB;

class articles extends Controller
{
    //
    public function index()
    {
        return view('articles.index', ['articles' => DB::table('tb_articles')->get()]);
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
             'CodeArticle' => 'required',
             'LibelleArticle' => 'required',
             'PrixArticle' => 'required',
             //'EtatArticle' => 'required',
             'ImageArticle' => 'required',
             'StatutArticle' => 'required',
             'IdTypeArticle' => 'required'
         ]);
         $input = $request->all();

         $input = $request->all();
         if ($image = $request->file('ImageArticle')) {
             $destinationPath = 'images/';
             $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
             $image->move($destinationPath, $profileImage);
             $input['ImageArticle'] = "$profileImage";
         }
          /*
         if ($image = $request->file('lientelechargement')) {
             $destinationPath = 'docs/';
             $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
             $image->move($destinationPath, $profileImage);
             $input['lientelechargement'] = "$profileImage";
         }
         */
        Tb_articles::create($input);
         return redirect()->route('articles.index')
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
