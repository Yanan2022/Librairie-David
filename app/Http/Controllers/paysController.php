<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\paysModel;
use DB;

class paysController extends Controller
{
    //
    public function index()
    {
        return view("pays.index", ['pays' => DB::table('pays_models')->get()]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'NomPays' => 'required',
            'IconPays' => 'required',
            'DevisePays' => 'required',

        ]);
        $input = $request->all();
        paysModel::create($input);
        return redirect()->route('pays.index')
            ->with('success', 'Création effectuée.');
    }


    public function edit(paysModel $pay)
    {
        return view("pays.edit", compact('pay'));
    }


    public function update(Request $request, paysModel $pay)
    {
        $pay->fill($request->all());
        $pay->update();

        return redirect()->route("pays.index");
    }


    public function destroy(paysModel $pay)
    {
        $pay->delete();

        return response()->json([
            "message" => "Pays supprimé !",
        ]);
    }
}
