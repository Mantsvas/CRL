<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $casts = [
        'arena' => 'array',
        'leagueStatistics' => 'array',
        'achievements' => 'array',
        'currentDeck' => 'array',
        'currentFavouriteCard' => 'array',
    ];

    public function clan()
    {
        return $this->belongsTo(Clan::class, 'clan_tag', 'tag');
    }
}
