<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CloseSchedule;
use App\Models\Schedule;
use Illuminate\Http\Request;

class CloseScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.close-schedules.index", [
            "closed_schedules" => CloseSchedule::all(),
            "nearest_schedule" => Schedule::nearests(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.close-schedules.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "start_date" => "required|date",
            "start_time" => "required|date_format:H:i",
            "end_date" => "required|date",
            "end_time" => "required|date_format:H:i",
            "close_reason" => "required",
        ]);

        $start = $data["start_date"] . " " . $data["start_time"] . ":" . date("i", strtotime($data["start_time"]));
        $end = $data["end_date"] . " " . $data["end_time"] . ":" . date("i", strtotime($data["end_time"]));
        $close = CloseSchedule::create([
            "start" => $start,
            "end" => $end,
            "reason" => $data["close_reason"],
        ]);

        return redirect("/_/close-schedules")->with("success", "Successfully creating a new close schedules");
    }

    public function edit(CloseSchedule $cs)
    {
        return view("admin.close-schedules.edit", [
            "close_schedule" => $cs,
            "old_start" => strtotime($cs->start),
            "old_end" => strtotime($cs->end),
        ]);
    }

    public function update(Request $request, CloseSchedule $cs)
    {
        $data = $request->validate([
            "start_date" => "required|date",
            "start_time" => "required|date_format:H:i",
            "end_date" => "required|date",
            "end_time" => "required|date_format:H:i",
            "close_reason" => "required",
        ]);

        $start = $data["start_date"] . " " . $data["start_time"] . ":" . date("i", strtotime($data["start_time"]));
        $end = $data["end_date"] . " " . $data["end_time"] . ":" . date("i", strtotime($data["end_time"]));
        CloseSchedule::where("id", $cs->id)->update([ 
            "start" => $start, 
            "end" => $end, 
            "reason" => $data["close_reason"], 
        ]);

        return redirect("/_/close-schedules")->with("success", "Successfully updating a new close schedules");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CloseSchedule  $closeSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(CloseSchedule $cs)
    {
        CloseSchedule::destroy($cs->id);
        return redirect("/_/close-schedules")->with("success", "Successfully deleting a close schedules");
    }
}
