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
    public $currentMonth;
    public $currentYear;

    public function mount()
    {
        $this->currentMonth = now()->month;
        $this->currentYear = now()->year;
    }

    public function goToPreviousMonth()
    {
        if ($this->currentMonth == 1) {
            $this->currentMonth = 12;
            $this->currentYear--;
        } else {
            $this->currentMonth--;
        }
    }

    public function goToNextMonth()
    {
        if ($this->currentMonth == 12) {
            $this->currentMonth = 1;
            $this->currentYear++;
        } else {
            $this->currentMonth++;
        }
    }

    public function getCalendarEventsProperty()
    {
        $startDate = now()->startOfMonth()->format('Y-m-d');
        $endDate = now()->addMonths(2)->endOfMonth()->format('Y-m-d');
        
        return Booking::with('eventPackage')
            ->where('status', 'confirmed')
            ->whereBetween('event_date', [$startDate, $endDate])
            ->orderBy('event_date', 'asc')
            ->get()
            ->mapWithKeys(function ($booking) {
                $dateKey = $booking->event_date->format('Y-n-j');
                return [$dateKey => [
                    'title' => $booking->eventPackage->name,
                    'type' => 'important',
                    'guests' => $booking->guest_count,
                    'id' => $booking->id
                ]];
            })
            ->toArray();
    }
public $selectedDate = null;

public function selectDate($date)
{
    $this->selectedDate = \Carbon\Carbon::create($this->currentYear, $this->currentMonth, $date);
}

public function getEventsCountForSelectedDate()
{
    if (!$this->selectedDate) {
        return 0;
    }
    
    return Booking::where('status', 'confirmed')
        ->whereDate('event_date', $this->selectedDate->format('Y-m-d'))
        ->count();
}

    public function render()
    {
        $upComingBookings = Booking::with('eventPackage')
            ->where('status', 'confirmed')
            ->whereDate('event_date', '>=', now()->toDateString())
            ->orderBy('event_date', 'asc')
            ->paginate($this->perPage);
            
        $today_booking = Booking::where('status', 'confirmed')
            ->whereDate('event_date', '=', now()->toDateString())->get();

        $all_packages = EventPackage::all();

        return view('livewire.admin.dashboard', [
            'upComingBookings' => $upComingBookings,
            'today_booking' => $today_booking,
            'all_packages' => $all_packages,
            'calendarEvents' => $this->calendar_events,
        ]);
    }
}