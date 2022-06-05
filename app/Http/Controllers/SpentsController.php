<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncomeSpentRequest;
use App\Models\BillingTime;
use App\Models\Spents;
use Illuminate\Http\Request;

class SpentsController extends Controller
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
        //
        $data["title"] = "Crear Nuevo Gasto";
        $data["text_buttom"] = "Crear Nuevo Gasto";
        $data["billing_times"] = BillingTime::orderBy("days", "ASC")->get();
        $data["route_send"] = Route("spent.store");
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

        $income = Spents::create([
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
     * @param  \App\Models\Spents  $spents
     * @return \Illuminate\Http\Response
     */
    public function show(Spents $spents)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spents  $spents
     * @return \Illuminate\Http\Response
     */
    public function edit(Spents $spent)
    {

        $data["title"] = "Actualizar Gasto " . $spent->name;
        $data["text_buttom"] = "Actualizar Gasto";
        $data["billing_times"] = BillingTime::orderBy("days", "ASC")->get();
        $data["route_send"] = Route("spent.update", ["spent" => $spent->id]);
        $data["update"] = $spent;
        $data["method"] = "PUT";

        return view("admin.managment.create", compact("data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spents  $spents
     * @return \Illuminate\Http\Response
     */
    public function update(IncomeSpentRequest $request, Spents $spent)
    {
        $spentUpdate = Spents::create([
            "name" => $request["name"],
            "billing_time_id" => $request["billing_time_id"],
            "price" => $request["price"],
            "desc" => $request["desc"],
        ]);

        $spentUpdate->billing_time_id = $request["billing_time_id"];
        $spentUpdate->save();

        $message = [
            "message" => "El Ingreso <b>{$spentUpdate->name}</b> Se ha Actualizado correctamente.",
            "color" => "success",
            "icon" => "far fa-check-circle"
        ];

        return redirect()->route("managment.index")->with("message", $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spents  $spents
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spents $spent)
    {
        $spent->delete();

        $message = [
            "message" => "El Gasto <b>{$spent->name}</b> Se ha eliminado correctamente.",
            "color" => "success",
            "icon" => "far fa-check-circle"
        ];

        return redirect()->back()->with("message", $message);
    }
}
