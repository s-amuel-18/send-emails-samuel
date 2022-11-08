<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    use HasFactory;

    protected $fillable = ["url", "user_id", "published"];

    public function getLogoRouteStorageAttribute()
    {
        return asset("storage/" . $this->url);
    }

    public function scopePublished($q)
    {
        return $q->where("published", 1);
    }
}
