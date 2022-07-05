<?php

namespace App\Providers;

use App\Models\Contact_email;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
            $emailsToday = Contact_email::correos_enviados_hoy();

            $view->with("puedo_enviar_emails", ($emailsToday < Contact_email::DAILY_EMAIL_LIMIT));
        });
    }
}
