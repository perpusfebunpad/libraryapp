<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CloseSchedule;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ScheduleController extends Controller
{
    public function create()
    {
        $user = User::find(auth()->user()->id);
        return view("dashboard.schedules.create", [
            "user" => $user,
        ]);
    }

    public function store(Request $request)
    {
        $DATE_FORMAT = "Y-m-d H:i:s";
        $MAXIMUM_SCHEDULE_PER_USER = 3;

        $rules = [
            "session" => "required",
            "date" => "required|date",
        ];

        if($request->has("with_friend")) {
            $rules["friend_name"] = "required";
            $rules["friend_npm"] = "required";
        }

        $data = $request->validate($rules);
        $user = User::find(auth()->user()->id);

        $now = time();
        $prev_week = strtotime("previous Sunday");
        $next_week = strtotime("next Sunday");
        $start = strtotime($data["date"] . " " . $data["session"]);
        $end = $start + 60*60;
        
        if($now > $end) {
            return back()->with("error", "Tidak dapat mendaftarkan jadwal di waktu yang sudah lewat");
        }

        // Check if user claim an session 4 in Friday
        if(date("w", $start) === "5" && $data["session"] == "11:00:00") {
            return back()->with("error", "Tidak bisa mendaftarkan jadwal di hari Jum'at sesi 4 karena perpustakaan tutup.");
        }

        if(date("w", $start) == "0" || date("w", $start) == "6") {
            return back()->with("error", "Tidak bisa mendaftarkan jadwal di hari Sabtu dan Minggu karena perpustakaan tutup");
        }

        if(Schedule::where("start", date($DATE_FORMAT, $start))->get()->count() > 0) {
            return back()->with("error", "Jadwal sudah diklaim");
        }

        foreach(CloseSchedule::nearests() as $nearest_close_schedule) {
            if($nearest_close_schedule != null && $nearest_close_schedule->clash_with($start, $end)) {
                return back()->with("error", "Jadwal ini tidak bisa diambil karena $nearest_close_schedule->reason perpustakaan akan tutup dari $nearest_close_schedule->start sampai $nearest_close_schedule->end");
            }
        }

        $in_this_week_schedules = Schedule::where("user_id", $user->id)->orderBy("start", "desc")->get()->filter(fn($schedule) => $schedule->in_range($prev_week, $next_week));
        if(!(count($in_this_week_schedules) < $MAXIMUM_SCHEDULE_PER_USER) 
            && $prev_week < $start && $end < $next_week) 
        {
            return back()->with("error", "Pembuatan jadwal hanya diperbolehkan maximum $MAXIMUM_SCHEDULE_PER_USER setiap minggunya");
        }

        $new_data = [
            "start" => date($DATE_FORMAT, $start),
            "end" => date($DATE_FORMAT, $end),
            "user_id" => $user->id,
            "verification_code" => Str::uuid(),
        ];

        if(array_key_exists("friend_name", $data) && array_key_exists("friend_npm", $data)) {
            $new_data["friend_name"] = $data["friend_name"];
            $new_data["friend_npm"] = $data["friend_npm"];
        }

        $schedule = Schedule::create($new_data);

        return redirect(route("dashboard.index"))->with("success", "Jadwal $schedule->start - $schedule->end berhasil didaftarkan");
    }
}
