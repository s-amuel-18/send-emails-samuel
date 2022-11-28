<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequirementsRequest;
use App\Models\Category;
use App\Models\Requirements;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Queue\Console\RetryBatchCommand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PharIo\Manifest\Requirement;

class RequirementsController extends Controller
{
    public function get_requirement($id)
    {
        $requirement = Requirements::with(["user", "category"])->findOrFail($id);
        $this->authorize("view", $requirement);

        $requirement->user_created = $requirement->user->username;
        $requirement->assigned_category = $requirement->category->name ?? "";
        $requirement->created_format = $requirement->created_at->format("d/m/Y H:i:s");

        return response()->json($requirement, 200);
    }

    public function datatable(Request $request)
    {
        $category_valid = Category::find($request["id_category"] ?? 0);
        $filter_private = $request["filter_private"] ?? 0;

        $query_user = (new Requirements())->datatableRequirementsQuery();

        $totalFilteredRecord = $totalDataRecord = $draw_val = "";

        $columns_list = array(
            0 => "req.id",
            1 => "req.created_at",
            2 => "us.username",
            3 => "req.name",
            4 => "cat.name",
            5 => "req.url",
        );

        $totalDataRecord = DB::table("requirements")->whereNull("requirements.deleted_at")->count();



        $totalFilteredRecord = $totalDataRecord;

        $limit_val = $request["length"];
        $start_val = $request["start"];
        $order_val = $columns_list[$request["order"][0]["column"]];

        $dir_val = $request["order"][0]["dir"];


        if (empty($request["search"]["value"])) {
            $data_return = $query_user->offset($start_val)
                ->orderBy($order_val, $dir_val);

            $data_return_count = (new Requirements())->datatableRequirementsQuery();
            // * Si se quiere filtrar por categorias (registros)
            if ($category_valid) {
                $data_return->where("req.category_id", $category_valid->id);
                $data_return_count->where("req.category_id", $category_valid->id);
            }

            // * Si se quiere filtrar por registros privados (registros)
            if ($filter_private == 1) {
                $data_return->where("req.private", 1);
                $data_return_count->where("req.private", 1);
            }

            $totalFilteredRecord = $data_return_count->count();

            $data_return = $data_return->limit($limit_val)->get();
        } else {
            $search_text = $request["search"]["value"];

            $data_return =  $query_user
                ->where(function ($q) use ($search_text) {
                    $q->where("req.id", "like", "%{$search_text}%")
                        ->orWhere("us.username", "like", "%{$search_text}%")
                        ->orWhere("req.name", "like", "%{$search_text}%")
                        ->orWhere("cat.name", "like", "%{$search_text}%")
                        ->orWhere("req.url", "like", "%{$search_text}%")
                        ->orWhere("req.created_at", "like", "%{$search_text}%");
                })
                ->offset($start_val)
                ->orderBy($order_val, $dir_val);



            $totalFilteredRecord = (new Requirements())->datatableRequirementsQuery()
                ->where(function ($q) use ($search_text) {
                    $q->where("req.id", "like", "%{$search_text}%")
                        ->orWhere("us.username", "like", "%{$search_text}%")
                        ->orWhere("req.name", "like", "%{$search_text}%")
                        ->orWhere("cat.name", "like", "%{$search_text}%")
                        ->orWhere("req.url", "like", "%{$search_text}%")
                        ->orWhere("req.created_at", "like", "%{$search_text}%");
                });
            // * Si se quiere filtrar por categorias 
            if ($category_valid) {
                $data_return->where("req.category_id", $category_valid->id);
                $totalFilteredRecord->where("req.category_id", $category_valid->id);
            }

            // * Si se quiere filtrar por privado 
            if ($filter_private == 1) {
                $data_return->where("req.private", 1);
                $totalFilteredRecord->where("req.private", 1);
            }


            $data_return = $data_return->limit($limit_val)->get();
            $totalFilteredRecord = $totalFilteredRecord->count();
        }

        $data_val = array();
        if (!empty($data_return)) {
            $data_val = $data_return->map(function ($requirement) {

                if ($requirement->us_username) {
                    $user = User::find($requirement->user_id);
                    $requirement->color_by_user = $user->color_by_id();
                } else {
                    $requirement->color_by_user = null;
                }

                $category = Category::find($requirement->category_id);

                if ($category) {
                    $badgr_category = (string) response()->view("admin.contact_email.components.datatable.badge", [
                        "color" => $category->color,
                        "text" => $requirement->cat_name,
                    ])->original;
                } else {
                    $badgr_category = (string) response()->view("admin.contact_email.components.datatable.badge", [
                        "color" => "light",
                        "text" => "Sin Categoría",
                    ])->original;
                }

                $created_parser = Carbon::parse($requirement->req_created_at);

                $details_params = [
                    "class" => "requirements_details",
                    "id" => $requirement->req_id,
                    "route" => route('requirements.get_requirement', ['id' => $requirement->req_id])
                ];

                $details_btn = (string) response()->view("admin.contact_email.components.datatable.details", $details_params)->original;
                $edit_btn = (string) response()->view("admin.requirements.components.btn_edit", [
                    "id" => $requirement->req_id,
                ])->original;
                $delete_btn = (string) response()->view("admin.requirements.components.btn_delete", [
                    "id" => $requirement->req_id,
                ])->original;
                $sum_btns = $details_btn . $edit_btn . $delete_btn;

                return [
                    "id" => $requirement->req_id,
                    "username" => (string) response()->view("admin.contact_email.components.datatable.user", [
                        "user" => $user ?? null,
                        "name" => true
                    ])->original,
                    "name" => (string) response()->view("admin.contact_email.components.datatable.name_enterprice", [
                        "name" => $requirement->req_name,
                        "limit_name" => 20,
                    ])->original,
                    "category" => $badgr_category,
                    "url" => (string) response()->view("admin.contact_email.components.datatable.web", ["url" => $requirement->req_url])->original,
                    "details" => $sum_btns,
                    // "edit_btn" => (string) response()->view("admin.requirements.components.btn_edit")->original,
                    // "delete_btn" => (string) response()->view("admin.requirements.components.btn_delete", $details_params)->original,
                    // "details" => (string) response()->view("admin.contact_email.components.datatable.details", $details_params)->original,
                    "created_at" => (string) response()->view("admin.contact_email.components.datatable.created_at", compact("created_parser"))->original,
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

        return "dsa";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequirementsRequest $request)
    {
        $data_insert = [
            "name" => $request["name"],
            "url" => $request["url"],
            "category_id" => $request["category_id"],
            "description" => $request["description"],
            "private" => $request["private"] ?? 0,
        ];

        auth()->user()->requirements()->create($data_insert);

        $data_response = [
            "message" => "El Registro se ha realizado correctamente",
            "data_insert" => $data_insert
        ];

        return response()->json($data_response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Requirements  $requirements
     * @return \Illuminate\Http\Response
     */
    public function update(RequirementsRequest $request, $id)
    {
        $requirement = Requirements::findOrFail($id);
        $this->authorize("view", $requirement);

        $data_insert = [
            "name" => $request["name"],
            "url" => $request["url"],
            "category_id" => $request["category_id"],
            "description" => $request["description"],
            "private" => $request["private"] ?? 0,
        ];

        $requirement->update($data_insert);

        $data_response = [
            "message" => "El Registro se ha actualizado correctamente",
            "data_insert" => $data_insert
        ];

        return response()->json($data_response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Requirements  $requirements
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        request()->validate([
            "id" => "required"
        ]);
        $requirement = Requirements::findOrFail($request["id"]);

        $this->authorize("view", $requirement);

        $requirement->delete();

        $data_response = [
            "message" => "El requerimiento se ha eliminado correctamente",
        ];
        return response()->json($request, 200);
    }

    public function category_store(Request $request)
    {
        $data = request()->validate([
            // "name" => "required|unique:categories,name|max:100|string",
            "name" => "required|max:100|string",
        ]);

        $name_categorie = $data["name"];
        $categorie_type = $request["type"] ?? Requirements::class;

        $exist_categorie = Category::where("catgoriable_type", $categorie_type)
            ->where("name", $name_categorie)
            ->count();

        if ($exist_categorie > 0) {
            return response()->json(["message" => "El nombre de la categoría ya está registrado."], 403);
        }

        $name = $data["name"];

        $category = auth()->user()->categories()->create([
            "name" => $name, "catgoriable_type" => Requirements::class,
            "catgoriable_type" => $categorie_type,
        ]);

        $response_data = [
            "message" => "La categoría se ha registrado correctamente.",
            "data_insert" => $category
        ];


        return response()->json($response_data, 200);
    }

    public function category_update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $data = request()->validate([
            // "name" => "required|unique:categories,name," . $id . ",id|max:100|string",
            "name" => "required|max:100|string",
        ]);

        $name = $data["name"];
        $categorie_type = $request["type"] ?? Requirements::class;
        Log::debug($request["type"] ?? "null");
        $exist_categorie = Category::where("catgoriable_type", $categorie_type)
            ->where("name", $name)
            ->where("id", "<>", $id)
            ->first();

        if ($exist_categorie) {
            return response()->json(["message" => "El nombre de la categoría ya está registrado."], 403);
        }


        $category->update(["name" => $name]);

        $category_updated = Category::findOrFail($id);

        $response_data = [
            "message" => "La categoría se ha actualizado correctamente.",
            "data_insert" => $category_updated
        ];

        return response()->json($response_data, 200);
    }

    public function category_delete($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        $response_data = [
            "message" => "La categoría se ha eliminado correctamente",
            "data" => $category
        ];

        return response()->json($response_data, 200);
    }
}
