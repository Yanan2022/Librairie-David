<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LivraisonModel;
use Illuminate\Http\Request;

class LivraisonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $livraisons = LivraisonModel::query();
        $livraisons = $livraisons->with(['entreprise', 'article']);
        // Some sorting, paginating and filtering actions here

        return response()->json($livraisons->get());
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
     * @param  \App\Models\LivraisonModel  $livraisonModel
     * @return \Illuminate\Http\Response
     */
    public function show(LivraisonModel $livraisonModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LivraisonModel  $livraisonModel
     * @return \Illuminate\Http\Response
     */
    public function edit(LivraisonModel $livraisonModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LivraisonModel  $livraisonModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LivraisonModel $livraisonModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LivraisonModel  $livraisonModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(LivraisonModel $livraisonModel)
    {
        //
    }
}
