<?php

namespace App\Models\Tournaments;

use Illuminate\Database\Eloquent\Model;

class GameDetail extends Model
{
    public function game()
    {
        $this->belongsTo('App\Models\Tournaments\Game', 'game_id');
    }
}
