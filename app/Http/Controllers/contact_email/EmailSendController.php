<?php

namespace App\Http\Controllers\contact_email;

use App\Http\Controllers\Controller;
use App\Models\BodyEmail;
use App\Models\Contact_email;
use Illuminate\Http\Request;

class EmailSendController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:envio_email.index")->only("index", "select_email", "send_emails");
    }


    public function index()
    {
        $bodysEmail = BodyEmail::select("id", "nombre")->get();

        $emails = Contact_email::select("id", "email")->whereNotNull("email")->orderBy("estado", "ASC")->get();
        // dd($bodysEmail);

        return view("admin.contact_email.envio_emails.index", compact("bodysEmail", "emails"));
    }

    public function crear_informacio(Request $request)
    {
        $data = request()->validate([
            "nombre_remitente" => "nullable|string|max:40",
            "select_body" => "nullable|integer|exists:body_emails,id",
            "check_emails" => "required|integer",
            "body" => "nullable|string",
            "emails" => "nullable|array",
        ]);



        if( isset($data["check_emails"]) ) {



        }

        // session()->forget("prueba");
        // session_destroy();

    }

    public function select_email()
    {
        # code...
    }

    private function send_emails()
    {
        # code...
    }
}
