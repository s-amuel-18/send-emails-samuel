<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{


    public function __construct()
    {
        // $this->middleware("can:user.index");
        $this->middleware("can:role.index")->only("index");
        $this->middleware("can:role.create")->only("create", "store");
        $this->middleware("can:role.edit")->only("edit", "update");
        $this->middleware("can:role.destroy")->only("destroy");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(auth()->user());
        $roles = Role::orderBy("created_at", "DESC")->get();

        // dd(auth()->user()->roles);

        return view("admin.role.index", compact("roles"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
        return view("admin.role.create", compact("permissions"));
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
            "name" => "required|string|max:255",
            "permissions" => "required|array|min:1"
        ]);


        $role = Role::create(["name" => $data["name"]]);

        $role->permissions()->sync($data["permissions"]);

        $message = [
            "message" => "Rol Creado Correctamente",
            "color" => "success",
            "type" => "success",
        ];

        return redirect()->route("role.index")->with("message", $message);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::get();
        // dd($role->permissions);

        return view("admin.role.edit", compact("role", "permissions"));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $data = request()->validate([
            "name" => "required|string|max:255",
            "permissions" => "required|array|min:1"
        ]);


        $role->name = $data["name"];

        // $role->permissions->removeRole($role);

        $role->revokePermissionTo($data["permissions"]);
        $role->permissions()->sync($data["permissions"]);

        $message = [
            "message" => "Rol Se ha Actualizado Correctamente",
            "color" => "success",
            "type" => "success",
        ];

        return redirect()->route("role.index")->with("message", $message);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        $message = [
            "message" => "El Rol <b>{$role->name}</b> Se ha eliminado correctamente.",
            "color" => "success",
            "icon" => "far fa-check-circle"
        ];

        return redirect()->back()->with("message", $message);
    }
}
