<?php

namespace App\Http\Controllers;

use App\Mail\ServicioMaillable;
use App\Models\Contact_email;
use App\Models\EmailEnviado;
use App\Models\Income;
use App\Models\Spents;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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

        // dd(Carbon::now()->format("H"));
        // dd(Carbon::now()->format("d"));
        // dd(Carbon::now()->format("i"));
        // dd(Carbon::now()->format("s"));

        
// let hora = @json($data["hora"]);
// let dia = @json($data["dia"]);
// let minutos = @json($data["minutos"]);
// let segundos = @json($data["segundos"]);

        

        if (auth()->user()->can("contact_email.estadisticas")) {

            $registros_de_hoy_take = Contact_email::today()->take(5)->get();
        } else {
            $registros_de_hoy_take = auth()->user()->emails_registros->today()->take(5)->get();
        }
        $registros_de_hoy = Contact_email::today()->count();

        $correos_sin_enviar = Contact_email::sinEnviar()->count();

        $enviados_hoy = 0;

        // usuarios que han registrado emails hoy
        $usr_registros_hoy = User::whereHas("emails_registros", function ($q) {
            return $q->whereDate("created_at", Carbon::today());
        })
            ->withCount(["emails_registros" => function ($q) {
                return $q->whereDate("created_at", Carbon::today());
            }])
            ->withCount(["emailEnviado" => function ($q) {
                // dd($q->whereDate("created_at", Carbon::today()));
                return $q->whereDate("contact_email_user.created_at", Carbon::today());
            }])
            ->get();


        if (auth()->user()->can("managment.index")) {
            $data["netIncome"] = Income::netIncome();
            $data["grossIncome"] = Income::grossIncome();
            $data["totalSpents"] = Spents::totalSpents();
            $data["dailyEarnings"] = Income::dailyEarnings();
        }

        return view('home', compact("data", "total_registros", "registros_de_hoy", "correos_sin_enviar", "enviados_hoy", "usr_registros_hoy", "date", "registros_de_hoy_take"));
    }
}
