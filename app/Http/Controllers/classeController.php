<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classe;
use Illuminate\Support\Facades\DB;

class classeController extends Controller
{
    //
    public function index()
    {
        return view('classes.index', ['classes' => DB::table('classes')->get()]);
    }

    public function show(Tb_articles $article)
    {
        //return $article;
        return view("classes.detail", compact('article'));
    }

     //Enregistrement d'un article
     public function store(Request $request)
     {
         $request->validate([
             'libelle' => 'required',
         ]);

         $input = $request->all();

        Classe::create($input);
         return redirect()->route('classes.index')
                         ->with('success','Création effectuée.');
     }


     public function edit($classe)
     {
        $classe =  Classe::find($classe);
         return view("classes.edit", compact('classe'));
     }


     public function update(Request $request, Classe $classe)
     {
        $classe->fill($request->all());

        $classe->update();

        return redirect()->route("classes.index");
     }


     public function destroy(Classe $classe)
     {
         $classe->delete();

         return response()->json([
             "message" => "Article supprimé !",
         ]);
     }
}
