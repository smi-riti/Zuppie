<?php

namespace App\Livewire\Admin\Booking;

use Livewire\Component;
use App\Models\Booking;
use Livewire\Attributes\Layout;

class ViewBooking extends Component   
{ 
     public function closeModal()
    {
        $this->dispatch('closeModal');
    }
    public Booking $booking; // Type-hint as Booking model

    public function mount(Booking $booking) // Use route model binding
    {
        // Eager load relationships with error handling
        $this->booking = $booking->load([
            'eventPackage.category', 
            'payments'
        ]);
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.booking.view-booking');
    }
}