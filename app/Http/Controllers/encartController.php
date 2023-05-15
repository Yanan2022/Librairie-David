<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encart;
use Illuminate\Support\Facades\DB;

class encartController extends Controller
{
    //
    public function index()
    {
        return view('encart.index', ['encarts' => DB::table('encarts')->get()]);
    }

     public function store(Request $request)
     {
         $request->validate([
             'libelle' => 'required',
             'image' => 'required',
         ]);
         $input = $request->all();

         if ($image = $request->file('image')) {
             $destinationPath = 'images/';
             $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
             $image->move($destinationPath, $profileImage);
             $input['image'] = "$profileImage";
         }
         
        Encart::create($input);
         return redirect()->route('encarts.index')
                         ->with('success','Création effectuée.');
     }


     public function edit(Encart $encart)
     {
         return view("encart.edit", compact('encart'));
     }


     public function update(Request $request, Encart $encart)
     {
         $encart->fill($request->all());

         if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $encart->image = "$profileImage";
        }

        $encart->update();

        return redirect()->route("encarts.index");
     }


     public function destroy(Encart $encart)
     {
         $encart->delete();

         return response()->json([
             "message" => "Article supprimé !",
         ]);
     }
}
