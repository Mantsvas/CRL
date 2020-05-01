<?php

namespace App\View\Components\Cards;

use Illuminate\View\Component;

class ResponsiveCard extends Component
{
    public $cardTitle;
    public $cardType;
    public $contentClasses;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($cardTitle = null, $cardType = 'secondary', $contentClasses = null)
    {
        $this->cardTitle = $cardTitle;
        $this->cardType = $cardType;
        $this->contentClasses = $contentClasses;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.cards.responsive-card');
    }
}
