<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CloseSchedule;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $user = User::find(auth()->user()->id);

        $schedules = Schedule::
            where("end", ">", date("Y-m-d H:i:s"))
            ->where("active", true)
            ->paginate(10);
        $current_page = $schedules->currentPage();
        $last_page = $schedules->lastPage();

        $user_nearest_schedule = Schedule::
            where("end", ">", date("Y-m-d H:i:s"))
            ->where("active", true)
            ->where("user_id", $user->id)
            ->first();

        return view("dashboard.index", [
            "user" => $user,
            "user_nearest_schedule" => $user_nearest_schedule,

            "schedules" => $schedules,
            "total_pages" => $last_page,
            "current_page" => $current_page,
            "first_link" => $current_page > 3 ? $current_page - 2 : 1,
            "last_link" => $current_page + 2 < $last_page ? $current_page + 2 : $last_page,
        ]);

        // $schedules = Schedule::where("user_id", auth()->user()->id)->orderBy("start", "desc")->get()->filter(fn($schedule) => !$schedule->expired());
        // $latest_schedule = $schedules->first();
        // if($latest_schedule && !$latest_schedule->expired() && !$latest_schedule->closed()) {

        // } else {
        //     $latest_schedule = null;
        // }
    }

    public function closing_schedules()
    {
        $nearest_closing_schedules = CloseSchedule::nearests();
        return view("dashboard.closing-schedules", [
            "schedules" => $nearest_closing_schedules,
            "user" => User::find(auth()->user()->id),
        ]);
    }
}
