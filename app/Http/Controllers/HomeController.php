<?php

namespace App\Http\Controllers;

use App\Mail\ServicioMaillable;
use App\Models\BillingTime;
use App\Models\Category;
use App\Models\CategoryService;
use App\Models\Contact_email;
use App\Models\EmailEnviado;
use App\Models\Income;
use App\Models\Requirements;
use App\Models\Spents;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use PharIo\Manifest\Requirement;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // dd();
        $data = [];

        $pays_time = BillingTime::withSum("spemts", "price")->get();

        $total_registros = Contact_email::emailValid()->count();

        $date = Carbon::now();
        $date = $date->format('Y-m-d');

        if (auth()->user()->can("contact_email.estadisticas")) {

            $registros_de_hoy_take = Contact_email::today()->take(5)->get();
        } else {
            $registros_de_hoy_take = auth()->user()->emails_registros()->today()->take(5)->get();
        }
        $registros_de_hoy = Contact_email::today()->count();

        $correos_sin_enviar = Contact_email::sinEnviar()->count();

        $enviados_hoy = auth()->user()->emailsSent24HoursAgo();

        // usuarios que han registrado emails hoy
        $usr_registros_hoy = User::withCount(["emails_registros" => function ($q) {
            return $q->whereDate("created_at", Carbon::today());
        }])
            ->withCount(["emailEnviado" => function ($q) {
                return $q->whereDate("contact_email_user.created_at", Carbon::today());
            }])
            ->orderBy("email_enviado_count", "DESC")
            ->orderBy("emails_registros_count", "DESC")
            ->get();


        $data['requirements_count'] = 1;
        $data["requirements"] = Requirements::get();
        $data["requirements_categories"] = Category::requirements()->orderBy("name")->get();

        $data["request"] = $request->all();
        $data["js"] = [
            "url_datatable_requirements" => route("requirements.datatable"),
            "url_store_requirement" => route("requirements.store"),
            "url_destroy_requirement" => route("requirements.destroy"),
        ];

        return view('admin.dashboard.dashboard', compact("data", "total_registros", "registros_de_hoy", "correos_sin_enviar", "enviados_hoy", "usr_registros_hoy", "date", "registros_de_hoy_take", "pays_time"));
    }
}
