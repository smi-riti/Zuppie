<?php

namespace App\Livewire\Admin\Offers;

use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class Add extends Component
{
    public $showModal = false;

    #[On('open-create-modal')]
    public function openModal()
    {
        $this->showModal = true;
    }
    
    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.offers.add');
    }
}
