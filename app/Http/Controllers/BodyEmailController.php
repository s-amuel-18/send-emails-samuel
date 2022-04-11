<?php

namespace App\Http\Controllers;

use App\Models\BodyEmail;
use Illuminate\Http\Request;

class BodyEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bodys = BodyEmail::get();
        // dd($bodys);
        // dd($bodys);
        return view("admin.contact_email.body_email.index", compact("bodys"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.contact_email.body_email.create");
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
     * @param  \App\Models\BodyEmail  $bodyEmail
     * @return \Illuminate\Http\Response
     */
    public function show(BodyEmail $bodyEmail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BodyEmail  $bodyEmail
     * @return \Illuminate\Http\Response
     */
    public function edit(BodyEmail $bodyEmail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BodyEmail  $bodyEmail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BodyEmail $bodyEmail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BodyEmail  $bodyEmail
     * @return \Illuminate\Http\Response
     */
    public function destroy(BodyEmail $bodyEmail)
    {

        $bodyEmail->delete();

        $message = [
            "message" => "El cuerpo de email Se ha eliminado correctamente.",
            "color" => "success",
            "icon" => "far fa-check-circle"
        ];

        return redirect()->back()->with("message", $message );

    }
}
