<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ? titulo de la pagina
        $data["title"] = "Proyectos";

        // ? cantidad de proyectos
        $data['projects_count'] = Project::complete()->count();

        // ? proyectos
        $data["projects"] = Project::complete()->get();

        // ? categoria de proyectos
        $data["categories"] = Category::project()->get();

        // ? variables para javascrip
        $data["js"] = [
            "category_type" => Project::class
        ];

        return view("admin.projects.index", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // ? titulo de la seccion
        $data['title'] = "Nuevo Proyecto";

        // ? Categorias
        $data["categories"] = Category::project()->get();

        // ? variables js
        $data['js'] = [];

        return view("admin.projects.create", compact("data"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ! falta validar imagenes
        $data = request()->validate([
            "name" => "required|string|max:191",
            "categories" => "required|array",
            "categories.*" => "exists:categories,id",
            "description" => "required",
            "image_front_page" => "required",
        ]);

        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    public function published(Project $project, Request $riquest)
    {
        $data = request()->validate([
            "published" => "required|numeric|min:0|max:1"
        ]);

        $published = $data["published"];

        $project->update([
            "published" => $published
        ]);

        $data_response = [
            "message" => [
                "type" => "success",
                "message" => "El proyecto se actualizó correctamente"
            ],
            "record" => $project,
        ];

        return response()->json($data_response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
