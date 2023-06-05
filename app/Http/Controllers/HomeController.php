<?php

namespace App\Http\Controllers;

use App\Models\CloseSchedule;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $nearest_close_schedule = CloseSchedule::nearest();
        return view("index", [
            "nearest_close_schedule" => $nearest_close_schedule,
        ]);
    }

    public function close_schedules() {
        $nearest_close_schedules = CloseSchedule::nearests();
        return view("close-schedules", [
            "schedules" => $nearest_close_schedules,
        ]);
    }
}
