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
        $pays_time = BillingTime::withSum("spemts", "price")->get();

        $pays_time->each(function ($spent) {
            $spent->calculate = $spent->calculate;
        });

        $calculate_spents = [
            "day" => $pays_time->sum("calculate.day"),
            "week" => $pays_time->sum("calculate.week"),
            "fortnight" => $pays_time->sum("calculate.fortnight"),
            "month" => $pays_time->sum("calculate.month"),
        ];

        $data["pays_time"] =  $calculate_spents;

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
