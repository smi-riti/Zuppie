<?php

namespace App\Livewire\Admin\Booking;

use Livewire\Component;
use App\Models\Booking;
use Livewire\Attributes\Layout;
#[Title('View Booking')]
class ViewBooking extends Component
{
    public function closeModal()
    {
        $this->dispatch('closeModal');
    }
    public Booking $booking; 

    public function mount(Booking $booking) 
    {
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