<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class comments extends Component
{
    public $feedbackComments;

    /**
     * Create a new component instance.
     */
    public function __construct($feedbackComments)
    {
        $this->feedbackComments = $feedbackComments;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.comments');
    }
}
