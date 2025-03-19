<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Profile\ChangePasswordController;
use App\Http\Controllers\Profile\ProfileController;
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

// Route::get("/", [ HomeController::class, "index" ])->middleware("guest");
// Route::redirect("/", "/dashboard")->middleware("auth");
// Route::redirect("/home", "/");
Route::get("/", [ HomeController::class, "index" ]);

Route::prefix("/auth")->middleware("guest")->group(function(){
    Route::get("/login", [LoginController::class, "login"])->name("login");
    Route::post("/login", [LoginController::class, "authenticate"]);
    Route::get("/register", [RegisterController::class, "register"])->name("register");
    Route::post("/register", [RegisterController::class, "store"]);
});

Route::get("/auth/logout", [LoginController::class, "logout"])->middleware("auth")->name('logout');

Route::prefix("/dashboard")->middleware("auth")->group(function(){
    Route::get("/", [ Dashboard\DashboardController::class, "index"])->name("dashboard.index");
    Route::get("/closing-schedules", [Dashboard\DashboardController::class, "closing_schedules"])->name("dashboard.closing_schedules");

    Route::prefix("/schedule")->controller(Dashboard\ScheduleController::class)->group(function(){
        Route::get("/", "create")->name("dashboard.schedules.create");
        Route::post("/", "store")->name("dashboard.schedules.store");
    });

    Route::prefix("/profile")->controller(Dashboard\ProfileController::class)->group(function(){
        Route::get("/", "index")->name("dashboard.profile.index");
        Route::get("/edit", "edit")->name("dashboard.profile.edit");
        Route::put("/", "update")->name("dashboard.profile.update");
    });
});

Route::prefix("/admin")->middleware(["auth", "can:moderate"])->group(function(){
    Route::get("/", [Admin\AdminController::class, "index"])->name("admin.index");
    Route::post("/verify-schedule", [Admin\AdminController::class, "verifySchedule"])->name("admin.verify-schedule");

    Route::get("/users/export", [Admin\UserController::class, "export"])->name("users.export");
    Route::resource("/users", Admin\UserController::class);

    Route::get("/schedules/export", [Admin\ScheduleController::class, "export"])->name("schedules.export");
    Route::resource("/schedules", Admin\ScheduleController::class);
    Route::resource("/close-schedules", Admin\CloseScheduleController::class);

    Route::get("/link-storage", function() {
        Artisan::call("storage:link");
        return response()->json([
            "msg" => "Storage linked",
        ]);
    });
});
