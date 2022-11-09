<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image as ModelsImage;
use Carbon\Carbon;
use Illuminate\Support\Str;

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
        "status_send",
    ];

    // * relaciones
    public function image()
    {
        return $this->morphOne(ModelsImage::class, "imageable")->whereNotNull("url");
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // * relaciones end

    // * scopes
    public function scopeComplete($q)
    {
        return $q->whereNotNull("name")
            ->whereNotNull("rating")
            ->whereNotNull("review");
    }

    public function scopePublished($q)
    {
        return $this->complete()->where("published", 1);
    }

    public function scopeSearch($q, $search)
    {
        return $q->where(function ($query) use ($search) {
            return $query->where("name", "like", "%" . $search . "%")
                ->orWhere("position", "like", "%" . $search . "%")
                ->orWhere("rating", "like", "%" . $search . "%")
                ->orWhere("title", "like", "%" . $search . "%")
                ->orWhere("review", "like", "%" . $search . "%");
        });
    }

    public function scopeRequestTestimony($q)
    {
        $testimony_token = self::whereNotNull("token")->where("status_send", 0)->count();

        if ($testimony_token == 0) {
            Testimony::create([
                "token" => Str::random(60) . "-" . now()->timestamp,
            ]);
        }

        return $q->whereNotNull("token")->where("status_send", 0);
    }
    // * scopes
}
