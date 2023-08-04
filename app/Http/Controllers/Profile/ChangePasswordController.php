<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordModificationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function edit()
    {
        return view("profile.change-password");
    }

    public function update(PasswordModificationRequest $request)
    {
        $data = $request->validated();
        $data["password"] = Hash::make($data["password"]);
        User::find(auth()->user()->id)->update($data);
        return redirect(route("profile.index"))->with("success", "Password changed");
    }
}
