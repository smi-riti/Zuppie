<?php

namespace App\Livewire\Admin;

use App\Models\Booking;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')] 
class Dashboard extends Component
{
    use WithPagination;
    
    public $perPage = 5; // Number of events per page

    public function mount()
    {
        // Initialization if needed
    }

    public function render()
    {
        $upComingBookings = Booking::with('eventPackage')
            ->where('status', 'confirmed')
            ->whereDate('event_date', '>=', now()->toDateString())
            ->orderBy('event_date', 'asc') // Show soonest events first
            ->paginate($this->perPage);

        return view('livewire.admin.dashboard', [
            'upComingBookings' => $upComingBookings,
        ]);
    }
}