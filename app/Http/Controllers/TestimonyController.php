<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestimonyRequest;
use App\Models\Testimony;
use App\Models\Image as ModelImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TestimonyController extends Controller
{
    public function index()
    {
        $search = request()->search;
        $testimonies = Testimony::complete();


        if ($search) {
            $testimonies->search($search);
        }

        $data["testimonies"] = $testimonies->orderBy("created_at", "DESC")->paginate(12);

        $data["title"] = "Testimonios";
        $data["js"] = [];
        return view("admin.testimony.index", compact("data"));
    }

    public function create()
    {
        // * solicitud de testimonio 
        // ? esta consulta nos entrega un tetimonio que tenga un token valido y en caso de que no tenga un token crea un testimonio vacio
        $data["testimony_request"] = Testimony::requestTestimony()->first();

        $data['title'] = "Testimonio";
        $data["js"] = [];
        return view("admin.testimony.create", compact("data"));
    }

    public function edit(Testimony $testimony)
    {
        $data["testimony"] = $testimony;
        $data["js"] = [];
        $data["route_form"] = route("testimony.update", ["testimony" => $data["testimony"]->id]);

        return view("admin.testimony.update", compact("data"));
    }

    public function with_token($token = null)
    {

        $data["testimony"] = Testimony::where("token", $token)->firstOrFail();
        $data["token"] = $token;
        $data["route_form"] = route("testimony.update_with_token", ["token" => $data["testimony"]->token]);

        $data["js"] = [];

        return view("admin.testimony.update", compact("data"));
    }

    public function store(TestimonyRequest $request)
    {
        $data_insert = [
            "name" => $request["name"],
            "position" => $request["position"],
            "rating" => $request["rating"],
            "title" => $request["title"],
            "review" => $request["review"],
        ];

        $testimony = auth()->user()->testimonies()->create($data_insert);

        $file_img = $request->file("image");

        if ($file_img) {
            $resize = [
                "fit" => [
                    "fit_x" => 200,
                    "fit_y" => 200
                ],
            ];


            $url_img = ModelImage::store_image($file_img, $resize, "testimonies");
            $testimony->image()->create([
                "url" => $url_img
            ]);
        }

        $message = [
            "message" => "El testimonio se ha registrado correctamente",
            "color" => "success",
            "icon" => "far fa-check-circle"
        ];

        return redirect()->route("testimony.index")->with("message", $message);
    }

    public function update(Testimony $testimony, TestimonyRequest $request)
    {
        $data_insert = [
            "name" => $request["name"],
            "position" => $request["position"],
            "rating" => $request["rating"],
            "title" => $request["title"],
            "review" => $request["review"],
            "token" => null,
        ];

        $testimony->update($data_insert);

        $file_img = $request->file("image");
        if ($file_img) {
            $image_testimony = $testimony->image;
            if ($image_testimony) {

                if (Storage::exists("public/" . $image_testimony->url)) {

                    // * ELIMINAMOS IMAGEN
                    Storage::delete("public/" . $image_testimony->url);

                    // * ELIMINAMOS EL REGISTRO DE LA BASE DE DATOS
                    $image_testimony->delete();
                }
            }

            $resize = [
                "fit" => [
                    "fit_x" => 200,
                    "fit_y" => 200
                ],
            ];


            $url_img = ModelImage::store_image($file_img, $resize, "testimonies");
            $testimony->image()->create([
                "url" => $url_img
            ]);
        }

        $message = [
            "message" => "El testimonio se ha actualizado correctamente",
            "color" => "success",
            "icon" => "far fa-check-circle"
        ];

        return redirect()->route("testimony.index")->with("message", $message);
    }

    public function update_with_token($token, TestimonyRequest $request)
    {
        $testimony = Testimony::where("token", $token)->firstOrFail();

        $data_insert = [
            "name" => $request["name"],
            "position" => $request["position"],
            "rating" => $request["rating"],
            "title" => $request["title"],
            "review" => $request["review"],
            "token" => null,
        ];

        $testimony->update($data_insert);

        return redirect()->route("testimony.message");
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

    public function message()
    {
        $data["js"] = [];
        return view("messages.tesimony_request", compact("data"));
    }
}
