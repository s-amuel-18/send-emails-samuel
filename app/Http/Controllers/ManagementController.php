<?php

namespace App\Http\Controllers;

use App\Models\BillingTime;
use App\Models\Income;
use App\Models\Spents;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function index()
    {
        $data["pays_time"] =  BillingTime::withSum("spemts", "price")->get();
        $data["income"] = Income::orderByDesc("price")->get();
        $data["spents"] = Spents::orderByDesc("price")->get();
        $data["title"] = "Administracion De Ingresos";
        $data["netIncome"] = Income::netIncome();
        $data["grossIncome"] = Income::grossIncome();
        $data["totalSpents"] = Spents::totalSpents();
        $data["dailyEarnings"] = Income::dailyEarnings();
        $data["porcentegeIncome"] = Income::porcentegeIncome();
        $data["porcentegeSpent"] = Spents::porcentegeSpent();

        return view("admin.managment.index", compact("data"));
    }
}
