<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $user = User::find(auth()->user()->id);
        return view("dashboard.index", [
            "user" => $user,
        ]);
    }
}
