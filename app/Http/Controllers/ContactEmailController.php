<?php

namespace App\Http\Controllers;

// use datatables;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Contact_email;

class ContactEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails = Contact_email::orderBy("created_at", "DESC")->get();

        return view("admin.contact_email.index", compact("emails"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.contact_email.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $ar_valid = [

        // ]

        $data = request()->validate([
            'nombre_empresa' => "nullable|string|max:255",
            'email' => "required_if:whatsapp,null|nullable|string|max:255|email|unique:contact_emails",
            'url' => "nullable|string|max:255|active_url",
            'whatsapp' => "required_if:email,null|nullable|string|max:255|active_url",
            'instagram' => "nullable|string|max:255|active_url",
            'facebook' => "nullable|string|max:255|active_url",
            'descripcion' => "nullable|string",
        ]);

        $data["user_id"] = auth()->user()->id;
        // dd($data);

        Contact_email::create($data);

        $message = [
            "message" => "El Registro Se ha Realizado correctamente.",
            "color" => "success",
            "icon" => "far fa-check-circle"
        ];

        return redirect()->route("contact_email.create")->with("message", $message );
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact_email  $contact_email
     * @return \Illuminate\Http\Response
     */
    public function show(Contact_email $contact_email)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact_email  $contact_email
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact_email $contact_email)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact_email  $contact_email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact_email $contact_email)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact_email  $contact_email
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact_email $contact_email)
    {
        $contact_email->delete();

        $message = [
            "message" => "El Registro Se ha eliminado correctamente.",
            "color" => "success",
            "icon" => "far fa-check-circle"
        ];

        return redirect()->back()->with("message", $message );
    }

    public function datatable()
    {
        $emails = Contact_email::orderBy("created_at", "DESC")->get();
        // dd($emails[0]);


        return datatables()
                ->of($emails)
                ->addColumn("actions", "admin.components.datatable.contact_email.actions")
                ->addColumn("creacion", function($email)
                {
                    return date_format($email->created_at, "d/m/Y");
                })
                ->addColumn("links_buttons", "admin.components.datatable.contact_email.links_buttons")
                ->addColumn("estado", "admin.components.datatable.contact_email.estado")
                ->addColumn("valid_email", "admin.components.datatable.contact_email.email")
                ->addColumn("word_nombre_empresa", "admin.components.datatable.contact_email.word_nombre_empresa")
                ->addColumn("usuario", function ($email)
                {
                    return $email->usuario->name;
                })
                ->rawColumns(["actions", "creacion", "links_buttons", "estado", "valid_email", "word_nombre_empresa", "usuario"])
                // ->rawColumns(["creacion"])
                // ->rawColumns(["links_buttons"])
                ->toJson();
    }
}
