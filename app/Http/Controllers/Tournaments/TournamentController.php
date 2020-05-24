<?php

namespace App\Http\Controllers\Tournaments;

use Session;
use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tournaments\Tournament;
use App\Models\Tournaments\TournamentTeam;
use App\Models\Tournaments\Game;
use App\Models\Upload;
use App\Models\Tournaments\Sponsor;

class TournamentController extends Controller
{
    public function index()
    {
        return view('tournaments.index', [
            'tournaments' => Tournament::orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function create()
    {
        return view('tournaments.create', [

        ]);
    }

    public function show(Request $request, Tournament $tournament)
    {
        $activeTab = $request->get('activeTab') ?? Session::pull('activeTab') ?? null;
        if (!$activeTab) {
            switch ($tournament->stage) {
                case 'preparation':
                    $activeTab = 'info';
                    break;
                case 'ongoing':
                    $activeTab = 'leaderboard';
                    break;
            }
        }

        return view('tournaments.show', [
            'tournament' => $tournament,
            'activeTab'  => $activeTab,
            'users'      => User::selectRaw('CONCAT(name, " ", email) as name, id')->whereNotIn('id', $tournament->moderators->pluck('id'))->get()->pluck('name', 'id')->prepend('', '')->toArray(),
        ]);
    }

    public function show2(Request $request, Tournament $tournament, String $activeTab = null)
    {
        if (!$activeTab) {
            switch ($tournament->stage) {
                case 'preparation':
                    $activeTab = 'info';
                    break;
                case 'ongoing':
                    $activeTab = 'leaderboard';
                    break;
            }
        }

        return view('tournaments.show', [
            'tournament' => $tournament,
            'activeTab'  => $activeTab,
            'users'      => User::selectRaw('CONCAT(name, " ", email) as name, id')->whereNotIn('id', $tournament->moderators->pluck('id'))->get()->pluck('name', 'id')->prepend('', '')->toArray(),
        ]);
    }

    public function edit(Tournament $tournament)
    {
        return view('tournaments.edit', [
            'tournament' => $tournament
        ]);
    }

    public function update(Request $request, Tournament $tournament)
    {
        $stage = $tournament->stage;
        $tournament->fill($request->all());
        $tournament->stage = $stage;
        $tournament->save();

        return redirect()->route('tournaments.show', $tournament);
    }

    public function store(Request $request)
    {
        $tournament = new Tournament;
        $tournament->fill($request->all());
        $tournament->stage = 'preparation';
        $tournament->save();

        return redirect()->route('tournaments.show', $tournament);
    }

    public function destroy(Tournament $tournament)
    {
        $tournament->delete();

        return redirect()->route('tournaments.index');
    }

    public function approveTeam(TournamentTeam $team)
    {
        Session::put('activeTab', 'players');
        if ($team->tournament->canModerate()) {
            $team->confirmToTournament();

            return redirect()->back()->with('alert-success', __('messages.Team was approved successfully!'));
        } else {
            return redirect()->back()->with('alert-danger', __('messages.You dont have permission to do it!'));
        }
    }

    public function removeTeam(TournamentTeam $team)
    {
        Session::put('activeTab', 'players');

        if ($team->tournament->canModerate()) {
            $team->removeFromTournament();

            return redirect()->back()->with('alert-success', __('messages.Team was removed successfully!'));
        } else {
            return redirect()->back()->with('alert-danger', __('messages.You dont have permission to do it!'));
        }
    }

    public function rejectTeam(TournamentTeam $team)
    {
        Session::put('activeTab', 'players');

        if ($team->tournament->canModerate()) {
            $team->delete();

            return redirect()->back()->with('alert-success', __('messages.Team was rejected successfully!'));
        } else {
            return redirect()->back()->with('alert-danger', __('messages.You dont have permission to do it!'));
        }
    }

    public function addModerator(Request $request, Tournament $tournament)
    {
        if (Auth::user() && Auth::user()->is_admin) {
            if ($tournament) {
                $tournament->moderators()->attach($request->get('user_id'));
            }

            return redirect()->back()->with('alert-success', __('messages.Moderator was succesfully added!'));
        } else {
            return redirect()->back()->with('alert-danger', __('messages.You dont have permission to do it!'));
        }
    }

    public function removeModerator(Request $request)
    {
        if (Auth::user() && Auth::user()->is_admin) {
            $tournament = Tournament::where('id', $request->tournament_id)->first();
            if ($tournament) {
                $tournament->moderators()->detach($request->get('user_id'));
            }

            return redirect()->back()->with('alert-success', __('messages.Moderator was succesfully removed!'));
        } else {
            return redirect()->back()->with('alert-danger', __('messages.You dont have permission to do it!'));
        }
    }

    public function sponsorUpload(Request $request, Tournament $tournament)
    {
        if ($request->file('file')) {
            $sponsor = new Sponsor;
            $sponsor->tournament_id = $tournament->id;
            $sponsor->title = $request->get('title');
            $sponsor->url = $request->get('url');
            $sponsor->save();
    
            $upload = new Upload;
            $upload->saveFile($request->file('file'), $sponsor);
        }

        return redirect()->back();
    }

    public function start(Tournament $tournament)
    {
        Session::put('activeTab', 'players');
        
        if (!$tournament->canModerate() && !Auth::user()->is_admin) {
            return redirect()->back()->with('alert-danger', __('messages.You dont have permission to do it!'));
        }

        if ($tournament->stage != 'preparation') {
            return redirect()->back()->with('alert-danger', __('messages.You dont have permission to do it!'));
        }

        if ($tournament->min_participiants > count($tournament->teams)) {
            return redirect()->back()->with('alert-danger', __('messages.Not enougt teams registered!'));
        }

        $tournament->splitTeamsToGroups();
        $tournament->generateSchedule();

        $tournament->stage = 'ongoing';
        $tournament->save();

        return redirect()->route('tournaments.show', $tournament);
    }

    public function setGameResult(Request $request)
    {
        Session::put('activeTab', 'schedule');

        $game = Game::where('id', $request->get('game_id'))->first();
        if ($game == null) {
            return ['success' => false, 'error' => __('messages.You dont have permission to do it!')];
        }

        if (!$game->tournament->canModerate()) {
            return ['success' => false, 'error' =>  __('messages.You dont have permission to do it!')];
        }

        if ($request->get('home_team_score') == $request->get('away_team_score')) {
            return ['success' => false, 'error' =>  __('messages.Result cant be a draw!')];
        }

        $game->home_team_score = $request->get('home_team_score') ?? 0;
        $game->away_team_score = $request->get('away_team_score') ?? 0;
        $game->winner_id = $request->get('home_team_score') > $request->get('away_team_score') ? $game->home_team_id : $game->away_team_id;
        $game->save();

        return ['success' => true];
    }
}
