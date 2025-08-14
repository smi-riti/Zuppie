<?php

namespace App\Livewire\Public\Section;

use Livewire\Component;
use App\Traits\HasSettings;
#[Title('Header')]

class Header extends Component
{
    use HasSettings;

    public function mount()
    {
        // Load only the settings we need for header
        $this->loadSiteSettings(['site_name', 'site_logo']);
    }

    public function render()
    {
        return view('livewire.public.section.header');
    }
}
