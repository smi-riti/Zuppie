<?php

namespace App\Livewire\Admin\Booking;

use Livewire\Component;
use App\Models\Booking;
use Livewire\Attributes\Layout;
class ViewBooking extends Component
{ 
    public $booking;

    public function mount($id)
    {
        $this->booking = Booking::with(['eventPackage.category', 'payments', 'services'])->findOrFail($id);
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.booking.view-booking', [
            'booking' => $this->booking
        ]);
    }
}
