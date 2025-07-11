<?php

namespace App\Livewire\Admin\Reviews;

use App\Models\reviews;
use Livewire\Attributes\Layout;
use Livewire\Component;

class All extends Component
{
    public $activeTab = 'All Reviews';
    public $reviews;
    public $approvedReviews;
    public $deniedReviews;


    public function mount()
    {
        $this->reviews = reviews::where('approved', false)->get();
        $this->approvedReviews = reviews::where('approved', true)->get();
    }

    public function approving($id)
    {
        $review = reviews::find($id);
        if ($review) {
            $review->approved = true;
            $review->save();
            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'Review approved successfully!'
            ]);
            $this->mount(); // Refresh the data
        } else {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Review not found!'
            ]);
        }
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.reviews.all');
    }
}
