<?php

namespace App\Http\Controllers\contact_email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Email_send extends Controller
{

    public function __construct()
    {
        $this->middleware("can:envio_email.index")->only("index", "select_email", "send_emails");
    }


    public function index()
    {
        return view("admin.contact_email.envio_emails.index");
    }

    public function select_email()
    {
        # code...
    }

    public function send_emails(Type $var = null)
    {
        # code...
    }
}
