<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tb_articles;
use App\Models\Tb_kit;
use Illuminate\Support\Facades\DB;

class kitController extends Controller
{
    //
    public function index()
    {
        return view('kits.index', ['kits' => DB::table('tb_kits')->get()]);
    }

    public function show(Tb_articles $article)
    {
        //return $article;
        return view("front.article.detail", compact('article'));
    }

     //Enregistrement d'un article
     public function store(Request $request)
     {
        //return $codeKit = $request->get('CodeKit');
         $request->validate([
             'CodeKit' => 'required',
             'LibelleKit' => 'required',
             'PrixKit' => 'required',
             //'EtatArticle' => 'required',
             'ImageKit' => 'required',
             'StatutKit' => 'required',
             'IdTypeKit' => 'required'
         ]);
         $input = $request->all();

         $input = $request->all();
         if ($image = $request->file('ImageKit')) {
             $destinationPath = 'images/';
             $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
             $image->move($destinationPath, $profileImage);
             $input['ImageKit'] = "$profileImage";
         }

        Tb_kit::create($input);
         return redirect()->route('kits.index')
                         ->with('success','Création effectuée.');
     }


     public function edit(Tb_kit $kit)
     {
         return view("kits.edit", compact('kit'));
     }


     public function update(Request $request, Tb_kit $kit)
     {
         $kit->fill($request->all());

         if ($image = $request->file('ImageKit')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $kit->Imagekit = "$profileImage";
        }

        $kit->update();

        return redirect()->route("kits.index");
     }


     public function destroy(Tb_kit $kit)
     {
         $article->delete();

         return response()->json([
             "message" => "Article supprimé !",
         ]);
     }
}
