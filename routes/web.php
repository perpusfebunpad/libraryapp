<?php

use App\Http\Controllers\AuthController;
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

Route::view("/", "index");
Route::view("/schedule", "schedule")->middleware("auth");
Route::redirect("/home", "/");

Route::prefix("/schedule")->middleware("auth")->controller(ScheduleController::class)->group(function(){
    Route::view("/", "schedule");
    Route::post("/", "make");
    Route::get("/proof", "proof");
});

Route::prefix("/auth")->controller(AuthController::class)->group(function(){
    Route::get("/login", "login")->middleware("guest")->name("login");
    Route::post("/login", "authenticate")->middleware("guest");
    Route::get("/register", "register")->middleware("guest");
    Route::post("/register", "store")->middleware("guest");
    Route::get("/logout", "logout")->middleware("auth");
});