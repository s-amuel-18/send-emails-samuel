<?php

namespace App\Providers;

use App\Models\Income;
use App\Models\Spents;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class MoreExpensesThanIncomeProvider extends ServiceProvider
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
        View::composer(['admin.dashboard.dashboard', "admin.managment.index"], function ($view) {
            $user = auth()->user();
            if ($user and $user->can("managment.index")) {
                $netIncome = Income::netIncome();
                $grossIncome = Income::grossIncome();
                $totalSpents = Spents::totalSpents();

                $percetegeEncome = $grossIncome > 0 ? (($netIncome * 100) / $grossIncome) : 0;

                $messageEncome = null;
                if ($netIncome == 0 and $totalSpents == 0) {
                    $messageEncome = [
                        "color" => "warning",
                        "title" => "!No tienes ganancias!",
                        "description" => "Al no tener ganancias signoficaticas `puedes puedes tener conflictos com tu estavilidad economica.",
                    ];
                } else if ($percetegeEncome < 30 and $percetegeEncome > 0) {
                    $messageEncome = [
                        "color" => "warning",
                        "title" => "!Tus ganancias son menores al 30%!",
                        "description" => "Tienes un nivel de ganancias bajo en comparacion de los ingresos brutos.",
                    ];
                } else if ($netIncome < $totalSpents) {
                    $messageEncome = [
                        "color" => "danger",
                        "title" => "!Tus gastos superan a tus ganancias¡",
                        "description" => "Tienes mas gastos que ganancias esto puede ser perjudicial para tu economia.",
                    ];
                }

                $view->with("messageEncome", $messageEncome);
            }
        });
    }
}
