<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailEnviado extends Model
{
    use HasFactory;
    public const DAILY_EMAIL_LIMIT = 100;

    protected $fillable = [
        'user_id',
        'contact_email_id'
    ];

    public function usuario()
    {
        return $this->belognsTo(User::class, "contact_email_id");
    }
}
