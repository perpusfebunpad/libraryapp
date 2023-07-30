<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register()
    {
        return view("auth.register");
    }

    public function store(UserCreationRequest $request)
    {
        $data = $request->validated();

        if(Str::length($data["npm"]) !== 18 && $data["status"] !== "MAHASISWA") {
            return redirect("/auth/register")->with("error", "Invalid NIP to become Dosen or Tenaga Didik");
        }

        $data["password"] = Hash::make($data["password"]);
        $user = User::create($data);
        return redirect("/auth/login")->with("success", "Created your account $user->name");
    }
}
