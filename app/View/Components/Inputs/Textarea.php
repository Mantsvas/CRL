<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class Textarea extends Component
{
    public $label;
    public $name;
    public $placeholder;
    public $value;
    public $id;
    public $cols;
    public $rows;
    public $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label = null, $name = null, $placeholder = null, $value = null, $id = null, $cols = 10, $rows = 10, $required = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->id = $id;
        $this->cols = $cols;
        $this->rows = $rows;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.inputs.textarea');
    }
}
