<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image as ModelsImage;

class Testimony extends Model
{
    use HasFactory;

    protected $fillable = [
        "uuid",
        "token",
        "user_id",
        "image_id",
        "name",
        "position",
        "rating",
        "title",
        "review",
        "published",
    ];

    // * relaciones
    public function image()
    {
        return $this->morphOne(ModelsImage::class, "imageable")->whereNotNull("url");
    }
    // * relaciones end

    // * scopes
    public function scopeComplete($q)
    {
        return $q->whereNotNull("name")
            ->whereNotNull("rating")
            ->whereNotNull("review");
    }
    // * scopes
}
