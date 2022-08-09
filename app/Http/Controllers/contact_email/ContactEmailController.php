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
use Illuminate\Support\Str;

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


    public function index(Request $request)
    {
        $colors = [
            "blue",
            "indigo",
            "purple",
            "pink",
            "red",
            "orange",
            "yellow",
            "green",
            "teal",
            "cyan",
        ];

        $search = $request["search"] ?? null;

        $contact_emails_query = Contact_email::with(["usuario"])
            ->withCount("envios")
            ->orderBy("envios_count", "ASC");


        if ($search) {
            $contact_emails_query->searchLike($search);
        }
        $contact_emails_all_counts = $contact_emails_query->count();

        $contact_emails = $contact_emails_query->paginate(Contact_email::PAGINATE);
        $contact_emails_today_count = Contact_email::today()->count();
        $data["js"] = [
            "url_datatable" => route("contact_email.datatable"),
        ];

        return view("admin.contact_email.index", compact("contact_emails", "search", "contact_emails_all_counts", "contact_emails_today_count", "data"));
    }

    public function estadisticas()
    {
        $total_registros = Contact_email::count();

        if ($total_registros == 0) {
            $message = [
                "message" => "No hay Registros realizados, Crea tu primer registro",
                "color" => "warning",
                "icon" => "fa fa-exclamation-circle"
            ];

            return redirect()->route("contact_email.create")->with("message", $message);
        }

        $date = Carbon::now();
        $date = $date->format('Y-m-d');

        $registros_de_hoy = Contact_email::whereDate("created_at", Carbon::today())->count();



        // dd($registros_de_hoy);

        $users = User::whereHas("emails_registros", null, ">", 0)
            ->withCount("emailEnviado")
            ->withCount("emails_registros")
            ->orderBy("emails_registros_count", "DESC")
            ->get();


        if ($total_registros == 0 || $users->count() == 0) {
            $registros_promedio = 0;
        } else {

            $registros_promedio = $total_registros / $users->count();
        }

        $emials_sin_enviar = Contact_email::sinEnviar()->count();

        $emials_enviados = Contact_email::enviados()->count();


        return view("admin.contact_email.estadisticas", compact("users", "total_registros", "registros_promedio", "emials_sin_enviar", "emials_enviados", "registros_de_hoy"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contact_emails_today_count = Contact_email::today()->count();

        return view("admin.contact_email.create", compact("contact_emails_today_count"));
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

    // // okuneva.steve
    // public function datatable()
    // {
    //     $all_permission = auth()->user()->hasAllPermissions([
    //         "contact_email.index",
    //         "contact_email.estadisticas",
    //         "contact_email.create",
    //         "contact_email.edit",
    //         "contact_email.destroy"
    //     ]);




    //     if ($all_permission) {
    //         $emails = Contact_email::orderBy("created_at", "DESC")->get();
    //     } else {
    //         $emails = auth()->user()->emails_registros;
    //     }
    //     // dd($emails[0]);



    //     return datatables()
    //         ->of($emails)
    //         ->addColumn("actions", "admin.components.datatable.contact_email.actions")
    //         ->addColumn("creacion", function ($email) {
    //             return $email->created_at->diffForHumans();
    //         })
    //         ->addColumn("envios", function ($email) {
    //             return $email->envios()->count();
    //         })
    //         ->addColumn("links_buttons", "admin.components.datatable.contact_email.links_buttons")
    //         ->addColumn("estado", "admin.components.datatable.contact_email.estado")
    //         ->addColumn("valid_email", "admin.components.datatable.contact_email.email")
    //         ->addColumn("word_nombre_empresa", "admin.components.datatable.contact_email.word_nombre_empresa")
    //         ->addColumn("usuario", function ($email) {
    //             $user = $email->usuario;
    //             return $user ? $user->name : "Sin Usuario";
    //         })
    //         ->rawColumns(["actions", "creacion", "links_buttons", "estado", "valid_email", "word_nombre_empresa", "usuario", "envios"])
    //         // ->rawColumns(["creacion"])
    //         // ->rawColumns(["links_buttons"])

    //         ->toJson();
    // }

    public function getContactEmails(Request $request)
    {
        $search = $request["search"] ?? null;

        $contactEmails = Contact_email::select("email")->whereNotNull("email");

        if ($search) {
            $contactEmails = $contactEmails->where("email", "like", "%$search%");
            if (strlen($search) > 5) {
                $contactEmails = $contactEmails->get();
            } else {
                $contactEmails = $contactEmails->take(10)->get();
            }
        } else {

            $contactEmails = $contactEmails->take(10)->get();
        }

        if ($request["format_select"]) {
            $contactEmails = $contactEmails->map(function ($email) {
                return [
                    "id" => $email->email,
                    "text" => $email->email,
                ];
            });
        }


        return response()->json([
            "results" => $contactEmails
        ], 200);
    }

    public function datatable(Request $request)
    {
        // $query_user = DB::table("contact_emails")
        //     ->select(
        //         "contact_emails.id AS contact_id",
        //         "contact_emails.url",
        //         "contact_emails.nombre_empresa",
        //         "contact_emails.estado",
        //         "contact_emails.email AS contact_email",
        //         "contact_emails.whatsapp",
        //         "contact_emails.instagram",
        //         "contact_emails.facebook",
        //         "contact_emails.user_id",
        //         "contact_emails.created_at AS contact_created",
        //         "us.username"
        //     )
        //     ->leftJoin("users AS us", function ($j) {
        //         $j->on("contact_emails.user_id", "=", "us.id")
        //             ->whereNotNull("us.created_at");
        //     })
        //     ->whereNotNull("contact_emails.created_at");

        $query_user = Contact_email::select(
            "contact_emails.id AS contact_id",
            "contact_emails.url",
            "contact_emails.nombre_empresa",
            "contact_emails.estado",
            "contact_emails.email AS contact_email",
            "contact_emails.whatsapp",
            "contact_emails.instagram",
            "contact_emails.facebook",
            "contact_emails.user_id",
            "contact_emails.created_at AS contact_created",
            "contact_emails.updated_at AS contact_updated",
            "us.username"
        )
            ->withCount("envios")
            ->leftJoin("users AS us", function ($j) {
                $j->on("contact_emails.user_id", "=", "us.id")
                    ->whereNotNull("us.created_at");
            });

        $totalFilteredRecord = $totalDataRecord = $draw_val = "";

        $columns_list = array(
            0 => "contact_emails.id",
            1 => "us.username",
            2 => "contact_emails.nombre_empresa",
            3 => "contact_emails.email",
            4 => "envios_count",
            5 => "contact_emails.url",
            6 => "contact_emails.whatsapp",
            7 => "contact_emails.facebook",
            8 => "contact_emails.instagram",
            9 => "contact_emails.created_at",
            10 => "contact_emails.updated_at",
        );

        $totalDataRecord = DB::table("contact_emails")->whereNotNull("created_at")->count();



        $totalFilteredRecord = $totalDataRecord;

        $limit_val = $request["length"];
        $start_val = $request["start"];
        $order_val = $columns_list[$request["order"][0]["column"]];

        $dir_val = $request["order"][0]["dir"];


        if (empty($request["search"]["value"])) {
            $data_return = $query_user->offset($start_val)
                ->orderBy($order_val, $dir_val);


            $data_return = $data_return->limit($limit_val)->get();
        } else {
            $search_text = $request["search"]["value"];

            $data_return =  $query_user
                ->where(function ($q) use ($search_text) {
                    $q->where("contact_emails.id", "like", "%{$search_text}%")
                        ->orWhere("contact_emails.nombre_empresa", "like", "%{$search_text}%")
                        ->orWhere("us.username", "like", "%{$search_text}%")
                        ->orWhere("contact_emails.estado", "like", "%{$search_text}%")
                        ->orWhere("contact_emails.email", "like", "%{$search_text}%")
                        ->orWhereHas("envios", null, "like", "%{$search_text}%")
                        ->orWhere("contact_emails.url", "like", "%{$search_text}%")
                        ->orWhere("contact_emails.whatsapp", "like", "%{$search_text}%")
                        ->orWhere("contact_emails.facebook", "like", "%{$search_text}%")
                        ->orWhere("contact_emails.instagram", "like", "%{$search_text}%")
                        ->orWhere("contact_emails.created_at", "like", "%{$search_text}%")
                        ->orWhere("contact_emails.updated_at", "like", "%{$search_text}%");
                })
                ->offset($start_val)
                ->orderBy($order_val, $dir_val);

            $data_return = $data_return->limit($limit_val)->get();

            $totalFilteredRecord = $query_user
                ->where(function ($q) use ($search_text) {
                    $q->where("contact_emails.id", "like", "%{$search_text}%")
                        ->orWhere("contact_emails.nombre_empresa", "like", "%{$search_text}%")
                        ->orWhere("us.username", "like", "%{$search_text}%")
                        ->orWhere("contact_emails.estado", "like", "%{$search_text}%")
                        ->orWhere("contact_emails.email", "like", "%{$search_text}%")
                        ->orWhereHas("envios", null, "like", "%{$search_text}%")
                        ->orWhere("contact_emails.url", "like", "%{$search_text}%")
                        ->orWhere("contact_emails.whatsapp", "like", "%{$search_text}%")
                        ->orWhere("contact_emails.facebook", "like", "%{$search_text}%")
                        ->orWhere("contact_emails.instagram", "like", "%{$search_text}%")
                        ->orWhere("contact_emails.created_at", "like", "%{$search_text}%")
                        ->orWhere("contact_emails.updated_at", "like", "%{$search_text}%");
                })
                ->count();
        }

        $data_val = array();

        if (!empty($data_return)) {
            $data_val = $data_return->map(function ($email) {
                if ($email->username) {
                    $email->color_by_user = User::find($email->user_id)->color_by_id();
                } else {
                    $email->color_by_user = null;
                }

                $created_parser = Carbon::parse($email->contact_created);
                $updated_parser = Carbon::parse($email->contact_updated);

                return [
                    "id" => $email->contact_id,
                    "nombre_empresa" => (string) response()->view("admin.contact_email.components.datatable.name_enterprice", compact("email"))->original,
                    "username" => (string) response()->view("admin.contact_email.components.datatable.user", compact("email"))->original,

                    "email" => (string) response()->view("admin.contact_email.components.datatable.email", compact("email"))->original,
                    "url" => (string) response()->view("admin.contact_email.components.datatable.web", compact("email"))->original,
                    "envios" => (string) response()->view("admin.contact_email.components.datatable.count_ship_mails", compact("email"))->original,
                    "whatsapp" => (string) response()->view("admin.contact_email.components.datatable.whatsapp", compact("email"))->original,
                    "facebook" => (string) response()->view("admin.contact_email.components.datatable.facebook", compact("email"))->original,
                    "instagram" => (string) response()->view("admin.contact_email.components.datatable.instagram", compact("email"))->original,
                    "actions" => (string) response()->view("admin.contact_email.components.datatable.actions", compact("email"))->original,
                    "created_at" => (string) response()->view("admin.contact_email.components.datatable.created_at", compact("created_parser"))->original,
                    "updated_at" => (string) response()->view("admin.contact_email.components.datatable.updated_at", compact("updated_parser"))->original,
                ];
            });
        }

        $draw_val = $request["draw"];
        $get_json_data = array(
            "draw"            => intval($draw_val),
            "recordsTotal"    => intval($totalDataRecord),
            "recordsFiltered" => intval($totalFilteredRecord),
            "data"            => $data_val
        );

        return $get_json_data;
    }
}
