<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vehiculeModel;
use DB;

class vehiculeController extends Controller
{
    //

    public function index()
    {
        return view("vehicule.index", ['vehic' => vehiculeModel::with('type')->get()]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'marque' => 'required',
            'couleur' => 'required',
            'capacite' => 'required',
            'numerocarteGrise' => 'required',
            'nomproprietaire' => 'required',
            'nomconducteur' => 'required',
            'idTypeV' => 'required',


        ]);
        $input = $request->all();
        vehiculeModel::create($input);
        return redirect()->route('vehicules.index')
            ->with('success', 'Création effectuée.');
    }


    public function edit(vehiculeModel $vehicule)
    {
        return view("vehicule.edit", compact('vehicule'));
    }


    public function update(Request $request, vehiculeModel $vehicule)
    {
        $vehicule->fill($request->all());
        $vehicule->update();

        return redirect()->route('vehicules.index');
    }


    public function destroy(vehiculeModel $vehicule)
    {
        $vehicule->delete();

        return response()->json([
            "message" => "Véhicule supprimé !",
        ]);
    }
}
