<?php

namespace App\Http\Controllers;

use App\Models\CloseSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Schedule;
use App\Models\User;
use Fpdf\Fpdf;


class ScheduleController extends Controller
{
    public function index() {
        $user = auth()->user();
        $schedules = Schedule::where("user_id", auth()->user()->id)->orderBy("start", "desc")->get()->filter(fn($schedule) => !$schedule->expired());
        $latest_schedule = $schedules->first();
        if($latest_schedule && !$latest_schedule->expired() && !$latest_schedule->closed()) {

        } else {
            $latest_schedule = null;
        }
        return view("schedule", [
            "user_schedules" => $schedules,
            "user_latest_schedule" => $latest_schedule,
        ]);
    }

    public function make(Request $request) {
        $user = auth()->user();
        $one_hour = 60 * 60;

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

        $now = time();
        $prev_week = strtotime("previous Sunday");
        $next_week = strtotime("next Sunday");
        $start = $data["date"] . " " .  $data["session"];
        $end = date("Y-m-d H:i:s", strtotime($start) + $one_hour);

        $in_this_week_schedules = Schedule::where("user_id", $user->id)->orderBy("start", "desc")->get()->filter(fn($schedule) => $schedule->in_range($prev_week, $next_week));

        // Check if already have schedule and if it's a valid schedule don't let to register
        // TODO: fix weekly schedule
        if(count($in_this_week_schedules) > 0 && $prev_week < strtotime($start) && strtotime($end) < $next_week) {
            return back()->with("error", "Anda sudah mendaftarkan jadwal sebelumnya untuk minggu ini. Mohon lakukan pendaftaran lagi di minggu depan");
        }

        /** Check invalid time registration */
        // Check if user claim an session 4 in Friday
        if(date("w", $date_php_time) === "5" && $data["session"] == "11:00:00") {
            return back()->with("error", "Tidak bisa mendaftarkan jadwal di hari Jum'at sesi 4 karena perpustakaan tutup.");
        }

        // Check if user claim schedule in saturday or sunday
        if(date("w", $date_php_time) === "0" || date("w", $date_php_time) === "6") {
            return back()->with("error", "Tidak bisa mendaftarkan jadwal di hari Sabtu dan Minggu karena perpustakaan tutup");
        }

        // Check if user claim in past time
        if($now > strtotime($end)) {
            return back()->with("error", "Tidak bisa mendaftarkan jadwal di hari yang sudah lewat");
        }

        // Check if there's close schedule
        foreach(CloseSchedule::nearests() as $nearest_close_schedule) {
            if($nearest_close_schedule != null && $nearest_close_schedule->clash_with($start, $end)) {
                return back()->with("error", "Jadwal ini tidak bisa diambil karena $nearest_close_schedule->reason perpustakaan akan tutup dari $nearest_close_schedule->start sampai $nearest_close_schedule->end");
            }
        }

        // Check if user claim a claimed schedule
        $schedules_with_same_time = Schedule::where("start", $start)->get();
        if(count($schedules_with_same_time) > 0) {
            return back()->with("error", "Jadwal akses untuk waktu ini sudah diambil tolong pilih waktu yang lainnya");
        }

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
        $schedules = Schedule::get_user_valid_schedules($user->id);
        if(count($schedules) == 0)
            return redirect("/schedule");
        $schedule = $schedules->first();
        $pdf = new Fpdf('L', 'mm', array(150,100));
        $pdf->SetTitle("Bukti registrasi jadwal database refinitiv");
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 24);
        $pdf->Write(5, "Bukti registrasi jadwal");
        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Write(5, "Nama : $user->name");
        $pdf->Ln(7);
        $pdf->Write(5, "NPM/NIP : $user->npm");
        $pdf->Ln(7);
        $pdf->Write(5, "Mulai : $schedule->start");
        $pdf->Ln(7);
        $pdf->Write(5, "Akhir : $schedule->end");
        if($schedule->friend_name != null && $schedule->friend_npm != null) {
            $pdf->Ln(7);
            $pdf->Write(5, "Teman : $schedule->friend_name - $schedule->friend_npm");
        }
        $pdf->Ln(7);
        $pdf->Write(5, "Kode Jadwal : $schedule->verification_code");
        $pdf->Output('D', "bukti-registrasi.pdf");
        // return redirect("/schedule");
    }
}
