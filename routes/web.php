<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

//    \App\Models\User::create([
//        "name" => "mazbaz",
//        "email" => "mrlog42@gmail.com",
//        "password" => "passworrrrd1234A"
//    ]);
    return view('welcome');
});
