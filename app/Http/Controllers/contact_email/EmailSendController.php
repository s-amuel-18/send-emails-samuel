<?php

namespace App\Http\Controllers\contact_email;

use App\Http\Controllers\Controller;
use App\Mail\ServicioMaillable;
use App\Models\BodyEmail;
use App\Models\Contact_email;
use App\Models\EmailEnviado;
use Carbon\Carbon;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
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

        $data["js"] = [
            "url_get_contact_email" => route('contact_email.getContactEmails'),
        ];

        return view("admin.contact_email.envio_emails.index", compact("bodysEmail", "emails", "data"));
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

    public function envioEmail(Request $request)
    {
        $data = request()->validate([
            "subject" => "required|string",
            "body_email" => "required|exists:body_emails,id"
        ]);


        $dalyEmailsValid = auth()->user()->validSendEmailDaily();

        $emailsToSend = auth()->user()->correos_por_enviar_hoy();
        $emailsToSend = $emailsToSend == 0 ? null : $emailsToSend;



        if (!$dalyEmailsValid) {
            $send_today = auth()->user()->correos_enviados_hoy();

            $lastEmailSend = auth()->user()->lastEmailSend();

            $hora = Carbon::now()->parse($lastEmailSend->created_at)->format("H");

            $dia = Carbon::now()->parse($lastEmailSend->created_at)->addDays(1)->format("d");

            $minutos = Carbon::now()->parse($lastEmailSend->created_at)->format("i");

            $segundos = Carbon::now()->parse($lastEmailSend->created_at)->format("s");

            $timesLastEmail = [
                "hora" => $hora,
                "dia" => $dia,
                "minutos" => $minutos,
                "segundos" => $segundos
            ];

            return [
                "success_email_send" => false,
                "emails_to_send" => $emailsToSend,
                "times_last_email" => $timesLastEmail,
                "emails_sent_today" => $send_today,
                "message" => [
                    "type" => "danger",
                    "message" => "Se llego al limite de envios diarios",
                ],
            ];
        }

        $emailsNotSend = Contact_email::sinEnviar()
            ->first();

        $info["subject"] =  $data["subject"];
        $info["body"] =  BodyEmail::find($data["body_email"])->body;

        try {
            //code...
            $correo = new ServicioMaillable($info);
            Mail::to($emailsNotSend->email)->send($correo);

            $emailsToSend = auth()->user()->correos_por_enviar_hoy();
            $emailsToSend = $emailsToSend == 0 ? null : $emailsToSend;


            $enviado = auth()->user()->emailEnviado()->attach($emailsNotSend->id);

            $emailsNotSend->update(["estado" => 1]);

            $send_today = auth()->user()->correos_enviados_hoy();

            $percentage = $send_today ? (($send_today * 100) / Contact_email::DAILY_EMAIL_LIMIT) : 0;

            return [
                "success_email_send" => true,
                "emails_to_send" => $emailsToSend,
                "emails_sent_today" => $send_today,
                "percentage" => $percentage,
                "message" => [
                    "type" => "success",
                    "message" => "Email enviado correctamente"
                ]
            ];
        } catch (\Throwable $th) {
            $send_today = auth()->user()->correos_enviados_hoy();

            //throw $th;
            return [
                "success_email_send" => false,
                "emails_to_send" => $emailsToSend,
                "emails_sent_today" => $send_today,
                "message" => [
                    "type" => "danger",
                    "message" => "Ha ocurrido un error, El motivo del error puede ser que se ha llegado al limite de envio de correos diarios"
                ]
            ];
        }
    }

    public function client_contact_front(Request $request)
    {
        $data = request()->validate([
            "nombre" => "required|string",
            "comment" => "required",
            "email" => "required|email",
        ]);

        $dalyEmailsValid = auth()->user()->validSendEmailDaily();


        if (!$dalyEmailsValid) {

            $response = [
                "success_email_send" => false,
                "message" =>  "Error de envio, intentelo mas tarde."
            ];

            return response()->json($response, 404);
        }


        $info["subject"] =  $data["nombre"] . " Quiere Contactarse Contigo";
        $info["body"] =  $data["comment"];

        try {
            $existEmail = Contact_email::where("email", $data["email"])->first();

            if (!$existEmail) {
                $newEmail = Contact_email::create([
                    "email" => $data["email"],
                ]);
            } else {
                $newEmail = $existEmail;
            }

            $correo = new ServicioMaillable($info);
            Mail::to($newEmail->email)->send($correo);

            auth()->user()->emailEnviado()->attach($newEmail->id);

            $newEmail->update(["estado" => 1]);

            $response = [
                "success_email_send" => true,
                "message" => "<strong>Correo enviado correctamente!</strong> el equipo de fluxel code se pondrá en contacto contigo lo antes posible, gracias por tu mensaje."
            ];

            return response()->json($response, 200);
        } catch (\Throwable $th) {

            //throw $th;
            $response = [
                "success_email_send" => false,
                "message" => "Ha ocurrido un error"
            ];

            return response()->json($response, 404);
        }
    }
}


// basededatos: avimarks_mail-samuel
// user:        avimarks_samuel
// pass:        0424Sam??
