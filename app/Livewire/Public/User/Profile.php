<?php

namespace App\Livewire\Public\User;

use App\Models\Booking;
use App\Models\EventPackage;
use App\Models\Wishlist;
use App\Services\WishlistService;
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
    
    

     public $featuredPackages;
    protected $wishlistService;

    public function boot(WishlistService $wishlistService)
    {
        $this->wishlistService = $wishlistService;
    }

    public function toggleWishlist($packageId)
    {
        $result = $this->wishlistService->toggleWishlist($packageId);
        
        if ($result['status'] === 'login_required') {
            return redirect()->route('login');
        }
        
        // Update local status
        $this->wishlistStatus[$packageId] = !($this->wishlistStatus[$packageId] ?? false);
        
        // Refresh wishlisted packages
        $this->wishlistedPackages = Wishlist::with('eventPackage.images', 'eventPackage.category')
            ->where('user_id', auth()->id())
            ->get();
    }
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

       // Load wishlisted packages
        $this->wishlistedPackages = Wishlist::with('eventPackage.images', 'eventPackage.category')
            ->where('user_id', auth()->id())
            ->get();

        // Initialize wishlist statuses for wishlisted packages
        $wishlistPackageIds = $this->wishlistedPackages->pluck('event_package_id')->toArray();
        $this->wishlistStatus = $this->wishlistService->getWishlistStatuses($wishlistPackageIds);
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
