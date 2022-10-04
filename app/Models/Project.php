<?php

namespace App\Models;

use App\Models\Image as ModelsImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", "name", "slug", "published", "image_front_page", "description", "trash", "eraser"
    ];

    /* 
    88""Yb 888888 88        db     dP""b8 88  dP"Yb  88b 88 888888 .dP"Y8
    88__dP 88__   88       dPYb   dP   `" 88 dP   Yb 88Yb88 88__   `Ybo."
    88"Yb  88""   88  .o  dP__Yb  Yb      88 Yb   dP 88 Y88 88""   o.`Y8b
    88  Yb 888888 88ood8 dP""""Yb  YboodP 88  YbodP  88  Y8 888888 8bodP'    
     */

    // ? usuario creador del proyecto
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    // ? imagenes del proyecto
    public function images()
    {
        return $this->morphMany(ModelsImage::class, "imageable")->whereNotNull("url");
    }

    public function itemHelp()
    {
        return $this->morphMany(ItemHelp::class, "helpeable");
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /*     
        88""Yb 888888 88        db     dP""b8 88  dP"Yb  88b 88 888888 .dP"Y8     888888 88 88b 88
        88__dP 88__   88       dPYb   dP   `" 88 dP   Yb 88Yb88 88__   `Ybo."     88__   88 88Yb88
        88"Yb  88""   88  .o  dP__Yb  Yb      88 Yb   dP 88 Y88 88""   o.`Y8b     88""   88 88 Y88
        88  Yb 888888 88ood8 dP""""Yb  YboodP 88  YbodP  88  Y8 888888 8bodP'     88     88 88  Y8
     */


    /* 
        .dP"Y8  dP""b8  dP"Yb  88""Yb 888888
        `Ybo." dP   `" dP   Yb 88__dP 88__
        o.`Y8b Yb      Yb   dP 88"""  88""
        8bodP'  YboodP  YbodP  88     888888        
    */

    public function scopeComplete($q)
    {
        return $q->where("eraser", 0)->where("trash", 0);
    }

    public function scopeTrash($q)
    {
        return $q->where("trash", 1);
    }

    public function scopeEraser($q)
    {
        return $q->where("eraser", 1)->where("trash", 0);
    }

    public function scopeWhereSlug($q, $slug)
    {

        if (!$slug) return null;

        return $q->where("slug", $slug);
    }

    /* 
        .dP"Y8  dP""b8  dP"Yb  88""Yb 888888     888888 88 88b 88
        `Ybo." dP   `" dP   Yb 88__dP 88__       88__   88 88Yb88
        o.`Y8b Yb      Yb   dP 88"""  88""       88""   88 88 Y88
        8bodP'  YboodP  YbodP  88     888888     88     88 88  Y8
     */


    /* 
        888888 88   88 88b 88  dP""b8 88  dP"Yb  88b 88 888888 .dP"Y8
        88__   88   88 88Yb88 dP   `" 88 dP   Yb 88Yb88 88__   `Ybo."
        88""   Y8   8P 88 Y88 Yb      88 Yb   dP 88 Y88 88""   o.`Y8b
        88     `YbodP' 88  Y8  YboodP 88  YbodP  88  Y8 888888 8bodP'
      */

    // * NOS PERMITE CREAR LAS IMAGENES Y REDIMENCIONARLAS (LAS AÑADE AL PROYECTO) 
    public function create_and_resize_images($request /* esta variable viene de formulario de envio */)
    {
        if (!$request) return null;
        $image_front_page = $request->file("image_front_page");

        $slug_name = $this->slug;

        // * VALIDAMOS QUE LA IMAGEN "image_front_page" FUE  SUBIDA CORRECTAMENTE
        if ($image_front_page) {

            // * NOMBRE ORIGINAL DE LA IMAGEN
            $name_image = $image_front_page->getClientOriginalName();

            // * NUEVO NOMBRE DE LA IMAGEN (ESTO LO HACEMOS PARA QUE NO SE REPITAN LOS NOMBRES DE LAS IMAGENES)
            $new_name_image = uniqid() . now()->timestamp . "-" . $name_image;

            // * GUARDAMOS LA IMAGEN EN EL STOREAGE
            $image_front_page->storeAs("public/projects", $new_name_image);
            $route_file = "projects/" . $new_name_image;

            // * PATH DEL ARCHIVO GURDADO
            $storage_path = storage_path("app/public/" . $route_file);

            // * REDIMENCIONAMOS LA IMG 
            $img_front_fit = Image::make($storage_path)->fit(600, 360);

            // * GUARDAMOS LA IMAGEN EN EL STORAGE
            $img_front_fit->save();

            // * AGREGAMOS LA RUTA DE LA IMAGEN AL PROYECTO
            $this->image_front_page = $route_file;

            // * GUARDAMOS TODOS LOS CAMBIOS
            $this->save();
        }

        // * VALIDAMOS QUE LAS IMAGENES "images" SE HALLAN ENVIANDO EN EL OBJETO REQUEST
        // ! ESTO SE QUEDA COMENTADO PORQUE YA SE GENERÓ UNA FUNCIONALIDAD MAS EFECTIVA, PERO NO SE QUIERE PERDER EL TRABAJO REALIZADP
        // $images = $request->file("images");
        // if ($images and count($images ?? []) > 0) {
        //     foreach ($images as $img) {
        //         // * REDIMENCIONAMOS LA IMG DE PORTADA
        //         $img_project = Image::make($img)->fit(600, 360);

        //         // * CREAMOS EL NOMBRE DE LA IMAGEN
        //         $name_img_project = $slug_name . "-img-project-" . now()->timestamp . "-" . uniqid() . $this->id . ".jpg";

        //         // * RUTA DE LA IMAGEN
        //         $route_img_project = "storage/" . $name_img_project;

        //         // * GUARDAMOS LA IMAGEN EN EL STORAGE
        //         $img_project->save($route_img_project);

        //         $img_insert = $this->images()->create([
        //             "url" => $route_img_project
        //         ]);
        //     }
        // }
    }

    // * NOS PERMITE CREAR LOS ITEMS HELPER Y AÑADIRLOS AL PROYECTO
    public function create_items_helper($items)
    {
        // * vemos si el proyecto cuenta con items asociados
        // ? lo que se busca hacer es eliminar los items help que estén asociados al proyecto para posteriormente crear los nuevos items y asociarlos
        $items_help_project = $this->itemHelp()->count();
        if ($items_help_project > 0) {
            $this->itemHelp()->delete();
        }

        // * VALIDAMOS QUE HALLAN ITEMS HELPERS
        if (!$items or count($items) < 1) return false;

        $items_helper = collect($items);

        // * ESTE MAPEO NOS PERMITE HACER UN ARRAY DE INFORMACION MAS CUSTOMIZADO, ESTO NOS PERMITE UNA MEJOR MANIPULACION DE LA INFORMACION
        $new_arr_items = collect($items_helper["name"])->map(function ($item, $i) use ($items_helper) {
            $new_arr = [
                "name" => $items_helper["name"][$i],
                "description" => $items_helper["description"][$i],
                "template" => $items_helper["template"][$i],
            ];

            $this->itemHelp()->create($new_arr);

            return $new_arr;
        });

        return $new_arr_items;
    }

    public function deleteFronImage()
    {
        $name_front_image = $this->originalNameFrontImage;

        // * SI HAY UNA IMAGEN COMO BANNER DEL PROYECTO
        if ($name_front_image) {

            // * SI EXISTE UNA IMAGEN EN EL STORAGE
            if (Storage::exists("public/" . $name_front_image)) {

                // * ELIMINAMOS IMAGEN
                Storage::delete("public/" . $name_front_image);

                // * NULL FRONT IMAGE
                $this->update([
                    "image_front_page" => null
                ]);
            }
        }
    }

    public function deleteAllImages()
    {
        $name_front_image = $this->originalNameFrontImage;

        // * SI HAY UNA IMAGEN COMO BANNER DEL PROYECTO
        if ($name_front_image) {

            // * SI EXISTE UNA IMAGEN EN EL STORAGE
            if (Storage::exists("public/" . $name_front_image)) {

                // * ELIMINAMOS IMAGEN
                Storage::delete("public/" . $name_front_image);

                // * NULL FRONT IMAGE
                $this->update([
                    "image_front_page" => null
                ]);
            }
        }

        // * IMAGENES ASOCIADAS AL PROYECTO 
        $images_project = $this->images; // ? array

        $images_project->each(function ($image) {
            $name_image = $image->originalNameFrontImage;
            // * SI HAY UNA IMAGEN COMO BANNER DEL PROYECTO
            if ($name_image) {
                // * SI EXISTE UNA IMAGEN EN EL STORAGE
                if (Storage::exists("public/" . $name_image)) {

                    // * ELIMINAMOS IMAGEN
                    Storage::delete("public/" . $name_image);
                }
            }
        });
    }

    public function create_slug()
    {
        // * VALIDACION PARA CREAR EL SLUG NAME POSTERIORMENTE
        if ($this->name ?? false) {
            // * ESTA VARIABLE NOS PERMITE AUMENTAR SU VALOR EN CASO DE QUE EL SLUG GENERADO YA ESTÉ EN USO
            $loops = 0;

            do {

                // * SI LA VARIABLE AUXILIAR YA HA SIDO AUMENTADA GENERAREMOS UN SLUG MAS PRODUCIDO, DE FORMA QUE NO SE REPITAN SLUGS
                if ($loops > 0) {

                    // * GENERAMOS EL SLUG NAME MAS ESPECIFICO
                    $slug_name = Str::slug($this->name) . "-" . uniqid();
                } else {

                    // * GENERAMOS EL SLUG NAME
                    $slug_name = Str::slug($this->name);
                }

                // * CANTIDAD DE PROYETOS CON EL SLUG NAME CREADO
                $projects_count = Project::whereSlug($slug_name)->count();

                // * EN CASO DE QUE EXISTA ALGUN PROYECTO CON EL SLUG NAME GENERADO
                if ($projects_count > 0) {
                    // * AUMENTANIS EK VALOR DE LA VARIABLE AUXILIAR
                    $loops += 1;
                }
            } while ($projects_count > 0);

            // * AGREGAMOS EL SLUG AL PROYECTO
            $this->slug = $slug_name;
            $this->save();
        }
    }

    static public function projectsStatus()
    {
        return [
            "trash_projects" => Project::trash()->count(),
            "eraser_projects" => Project::eraser()->count(),
            "complete_projects" => Project::complete()->count(),
        ];
    }

    /* 
        888888 88   88 88b 88  dP""b8 88  dP"Yb  88b 88 888888 .dP"Y8     888888 88 88b 88
        88__   88   88 88Yb88 dP   `" 88 dP   Yb 88Yb88 88__   `Ybo."     88__   88 88Yb88
        88""   Y8   8P 88 Y88 Yb      88 Yb   dP 88 Y88 88""   o.`Y8b     88""   88 88 Y88
        88     `YbodP' 88  Y8  YboodP 88  YbodP  88  Y8 888888 8bodP'     88     88 88  Y8      
       */

    /* 
           db    888888 888888 88""Yb 88 88""Yb 88   88 888888 888888
          dPYb     88     88   88__dP 88 88__dP 88   88   88   88__
         dP__Yb    88     88   88"Yb  88 88""Yb Y8   8P   88   88""
        dP""""Yb   88     88   88  Yb 88 88oodP `YbodP'   88   888888
     */

    public function getRouteTrashAttribute()
    {
        return route('project.trash', ['project' => $this->id]);
    }

    public function getRouteDeleteAttribute()
    {
        return route('project.destroy', ['project' => $this->id]);
    }

    public function getOriginalNameFrontImageAttribute()
    {
        return $this->image_front_page ? str_replace("storage/", "", $this->image_front_page) : null;
    }

    /* 
           db    888888 888888 88""Yb 88 88""Yb 88   88 888888 888888     888888 88 88b 88
          dPYb     88     88   88__dP 88 88__dP 88   88   88   88__       88__   88 88Yb88
         dP__Yb    88     88   88"Yb  88 88""Yb Y8   8P   88   88""       88""   88 88 Y88
        dP""""Yb   88     88   88  Yb 88 88oodP `YbodP'   88   888888     88     88 88  Y8
      */
}
