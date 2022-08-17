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
        // $emails = Contact_email::sinEnviar()->emailValid()->take(Contact_email::DAILY_EMAIL_LIMIT)->get();
        // // $emails = Contact_email::sinEnviar()->emailValid()->take(1)->get();

        // $emails->each(function ($emailsNotSend) {
        //     $info["subject"] =  "dsadsa";
        //     $info["body"] =  "dsadsadas";

        //     $insert = DB::table("contact_email_user")->insert([
        //         "user_id" => auth()->user()->id,
        //         "contact_email_id" => $emailsNotSend->id,
        //         // "created_at" => Carbon::now()
        //         "created_at" => Carbon::now()->subHours(23)->subMinutes(59)->subSeconds(55)
        //     ]);

        //     (new Contact_email())->groupBySendEmail(auth()->user()->id, $emailsNotSend->id, $info);
        // });

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
            ->orderBy("emails_registros_count", "DESC")
            ->orderBy("email_enviado_count", "DESC")
            ->get();


        if (auth()->user()->can("managment.index")) {
            $data["netIncome"] = Income::netIncome();
            $data["grossIncome"] = Income::grossIncome();
            $data["totalSpents"] = Spents::totalSpents();
            $data["dailyEarnings"] = Income::dailyEarnings();
        }

        $data['requirements_count'] = 1;
        $data["requirements"] = Requirements::get();
        $data["requirements_categories"] = Category::requirements()->get();

        $data["request"] = $request->all();
        $data["js"] = [
            "url_datatable_requirements" => route("requirements.datatable"),
        ];
        // dd($data["requirements"]);

        return view('admin.dashboard.dashboard', compact("data", "total_registros", "registros_de_hoy", "correos_sin_enviar", "enviados_hoy", "usr_registros_hoy", "date", "registros_de_hoy_take", "pays_time"));
    }
}
