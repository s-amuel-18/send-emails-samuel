<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact_email extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre_empresa',
        'url',
        'estado',
        'email',
        'whatsapp',
        'instagram',
        'facebook',
        'descripcion',
    ];


    public function usuario()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
