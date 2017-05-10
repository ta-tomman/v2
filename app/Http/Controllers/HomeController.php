<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

    public function partial(Request $request, $path = '')
    {
        $request->isPartial = true;
        $newReq = Request::create('/'.$path, 'GET');
        $response = Route::dispatch($newReq);

        return $response;
    }

    public function shellTest()
    {
        return view('home.shell');
    }
}
