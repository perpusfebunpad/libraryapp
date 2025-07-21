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
    public function closing() {
        $user = User::find(auth()->user()->id);

        $closed_schedules = CloseSchedule::all();
        $nearest_closing_schedules = $closed_schedules->filter(fn($schedule) => !$schedule->expired());
        // $nearest_closing_schedules = CloseSchedule::nearests();
        $nearest_closing_schedule = CloseSchedule::
            where("end", ">", date("Y-m-d H:i:s"))
            ->get();

        return view("schedules.closing", [
            "schedules" => $nearest_closing_schedules,
            "user" => User::find(auth()->user()->id),
        ]);
    }

    public function index() {
        $user = User::find(auth()->user()->id);

        $user_nearest_schedule = Schedule::
            where("end", ">", date("Y-m-d H:i:s"))
            ->where("active", true)
            ->where("user_id", $user->id)
            ->first();

        $schedules = Schedule::orderBy("start", "desc")
            // ->where("end", ">", date("Y-m-d H:i:s"))
            // ->where("active", true)
            ->paginate(10);
        $current_page = $schedules->currentPage();
        $last_page = $schedules->lastPage();

        return view("schedules.index", [
            "user_schedules" => $schedules,
            "user_nearest_schedule" => $user_nearest_schedule,

            "schedules" => $schedules,
            "total_pages" => $last_page,
            "current_page" => $current_page,
            "first_link" => $current_page > 3 ? $current_page - 2 : 1,
            "last_link" => $current_page + 2 < $last_page ? $current_page + 2 : $last_page,
        ]);
    }

    public function create() {
        $user = User::find(auth()->user()->id);
        return view("schedules.create", [
            "user" => $user,
        ]);
    }

    public function store(Request $request) {
        $DATE_FORMAT = "Y-m-d H:i:s";

        $rules = [
            "session" => "required",
            "date" => "required|date",
            "location" => "required",
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

        if(Schedule::where("start", date($DATE_FORMAT, $start))->where("location", $data["location"])->exists()) {
            return back()->with("error", "Jadwal sudah diklaim");
        }

        foreach(CloseSchedule::nearests() as $nearest_close_schedule) {
            if($nearest_close_schedule != null && $nearest_close_schedule->clash_with($start, $end)) {
                return back()->with("error", "Jadwal ini tidak bisa diambil karena $nearest_close_schedule->reason perpustakaan akan tutup dari $nearest_close_schedule->start sampai $nearest_close_schedule->end");
            }
        }

        // Ini merupakan logic untuk pembatasan jumlah jadwal per-orang
        $MAXIMUM_SCHEDULE_PER_USER = 3;
        $in_this_week_schedules = Schedule::where("user_id", $user->id)->orderBy("start", "desc")->get()->filter(fn($schedule) => $schedule->in_range($prev_week, $next_week));
        if(!(count($in_this_week_schedules) <= $MAXIMUM_SCHEDULE_PER_USER)
            && $prev_week < $start && $end < $next_week)
        {
            return back()->with("error", "Pembuatan jadwal hanya diperbolehkan maximum $MAXIMUM_SCHEDULE_PER_USER setiap minggunya");
        }

        $new_data = [
            "start" => date($DATE_FORMAT, $start),
            "end" => date($DATE_FORMAT, $end),
            "user_id" => $user->id,
            "verification_code" => Str::uuid(),
            "location" => $data["location"],
        ];

        if(array_key_exists("friend_name", $data) && array_key_exists("friend_npm", $data)) {
            $new_data["friend_name"] = $data["friend_name"];
            $new_data["friend_npm"] = $data["friend_npm"];
        }

        $schedule = Schedule::create($new_data);

        return redirect(route("user.schedules.index"))->with("success", "Jadwal $schedule->start - $schedule->end berhasil didaftarkan");
    }

    // public function old_store(Request $request) {
    //     $user = auth()->user();
    //     $one_hour = 60 * 60;

    //     $rules = [
    //         "session" => "required",
    //         "date" => "required|date",
    //     ];

    //     if($request->has("with_friend")) {
    //         $rules["friend_name"] = "required";
    //         $rules["friend_npm"] = "required";
    //     }

    //     $data = $request->validate($rules);

    //     $date_php_time = strtotime($data["date"]);

    //     $now = time();
    //     $prev_week = strtotime("previous Sunday");
    //     $next_week = strtotime("next Sunday");
    //     $start = $data["date"] . " " .  $data["session"];
    //     $end = date("Y-m-d H:i:s", strtotime($start) + $one_hour);

    //     $in_this_week_schedules = Schedule::where("user_id", $user->id)->orderBy("start", "desc")->get()->filter(fn($schedule) => $schedule->in_range($prev_week, $next_week));

    //     // Check if already have schedule and if it's a valid schedule don't let to register
    //     // TODO: fix weekly schedule
    //     if(count($in_this_week_schedules) > 0 && $prev_week < strtotime($start) && strtotime($end) < $next_week) {
    //         return back()->with("error", "Anda sudah mendaftarkan jadwal sebelumnya untuk minggu ini. Mohon lakukan pendaftaran lagi di minggu depan");
    //     }

    //     /** Check invalid time registration */
    //     // Check if user claim an session 4 in Friday
    //     if(date("w", $date_php_time) === "5" && $data["session"] == "11:00:00") {
    //         return back()->with("error", "Tidak bisa mendaftarkan jadwal di hari Jum'at sesi 4 karena perpustakaan tutup.");
    //     }

    //     // Check if user claim schedule in saturday or sunday
    //     if(date("w", $date_php_time) === "0" || date("w", $date_php_time) === "6") {
    //         return back()->with("error", "Tidak bisa mendaftarkan jadwal di hari Sabtu dan Minggu karena perpustakaan tutup");
    //     }

    //     // Check if user claim in past time
    //     if($now > strtotime($end)) {
    //         return back()->with("error", "Tidak bisa mendaftarkan jadwal di hari yang sudah lewat");
    //     }

    //     // Check if there's close schedule
    //     foreach(CloseSchedule::nearests() as $nearest_close_schedule) {
    //         if($nearest_close_schedule != null && $nearest_close_schedule->clash_with($start, $end)) {
    //             return back()->with("error", "Jadwal ini tidak bisa diambil karena $nearest_close_schedule->reason perpustakaan akan tutup dari $nearest_close_schedule->start sampai $nearest_close_schedule->end");
    //         }
    //     }

    //     // Check if user claim a claimed schedule
    //     $schedules_with_same_time = Schedule::where("start", $start)->get();
    //     if(count($schedules_with_same_time) > 0) {
    //         return back()->with("error", "Jadwal akses untuk waktu ini sudah diambil tolong pilih waktu yang lainnya");
    //     }

    //     $new_data = [
    //         "start" => $start,
    //         "end" => $end,
    //         "user_id" => $user->id,
    //         "verification_code" => Str::uuid(),
    //     ];

    //     if(array_key_exists("friend_name", $data) && array_key_exists("friend_npm", $data)) {
    //         $new_data["friend_name"] = $data["friend_name"];
    //         $new_data["friend_npm"] = $data["friend_npm"];
    //     }

    //     $schedule = Schedule::create($new_data);

    //     return back()->with("success", "Schedule created for $schedule->start - $schedule->end is created");
    // }

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
        // $pdf->Output('D', "bukti-registrasi.pdf");
        // return redirect("/schedule");
        return response($pdf->Output('S', 'bukti-registrasi.pdf'))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="bukti-registrasi.pdf"');
    }
}
