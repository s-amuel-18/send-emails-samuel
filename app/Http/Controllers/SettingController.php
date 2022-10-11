<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    public function index()
    {
        $data["logo_img"] = Logo::first();

        $data["title"] = "Configuraciónes del sistema";

        $data["js"] = [
            "route_upload_logo_async" => route("settings.upload_logo_async")
        ];

        return view("admin.settings.index", compact("data"));
    }

    public function upload_logo_async(Request $request)
    {
        // * VALIDAMOS LOS DATOS ENVIADOS
        $data_valid = request()->validate([
            "image" => "required|image|mimes:jpeg,png|max:2000",
        ]);

        // * IMAGEN ENVIADA
        $img = $request->file("image");

        // * NOMBRE ORIGINAL DE LA IMAGEN
        $name_image = $img->getClientOriginalName();

        // * NUEVO NOMBRE DE LA IMAGEN (ESTO LO HACEMOS PARA QUE NO SE REPITAN LOS NOMBRES DE LAS IMAGENES)
        $new_name_image = uniqid() . now()->timestamp . "-" . $name_image;

        // * GUARDAMOS LA IMAGEN EN EL STOREAGE
        $img->storeAs("public/logos", $new_name_image);
        $route_file = "logos/" . $new_name_image;

        // * PATH DEL ARCHIVO GURDADO
        $storage_path = storage_path("app/public/" . $route_file);

        // * REDIMENCIONAMOS LA IMG 
        $img_front_fit = Image::make($storage_path)->resize(200, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        // * GUARDAMOS LA IMAGEN EN EL STORAGE
        $img_front_fit->save();

        $logo = Logo::first();
        $data_insert = ["url" => $route_file];

        // * CREAMOS EL REGISTRO DE LA IMG EN LA BASE DE DATOS
        if ($logo) {
            $route_storage_img = "public/" . $logo->url;
            if (Storage::exists($route_storage_img)) {
                Storage::delete($route_storage_img);
            }

            $logo->update($data_insert);
        } else {
            Logo::create($data_insert);
        }


        return response()->json([
            "route_file" => $route_file ?? null,
            "message" => "La imagen se ha registrado correctamente"
        ]);
    }
}
