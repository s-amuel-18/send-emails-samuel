<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;

    protected $fillable = ["user_id", "url", "icon"];

    // * scope 
    public function scopeComplete($query)
    {
        return $query->whereNotNull("icon")->whereNotNull("url");
    }
    // * scope end

    // * attribute 
    public function getRouteUpdateAttribute()
    {
        return route("settings.update_social_media_async", ["social_media" => $this->id]);
    }

    public function getRouteDeleteAttribute()
    {
        return route("settings.delete_social_media_async", ["social_media" => $this->id]);
    }

    public function getRouteGetSocialMediaAttribute()
    {
        return route("settings.get_social_media_async", ["social_media" => $this->id]);
    }
    // * attribute end 
}
