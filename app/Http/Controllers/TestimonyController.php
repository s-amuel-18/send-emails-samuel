<?php

namespace App\Http\Controllers;

use App\Models\Testimony;
use Illuminate\Http\Request;

class TestimonyController extends Controller
{
    public function index()
    {
        $data["testimonies"] = Testimony::complete()->paginate(8);

        if (request()->page) {
            return response()->json([
                "testimonies" => $data["testimonies"]
            ]);
        }


        $data["title"] = "Testimonios";
        $data["js"] = [];
        return view("admin.testimony.index", compact("data"));
    }

    public function create()
    {
        $data['title'] = "Testimonio";
        $data["js"] = [];
        return view("admin.testimony.create", compact("data"));
    }

    public function published(Testimony $testimony, Request $riquest)
    {
        $data = request()->validate([
            "published" => "required|numeric|min:0|max:1"
        ]);

        $published = $data["published"];

        $testimony->update([
            "published" => $published
        ]);

        $data_response = [
            "message" => [
                "type" => "success",
                "message" => "El testimonio se ha actualizado correctamente"
            ],
            "record" => $testimony,
        ];

        return response()->json($data_response, 200);
    }

    public function destroy(Testimony $testimony)
    {
        $testimony->delete();

        return response()->json([
            "message" => "El testimonio se ha eliminado correctamente.",
            "testimony" => $testimony
        ]);
    }
}
