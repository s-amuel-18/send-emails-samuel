<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        "location", "location_alt", "phone_number", "phone_number_alt", "email",
        "email_alt", "whatsapp_url"
    ];

    // * scopes
    public function scopeComplete($q)
    {
        return $q->whereNotNull("location")->whereNotNull("phone_number")->whereNotNull("email");
    }
    // * scopes end
}
