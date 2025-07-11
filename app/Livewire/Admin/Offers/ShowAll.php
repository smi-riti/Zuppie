<?php

namespace App\Livewire\Admin\Offers;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ShowAll extends Component
{
    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.offers.show-all');
    }
}
