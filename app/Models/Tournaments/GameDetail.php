<?php

namespace App\Models\Tournaments;

use Illuminate\Database\Eloquent\Model;

class GameDetail extends Model
{
    public function game()
    {
        $this->belongsTo('App\Models\Tournaments\Game', 'game_id');
    }

    public function homePlayer1()
    {
        return $this->belongsTo('App\Models\Player', 'home_player_1');
    }

    public function homePlayer2()
    {
        return $this->belongsTo('App\Models\Player', 'home_player_2');
    }

    public function awayPlayer1()
    {
        return $this->belongsTo('App\Models\Player', 'away_player_1');
    }

    public function awayPlayer2()
    {
        return $this->belongsTo('App\Models\Player', 'away_player_2');
    }
}
