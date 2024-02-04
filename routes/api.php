<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TicketApiController;
use App\Models\Platform;
use App\Models\Status;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::name("auth.")->prefix("auth")->group(function () {

    Route::controller(AuthController::class)->group(function ($router) {
        Route::post('login', 'login')->name('login');
        Route::post('logout', 'logout')->name('logout')->middleware('auth.token');
        Route::post('refresh', 'refresh')->name('refresh');
        Route::middleware('auth.token')->get('/me', "me");
    });
});

Route::resource("ticket", TicketApiController::class, [
    'except' => ["edit"],
]);

Route::get("/ticket/ident/{identifier}", [TicketApiController::class, "getByIdentifier"]);


Route::get("status", function () {
    return Status::orderBy('order', 'DESC')->get();
});

Route::get("platforms", function () {
    return Platform::all();
});

Route::resource("client", ClientController::class, [
    'except' => ["edit", "update", "index", "destroy", "create"],
]);

Route::get("/client/ident/{identifier}", [ClientController::class, "getByIdentifier"]);

Route::post("/message", [MessageController::class, "store"]);
