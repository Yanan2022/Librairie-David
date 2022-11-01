<?php

namespace App\Http\Controllers;

use App\Models\Panier;
use Illuminate\Http\Request;
use App\Models\Tb_articles;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class PanierController extends Controller
{
    public function index(Request $request)
    {
        $panier = $this->_getPanier($request);

        return view("panier", compact('panier'));
    }


    public function ajouterArticle(Request $request, Tb_articles $article)
    {
        $panier = $this->_getPanier($request);

        $panier->addArticle($article, 1)->refresh();

        return redirect()->route("panier.index");
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
