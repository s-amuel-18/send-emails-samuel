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
    public const PAGINATE = 10;

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

    public function scopeLastEmailToday($q)
    {
        return $q->enviadosHoy();
    }

    public function scopeSinEnviar($q)
    {
        return $q->whereHas("envios", null, "=", 0)
            ->whereNotNull("email");
    }

    public function scopeEnviados($q)
    {
        return $q->whereHas("envios", null, ">", 0)
            ->whereNotNull("email");
    }

    public function scopeEnviadosHoy($q)
    {
        return $q->enviados()->whereHas("envios", function ($q) {
            $q->whereDate("contact_email_user.created_at", Carbon::today());
        });
    }

    public function scopeLimitDaily($q)
    {
        return $q->sinEnviar()->take($this::DAILY_EMAIL_LIMIT);
    }

    public function scopeSearchLike($q, $search)
    {
        return $q->where(function ($query) use ($search) {
            $query->where("nombre_empresa", "like", "%$search%")
                ->orWhere("url", "like", "%$search%")
                ->orWhere("email", "like", "%$search%")
                ->orWhereHas("usuario", function ($q) use ($search) {
                    $q->where("username", "like", "%$search%");
                });
        });
    }

    public function scopeEmailValid($q)
    {
        return $q->whereNotNull("email");
    }

    public function groupBySendEmail($user, $id_email, $desc = null)
    {
        $contact = Contact_email::find($id_email);

        if (!$contact or (!isset($contact->email) or !$contact->email)) {
            return null;
        }

        $query = DB::table("contact_email_user")
            ->where("user_id", $user)
            ->where("contact_email_id", $id_email)
            ->take(1);

        $contact_email_user_last = $query->first();

        // dump($contact_email_user_last);

        if (!$contact_email_user_last) {
            return null;
        }
        $max_group_send_register = DB::table("contact_email_user")->max("group_send");

        $group_send_last_contact = $max_group_send_register ?? 1;


        $count_contacts_for_group = DB::table("contact_email_user")->where("group_send", $group_send_last_contact)->count();

        $hours_last_email = Carbon::parse($contact_email_user_last->created_at);

        $now = Carbon::now();

        $diffHours = $hours_last_email->diffInHours($now);
        // dump("count_contacts_for_group: " . $count_contacts_for_group . " diffHours: " . $diffHours);
        $group_send = ($count_contacts_for_group >= Contact_email::DAILY_EMAIL_LIMIT && $diffHours >= 24)
            ? intval($group_send_last_contact) + 1
            : $group_send_last_contact;

        $data_insert = [
            "group_send" => $group_send
        ];

        if ($desc) {
            $data_insert["subject"] = $desc["subject"];
            $data_insert["body"] = $desc["body"];
        }

        $query->update($data_insert);


        return $group_send;
    }
}
