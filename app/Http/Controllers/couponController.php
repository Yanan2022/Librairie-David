<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;


class couponController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    public function index()
    {
        $coupons = Coupon::all();
        return view('coupon.index', compact('coupons'));
    }
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
        $coupon =  Coupon::find($id);
         return view("coupon.edit", compact('coupon'));
     }


     public function update(Request $request, Coupon $coupon)
     {
        $coupon->fill($request->all());
        $coupon->update();
        return redirect()->route("coupons.index");
     }


     public function destroy(Coupon $coupon)
     {
         $coupon->delete();
         return response()->json([
             "message" => "coupon supprimé !",
         ]);
     }
}
