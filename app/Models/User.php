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
use Illuminate\Support\Str;

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
        return $this->belongsToMany(Contact_email::class)->where("type", Contact_email::MAIL)->withPivot('created_at');
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function requirements()
    {
        return $this->hasMany(Requirements::class);
    }


    public function correos_enviados_hoy()
    {
        return $this->emailsSent24HoursAgo();
    }

    public function emailsSent24HoursAgo()
    {
        $max_group_send_register = DB::table("contact_email_user")->max("group_send");

        $dataDo24Hours = Carbon::now()->subHours(24);
        $dateNow = Carbon::now();

        $last_mail = DB::table("contact_email_user")
            ->where("group_send", $max_group_send_register)
            ->orderBy("created_at", "DESC")
            ->take(1)
            ->first();

        if ($last_mail) {
            $diifHours = Carbon::parse($last_mail->created_at)->diffInHours($dateNow);

            if ($diifHours >= 24) {
                $emailsDo24Hours = 0;
            } else {
                $emailsDo24Hours = DB::table("contact_email_user")
                    ->where("group_send", $max_group_send_register)
                    ->count();
            }
        } else {
            $emailsDo24Hours = DB::table("contact_email_user")
                ->whereBetween("created_at", [$dataDo24Hours, $dateNow])
                ->count();
        }

        return $emailsDo24Hours;
    }

    public function correos_por_enviar_hoy()
    {
        return Contact_email::DAILY_EMAIL_LIMIT - $this->correos_enviados_hoy();
    }

    public function validSendEmailDaily()
    {
        return $this->emailsSent24HoursAgo() < Contact_email::DAILY_EMAIL_LIMIT;
    }

    public function lastEmailSend()
    {
        return DB::table("contact_email_user")->orderBy("created_at", "DESC")->first();
    }

    public function color_by_id()
    {
        $colors = [
            "blue",
            "info",
            "purple",
            "pink",
            "red",
            "orange",
            "yellow",
            "green",
            "teal",
            "cyan",
        ];

        return $colors[substr($this->id, -1)];
    }

    public function getColorAttribute()
    {
        return $this->color_by_id();
    }
}
