<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class Select extends Component
{
    public $label;
    public $name;
    public $options;
    public $selected;
    public $id;
    public $required;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label = null, $name = null, $options = [], $selected = null, $id = null, $required = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->options = $options;
        $this->selected = $selected;
        $this->id = $id;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.inputs.select');
    }
}
