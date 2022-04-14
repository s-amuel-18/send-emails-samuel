<?php

namespace App\Http\Controllers;

use App\Models\Contact_email;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $permiso_estadisticas = auth()->user()->can("contact-email.estadisticas");

        if( !$permiso_estadisticas ) {
            return redirect()->route("contact_email.index");
        }

        $total_registros = Contact_email::count();

        $date = Carbon::now();
        $date = $date->format('Y-m-d');

        $registros_de_hoy = Contact_email::whereDate("created_at", $date)->count();

        $correos_sin_enviar = Contact_email::where("estado", "=", 0)->count();

        $usuarios_registrados = User::count();

        // usuarios que han registrado emails hoy
        $usr_registros_hoy = User::select(
            "users.id", "users.username",
            DB::raw("COUNT(con_em.id) AS cantidad_registros"))
            // ->join("contact_emails AS con_em", "con_em.user_id", "=", "users.id")
            ->leftJoin("contact_emails AS con_em", function ($join) {
                $date = Carbon::now();
                $date = $date->format('Y-m-d');
                $join->on('con_em.user_id', '=', 'users.id')
                ->whereDate("con_em.created_at", $date);
            })
            ->groupBy("users.id")
            // ->whereDate("con_em.created_at", $date)
            ->orderBy("cantidad_registros", "DESC")
            ->get();

            // ->join('contacts', function ($join) {
            //     $join->on('users.id', '=', 'contacts.user_id')
            //          ->where('contacts.user_id', '>', 5);
            // })

            // $sd = "SELECT
            //             COUNT(con_em.id) AS cantidad_registros,
            //             us.id,
            //             us.username
            //         FROM users as us
            //         LEFT JOIN contact_emails AS con_em ON con_em.user_id = us.id AND con_em.created_at > '2022-04-14'
            //         -- WHERE
            //         GROUP BY us.id
            //         ORDER BY cantidad_registros";

        return view('home', compact("total_registros", "registros_de_hoy", "correos_sin_enviar", "usuarios_registrados", "usr_registros_hoy"));
    }
}
