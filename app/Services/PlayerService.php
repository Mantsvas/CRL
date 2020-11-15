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
        
        $player->name = $data->name;
        $player->clan_tag = ltrim($data->clan->tag, '#') ?? null;
        $player->level = $data->expLevel ?? null;
        $player->trophies = $data->trophies ?? null;
        $player->bestTrophies = $data->bestTrophies ?? null;
        $player->wins = $data->wins ?? null;
        $player->losses = $data->losses ?? null;
        $player->battlesCount = $data->battlesCount ?? null;
        $player->threeCrownWins = $data->threeCrownWins ?? null;
        $player->challengeCardsWon = $data->challengeCardsWon ?? null;
        $player->challengeMaxWins = $data->challengeMaxWins ?? null;
        $player->tournamentCardsWon = $data->tournamentCardsWon ?? null;
        $player->role = $data->role ?? null;
        $player->donations = $data->donations ?? null;
        $player->donationsReceived = $data->donationsReceived ?? null;
        $player->totalDonations = $data->totalDonations ?? null;
        $player->warDayWins = $data->warDayWins ?? null;
        $player->clanCardsCollected = $data->clanCardsCollected ?? null;
        $player->starPoints = $data->starPoints ?? null;
        $player->clan = json_encode($data->clan ?? []);
        $player->arena = json_encode($data->arena ?? []);
        $player->leagueStatistics = json_encode($data->leagueStatistics ?? []);
        $player->achievements = json_encode($data->achievements ?? []);
        $player->currentDeck = json_encode($data->currentDeck ?? []);
        $player->currentFavouriteCard = json_encode($data->currentFavouriteCard ?? []);
        $player->in_clan = true;
        $player->save();
    }
}