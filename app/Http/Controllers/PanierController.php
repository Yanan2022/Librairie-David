<?php

namespace App\Http\Controllers;

use App\Models\Panier;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Models\Tb_articles;
use App\Models\Tb_kit;
use App\Models\Tb_kitscolaire;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Session;

class PanierController extends Controller
{
    public function index(Request $request)
    {
        $panier = $this->_getPanier($request);
        $produits =Tb_articles::whereIn('id',[3,4,5,6,7])->get();
         //return $panier->total;
        return view("front.panier.panier", compact('panier','produits'));
    }

    public function panierScanner(Request $request)
    {
        $panier = $this->_getPanier($request);
        $produits =Tb_articles::whereIn('id',[3,4,5,6,7])->get();
        return view('front.catalogue.scanner', compact('panier', 'pieces'));
        //return view("front.panier.panier", compact('panier','produits'));
    }

    public function panierkit(Request $request)
    {
        $panier = $this->_getPanier($request);
        $produits =Tb_articles::whereIn('id',[3,4,5,6,7])->get();
        return view("front.panier.panierkit", compact('panier','produits'));
    }


    public function ajouterArticle(Request $request, Tb_articles $article)
    {
        if (empty(Session::get('client')['nom'])) {
            # code...
            return redirect('login-client');
        }else {
            $panier = $this->_getPanier($request);

            $panier->addArticle($article, 1)->refresh();
            Session::put('panier', $panier);

            return redirect()->route("panier.index");
        }
    }

    public function ajouterKit(Request $request,Tb_kitscolaire $kitscolaire)
    {
        //return $kitscolaire;
        $panier = $this->_getPanier($request);

        $panier->addKit($kitscolaire, 1);
        Session::put('panier', $panier);

        return redirect()->route("panier.panierkit");
    }

    public function storeCoupon(Request $request)
    {
        $panier = $this->_getPanier($request);
        //return $panier->getTotalAttribute();
        $code = $request->get('code');
        $coupon = Coupon::where('code', $code)->first();
        if (!$coupon) {
            return redirect()->route('panier.index')->with('status', 'le coupon est invalide');
        }

        $panier = $this->_getPanier($request);
        $total =  $panier->total;
        $request->session()->put('coupon', [
            'code'=>$coupon->code,
            'remise'=>$coupon->discount($total),
        ]);


        return redirect()->route('panier.index')->with('status', 'le coupon est valide');
    }

    public function destroyCoupon()
    {
        # code...
        request()->session()->forget('coupon');
        return redirect()->back();
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
