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

    public function players()
    {
        return $this->belongsToMany('App\Models\Player', 'tournament_team_player');
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

    public function getSquad()
    {
        $squad = '';
        foreach($this->players as $player) {
            $squad .= '<span class="btn btn-sm btn-warning m-2 p-2" style="cursor: default">' . $player->name . ' [' . mb_strtoupper($player->tag) . '] </span>';
        }

        return $squad;
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
