<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
//use App\Models\Tb_articles;
use App\Models\articles;

class articleController extends Controller
{
    //
    public function index()
    {
        return view('articles.index', ['articles' => DB::table('tb_articles')->get()]);
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
  /*
        $input = $request->all();
        if ($image = $request->file('vignette')) {
            $destinationPath = 'vignettedocs/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['vignette'] = "$profileImage";
        }
        if ($image = $request->file('lientelechargement')) {
            $destinationPath = 'docs/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['lientelechargement'] = "$profileImage";
        }
        */
        articles::create($input);
        return redirect()->route('articles.index')
                        ->with('success','Création effectuée.');
    }
}
