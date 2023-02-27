<?php

namespace App\Models;

use App\Mail\ServicioMaillable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Contact_email extends Model
{
    public const PAGINATE = 10;

    use HasFactory;

    public const DAILY_EMAIL_LIMIT = 100;
    // types contact
    public const MAIL = 0;
    public const WHATSAPP = 1;
    public const FACEBOOK = 2;
    public const INSTAGRAM = 3;

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
        return $this->belongsToMany(User::class)->where("type", $this::MAIL)->withPivot('created_at');
    }

    public function envios_whatsapp()
    {

        return $this->belongsToMany(User::class)->where("type", $this::WHATSAPP)->withPivot('created_at');
    }

    public function envios_facebook()
    {
        return $this->belongsToMany(User::class)->where("type", $this::FACEBOOK)->withPivot('created_at');
    }

    public function envios_instagram()
    {
        return $this->belongsToMany(User::class)->where("type", $this::INSTAGRAM)->withPivot('created_at');
    }

    public function type_alternative($type = 0)
    {
        $arr_relations = [
            $this::MAIL => $this->envios(),
            $this::WHATSAPP => $this->envios_whatsapp(),
            $this::FACEBOOK => $this->envios_facebook(),
            $this::INSTAGRAM => $this->envios_instagram(),
        ];
        return $arr_relations[$type];
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

    public function scopeTypeMail($q)
    {
        return $q->where("type", $this::MAIL);
    }

    public function groupBySendEmail($user, $id_email, $desc = null)
    {
        // verificamos que el registro existe en "Contact_email"
        $contact = Contact_email::find($id_email);
        // validamos que el registro no sea nulo
        if (!$contact or (!isset($contact->email) or !$contact->email)) {
            return null;
        }

        // seleccionamos el ultimo registro de envio de email, esto lo hacemos para tomar el ultimo envio que se hizo y posteriormente actualizarlo con los datos correspondientes
        $query = DB::table("contact_email_user")
            ->where("user_id", $user)
            ->where("contact_email_id", $id_email)
            ->orderBy("created_at", "DESC")
            ->take(1);

        // seleccionamos el registro
        $contact_email_user_last = DB::table("contact_email_user")
            ->whereNotNull("group_send")
            ->orderBy("created_at", "DESC")
            ->first();

        // seleccionamos el group send mas alto
        $max_group_send_register = DB::table("contact_email_user")->max("group_send");

        // validamos que en caso de que el group send sea nulo, lo convertimos en 1
        $group_send_last_contact = $max_group_send_register ?? 1;

        // contamos la cantidad de emails que se han enviado con ese numero de group send
        $count_contacts_for_group = DB::table("contact_email_user")->where("group_send", $group_send_last_contact)->count();
        // validamos que venga una descripcion
        if ($desc) {
            $data_insert["subject"] = $desc["subject"];
            $data_insert["body"] = $desc["body"];
        }

        // validamos que el registro exista
        if (!$contact_email_user_last) {
            $data_insert["group_send"] = 1;
            $query->update($data_insert);

            return null;
        }


        //  tomamos la hora del ultimo emails enviado
        $hours_last_email = Carbon::parse($contact_email_user_last->created_at);


        $now = Carbon::now();
        // diferencia entre la hora actual y el ultimo email enviado
        $diffHours = $hours_last_email->diffInHours($now);

        // creamos el group send "grupo de envio"
        $group_send = ($count_contacts_for_group >= Contact_email::DAILY_EMAIL_LIMIT && $diffHours >= 24)
            ? intval($group_send_last_contact) + 1
            : $group_send_last_contact;

        $data_insert["group_send"] = $group_send;

        $query->update($data_insert);

        return $group_send;
    }

    public function datatableContactEmailQuery()
    {
        $user = auth()->user();
        $rol_estadisticas = $user->can("contact_email.estadisticas");

        $query = Contact_email::select(
            "contact_emails.id AS contact_id",
            "contact_emails.url",
            "contact_emails.nombre_empresa",
            "contact_emails.estado",
            "contact_emails.email AS contact_email",
            "contact_emails.whatsapp",
            "contact_emails.instagram",
            "contact_emails.facebook",
            "contact_emails.user_id",
            "contact_emails.created_at AS contact_created",
            "contact_emails.updated_at AS contact_updated",
            "us.username"
        )
            ->withCount("envios")
            ->withCount("envios_whatsapp")
            ->withCount("envios_facebook")
            ->withCount("envios_instagram")
            ->leftJoin("users AS us", function ($j) {
                $j->on("contact_emails.user_id", "=", "us.id")
                    ->whereNotNull("us.created_at");
            });

        if (!$rol_estadisticas) {
            $query->where("contact_emails.user_id", $user->id);
        }

        return $query;
    }

    public function datatableEmailsSendQuery()
    {
        return DB::table('contact_email_user')
            ->select(
                "contact_email_user.id AS send_id",
                "contact_email_user.user_id",
                "contact_email_user.created_at AS shipping_created",
                "contact_email_user.subject",
                "contact_email_user.body",
                "contact_email_user.group_send",
                "us.username",
                "cm.email AS contact_email",
            )
            ->leftJoin("users AS us", function ($j) {
                $j->on("us.id", "=", "contact_email_user.user_id")
                    ->whereNull("us.deleted_at");
            })
            ->leftJoin("contact_emails AS cm", function ($j) {
                $j->on("cm.id", "=", "contact_email_user.contact_email_id")
                    ->whereNull("cm.deleted_at");
            })
            ->where("type", $this::MAIL)
            ->whereNull("contact_email_user.deleted_at");
    }

    public function getEmailWasSentAttribute()
    {
        return $this->envios()->count();
    }
}
