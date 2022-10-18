<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        "location", "location_alt", "phone_number", "phone_number_alt", "email",
        "email_alt"
    ];
}
