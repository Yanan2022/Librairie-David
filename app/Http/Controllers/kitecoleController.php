<?php

namespace App\Http\Controllers;

use App\Models\Ecole;
use Illuminate\Http\Request;
use App\Models\Tb_articles;
use App\Models\Tb_kitscolaire;
use Illuminate\Support\Facades\DB;

class kitecoleController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    public function index()
    {
        return view('ecoles.index', ['ecoles' => DB::table('ecoles')->get()]);
    }

    public function show($id)
    {
        $detailkitscolaire = Tb_articles::where('idkitscolaire', $id)->get();
        return view("kitscolaire.show", compact('detailkitscolaire'));
    }

     public function store(Request $request)
     {
         $request->validate([
             'code' => 'required',
             'libelle' => 'required',
             'image' => 'required',
         ]);
        $input = $request->all();
        // $input = $request->all();
        if ($image = $request->file('image')) {
             $destinationPath = 'images/';
             $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
             $image->move($destinationPath, $profileImage);
             $input['image'] = "$profileImage";
        }
        Ecole::create($input);
         return redirect()->route('kitecoles.index')
                         ->with('success','Création effectuée.');
     }


     public function edit($id)
     {
        $ecole =  Ecole::find($id);
        return view("ecoles.edit", compact('ecole'));
     }
     public function update(Request $request,  $ecole)
     {
        $ecole =  Ecole::find($ecole);
        $ecole->fill($request->all());

         if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $ecole->image = "$profileImage";
        }
        $ecole->update();
        return redirect()->route("kitecoles.index");
     }
     public function destroy(Tb_kitscolaire $kit)
     {
         $kit->delete();
         return response()->json([
             "message" => "Kit scolaire supprimé !",
         ]);
     }
}
