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
        $legendaryCollected = number_format($this->cards->where('maxLevel', 5)->sum('collected_total') / 612 * 100);
        $epicCollected = number_format($this->cards->where('maxLevel', 8)->sum('collected_total') / 10808 * 100);
        $rareCollected = number_format($this->cards->where('maxLevel', 11)->sum('collected_total') / 72408 * 100);
        $commonCollected = number_format($this->cards->where('maxLevel', 13)->sum('collected_total') / 268408 * 100);
        $goldProgress = number_format($this->cards->sum('spent') / 18532500 * 100);

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
            'legendaryCollected'        => $legendaryCollected,
            'epicCollected'             => $epicCollected,
            'rareCollected'             => $rareCollected,
            'commonCollected'           => $commonCollected,
            'goldProgress'              => $goldProgress,
        ];
    }
}
