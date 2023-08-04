<?php

use App\Http\Controllers\Admin;
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

Route::get("/", [ HomeController::class, "index" ]);
Route::get("/closing-schedules", [ HomeController::class, "close_schedules" ]);
Route::redirect("/home", "/");

Route::prefix("/auth")->middleware("guest")->group(function(){
    Route::get("/login", [LoginController::class, "login"])->name("login");
    Route::post("/login", [LoginController::class, "authenticate"]);
    Route::get("/register", [RegisterController::class, "register"])->name("register");
    Route::post("/register", [RegisterController::class, "store"]);
});

Route::get("/auth/logout", [LoginController::class, "logout"])->middleware("auth")->name('logout');

Route::prefix("/profile")->middleware("auth")->group(function(){
    Route::get("/", [ ProfileController::class, "index" ])->name("profile.index");
    Route::get("/edit", [ ProfileController::class, "edit" ])->name("profile.edit");
    Route::put("/", [ ProfileController::class, "update" ])->name("profile.update");
    Route::get("/change-password", [ ChangePasswordController::class, "edit" ])->name("password.edit");
    Route::put("/change-password", [ ChangePasswordController::class, "update" ])->name("password.update");
});

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
