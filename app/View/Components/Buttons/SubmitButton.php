<?php

namespace App\View\Components\Buttons;

use Illuminate\View\Component;

class SubmitButton extends Component
{
    public $type;
    public $size;
    public $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type = 'success', $size = 'sm', $name)
    {
        $this->type = $type;
        $this->size = $size;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.buttons.submit-button');
    }
}
