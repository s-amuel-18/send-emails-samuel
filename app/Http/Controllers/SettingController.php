<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $data["title"] = "Configuraciónes del sistema";
        return view("admin.settings.index", compact("data"));
    }
}
