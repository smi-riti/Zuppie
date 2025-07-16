<?php

namespace App\Livewire\Public\Event;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class ManageBooking extends Component
{
    public $bookingId;
    public $booking;
    public $showSuccess = false;
    public $activeTab = 'upcoming';
    public $selectedBooking = null;
    public $showBookingDetail = false;
    public $showEditProfile = false;
    
    // User profile fields
    public $name = '';
    public $email = '';
    public $phone = '';

    public function mount($booking_id = null)
    {
        $this->bookingId = $booking_id;
        
        // Show success message for new bookings
        if (session('booking_success')) {
            $this->showSuccess = true;
        }
        
        $this->loadBooking();
        $this->loadUserProfile();
    }

    public function loadBooking()
    {
        if ($this->bookingId) {
            // Load specific booking
            $this->booking = Booking::with(['eventPackage.category', 'eventPackage.images', 'payments', 'user'])
                ->where('id', $this->bookingId)
                ->first();
                
            if (!$this->booking) {
                session()->flash('error', 'Booking not found');
                return redirect()->route('event-packages');
            }
        } else {
            // Load user's latest booking if logged in
            if (Auth::check()) {
                $this->booking = Booking::with(['eventPackage.category', 'eventPackage.images', 'payments'])
                    ->where('user_id', Auth::id())
                    ->latest()
                    ->first();
            }
        }
    }

    public function loadUserProfile()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $this->name = $user->name;
            $this->email = $user->email;
            $this->phone = $user->phone ?? '';
        }
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
        $this->selectedBooking = null;
        $this->showBookingDetail = false;
    }

    public function showBookingDetails($bookingId)
    {
        $this->selectedBooking = Booking::with(['eventPackage.category', 'eventPackage.images', 'payments', 'user'])
            ->find($bookingId);
        $this->showBookingDetail = true;
    }

    public function closeBookingDetail()
    {
        $this->showBookingDetail = false;
        $this->selectedBooking = null;
    }

    public function openEditProfile()
    {
        $this->showEditProfile = true;
    }

    public function closeEditProfile()
    {
        $this->showEditProfile = false;
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
        ]);

        if (Auth::check()) {
            $user = Auth::user();
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
            ]);

            session()->flash('profile_success', 'Profile updated successfully!');
            $this->closeEditProfile();
        }
    }

    public function getAllUserBookingsProperty()
    {
        if (!Auth::check()) {
            return collect([]);
        }

        return Booking::with(['eventPackage.category', 'eventPackage.images', 'payments'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getUpcomingBookingsProperty()
    {
        if (!Auth::check()) return collect([]);

        return Booking::with(['eventPackage', 'payments'])
            ->where('user_id', Auth::id())
            ->where('event_date', '>', now())
            ->where('booking_status', '!=', 'cancelled')
            ->orderBy('event_date', 'asc')
            ->get();
    }

    public function getPresentBookingsProperty()
    {
        if (!Auth::check()) return collect([]);

        return Booking::with(['eventPackage', 'payments'])
            ->where('user_id', Auth::id())
            ->where('event_date', '=', now()->toDateString())
            ->where('booking_status', '!=', 'cancelled')
            ->orderBy('event_time', 'asc')
            ->get();
    }

    public function getOldBookingsProperty()
    {
        if (!Auth::check()) return collect([]);

        return Booking::with(['eventPackage', 'payments'])
            ->where('user_id', Auth::id())
            ->where('event_date', '<', now())
            ->orderBy('event_date', 'desc')
            ->get();
    }

    public function getBookingStatusBadgeProperty()
    {
        if (!$this->booking) return '';
        
        $statusClasses = [
            'confirmed' => 'bg-green-100 text-green-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            'cancelled' => 'bg-red-100 text-red-800',
            'completed' => 'bg-blue-100 text-blue-800'
        ];
        
        return $statusClasses[$this->booking->status] ?? 'bg-gray-100 text-gray-800';
    }

    public function getPaymentStatusBadgeProperty()
    {
        if (!$this->booking || !$this->booking->payments->count()) return '';
        
        $payment = $this->booking->payments->first();
        
        $statusClasses = [
            'paid' => 'bg-green-100 text-green-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            'failed' => 'bg-red-100 text-red-800'
        ];
        
        return $statusClasses[$payment->status] ?? 'bg-gray-100 text-gray-800';
    }

    public function downloadInvoice()
    {
        // Implement invoice download functionality
        session()->flash('info', 'Invoice download feature will be available soon.');
    }

    public function contactSupport()
    {
        // Implement contact support functionality
        session()->flash('info', 'Support contact feature will be available soon.');
    }

    public function dismissSuccess()
    {
        $this->showSuccess = false;
    }

    public function getBookingImagesProperty($booking)
    {
        if (!$booking || !$booking->eventPackage) return [];
        
        $images = $booking->eventPackage->images->pluck('image_url')->toArray();
        
        // Add default images if no images available
        if (empty($images)) {
            $images = [
                'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=400&h=300&fit=crop',
                'https://images.unsplash.com/photo-1511578314322-379afb476865?w=400&h=300&fit=crop',
                'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=400&h=300&fit=crop'
            ];
        }
        
        // Limit to 3 images for manage booking
        return array_slice($images, 0, 3);
    }

    public function render()
    {
        return view('livewire.public.event.manage-booking');
    }
}
