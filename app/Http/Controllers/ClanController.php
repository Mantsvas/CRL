<?php

namespace App\Http\Controllers;

use CRApi;
use App\Models\Clan;
use App\Services\ClanService;
class ClanController extends Controller
{
    public function show(CRApi $api, String $tag)
    {        
        return view('clan.show', [
            'clan' => Clan::where('tag', $tag)->first()
        ]);
    }
}
