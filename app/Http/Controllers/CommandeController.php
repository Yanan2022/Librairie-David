<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\EntrepriseModel;
use App\Models\Panier;
use App\Http\Requests\StoreCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Session;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commandes = Commande::query();
        $eid = request("entreprise_id") ?? null;
        if($eid !== null) {
            $entreprise = EntrepriseModel::findOrFail($eid);
            $commandes = $commandes->whereHas("articles", function($q) use ($entreprise) {
                return $q->where('entreprise_id', $entreprise->id);
            });
        }
        $commandes = $commandes->with("articles");

        return view("commandes.index", [
            "commandes" => $commandes->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (empty(Session::get('client')['nom'])) {
            # code...
            return redirect('login-client');
        }else{
            $panier = $this->_getPanier($request);
            if($panier->articles->isNotEmpty()) {
                return view("commandes.create", compact('panier'));
            } else {
                return redirect("/");
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommandeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommandeRequest $request)
    {
        $input = $request->validated();
        $panier = $this->_getPanier($request);
        if($panier->articles->isEmpty()) {
            abort(401, "Requête invalide");
        }

        $commande = new Commande($input);
        $commande->uuid = $panier->uuid;
        $commande->save();

        foreach ($panier->articles as $article) {
            $commande->articles()->attach($article->id, [
                'quantite' => $article->pivot->quantite,
                'prix_unitaire' => $article->pivot->prix_unitaire
            ]);
        }

        $panier->delete();

        return view('commandes.merci');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function show(Commande $commande)
    {
        return view("commandes.show", compact('commande'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function edit(Commande $commande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommandeRequest  $request
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommandeRequest $request, Commande $commande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commande $commande)
    {
        $commande->delete();

        return redirect()->route("commandes.index");
    }


    public function valider(Commande $commande)
    {
        $commande->update(["etat" => "Accepté"]);
        return response()->json([
            'redirect' => route("commandes.choose-delivery-mode", $commande),
            'commande' => $commande,
        ]);
    }


    public function choisirLivreur(Request $request, Commande $commande)
    {
        if(!empty($request->type_vehicule_id)) {

            $commande->update(["type_vehicule_id" => $request->type_vehicule_id]);

            return view("commandes.delivery-set", [
                'type_vehicule' => \App\Models\typevehiculeModel::find($request->type_vehicule_id),
                'commande' => $commande,
            ]);
        }

        $types_vehicules = \App\Models\typevehiculeModel::all();
        return view("commandes.mode-livraison", compact('commande', 'types_vehicules'));
    }


    private function _getPanier(Request $request)
    {
        $uuid = $request->cookie('uuid', Str::uuid());
        Cookie::queue('uuid', $uuid, 30 * 24 * 60); // 30 jours (en minutes)
        $panier = Panier::firstOrCreate([
            'uuid' => $uuid,
            'etat' => 'actif',
        ]);

        return $panier;
    }
}
