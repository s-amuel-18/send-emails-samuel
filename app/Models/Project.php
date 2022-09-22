<?php

namespace App\Models;

use App\Models\Image as ModelsImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", "name", "slug", "published", "image_front_page", "description", "trash"
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
        return $this->morphMany(ModelsImage::class, "imageable");
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
        return $q->where("eraser", 0)->where("trash", 1);
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
        $images = $request->file("images");

        $slug_name = $this->slug;

        // * VALIDAMOS QUE LA IMAGEN "image_front_page" FUE  SUBIDA CORRECTAMENTE
        if ($image_front_page) {
            // * REDIMENCIONAMOS LA IMG DE PORTADA
            $img_front_fit = Image::make($image_front_page)->fit(300, 180);

            // * CREAMOS EL NOMBRE DE LA IMAGEN
            $name_img_front_fit = "storage/" . $slug_name . "-front-image-project-" . now()->timestamp . "-" . uniqid() . ".jpg";

            // * GUARDAMOS LA IMAGEN EN EL STORAGE
            $img_front_fit->save($name_img_front_fit);

            // * AGREGAMOS LA RUTA DE LA IMAGEN AL PROYECTO
            $this->image_front_page = $name_img_front_fit;

            // * GUARDAMOS TODOS LOS CAMBIOS
            $this->save();
        }

        // * VALIDAMOS QUE LAS IMAGENES "images" SE HALLAN ENVIANDO EN EL OBJETO REQUEST
        if ($images and count($images ?? []) > 0) {
            foreach ($images as $img) {
                // * REDIMENCIONAMOS LA IMG DE PORTADA
                $img_project = Image::make($img)->fit(600, 360);

                // * CREAMOS EL NOMBRE DE LA IMAGEN
                $name_img_project = $slug_name . "-img-project-" . now()->timestamp . "-" . uniqid() . $this->id . ".jpg";

                // * RUTA DE LA IMAGEN
                $route_img_project = "storage/" . $name_img_project;

                // * GUARDAMOS LA IMAGEN EN EL STORAGE
                $img_project->save($route_img_project);

                $img_insert = $this->images()->create([
                    "url" => $route_img_project
                ]);
            }
        }
    }

    // * NOS PERMITE CREAR LOS ITEMS HELPER Y AÑADIRLOS AL PROYECTO
    public function create_items_helper($items)
    {
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

    /* 
           db    888888 888888 88""Yb 88 88""Yb 88   88 888888 888888     888888 88 88b 88
          dPYb     88     88   88__dP 88 88__dP 88   88   88   88__       88__   88 88Yb88
         dP__Yb    88     88   88"Yb  88 88""Yb Y8   8P   88   88""       88""   88 88 Y88
        dP""""Yb   88     88   88  Yb 88 88oodP `YbodP'   88   888888     88     88 88  Y8
      */
}
