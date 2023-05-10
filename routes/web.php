<?php

use App\Http\Controllers\AdminCloseScheduleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
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
Route::redirect("/home", "/");

Route::prefix("/schedule")->middleware("auth")->controller(ScheduleController::class)->group(function(){
    Route::get("/", "index");
    Route::post("/", "make");
    Route::get("/proof", "proof");
    Route::get("/get-email", "get_email");
});

Route::prefix("/_")->middleware(["auth", "can:moderate"])->group(function(){
    Route::get("/", [AdminController::class, "index"]);
    Route::post("/verify-schedule", [AdminController::class, "verify_schedule"]);

    Route::prefix("/users")->controller(AdminUserController::class)->group(function(){
        Route::get("/", "index");
        Route::get("/create", "create");
        Route::post("/", "store");
        Route::get("/edit/{user:npm}", "edit");
        Route::put("/edit/{user:npm}", "update");
        Route::get("/delete/{user:npm}", "destroy");
    });

    Route::prefix("/close-schedules")->controller(AdminCloseScheduleController::class)->group(function(){
        Route::get("/", "index");
        Route::get("/create", "create");
        Route::post("/", "store");
        Route::get("/edit/{cs}", "edit");
        Route::put("/edit/{cs}", "update");
        Route::get("/delete/{cs}", "destroy");
    });

});

Route::prefix("/auth")->controller(AuthController::class)->group(function(){
    Route::get("/login", "login")->middleware("guest")->name("login");
    Route::post("/login", "authenticate")->middleware("guest");
    Route::get("/register", "register")->middleware("guest");
    Route::post("/register", "store")->middleware("guest");
    Route::get("/logout", "logout")->middleware("auth");
});