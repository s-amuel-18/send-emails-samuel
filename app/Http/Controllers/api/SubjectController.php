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
