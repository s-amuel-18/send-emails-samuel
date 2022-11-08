<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use App\Models\InfoPrimary;
use App\Models\Logo;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Polyfill\Intl\Idn\Info;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {
        $data["logo_img"] = Logo::first();
        $data["info_primary"] = InfoPrimary::first();
        $data["contact_info"] = ContactInfo::first();
        $data["social_medias"] = SocialMedia::complete()->get();

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

        // * NUEVO NOMBRE DE LA IMAGEN (ESTO LO HACEMOS PARA QUE NO SE REPITAN LOS NOMBRES DE LAS IMAGENES)
        $new_name_image = uniqid() . now()->timestamp . ".png";

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

    public function publish_logo_async(Request $request)
    {
        $data_valid = request()->validate([
            "published" => "required"
        ]);

        $logo = Logo::first();

        if (!$logo) {
            return response()->json([
                "message" => "No se encontró algun logo para publicar, adjunta una imagen."
            ], 404);
        }

        $published = $data_valid["published"];
        $logo->update([
            "published" => $published,
        ]);

        $public = $published ? "publicado" : "privatizado";

        return response()->json([
            "message" => "Logo {$public} correctamente."
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

        // * NUEVO NOMBRE DE LA IMAGEN (ESTO LO HACEMOS PARA QUE NO SE REPITAN LOS NOMBRES DE LAS IMAGENES)
        $new_name_image = uniqid() . now()->timestamp . ".png";

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

    public function published_info_primary_async(Type $var = null)
    {
        $data_valid = request()->validate([
            "published" => "required"
        ]);

        $info_primary = InfoPrimary::first();

        if (!$info_primary) {
            return response()->json([
                "message" => "No hay información registrada, registra un titulo o una descripcion."
            ], 404);
        }

        $published = $data_valid["published"];
        $info_primary->update([
            "published" => $published,
        ]);

        $public = $published ? "publicada" : "privatizada";

        return response()->json([
            "message" => "Información {$public} correctamente"
        ]);
    }

    public function contact_info_async(Request $request)
    {
        $contact_info = ContactInfo::first();

        $data_valid = request()->validate([
            "location" => "required|string|max:191",
            "email" => "required|email|unique:contact_infos,email," . ($contact_info->id ?? 0)  . ",id|max:191",
            "phone" => "required|string|max:191",
            "whatsapp_url" => "required|url|string|max:191"
        ]);

        $data_insert = [
            "location" => $data_valid["location"],
            "email" => $data_valid["email"],
            "phone_number" => $data_valid["phone"],
            "whatsapp_url" => $data_valid["whatsapp_url"],
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
        $data_valid = request()->validate([
            "url" => "required|string|url|max:191|unique:social_media,url",
            "icon" => "required|string|max:191",
        ]);

        $data_insert = [
            "url" => $data_valid["url"],
            "icon" => $data_valid["icon"],
        ];

        $social_media = SocialMedia::create($data_insert);
        $social_media["routeUpdate"] = $social_media->routeUpdate;
        $social_media["routeDelete"] = $social_media->routeDelete;
        $social_media["routeGetSocialMedia"] = $social_media->routeGetSocialMedia;

        return response()->json([
            "social_media" => $social_media,
            "message" => "La red social se ha registrado correctamente."
        ]);
    }

    public function get_social_media_async(SocialMedia $social_media)
    {
        $social_media["routeUpdate"] = $social_media->routeUpdate;
        $social_media["routeDelete"] = $social_media->routeDelete;
        $social_media["routeGetSocialMedia"] = $social_media->routeGetSocialMedia;

        return response()->json([
            "social_media" => $social_media
        ]);
    }

    public function update_social_media_async(SocialMedia $social_media)
    {
        $data_valid = request()->validate([
            "url" => "required|string|url|max:191|unique:social_media,url," . $social_media->id . ",id",
            "icon" => "required|string|max:191",
        ]);

        $data_insert = [
            "url" => $data_valid["url"],
            "icon" => $data_valid["icon"],
        ];

        $social_media->update($data_insert);

        return response()->json([
            "social_media" => $social_media,
            "message" => "Actualizado correctamente"
        ]);
    }

    public function delete_social_media_async(SocialMedia $social_media)
    {
        $social_media->delete();

        return response()->json([
            "message" => "Red social eliminada correctamente",
        ]);
    }
}
