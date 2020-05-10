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

    public function fixedTag()
    {
        $tag = $this->tag;
        if ($tag[0] == '#') {
            $tag = substr($tag, 1);
        }

        $tag = str_replace('O', '0', $tag);

        return $tag;
    }
}
