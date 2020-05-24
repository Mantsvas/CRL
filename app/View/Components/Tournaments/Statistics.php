<?php

namespace App\View\Components\Tournaments;

use Illuminate\View\Component;
use App\Models\Tournaments\Game;
use App\Models\Tournaments\GameDetail;
use App\Models\Player;

class Statistics extends Component
{
    public $tournament;
    public $rankingByWins2vs2;
    public $rankingByWinsKOTH;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tournament)
    {
        $this->tournament = $tournament;

        $this->getLeaders();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.tournaments.statistics');
    }

    private function getLeaders()
    {
        $games = Game::where('tournament_id', $this->tournament->id)->whereHas('gameDetails')->with(['gameDetails2vs2', 'gameDetailsKOTH', 'gameDetails1vs1'])->whereNotNull('winner_id')->get();

        $details2vs2 = [];
        $detailsKOTH = [];

        foreach ($games as $game) {
            foreach ($game->gameDetails2vs2 as $detail) {
                if (!isset($details2vs2[$detail->home_player_1])) {
                    $details2vs2[$detail->home_player_1] = $this->setEmptyDataset();
                    $details2vs2[$detail->home_player_1]['player'] = $detail->homePlayer1;
                }

                if (!isset($details2vs2[$detail->home_player_2])) {
                    $details2vs2[$detail->home_player_2] = $this->setEmptyDataset();
                    $details2vs2[$detail->home_player_2]['player'] = $detail->homePlayer2;
                }

                if (!isset($details2vs2[$detail->away_player_1])) {
                    $details2vs2[$detail->away_player_1] = $this->setEmptyDataset();
                    $details2vs2[$detail->away_player_1]['player'] = $detail->awayPlayer1;
                }

                if (!isset($details2vs2[$detail->away_player_2])) {
                    $details2vs2[$detail->away_player_2] = $this->setEmptyDataset();
                    $details2vs2[$detail->away_player_2]['player'] = $detail->awayPlayer2;
                }

                if ($detail->winner_side == 'home') {
                    $details2vs2[$detail->home_player_1]['won'] += 1; 
                    $details2vs2[$detail->home_player_2]['won'] += 1;
                }

                if ($detail->winner_side == 'away') {
                    $details2vs2[$detail->away_player_1]['won'] += 1;
                    $details2vs2[$detail->away_player_2]['won'] += 1;
                }

                $details2vs2[$detail->home_player_1]['played'] += 1; 
                $details2vs2[$detail->home_player_2]['played'] += 1;
                $details2vs2[$detail->away_player_1]['played'] += 1;
                $details2vs2[$detail->away_player_2]['played'] += 1;

                $details2vs2[$detail->home_player_1]['winPercent'] = $details2vs2[$detail->home_player_1]['won'] / $details2vs2[$detail->home_player_1]['played'] * 100;
                $details2vs2[$detail->home_player_2]['winPercent'] = $details2vs2[$detail->home_player_2]['won'] / $details2vs2[$detail->home_player_2]['played'] * 100;
                $details2vs2[$detail->away_player_1]['winPercent'] = $details2vs2[$detail->away_player_1]['won'] / $details2vs2[$detail->away_player_1]['played'] * 100;
                $details2vs2[$detail->away_player_2]['winPercent'] = $details2vs2[$detail->away_player_2]['won'] / $details2vs2[$detail->away_player_2]['played'] * 100;

                $details2vs2[$detail->home_player_1]['crowsCollected'] += $detail->home_score; 
                $details2vs2[$detail->home_player_2]['crowsCollected'] += $detail->home_score;
                $details2vs2[$detail->away_player_1]['crowsCollected'] += $detail->away_score;
                $details2vs2[$detail->away_player_2]['crowsCollected'] += $detail->away_score;

                $details2vs2[$detail->home_player_1]['crowsLost'] += $detail->away_score; 
                $details2vs2[$detail->home_player_2]['crowsLost'] += $detail->away_score;
                $details2vs2[$detail->away_player_1]['crowsLost'] += $detail->home_score;
                $details2vs2[$detail->away_player_2]['crowsLost'] += $detail->home_score;
            }
            
            foreach ($game->gameDetailsKOTH as $detail) {
                if (!isset($detailsKOTH[$detail->home_player_1])) {
                    $detailsKOTH[$detail->home_player_1] = $this->setEmptyDataset();
                    $detailsKOTH[$detail->home_player_1]['player'] = $detail->homePlayer1;
                }

                if (!isset($detailsKOTH[$detail->away_player_1])) {
                    $detailsKOTH[$detail->away_player_1] = $this->setEmptyDataset();
                    $detailsKOTH[$detail->away_player_1]['player'] = $detail->awayPlayer1;
                }

                if ($detail->winner_side == 'home') {
                    $detailsKOTH[$detail->home_player_1]['won'] += 1; 
                }

                if ($detail->winner_side == 'away') {
                    $detailsKOTH[$detail->away_player_1]['won'] += 1;
                }

                $detailsKOTH[$detail->home_player_1]['played'] += 1; 
                $detailsKOTH[$detail->away_player_1]['played'] += 1;

                $detailsKOTH[$detail->home_player_1]['winPercent'] = $detailsKOTH[$detail->home_player_1]['won'] / $detailsKOTH[$detail->home_player_1]['played'] * 100;
                $detailsKOTH[$detail->away_player_1]['winPercent'] = $detailsKOTH[$detail->away_player_1]['won'] / $detailsKOTH[$detail->away_player_1]['played'] * 100;

                $detailsKOTH[$detail->home_player_1]['crowsCollected'] += $detail->home_score; 
                $detailsKOTH[$detail->away_player_1]['crowsCollected'] += $detail->away_score;

                $detailsKOTH[$detail->home_player_1]['crowsLost'] += $detail->away_score; 
                $detailsKOTH[$detail->away_player_1]['crowsLost'] += $detail->home_score;
            }

            foreach ($game->gameDetails1vs1 as $detail) {
                if (!isset($detailsKOTH[$detail->home_player_1])) {
                    $detailsKOTH[$detail->home_player_1] = $this->setEmptyDataset();
                    $detailsKOTH[$detail->home_player_1]['player'] = $detail->homePlayer1;
                }

                if (!isset($detailsKOTH[$detail->away_player_1])) {
                    $detailsKOTH[$detail->away_player_1] = $this->setEmptyDataset();
                    $detailsKOTH[$detail->away_player_1]['player'] = $detail->awayPlayer1;
                }

                if ($detail->winner_side == 'home') {
                    $detailsKOTH[$detail->home_player_1]['won'] += 1; 
                }

                if ($detail->winner_side == 'away') {
                    $detailsKOTH[$detail->away_player_1]['won'] += 1;
                }

                $detailsKOTH[$detail->home_player_1]['played'] += 1; 
                $detailsKOTH[$detail->away_player_1]['played'] += 1;

                $detailsKOTH[$detail->home_player_1]['winPercent'] = $detailsKOTH[$detail->home_player_1]['won'] / $detailsKOTH[$detail->home_player_1]['played'] * 100;
                $detailsKOTH[$detail->away_player_1]['winPercent'] = $detailsKOTH[$detail->away_player_1]['won'] / $detailsKOTH[$detail->away_player_1]['played'] * 100;

                $detailsKOTH[$detail->home_player_1]['crowsCollected'] += $detail->home_score; 
                $detailsKOTH[$detail->away_player_1]['crowsCollected'] += $detail->away_score;

                $detailsKOTH[$detail->home_player_1]['crowsLost'] += $detail->away_score; 
                $detailsKOTH[$detail->away_player_1]['crowsLost'] += $detail->home_score;
            }
        }

        $this->rankingByWins2vs2 = collect($details2vs2)->sortByDesc('winPercent');
        $this->rankingByWinsKOTH = collect($detailsKOTH)->sortByDesc('winPercent');
    }

    private function setEmptyDataset()
    {
        return [
            'won'               => 0,
            'played'            => 0,
            'crowsCollected'    => 0,
            'crowsLost'         => 0,
            'winPercent'        => null,
        ];
    }
}
