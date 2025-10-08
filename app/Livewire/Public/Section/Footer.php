<?php

namespace App\Livewire\Public\Section;

use Livewire\Component;
use App\Traits\HasSettings;
#[Title('Footer')]

class Footer extends Component
{
    use HasSettings;

    public function mount()
    {
        // Load all default settings for footer (the trait will load commonly used ones)
        $this->loadSiteSettings();
    }

    public function render()
    {
        return view('livewire.public.section.footer');
    }
}
