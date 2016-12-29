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
Route::post('hook/'.env('TELEGRAM_APIKEY'), function(Request $req) {
    // shell parameter have to be in single line
    $input = str_replace("\n", '', $req->getContent());
    $payload = escapeshellarg($input);

    // working directory is <approot>/public, while artisan is in <approot>
    $cmd = "nohup php ../artisan telegram:bot $payload > /dev/null 2>&1 &";
    exec($cmd);
});


Route::get('/', function () {
    return view('welcome');
});

