<?php

namespace App\Providers;

use App\Models\BodyEmail;
use App\Models\Contact_email;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DailyShipmentsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('home', function ($view) {

            $user = auth()->user();

            if (!$user) {
                return null;
            }

            $emailsToday = $user->correos_enviados_hoy();

            // $lastEmailSend = Contact_email::enviadosHoy();

            $lastEmailSend = DB::table("contact_email_user")->orderBy("created_at", "DESC")->first();

            $bodyEmails = BodyEmail::select("nombre", "id")->get();

            $puedo_enviar = ($emailsToday < Contact_email::DAILY_EMAIL_LIMIT);

            if (!$puedo_enviar) {

                $hora = Carbon::now()->parse($lastEmailSend->created_at)->format("H");
                $mes = Carbon::now()->parse($lastEmailSend->created_at)->format("m");
                $year = Carbon::now()->parse($lastEmailSend->created_at)->format("Y");


                $dia = Carbon::now()->parse($lastEmailSend->created_at)->addDays(1)->format("d");
                $minutos = Carbon::now()->parse($lastEmailSend->created_at)->format("i");
                $segundos = Carbon::now()->parse($lastEmailSend->created_at)->format("s");
                $timesLastEmail = [
                    "hora" => $hora,
                    "dia" => $dia,
                    "minutos" => $minutos,
                    "segundos" => $segundos,
                    "mes" => $mes,
                    "year" => $year,
                ];
            }




            // dd($timesLastEmail);
            $view->with("puedo_enviar_emails", [
                "puedo_enviar_emails" => $puedo_enviar,
                "timesLastEmail" => $timesLastEmail ?? null,
                "bodyEmails" => $bodyEmails,
                "count_emails_register" => Contact_email::count(),
            ]);
        });
    }
}
