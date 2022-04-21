<?php

namespace App\Http\Controllers;

use App\Models\RecomendacionMejora;
use Illuminate\Http\Request;

class RecomendacionMejoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.recomendacion.index");
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
     * @param  \App\Models\RecomendacionMejora  $recomendacionMejora
     * @return \Illuminate\Http\Response
     */
    public function show(RecomendacionMejora $recomendacionMejora)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RecomendacionMejora  $recomendacionMejora
     * @return \Illuminate\Http\Response
     */
    public function edit(RecomendacionMejora $recomendacionMejora)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RecomendacionMejora  $recomendacionMejora
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecomendacionMejora $recomendacionMejora)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RecomendacionMejora  $recomendacionMejora
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecomendacionMejora $recomendacionMejora)
    {
        //
    }
}
