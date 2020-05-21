<?php

namespace App\Http\Controllers\Tournaments;

use Illuminate\Http\Request;
use App\Models\Tournaments\Game;
use App\Models\Tournaments\GameDetail;
use App\Http\Controllers\Controller;
use Auth;

class GameController extends Controller
{
    public function editGameDetails(Game $game)
    {
        if (!$game->tournament->canModerate()) {
            return redirect()->back();
        }

        return view('tournaments.forms.game_details', [
            'game'       => $game,
            'gameDetails' => $game->getDetails(),
        ]);
    }

    public function storeGameDetails(Request $request, Game $game)
    {
        if (!$game->tournament->canModerate()) {
            return redirect()->back();
        }

        $gameDetails = $game->gameDetails;

        $stages = [
            '2vs2' => $request->get('2vs2'),
            'KOTH' => $request->get('KOTH'),
            'overtime' => $request->get('overtime')
        ];

        foreach ($stages as $type => $stage) {
            if ($stage != null) {
                foreach ($stage as $battle => $details) {
                    $exploded = explode('game_', $battle);
                    if (count($exploded) == 2) {
                        $gameDetail =  GameDetail::where(['game_id' => $game->id, 'type' => $type, 'number' => $exploded[1]])->first();
                        if (!isset($gameDetail)) {
                            $gameDetail = new GameDetail;
                            $gameDetail->created_by = Auth::user()->id;
                            $gameDetail->game_id = $game->id;
                            $gameDetail->type = $type;
                            $gameDetail->number = $exploded[1];
                        } else {
                            $gameDetail->updated_by = Auth::user()->id;
                        };

                        switch ($type) {
                            case '2vs2':
                                if (isset($stage['home_team_player_1']) && isset($stage['home_team_player_2']) && isset($stage['away_team_player_1']) && isset($stage['away_team_player_2'])) {
                                    $gameDetail->home_player_1 = $stage['home_team_player_1'];
                                    $gameDetail->home_player_2 = $stage['home_team_player_2'];
                                    $gameDetail->away_player_1 = $stage['away_team_player_1'];
                                    $gameDetail->away_player_2 = $stage['away_team_player_2'];

                                    if (isset($details['homeScore']) && isset($details['awayScore'])) {
                                        $gameDetail->home_score = $details['homeScore'];
                                        $gameDetail->away_score = $details['awayScore'];
                                        if ($gameDetail->home_score > $gameDetail->away_score) {
                                            $gameDetail->winner_id_1 = $gameDetail->home_player_1;
                                            $gameDetail->winner_id_2 = $gameDetail->home_player_2;
                                            $gameDetail->winner_side = 'home';
                                        } else if ($gameDetail->home_score < $gameDetail->away_score) {
                                            $gameDetail->winner_id_1 = $gameDetail->away_player_1;
                                            $gameDetail->winner_id_2 = $gameDetail->away_player_2;
                                            $gameDetail->winner_side = 'away';
                                        } else {
                                            $gameDetail->winner_id_1 = null;
                                            $gameDetail->winner_id_2 = null;;
                                            $gameDetail->winner_side = null;
                                        }

                                        $gameDetail->save();
                                    }

                                }
                            break;
                            case 'KOTH':
                            case 'overtime':
                                if (isset($details['home_team_player']) && isset($details['away_team_player']) && isset($details['homeScore']) && isset($details['awayScore'])) {
                                    $gameDetail->home_player_1 = $details['home_team_player'];
                                    $gameDetail->away_player_1 = $details['away_team_player'];
                                    $gameDetail->home_score = $details['homeScore'];
                                    $gameDetail->away_score = $details['awayScore'];
                                    if ($gameDetail->home_score > $gameDetail->away_score) {
                                        $gameDetail->winner_id_1 = $gameDetail->home_player_1;
                                        $gameDetail->winner_side = 'home';
                                    } else if ($gameDetail->home_score < $gameDetail->away_score) {
                                        $gameDetail->winner_id_1 = $gameDetail->away_player_1;
                                        $gameDetail->winner_side = 'away';
                                    } else {
                                        $gameDetail->winner_id_1 = null;
                                        $gameDetail->winner_side = null;
                                    }
                                    $gameDetail->save();
                                }        
                            break;
                            default:
                        }
                    } 
                }
            }
        }

        $winner2vs2['home'] = GameDetail::where(['game_id' => $game->id, 'type' => '2vs2', 'winner_side' => 'home'])->count();
        $winner2vs2['away'] = GameDetail::where(['game_id' => $game->id, 'type' => '2vs2', 'winner_side' => 'away'])->count();
        $winnerKOTH['home'] = GameDetail::where(['game_id' => $game->id, 'type' => 'KOTH', 'winner_side' => 'home'])->count();;
        $winnerKOTH['away'] = GameDetail::where(['game_id' => $game->id, 'type' => 'KOTH', 'winner_side' => 'away'])->count();;
        $winnerOvertime['home'] = GameDetail::where(['game_id' => $game->id, 'type' => 'overtime', 'winner_side' => 'home'])->count();;
        $winnerOvertime['away'] = GameDetail::where(['game_id' => $game->id, 'type' => 'overtime', 'winner_side' => 'away'])->count();;

        $game->home_team_score = ($winner2vs2['home'] > $winner2vs2['away'] ? 1 : 0) + ($winnerKOTH['home'] > $winnerKOTH['away'] ? 1: 0) + ($winnerOvertime['home'] > $winnerOvertime['away'] ? 1 : 0);
        $game->away_team_score = ($winner2vs2['home'] < $winner2vs2['away'] ? 1 : 0) + ($winnerKOTH['home'] < $winnerKOTH['away'] ? 1: 0) + ($winnerOvertime['home'] < $winnerOvertime['away'] ? 1 : 0);

        if ($game->home_team_score > $game->away_team_score) {
            $game->winner_id = $game->home_team_id;
        } else if ($game->home_team_score < $game->away_team_score) {
            $game->winner_id = $game->away_team_id;
        } else {
            $game->winner_id = null;
        }

        $game->save();
        return redirect()->route('tournaments.show', $game->tournament);
    }
}
