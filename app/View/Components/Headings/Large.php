<?php

namespace App\View\Components\Headings;

use Illuminate\View\Component;

class Large extends Component
{
    public $heading;
    public $classes;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($heading, $classes = null)
    {
        $this->heading = $heading;
        $this->classes = $classes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.headings.large');
    }
}
