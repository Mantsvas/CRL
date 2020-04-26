<?php

namespace App\Models\Tournaments;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Tournament extends Model
{
    protected $fillable = [
        'title', 'description', 'format', 'min_participiants', 'max_participiants', 'group_count', 'playoff_count', 'rules', 'type', 'stage', 'start_date'
    ];

    public function teams()
    {
        return $this->hasMany('App\Models\Tournaments\TournamentTeam', 'tournament_id')->where('confirmed', true);
    }

    public function applicants()
    {
        return $this->hasMany('App\Models\Tournaments\TournamentTeam', 'tournament_id')->withTrashed();
    }

    public function moderators()
    {
        return $this->belongsToMany('App\User', 'tournament_moderator');
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
        } else {
            $tabs['info'] = __('messages.Info');
            $tabs['players'] = __('messages.Leaderboard');
        }
         
        return $tabs;
    }
}
