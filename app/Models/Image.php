<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
