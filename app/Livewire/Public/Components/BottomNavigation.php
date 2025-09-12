<?php

namespace App\Livewire\Public\Components;

use Livewire\Component;
use App\Traits\HasSettings;

#[Title('Bottom Navigation')]

class BottomNavigation extends Component
{
    use HasSettings;

    public function mount()
    {
        $this->loadSiteSettings();
    }

    public function render()
    {
        return view('livewire.public.components.bottom-navigation');
    }
}
