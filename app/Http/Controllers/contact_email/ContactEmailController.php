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
        $this->middleware("can:contact_email.index")->only(
            "index",
            "getContactEmails",
            "datatable",
            "shipping_history",
            "shipping_history_datatable",
            "get_details_shippung",
            "alternative_contact"
        );
        $this->middleware("can:contact_email.estadisticas")->only("estadisticas");
        $this->middleware("can:contact_email.create")->only("create", "store");
        $this->middleware("can:contact_email.edit")->only("edit", "update", "update_email_async");
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

        $contact_emails_query = Contact_email::orderBy("envios_count", "ASC");

        $contact_emails_all_counts = $contact_emails_query->count();

        $contact_emails_today_count = Contact_email::today()->count();

        $data["request"] = $request->all();
        $data["users_with_record"] = User::whereHas("emails_registros", null, ">", 0)->get();

        $data["js"] = [
            "url_datatable" => route("contact_email.datatable"),
        ];
        if ($request["date_filter"]) {
            try {
                $data["js"]["date_filter_parse"] = Carbon::now()->parse($request["date_filter"]);
            } catch (\Throwable $e) {
                $data["js"]["date_filter_parse"] = null;
            }
        }

        return view("admin.contact_email.index", compact("contact_emails_all_counts", "contact_emails_today_count", "data"));
    }

    public function estadisticas()
    {
        $total_registros = Contact_email::count();
        $total_records_with_email = Contact_email::emailValid()->count();

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


        return view("admin.contact_email.estadisticas", compact("users", "total_registros", "registros_promedio", "emials_sin_enviar", "emials_enviados", "registros_de_hoy", "total_records_with_email"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contact_emails_today_count = auth()->user()->emails_registros()->whereDate("created_at", Carbon::today())->count();

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
        // dd(Contact_email::all()->random()->update(["estado", 1]));
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
            'email' => "required_if:whatsapp,null|nullable|string|max:255|email|unique:contact_emails,email,{$contact_email->id},id",
            'url' => "nullable|string|max:255|active_url",
            'whatsapp' => "required_if:email,null|nullable|string|max:255|active_url",
            'instagram' => "nullable|string|max:255|active_url",
            'facebook' => "nullable|string|max:255|active_url",
            'descripcion' => "nullable|string",
        ]);

        $valid_email = Contact_email::select("id")->where("email", "=", $data["email"])->get();

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

    public function update_email_async(Contact_email $contact_email, Request $request)
    {
        $data = request()->validate([
            "email" => "required|email|unique:contact_emails,email,{$contact_email->id},id",
        ]);


        $email = $data["email"];

        $contact_email->update([
            "email" => $email,
        ]);

        $data_response = [
            "message" => "El email se ha actualizado correctamente",
            "data_update" => $contact_email
        ];

        return response()->json($data_response, 200);
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
        try {
            $date_filter = $request["date_filter"] ? Carbon::now()->parse($request["date_filter"]) : null;
        } catch (\Throwable $th) {
            $date_filter = null;
        }

        $filter_user = $request["username"] ?? null
            ?  User::where("username", $request["username"])->first()
            : null;


        $query_user = (new Contact_email())->datatableContactEmailQuery();

        $query_user_count = $query_user;

        $totalFilteredRecord = $totalDataRecord = $draw_val = "";

        $columns_list = array(
            // 0 => "contact_emails.id",
            0 => "us.username",
            1 => "contact_emails.nombre_empresa",
            2 => "contact_emails.email",
            3 => "envios_count",
            4 => "contact_emails.url",
            5 => "contact_emails.whatsapp",
            6 => "contact_emails.facebook",
            7 => "contact_emails.instagram",
            8 => "contact_emails.created_at",
            9 => "contact_emails.updated_at",
        );

        $totalDataRecord = Contact_email::whereNull("deleted_at")->count();



        $totalFilteredRecord = $totalDataRecord;

        $limit_val = $request["length"];
        $start_val = $request["start"];
        $order_val = $columns_list[$request["order"][0]["column"]];

        $dir_val = $request["order"][0]["dir"];


        if (empty($request["search"]["value"])) {
            $data_return = $query_user->offset($start_val)
                ->orderBy($order_val, $dir_val);

            $data_return_count = (new Contact_email())->datatableContactEmailQuery();

            // * Si se quiere filtrar por nombre de usuario
            if ($filter_user) {
                $data_return->where("contact_emails.user_id", $filter_user->id);
                $data_return_count->where("contact_emails.user_id", $filter_user->id);
            }

            // * Si se quiere filtrar fecha
            if ($date_filter) {
                $data_return->whereDate("contact_emails.created_at", $date_filter);
                $data_return_count->whereDate("contact_emails.created_at", $date_filter);
            }

            $totalFilteredRecord = $data_return_count->count();
            $data_return = $data_return->limit($limit_val)->get();
        } else {
            $search_text = $request["search"]["value"];

            $data_return =  $query_user
                ->where(function ($q) use ($search_text) {
                    $q->where("contact_emails.id", "like", "%{$search_text}%")
                        ->orWhere("contact_emails.nombre_empresa", "like", "%{$search_text}%")
                        ->orWhere("us.username", "like", "%{$search_text}%")
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




            $totalFilteredRecord = (new Contact_email())->datatableContactEmailQuery()
                ->where(function ($q) use ($search_text) {
                    $q->where("contact_emails.id", "like", "%{$search_text}%")
                        ->orWhere("contact_emails.nombre_empresa", "like", "%{$search_text}%")
                        ->orWhere("us.username", "like", "%{$search_text}%")
                        ->orWhere("contact_emails.email", "like", "%{$search_text}%")
                        ->orWhereHas("envios", null, "like", "%{$search_text}%")
                        ->orWhere("contact_emails.url", "like", "%{$search_text}%")
                        ->orWhere("contact_emails.whatsapp", "like", "%{$search_text}%")
                        ->orWhere("contact_emails.facebook", "like", "%{$search_text}%")
                        ->orWhere("contact_emails.instagram", "like", "%{$search_text}%")
                        ->orWhere("contact_emails.created_at", "like", "%{$search_text}%")
                        ->orWhere("contact_emails.updated_at", "like", "%{$search_text}%");
                });

            // * Si se quiere filtrar por nombre de usuario
            if ($filter_user) {
                $data_return->where("contact_emails.user_id", $filter_user->id);
                $totalFilteredRecord->where("contact_emails.user_id", $filter_user->id);
            }

            // * Si se quiere filtrar fecha
            if ($date_filter) {
                $data_return->whereDate("contact_emails.created_at", $date_filter);
                $totalFilteredRecord->whereDate("contact_emails.created_at", $date_filter);
            }

            $data_return = $data_return->limit($limit_val)->get();
            $totalFilteredRecord = $totalFilteredRecord->count();
        }

        $data_val = array();

        if (!empty($data_return)) {
            $data_val = $data_return->map(function ($email) {
                $email->contact_created_parce = Carbon::now()->parse($email->contact_created);

                if ($email->username) {
                    $email->color_by_user = User::find($email->user_id)->color_by_id();
                } else {
                    $email->color_by_user = null;
                }

                $created_parser = Carbon::parse($email->contact_created);

                $updated_parser = Carbon::parse($email->contact_updated);

                // contacto alternativo
                $whatsapp = (string) response()->view("admin.contact_email.components.datatable.whatsapp", [
                    "email" => $email,
                    "class" => "contact_alternative_btn",
                    "id" => $email->contact_id,
                    "url" => route("contact_email.alternative_contact", ["contact_email" => $email->contact_id]),
                    "type_contact" => Contact_email::WHATSAPP,
                    "count_shipping" => $email->envios_whatsapp_count,
                ])->original;

                $facebook = (string) response()->view("admin.contact_email.components.datatable.facebook", [
                    "email" => $email,
                    "class" => "contact_alternative_btn",
                    "id" => $email->contact_id,
                    "url" => route("contact_email.alternative_contact", ["contact_email" => $email->contact_id]),
                    "type_contact" => Contact_email::FACEBOOK,
                    "count_shipping" => $email->envios_facebook_count,
                ])->original;

                $instagram = (string) response()->view("admin.contact_email.components.datatable.instagram", [
                    "email" => $email,
                    "class" => "contact_alternative_btn",
                    "id" => $email->contact_id,
                    "url" => route("contact_email.alternative_contact", ["contact_email" => $email->contact_id]),
                    "type_contact" => Contact_email::INSTAGRAM,
                    "count_shipping" => $email->envios_instagram_count,
                ])->original;

                $html_email = (string) response()->view("admin.components.inputs.edit-inline", [
                    "value" => $email->contact_email,
                    "type" => "email",
                    "classes" => "form-control-sm",
                    "placeholder" => "Correo electronico",
                    "url_async_edit" => route("contact_email.update_email_async", ["contact_email" => $email->contact_id]),
                    "id_item_element" => $email->contact_id,
                    "element_obj_async" => "email",
                    "style" => "min-width: 200px;",
                    "method" => "POST"
                ])->original;

                return [
                    "id" => $email->contact_id,
                    "nombre_empresa" => (string) response()->view("admin.contact_email.components.datatable.name_enterprice", ["name" => $email->nombre_empresa, "limit_name" => 15])->original,
                    "username" => (string) response()->view("admin.contact_email.components.datatable.user", ["email" => $email])->original,
                    "email" => $html_email,
                    "url" => (string) response()->view("admin.contact_email.components.datatable.web", compact("email"))->original,
                    "envios" => (string) response()->view("admin.contact_email.components.datatable.count_ship_mails", compact("email"))->original,
                    "whatsapp" => $whatsapp,
                    "facebook" => $facebook,
                    "instagram" => $instagram,
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

    public function shipping_history(Request $request)
    {
        $data["title"] = 'Historial De Envios';
        $data["shipping_history_count"] = 10;
        $data["request"] = $request->all();

        $data["js"] = [
            "url_datatable" => route("contact_email.shipping_history_datatable"),
        ];

        $data["request"] = $request->all();
        $data["users_with_sent_email"] = User::whereHas("emailEnviado", null, ">", 0)->get();

        if ($request["date_filter"]) {
            try {
                $data["js"]["date_filter_parse"] = Carbon::now()->parse($request["date_filter"]);
            } catch (\Throwable $e) {
                $data["js"]["date_filter_parse"] = null;
            }
        }
        // dd($data["js"]);
        return view("admin.contact_email.shipping_history", compact("data"));
    }

    public function shipping_history_datatable(Request $request)
    {
        try {
            $date_filter = $request["date_filter"] ? Carbon::now()->parse($request["date_filter"]) : null;
            # code...
        } catch (\Throwable $e) {
            $date_filter = null;
            # code...
        }

        $username = $request["username"] ? User::where("username", $request["username"])->first() : null;

        $query_user = (new Contact_email())->datatableEmailsSendQuery();

        $totalFilteredRecord = $totalDataRecord = $draw_val = "";

        $columns_list = array(
            0 => "contact_email_user.created_at",
            1 => "us.username",
            2 => "cm.email",
            3 => "contact_email_user.subject",
            4 => "contact_email_user.group_send",
        );

        $totalDataRecord = DB::table("contact_email_user")->whereNull("contact_email_user.deleted_at")->count();



        $totalFilteredRecord = $totalDataRecord;

        $limit_val = $request["length"];
        $start_val = $request["start"];
        $order_val = $columns_list[$request["order"][0]["column"]];

        $dir_val = $request["order"][0]["dir"];


        if (empty($request["search"]["value"])) {
            $data_return = $query_user->offset($start_val)
                ->orderBy($order_val, $dir_val);

            $data_return_count = (new Contact_email())->datatableEmailsSendQuery();

            // * Si se quiere filtrar por fecha)
            if ($date_filter) {
                $data_return->whereDate("contact_email_user.created_at", $date_filter);
                $data_return_count->whereDate("contact_email_user.created_at", $date_filter);
            }

            // * Si se quiere filtrar por usuario)
            if ($username) {
                $data_return->where("contact_email_user.user_id", $username->id);
                $data_return_count->where("contact_email_user.user_id", $username->id);
            }

            // * Si se quiere filtrar por email)
            if ($request["email"] ?? null) {
                $data_return->where("cm.email", $request["email"]);
                $data_return_count->where("cm.email", $request["email"]);
            }

            // * datos de salida
            $totalFilteredRecord = $data_return_count->count();
            $data_return = $data_return->limit($limit_val)->get();
        } else {
            $search_text = $request["search"]["value"];

            $data_return =  $query_user
                ->where(function ($q) use ($search_text) {
                    $q->where("contact_email_user.created_at", "like", "%{$search_text}%")
                        ->orWhere("us.username", "like", "%{$search_text}%")
                        ->orWhere("contact_email_user.subject", "like", "%{$search_text}%")
                        ->orWhere("contact_email_user.group_send", "like", "%{$search_text}%")
                        ->orWhere("cm.email", "like", "%{$search_text}%");
                })
                ->offset($start_val)
                ->orderBy($order_val, $dir_val);

            $totalFilteredRecord = (new Contact_email())->datatableEmailsSendQuery()
                ->where(function ($q) use ($search_text) {
                    $q->where("contact_email_user.created_at", "like", "%{$search_text}%")
                        ->orWhere("us.username", "like", "%{$search_text}%")
                        ->orWhere("contact_email_user.subject", "like", "%{$search_text}%")
                        ->orWhere("contact_email_user.group_send", "like", "%{$search_text}%")
                        ->orWhere("cm.email", "like", "%{$search_text}%");
                });

            // * Si se quiere filtrar por fecha)
            if ($date_filter) {
                $data_return->whereDate("contact_email_user.created_at", $date_filter);
                $totalFilteredRecord->whereDate("contact_email_user.created_at", $date_filter);
            }


            // * Si se quiere filtrar por usuario)
            if ($username) {
                $data_return->where("contact_email_user.user_id", $username->id);
                $totalFilteredRecord->where("contact_email_user.user_id", $username->id);
            }

            // * Si se quiere filtrar por email)
            if ($request["email"] ?? null) {
                $data_return->where("cm.email", $request["email"]);
                $totalFilteredRecord->where("cm.email", $request["email"]);
            }

            // * datos salida
            $data_return = $data_return->limit($limit_val)->get();
            $totalFilteredRecord = $totalFilteredRecord->count();
        }

        $data_val = array();

        if (!empty($data_return)) {
            $data_val = $data_return->map(function ($email) {
                if ($email->username) {
                    $email->color_by_user = User::find($email->user_id)->color_by_id();
                } else {
                    $email->color_by_user = null;
                }

                $created_parser = Carbon::parse($email->shipping_created);

                $details_params = [
                    "class" => "more_details",
                    "id" => $email->send_id,
                    "route" => route('contact_email.shipping_details', ['id' => $email->send_id])
                ];

                return [
                    "id" => $email->send_id,
                    "username" => (string) response()->view("admin.contact_email.components.datatable.user", compact("email"))->original,
                    "email" => (string) response()->view("admin.contact_email.components.datatable.email", compact("email"))->original,
                    "created_at" => (string) response()->view("admin.contact_email.components.datatable.created_at", compact("created_parser"))->original,
                    "subject" => !$email->subject ? "Sin asunto" : $email->subject,
                    "group_send" => $email->group_send ? $email->group_send : "Sin Grupo",
                    "details" => (string) response()->view("admin.contact_email.components.datatable.details", $details_params)->original
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

    public function get_details_shippung($id_shipping)
    {
        $shipping_details = DB::table("contact_email_user")
            ->select(
                "contact_email_user.id AS ship_id",
                "contact_email_user.user_id",
                "contact_email_user.contact_email_id",
                "contact_email_user.created_at AS ship_created_at",
                "contact_email_user.updated_at AS ship_updated_at",
                "contact_email_user.group_send",
                "contact_email_user.subject",
                "contact_email_user.body",
                "us.username",
                "cm.email"
            )
            ->leftJoin("users AS us", function ($j) {
                $j->on("us.id", "=", "contact_email_user.user_id")
                    ->whereNull("us.deleted_at");
            })
            ->leftJoin("contact_emails AS cm", function ($j) {
                $j->on("cm.id", "=", "contact_email_user.contact_email_id")
                    ->whereNull("us.deleted_at");
            })
            ->where("contact_email_user.id", $id_shipping)
            ->whereNull("contact_email_user.deleted_at")
            ->first();

        if (!$shipping_details) {
            return response()->json([
                "message" => "El valor no fue encontrado"
            ], 404);
        }
        $shipping_details->created_format = Carbon::parse($shipping_details->ship_created_at)->format("d/m/Y H:s:i");

        return response()->json($shipping_details, 200);
    }

    public function alternative_contact(Contact_email $contact_email,  Request $request)
    {
        $data = request()->validate([
            "type" => "required|integer"
        ]);


        auth()->user()->emailEnviado()->attach([$contact_email->id => ["type" => $data["type"]]]);

        return response()->json(
            [
                "count_shipping" => $contact_email->type_alternative($data["type"])->count()
            ]
        );
    }
}
