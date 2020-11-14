<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClanResource;
use CRApi;
use App\Models\Clan;
use App\Services\ClanService;
class ClanController extends Controller
{
    public function show(String $tag)
    {        
        return view('clan.show', compact('tag'));
    }

    public function clanData(String $tag)
    {
        $clan = Clan::where('tag', $tag)->with('players', 'riverRaces', 'currentRiverRace', 'location')->first();

        return new ClanResource($clan);
    }
}
