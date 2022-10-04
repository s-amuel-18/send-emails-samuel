<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image as ModelsImage;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // dsadsadsa-front-image-project-1663876542-632cbdbeabc06.jpg>
    public function index(Request $request)
    {

        if ($request["trash"]) {
            // * titulo de la pagina
            $data["title"] = "Papelera";

            // * tipo de eliminacion
            $data["type_destroy"] = "delete";

            // * pagina actual
            $data["page"] = "trash";

            // * cantidad de proyectos
            $data['projects_count'] = Project::trash()->count();

            // * proyectos
            $data["projects"] = Project::trash()->get();
        } elseif ($request["eraser"]) {

            // * titulo de la pagina
            $data["title"] = "Borradores";

            // * tipo de eliminacion
            $data["type_destroy"] = "trash";

            // * pagina actual
            $data["page"] = "eraser";

            // * cantidad de proyectos
            $data['projects_count'] = Project::eraser()->count();

            // * proyectos
            $data["projects"] = Project::eraser()->get();
        } else {

            // * titulo de la pagina
            $data["title"] = "Proyectos";

            // * tipo de eliminacion
            $data["type_destroy"] = "trash";

            // * pagina actual
            $data["page"] = "index";

            // * cantidad de proyectos
            $data['projects_count'] = Project::complete()->count();

            // * proyectos
            $data["projects"] = Project::complete()->get();
        }

        $data["trash_count"] = Project::trash()->count();
        $data["eraser_count"] = Project::eraser()->count();
        $data["index_count"] = Project::complete()->count();

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

        return view("admin.projects.create_and_update", compact("data"));
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
            "project_id" => "required",
            "name" => "required|string|max:191",
            "categories" => "required|array",
            "categories.*" => "exists:categories,id",
            "description" => "required",
            "image_front_page" => "required_if:img_front_exist,null|image|mimes:jpeg,png,jpg|max:2048",
            "item_help" => "nullable|array",
            "item_help.*" => "required",
            // "images" => "sometimes|required|array",
            // "images.*" => [
            //     "image",
            //     "mimes:jpeg,png",
            // ]
        ]);

        $data_insert = [
            "name" => $data["name"],
            "description" => $data["description"],
        ];

        if ($data["project_id"] == 0) {

            // * CREACION DEL PROYECTO
            $project = auth()->user()->projects()->create($data_insert);

            // * EN CASO DE QUE EL PROYECTO NO TENGA SLUG NAME LO CREAMOS
            if (!$project->slug ?? null) {
                $project->create_slug();
            }
        } else {
            $project = Project::findOrFail($data["project_id"]);
            $data_insert["eraser"] = 0;
            $project->update($data_insert);
        }

        if ($request["img_front_exist"] and $request->file("image_front_page")) {
            $project->deleteFronImage();
        }

        // * FUNCION QUE PERMITE REDIMENCIONAR LAS IMAGENES ENVIADAS Y AGREGARLAS AL PROYECTO
        $project->create_and_resize_images($request);

        // * ASOCIAMOS LAS CATEGORIAS ENVIADAS AL PROYECTO
        $project->categories()->sync($data["categories"]);


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
        // * titulo de la seccion
        $data['title'] = "Editar " . $project->name;
        // * proyecto
        $data['project'] = $project;

        // * plud de categorias asociadas al proyecto
        $data['pluck_categories'] = $project->categories->pluck("id")->all();

        // * Categorias
        $data["categories"] = Category::project()->get();

        // * variables js
        $data['js'] = [];

        return view("admin.projects.create_and_update", compact("data"));
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
        if (!$project->published and $project->eraser) {
            return response()->json([
                "message" => "No se puede puede publicar un proyecto incompleto."
            ], 500);
        }

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
            "projects_status" => Project::projectsStatus(),
            "element" => $project
        ];

        return response()->json($response, 200);
    }

    public function trash(Project $project)
    {
        $project->update([
            "trash" => 1,
            "trash" => 1,
            "published" => 0
        ]);

        $response = [
            "message" => [
                "message" => "El proyecto se ha enviado a la papelera",
                "type" => "success"
            ],
            "element" => $project,
            "projects_status" => Project::projectsStatus(),
        ];

        return response()->json($response, 200);
    }

    public function destroy(Project $project)
    {
        // * ELIMINACION DE IMAGENES ASOCIADAS AL PROYECTO
        $project->deleteAllImages();
        $project->delete();

        $response = [
            "message" => [
                "message" => "El proyecto se ha eliminado correctamente",
                "type" => "success"
            ],
            "element" => $project,
            "projects_status" => Project::projectsStatus(),
        ];

        return response()->json($response, 200);
    }



    public function upload_image(Request $request)
    {
        // * VALIDAMOS LOS DATOS ENVIADOS
        $data_valid = request()->validate([
            "image" => "required|image|mimes:jpeg,png",
            "project_id" => "required"
        ]);

        $project_id = $data_valid["project_id"];

        // * EN CASO DE QUE EL ID DEL PROYECTO SEA 0 (NO SE TIENE UN PROYECTO) LO CREAMOS COMO UNO NUEVO
        if ($project_id == 0) {
            // * CREAMOS UN PROYECTO VACIO PARA POSTERIORMENTE ASOCIAR LAS IMAGENES ENVUADAS A ESTE PROYECTO
            $project = auth()->user()->projects()->create([
                "eraser" => 1
            ]);
        } else {
            $project = Project::findOrFail($project_id);
        }

        // * IMAGEN ENVIADA
        $img = $request->file("image");

        // * NOMBRE ORIGINAL DE LA IMAGEN
        $name_image = $img->getClientOriginalName();

        // * NUEVO NOMBRE DE LA IMAGEN (ESTO LO HACEMOS PARA QUE NO SE REPITAN LOS NOMBRES DE LAS IMAGENES)
        $new_name_image = uniqid() . now()->timestamp . "-" . $name_image;

        // * GUARDAMOS LA IMAGEN EN EL STOREAGE
        $img->storeAs("public/projects", $new_name_image);
        $route_file = "projects/" . $new_name_image;

        // * PATH DEL ARCHIVO GURDADO
        $storage_path = storage_path("app/public/" . $route_file);

        // * REDIMENCIONAMOS LA IMG 
        $img_front_fit = Image::make($storage_path)->fit(600, 360);

        // * GUARDAMOS LA IMAGEN EN EL STORAGE
        $img_front_fit->save();

        // * CREAMOS EL REGISTRO DE LA IMG EN LA BASE DE DATOS
        $image_create = $project->images()->create([
            "url" => $route_file
        ]);

        return response()->json([
            "route_file" => $route_file ?? null,
            "project" => $project,
            "image_create" => $image_create
        ]);
    }


    public function upload_image_delete(Request $request)
    {
        // * VALIDAMOS LOS DATOS ENVIADOS
        $data_valid = request()->validate([
            "image_id" => "required|exists:images,id",
        ]);

        $image = ModelsImage::findOrFail($data_valid["image_id"]);
        $route_file = $image->url;

        if (!$route_file) return response()->json(null, 404);

        if (Storage::exists("public/" . $route_file)) {

            // * ELIMINAMOS IMAGEN
            Storage::delete("public/" . $route_file);

            // * ELIMINAMOS EL REGISTRO DE LA BASE DE DATOS
            $image->delete();

            return response()->json([
                "message" =>    "Imagen eliminada"
            ]);
        }

        return response()->json([
            "message" => "No existe el archivo"
        ], 404);
    }

    public function change_or_create_data_project(Request $request)
    {
        // * METODOS DE VALIDACION
        $data_valid = request()->validate([
            "categories" => "nullable|array",
            "categories.*" => "exists:categories,id",
            "description" => "nullable",
            "name" => "nullable",
            "project_id" => "required"
        ]);

        // * EXTRAEMOS EL ID DEL PROYECTO 
        // ? NOTA: este id puede ser un 0 o uno que ya exista en la base de datos, de esta forma sabemos si debemos crear o actualizar el proyecto
        $project_id = $data_valid["project_id"];
        // * EN CASO DE QUE EL ID DEL PROYECTO SEA 0 (NO SE TIENE UN PROYECTO) LO CREAMOS COMO UNO NUEVO
        if ($project_id == 0) {
            // * CREAMOS UN PROYECTO VACIO PARA POSTERIORMENTE ASOCIAR LAS IMAGENES ENVUADAS A ESTE PROYECTO
            $project = auth()->user()->projects()->create([
                "eraser" => 1,
                "name" => $data_valid["name"] ?? "",
                "description" => $data_valid["description"] ?? "",
            ]);
        } else {
            // * FILTRAMOS EL PRPYECTO EN CASO DE QUE EL ID ENVIADO NO SEA 0 
            $project = Project::findOrFail($project_id);
            $project->update([
                "name" => $data_valid["name"] ?? "",
                "description" => $data_valid["description"] ?? "",
            ]);
        }


        if ($data_valid["categories"] ?? null) {
            // * ASOCIAMOS LAS CATEGORIAS ENVIADAS AL PROYECTO
            $project->categories()->sync($data_valid["categories"]);
        }

        // * RESPONDEMOS CON LOS DATOS DEL PROYECTO
        return response()->json([
            "project" => $project,
        ]);
    }
}
