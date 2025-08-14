<?php

namespace App\Livewire\Public\Components;

use App\Models\reviews;
use Livewire\Component;
#[Title('Review Modal')]

class ReviewModal extends Component
{
    public $showModal = false;
    public $packageId;

    public function render()
    {
        $reviews = reviews::all();
        return view('livewire.public.components.review-modal', ['reviews' => $reviews]);
    }
}
