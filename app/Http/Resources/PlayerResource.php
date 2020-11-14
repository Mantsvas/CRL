<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlayerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'tag'                       => $this->tag,
            'name'                      => $this->name,
            'clan_tag'                  => $this->clan_tag,
            'level'                     => $this->level,
            'trophies'                  => $this->trophies,
            'bestTrophies'              => $this->bestTrophies,
            'wins'                      => $this->wins,
            'losses'                    => $this->losses,
            'battlesCount'              => $this->battlesCount,
            'threeCrownWins'            => $this->threeCrownWins,
            'challengeCardsWon'         => $this->challengeCardsWon,
            'challengeMaxWins'          => $this->challengeMaxWins,
            'tournamentCardsWon'        => $this->tournamentCardsWon,
            'tournamentBattleCount'     => $this->tournamentBattleCount,
            'role'                      => $this->role,
            'donations'                 => $this->donations,
            'donationsReceived'         => $this->donationsReceived,
            'totalDonations'            => $this->totalDonations,
            'warDayWins'                => $this->warDayWins,
            'clanCardsCollected'        => $this->clanCardsCollected,
            'starPoints'                => $this->starPoints,
            'clan'                      => json_decode($this->clan),
            'arena'                     => json_decode($this->arena),
            'leagueStatistics'          => json_decode($this->leagueStatistics),
            'achievements'              => json_decode($this->achievements),
            'currentDeck'               => json_decode($this->currentDeck),
            'currentFavouriteCard'      => json_decode($this->currentFavouriteCard),
        ];
    }
}
