<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class Date extends Component
{
    public $label;
    public $name;
    public $placeholder;
    public $value;
    public $id;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label = null, $name = null, $placeholder = null, $value = null, $id = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.inputs.date');
    }
}
