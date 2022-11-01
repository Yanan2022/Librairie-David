<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CatEntreModel;

class catEntrepriseController extends Controller
{
    public function index()
    {
        return view("categorie.index", ['categ' => DB::table('cat_entre_models')->get()]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'LibCategorie' => 'required',
        ]);
        $input = $request->all();
        CatEntreModel::create($input);
        return redirect()->route('categories.index')
            ->with('success', 'Création effectuée.');
    }


    public function edit(CatEntreModel $category)
    {
        return view("categorie.edit", compact('category'));
    }


    public function update(Request $request, CatEntreModel $category)
    {
        $category->fill($request->all());
        $category->update();

        return redirect()->route("categories.index");
    }


    public function destroy(CatEntreModel $category)
    {
        $category->delete();

        return response()->json([
            "message" => "Catégorie supprimée !",
        ]);
    }
}
