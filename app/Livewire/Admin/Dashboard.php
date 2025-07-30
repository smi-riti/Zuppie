<?php

namespace App\Livewire\Admin;

use App\Models\Booking;
use App\Models\EventPackage;
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
    }

    public function render()
    {
        $upComingBookings = Booking::with('eventPackage')
            ->where('status', 'confirmed')
            ->whereDate('event_date', '>=', now()->toDateString())
            ->orderBy('event_date', 'asc') // Show soonest events first
            ->paginate($this->perPage);
            
        $today_booking = Booking::where('status', 'confirmed')
            ->whereDate('event_date', '=', now()->toDateString())->get();

            $all_packages = EventPackage::all();

        return view('livewire.admin.dashboard', [
            'upComingBookings' => $upComingBookings,
            'today_booking' => $today_booking,
            'all_packages' => $all_packages
        ]);
    }
}