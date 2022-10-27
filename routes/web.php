<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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

Route::get("/",[ HomeController::class,"index" ])->name("index");

Route::prefix("/issue-ticket")->group(function (){
    Route::post("/store", [ HomeController::class,"storeTicket" ])->name("ticket.store");
});

Route::prefix("/login")->group(function (){
    Route::get("/", [ AdminController::class, "login" ])->name("login");
    Route::post("/store", [ AdminController::class, "loginStore" ])->name("login.store");
});

Route::prefix("/admin")->middleware("is_admin")->group(function (){
    Route::get("/home", [ AdminController::class, "home" ])->name("home");
    Route::get("/issue-ticket/detail/{id}", [ AdminController::class, "ticketDetail" ])->name("ticket.detail");
    Route::post("/developer/assign", [ AdminController::class, "assignDeveloper" ])->name("assign.developer");
    Route::get("/issue-ticket/update-status/{id}", [ AdminController::class, "statusUpdate" ])->name("status.update");
});
