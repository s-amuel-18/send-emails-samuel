<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        // $this->middleware("can:user.index");
        $this->middleware("can:user.index")->only("index");
        $this->middleware("can:user.create")->only("create", "store");
        $this->middleware("can:user.edit")->only("edit", "update");
        $this->middleware("can:user.destroy")->only("destroy");
    }


    public function index()
    {
        // dd( auth()->user()->roles );
        $users = User::orderBy("created_at", "DESC")->get();

        return view("admin.users.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::orderBy("name", "ASC")->get();

        return view("admin.users.create", compact("roles"));
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
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users', 'regex:/^\S*$/u'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'roles' => ['array', 'nullable'],
        ]);

        $data["password"] = Hash::make($data["password"]);


        $user = User::create($data);

        if ($data["roles"] ?? false) {
            $user->roles()->sync($data["roles"]);
        }


        $message = [
            "message" => "El Usuario <b>{$user->username}</b> Se ha Creado correctamente.",
            "color" => "success",
            "icon" => "far fa-check-circle"
        ];

        return redirect()->route("user.index")->with("message", $message);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::orderBy("name", "ASC")->get();


        return view("admin.users.edit", compact("user", "roles"));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $arr_validate = [
            'name' => ['required', 'string', 'max:255'],
        ];
        // dd($request["password"]);

        if ($request["password"]) {
            $arr_validate["password"] =  ['string', 'min:8', 'confirmed'];
        }

        $data = request()->validate($arr_validate);


        $user->name = $data["name"];

        if (isset($data["password"])) {
            $user->password = Hash::make($data["password"]);
        }

        if ($request->roles) {
            $user->roles()->sync($request->roles);
        }


        $user->save();

        $message = [
            "message" => "El Usuario <b>{$user->username}</b> Se ha Actualizado correctamente.",
            "color" => "success",
            "icon" => "far fa-check-circle"
        ];

        return redirect()->route("user.index")->with("message", $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        $message = [
            "message" => "El Usuario <b>{$user->username}</b> Se ha eliminado correctamente.",
            "color" => "success",
            "icon" => "far fa-check-circle"
        ];

        return redirect()->back()->with("message", $message);
    }
}
