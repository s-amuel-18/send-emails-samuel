<?php

namespace App\Http\Controllers;

use App\Models\Contact_email;
use App\Models\EmailEnviado;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware("can:home")->only("index");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_registros = Contact_email::count();

        $date = Carbon::now();
        $date = $date->format('Y-m-d');

        if (auth()->user()->can("contact_email.estadisticas")) {

            $registros_de_hoy_completo = Contact_email::whereDate("created_at", $date)->get();
        } else {
            $registros_de_hoy_completo = auth()->user()->emails_registros->where("created_at", ">=", $date)->get();
        }
        $registros_de_hoy = $registros_de_hoy_completo->count();

        $correos_sin_enviar = Contact_email::where("estado", "=", 0)->count();

        $enviados_hoy = EmailEnviado::whereDate("created_at", $date)->count();
        // $enviados_hoy = $enviados_hoy_all->count();

        // usuarios que han registrado emails hoy
        $usr_registros_hoy = User::select(
            "users.id",
            "users.username",
            DB::raw("COUNT(con_em.id) AS cantidad_registros")
        )
            ->leftJoin("contact_emails AS con_em", function ($join) {
                $date = Carbon::now();
                $date = $date->format('Y-m-d');
                $join->on('con_em.user_id', '=', 'users.id')
                    ->whereDate("con_em.created_at", $date);
            })
            ->groupBy("users.id")
            ->orderBy("cantidad_registros", "DESC")
            ->get();


        return view('home', compact("total_registros", "registros_de_hoy", "correos_sin_enviar", "enviados_hoy", "usr_registros_hoy", "date", "registros_de_hoy_completo"));
    }
}
