<?php

namespace App\Http\Controllers;

use App\Models\Clan;
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
    public function index(CRApi $api)
    {
        return view('welcome', [
            'clans' => Clan::orderBy('cw_score', 'desc')->get(),
        ]);
    }

    public function player(CRApi $api, $tag)
    {
        $api = new CRApi;
        $data = $api->getPlayer($tag);
        dd($data->name);
        dd($data);
    }
}
