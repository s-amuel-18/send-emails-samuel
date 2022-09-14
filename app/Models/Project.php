<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

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
        return $this->morphMany(Image::class, "imageable");
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
}
