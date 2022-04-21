<?php

namespace App\Http\Controllers\contact_email;

use App\Http\Controllers\Controller;
use App\Models\Contact_email;
use App\Models\User;
use Illuminate\Http\Request;

// use Illuminate\Http\Request;
// use App\Models\Contact_email;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ContactEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        // $this->middleware("can:user.index");
        $this->middleware("can:contact_email.index")->only("index");
        $this->middleware("can:contact_email.estadisticas")->only("estadisticas");
        $this->middleware("can:contact_email.create")->only("create", "store");
        $this->middleware("can:contact_email.edit")->only("edit", "update");
        $this->middleware("can:contact_email.destroy")->only("destroy");
    }


    public function index()
    {
        // $emails = Contact_email::orderBy("created_at", "DESC")->get();

        return view("admin.contact_email.index");
    }

    public function estadisticas()
    {
        $total_registros = Contact_email::count();

        if( $total_registros == 0) {
            $message = [
                "message" => "No hay Registros realizados, Crea tu primer registro",
                "color" => "warning",
                "icon" => "fa fa-exclamation-circle"
            ];

            return redirect()->route("contact_email.create")->with("message", $message);
        }

        $date = Carbon::now();
        $date = $date->format('Y-m-d');

        $registros_de_hoy = Contact_email::whereDate("created_at", $date)->count();



        // dd($registros_de_hoy);

        $users = User::select(
            "users.id",
            "users.username",
            DB::raw("COUNT(users.id) as cant_reg")
        )
            ->leftJoin("contact_emails AS co_em", "co_em.user_id", "=", "users.id")
            ->groupBy("users.id")
            ->orderBy("cant_reg", "DESC")
            ->get();

        // dd($users->count());
        $registros_promedio = $total_registros == 0 ? 0 : $total_registros / $users->count();

        $emials_sin_enviar = Contact_email::where("estado", "=", 0)->get()->count();

        $emials_enviados = Contact_email::where("estado", ">", 0)->get()->count();


        return view("admin.contact_email.estadisticas", compact("users", "total_registros", "registros_promedio", "emials_sin_enviar", "emials_enviados", "registros_de_hoy"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.contact_email.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'nombre_empresa' => "nullable|string|max:255",
            'email' => "required_if:whatsapp,null|nullable|string|max:255|email|unique:contact_emails",
            'url' => "nullable|string|max:255|active_url",
            'whatsapp' => "required_if:email,null|nullable|string|max:255|active_url",
            'instagram' => "nullable|string|max:255|active_url",
            'facebook' => "nullable|string|max:255|active_url",
            'descripcion' => "nullable|string",
        ]);

        $data["user_id"] = auth()->user()->id;

        Contact_email::create($data);

        $message = [
            "message" => "El Registro Se ha Realizado correctamente.",
            "color" => "success",
            "icon" => "far fa-check-circle"
        ];

        return redirect()->route("contact_email.create")->with("message", $message);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact_email  $contact_email
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact_email $contact_email)
    {
        return view("admin.contact_email.edit", compact("contact_email"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact_email  $contact_email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact_email $contact_email)
    {
        $data = request()->validate([
            'nombre_empresa' => "nullable|string|max:255",
            'email' => "required_if:whatsapp,null|nullable|string|max:255|email",
            'url' => "nullable|string|max:255|active_url",
            'whatsapp' => "required_if:email,null|nullable|string|max:255|active_url",
            'instagram' => "nullable|string|max:255|active_url",
            'facebook' => "nullable|string|max:255|active_url",
            'descripcion' => "nullable|string",
        ]);

        $valid_email = Contact_email::select("id")->where("email", "=", $data["email"])->get();

        // dd($valid_email->count());

        if ($valid_email->count() != 0 and ($valid_email[0]->id != $contact_email->id)) {
            $message = [
                "message" => "El Email ya existe.",
                "color" => "danger",
            ];

            return redirect()->route("contact_email.edit", ["contact_email" => $contact_email->id])->with("message", $message);
        }

        $contact_email->nombre_empresa = $data["nombre_empresa"];
        $contact_email->email = $data["email"];
        $contact_email->url = $data["url"];
        $contact_email->whatsapp = $data["whatsapp"];
        $contact_email->instagram = $data["instagram"];
        $contact_email->facebook = $data["facebook"];
        $contact_email->descripcion = $data["descripcion"];



        $contact_email->save();

        $message = [
            "message" => "El Registro Se ha Actualizado correctamente.",
            "color" => "success",
            "icon" => "far fa-check-circle"
        ];

        return redirect()->route("contact_email.index")->with("message", $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact_email  $contact_email
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact_email $contact_email)
    {
        $contact_email->delete();

        $message = [
            "message" => "El Registro Se ha eliminado correctamente.",
            "color" => "success",
            "icon" => "far fa-check-circle"
        ];

        return redirect()->back()->with("message", $message);
    }

    // okuneva.steve
    public function datatable()
    {
        $all_permission = auth()->user()->hasAllPermissions(["contact_email.index",
        "contact_email.estadisticas",
        "contact_email.create",
        "contact_email.edit",
        "contact_email.destroy"]);




        if( $all_permission ) {
            $emails = Contact_email::orderBy("created_at", "DESC")->get();
        } else {
            $emails = auth()->user()->emails_registros;
        }
// dd($emails[0]);



        return datatables()
            ->of($emails)
            ->addColumn("actions", "admin.components.datatable.contact_email.actions")
            ->addColumn("creacion", function ($email) {
                return date_format($email->created_at, "d/m/Y");
            })
            ->addColumn("envios", function ($email) {
                return $email->envios->count();
            })
            ->addColumn("links_buttons", "admin.components.datatable.contact_email.links_buttons")
            ->addColumn("estado", "admin.components.datatable.contact_email.estado")
            ->addColumn("valid_email", "admin.components.datatable.contact_email.email")
            ->addColumn("word_nombre_empresa", "admin.components.datatable.contact_email.word_nombre_empresa")
            ->addColumn("usuario", function ($email) {
                return $email->usuario ? $email->usuario->name : "Sin Usuario" ;
            })
            ->rawColumns(["actions", "creacion", "links_buttons", "estado", "valid_email", "word_nombre_empresa", "usuario", "envios"])
            // ->rawColumns(["creacion"])
            // ->rawColumns(["links_buttons"])

            ->toJson();
    }
}
