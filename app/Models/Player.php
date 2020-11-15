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

    public function cards()
    {
        return $this->hasMany(PlayerCard::class, 'player_tag', 'tag');
    }

    public function setBasicData($data)
    {
        $this->name = $data->name;
        $this->role = $data->role ?? null;
        $this->level = $data->expLevel ?? null;
        $this->trophies = $data->trophies ?? null;
        $this->arena = json_encode($data->arena ?? []);
        $this->donations = $data->donations ?? null;
        $this->donationsReceived = $data->donationsReceived ?? null;
        $this->in_clan = true;
    }

    public function setAdvanceData($data)
    {
        $this->clan_tag = ltrim($data->clan_tag, '#') ?? null;
        $this->bestTrophies = $data->bestTrophies ?? null;
        $this->wins = $data->wins ?? null;
        $this->losses = $data->losses ?? null;
        $this->battlesCount = $data->battlesCount ?? null;
        $this->threeCrownWins = $data->threeCrownWins ?? null;
        $this->challengeCardsWon = $data->challengeCardsWon ?? null;
        $this->challengeMaxWins = $data->challengeMaxWins ?? null;
        $this->tournamentCardsWon = $data->tournamentCardsWon ?? null;
        $this->totalDonations = $data->totalDonations ?? null;
        $this->warDayWins = $data->warDayWins ?? null;
        $this->clanCardsCollected = $data->clanCardsCollected ?? null;
        $this->starPoints = $data->starPoints ?? null;
        $this->clan = json_encode($data->clan ?? []);
        $this->leagueStatistics = json_encode($data->leagueStatistics ?? []);
        $this->achievements = json_encode($data->achievements ?? []);
        $this->currentDeck = json_encode($data->currentDeck ?? []);
        $this->currentFavouriteCard = json_encode($data->currentFavouriteCard ?? []);
    }
}
