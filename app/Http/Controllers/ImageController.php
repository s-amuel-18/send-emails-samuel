<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store_image_async(Request $request)
    {
        $data_valid = request()->validate([
            "image" => "required|image|mimes:jpeg,png|max:2000",
            "fit_x" => "nullable|numeric",
            "fit_y" => "nullable|numeric",
            "crop_width" => "nullable|numeric",
            "crop_height" => "nullable|numeric",
            "crop_x" => "nullable|numeric",
            "crop_y" => "nullable|numeric",
        ]);


        // * IMAGEN ENVIADA
        $img = $request->file("image");

        // * NOMBRE ORIGINAL DE LA IMAGEN
        $name_image = $img->getClientOriginalName();

        // * NUEVO NOMBRE DE LA IMAGEN (ESTO LO HACEMOS PARA QUE NO SE REPITAN LOS NOMBRES DE LAS IMAGENES)
        $new_name_image = uniqid() . now()->timestamp . "-" . $name_image;

        // * GUARDAMOS LA IMAGEN EN EL STOREAGE
        $img->storeAs("public/images", $new_name_image);
        $route_file = "images/" . $new_name_image;

        // * PATH DEL ARCHIVO GURDADO
        $storage_path = storage_path("app/public/" . $route_file);


        if (
            $data_valid["crop_width"] and
            $data_valid["crop_height"] and
            $data_valid["crop_x"] and
            $data_valid["crop_y"]
        ) {
            // * CORTAR IMG 
            $width = round($data_valid["crop_width"]);
            $height = round($data_valid["crop_height"]);
            $x = round($data_valid["crop_x"]);
            $y = round($data_valid["crop_y"]);
            $img_front_fit = Image::make($storage_path)->crop($width, $height, $x, $y);
        }

        $img_front_fit->fit($data_valid["fit_x"] ?? null, $data_valid["fit_y"] ?? null);

        // * GUARDAMOS LA IMAGEN EN EL STORAGE
        $img_front_fit->save();

        return response()->json([
            "url_image" => $route_file,
            "message" => "Imagen subida con exito",
        ]);
    }
}
