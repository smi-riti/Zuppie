<?php

namespace App\Livewire\Public\User;

use App\Models\Booking;
use Livewire\Attributes\On;
use Livewire\Component;

class MyPackageModal extends Component
{
    public $showViewModal = false;
    public $bookingDetails;
    public $booking;

     public function mount($bookingId)
    {
        $this->booking = Booking::findOrFail($bookingId);
    }
    public function openViewModal($bookingId){
        $this->showViewModal = true;
        $this->bookingDetails = Booking::findOrFail($bookingId);
        $this->booking_id = $this->bookingDetails['id'];
    }

    public function closeViewModal()
    {
        $this->dispatch('closeViewModal');
    }
    public function render()
    {
        return view('livewire.public.user.my-package-modal');
    }
}
