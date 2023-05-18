<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tb_articles;
use App\Models\Tb_kitscolaire;
use Illuminate\Support\Facades\DB;

class kitscolaireController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    public function index()
    {
        return view('kitscolaire.index', ['kitscolaire' => DB::table('tb_kitscolaires')->get()]);
    }

    public function show($id)
    {
        $detailkitscolaire = Tb_articles::where('idkitscolaire', $id)->get();
        return view("kitscolaire.show", compact('detailkitscolaire'));
    }

     public function store(Request $request)
     {
         $request->validate([
             'CodeKitscolaire' => 'required',
             'LibelleKitscolaire' => 'required',
             'PrixKitscolaire' => 'required',
             'ImageKitscolaire' => 'required',
             'StatutKitscolaire' => 'required',
             'IdTypeKitscolaire' => 'required',
             'quantite' => 'required'
         ]);
        $input = $request->all();
        $input = $request->all();
        if ($image = $request->file('ImageKitscolaire')) {
             $destinationPath = 'images/';
             $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
             $image->move($destinationPath, $profileImage);
             $input['ImageKitscolaire'] = "$profileImage";
        }
        Tb_kitscolaire::create($input);
         return redirect()->route('kitscolaires.index')
                         ->with('success','Création effectuée.');
     }


     public function edit($id)
     {
        $kitscolaire =  Tb_kitscolaire::find($id);
        return view("kitscolaire.edit", compact('kitscolaire'));
     }
     public function update(Request $request, Tb_kitscolaire $kitscolaire)
     {
        $kitscolaire->fill($request->all());

         if ($image = $request->file('ImageKitscolaire')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $kitscolaire->ImageKitscolaire = "$profileImage";
        }

        $kitscolaire->update();

        return redirect()->route("kitscolaires.index");
     }
     public function destroy(Tb_kitscolaire $kit)
     {
         $kit->delete();
         return response()->json([
             "message" => "Kit scolaire supprimé !",
         ]);
     }
}
