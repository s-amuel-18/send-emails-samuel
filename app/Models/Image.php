<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image as ItenrventionImage;
use Illuminate\Support\Str;

class Image extends Model
{
  use HasFactory;

  protected $fillable = ["url", "imageable_id", "imageable_type"];


  /* 
           db    888888 888888 88""Yb 88 88""Yb 88   88 888888 888888
          dPYb     88     88   88__dP 88 88__dP 88   88   88   88__
         dP__Yb    88     88   88"Yb  88 88""Yb Y8   8P   88   88""
        dP""""Yb   88     88   88  Yb 88 88oodP `YbodP'   88   888888
     */


  public function getOriginalNameFrontImageAttribute()
  {
    return $this->url ? str_replace("storage/", "", $this->url) : null;
  }

  /* 
           db    888888 888888 88""Yb 88 88""Yb 88   88 888888 888888     888888 88 88b 88
          dPYb     88     88   88__dP 88 88__dP 88   88   88   88__       88__   88 88Yb88
         dP__Yb    88     88   88"Yb  88 88""Yb Y8   8P   88   88""       88""   88 88 Y88
        dP""""Yb   88     88   88  Yb 88 88oodP `YbodP'   88   888888     88     88 88  Y8
      */


  //   * FUNCTIONS 

  static public function store_image($img, $resize, $folder)
  {
    if (!$img or !$folder) return null;

    // * NUEVO NOMBRE DE LA IMAGEN (ESTO LO HACEMOS PARA QUE NO SE REPITAN LOS NOMBRES DE LAS IMAGENES)
    $new_name_image = uniqid() . now()->timestamp . ".png";

    // * GUARDAMOS LA IMAGEN EN EL STOREAGE
    $img->storeAs("public/{$folder}", $new_name_image);
    $route_file = "{$folder}/" . $new_name_image;

    // * PATH DEL ARCHIVO GURDADO
    $storage_path = storage_path("app/public/" . $route_file);

    $img_store = ItenrventionImage::make($storage_path);

    if ($resize["fit"]) {
      $fit = $resize["fit"];
      $img_store->fit($fit["fit_x"] ?? null, $fit["fit_y"] ?? null);
    }

    // * GUARDAMOS LA IMAGEN EN EL STORAGE
    $img_store->save();

    return $route_file;
  }

  //   * FUNCTIONS END

  public function getRouteAttribute()
  {
    return $this->url ? asset("storage/" . $this->url) : null;
  }
}
