<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image as ModelsImage;
use App\Models\Project;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // * titulo de la pagina
        $data["title"] = "Proyectos";

        // * cantidad de proyectos
        $data['projects_count'] = Project::complete()->count();

        // * tipo de eliminacion
        $data["type_destroy"] = "trash";

        // * pagina actual
        $data["page"] = "index";

        // * proyectos
        $data["projects"] = Project::complete()->get();

        // * categoria de proyectos
        $data["categories"] = Category::project()->get();

        // * variables para javascrip
        $data["js"] = [
            "category_type" => Project::class
        ];

        return view("admin.projects.index", compact("data"));
    }

    public function trash_projects()
    {
        // * titulo de la pagina
        $data["title"] = "Proyectos (papelera)";

        // * cantidad de proyectos
        $data['projects_count'] = Project::trash()->count();

        // * tipo de eliminacion
        $data["type_destroy"] = "delete";

        // * pagina actual
        $data["page"] = "trash";

        // * proyectos
        $data["projects"] = Project::trash()->get();

        // * categoria de proyectos
        $data["categories"] = Category::project()->get();

        // * variables para javascrip
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
        // * validaciones
        $data = request()->validate([
            "name" => "required|string|max:191",
            "categories" => "required|array",
            "categories.*" => "exists:categories,id",
            "description" => "required",
            "image_front_page" => "required|image|mimes:jpeg,png,jpg|max:2048",
            "item_help" => "nullable|array",
            "item_help.*" => "required",
            "images" => "sometimes|required|array",
            "images.*" => [
                "image",
                "mimes:jpeg,png",
            ]
        ]);


        // * CREACION DEL PROYECTO
        $project = auth()->user()->projects()->create([
            "name" => $data["name"],
            "description" => $data["description"],
        ]);

        // * FUNCION QUE PERMITE REDIMENCIONAR LAS IMAGENES ENVIADAS Y AGREGARLAS AL PROYECTO
        $project->create_and_resize_images($request);

        // * AGREGAMOS LAS CATEGORIAS AL PROYECTO
        $project->categories()->attach($data["categories"]);

        // * VALIDAMOS QUE HALLAN ITEMS HELPERS
        if (count($data["item_help"] ?? []) > 0) {
            // * NOS PERMITE CREAR LOS ITEMS HELPER Y AÑADIRLOS AL PROYECTO
            $project->create_items_helper($data["item_help"]);
        }


        if ($project->slug ?? null) {
            return redirect()->route("project.show", ["slug_name" => $project->slug]);
        } else {
            return redirect()->route("project.index");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($slug_name)
    {
        $project = Project::whereSlug($slug_name)
            ->with("images")
            ->with("categories")
            ->with("itemHelp")
            ->firstOrFail();

        $data["title"] = $project->name;
        $data["project"] = $project;


        return view("admin.projects.show", compact("data"));
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


    public function out_trash(Project $project)
    {
        $project->update([
            "trash" => 0
        ]);

        $response = [
            "message" => [
                "message" => "El proyecto se ha restaurado correctamente.",
                "type" => "success"
            ],
            "element" => $project
        ];

        return response()->json($response, 200);
    }

    public function trash(Project $project)
    {
        $project->update([
            "trash" => 1,
            "published" => 0
        ]);

        $response = [
            "message" => [
                "message" => "El proyecto se ha enviado a la papelera",
                "type" => "success"
            ],
            "element" => $project
        ];

        return response()->json($response, 200);
    }

    public function destroy(Project $project)
    {
        $response = [
            "message" => [
                "message" => "El proyecto se ha eliminado correctamente",
                "type" => "success"
            ],
            "element" => $project
        ];

        return response()->json($response, 200);
    }
}
