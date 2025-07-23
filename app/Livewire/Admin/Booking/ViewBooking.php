<?php

namespace App\Livewire\Admin\Booking;

use Livewire\Component;
use Livewire\Attributes\Layout;
class ViewBooking extends Component
{ 
    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.booking.view-booking');
    }
}
