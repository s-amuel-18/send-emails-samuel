<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryService extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "icon_class",
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
