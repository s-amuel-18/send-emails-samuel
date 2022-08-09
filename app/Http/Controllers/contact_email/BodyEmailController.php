<?php

namespace App\Http\Controllers\contact_email;
// namespace App\Http\Controllers;

use App\Models\BodyEmail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BodyEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        // $this->middleware("can:user.index");
        $this->middleware("can:bodyEmail.index")->only("index");
        $this->middleware("can:bodyEmail.create")->only("create", "store");
        $this->middleware("can:bodyEmail.edit")->only("edit", "update");
        $this->middleware("can:bodyEmail.destroy")->only("destroy");
    }

    public function index()
    {
        $bodys = BodyEmail::paginate(10);
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
        $data = request()->validate([
            "nombre" => "required|string|max:255",
            "body" => "required"
        ]);

        BodyEmail::create([
            "user_id" => auth()->user()->id,
            "nombre" => $data["nombre"],
            "body" => $data["body"],
        ]);

        $message = [
            "message" => "El Cuerpo de Email se ha resactado correctamente",
            "color" => "success",
            "icon" => "far fa-check-circle"
        ];

        return redirect()->route("bodyEmail.index")->with("message", $message);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BodyEmail  $bodyEmail
     * @return \Illuminate\Http\Response
     */
    public function edit(BodyEmail $bodyEmail)
    {
        return view("admin.contact_email.body_email.edit", compact("bodyEmail"));
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
        $data = request()->validate([
            "nombre" => "required|string|max:255",
            "body" => "required"
        ]);

        $bodyEmail->nombre = $data["nombre"];
        $bodyEmail->body = $data["body"];

        $bodyEmail->save();

        $message = [
            "message" => "El Cuerpo de Email se ha Actualizado correctamente",
            "color" => "success",
            "icon" => "far fa-check-circle"
        ];

        return redirect()->route("bodyEmail.index")->with("message", $message);
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

        return redirect()->back()->with("message", $message);
    }
}
