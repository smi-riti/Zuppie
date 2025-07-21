<?php

namespace App\Livewire\Public\User;

use App\Models\Booking;
use Livewire\Component;

class Profile extends Component
{
    public $activeTab = 'All Bookings';
    public $upComingBookings;
    public $pastBookings;
    public $cancelledBookings;
    public $completedBookings;

    public $bookingIdToView;
    public $showViewModal = false;
    public $packageIdToReview;
    public $showReviewModal = false;
    protected $listeners = [
        'closeViewModal' => 'closeViewModal',
        'closeReviewModal' => 'closeReviewModal',
    ];
    public function mount()
    {
        $this->upComingBookings = Booking::where('user_id', auth()->id())
            ->where('status', 'confirmed')
            ->whereDate('event_date', '>=', now()->toDateString())
            ->get();

        $this->pastBookings = Booking::where('user_id', auth()->id())
            ->whereDate('event_date', '<', now()->toDateString())
            ->where('is_completed', 1)
            ->where('status', 'confirmed')
            ->get();

        $this->completedBookings = Booking::where(function ($query) {
            $query->where('user_id', auth()->id())
                ->where('is_completed', 1);
        })->get();
        $this->cancelledBookings = Booking::where('user_id', auth()->id())
            ->where('status', 'cancelled')
            ->get();
    }

    public function openViewModal($bookingId)
    {
        $this->bookingIdToView = $bookingId;
        $this->showViewModal = true;
    }
    public function closeViewModal()
    {
        $this->showViewModal = false;
    }

    public function openReviewModal($packageId)
    {
        $this->packageIdToReview = $packageId;
        $this->showReviewModal = true;
    }
    public function closeReviewModal()
    {
        $this->showReviewModal = false;
    }

    public function render()
    {
        $bookings = Booking::where('user_id', auth()->id())
            ->orderBy('event_date', 'desc')
            ->get();
        return view('livewire.public.user.profile', compact('bookings'));
    }
}
