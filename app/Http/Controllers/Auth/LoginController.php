<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAuthenticationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function authenticate(UserAuthenticationRequest $request)
    {
        $credentials = $request->validated();
        if(!Auth::attempt($credentials)) {
            return back()->with("error", "Invalid credentials provided");
        }
        $request->session()->regenerate();
        return redirect()->intended("/");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
