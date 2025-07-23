<?php

namespace App\Livewire\Public\User;

use App\Models\Booking;
use App\Models\EventPackage;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    public $activeTab = 'All Bookings';
    public $upComingBookings;
    public $pastBookings;
    public $cancelledBookings;
    public $completedBookings;
    public $bookingIdToView;
    public $wishlistedPackages;
    public $showViewModal = false;
    public $packageIdToReview;
    public $showReviewModal = false;
    public $showEditProfileModal = false;
    public $userIdToEdit;
    
    public $wishlistStatus = [];
    public $packages, $filteredPackages;

    protected $listeners = [
        'closeViewModal' => 'closeViewModal',
        'closeReviewModal' => 'closeReviewModal',
        'closeEditProfileModal' => 'closeEditProfileModal'
    ];
    public function mount()
    {
        $this->upComingBookings = Booking::where('user_id', auth()->id())
            ->where('status', 'confirmed')
            ->where('is_completed', 0)
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
        $this->wishlistedPackages = Wishlist::where('user_id', auth()->id())->get();

       
    }
    
    

    public function toggleWishlist($packageId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $wishlist = Wishlist::where('user_id', Auth::id())
                           ->where('event_package_id', $packageId)
                           ->first();

        if ($wishlist) {
            $wishlist->delete();
            $this->dispatch('toast', message: 'Removed from wishlist!');
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'event_package_id' => $packageId,
            ]);
            $this->dispatch('toast', message: 'Added to wishlist!');
        }
    }

    public function getWishlistedPackagesProperty()
    {
        return Wishlist::where('user_id', Auth::id())
                       ->with(['eventPackage.category', 'eventPackage.images'])
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
    public function openEditProfileModal($userId)
    {
        $this->userIdToEdit = $userId;
        $this->showEditProfileModal = true;
    }
    public function closeEditProfileModal()
    {
        $this->showEditProfileModal = false;
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
