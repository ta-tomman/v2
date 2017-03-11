<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\SSO;

class LoginController extends Controller
{
    public function loginPage()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $nik  = $request->input('nik');
        $pass = $request->input('pass');

        $ssoResult = SSO::login($nik, $pass);

        if ($ssoResult->success) {
            // TODO: user data via auth table and hrmista
            if ($request->session()->has('auth-originalUrl')) {
                $url = $request->session()->pull('auth-originalUrl');
            } else {
                $url = '/';
            }

            return redirect($url);
        } else {
            // flash old input
            $request->flash();

            // flash proper error message
            switch ($ssoResult->error) {
                case SSO::ERR_PASSWORD_WRONG:
                    $alertText = '<strong>Password</strong> salah. User akan dikunci jika 3x salah password';
                    break;

                case SSO::ERR_USER_NOT_EXIST:
                    $alertText = '<strong>User</strong> tidak terdaftar';
                    break;
            }
            $request->session()->flash('alerts', [
                [
                    'type' => 'danger',
                    'text' => $alertText
                ]
            ]);

            return view('login');
        }
    }
}
