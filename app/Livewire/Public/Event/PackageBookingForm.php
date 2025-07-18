<?php

namespace App\Livewire\Public\Event;

use Livewire\Component;
use App\Models\EventPackage;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use App\Models\Service;
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
    public $acceptTerms = false;
    
    // Multi-step form
    public $currentStep = 1;
    public $showPackageDetails = false;
    
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
        'eventEndDate' => 'nullable|date|after:eventDate',
        'guestCount' => 'nullable|integer|min:1|max:10000',
        'location' => 'required|string|min:5|max:500',
        'specialRequests' => 'nullable|string|max:1000',
        'paymentMethod' => 'required|in:cash',
        'acceptTerms' => 'required|accepted'
    ];

    protected $messages = [
        'name.required' => 'Name is required',
        'name.min' => 'Name must be at least 2 characters',
        'phone.required' => 'Phone number is required',
        'phone.min' => 'Phone number must be at least 10 digits',
        'phone.max' => 'Phone number cannot exceed 15 digits',
        'email.email' => 'Please enter a valid email address',
        'eventDate.required' => 'Event date is required',
        'eventDate.after' => 'Event date must be in the future',
        'eventDate.date' => 'Please enter a valid event date',
        'eventEndDate.after' => 'Event end date must be after event start date',
        'eventEndDate.date' => 'Please enter a valid event end date',
        'guestCount.integer' => 'Guest count must be a number',
        'guestCount.min' => 'Guest count must be at least 1',
        'guestCount.max' => 'Guest count cannot exceed 10,000',
        'location.required' => 'Event location is required',
        'location.min' => 'Location must be at least 5 characters',
        'location.max' => 'Location cannot exceed 500 characters',
        'specialRequests.max' => 'Special requests cannot exceed 1000 characters',
        'acceptTerms.required' => 'You must accept the terms and conditions'
    ];

    public function mount($package_id = null, $pin_code = null)
    {
        $this->packageId = $package_id ?: session('package_id') ?: request('package_id');
        $this->pinCode = $pin_code ?: session('pin_code') ?: request('pin_code');
        
        // Validate pin code exists in services
        if ($this->pinCode) {
            $service = Service::where('pin_code', $this->pinCode)->first();
            if (!$service) {
                session()->flash('error', 'Invalid service area pin code. Please check pincode availability on package detail page.');
                return redirect()->route('event-packages');
            }
        } else {
            session()->flash('error', 'Pin code is required. Please check pincode availability on package detail page.');
            return redirect()->route('event-packages');
        }
        
        $this->loadPackage();
        $this->checkUserAuthentication();
        $this->loadFormDataFromSession();
        
        // If user just logged in/registered and has form data, go to step 4
        if ($this->isLoggedIn && session('booking_form_data') && 
            $this->name && $this->phone && $this->eventDate && $this->location) {
            $this->currentStep = 4;
        }
        
        // Set default end date as next day
        if (!$this->eventEndDate && $this->eventDate) {
            $this->eventEndDate = date('Y-m-d', strtotime($this->eventDate . ' +1 day'));
        }
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
            if (!$this->eventEndDate || $this->eventEndDate <= $this->eventDate) {
                // Set end date to next day by default
                $this->eventEndDate = date('Y-m-d', strtotime($this->eventDate . ' +1 day'));
            }
        }
        
        // Check for existing user when phone is entered
        if ($field === 'phone' && strlen($this->phone) >= 10) {
            $this->checkExistingUser();
        }
        
        // Clean up guest count - convert empty string to null
        if ($field === 'guestCount') {
            $this->guestCount = $this->guestCount === '' ? null : intval($this->guestCount);
        }
        
        // Validate field on change for current step
        if ($this->currentStep === 1 && in_array($field, ['eventDate', 'eventEndDate', 'location'])) {
            try {
                $this->validateOnly($field, [
                    'eventDate' => 'required|date|after:today',
                    'eventEndDate' => 'nullable|date|after:eventDate',
                    'location' => 'required|string|min:5|max:500',
                ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                // Validation error will be automatically shown
            }
        } elseif ($this->currentStep === 2 && in_array($field, ['guestCount', 'specialRequests'])) {
            try {
                $this->validateOnly($field, [
                    'guestCount' => 'nullable|integer|min:1|max:10000',
                    'specialRequests' => 'nullable|string|max:1000',
                ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                // Validation error will be automatically shown
            }
        } elseif ($this->currentStep === 3 && in_array($field, ['name', 'phone', 'email'])) {
            try {
                $this->validateOnly($field, [
                    'name' => 'required|string|min:2|max:255',
                    'phone' => 'required|string|min:10|max:15',
                    'email' => 'nullable|email|max:255',
                ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                // Validation error will be automatically shown
            }
        }
    }

    public function submitBooking()
    {
        $this->isSubmitting = true;
        
        // Ensure user is logged in before allowing booking
        if (!$this->isLoggedIn) {
            session()->flash('error', 'You must be logged in to complete the booking.');
            $this->isSubmitting = false;
            return;
        }
        
        try {
            // Validate all fields
            $this->validate();

            // Update logged in user's information
            $user = $this->updateUserInfo();
            
            // Create booking
            $booking = $this->createBooking($user);
            
            // Create payment record
            $this->createPaymentRecord($booking);
            
            // Send email if email provided
            if ($this->email) {
                $this->sendConfirmationEmail($user, $booking);
            }

            session()->flash('booking_success', 'Your booking has been confirmed successfully!');
            
            // Clear saved form data
            session()->forget('booking_form_data');
            
            // Redirect to manage booking
            return redirect()->route('manage-booking', ['booking_id' => $booking->id]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation failed, show specific validation errors
            session()->flash('validation_error', 'Please fix the validation errors before submitting your booking.');
            $this->isSubmitting = false;
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong. Please try again. Error: ' . $e->getMessage());
            \Log::error('Booking error: ' . $e->getMessage());
            $this->isSubmitting = false;
        }
    }

    // Step navigation methods
    public function goToStep($step)
    {
        $this->currentStep = $step;
    }

    public function togglePackageDetails()
    {
        $this->showPackageDetails = !$this->showPackageDetails;
    }

    public function toggleEditForm()
    {
        $this->showEditForm = !$this->showEditForm;
    }

    public function updateUserDetails()
    {
        if (!$this->isLoggedIn) {
            return;
        }

        $this->validate([
            'name' => 'required|string|min:2|max:255',
            'phone' => 'required|string|min:10|max:15',
            'email' => 'nullable|email|max:255',
        ]);

        try {
            // Note: This updates the user account info, not just booking details
            $this->existingUser->update([
                'name' => $this->name,
                'email' => $this->email,
                'phone_no' => $this->phone,
            ]);

            $this->showEditForm = false;
            session()->flash('success', 'Your account details have been updated successfully.');

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update details. Please try again.');
            \Log::error('Update error: ' . $e->getMessage());
        }
    }

    private function saveFormDataToSession()
    {
        session([
            'booking_form_data' => [
                'eventDate' => $this->eventDate,
                'eventEndDate' => $this->eventEndDate,
                'location' => $this->location,
                'guestCount' => $this->guestCount,
                'specialRequests' => $this->specialRequests,
                'packageId' => $this->packageId,
                'pinCode' => $this->pinCode,
            ]
        ]);
    }

    private function loadFormDataFromSession()
    {
        // Load form data
        $formData = session('booking_form_data');
        if ($formData) {
            $this->eventDate = $formData['eventDate'] ?? $this->eventDate;
            $this->eventEndDate = $formData['eventEndDate'] ?? $this->eventEndDate;
            $this->location = $formData['location'] ?? $this->location;
            $this->guestCount = $formData['guestCount'] ?? $this->guestCount;
            $this->specialRequests = $formData['specialRequests'] ?? $this->specialRequests;
        }

        // Load step 3 data if available
        $step3Data = session('booking_step3_data');
        if ($step3Data) {
            $this->name = $step3Data['name'] ?? $this->name;
            $this->email = $step3Data['email'] ?? $this->email;
            $this->phone = $step3Data['phone'] ?? $this->phone;
            
            // Clear step 3 data after loading
            session()->forget('booking_step3_data');
        }
    }

    public function validateStep1()
    {
        try {
            $this->validate([
                'eventDate' => 'required|date|after:today',
                'eventEndDate' => 'nullable|date|after:eventDate',
                'location' => 'required|string|min:5|max:500',
            ]);
            
            $this->currentStep = 2;
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation failed, errors will be automatically displayed
            session()->flash('validation_error', 'Please fix the validation errors before proceeding.');
        }
    }

    public function validateStep2()
    {
        try {
            $this->validate([
                'guestCount' => 'nullable|integer|min:1|max:10000',
                'specialRequests' => 'nullable|string|max:1000',
            ]);
            
            $this->currentStep = 3;
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation failed, errors will be automatically displayed
            session()->flash('validation_error', 'Please fix the validation errors before proceeding.');
        }
    }

    public function validateStep3()
    {
        try {
            $this->validate([
                'name' => 'required|string|min:2|max:255',
                'phone' => 'required|string|min:10|max:15',
                'email' => 'nullable|email|max:255',
            ]);
            
            // Check if user needs to register/login
            if (!$this->isLoggedIn) {
                // Save form data to session before redirecting
                $this->saveFormDataToSession();
                session(['booking_step3_data' => [
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->phone
                ]]);
                
                // Check if user exists
                if ($this->existingUser) {
                    // Redirect to login page
                    session()->flash('info', 'Please login to complete your booking.');
                    return redirect()->route('login');
                } else {
                    // Redirect to register page
                    session()->flash('info', 'Please register to complete your booking.');
                    return redirect()->route('register');
                }
            }
            
            $this->currentStep = 4;
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation failed, errors will be automatically displayed
            session()->flash('validation_error', 'Please fix the validation errors before proceeding.');
        }
    }

    private function updateUserInfo()
    {
        // For this booking system, we don't update user's account details
        // The booking details are separate from user account details
        if (!$this->isLoggedIn || !$this->existingUser) {
            throw new \Exception('User must be logged in to complete booking');
        }
        
        return $this->existingUser;
    }

    private function createBooking($user)
    {
        // Validate pin code again before creating booking
        $service = Service::where('pin_code', $this->pinCode)->first();
        if (!$service) {
            throw new \Exception('Invalid pin code. Service not available in this area.');
        }

        return Booking::create([
            'user_id' => $user->id,
            'event_package_id' => $this->package->id,
            'booking_name' => $this->name,
            'booking_email' => $this->email,
            'booking_phone_no' => $this->phone,
            'event_date' => $this->eventDate,
            'event_end_date' => $this->eventEndDate ?: $this->eventDate,
            'guest_count' => $this->guestCount ? intval($this->guestCount) : null, // Keep null if not provided
            'location' => $this->location,
            'special_requests' => $this->specialRequests,
            'status' => 'pending',
            'total_price' => $this->package->discounted_price,
            'pin_code' => $this->pinCode,
            'is_completed' => false
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

    public function checkUserAuthentication()
    {
        if (Auth::check()) {
            $this->isLoggedIn = true;
            $this->existingUser = Auth::user();
            
            // Pre-fill booking form with user data (but these can be edited for booking)
            $this->name = $this->existingUser->name ?? '';
            $this->email = $this->existingUser->email ?? '';
            $this->phone = $this->existingUser->phone_no ?? '';
            
            $this->userMessage = "Welcome back, {$this->existingUser->name}! Your information has been pre-filled but you can modify it for this booking.";
        } else {
            $this->isLoggedIn = false;
            $this->existingUser = null;
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

    public function render()
    {
        return view('livewire.public.event.package-booking-form');
    }
}