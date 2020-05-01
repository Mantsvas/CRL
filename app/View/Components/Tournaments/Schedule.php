<?php

namespace App\View\Components\Tournaments;

use Illuminate\View\Component;

class Schedule extends Component
{
    public $tournament;
    public $schedule;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tournament)
    {
        $this->tournament = $tournament;
        $this->schedule = $tournament->getSchedule();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.tournaments.schedule');
    }
}
