<?php

namespace App\Http\Controllers\Tournaments;

use Session;
use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tournaments\Tournament;
use App\Models\Tournaments\TournamentTeam;
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
        dd($activeTab);
        return view('tournaments.show', [
            'tournament' => $tournament,
            'activeTab'  => $request->get('activeTab') ?? Session::pull('activeTab') ?? 'info',
            'users'      => User::selectRaw('CONCAT(name, " ", email) as name, id')->whereNotIn('id', $tournament->moderators->pluck('id'))->get()->pluck('name', 'id')->prepend('', '')->toArray(),
        ]);
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
        if ($team->tournament->canModerate()) {
            $team->confirmToTournament();

            return redirect()->back()->with('alert-success', __('messages.Team was approved successfully!'));
        } else {
            return redirect()->back()->with('alert-danger', __('messages.You dont have permission to do it!'));
        }
    }

    public function removeTeam(TournamentTeam $team)
    {
        if ($team->tournament->canModerate()) {
            $team->removeFromTournament();

            return redirect()->back()->with('alert-success', __('messages.Team was removed successfully!'));
        } else {
            return redirect()->back()->with('alert-danger', __('messages.You dont have permission to do it!'));
        }
    }

    public function rejectTeam(TournamentTeam $team)
    {
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
}
