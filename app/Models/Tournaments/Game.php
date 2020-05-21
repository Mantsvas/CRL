<?php

namespace App\Models\Tournaments;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function homeTeam()
    {
        return $this->belongsTo('App\Models\Tournaments\TournamentTeam', 'home_team_id')->withDefault(['title' => __('messages.NO GAME')]);
    }

    public function awayTeam()
    {
        return $this->belongsTo('App\Models\Tournaments\TournamentTeam', 'away_team_id')->withDefault(['title' => __('messages.NO GAME')]);
    }

    public function getGroupAttribute()
    {
        return $this->homeTeam->group ? $this->homeTeam->group : $this->awayTeam->group;
    }

    public function tournament()
    {
        return $this->belongsTo('App\Models\Tournaments\Tournament', 'tournament_id');
    }

    public function gameDetails()
    {
        return $this->hasMany('App\Models\Tournaments\GameDetail', 'game_id');
    }

    public function gameDetails2vs2()
    {
        return $this->hasMany('App\Models\Tournaments\GameDetail', 'game_id')->where('type', '2vs2');
    }

    public function gameDetailsKOTH()
    {
        return $this->hasMany('App\Models\Tournaments\GameDetail', 'game_id')->where('type', 'KOTH');
    }

    public function gameDetails1vs1()
    {
        return $this->hasMany('App\Models\Tournaments\GameDetail', 'game_id')->where('type', 'overtime');
    }

    public function getDetails()
    {
        $details = [
            '2vs2' => [
                'homePlayer1' => null,
                'homePlayer2' => null,
                'awayPlayer1' => null,
                'awayPlayer2' => null,
                'game1' => [
                    'homeScore' => null,
                    'awayScore' => null,
                ],
                'game1' => [
                    'homeScore' => null,
                    'awayScore' => null,
                ],
                'game2' => [
                    'homeScore' => null,
                    'awayScore' => null,
                ]
            ],
            'KOTH' => [
                'game1' => [
                    'homePlayer' => null,
                    'awayPlayer' => null,
                    'homeScore' => null,
                    'awayScore' => null
                ],
                'game2' => [
                    'homePlayer' => null,
                    'awayPlayer' => null,
                    'homeScore' => null,
                    'awayScore' => null
                ],
                'game3' => [
                    'homePlayer' => null,
                    'awayPlayer' => null,
                    'homeScore' => null,
                    'awayScore' => null
                ],
                'game4' => [
                    'homePlayer' => null,
                    'awayPlayer' => null,
                    'homeScore' => null,
                    'awayScore' => null
                ],
                'game5' => [
                    'homePlayer' => null,
                    'awayPlayer' => null,
                    'homeScore' => null,
                    'awayScore' => null
                ],
            ],
            '1vs1' => [
                'game1' => [
                    'homePlayer' => null,
                    'awayPlayer' => null,
                    'homeScore' => null,
                    'awayScore' => null
                ],
                'game2' => [
                    'homePlayer' => null,
                    'awayPlayer' => null,
                    'homeScore' => null,
                    'awayScore' => null
                ],
                'game3' => [
                    'homePlayer' => null,
                    'awayPlayer' => null,
                    'homeScore' => null,
                    'awayScore' => null
                ],
            ],
        ];

        foreach ($this->gameDetails2vs2 as $detail) {
            $details['2vs2']['homePlayer1'] = $detail->home_player_1;
            $details['2vs2']['homePlayer2'] = $detail->home_player_2;
            $details['2vs2']['awayPlayer1'] = $detail->away_player_1;
            $details['2vs2']['awayPlayer2'] = $detail->away_player_2;
            $details['2vs2']['game' . $detail->number] = [
                                                            'homeScore' => $detail->home_score,
                                                            'awayScore' => $detail->away_score,
                                                        ];
        }

        foreach ($this->gameDetailsKOTH as $detail) {
            $details['KOTH']['game' . $detail->number] = [
                                                            'homePlayer' => $detail->home_player_1,
                                                            'awayPlayer' => $detail->away_player_1,
                                                            'homeScore' => $detail->home_score,
                                                            'awayScore' => $detail->away_score,
                                                        ];
        }

        foreach ($this->gameDetails1vs1 as $detail) {
            $details['1vs1']['game' . $detail->number] = [
                                                            'homePlayer' => $detail->home_player_1,
                                                            'awayPlayer' => $detail->away_player_1,
                                                            'homeScore' => $detail->home_score,
                                                            'awayScore' => $detail->away_score,
                                                        ];
        }

        return $details;
    }
}
