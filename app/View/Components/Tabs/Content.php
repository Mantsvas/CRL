<?php

namespace App\View\Components\Tabs;

use Illuminate\View\Component;

class Content extends Component
{
    public $key;
    public $active;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($key, $active = null)
    {
        $this->key = $key;
        $this->active = $active;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.tabs.content');
    }
}
