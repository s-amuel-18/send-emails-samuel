<?php

namespace App\Http\Controllers;

use App\Models\Spents;
use Illuminate\Http\Request;

class SpentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Spents  $spents
     * @return \Illuminate\Http\Response
     */
    public function show(Spents $spents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spents  $spents
     * @return \Illuminate\Http\Response
     */
    public function edit(Spents $spents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spents  $spents
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spents $spents)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spents  $spents
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spents $spent)
    {
        $spent->delete();

        $message = [
            "message" => "El Gasto <b>{$spent->name}</b> Se ha eliminado correctamente.",
            "color" => "success",
            "icon" => "far fa-check-circle"
        ];

        return redirect()->back()->with("message", $message);
    }
}
