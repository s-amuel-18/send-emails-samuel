<?php

namespace App\Http\Controllers\contact_email;

use App\Exports\ContactEmailExport;
use App\Http\Controllers\Controller;
use App\Mail\ServicioMaillable;
use App\Models\BodyEmail;
use App\Models\Contact_email;
use App\Models\EmailEnviado;
use App\Models\User;
use Carbon\Carbon;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

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
        $data = request()->validate([
            "select_body" => "nullable|integer|exists:body_emails,id",
            "body" => "required_if:select_body,null|nullable|string",
            "email" => "required",
            "asunto" => "required|string",
        ]);


        $email = $data["email"];
        $info["subject"] = $data["asunto"];

        if ($data["select_body"]) {
            $info["body"] = BodyEmail::select("body")
                ->find($data["select_body"])
                ->body;
        } else {
            $info["body"] = $data["body"];
        }

        $dalyEmailsValid = auth()->user()->validSendEmailDaily();

        $emailsToSend = auth()->user()->correos_por_enviar_hoy();
        $emailsToSend = $emailsToSend == 0 ? null : $emailsToSend;


        if (!$dalyEmailsValid) {
            $send_today = auth()->user()->emailsSent24HoursAgo();

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
            $message = [
                "color" => "warning",
                "message" => "Se llegó al limite de envios diarios"
            ];

            return redirect()->back()->with("message", $message);
        }

        try {
            $emailExist = Contact_email::where("email", $email)->first();

            if ($emailExist) {
                $emailSend = $emailExist;
            } else {
                $emailSend = auth()->user()->emails_registros()->create([
                    "email" => $email
                ]);
            }


            $correo = new ServicioMaillable($info);
            Mail::to($email)->send($correo);

            $emailsToSend = auth()->user()->correos_por_enviar_hoy();
            $emailsToSend = $emailsToSend == 0 ? null : $emailsToSend;


            $enviado = auth()->user()->emailEnviado()->attach($emailSend->id);

            (new Contact_email())->groupBySendEmail(auth()->user()->id, $emailSend->id, $info);

            $emailSend->update(["estado" => 1]);

            $send_today = auth()->user()->emailsSent24HoursAgo();

            $percentage = $send_today ? (($send_today * 100) / Contact_email::DAILY_EMAIL_LIMIT) : 0;

            $message = [
                "color" => "success",
                "message" => "Email enviado correctamente"
            ];

            return redirect()->back()->with("message", $message);
        } catch (\Throwable $th) {
            $send_today = auth()->user()->emailsSent24HoursAgo();
            $message = [
                "color" => "danger",
                "message" => "Ha ocurrido un error."
            ];

            return redirect()->back()->with("message", $message);
        }
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
            $send_today = auth()->user()->emailsSent24HoursAgo();

            $lastEmailSend = auth()->user()->lastEmailSend();

            $hora = Carbon::now()->parse($lastEmailSend->created_at)->format("H");

            $mes = Carbon::now()->parse($lastEmailSend->created_at)->format("m");

            $year = Carbon::now()->parse($lastEmailSend->created_at)->format("Y");

            $dia = Carbon::now()->parse($lastEmailSend->created_at)->addDays(1)->format("d");

            $minutos = Carbon::now()->parse($lastEmailSend->created_at)->format("i");

            $segundos = Carbon::now()->parse($lastEmailSend->created_at)->format("s");

            $timesLastEmail = [
                "hora" => $hora,
                "dia" => $dia,
                "mes" => $mes,
                "year" => $year,
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
                    "message" => "Se llegó al limite de envios diarios",
                ],
            ];
        }

        $emailsNotSend = Contact_email::sinEnviar()
            ->orderBy("created_at", "DESC")
            ->first();

        $info["subject"] =  $data["subject"];
        $info["body"] =  BodyEmail::find($data["body_email"])->body;

        try {
            $correo = new ServicioMaillable($info);
            Mail::to($emailsNotSend->email)->send($correo);

            $emailsToSend = auth()->user()->correos_por_enviar_hoy();
            $emailsToSend = $emailsToSend == 0 ? null : $emailsToSend;


            $enviado = auth()->user()->emailEnviado()->attach($emailsNotSend->id);
            (new Contact_email())->groupBySendEmail(auth()->user()->id, $emailsNotSend->id, $info);

            $emailsNotSend->update(["estado" => 1]);

            $send_today = auth()->user()->emailsSent24HoursAgo();

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
            $send_today = auth()->user()->emailsSent24HoursAgo();

            //throw $th;
            return [
                "success_email_send" => false,
                "emails_to_send" => $emailsToSend,
                "emails_sent_today" => $send_today,
                "email_err" => $emailsNotSend,
                "message" => [
                    "type" => "danger",
                    "message" => "Ha ocurrido un error. correos diarios"
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

        $dalyEmailsValid = (new User())->validSendEmailDaily();


        if (!$dalyEmailsValid) {

            $response = [
                "success_email_send" => false,
                "message" =>  "Error de envio, intentelo mas tarde."
            ];

            return response()->json($response, 404);
        }


        $info["subject"] =  $data["nombre"] . " Quiere Contactarse Contigo '{$data["email"]}'";
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
            Mail::to(env("MAIL_FROM_ADDRESS"))->send($correo);


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
