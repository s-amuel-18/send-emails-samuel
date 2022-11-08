<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoPrimary extends Model
{
    use HasFactory;

    protected $fillable = ["url", "title", "description", "published"];

    // * attributes
    public function getRouteImgAttribute()
    {
        return $this->url ?? null ? asset("storage/" . $this->url) : null;
    }
    // * attributes end

    public function scopePublished($q)
    {
        return $q->where("published", 1);
    }
}
