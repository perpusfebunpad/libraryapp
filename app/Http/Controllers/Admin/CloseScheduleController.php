<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CloseSchedule;
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CloseSchedule  $closeSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(CloseSchedule $closeSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CloseSchedule  $closeSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CloseSchedule $closeSchedule)
    {
        //
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
