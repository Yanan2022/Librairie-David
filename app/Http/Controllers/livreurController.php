<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tb_articles;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class livreurController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    //
    public function index()
    {
        return view('livreur.index', ['livreurs' => DB::table('users')->get()]);
    }

    public function show(Tb_articles $article)
    {
        //return $article;
        return view("front.article.detail", compact('article'));
    }

     //Enregistrement d'un article
     public function store(Request $request)
     {
         $request->validate([
             'nom' => 'required',
             'prenom' => 'required',
             'contact' => 'required',
             //'EtatArticle' => 'required',
             'photo' => 'required',
             'email' => 'required',
         ]);
         $input = $request->all();

         $input = $request->all();
         if ($image = $request->file('photo')) {
             $destinationPath = 'images/';
             $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
             $image->move($destinationPath, $profileImage);
             $photo = $input['ImageArticle'] = "$profileImage";
         }

         $livreur = new User;
         $livreur->nom = $request->nom;
         $livreur->prenom = $request->prenom;
         $livreur->contact = $request->contact;
         $livreur->photo = $photo;
         $livreur->email = $request->email;
         $livreur->password = Hash::make(12345678);
         $livreur->role_id = 1;
         $livreur->save();
         return redirect()->route('livreurs.index')
                         ->with('success','Création effectuée.');
     }


     public function edit($id)
     {
        $livreur =  User::find($id);
         return view("livreur.edit", compact('livreur'));
     }


     public function update(Request $request, User $livreur)
     {
         $livreur->fill($request->all());

         if ($image = $request->file('photo')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $livreur->photo = "$profileImage";
        }

        $livreur->update();

        return redirect()->route("livreurs.index");
     }


     public function destroy(User $livreur)
     {
         $livreur->delete();

         return response()->json([
             "message" => "Article supprimé !",
         ]);
     }
}
