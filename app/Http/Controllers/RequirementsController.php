<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Requirements;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Queue\Console\RetryBatchCommand;
use Illuminate\Support\Facades\DB;
use PharIo\Manifest\Requirement;

class RequirementsController extends Controller
{
    public function get_requirement($id)
    {
        $requirement = Requirements::with(["user", "category"])->findOrFail($id);
        $requirement->user_created = $requirement->user->username;
        $requirement->assigned_category = $requirement->category->name;
        $requirement->created_format = $requirement->created_at->format("d/m/Y H:i:s");

        return response()->json($requirement, 200);
    }

    public function datatable(Request $request)
    {
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

            $data_return = $data_return->limit($limit_val)->get();

            $totalFilteredRecord = (new Requirements())->datatableRequirementsQuery()
                ->where(function ($q) use ($search_text) {
                    $q->where("req.id", "like", "%{$search_text}%")
                        ->orWhere("us.username", "like", "%{$search_text}%")
                        ->orWhere("req.name", "like", "%{$search_text}%")
                        ->orWhere("cat.name", "like", "%{$search_text}%")
                        ->orWhere("req.url", "like", "%{$search_text}%")
                        ->orWhere("req.created_at", "like", "%{$search_text}%");
                })
                ->count();
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

                if ($requirement->category_id) {
                    $category = Category::find($requirement->category_id);
                    $requirement->color_by_category = $category->color;
                } else {
                    $requirement->color_by_category = null;
                }

                $created_parser = Carbon::parse($requirement->req_created_at);

                $details_params = [
                    "class" => "requirements_details",
                    "id" => $requirement->req_id,
                    "route" => route('requirements.get_requirement', ['id' => $requirement->req_id])
                ];

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
                    "category" => (string) response()->view("admin.contact_email.components.datatable.badge", [
                        "color" => $requirement->color_by_category,
                        "text" => $requirement->cat_name,
                    ])->original,
                    "url" => (string) response()->view("admin.contact_email.components.datatable.web", ["url" => $requirement->req_url])->original,
                    "details" => (string) response()->view("admin.contact_email.components.datatable.details", $details_params)->original,
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Requirements  $requirements
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requirements $requirements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Requirements  $requirements
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requirements $requirements)
    {
        //
    }
}
