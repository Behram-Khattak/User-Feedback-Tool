<?php

namespace App\Livewire;

use App\Models\Feedback;
use Livewire\Component;

class LoadMoreFeedbacks extends Component
{
    public $limitPerPage = 10;

    public function load()
    {
        $this->limitPerPage += 10;
    }

    public function render()
    {
        $feed = new Feedback();

        $feedbacks = $feed->take($this->limitPerPage)->get();

        return view('livewire.load-more-feedbacks', compact('feedbacks'));
    }
}
