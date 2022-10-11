<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    use HasFactory;

    protected $fillable = ["url", "user_id"];

    public function getLogoRouteStorageAttribute()
    {
        return asset("storage/" . $this->url);
    }
}
