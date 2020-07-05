<?php

namespace App\View\Components\Tournaments;

use Illuminate\View\Component;

class Playoff extends Component
{
    public $tournament;
    public $quaterFinals;
    public $semiFinals;
    public $finals;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tournament)
    {
        $this->tournament = $tournament;
        $this->quaterFinals = $tournament->getQuaterFinals;
        $this->semiFinals = $tournament->getSemiFinals;
        $this->finals = $tournament->getFinals;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.tournaments.playoff');
    }
}
