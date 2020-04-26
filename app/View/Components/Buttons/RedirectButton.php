<?php

namespace App\View\Components\Buttons;

use Illuminate\View\Component;

class RedirectButton extends Component
{
    public $type;
    public $size;
    public $route;
    public $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type = 'success', $size = 'sm', $route, $name)
    {
        $this->type = $type;
        $this->size = $size;
        $this->route = $route;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.buttons.redirect-button');
    }
}
