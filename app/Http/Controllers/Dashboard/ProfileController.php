<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->user()->id);
        return view("dashboard.profile.index", [
            "user" => $user
        ]);
    }

    public function edit()
    {
        $user = User::find(auth()->user()->id);
        return view("dashboard.profile.edit", [
            "user" => $user
        ]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $data = $request->validated();
        if(!$data["password"]) {
            unset($data["password"]);
        }

        User::find(auth()->user()->id)->update($data);
        return redirect(route("dashboard.profile.index"))->with("success", "User's profile has been updated");
    }
}
