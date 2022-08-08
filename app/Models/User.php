<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function emails_registros()
    {
        return $this->hasMany(Contact_email::class, "user_id");
    }

    // public function emailEnviado()
    // {
    //     return $this->hasMany(EmailEnviado::class, "user_id");
    // }

    public function emailEnviado()
    {
        return $this->belongsToMany(Contact_email::class)->withPivot('created_at');
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function categories()
    {
        return $this->hasMany(CategoryService::class);
    }

    public function correos_enviados_hoy()
    {
        return DB::table("contact_email_user")->whereDate("created_at", Carbon::today())->count();
    }

    public function correos_por_enviar_hoy()
    {
        return Contact_email::DAILY_EMAIL_LIMIT - $this->correos_enviados_hoy();
    }

    public function validSendEmailDaily()
    {
        return $this->correos_enviados_hoy() < Contact_email::DAILY_EMAIL_LIMIT;
    }

    public function lastEmailSend()
    {
        return DB::table("contact_email_user")->orderBy("created_at", "DESC")->first();
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

        return $colors[$this->id];
    }
}
