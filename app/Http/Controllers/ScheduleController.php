<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Schedule;
use App\Models\User;
use Fpdf\Fpdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


class ScheduleController extends Controller
{
    public function index() {
        $user = auth()->user();
        if($user->schedule !== null && $user->schedule->expired() && $user->schedule->destroyable()) {
            Schedule::destroy($user->schedule->id);
        }
        return view("schedule");
    }

    public function make(Request $request) {
        $user = auth()->user();
        $one_hour = 60 * 60;

        // Check if user already have a schedule if it's already expired destroy the last schedule
        if($user->schedule != null) {
            if($user->schedule->expired() && $user->schedule->destroyable()) {
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

        return back()->with("success", "Schedule created");
    }

    public function get_email() {
        $user = auth()->user();
        if($user->schedule === null)
            return back()->with("error", "You don't have any schedule");
        $schedule = $user->schedule;
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; // TODO: set into SMTP::DEBUG_OFF on production
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->SMTPSecure = "tls";
        $mail->SMTPAuth = true;
        $mail->isHTML(true);
        $mail->Username = env("MAIL_USERNAME");
        $mail->Password = env("MAIL_PASSWORD");
        $mail->setFrom(env("MAIL_USERNAME"), "Noreply");
        $mail->addAddress($user->email);
        $mail->Subject = "Bukti registrasi Jadwal akses Database Refinitiv FEB UNPAD";
        $mail->msgHTML("
<h1>Bukti registrasi Jadwal akses Database Refinitiv FEB UNPAD</h1>
<table>
    <tr>
        <td>Nama:</td>
        <td>$user->name</td>
    </tr>
    <tr>
        <td>Jadwal:</td>
        <td>$schedule->start - $schedule->end</td>
    </tr>
    <tr>
        <td>Kode Verifikasi:</td>
        <td>$schedule->verification_code</td>
    </tr>
</table>
        ");
        if(!$mail->send()) {
            return back()->with("error", "Failed to send email $mail->ErrorInfo");
        } else {
            return back()->with("success", "Email is sent");
        }
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
