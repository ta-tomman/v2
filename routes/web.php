<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/** Telegram WebHook **/
Route::post('hook/'.env('TELEGRAM_BOT_TOKEN'), function() { Telegram::commandsHandler(true); });


Route::get('/', function () {
    return view('welcome');
});

