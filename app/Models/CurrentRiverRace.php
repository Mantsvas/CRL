<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrentRiverRace extends Model
{
    protected $casts = [
        'clans' => 'array',
    ];

    public function clan()
    {
        return $this->belongsTo(Clan::class, 'clan_tag');
    }
}
