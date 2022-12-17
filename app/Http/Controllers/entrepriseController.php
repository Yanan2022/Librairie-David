<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntrepriseModel;
use Illuminate\Support\Facades\DB;

class entrepriseController extends Controller
{
    //
    public function index()
    {
        return view("entreprise.index",['ent' => DB::table('entreprise_models')->get()]);
    }

    public function store (Request $request)
    {
        $request->validate([

            'CodeEntreprise'=> 'required',
            'LibelleEntreprise'=> 'required',
            'ContactEntreprise'=> 'required',
            'AdresseEntreprise' => 'required',
            'MailEntreprise'=> 'required',
            'SiteEntreprise'=> 'required',
            'long'=> 'required',
            'lat'=> 'required',
            'Id_Catégorie'=> 'required',
            'Id_pays'=> 'required'

        ]);
        $input = $request->all();
        EntrepriseModel::create($input);
        return redirect()->route('entreprises.index')
                        ->with('success','Création effectuée.');

    }


    public function edit(EntrepriseModel $entreprise)
    {
        return view("entreprise.edit", compact('entreprise'));
    }


    public function update(Request $request, EntrepriseModel $entreprise)
    {
        $entreprise->fill($request->all());
        $entreprise->update();

        return redirect()->route("entreprises.index");
    }


    public function destroy(EntrepriseModel $entreprise)
    {
        $entreprise->delete();

        return response()->json([
            "message" => "Entreprise supprimée !",
        ]);
    }
}
