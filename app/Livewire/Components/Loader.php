<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Loader extends Component
{
    public $message = 'Loading...';
    public $size = 'medium'; // small, medium, large
    public $type = 'spinner'; // spinner, dots, pulse
    
    public function render()
    {
        return view('livewire.components.loader');
    }
}
