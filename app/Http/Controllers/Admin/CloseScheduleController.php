<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CloseSchedule;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $schedules = CloseSchedule::paginate(10);
        $current_page = $schedules->currentPage();
        $last_page = $schedules->lastPage();
        return view("admin.closing.index", [
            "nearest_schedule" => Schedule::nearests(),

            "closed_schedules" => $schedules,
            "total_pages" => $last_page,
            "current_page" => $current_page,
            "first_link" => $current_page > 3 ? $current_page - 2 : 1,
            "last_link" => $current_page + 2 < $last_page ? $current_page + 2 : $last_page,
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

        $writer = new Xlsx($spreadsheet);

        ob_end_clean();
        return response()->streamDownload(function() use ($writer) {
            $writer->save("php://output");
        }, "schedules-table.xlsx", [ "Content-Type" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.closing.create");
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

        return redirect(route("closing.index"))->with("success", "Successfully creating a new close schedules");
    }

    public function edit(CloseSchedule $closing)
    {
        return view("admin.closing.edit", [
            "close_schedule" => $closing,
            "old_start" => strtotime($closing->start),
            "old_end" => strtotime($closing->end),
        ]);
    }

    public function update(Request $request, CloseSchedule $closing)
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
        CloseSchedule::where("id", $closing->id)->update([
            "start" => $start,
            "end" => $end,
            "reason" => $data["close_reason"],
        ]);

        return redirect(route("closing.index"))->with("success", "Successfully updating a new close schedules");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CloseSchedule  $closeSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(CloseSchedule $closing)
    {
        return redirect(route("closing.index"))->with("success", "Successfully deleting a close schedules");
    }
}
