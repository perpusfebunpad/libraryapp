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
        $closing_schedules = CloseSchedule::paginate(10);
        $current_page = $closing_schedules->currentPage();
        $last_page = $closing_schedules->lastPage();

        return view("admin.close-schedules.index", [
            "closed_schedules" => $closing_schedules,

            "total_pages" => $last_page,
            "current_page" => $current_page,
            "first_link" => $current_page > 3 ? $current_page - 2 : 1,
            "last_link" => $current_page + 2 < $last_page ? $current_page + 2 : $last_page,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CloseSchedule  $closeSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(CloseSchedule $closeSchedule)
    {
        abort(400);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CloseSchedule  $closeSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(CloseSchedule $closeSchedule)
    {
        abort(400);
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
        abort(400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CloseSchedule  $closeSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(CloseSchedule $closeSchedule)
    {
        //
    }
}
