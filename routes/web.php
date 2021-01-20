<?php

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

Route::get('/', function () {
    return view('battles.gameStart');
});

Route::resource('/battles', \App\Http\Controllers\ShipController::class);

Route::get('/battles.prediction', [\App\Http\Controllers\ShipController::class,'prediction'])->name('battles.prediction');

Route::get('start', [\App\Http\Controllers\ShipController::class,'start'])->name('start');

Route::get('killSoldiers', [\App\Http\Controllers\SoldierController::class,'killSoldiers'])->name('killSoldiers');

Route::get('/battles.finish', [\App\Http\Controllers\SoldierController::class,'finish'])->name('battles.finish');

Route::post('add-teams-and-soldiers', [\App\Http\Controllers\SoldierController::class,'store']);

Route::get('search', [\App\Http\Controllers\ApiController::class,'search'])->name('search');;
