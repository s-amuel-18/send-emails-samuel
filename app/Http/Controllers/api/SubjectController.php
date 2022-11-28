<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Note;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function get_all(Request $request)
    {
        return response()->json([
            "subjects" => []
        ]);
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            "name" => "required|max:100|string",
        ]);

        $name_categorie = $data["name"];
        $categorie_type = Requirements::class;

        $exist_categorie = Category::where("catgoriable_type", $categorie_type)
            ->where("name", $name_categorie)
            ->count();

        if ($exist_categorie > 0) {
            return response()->json(["message" => "El nombre de la categoría ya está registrado."], 403);
        }

        $name = $data["name"];

        $category = auth()->user()->categories()->create([
            "name" => $name, "catgoriable_type" => Requirements::class,
            "catgoriable_type" => $categorie_type,
        ]);

        $response_data = [
            "message" => "La categoría se ha registrado correctamente.",
            "data_insert" => $category
        ];


        return response()->json($response_data, 200);
    }

    public function update(Type $var = null)
    {
        # code...
    }

    public function destroy(Type $var = null)
    {
        # code...
    }

    public function notes($id_category)
    {
        $category = Category::note()->where("id", $id_category)->firstOrFail();

        return response()->json([
            "subject" => $category
        ]);
    }
}
