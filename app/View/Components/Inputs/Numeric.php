<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class Numeric extends Component
{
    public $label;
    public $name;
    public $placeholder;
    public $value;
    public $id;
    public $min;
    public $max;
    public $step;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label = null, $name = null, $placeholder = null, $value = null, $id = null, $min = null, $max = null, $step = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->id = $id;
        $this->min = $min;
        $this->max = $max;
        $this->step = $step;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.inputs.numeric');
    }
}
