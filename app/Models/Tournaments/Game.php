<?php

namespace App\Models\Tournaments;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function homeTeam()
    {
        return $this->belongsTo('App\Models\Tournaments\TournamentTeam', 'home_team_id')->withDefault(['title' => __('messages.NO GAME')]);
    }

    public function awayTeam()
    {
        return $this->belongsTo('App\Models\Tournaments\TournamentTeam', 'away_team_id')->withDefault(['title' => __('messages.NO GAME')]);
    }

    public function getGroupAttribute()
    {
        return $this->homeTeam->group ? $this->homeTeam->group : $this->awayTeam->group;
    }
}
