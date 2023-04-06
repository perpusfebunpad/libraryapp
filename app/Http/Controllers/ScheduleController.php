<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function make(Request $request) {
        $user = auth()->user();
        $two_hour = 60 * 60 * 2;

        // Check if user already have a schedule if it's already expired destroy the last schedule
        if($user->schedule != null) {
            if($user->schedule->expired() && $user->schedule->destroyable()) {
                Schedule::destroy($user->schedule->id);
            } else {
                return back()->with("error", "Can't register a schedule if you already have one this week");
            }
        }

        $data = $request->validate([
            "session" => "required",
            "date" => "required|date",
        ]);
        $now = time();
        $start = $data["date"] . " " .  $data["session"];
        $end = date("Y-m-d H:i:s", strtotime($start) + $two_hour);

        if($now > strtotime($end))
            return back()->with("error", "Can't register an expired schedule");

        $schedule = Schedule::create([
            "start" => $start,
            "end" => $end,
            "user_id" => $user->id,
        ]);

        return back()->with("success", "Schedule created");
    }
}
