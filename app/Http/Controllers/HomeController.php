<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use App\Http\Constants\Constants as Cnst;
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
        $clans = Clan::whereIn('tag', Cnst::CLAN_TAGS)->with(['players', 'riverRaces', 'currentRiverRace', 'location'])->orderBy('clanWarTrophies', 'desc')->get();
        
        return view('welcome', [
            'clans' => $clans,
        ]);
    }

    public function clan(CRApi $api, String $tag)
    {
        $api = new CRApi;
        $data = $api->getClan($tag);
        dd($data);
        return view('clan.index', $data);
    }

    public function player(CRApi $api, $tag)
    {
        $api = new CRApi;
        $data = $api->getPlayer($tag);
        dd($data);
        return view('player.index');
    }
}
