<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clan extends Model
{
    protected $fillable = [
        'title', 'tag', 'follow'
    ];

    public function allPlayers()
    {
        return $this->hasMany(Player::class, 'clan_tag', 'tag');
    }
    
    public function players()
    {
        return $this->hasMany(Player::class, 'clan_tag', 'tag')->where('in_clan', true);
    }

    public function riverRaces()
    {
        return $this->belongsToMany(RiverRace::class, 'clan_river_race', 'clan_tag', 'river_race_id', 'tag', 'id');
    }

    public function currentRiverRace()
    {
        return $this->hasOne(CurrentRiverRace::class, 'clan_tag', 'tag');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

}
