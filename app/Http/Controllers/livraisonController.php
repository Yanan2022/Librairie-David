<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LivraisonModel;
use App\Models\vehiculeModel;
use App\Http\Requests\StoreLivraisonRequest;
use Auth;
use App\Models\Commande;

class livraisonController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    //
    public function index()
    {
        if (Auth::id() == 1) {
            # code...
            $livraisons = LivraisonModel::all();
            return view("livraison.index",compact('livraisons'));
        }else {
            # code...
            $livraisons =  LivraisonModel::where('user_id', '=', Auth::id())->get();
            return view("livraison.index",compact('livraisons'));
        }

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

    public function commandeEmporte($id)
    {
        # code...
        $livraison = LivraisonModel::find($id);
        $livraison->etat = "Emporté";
        $livraison->update();

        $commande = $livraison->commande_id;
        $commande = Commande::find($commande);
        $commande->etat = "Emporté";
        $commande->update();
        return redirect()->route("livs.index");
    }

    public function commandeLivre($id)
    {
        # code...
        $livraison = LivraisonModel::find($id);
        $livraison->etat = "Livré";
        $livraison->update();

        $commande = $livraison->commande_id;
        $commande = Commande::find($commande);
        $commande->etat = "Livré";
        $commande->update();
        return redirect()->route("livs.index");
    }
}
