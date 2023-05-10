<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view("admin.index");
    }
    
    public function verify_schedule(Request $request) {
        $data = $request->validate([
            "verification_code" => "required",
        ]);
        $vcode = $data["verification_code"];
        $schedules = Schedule::all();
        $data = Schedule::where("verification_code", $vcode)->get();
        if(count($data) > 0) {
            $jadwal = $data[0];
            $pemilik = $jadwal->owner;

            if($jadwal->expired())
                return back()->with("success", "Jadwal atas nama $pemilik->name sudah expired");
            else
                return back()->with("success", "Jadwal dari $jadwal->start - $jadwal->end atas nama $pemilik->name masih valid");
        } else {
            return back()->with("error", "Jadwal dengan kode $vcode tidak ditemukan.");
        }
    }
}
