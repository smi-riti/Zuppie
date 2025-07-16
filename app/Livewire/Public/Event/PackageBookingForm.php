<?php

namespace App\Livewire\Public\Event;

use Livewire\Component;
use App\Models\EventPackage;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PackageBookingForm extends Component
{
    public $packageId;
    public $pinCode;
    public $package;
    
    // Form fields
    public $name = '';
    public $email = '';
    public $phone = '';
    public $eventDate = '';
    public $eventEndDate = '';
    public $guestCount = '';
    public $location = '';
    public $specialRequests = '';
    public $paymentMethod = 'cash';
    
    // User state
    public $isLoggedIn = false;
    public $existingUser = null;
    public $userMessage = '';
    
    // Validation state
    public $isSubmitting = false;

    protected $rules = [
        'name' => 'required|string|min:2|max:255',
        'phone' => 'required|string|min:10|max:15',
        'email' => 'nullable|email|max:255',
        'eventDate' => 'required|date|after:today',
        'eventEndDate' => 'nullable|date|after_or_equal:eventDate',
        'guestCount' => 'nullable|integer|min:1|max:10000',
        'location' => 'required|string|min:5|max:500',
        'specialRequests' => 'nullable|string|max:1000',
        'paymentMethod' => 'required|in:cash'
    ];

    protected $messages = [
        'name.required' => 'Name is required',
        'phone.required' => 'Phone number is required',
        'phone.min' => 'Phone number must be at least 10 digits',
        'eventDate.required' => 'Event date is required',
        'eventDate.after' => 'Event date must be in the future',
        'eventEndDate.after_or_equal' => 'Event end date must be same or after event start date',
        'location.required' => 'Event location is required',
        'location.min' => 'Location must be at least 5 characters'
    ];

    public function mount($package_id = null, $pin_code = null)
    {
        // Get from URL parameters or session
        $this->packageId = $package_id ?: session('package_id') ?: request('package_id');
        $this->pinCode = $pin_code ?: session('pin_code') ?: request('pin_code');
        
        $this->loadPackage();
        $this->checkUserAuthentication();
        
        // Set default end date as same day
        $this->eventEndDate = $this->eventDate;
    }

    public function loadPackage()
    {
        $this->package = EventPackage::with(['category', 'images'])
            ->where('id', $this->packageId)
            ->where('is_active', true)
            ->first();

        if (!$this->package) {
            return redirect()->route('event-packages')->with('error', 'Package not found');
        }
    }

    public function updated($field)
    {
        // Auto-set end date when start date changes
        if ($field === 'eventDate' && $this->eventDate) {
            if (!$this->eventEndDate || $this->eventEndDate < $this->eventDate) {
                $this->eventEndDate = $this->eventDate;
            }
        }
        
        // Check for existing user when phone is entered
        if ($field === 'phone' && strlen($this->phone) >= 10) {
            $this->checkExistingUser();
        }
        
        // Clean up guest count - convert empty string to null
        if ($field === 'guestCount') {
            $this->guestCount = $this->guestCount === '' ? null : $this->guestCount;
        }
        
        // Validate field on change
        $this->validateOnly($field);
    }

    public function submitBooking()
    {
        $this->isSubmitting = true;
        
        // Validate form
        $this->validate();

        try {
            // Create or find user
            $user = $this->createOrFindUser();
            
            // Create booking
            $booking = $this->createBooking($user);
            
            // Create payment record
            $this->createPaymentRecord($booking);
            
            // Login user if not already logged in
            if (!$this->isLoggedIn) {
                Auth::login($user);
            }
            
            // Send email if email provided
            if ($this->email) {
                $this->sendConfirmationEmail($user, $booking);
            }

            session()->flash('booking_success', 'Your booking has been confirmed successfully!');
            
            // Redirect to manage booking
            return redirect()->route('manage-booking', ['booking_id' => $booking->id]);
            
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong. Please try again.');
            \Log::error('Booking error: ' . $e->getMessage());
        }
        
        $this->isSubmitting = false;
    }

    private function createOrFindUser()
    {
        // If user is already logged in, use that user
        if ($this->isLoggedIn && $this->existingUser) {
            // Update user info with any changes
            $this->existingUser->update([
                'name' => $this->name,
                'email' => $this->email ?: $this->existingUser->email
            ]);
            
            return $this->existingUser;
        }
        
        // Check if user exists by phone
        $user = User::where('phone_no', $this->phone)->first();
        
        if (!$user) {
            // Generate random password
            $password = Str::random(8);
            
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone_no' => $this->phone,
                'password' => Hash::make($password),
                'is_admin' => false
            ]);
            
            // Store password for email
            $user->temp_password = $password;
        } else {
            // Update user info if needed
            $user->update([
                'name' => $this->name,
                'email' => $this->email ?: $user->email
            ]);
        }
        
        return $user;
    }

    private function createBooking($user)
    {
        return Booking::create([
            'user_id' => $user->id,
            'event_package_id' => $this->package->id,
            'event_date' => $this->eventDate,
            'event_end_date' => $this->eventEndDate ?: $this->eventDate,
            'guest_count' => $this->guestCount ?: null, // Convert empty string to null
            'location' => $this->location,
            'special_requests' => $this->specialRequests,
            'status' => 'confirmed',
            'total_price' => $this->package->discounted_price,
            'pin_code' => $this->pinCode
        ]);
    }

    private function createPaymentRecord($booking)
    {
        return Payment::create([
            'booking_id' => $booking->id,
            'amount' => $booking->total_price,
            'payment_date' => now(),
            'payment_method' => $this->paymentMethod,
            'transaction_id' => 'CASH_' . now()->format('YmdHis') . '_' . $booking->id,
            'status' => 'pending',
            'notes' => 'Cash payment - to be collected on event day'
        ]);
    }

    private function sendConfirmationEmail($user, $booking)
    {
        try {
            // You can implement email sending here
            // For now, we'll just log it
            \Log::info("Booking confirmation email would be sent to: {$this->email}");
            
            // If user has temp password, include it in email
            if (isset($user->temp_password)) {
                \Log::info("New account created with password: {$user->temp_password}");
            }
        } catch (\Exception $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
        }
    }

    public function getTotalPriceProperty()
    {
        return $this->package ? $this->package->discounted_price : 0;
    }

    public function render()
    {
        return view('livewire.public.event.package-booking-form');
    }
    
    public function checkUserAuthentication()
    {
        if (Auth::check()) {
            $this->isLoggedIn = true;
            $this->existingUser = Auth::user();
            
            // Pre-fill form with user data
            $this->name = $this->existingUser->name;
            $this->email = $this->existingUser->email;
            $this->phone = $this->existingUser->phone_no;
            
            $this->userMessage = "Welcome back, {$this->existingUser->name}! Your information has been pre-filled.";
        }
    }

    public function checkExistingUser()
    {
        if (!$this->isLoggedIn && $this->phone) {
            $user = User::where('phone_no', $this->phone)->first();
            
            if ($user) {
                $this->existingUser = $user;
                
                // Pre-fill form with existing user data
                $this->name = $user->name;
                $this->email = $user->email;
                
                $this->userMessage = "We found your account! Your information has been pre-filled. You can proceed with booking.";
                
                // Dispatch event to show message in frontend
                $this->dispatch('user-found', ['message' => $this->userMessage]);
            } else {
                $this->existingUser = null;
                $this->userMessage = '';
                $this->dispatch('user-not-found');
            }
        }
    }
}
