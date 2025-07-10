<?php

namespace App\Livewire\Admin\Reviews;

use App\Models\reviews;
use Livewire\Attributes\Layout;
use Livewire\Component;

class All extends Component
{
    public $reviews;
    
    #[Layout('components.layouts.admin')]

    public function mount()
    {
        $this->reviews = reviews::all();
    }
    public function render()
    {
        return view('livewire.admin.reviews.all');
    }
}
