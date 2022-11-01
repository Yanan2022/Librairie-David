<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CatEntreModel;
use Illuminate\Http\Request;

class CateEntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $CategorieEntreprise =CatEntreModel::query();
        return response()->json($CategorieEntreprise->get());
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
     * @param  \App\Models\CatEntreModel  $catEntreModel
     * @return \Illuminate\Http\Response
     */
    public function show(CatEntreModel $catEntreModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CatEntreModel  $catEntreModel
     * @return \Illuminate\Http\Response
     */
    public function edit(CatEntreModel $catEntreModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CatEntreModel  $catEntreModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CatEntreModel $catEntreModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CatEntreModel  $catEntreModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(CatEntreModel $catEntreModel)
    {
        //
    }
}
