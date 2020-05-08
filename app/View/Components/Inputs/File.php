<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class File extends Component
{
    public $name;
    public $id;
    public $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = null, $id, $required = null)
    {
        $this->name = $name;
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
        return view('components.inputs.file');
    }
}
