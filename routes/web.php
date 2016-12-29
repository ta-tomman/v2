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
    //$json = escapeshellarg($req->getContent());
    //exec("nohup php artisan telegram:bot $json > /dev/null 2>&1 &");
    $json = $req->getContent();
    header('HTTP/1.1 200 OK'); Artisan::call('telegram:bot', ['json' => $json]);
});


Route::get('/', function () {
    return view('welcome');
});

