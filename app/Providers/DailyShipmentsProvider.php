<?php

namespace App\Providers;

use App\Models\Contact_email;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

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
        View::composer('*', function ($view) {
            $user = auth()->user();
            
            if (!$user) {
                return false;
            }
            
            $emailsToday = $user->correos_enviados_hoy();

            $hora = Carbon::now()->format("H");
            $dia = Carbon::now()->format("d");
            $minutos = Carbon::now()->addMinutes(2)->format("i");
            $segundos = Carbon::now()->format("s");



            $timesLastEmail = [
                "hora" => $hora,
                "dia" => $dia,
                "minutos" => $minutos,
                "segundos" => $segundos
            ];
            // dd($timesLastEmail);
            $view->with("puedo_enviar_emails", [
                "puedo_enviar_emails" => /* ($emailsToday < Contact_email::DAILY_EMAIL_LIMIT) */ false,
                "timesLastEmail" => $timesLastEmail
            ]);
        });
    }
}
