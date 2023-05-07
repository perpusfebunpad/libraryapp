<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login() {
        return view("auth.login");
    }

    public function authenticate(Request $request) {
        $rules = [
            "npm" => "required|numeric|digits_between:12,12",
            "password" => "required"
        ];

        $validData = $request->validate($rules);
        if(Auth::attempt($validData, true)) {
            $request->session()->regenerate();
            return redirect()->intended("/home");
        }
        return back()->with("error", "Invalid credentials");
    }

    public function register() {
        return view("auth.register");
    }

    public function store(Request $request) {
        $validData = $request->validate([
            "npm" => "required|numeric|digits_between:12,18",
            "name" => "required",
            "email" => "required|email",
            "phone_number" => "required|numeric|digits_between:10,14",
            "departement" => "required", 
            "password" => "required|min:8|confirmed",
        ]);

        $validData["password"] = Hash::make($validData["password"]);
        $user = User::create($validData);
        return redirect("/auth/login")->with("success", "Created your account $user->name");
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
