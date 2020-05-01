<?php

namespace App\View\Components\Tournaments;

use Illuminate\View\Component;

class Leaderboard extends Component
{
    public $leaderboard;
    public $tournament;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tournament)
    {
        $this->tournament = $tournament;
        $this->leaderboard = $tournament->getLeaderboard();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.tournaments.leaderboard');
    }
}
