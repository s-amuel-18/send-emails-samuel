<?php

namespace App\Http\Controllers\contact_email;

use App\Http\Controllers\Controller;
use App\Mail\ServicioMaillable;
use App\Models\BodyEmail;
use App\Models\Contact_email;
use App\Models\EmailEnviado;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;

class EmailSendController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:envio_email.index")->only("index", "select_email", "send_emails");
    }


    public function index()
    {
        $bodysEmail = BodyEmail::select("id", "nombre")->get();

        $emails = Contact_email::select("id", "email", "estado")->whereNotNull("email")->orderBy("estado", "ASC")->get();

        return view("admin.contact_email.envio_emails.index", compact("bodysEmail", "emails"));
    }

    public function crear_informacio(Request $request)
    {

        // dd($request);
        $data = request()->validate([
            // "nombre_remitente" => "string|max:40",
            "select_body" => "nullable|integer|exists:body_emails,id",
            "check_emails" => "nullable|integer",
            "body" => "required_if:select_body,null|nullable|string",
            "emails" => "required_if:check_emails,null|nullable|array",
            "asunto" => "required|string",
        ]);

        // seleccionamos los ids en caso de que el usuario halla escogido algun correo en espesifico
        $ids_emails = $request->has("emails") ? $data["emails"] : [];

        // validamos que el check de los emails extra este presionado (100 emails extra)
        if ($data["check_emails"]) {

            // realizamos una consulta para buscar ids de correos extra
            $ids_emails_extra = Contact_email::select("id")
                ->where("estado", "=", "0")
                ->whereNotIn("id", $ids_emails)
                ->whereNotNull("email")
                ->limit(Contact_email::DAILY_EMAIL_LIMIT - count($ids_emails))
                ->get();


            // realizamos un sivlo para agregar esos ids al array de ids seleccionamos
            foreach ($ids_emails_extra as $k => $item) {
                array_push($ids_emails, $item->id);
            }
        }

        // realizamos una consulta que nos devuelva todos los emails que coinsidan con esos ids
        $emails = Contact_email::select("id", "email")
            ->whereIn("id", $ids_emails)
            ->get();




        // seleccionar el cuerpo del email
        $body = $data["body"] ? $data["body"] : BodyEmail::select("body")->where("id", "=", $data["select_body"])->get()[0]->body;


        $info["subject"] =  $data["asunto"];
        $info["body"] =  $body;
        $info["link_principal"] =  "https://negociaecuador.com/samuel-graterol-dev/";

        // aqui se van a agregar los emails Que no fueron enviados
        $arr_sin_enviar = [];
        $arr_enviados = [];

        $correo = new ServicioMaillable($info);

        $date = Carbon::now();
        $date = $date->format('Y-m-d');


        foreach ($emails as $email) {
            // dd($email->email);
            try {


                $enviados_hoy = EmailEnviado::whereDate("created_at", $date)->count();

                // vakidanis que la cantidad de correos diarios no sobre pase los 100
                if ($enviados_hoy >= Contact_email::DAILY_EMAIL_LIMIT) {
                    $message = [
                        "message" => "La cantidad De correos diarios Ha llegado a su limite, Se enviaron Correctamente " . count($arr_enviados) . " correos y hubieron " . count($arr_sin_enviar) . " correos fallidos",
                        "color" => "danger"
                    ];

                    return redirect()->back()->with("message", $message);
                }

                Mail::to($email->email)->send($correo);


                auth()->user()->emailEnviado()->create([
                    "contact_email_id" => $email->id
                ]);

                $email->estado = 1;
                $email->save();

                Contact_email::where("id", $email->id)->update(["estado" => 1]);

                array_push($arr_enviados, $email->email);
            } catch (\Throwable $th) {
                // dd($th);
                array_push($arr_sin_enviar, $email->email);
            }
        }



        $message = [
            "message" => "Se enviaron Correctamente " . count($arr_enviados) . " correos y hubieron " . count($arr_sin_enviar) . " correos fallidos",
            "color" => "success",
            "icon" => "far fa-check-circle"
        ];

        return redirect()->back()->with("message", $message);
    }

    public function email()
    {
        return view("emails.servicio");
    }

    public function envioEmail(/* Request $request */)
    {
        // validacion de informacion
        /* $data = request()->validate([
            "select_body" => "nullable|integer|exists:body_emails,id",
            "emails" => "required_if:check_emails,null|nullable|array",
            "asunto" => "required|string",
        ]); */

        $emailsNotSend = Contact_email::limitDaily()
            ->get();

        $info["subject"] =  "Holaa";
        $info["body"] =  "este es el escrito";
        $info["link_principal"] =  "https://negociaecuador.com/samuel-graterol-dev/";

        foreach ($emailsNotSend as $email) {
            $emailsToday = Contact_email::correos_enviados_hoy();

            try {
                // retraso del email
                sleep(5);
                if ($emailsToday < Contact_email::DAILY_EMAIL_LIMIT) {
                    $correo = new ServicioMaillable($info, $email);
                    Mail::to($email->email)->send($correo);
                }
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }
}


// basededatos: avimarks_mail-samuel
// user:        avimarks_samuel
// pass:        0424Sam??
