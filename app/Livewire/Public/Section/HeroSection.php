<?php

namespace App\Livewire\Public\Section;

use Livewire\Component;
#[Title('Hero Section')]

class HeroSection extends Component
{
    public function render()
    {
        return view('livewire.public.section.hero-section');
    }
}
