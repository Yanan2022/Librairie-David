<?php

namespace App\Http\Controllers;

use App\Models\Panier;
use Illuminate\Http\Request;
use App\Models\Tb_articles;
use App\Models\Tb_kit;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Session;
use App\Models\Commande;

class PanierkitController extends Controller
{
    public function index(Request $request)
    {
        $panier = $this->_getPanier($request);

        return view("front.panier.panier", compact('panier'));
    }


    public function ajouterKit(Request $request, $idKit)
    {
        $articles = Tb_articles::where('idKit','=', $idKit)->get();
        // $prixTotal = $panier->sum('PrixArticle');
        // return view("front.kit.panier", compact('panier','prixTotal', 'idKit'));


        foreach($articles as $article){
             $panier = $this->_getPanier($request);
             $panier->addArticle($article, 1)->refresh();
        }

        return redirect()->route("panier.index");

        // $panier = $this->_getPanier($request);
        // return $panier->addKit($kit, 1)->refresh();
        // Session::put('panier', $panier);
    }

    public function create(Request $request, $id)
    {
        $article =  Tb_kit::find($id);
        $PrixKit =  $article->PrixKit;
        return view("front.kit.create", compact('id', 'PrixKit'));
        // $panier = $this->_getPanier($request);

        // if($panier->articles->isNotEmpty()) {
        //     return view("commandes.create", compact('panier'));
        // } else {
        //     return redirect("/");
        // }
    }

    public function store(Request $request)
    {
        $commande = new Commande();
        $commande->uuid = $request->get('uuid');
        $commande->nom = $request->get('nom');
        $commande->prenoms = $request->get('prenoms');
        $commande->telephone = $request->get('telephone');
        $commande->email = $request->get('email');
        $commande->ville = $request->get('ville');
        $commande->commune = $request->get('commune');
        $commande->quartier = $request->get('quartier');
        //$commande->adresse = $request->get('adresse');
        $commande->save();

        //return $commande;
        // return "ok";
        // $input = $request->validated();
        // $panier = $this->_getPanier($request);
        // if($panier->articles->isEmpty()) {
        //     abort(401, "Requête invalide");
        // }

        // $commande = new Commande($input);
        // $commande->uuid = $panier->uuid;
        // $commande->save();

        // foreach ($panier->articles as $article) {
        //     $commande->articles()->attach($article->id, [
        //         'quantite' => $article->pivot->quantite,
        //         'prix_unitaire' => $article->pivot->prix_unitaire
        //     ]);
        // }

        // $panier->delete();

        return view('commandes.merci');
    }


    public function retirerArticle(Request $request, Tb_articles $article)
    {
        $panier = $this->_getPanier($request);
        $qte = intval($request->get("qte")) ?? 1;

        $panier->removeArticle($article, $qte)->refresh();

        return redirect()->route("panier.index");
    }


    public function vider(Request $request)
    {
        $panier = $this->_getPanier($request);

        $panier->articles()->detach();
        $panier->refresh();

        return redirect()->route("panier.index");
    }


    private function _getPanier(Request $request)
    {
        $uuid = $request->cookie('uuid', Str::uuid());
        Cookie::queue('uuid', $uuid, 30*24*60); // 30 jours (en minutes)
        $panier = Panier::firstOrCreate([
            'uuid' => $uuid,
            'etat' => 'actif',
        ]);

        return $panier;
    }
}
