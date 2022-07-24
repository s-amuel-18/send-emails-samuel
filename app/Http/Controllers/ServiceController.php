<?php

namespace App\Http\Controllers;

use App\Models\CategoryService;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Servicios";

        $data["services"] = Service::get();

        return view("admin.services.index", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Servicios";

        $data["categories"] = CategoryService::get();


        return view("admin.services.create", compact("data"));
    }

    // public function ct()
    // {
    //     $data['title'] = "Servicios";
    //     return view("admin.services.create-ct", compact("data"));
    // }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            "name" => "required|max:255|string",
            "price" => "required|numeric|max:1000000",

        ]);

        $service = auth()->user()->services()->create([
            "name" => $data["name"],
            "price" => $data["price"],
            "category_id" => $data["category_id"] ?? 0,
        ]);


        $message = [
            "message" => "El Servico <b>{$service->name}</b> Se ha creado correctamente.",
            "color" => "success",
            "category_id" => "far fa-check-circle"
        ];

        return redirect()->route("service.index")->with("message", $message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($service_id)
    {
        $service = Service::findOrFail($service_id);

        $data['title'] = "Servicios";
        $data['service'] = $service;

        $data["categories"] = CategoryService::get();


        return view("admin.services.edit", compact("data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $service_id)
    {
        $data = request()->validate([
            "name" => "required|max:255|string",
            "price" => "required|numeric|max:1000000",

        ]);

        $service = Service::findOrFail($service_id);

        $service->update([
            "name" => $data["name"],
            "price" => $data["price"],
            "category_id" => $data["category_id"] ?? 0,
        ]);

        $message = [
            "message" => "El Servico <b>{$service->name}</b> Se ha editado correctamente.",
            "color" => "success",
            "category_id" => "far fa-check-circle"
        ];

        return redirect()->route("service.index")->with("message", $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($service_id)
    {
        $service = Service::findOrFail($service_id);

        $service->delete();

        $message = [
            "message" => "El Servico <b>{$service->name}</b> Se ha eliminado correctamente.",
            "color" => "success",
            "icon" => "far fa-check-circle"
        ];

        return redirect()->back()->with("message", $message);
    }
}
