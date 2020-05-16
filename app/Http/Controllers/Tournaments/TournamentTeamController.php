<?php

namespace App\Http\Controllers\Tournaments;

use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;
use App\Models\Tournaments\TournamentTeam;
use App\Models\Player;
use App\Services\ClashRoyaleService;

class TournamentTeamController extends Controller
{
    public function show(TournamentTeam $team)
    {
        return view('tournaments.teams.show', [
            'team' => $team 
        ]);
    }

    public function registerTeam(Request $request, ClashRoyaleService $CRapi)
    {
        if (!$request->get('tournament_id') || !$request->get('title')) {
            return redirect()->back();
        }

        $team = new TournamentTeam;
        $team->tournament_id = $request->get('tournament_id');
        $team->title = $request->get('title');
        $team->tag = $request->get('tag');
        $team->capacity = $team->tournament->teamCapacity();
        $team->contacts = $request->get('contacts');
        $team->save();

        $players = [];
        foreach ($request->get('player_tag') as $key => $tag) {
            $players[$key] = ['tag' => $this->fixTag($tag), 'name' => null];
        }

        foreach ($request->get('player_name') as $key => $name) {
            $players[$key]['name'] = $name;
        }

        $this->addPlayerToTeam($players, $team);

        Session::put('activeTab', 'players');
        return redirect()->back()->with('alert-success', __('messages.Registration successfull!'));
    }

    private function fixTag($tag)
    {
        if ($tag[0] == '#') {
            $tag = substr($tag, 1);
        }

        return $tag;
    }

    public function addPlayerToTeam(Array $players, $team) : void
    {
        $ids = [];
        foreach ($players as $key => $playerArray) {
            if ($playerArray['tag'] != null && $playerArray['name'] != null) {
                $player = Player::where(['tag' => $playerArray['tag'], 'name' => $playerArray['name']])->first();
                if (!$player) {
                    $player = Player::create(['tag' => $playerArray['tag'], 'name' => $playerArray['name']]);
                }

                array_push($ids, $player->id);
            }
        }

        $team->players()->sync($ids);
    }
}
