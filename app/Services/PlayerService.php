<?php 

namespace App\Services;

use App\Models\Player;

class PlayerService 
{
    public function createOrUpdate(Object $data, Player $player = null)
    {
        if (!$player) {
            $player = new Player();
            $player->tag = ltrim($data->tag, '#');
        }
        
        $player->setBasicData($data);
        $player->setAdvanceData($data);
        $player->save();
    }

    public function quickPlayerUpdate($data, $clanTag, Player $player = null)
    {
        if (!$player) {
            $player = new Player();
            $player->tag = ltrim($data->tag, '#');
        }

        $player->clan_tag = $clanTag;
        $player->setBasicData($data);
        $player->save();
    }
}