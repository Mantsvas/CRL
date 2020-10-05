<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clan extends Model
{
    protected $fillable = [
        'title', 'tag', 'follow'
    ];

    public function getRiverRaceAttribute()
    {
        return json_decode($this->current_river_race);
    }
}
