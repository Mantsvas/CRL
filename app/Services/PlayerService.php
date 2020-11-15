<?php 

namespace App\Services;

use App\Models\Player;
use App\Models\PlayerCard;

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

    public function updateCards(Player $player, $cards)
    {
        $playerCards = $player->cards;
        foreach ($cards as $card) {
            $playerCard = $playerCards->where('card_id', $card->id)->first();
            if (!$playerCard) {
                $playerCard = new PlayerCard;
                $playerCard->card_id = $card->id;
                $playerCard->player_tag = ltrim($player->tag, '#');
            }

            $playerCard->name = $card->name;
            $playerCard->level = $card->level;
            $playerCard->maxLevel = $card->maxLevel;
            $playerCard->starLevel = $card->starLevel ?? null;
            $playerCard->count = $card->count;
            $playerCard->setCollectedAmounts();
            $playerCard->save();
        }
    }
}