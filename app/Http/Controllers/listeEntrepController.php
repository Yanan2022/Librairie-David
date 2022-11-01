<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\EntrepriseModel;

class listeEntrepController extends Controller
{
    //
    public function index()
    {
        $entreprise = Http::get('https://jsonplaceholder.typicode.com/users')
        ->json();
       /* $entreprises = Http::get('http://127.0.0.1:8000/api/Entre')
        ->json();*/
        dump($entreprise);
        return view('entreprise.indexliste');
    }


    //afficher les entreprises par 
    public function show()
    {
      
    }
}
