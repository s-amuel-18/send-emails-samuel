<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use App\Models\InfoPrimary;
use App\Models\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Polyfill\Intl\Idn\Info;

class SettingController extends Controller
{
    public function index()
    {
        $data["logo_img"] = Logo::first();
        $data["info_primary"] = InfoPrimary::first();
        $data["contact_info"] = ContactInfo::first();
        // dd($data["contact_info"]->toArray());

        $data["title"] = "Configuraciónes del sistema";

        $data["js"] = [
            "route_upload_logo_async" => route("settings.upload_logo_async"),
            "route_upload_img_primary_async" => route("settings.upload_img_primary_async"),
            "route_info_primary_async" => route("settings.info_primary_async"),
            "route_contact_info_async" => route("settings.contact_info_async"),
            "route_create_social_media_async" => route("settings.create_social_media_async"),
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

    public function upload_img_primary_async(Request $request)
    {
        // * VALIDAMOS LOS DATOS ENVIADOS
        $data_valid = request()->validate([
            "image" => "required|image|mimes:jpeg,png|max:5000",
            "width" => "required|numeric",
            "height" => "required|numeric",
            "x" => "required|numeric",
            "y" => "required|numeric",
        ]);

        // * IMAGEN ENVIADA
        $img = $request->file("image");

        // * NOMBRE ORIGINAL DE LA IMAGEN
        $name_image = $img->getClientOriginalName();

        // * NUEVO NOMBRE DE LA IMAGEN (ESTO LO HACEMOS PARA QUE NO SE REPITAN LOS NOMBRES DE LAS IMAGENES)
        $new_name_image = uniqid() . now()->timestamp . "-" . $name_image;

        // * GUARDAMOS LA IMAGEN EN EL STOREAGE
        $img->storeAs("public/site_image", $new_name_image);
        $route_file = "site_image/" . $new_name_image;

        // * PATH DEL ARCHIVO GURDADO
        $storage_path = storage_path("app/public/" . $route_file);

        // * REDIMENCIONAMOS LA IMG 
        // $img_front_fit = Image::make($storage_path)->crop(300, 300, 20, 20);
        $width = round($data_valid["width"]);
        $height = round($data_valid["height"]);
        $x = round($data_valid["x"]);
        $y = round($data_valid["y"]);

        $img_front_fit = Image::make($storage_path)->crop($width, $height, $x, $y)
            ->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            });;

        // * GUARDAMOS LA IMAGEN EN EL STORAGE
        $img_front_fit->save();

        $infoPrimary = InfoPrimary::first();
        $data_insert = ["url" => $route_file];

        // * CREAMOS EL REGISTRO DE LA IMG EN LA BASE DE DATOS
        if ($infoPrimary) {
            $route_storage_img = "public/" . $infoPrimary->url;
            if (Storage::exists($route_storage_img)) {
                Storage::delete($route_storage_img);
            }

            $infoPrimary->update($data_insert);
        } else {
            InfoPrimary::create($data_insert);
        }


        return response()->json([
            "route_file" => asset("storage/" . $route_file) ?? null,
            "message" => "La imagen se ha registrado correctamente"
        ]);
    }

    public function info_primary_async(Request $request)
    {
        // * validamos datos de entrada
        $data_valid = request()->validate([
            "title" => "nullable|string|max:191",
            "description" => "nullable|string"
        ]);

        // * indo principal de la pagina (puede ser nulo)
        $info_primary = InfoPrimary::first();

        // * creamos la lista de datos que queremos registrar
        $data_insert = [
            "title" => $data_valid["title"] ?? null,
            "description" => $data_valid["description"] ?? null
        ];

        // * validamos que exista un registro en InfoPrimary
        if ($info_primary) {
            // * en caso de que exista actualizamos los datos
            $info_primary->update($data_insert);
        } else {
            // * en caso de que no exista los creamos
            $info_primary = InfoPrimary::create($data_insert);
        }

        // * mandamos informacion al cliente
        return response()->json([
            "info_primary" => $info_primary,
            "message" => "Se ha registrado correctamente"
        ]);
    }

    public function contact_info_async(Request $request)
    {
        $contact_info = ContactInfo::first();

        $data_valid = request()->validate([
            "location" => "required|string|max:191",
            "email" => "required|email|unique:contact_infos,email," . ($contact_info->id ?? 0)  . ",id|max:191",
            "phone" => "required|string|max:191"
        ]);

        $data_insert = [
            "location" => $data_valid["location"],
            "email" => $data_valid["email"],
            "phone_number" => $data_valid["phone"],
        ];

        if ($contact_info) {
            $contact_info->update($data_insert);
        } else {
            $contact_info = ContactInfo::create($data_insert);
        }

        return response()->json([
            "contact_info" => $contact_info,
            "message" => "Informacion de contacto registrada correctamente"
        ]);
    }

    public function create_social_media_async()
    {
    }
}
