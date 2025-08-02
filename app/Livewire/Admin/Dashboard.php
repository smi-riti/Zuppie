<?php

namespace App\Livewire\Admin;

use App\Models\Booking;
use App\Models\EventPackage;
use App\Models\Payment;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Carbon\Carbon;

#[Layout('components.layouts.admin')]
class Dashboard extends Component
{
    use WithPagination;
    
    public $perPage = 3; // Number of events per page
    public $currentMonth;
    public $currentYear;
    public $selectedDate = null;

    // Statistics properties
    public $upcomingEventsCount = 0;
    public $pastEventsCount = 0;
    public $cancelledEventsCount = 0;
    public $totalRevenue = 0;

    public function mount()
    {
        $this->currentMonth = now()->month;
        $this->currentYear = now()->year;
        $this->calculateStatistics();
    }

    public function calculateStatistics()
    {
        // Upcoming Events (confirmed events from today onwards)
        $this->upcomingEventsCount = Booking::where('status', 'confirmed')
            ->whereDate('event_date', '>=', now()->toDateString())
            ->count();

        // Past Events (completed events)
        $this->pastEventsCount = Booking::where('status', 'confirmed')
            ->where('is_completed', 1)
            ->whereDate('event_date', '<', now()->toDateString())
            ->count();

        // Cancelled Events
        $this->cancelledEventsCount = Booking::where('status', 'cancelled')->count();

        // Total Revenue (online payments + completed cash payments)
        $onlinePayment = Payment::where('status', 'paid')->sum('amount');
        $cashPayment = Booking::where('is_completed', 1)->sum('due_amount');
        $this->totalRevenue = $onlinePayment + $cashPayment;
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

    public function selectDate($date)
    {
        $this->selectedDate = Carbon::create($this->currentYear, $this->currentMonth, $date);
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

    public function getCalendarEventsProperty()
    {
        $startDate = Carbon::create($this->currentYear, $this->currentMonth, 1)->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::create($this->currentYear, $this->currentMonth, 1)->endOfMonth()->format('Y-m-d');

        return Booking::with('eventPackage')
            ->where('status', 'confirmed')
            ->whereBetween('event_date', [$startDate, $endDate])
            ->orderBy('event_date', 'asc')
            ->get()
            ->mapWithKeys(function ($booking) {
                $dateKey = $booking->event_date->format('Y-n-j');
                return [
                    $dateKey => [
                        'title' => $booking->eventPackage->name,
                        'type' => 'important',
                        'guests' => $booking->guest_count,
                        'id' => $booking->id
                    ]
                ];
            })
            ->toArray();
    }

    public function getMonthlyRevenueData()
    {
        $monthlyData = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthName = $month->format('M');
            
            $monthlyRevenue = Payment::where('status', 'paid')
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('amount');
                
            $monthlyCash = Booking::where('is_completed', 1)
                ->whereYear('updated_at', $month->year)
                ->whereMonth('updated_at', $month->month)
                ->sum('due_amount');
                
            $monthlyData[] = [
                'month' => $monthName,
                'revenue' => $monthlyRevenue + $monthlyCash
            ];
        }
        
        return $monthlyData;
    }

    public function render()
    {
        $upComingBookings = Booking::with('eventPackage')
            ->where('status', 'confirmed')
            ->whereDate('event_date', '>=', now()->toDateString())
            ->orderBy('event_date', 'asc')
            ->paginate($this->perPage);

        $todayBookings = Booking::with('eventPackage')
            ->where('status', 'confirmed')
            ->whereDate('event_date', '=', now()->toDateString())
            ->get();

        $calendarEvents = $this->calendar_events;
        $monthlyRevenueData = $this->getMonthlyRevenueData();

        return view('livewire.admin.dashboard', [
            'upComingBookings' => $upComingBookings,
            'todayBookings' => $todayBookings,
            'calendarEvents' => $calendarEvents,
            'monthlyRevenueData' => $monthlyRevenueData,
        ]);
    }
}