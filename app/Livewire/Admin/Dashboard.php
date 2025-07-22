<?php

namespace App\Livewire\Admin;

use App\Models\Booking;
use Livewire\Component;
use Livewire\Attributes\Layout;
#[Layout('components.layouts.admin')] 
class Dashboard extends Component
{
    public $upComingBookings;

     public function mount()
    {
        
       $this->upComingBookings = Booking::where('status', 'confirmed')
        ->whereDate('event_date', '>=', now()->toDateString())
        ->get();
    }
    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}

