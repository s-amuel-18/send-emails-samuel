<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoteRequest;
use App\Models\Category;
use App\Models\Note;
use Illuminate\Http\Request;
use Mockery\Matcher\Not;

class SubjectController extends Controller
{
    private const CATEGORY_TYPE = Note::class;

    public function get_all()
    {
        $categories = auth()->user()->categories()->note();

        $categories = $categories->paginate(10);

        return response()->json([
            "subjects" => $categories
        ]);
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            "name" => "required|max:100|string",
        ]);

        $name_categorie = $data["name"];
        $categorie_type = $this::CATEGORY_TYPE;

        $exist_categorie = auth()->user()->categories()->note()
            ->where("name", $name_categorie)
            ->count();

        if ($exist_categorie > 0) {
            return response()->json(["message" => "El nombre de la asignatura ya está registrado."], 403);
        }

        $name = $data["name"];

        $category = auth()->user()->categories()->create([
            "name" => $name,
            "catgoriable_type" => $categorie_type,
        ]);

        $response_data = [
            "message" => "La asignatura se ha registrado correctamente.",
            "subject" => $category
        ];

        return response()->json($response_data, 200);
    }

    public function update($id)
    {
        $category = Category::findOrFail($id);

        $this->authorize("view", $category);

        $data = request()->validate([
            "name" => "required|max:100|string",
        ]);

        $name = $data["name"];
        $categorie_type = $this::CATEGORY_TYPE;

        $exist_categorie = auth()->user()->categories()->note()
            ->where("name", $name)
            ->where("id", "<>", $id)
            ->first();

        if ($exist_categorie) {
            return response()->json(["message" => "El nombre de la asignatura ya está registrado."], 403);
        }


        $category->update(["name" => $name]);

        $category_updated = Category::findOrFail($id);

        $response_data = [
            "message" => "La asignatura se ha actualizado correctamente.",
            "data_insert" => $category_updated
        ];

        return response()->json($response_data, 200);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $this->authorize("view", $category);

        $category->delete();

        $response_data = [
            "message" => "La asignatura se ha eliminado correctamente",
            "data" => $category
        ];

        return response()->json($response_data, 200);
    }

    public function notes($id_category)
    {
        $category = Category::note()->where("id", $id_category)->firstOrFail();

        $this->authorize("view", $category);

        $notes = Note::where("category_id", $id_category)
            ->orderBy("favorite", "desc")
            ->orderBy("created_at", "desc");
        $notes = $notes->paginate(10);

        return response()->json([
            "subject" => $category,
            "notes" => $notes
        ]);
    }

    public function note_show(Note $note)
    {

        $this->authorize("view", $note);

        return response()->json([
            "note" => $note
        ]);
    }

    public function note_store(NoteRequest $request)
    {
        $category = Category::find($request->category_id);

        $this->authorize("view", $category);

        $note = auth()->user()->notes()->create($request->all());

        return response()->json([
            "message" => "La nota se creó correctamente.",
            "note" => $note
        ]);
    }

    public function note_update(Note $note, NoteRequest $request)
    {
        $this->authorize("view", $note);

        $note->update($request->all());

        return response()->json([
            "message" => "La nota se actualizó correctamente.",
            "note" => $note
        ]);
    }

    public function note_delete(Note $note)
    {
        $this->authorize("view", $note);

        $note->delete();

        return response()->json([
            "message" => "La nota se eliminó correctamente.",
            "note" => $note
        ]);
    }
}
