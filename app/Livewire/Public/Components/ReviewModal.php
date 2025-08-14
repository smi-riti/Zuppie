<?php

namespace App\Livewire\Public\Components;

use App\Models\reviews;
use App\Models\User;
use Livewire\Component;
#[Title('Review Modal')]

class ReviewModal extends Component
{
    public $perpage = 3;
    public $totalReviews;
    public $showAllReviewsModal = false;
    public $packageReviews;

    public $packageId;
    public function mount($packageId)
    {
        $this->packageId = $packageId;
        $this->totalReviews = reviews::where('event_package_id', $packageId)->count();
    }

    public function loadMore(){
        $this->perpage += 3;
    }



    public function closeAllReviewsModal()
    {
        $this->dispatch('closeAllReviewsModal');
    }

    public function render()
    {
        $reviews = reviews::where('event_package_id', $this->packageId)
            ->where('approved', true)
            ->latest()
            ->take($this->perpage)
            ->get();
        return view('livewire.public.components.review-modal', compact('reviews'));
    }
}
