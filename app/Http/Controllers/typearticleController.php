<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\typearticleModel;

class typearticleController extends Controller
{
    //
    public function index()
    {
        return view("categoriearticle.index", [
            'categart' => typearticleModel::with('type_parent')->get(),
        ]);
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
