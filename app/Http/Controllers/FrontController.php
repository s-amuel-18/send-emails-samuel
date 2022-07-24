<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $data['js'] = [
            "url_post_contact_message" => route("envio_email.client_contact_front")
        ];
        return view("front.index", compact("data"));
    }
}
