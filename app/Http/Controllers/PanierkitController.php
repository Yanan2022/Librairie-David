<?php

namespace App\Http\Controllers;

use App\Models\Panierkit;
use Illuminate\Http\Request;
use App\Models\Tb_articles;
use App\Models\Tb_kit;
use App\Models\Tb_kitscolaire;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Session;
use App\Models\Commande;

class PanierkitController extends Controller
{
    public function index(Request $request)
    {
        $kitscolaires = Tb_kitscolaire::all();
        return view("front.kit.index", compact('kitscolaires'));
    }

    public function detail($kitscolaire)
    {
        $detailkitscolaires = Tb_articles::where('idkitscolaire', $kitscolaire)->get();
        return view("front.kit.detail", compact('detailkitscolaires'));
    }

    public function panierkit(Request $request)
    {
        $panier = $this->_getPanier($request);
        $produits =Tb_articles::whereIn('id',[3,4,5,6,7])->get();
        return view("front.panier.panierkit", compact('panier','produits'));
    }


    public function ajouterKit(Request $request, Tb_kitscolaire $kitscolaire)
    {
        $panier = $this->_getPanier($request);

        $panier->addKit($kitscolaire, 1);

        return redirect()->route("panier.panierkit");
    }

    public function create(Request $request, $id)
    {
        $article =  Tb_kit::find($id);
        $PrixKit =  $article->PrixKit;
        return view("front.kit.create", compact('id', 'PrixKit'));
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
        $commande->save();

        return view('commandes.merci');
    }


    public function retirerKit(Request $request, Tb_kitscolaire $kitscolaire)
    {
        $panier = $this->_getPanier($request);
        $qte = intval($request->get("qte")) ?? 1;

        $panier->removeKit($kitscolaire, $qte)->refresh();

        return redirect()->route("panier.panierkit");
    }


    public function viderkit(Request $request)
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
        $panier = Panierkit::firstOrCreate([
            'uuid' => $uuid,
            'etat' => 'actif',
        ]);

        return $panier;
    }
}
