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
        $pass = $request->input('nik');

        $ssoResult = SSO::login($nik, $pass);

        return $ssoResult;
    }
}
