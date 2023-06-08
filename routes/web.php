<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScheduleController;
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
    Route::get("/", [Admin\BaseController::class, "index"]);
    Route::post("/verify-schedule", [Admin\BaseController::class, "verify_schedule"]);

    Route::prefix("/users")->controller(Admin\UserController::class)->group(function(){
        Route::get("/", "index");
        Route::get("/create", "create");
        Route::post("/", "store");
        Route::get("/detail/{user:npm}", "show");
        Route::get("/edit/{user:npm}", "edit");
        Route::put("/edit/{user:npm}", "update");
        Route::get("/delete/{user:npm}", "destroy");
    });

    Route::prefix("/close-schedules")->controller(Admin\CloseScheduleController::class)->group(function(){
        Route::get("/", "index");
        Route::get("/create", "create");
        Route::post("/", "store");
        Route::get("/edit/{cs}", "edit");
        Route::put("/edit/{cs}", "update");
        Route::get("/delete/{cs}", "destroy");
    });

    Route::prefix("/schedules")->controller(Admin\ScheduleController::class)->group(function(){
        Route::get("/", "index");
        Route::get("/create", "create");
        Route::post("/", "store");
        Route::get("/edit/{schedule}", "edit");
        Route::put("/edit/{schedule}", "update");
        Route::get("/delete/{schedule}", "destroy");
    });

});

Route::prefix("/auth")->controller(AuthController::class)->group(function(){
    Route::get("/login", "login")->middleware("guest")->name("login");
    Route::post("/login", "authenticate")->middleware("guest");
    Route::get("/register", "register")->middleware("guest");
    Route::post("/register", "store")->middleware("guest");
    Route::get("/logout", "logout")->middleware("auth");
});