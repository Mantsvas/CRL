<?php

namespace App\Models\Tournaments;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tournaments\Game;
use Auth;

class Tournament extends Model
{
    protected $fillable = [
        'title', 'description', 'description_en', 'format', 'min_participiants', 'max_participiants', 'group_count', 
        'playoff_count', 'rules', 'rules_en', 'type', 'stage', 'start_date', 'video_link'
    ];

    public function teams()
    {
        return $this->hasMany('App\Models\Tournaments\TournamentTeam', 'tournament_id')->where('confirmed', true)->with(['homeGames', 'awayGames']);
    }

    public function applicants()
    {
        return $this->hasMany('App\Models\Tournaments\TournamentTeam', 'tournament_id')->withTrashed();
    }

    public function moderators()
    {
        return $this->belongsToMany('App\User', 'tournament_moderator');
    }

    public function games()
    {
        return $this->hasMany('App\Models\Tournaments\Game', 'tournament_id')->where('stage', 'regular');
    }

    public function getQuaterFinals()
    {
        return $this->hasMany('App\Models\Tournaments\Game', 'tournament_id')->where('stage', 'playoff')->whereIn('round', [4, 5, 6, 7])->orderBy('round', 'asc');
    }

    public function getSemiFinals()
    {
        return $this->hasMany('App\Models\Tournaments\Game', 'tournament_id')->where('stage', 'playoff')->whereIn('round', [2, 3])->orderBy('round', 'asc');
    }

    public function getFinals()
    {
        return $this->hasMany('App\Models\Tournaments\Game', 'tournament_id')->where('stage', 'playoff')->whereIn('round', [1])->orderBy('round', 'asc');
    }

    public function playoffGames()
    {
        return $this->hasMany('App\Models\Tournaments\Game', 'tournament_id')->where('stage', 'playoff');
    }

    public function sponsors()
    {
        return $this->hasMany('App\Models\Tournaments\Sponsor');
    }

    public function teamCapacity()
    {
        if ($this->type == 'clans') {
            return 9;
        } elseif ($this->type == '2vs2') {
            return 2;
        } elseif ($this->type == '1vs1') {
            return 1;
        } else {
            return 0;
        }
    }

    public function canModerate()
    {
        if (Auth::user() && (Auth::user()->is_admin || count($this->moderators->where('id', Auth::user()->id)))) {
            return true;
        } else {
            return false;
        } 
    }

    public function tabs()
    {
        $tabs = [];

        if ($this->stage == 'preparation') {
            $tabs['info'] = __('messages.Info');
            $tabs['players'] = __('messages.Participiants') . ' / ' . __('messages.Registration');
            $tabs['rules'] = __('messages.Rules');
        } elseif ($this->stage == 'ongoing') {
            $tabs['info'] = __('messages.Info');
            $tabs['leaderboard'] = __('messages.Leaderboard');
            $tabs['schedule'] = __('messages.Schedule');
            $tabs['rules'] = __('messages.Rules');
            $tabs['statistics'] = __('messages.Statistics');
        } elseif ($this->stage == 'playoff') {
            $tabs['info'] = __('messages.Info');
            $tabs['leaderboard'] = __('messages.Leaderboard');
            $tabs['schedule'] = __('messages.Schedule');
            $tabs['playoff'] = __('messages.Playoff');
            $tabs['rules'] = __('messages.Rules');
            $tabs['statistics'] = __('messages.Statistics');
        }
         
        return $tabs;
    }

    public function setActiveTab()
    {
        switch ($this->stage) {
            case 'preparation':
                return 'info';
                break;
            case 'ongoing':
                return 'leaderboard';
                break;
            case 'playoff':
                return 'playoff';
                break;
        }

        return 'info';
    }

    public function splitTeamsToGroups() : void
    {
        $group = 'A';
        $groups = [];
        for ($j = 1; $j <= $this->group_count; $j++) {
            $groups[$group] = [];
            $lastGroup = $group;
            $group++;
        }

        $group = 'A';
        foreach ($this->teams as $team) {
            $team->group = $group;
            $team->save();
            $group = $group == $lastGroup ? 'A' : ++$group;
        }
    }

    public function generateSchedule()
    {
        $group = 'A';
        $groups = [];

        for ($i = 1; $i <= $this->group_count; $i++) {
            $groups[] = $group++;
        }

        foreach ($groups as $group) {

            $teams = $this->teams->where('group', $group);
            $teamsArray = [];
            foreach ($teams as $team) {
                array_push($teamsArray, $team);
            }
            $teamCount = count($teams);
            //Account for odd number of teams by adding a bye
            if ($teamCount % 2 === 1) {
                array_push($teamsArray, null);;
                $teamCount += 1;
            }

            $rounds = $teamCount - 1;
            $halfTeamCount = $teamCount / 2 -1;
            for($round = 0; $round < $rounds; $round += 1) {
                for ($i = 0; $i <= $halfTeamCount; $i++) {
                    $newGame = new Game;
                    $newGame->tournament_id = $this->id;
                    $newGame->team_type = 'App\Models\Tournaments\TournamentTeam';
                    $newGame->home_team_id = isset($teamsArray[$halfTeamCount - $i]) ? $teamsArray[$halfTeamCount - $i]->id : null;
                    $newGame->away_team_id = isset($teamsArray[$i + $halfTeamCount + 1]) ? $teamsArray[$i + $halfTeamCount + 1]->id : null;
                    $newGame->real_game = isset($teamsArray[$halfTeamCount - $i]) && isset($teamsArray[$i + $halfTeamCount + 1]);
                    $newGame->round = $round + 1;
                    $newGame->save();
                }

                $tmp = $teamsArray[1];
                for ($i = 1; $i < count($teamsArray) - 1; $i++) {
                    $teamsArray[$i] = $teamsArray[$i+1];
                }
                $teamsArray[count($teamsArray) -1] = $tmp;
            }
        }
    }

    public function getLeaderboard()
    {
        $leaderboard = [];
        $group = 'A';
        for ($i = 1; $i <= $this->group_count; $i++) {
            $leaderboard[$group] = [];
            $group++;
        }

        $teams = $this->teams
                        ->sortByDesc('extra')
                        ->sortByDesc(function ($team, $key) {
                            $score = $team->score;
                            if ($team->id == 16 || $team->id == 23) {
                                $score++;
                            }
                            return $score - $team->score_against;
                        })
                        ->sortByDesc('wins')
                        ->sortByDesc('win_percent')
                            ;
        foreach ($teams as $team) {
            $group = $team->group;
            $games = $team->homeGames->merge($team->awayGames);
            $leaderboard[$group][] = $team;
        }

        return $leaderboard;
    }

    public function setPlayoffTree()
    {
        $leaderboard = $this->getLeaderboard();

        $seeds = [];
        $seedIndex = 1;
        foreach ($leaderboard as $group) {
            foreach ($group as $team) {
                if ($seedIndex > 8) {
                    continue;
                }
                $seeds[$seedIndex] = $team;
                $seedIndex++;
            }
        }

        $games = [];
        $games[1] = [ 'team_1' => $seeds[1], 'team_2' => $seeds[8], 'round' => 4];
        $games[2] = [ 'team_1' => $seeds[4], 'team_2' => $seeds[5], 'round' => 5 ];
        $games[3] = [ 'team_1' => $seeds[3], 'team_2' => $seeds[6], 'round' => 6 ];
        $games[4] = [ 'team_1' => $seeds[2], 'team_2' => $seeds[7], 'round' => 7 ];
        $games[5] = ['team_1' => null, 'team_2' => null, 'round' => 2];
        $games[6] = ['team_1' => null, 'team_2' => null,'round' => 3 ];
        $games[7] = ['team_1' => null, 'team_2' => null, 'round' => 1 ];

        foreach ($games as $game) {
            $newGame = new Game;
            $newGame->tournament_id = $this->id;
            $newGame->team_type = 'App\Models\Tournaments\TournamentTeam';
            $newGame->home_team_id = $game['team_1']->id ?? null;
            $newGame->away_team_id = $game['team_2']->id ?? null;
            $newGame->real_game = true;
            $newGame->round = $game['round'];
            $newGame->stage = 'playoff';
            $newGame->save();
        }
    }

    public function getSchedule()
    {
        $games = $this->games->sortBy('round')->sortBy('group')->sortBy('round');
        $shcedule = [];

        foreach ($games as $game) {
            $schedule[$game->round][$game->homeTeam->group ? $game->homeTeam->group : $game->awayTeam->group][] = $game;
        }

        return $schedule;
    }
}
