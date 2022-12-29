<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banniere;
use Illuminate\Support\Facades\DB;

class banniereController extends Controller
{
    //
    public function index()
    {
        return view('banniere.index', ['bannieres' => DB::table('bannieres')->get()]);
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
             'libelle' => 'required',
             'image' => 'required',
         ]);
         $input = $request->all();

         if ($image = $request->file('image')) {
             $destinationPath = 'images/';
             $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
             $image->move($destinationPath, $profileImage);
             $input['image'] = "$profileImage";
         }
          /*
         if ($image = $request->file('lientelechargement')) {
             $destinationPath = 'docs/';
             $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
             $image->move($destinationPath, $profileImage);
             $input['lientelechargement'] = "$profileImage";
         }
         */
        Banniere::create($input);
         return redirect()->route('bannieres.index')
                         ->with('success','Création effectuée.');
     }


     public function edit(Banniere $banniere)
     {
         return view("banniere.edit", compact('banniere'));
     }


     public function update(Request $request, Banniere $banniere)
     {
         $banniere->fill($request->all());

         if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $banniere->image = "$profileImage";
        }

        $banniere->update();

        return redirect()->route("bannieres.index");
     }


     public function destroy(Banniere $banniere)
     {
         $banniere->delete();

         return response()->json([
             "message" => "Article supprimé !",
         ]);
     }
}
