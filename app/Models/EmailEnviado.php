<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailEnviado extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'contact_email_id'
    ];

    public function usuario()
    {
        return $this->belognsTo(User::class, "contact_email_id");
    }
}
