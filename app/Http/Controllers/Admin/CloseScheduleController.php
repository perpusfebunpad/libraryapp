<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CloseSchedule;
use App\Models\Schedule;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

    public function export()
    {
        $close_schedules = CloseSchedule::all();
        $spreadsheet = new Spreadsheet();
        $asheet = $spreadsheet->getActiveSheet();
        $asheet->setCellValue("A1", "id");
        $asheet->setCellValue("B1", "start");
        $asheet->setCellValue("C1", 'end');
        $asheet->setCellValue("D1", 'reason');

        foreach($close_schedules as $key => $close_schedule) {
            $key += 2;
            $asheet->setCellValue("A".$key, $close_schedule->id);
            $asheet->setCellValue("B".$key, $close_schedule->start);
            $asheet->setCellValue("C".$key, $close_schedule->end);
            $asheet->setCellValue("D".$key, $close_schedule->reason);
        }
        ob_clean();
        $xlsx = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="close-schedules-table_' . time() . '.xlsx"');
        header('Cache-Control: max-age=0');
        ob_end_clean();
        return $xlsx->save("php://output");

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
