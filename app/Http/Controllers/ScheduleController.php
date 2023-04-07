<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function make(Request $request) {
        $user = auth()->user();
        $one_hour = 60 * 60;

        // Check if user already have a schedule if it's already expired destroy the last schedule
        if($user->schedule != null) {
            if($user->schedule->expired() && $user->schedule->destroyable()) {
                Schedule::destroy($user->schedule->id);
            } else {
                return back()->with("error", "Can't register a schedule if you already have one this week");
            }
        }

        $rules = [
            "session" => "required",
            "date" => "required|date",
        ];

        if($request->has("with_friend")) {
            $rules["friend_name"] = "required";
            $rules["friend_npm"] = "required";
        }

        $data = $request->validate($rules);

        $date_php_time = strtotime($data["date"]);

        /** Check invalid time registration */
        // Check if user claim an session 4 in Friday
        if(date("w", $date_php_time) === "5" && $data["session"] == "11:00:00") {
            return back()->with("error", "Tidak bisa mendaftarkan jadwal di hari Jum'at sesi 4 karena perpustakaan tutup.");
        }
        // Check if user claim schedule in saturday or sunday
        if(date("w", $date_php_time) === "0" || date("w", $date_php_time) === "6") {
            return back()->with("error", "Tidak bisa mendaftarkan jadwal di hari Sabtu dan Minggu karena perpustakaan tutup");
        }


        $now = time();
        $start = $data["date"] . " " .  $data["session"];
        $end = date("Y-m-d H:i:s", strtotime($start) + $one_hour);

        if($now > strtotime($end))
            return back()->with("error", "Can't register an expired schedule");

        $new_data = [
            "start" => $start,
            "end" => $end,
            "user_id" => $user->id,            
        ];

        if(array_key_exists("friend_name", $data) && array_key_exists("friend_npm", $data)) {
            $new_data["friend_name"] = $data["friend_name"];
            $new_data["friend_npm"] = $data["friend_npm"];
        }

        $schedule = Schedule::create($new_data);

        return back()->with("success", "Schedule created");
    }
}
