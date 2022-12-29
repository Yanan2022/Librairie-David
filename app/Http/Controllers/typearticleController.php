<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\typearticleModel;
use App\Models\EntrepriseModel;
use App\Models\Tb_articles;

class typearticleController extends Controller
{
    //
    public function index()
    {
        return view("categoriearticle.index", [
            'categart' => typearticleModel::with('type_parent')->get(),
        ]);
    }

    public function show($id)
    {
        $categories = typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get();
        $entreprises = EntrepriseModel::orderBy('LibelleEntreprise')->get();
        $articles = Tb_articles::where('IdTypeArticle', '=', $id)
                                 ->paginate(6);
        return view('front.catalogue.fourniture', compact('articles', 'categories', 'entreprises','id'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'LibCategorieArt' => 'required',
            'type_parent_id' => 'nullable|integer|exists:typearticle_models,id',
        ]);
        $input = $request->all();
        typearticleModel::create($input);
        return redirect()->route('catArts.index')
            ->with('success', 'Création effectuée.');
    }


    public function edit(typearticleModel $catArt)
    {
        return view("categoriearticle.edit", compact('catArt'));
    }


    public function update(Request $request, typearticleModel $catArt)
    {
        $catArt->fill($request->all());
        $catArt->update();

        return redirect()->route("catArts.index");
    }


    public function destroy(typearticleModel $catArt)
    {
        $catArt->delete();

        return response()->json([
            "message" => "Catégoorie supprimée !",
        ]);
    }
}
