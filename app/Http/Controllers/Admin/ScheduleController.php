<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::paginate(10);
        $current_page = $schedules->currentPage();
        $last_page = $schedules->lastPage();
        return view("admin.schedules.index", [
            "schedules" => $schedules,
            "total_pages" => $last_page,
            "current_page" => $current_page,
            "first_link" => $current_page > 3 ? $current_page - 2 : 1,
            "last_link" => $current_page + 2 < $last_page ? $current_page + 2 : $last_page,
        ]);
    }

    public function export()
    {
        $schedules = Schedule::all();
        $spreadsheet = new Spreadsheet();
        $asheet = $spreadsheet->getActiveSheet();
        $asheet->setCellValue("A1", "id");
        $asheet->setCellValue("B1", "start");
        $asheet->setCellValue("C1", "end");
        $asheet->setCellValue("D1", "friend_name");
        $asheet->setCellValue("E1", "friend_npm");
        $asheet->setCellValue("F1", "verification_code");
        $asheet->setCellValue("G1", "user_id");

        foreach($schedules as $key => $schedule) {
            $key += 2;
            $asheet->setCellValue("A".$key, $schedule->id);
            $asheet->setCellValue("B".$key, $schedule->start);
            $asheet->setCellValue("C".$key, $schedule->end);
            $asheet->setCellValue("D".$key, $schedule->friend_name);
            $asheet->setCellValue("E".$key, $schedule->friend_npm);
            $asheet->setCellValue("G".$key, $schedule->user_id);
            $asheet->setCellValue("F".$key, $schedule->verification_code);
        }

        $writer = new Xlsx($spreadsheet);

        ob_end_clean();
        return response()->streamDownload(function() use ($writer) {
            $writer->save("php://output");
        }, "schedules-table.xlsx", [ "Content-Type" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" ]);
    }

    public function create()
    {
        return view("admin.schedules.create");
    }

    public function store(Request $request)
    {
        abort(400);
    }

    public function show(Schedule $schedule)
    {
        abort(400);
    }

    public function edit(Schedule $schedule)
    {
        abort(400);
    }

    public function update(Request $request, Schedule $schedule)
    {
        abort(400);
    }

    public function destroy(Schedule $schedule)
    {
        Schedule::destroy($schedule->id);
        return redirect("schedules.index")->with("success", "Successfully deleting a schedules");
    }
}
