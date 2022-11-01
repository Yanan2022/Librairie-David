<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeColisModel;
use DB;

class TypeColisController extends Controller
{
    //
     //
     public function index()
     {
         return view("typecolis.index",['typecolis' => DB::table('type_colis_models')->get()]);
     }
     public function store(Request $request)
     {
         $request->validate([
             'LibelleType' => 'required',
             
         ]);
         $input = $request->all();
         TypeColisModel::create($input);
         return redirect()->route('TColi.index')
                         ->with('success','Création effectuée.');
 
 
     }
}
