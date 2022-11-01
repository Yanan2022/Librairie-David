<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\typevehiculeModel;
use DB;

class typevehiculeController extends Controller
{
    //
    public function index()
    {
        return view("typevehicule.index", ['vehicule' => DB::table('typevehicule_models')->get()]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'LibelleType' => 'required',

        ]);
        $input = $request->all();
        typevehiculeModel::create($input);
        return redirect()->route('Tvehicules.index')
            ->with('success', 'Création effectuée.');
    }


    public function edit(typevehiculeModel $Tvehicule)
    {
        return view("typevehicule.edit", compact("Tvehicule"));
    }


    public function update(Request $request, typevehiculeModel $Tvehicule)
    {
        $Tvehicule->fill($request->all());
        $Tvehicule->update();

        return redirect()->route("Tvehicules.index");
    }


    public function destroy(typevehiculeModel $Tvehicule)
    {
        $Tvehicule->delete();

        return response()->json([
            "message" => "Type de véhicule supprimé !",
        ]);
    }
}
