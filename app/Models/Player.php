<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'tag', 'name'
    ];

    public function tournamentTeams()
    {
        return $this->belongsToMany('App\Models\tournaments\TournamentTeam', 'tournament_team_player');
    }
}
