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

    public function tournament()
    {
        return $this->belongsTo('App\Models\Tournaments\Tournament', 'tournament_id');
    }

    public function gameDetails()
    {
        return $this->hasMany('App\Models\Tournaments\GameDetail', 'game_id');
    }

    public function gameDetails2vs2()
    {
        return $this->hasMany('App\Models\Tournaments\GameDetail', 'game_id')->where('type', '2vs2');
    }

    public function gameDetailsKOTH()
    {
        return $this->hasMany('App\Models\Tournaments\GameDetail', 'game_id')->where('type', 'KOTH');
    }

    public function gameDetails1vs1()
    {
        return $this->hasMany('App\Models\Tournaments\GameDetail', 'game_id')->where('type', '1vs1');
    }
}
