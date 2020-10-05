<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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
        $clans = Clan::orderBy('cw_score', 'desc')->get();
        $now = \Carbon\Carbon::now();
        $diff = $now->diffInSeconds($clans->first()->updated_at);
        if ($diff > 600) {
            Artisan::call('UpdateCWResults');
            $clans = Clan::orderBy('cw_score', 'desc')->get();
        }
        return view('welcome', [
            'clans' => $clans,
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
