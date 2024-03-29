<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "user_id", "category_id", "description", "trash", "favorite"
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
