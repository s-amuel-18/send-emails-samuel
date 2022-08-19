<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "user_id", "catgoriable_type"
    ];

    public function scopeRequirements($q)
    {
        return $q->where("catgoriable_type", Requirements::class);
    }

    public function color_by_id()
    {
        $colors = [
            "blue",
            "indigo",
            "purple",
            "pink",
            "red",
            "orange",
            "yellow",
            "green",
            "teal",
            "cyan",
        ];

        return $colors[substr($this->id, -1)];
    }

    public function getColorAttribute()
    {
        return $this->color_by_id();
    }
}
