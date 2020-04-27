<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class Hidden extends Component
{
    public $id;
    public $name;
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id = null, $name = null, $value = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.inputs.hidden');
    }
}
