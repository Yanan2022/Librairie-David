<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LivraisonModel;
use App\Models\vehiculeModel;
use App\Http\Requests\StoreLivraisonRequest;

class livraisonController extends Controller
{
    //
    public function index()
    {
        return view("livraison.index",['liv' => DB::table('livraison_models')->get()]);
    }


    public function store(StoreLivraisonRequest $request)
    {
        $liv = new LivraisonModel($request->validated());
         if ($image = $request->file('imagecolis')) {
             $destinationPath = 'images/';
             $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
             $image->move($destinationPath, $profileImage);
             $liv->imagecolis = "$profileImage";
         }
         $liv->save();

         return redirect()->route("livs.index");
    }


    public function show(LivraisonModel $liv)
    {
        $vehicules = vehiculeModel::all();
        return view("livraison.show", compact("liv", "vehicules"));
    }


    public function edit(LivraisonModel $liv)
    {
        return view("livraison.edit", compact('liv'));
    }


    public function update(StoreLivraisonRequest $request, LivraisonModel $liv)
    {
        $liv->fill($request->validated());
        if ($image = $request->file('imagecolis')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $liv->imagecolis = "$profileImage";
        }
        $liv->update();

        return redirect()->route('livs.index');
    }


    public function destroy(LivraisonModel $liv)
    {
        $liv->delete();

        return response()->json([
            "message" => "Livraison supprimée !",
        ]);
    }
}
