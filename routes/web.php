<?php

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

/*
 * Telegram Webhook
 */
Route::post('hook/'.env('TELEGRAM_BOT_TOKEN'), function() {
    // terminate connection early
    // so a command handler doesn't block telegram queue
    header('Connection: close');
    ob_start();
    echo 'OK';
    $size = ob_get_length();
    header("Content-Length: $size");
    ob_end_flush();
    flush();

    // proceeed with Telegram Command handler
    Telegram::commandsHandler(true);
});

Route::group(['prefix' => 'tgram'], function() {
    Route::get('ipayment/{jastel}', 'Billing\IpaymentController@show');
});


/*
 * Authentication
 */
Route::get('login', 'Auth\LoginController@loginPage');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');


/*
 * Normal Routes
 */
Route::group(['middleware' => 'authenticated'], function() {
    Route::get('/', function () {
        return view('welcome');
    });
});

