<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirements extends Model
{
    use HasFactory;

    public function categoriable()
    {
        return $this->morphMany(Category::class, "catgoriable");
    }
}
