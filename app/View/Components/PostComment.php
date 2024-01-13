<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostComment extends Component
{
    public $feedbackId;

    /**
     * Create a new component instance.
     */
    public function __construct($feedbackId)
    {
        $this->feedbackId = $feedbackId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post-comment');
    }
}
