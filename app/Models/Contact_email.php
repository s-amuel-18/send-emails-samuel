<?php

namespace App\Models;

use App\Mail\ServicioMaillable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Contact_email extends Model
{
    use HasFactory;

    public const DAILY_EMAIL_LIMIT = 100;

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

    public function envios()
    {
        return $this->belongsToMany(User::class)->withPivot('created_at');
    }

    // public function envios()
    // {
    //     return $this->hasMany(EmailEnviado::class, "contact_email_id");
    // }

    public function ultimo_correo_enviado()
    {
        return DB::table("contact_email_user")->orderBy("created_at", "DESC")->first();
    }

    public function correos_enviados_hoy()
    {
        return DB::table("contact_email_user")->whereDate("created_at", Carbon::today())->count();
    }

    public function sendInformationEmail($info)
    {
        $correo = new ServicioMaillable($info, $this);
        Mail::to($this->email)->send($correo);
    }

    public function scopeToday($q)
    {
        return $q->whereDate("created_at", Carbon::today());
    }

    public function scopeSinEnviar($q)
    {
        return $q->whereHas("envios", null, "=", 0)
            ->where("estado", "=", 0)
            ->whereNotNull("email");
    }

    public function scopeLimitDaily($q)
    {
        return $q->sinEnviar()->take($this::DAILY_EMAIL_LIMIT);
    }
}
