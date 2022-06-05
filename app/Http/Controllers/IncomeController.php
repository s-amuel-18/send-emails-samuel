<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncomeSpentRequest;
use App\Models\BillingTime;
use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data["title"] = "Crear Nuevo Ingreso";
        $data["text_buttom"] = "Crear Nuevo Ingreso";
        $data["billing_times"] = BillingTime::orderBy("days", "ASC")->get();
        $data["route_send"] = Route("income.store");
        $data["method"] = "POST";

        return view("admin.managment.create", compact("data"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IncomeSpentRequest $request)
    {
        // dd($request);

        $income = Income::create([
            "name" => $request["name"],
            "billing_time_id" => $request["billing_time_id"],
            "price" => $request["price"],
            "desc" => $request["desc"],
        ]);

        $income->billing_time_id = $request["billing_time_id"];
        $income->save();

        $message = [
            "message" => "El Ingreso <b>{$income->name}</b> Se ha creado correctamente.",
            "color" => "success",
            "icon" => "far fa-check-circle"
        ];

        return redirect()->route("managment.index")->with("message", $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        $data["title"] = "Actualizar Ingreso " . $income->name;
        $data["text_buttom"] = "Actualizar Ingreso";
        $data["billing_times"] = BillingTime::orderBy("days", "ASC")->get();
        $data["route_send"] = Route("income.update", ['income' => $income->id]);
        $data["update"] = $income;
        $data["method"] = "PUT";

        return view("admin.managment.create", compact("data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(IncomeSpentRequest $request, Income $income)
    {
        $incomeUpdate = Income::create([
            "name" => $request["name"],
            "billing_time_id" => $request["billing_time_id"],
            "price" => $request["price"],
            "desc" => $request["desc"],
        ]);

        $incomeUpdate->billing_time_id = $request["billing_time_id"];
        $incomeUpdate->save();

        $message = [
            "message" => "El Ingreso <b>{$incomeUpdate->name}</b> Se ha Actualizado correctamente.",
            "color" => "success",
            "icon" => "far fa-check-circle"
        ];

        return redirect()->route("managment.index")->with("message", $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        $income->delete();

        $message = [
            "message" => "El Ingreso <b>{$income->name}</b> Se ha eliminado correctamente.",
            "color" => "success",
            "icon" => "far fa-check-circle"
        ];

        return redirect()->back()->with("message", $message);
    }
}
