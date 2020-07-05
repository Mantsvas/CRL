<?php

namespace App\Models\Tournaments;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TournamentTeam extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title', 'capacity', 'tag', 'tournament_id'
    ];

    public function tournament()
    {
        return $this->belongsTo('App\Models\Tournaments\Tournament');
    }

    public function homeGames()
    {
        return $this->hasMany('App\Models\Tournaments\Game', 'home_team_id')->whereIn('stage', ['regular', 'extra']);
    }

    public function awayGames()
    {
        return $this->hasMany('App\Models\Tournaments\Game', 'away_team_id')->whereIn('stage', ['regular', 'extra']);
    }

    public function getWinsAttribute()
    {
        return count($this->homeGames->where('winner_id', $this->id)) + count($this->awayGames->where('winner_id', $this->id));
    }

    public function getLosesAttribute()
    {
        return count($this->homeGames->where('winner_id', '!=', $this->id)->where('winner_id', '!=', null)) + count($this->awayGames->where('winner_id', '!=', null)->where('winner_id', '!=', $this->id));
    }

    public function getScoreAttribute()
    {
        return $this->homeGames->where('winner_id', '!=', null)->sum('home_team_score') + $this->awayGames->where('winner_id', '!=', null)->sum('away_team_score');
    }

    public function getScoreAgainstAttribute()
    {
        return $this->homeGames->where('winner_id', '!=', null)->sum('away_team_score') + $this->awayGames->where('winner_id', '!=', null)->sum('home_team_score');
    }

    public function getWinPercentAttribute()
    {
        return round(($this->wins + $this->loses) != 0 ? $this->wins / ($this->wins + $this->loses) * 100 : 0);
    }

    public function getGamesAttribute()
    {
        return $this->homeGames->merge($this->awayGames);
    }

    public function players()
    {
        return $this->belongsToMany('App\Models\Player', 'tournament_team_player')->orderBy('max_trophies', 'desc');
    }

    public function getStatus()
    {
        $status = '';
        if ($this->deleted_at) {
            $status = __('messages.Rejected');
        } elseif ($this->confirmed) {
            $status = __('messages.Approved');
        } else {
            $status = __('messages.Waiting for approval');
        }

        return $status;
    }

    public function confirmToTournament() : void
    {
        $this->confirmed = true;
        $this->save();
    }

    public function removeFromTournament() : void
    {
        $this->confirmed = false;
        $this->save();
    }
}
