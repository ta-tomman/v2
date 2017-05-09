<?php namespace App\Http\Controllers\Mcore;

use \App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index(Request $request)
    {
        return view('mcore.map');
    }
}
