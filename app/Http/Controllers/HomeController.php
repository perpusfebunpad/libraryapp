<?php

namespace App\Http\Controllers;

use App\Models\CloseSchedule;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view("index");
    }

    public function close_schedules() {
        $nearest_close_schedules = CloseSchedule::nearests();
        return view("close-schedules", [
            "schedules" => $nearest_close_schedules,
        ]);
    }

    public function profile() {
        $user = User::find(auth()->user()->id);
        return view("auth.profile", [
            "user" => $user,
        ]);
    }
}
