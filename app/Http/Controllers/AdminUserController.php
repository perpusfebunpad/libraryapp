<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.users.index", [
            "users" => User::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            "npm" => "required|numeric|digits_between:12,18|unique:users",
            "name" => "required",
            "email" => "required|email",
            "phone_number" => "required|numeric|digits_between:10,14",
            "departement" => "required", 
            "password" => "required|min:8|confirmed",
            "status" => "required",
            "role" => "required",
        ]);
        $newUser =  User::create($validData);
        return redirect("/_/users")->with("success", "Successfully create a new user");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view("admin.users.edit", [
            "user" => $user,
        ]);
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
        // dd($request->all());
        $validData = $request->validate([
            "npm" => "required|numeric|digits_between:12,18|unique:users,npm," . $user->id ,
            "name" => "required",
            "email" => "required|email",
            "phone_number" => "required|numeric|digits_between:10,14",
            "departement" => "required", 
            "status" => "required",
            "role" => "required",
        ]);

        User::where("id", $user->id)->update($validData);
        return redirect("/_/users")->with("success", "Successfully update an user");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $name = $user->name;
        User::destroy($user->id);
        return back()->with("success", "User \"$name\" is deleted from the database");
    }
}
