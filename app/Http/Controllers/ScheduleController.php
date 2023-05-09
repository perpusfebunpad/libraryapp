<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Schedule;
use App\Models\User;
use Fpdf\Fpdf;


class ScheduleController extends Controller
{
    public function index() {
        $user = auth()->user();
        $schedules = Schedule::where("user_id", $user->id)->orderBy("start")->get();
        $latest_schedule = count($schedules) > 0 ? $schedules[0] : null;
        
        if($latest_schedule && $latest_schedule->invalid()) {
            // TODO: change the action if the latest schedule is invalid
            Schedule::destroy($user->schedule->id);
        }

        return view("schedule", [
            "user_has_valid_schedule" => count($schedules) > 0 && !$latest_schedule->invalid(),
            "user_schedules" => $schedules,
            "user_latest_schedule" => $latest_schedule,
        ]);
    }

    public function make(Request $request) {
        $user = auth()->user();
        $schedules = Schedule::where("user_id", $user->id)->orderBy("start")->get();
        $latest_schedule = count($schedules) > 0 ? $schedules[0] : null;
        $one_hour = 60 * 60;

        // Check if user already have a schedule if it's already invalid do something
        if(count($schedules) > 0) {
            if($latest_schedule->invalid()) {
                // TODO: change the action if the latest schedule is invalid
                Schedule::destroy($user->schedule->id);
            } else {
                return back()->with("error", "Tidak bisa maelakukan registrasi apabila anda sudah memiliki jadwal untuk minggu ini");
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
            return back()->with("error", "Tidak bisa mendaftarkan jadwal di hari yang sudah lewat");

        $new_data = [
            "start" => $start,
            "end" => $end,
            "user_id" => $user->id,
            "verification_code" => Str::uuid(),
        ];

        if(array_key_exists("friend_name", $data) && array_key_exists("friend_npm", $data)) {
            $new_data["friend_name"] = $data["friend_name"];
            $new_data["friend_npm"] = $data["friend_npm"];
        }

        $schedule = Schedule::create($new_data);

        return back()->with("success", "Schedule created for $schedule->start - $schedule->end is created");
    }

    public function proof() {
        $user = auth()->user();
        if($user->schedule == null)
            return redirect("/schedule");
        $schedule = $user->schedule;
        $pdf = new Fpdf();
        $pdf->SetTitle("Bukti registrasi jadwal database refinitiv");
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 24);
        $pdf->Write(5, "Bukti registrasi jadwal");
        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Write(5, "Nama : $user->name");
        $pdf->Ln(5);
        $pdf->Write(5, "NPM : $user->npm");
        $pdf->Ln(5);
        $pdf->Write(5, "Mulai : $schedule->start");
        $pdf->Ln(5);
        $pdf->Write(5, "Akhir : $schedule->end");
        $pdf->Ln(5);
        $pdf->Write(5, "Kode Jadwal : $schedule->verification_code");
        $pdf->Output('D', "bukti-registrasi.pdf");
        // return redirect("/schedule");
    }
}
