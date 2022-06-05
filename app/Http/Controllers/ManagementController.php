<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Spents;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function index()
    {
        $data["income"] = Income::orderByDesc("price")->get();
        $data["spents"] = Spents::orderByDesc("price")->get();
        $data["title"] = "Administracion De Ingresos";
        $data["netIncome"] = Income::netIncome();
        $data["grossIncome"] = Income::grossIncome();
        $data["totalSpents"] = Spents::totalSpents();
        $data["dailyEarnings"] = Income::dailyEarnings();

        return view("admin.managment.index", compact("data"));
    }
}
