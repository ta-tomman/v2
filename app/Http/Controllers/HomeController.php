<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $auth = $request->session()->get('auth');
        $nik = $auth->login;
        //$permission = $auth->permission;

        return view('home.inactive', compact('nik'));
    }
}
