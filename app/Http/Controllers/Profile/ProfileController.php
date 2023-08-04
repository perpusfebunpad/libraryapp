<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileModificationRequest;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->user()->id);
        return view("profile.index", [
            "user" => $user,
        ]);
    }

    public function edit()
    {
        $user = User::find(auth()->user()->id);
        return view("profile.edit", [
            "user" => $user,
        ]);
    }

    public function update(ProfileModificationRequest $request)
    {
        $data = $request->validated();
        User::find(auth()->user()->id)->update($data);
        return redirect(route("profile.index"))->with("success", "Profile changed");
    }
}
