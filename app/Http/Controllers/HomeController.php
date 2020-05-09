<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClashRoyaleService as CRApi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // 
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    public function player(CRApi $api, $tag)
    {
        return response([ 'response' => $api->getPlayer($tag)]);
    }
}
