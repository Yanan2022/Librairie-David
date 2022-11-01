<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EntrepriseModel as Entreprise;
use App\Models\CatEntreModel as Categorie;

class CategorieEntrepriseController extends Controller
{
    public function index()
    {
        $rayon = 5.0; // 5 kilometres
        $entreprises = Entreprise::query();
        $idPays = intval(request("IdPays"));
        $long = request("gps_client_lon");
        $lat = request("gps_client_lat");
        if (empty($idPays) or empty($long) or empty($lat)) {
            return response()->json([
                "message" => "Mauvaise requête",
                "description" => "Tous les paramètres sont requis.",
            ], 400);
        }
        $entreprises = $entreprises->select('Id_Catégorie')
            ->where("Id_pays", $idPays)
            ->whereBetween("lat", [
                $lat - ($rayon / 111.045),
                $lat + ($rayon / 111.045)
            ])
            ->whereBetween("long", [
                $long - ($rayon / (111.045 * cos(deg2rad($lat)))),
                $long + ($rayon / (111.045 * cos(deg2rad($lat))))
            ])
            ->get();

        if(!$entreprises->isEmpty()) {
            $categories = Categorie::whereIn('id', $entreprises->pluck('Id_Catégorie'))->get();
            return response()->json($categories);
        }

        return response()->json([]);
    }
}
