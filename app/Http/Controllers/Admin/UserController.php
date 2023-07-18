<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.users.index", [
            "users" => User::all(),
        ]);
    }

    public function export() {
        $users = User::all();
        $spreadsheet = new Spreadsheet();
        $asheet = $spreadsheet->getActiveSheet();
        $asheet->setCellValue("A1", "id");
        $asheet->setCellValue("B1", 'name');
        $asheet->setCellValue("C1", 'npm');
        $asheet->setCellValue("D1", 'email');
        $asheet->setCellValue("E1", 'password');
        $asheet->setCellValue("F1", "status");
        $asheet->setCellValue("G1", "departement");
        $asheet->setCellValue("H1", "phone_number");
        $asheet->setCellValue("I1", "role");

        foreach($users as $key => $user) {
            $key += 2;
            $asheet->setCellValue("A".$key, $user->id);
            $asheet->setCellValue("B".$key, $user->name);
            $asheet->setCellValue("C".$key, $user->npm);
            $asheet->setCellValue("D".$key, $user->email);
            $asheet->setCellValue("E".$key, $user->password);
            $asheet->setCellValue("F".$key, $user->status);
            $asheet->setCellValue("G".$key, $user->departement);
            $asheet->setCellValue("H".$key, $user->phone_number);
            $asheet->setCellValue("I".$key, $user->role);
        }

        ob_clean();
        $xlsx = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="users-table_' . time() . '.xlsx"');
        header('Cache-Control: max-age=0');
        ob_end_clean();
        $xlsx->save("php://output");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            "npm" => "required|numeric|digits_between:12,18|unique:users",
            "name" => "required",
            "email" => "required|email",
            "phone_number" => "required|numeric|digits_between:10,14",
            "departement" => "required", 
            "password" => "required|min:8|confirmed",
            "status" => "required",
            "role" => "required",
        ]);
        $validData["password"] = Hash::make($validData["password"]);
        $newUser =  User::create($validData);
        return redirect("/_/users")->with("success", "Successfully create a new user");
    }

    public function show(User $user) {
        return view("admin.users.show", [
            "user" => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view("admin.users.edit", [
            "user" => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // dd($request->all());
        $validData = $request->validate([
            "npm" => "required|numeric|digits_between:12,18|unique:users,npm," . $user->id ,
            "name" => "required",
            "email" => "required|email",
            "phone_number" => "required|numeric|digits_between:10,14",
            "departement" => "required", 
            "status" => "required",
            "role" => "required",
            "password" => "nullable|min:8|confirmed"
        ]);

        if($validData["password"] == null) {
            unset($validData["password"]);
        } else {
            $validData["password"] = Hash::make($validData["password"]);
        }

        User::where("id", $user->id)->update($validData);
        return redirect("/_/users")->with("success", "Successfully update an user");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $name = $user->name;
        User::destroy($user->id);
        return back()->with("success", "User \"$name\" is deleted from the database");
    }
}
