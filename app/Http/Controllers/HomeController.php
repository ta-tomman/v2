<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $auth = $request->session()->get('auth');
        $nik = $auth->login;
        $permission = $auth->permission;

        if (!count($permission)) {
            return view('home.inactive', compact('nik'));
        }

        return view('home.default');
    }

    public function shell()
    {
        return view('shell');
    }
}
