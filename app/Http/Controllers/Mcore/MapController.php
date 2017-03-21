<?php namespace App\Http\Controllers\Mcore;

use \App\Http\Controllers\Controller;

class MapController extends Controller
{
    public function index()
    {
        return view('mcore.map');
    }
}
