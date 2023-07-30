<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", [ HomeController::class, "index" ]);
Route::get("/closing-schedules", [ HomeController::class, "close_schedules" ]);
Route::redirect("/home", "/");
Route::get("/auth/profile", [HomeController::class, "profile"])->middleware("auth");

Route::prefix("/schedule")->middleware("auth")->controller(ScheduleController::class)->group(function(){
    Route::get("/", "index");
    Route::post("/", "make");
    Route::get("/proof", "proof");
    Route::get("/get-email", "get_email");
});

Route::prefix("/_")->middleware(["auth", "can:moderate"])->group(function(){
    Route::get("/", [Admin\DashboardController::class, "index"]);
    Route::post("/verify-schedule", [Admin\DashboardController::class, "verifySchedule"]);

    Route::prefix("/users")->controller(Admin\UserController::class)->group(function(){
        Route::get("/", "index");
        Route::get("/create", "create");
        Route::post("/", "store");
        Route::get("/detail/{user:npm}", "show");
        Route::get("/edit/{user:npm}", "edit");
        Route::put("/edit/{user:npm}", "update");
        Route::get("/delete/{user:npm}", "destroy");
        Route::get("/export", "export");
    });

    Route::prefix("/close-schedules")->controller(Admin\CloseScheduleController::class)->group(function(){
        Route::get("/", "index");
        Route::get("/create", "create");
        Route::post("/", "store");
        Route::get("/edit/{cs}", "edit");
        Route::put("/edit/{cs}", "update");
        Route::get("/delete/{cs}", "destroy");
        Route::get("/export", "export");
    });

    Route::prefix("/schedules")->controller(Admin\ScheduleController::class)->group(function(){
        Route::get("/", "index");
        Route::get("/create", "create");
        Route::post("/", "store");
        Route::get("/edit/{schedule}", "edit");
        Route::put("/edit/{schedule}", "update");
        Route::get("/delete/{schedule}", "destroy");
        Route::get("/export", "export");
    });

    Route::get("/link-storage", function() {
        Artisan::call("storage:link");
        return response()->json([
            "msg" => "Storage linked",
        ]);
    });
});

Route::prefix("/auth")->group(function(){
    Route::get("/login", [LoginController::class, "login"])->middleware("guest")->name("login");
    Route::post("/login", [LoginController::class, "authenticate"])->middleware("guest");
    Route::get("/logout", [LoginController::class, "logout"])->middleware("auth");
    Route::get("/register", [RegisterController::class, "register"])->middleware("guest");
    Route::post("/register", [RegisterController::class, "store"])->middleware("guest");
});