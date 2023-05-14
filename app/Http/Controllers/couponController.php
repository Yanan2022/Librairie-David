<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class couponController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    //
    public function index()
    {
        $coupons = Coupon::all();
        return view('coupon.index', compact('coupons'));
    }

    public function show(Codepromo $article)
    {
        //return $article;
        return view("front.article.detail", compact('article'));
    }

     //Enregistrement d'un article
     public function store(Request $request)
     {
         $request->validate([
             'code' => 'required',
             'percent_off' => 'required',
             'date_debut' => 'required',
             'date_fin' => 'required',
         ]);
         $input = $request->all();

         $coupon = new Coupon($input);
         $coupon->date_debut = $request->get('date_debut');
         $coupon->date_fin = $request->get('date_fin');
         $coupon->save();
         return redirect()->route('coupons.index')
                         ->with('success','Création effectuée.');
     }


     public function edit($id)
     {
        $livreur =  User::find($id);
         return view("codepromo.edit", compact('livreur'));
     }


     public function update(Request $request, Codepromo $livreur)
     {
         $livreur->fill($request->all());


        $livreur->update();

        return redirect()->route("livreurs.index");
     }


     public function destroy(Coupon $coupon)
     {
         $livreur->delete();

         return response()->json([
             "message" => "Article supprimé !",
         ]);
     }
}
