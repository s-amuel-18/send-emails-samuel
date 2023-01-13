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

    /* 
    88""Yb 888888 88        db     dP""b8 88  dP"Yb  88b 88 888888 .dP"Y8
    88__dP 88__   88       dPYb   dP   `" 88 dP   Yb 88Yb88 88__   `Ybo."
    88"Yb  88""   88  .o  dP__Yb  Yb      88 Yb   dP 88 Y88 88""   o.`Y8b
    88  Yb 888888 88ood8 dP""""Yb  YboodP 88  YbodP  88  Y8 888888 8bodP'    
     */

    public function emails_registros()
    {
        return $this->hasMany(Contact_email::class, "user_id");
    }

    public function testimonies()
    {
        return $this->hasMany(Testimony::class, "user_id");
    }

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

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function pay()
    {
        return $this->hasMany(Pay::class, "user_id");
    }

    public function history_pay()
    {
        return $this->hasMany(HistoryPayments::class, "user_id");
    }
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /*     
        88""Yb 888888 88        db     dP""b8 88  dP"Yb  88b 88 888888 .dP"Y8     888888 88 88b 88
        88__dP 88__   88       dPYb   dP   `" 88 dP   Yb 88Yb88 88__   `Ybo."     88__   88 88Yb88
        88"Yb  88""   88  .o  dP__Yb  Yb      88 Yb   dP 88 Y88 88""   o.`Y8b     88""   88 88 Y88
        88  Yb 888888 88ood8 dP""""Yb  YboodP 88  YbodP  88  Y8 888888 8bodP'     88     88 88  Y8
     */

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
