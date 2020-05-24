<?php

namespace App\View\Components\Tabs;

use Illuminate\View\Component;

class Tab extends Component
{
    public $tabs;
    public $active;
    public $tournament;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tabs, $tournament, $active = null)
    {
        $this->tabs = $tabs;
        $this->active = $active;
        $this->tournament = $tournament;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.tabs.tab');
    }
}
