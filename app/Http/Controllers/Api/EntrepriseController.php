<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EntrepriseModel as Entreprise;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entreprises = Entreprise::query();
        if(!empty(request("IdCatégorie")))
            $entreprises = $entreprises->where('Id_Catégorie', request("IdCatégorie"));
        if(!empty(request("IdPays")))
            $entreprises = $entreprises->where('Id_pays', request("IdPays"));
        $long = request("gps_client_lon");
        $lat = request("gps_client_lat");
        $rayon = 5.0; // 5 kilometres
        if(!empty($long) && !empty($lat)) {
            $entreprises = $entreprises->whereBetween("lat", [
                $lat - ($rayon / 111.045),
                $lat + ($rayon / 111.045)
            ])
            ->whereBetween("long", [
                $long - ($rayon / (111.045 * cos(deg2rad($lat)))),
                $long + ($rayon / (111.045 * cos(deg2rad($lat))))
            ]);
        }

        $entreprises = $entreprises->with(['pays', 'categorie']);
        return response()->json($entreprises->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EntrepriseModel  $entrepriseModel
     * @return \Illuminate\Http\Response
     */
    public function show(Entreprise $entreprise)
    {
       return response()->json($entreprise->load(["pays", "categorie"]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EntrepriseModel  $entrepriseModel
     * @return \Illuminate\Http\Response
     */
    public function edit(Entreprise $entrepriseModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EntrepriseModel  $entrepriseModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entreprise $entrepriseModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EntrepriseModel  $entrepriseModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entreprise $entrepriseModel)
    {
        //
    }
}
