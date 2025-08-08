<?php

namespace App\Livewire\Public\Event;

use Livewire\Component;
use App\Models\EventPackage;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use App\Models\Service;
use App\Services\RazorpayService;
use App\Mail\BookingConfirmationMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PackageBookingForm extends Component
{
    public $packageId;
    public $pinCode;
    public $package;
    public $name = '';
    public $email = '';
    public $phone = '';
    public $eventDate = '';
    public $eventTime = '';
    public $eventEndDate = '';
    public $guestCount = '';
    public $location = '';
    public $specialRequests = '';
    public $paymentMethod = 'cash';
    public $acceptTerms = false;
    public $currentStep = 1;
    public $showPackageDetails = false;
    public $isLoggedIn = false;
    public $existingUser = null;
    public $userMessage = '';
    public $isSubmitting = false;
    public $razorpayOrderId = null;
    public $razorpayPaymentId = null;
    public $razorpaySignature = null;

    protected $rules = [
        'name' => 'required|string|min:2|max:255',
        'phone' => 'required|digits:10',
        'email' => 'nullable|email|max:255',
        'eventDate' => 'required|date|after:today',
        'eventTime' => 'nullable|date_format:H:i',
        'eventEndDate' => 'nullable|date|after:eventDate',
        'guestCount' => 'nullable|integer|min:1|max:10000',
        'location' => 'required|string|min:5|max:500',
        'specialRequests' => 'nullable|string|max:1000',
        'paymentMethod' => 'required|in:cash,online',
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
        'eventTime.date_format' => 'Please enter a valid time format (HH:MM)',
        'eventEndDate.after' => 'Event end date must be after event start date',
        'eventEndDate.date' => 'Please enter a valid event end date',
        'guestCount.integer' => 'Guest count must be a number',
        'guestCount.min' => 'Guest count must be at least 1',
        'guestCount.max' => 'Guest count cannot exceed 10,000',
        'location.required' => 'Event location is required',
        'location.min' => 'Location must be at least 5 characters',
        'location.max' => 'Location cannot exceed 500 characters',
        'specialRequests.max' => 'Special requests cannot exceed 1000 characters',
        'paymentMethod.required' => 'Please select a payment method',
        'acceptTerms.required' => 'You must accept the terms and conditions',
        'acceptTerms.accepted' => 'You must accept the terms and conditions to proceed'
    ];

    public function mount($package_slug = null, $pin_code = null)
    {
        $this->packageId = $package_slug ?: session('booking_package_id') ?: session('package_id') ?: request('package_id');
        $this->pinCode = $pin_code ?: session('booking_pin_code') ?: session('pin_code') ?: request('pin_code');
        
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
        
        // If user just logged in and has booking data, continue to step 4
        if ($this->isLoggedIn && session('booking_step3_data')) {
            $step3Data = session('booking_step3_data');
            $this->name = $step3Data['name'] ?? '';
            $this->email = $step3Data['email'] ?? '';
            $this->phone = $step3Data['phone'] ?? '';
            $this->eventTime = $step3Data['eventTime'] ?? $this->eventTime;
            $this->currentStep = 4; // Go to review page
            session()->forget('booking_step3_data');
            session(['prefill_user_data' => true]); // Allow pre-fill for authenticated user
        } else {
            // Always start from step 1 unless explicitly navigating
            $this->currentStep = 1;
        }
        
        // Clear any step completion flags to ensure proper navigation
        session()->forget(['booking_step3_completed', 'review_step_access']);
    }

    public function loadPackage()
    {
        $this->package = EventPackage::with(['category', 'images'])
            ->where(function($query) {
                $query->where('slug', $this->packageId)
                      ->orWhere('id', $this->packageId);
            })
            ->where('is_active', true)
            ->first();

        if (!$this->package) {
            return redirect()->route('event-packages')->with('error', 'Package not found');
        }
    }

    public function updated($field)
    {
        // Clean up time field - convert empty string to null
        if ($field === 'eventTime') {
            $this->eventTime = empty($this->eventTime) ? null : $this->eventTime;
        }
        
        // Real-time validation for event date
        if ($field === 'eventDate' && $this->eventDate) {
            try {
                $this->validateOnly('eventDate');
            } catch (\Illuminate\Validation\ValidationException $e) {
                // Validation error will be automatically shown
            }
        }
        
        // Real-time validation for event time
        if ($field === 'eventTime' && !empty($this->eventTime)) {
            try {
                $this->validateOnly('eventTime');
            } catch (\Illuminate\Validation\ValidationException $e) {
                // Validation error will be automatically shown
            }
        }
        
        // Real-time validation for event end date
        if ($field === 'eventEndDate' && $this->eventEndDate) {
            try {
                $this->validateOnly('eventEndDate');
            } catch (\Illuminate\Validation\ValidationException $e) {
                // Validation error will be automatically shown
            }
        }
        
        // Check for existing user when phone is entered
        if ($field === 'phone' && strlen($this->phone) >= 10) {
            $this->checkExistingUser();
            try {
                $this->validateOnly('phone');
            } catch (\Illuminate\Validation\ValidationException $e) {
                // Validation error will be automatically shown
            }
        }
        
        // Clean up guest count - convert empty string to null
        if ($field === 'guestCount') {
            $this->guestCount = $this->guestCount === '' ? null : intval($this->guestCount);
            if ($this->guestCount !== null) {
                try {
                    $this->validateOnly('guestCount');
                } catch (\Illuminate\Validation\ValidationException $e) {
                    // Validation error will be automatically shown
                }
            }
        }
        
        // Real-time validation for other fields
        if (in_array($field, ['name', 'email', 'location', 'specialRequests', 'paymentMethod', 'acceptTerms'])) {
            try {
                $this->validateOnly($field);
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
            // Validate all fields including terms acceptance
            $this->validate([
                'name' => 'required|string|min:2|max:255',
                'phone' => 'required|string|min:10|max:15',
                'email' => 'nullable|email|max:255',
                'eventDate' => 'required|date|after:today',
                'eventTime' => 'nullable|date_format:H:i',
                'eventEndDate' => 'nullable|date|after:eventDate',
                'guestCount' => 'nullable|integer|min:1|max:10000',
                'location' => 'required|string|min:5|max:500',
                'specialRequests' => 'nullable|string|max:1000',
                'paymentMethod' => 'required|in:cash,online',
                'acceptTerms' => 'required|accepted'
            ]);

            // Update logged in user's information
            $user = $this->updateUserInfo();
            
            // Handle payment method
            if ($this->paymentMethod === 'online') {
                // Create Razorpay order and initiate payment
                $this->initiateRazorpayPayment($user);
            } else {
                // Process cash payment directly
                $this->processCashPayment($user);
            }
            
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

    private function processCashPayment($user)
    {
        // For cash payment, require 20% advance payment online first
        $this->initiateAdvancePayment($user);
    }

    private function initiateAdvancePayment($user)
    {
        try {
            $razorpayService = new RazorpayService();
            
            // Calculate 20% advance amount
            $totalAmount = $this->getTotalPriceProperty();
            $advanceAmount = $totalAmount * 0.20; // 20% advance
            
            // Create Razorpay order for advance payment
            $order = $razorpayService->createOrder(
                $advanceAmount,
                'INR',
                'advance_' . time(),
                [
                    'package_id' => $this->packageId,
                    'user_id' => $user->id,
                    'pin_code' => $this->pinCode,
                    'payment_type' => 'advance_cash',
                    'total_amount' => $totalAmount
                ]
            );
            
            $this->razorpayOrderId = $order->id;
            
            session([
                'advance_payment_data' => [
                    'user_id' => $user->id,
                    'total_amount' => $totalAmount,
                    'advance_amount' => $advanceAmount,
                    'payment_method' => 'cash',
                    'order_id' => $order->id
                ]
            ]);
            
            // Emit JavaScript event to open Razorpay
            $this->dispatch('initiate-razorpay-payment', [
                'order_id' => $order->id,
                'amount' => $order->amount,
                'currency' => 'INR',
                'customer_name' => $this->name,
                'customer_email' => $this->email,
                'customer_phone' => $this->phone,
                'description' => '20% Advance Payment for ' . $this->package->name
            ]);

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to initiate advance payment: ' . $e->getMessage());
            \Log::error('Advance payment initiation failed: ' . $e->getMessage());
            $this->isSubmitting = false;
        }
    }

    private function initiateRazorpayPayment($user)
    {
        try {
            $razorpayService = new RazorpayService();
            
            // Calculate total amount
            $totalAmount = $this->getTotalPriceProperty();
            
            // Create Razorpay order
            $order = $razorpayService->createOrder(
                $totalAmount,
                'INR',
                'booking_' . time(),
                [
                    'package_id' => $this->packageId,
                    'user_id' => $user->id,
                    'pin_code' => $this->pinCode
                ]
            );
            
            $this->razorpayOrderId = $order->id;
            
            // Store booking data in session for completion after payment
            session(['pending_booking_data' => [
                'user_id' => $user->id,
                'package_id' => $this->package->id,
                'pin_code' => $this->pinCode,
                'event_date' => $this->eventDate,
                'event_time' => !empty($this->eventTime) ? $this->eventTime : null,
                'event_end_date' => !empty($this->eventEndDate) ? $this->eventEndDate : null,
                'guest_count' => !empty($this->guestCount) ? $this->guestCount : null,
                'location' => $this->location,
                'special_requests' => !empty($this->specialRequests) ? $this->specialRequests : null,
                'total_price' => $totalAmount,
                'booking_name' => $this->name,
                'booking_email' => !empty($this->email) ? $this->email : null,
                'booking_phone_no' => $this->phone,
                'razorpay_order_id' => $this->razorpayOrderId
            ]]);
            
            $this->isSubmitting = false;
            
            \Log::info('Razorpay order created successfully', [
                'order_id' => $this->razorpayOrderId,
                'amount' => $totalAmount,
                'user_id' => $user->id
            ]);
            
            // Emit event to frontend to show Razorpay checkout
            $this->dispatch('initiate-razorpay-payment', [
                'order_id' => $this->razorpayOrderId,
                'amount' => $totalAmount * 100, // Convert to paise
                'currency' => 'INR',
                'name' => config('app.name'),
                'description' => $this->package->name . ' - Event Booking',
                'prefill' => [
                    'name' => $this->name,
                    'email' => $this->email,
                    'contact' => $this->phone
                ]
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Razorpay payment initiation failed', [
                'error' => $e->getMessage(),
                'user_id' => $user->id,
                'package_id' => $this->packageId
            ]);
            
            // Fallback to cash payment if Razorpay fails
            session()->flash('error', 'Online payment is currently unavailable. Please select cash payment or try again later.');
            $this->paymentMethod = 'cash';
            $this->isSubmitting = false;
        }
    }

    public function handleAdvancePaymentSuccess($paymentId, $orderId, $signature)
    {
        try {
            $razorpayService = new RazorpayService();
            
            // Verify payment signature
            $isValid = $razorpayService->verifyPaymentSignature($orderId, $paymentId, $signature);
            
            if (!$isValid) {
                throw new \Exception('Payment verification failed');
            }

            $advanceData = session('advance_payment_data');
            if (!$advanceData) {
                throw new \Exception('Advance payment session data not found');
            }

            // Create booking
            $user = User::find($advanceData['user_id']);
            $booking = $this->createBooking($user);
            
            // Update booking to mark advance as paid
            $booking->update([
                'advance_paid' => true,
                'due_amount' => $booking->total_price * 0.80
            ]);
            
            // Create advance payment record (20% paid)
            Payment::create([
                'booking_id' => $booking->id,
                'razorpay_payment_id' => $paymentId,
                'razorpay_order_id' => $orderId,
                'razorpay_signature' => $signature,
                'amount' => $advanceData['advance_amount'],
                'currency' => 'INR',
                'status' => 'paid',
                'payment_method' => 'online',
                'payment_date' => now('Asia/Kolkata'),
                'notes' => '20% advance payment for cash booking (Balance ₹' . number_format($booking->total_price * 0.80, 2) . ' to be paid in cash on event day)'
            ]);

            // Send confirmation email
            $this->sendConfirmationEmail($user, $booking);

            // Clear session data
            session()->forget(['advance_payment_data', 'booking_form_data']);
            
            session()->flash('booking_success', 
                'Your booking has been confirmed! You have paid ₹' . number_format($advanceData['advance_amount'], 2) . 
                ' as advance. Remaining balance: ₹' . number_format($advanceData['total_amount'] - $advanceData['advance_amount'], 2) . 
                ' can be paid later from your profile or on event day.'
            );
            
            $this->isSubmitting = false;
            
            // Redirect to profile page  
            return redirect()->route('profile');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Advance payment processing failed: ' . $e->getMessage());
            \Log::error('Advance payment processing error: ' . $e->getMessage());
            $this->isSubmitting = false;
        }
    }

    public function completeRazorpayPayment($paymentId, $orderId, $signature)
    {
        try {
            $razorpayService = new RazorpayService();
            
            // Verify payment signature
            if (!$razorpayService->verifyPaymentSignature($orderId, $paymentId, $signature)) {
                throw new Exception('Payment signature verification failed');
            }
            
            // Check if this is an advance payment for cash booking
            $advanceData = session('advance_payment_data');
            if ($advanceData && $advanceData['order_id'] === $orderId) {
                return $this->handleAdvancePaymentSuccess($paymentId, $orderId, $signature);
            }
            
            // Handle full payment scenario
            $bookingData = session('pending_booking_data');
            if (!$bookingData || $bookingData['razorpay_order_id'] !== $orderId) {
                throw new Exception('Invalid booking session data');
            }
            
            // Create booking
            $booking = Booking::create([
                'user_id' => $bookingData['user_id'],
                'event_package_id' => $bookingData['package_id'],
                'pin_code' => $bookingData['pin_code'],
                'event_date' => $bookingData['event_date'],
                'event_time' => !empty($bookingData['event_time']) ? $bookingData['event_time'] : null,
                'event_end_date' => !empty($bookingData['event_end_date']) ? $bookingData['event_end_date'] : null,
                'guest_count' => !empty($bookingData['guest_count']) ? intval($bookingData['guest_count']) : null,
                'location' => $bookingData['location'],
                'special_requests' => !empty($bookingData['special_requests']) ? $bookingData['special_requests'] : null,
                'total_price' => $bookingData['total_price'],
                'payment_method' => 'online',
                'advance_amount' => null,
                'advance_paid' => true,
                'due_amount' => 0,
                'booking_name' => $bookingData['booking_name'],
                'booking_email' => !empty($bookingData['booking_email']) ? $bookingData['booking_email'] : null,
                'booking_phone_no' => $bookingData['booking_phone_no'],
                'status' => 'confirmed',
                'is_completed' => false
            ]);
            
            // Create full payment record
            Payment::create([
                'booking_id' => $booking->id,
                'amount' => $bookingData['total_price'],
                'payment_date' => now('Asia/Kolkata'),
                'payment_method' => 'online',
                'razorpay_payment_id' => $paymentId,
                'razorpay_order_id' => $orderId,
                'razorpay_signature' => $signature,
                'status' => 'paid',
                'currency' => 'INR',
                'notes' => 'Full payment via Razorpay'
            ]);
            
            // Send confirmation email
            $user = User::find($bookingData['user_id']);
            $this->sendConfirmationEmail($user, $booking);
            
            // Clear session data
            session()->forget(['pending_booking_data', 'booking_form_data']);
            
            session()->flash('booking_success', 'Your payment was successful and booking has been confirmed!');
            
            return redirect()->route('profile');
            
        } catch (Exception $e) {
            session()->flash('error', 'Payment ver,ification failed: ' . $e->getMessage());
            \Log::error('Razorpay payment completion error: ' . $e->getMessage());
        }
    }

    public function handleRazorpayError($error)
    {
        session()->flash('error', 'Payment failed: ' . $error['description'] ?? 'Unknown error');
        session()->forget('pending_booking_data');
        $this->isSubmitting = false;
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
                'eventTime' => !empty($this->eventTime) ? $this->eventTime : null,
                'eventEndDate' => !empty($this->eventEndDate) ? $this->eventEndDate : null,
                'location' => $this->location,
                'guestCount' => !empty($this->guestCount) ? $this->guestCount : null,
                'specialRequests' => !empty($this->specialRequests) ? $this->specialRequests : null,
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
            $this->eventTime = $formData['eventTime'] ?? $this->eventTime;
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
        $this->validate([
            'eventDate' => 'required|date|after:today',
            'eventTime' => 'nullable|date_format:H:i',
            'eventEndDate' => 'nullable|date|after:eventDate',
            'location' => 'required|string|min:5|max:500',
        ]);
        
        $this->currentStep = 2;
    }

    public function validateStep2()
    {
        $this->validate([
            'guestCount' => 'nullable|integer|min:1|max:10000',
            'specialRequests' => 'nullable|string|max:1000',
        ]);
        
        $this->currentStep = 3;
    }

    public function validateStep3()
    {
        $this->validate([
            'name' => 'required|string|min:2|max:255',
            'phone' => 'required|string|min:10|max:15',
            'email' => 'nullable|email|max:255',
        ]);
        
        // Check if user needs to register/login
        if (!$this->isLoggedIn) {
            // Save form data to session before redirecting
            $this->saveFormDataToSession();
            session(['booking_return_url' => request()->url()]);
            session(['booking_package_id' => $this->packageId]);
            session(['booking_pin_code' => $this->pinCode]);
            session(['booking_step3_data' => [
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'eventTime' => $this->eventTime
            ]]);
            
            // Check if user with this email/phone exists
            $existingUser = \App\Models\User::where('email', $this->email)
                ->orWhere('phone_no', $this->phone)
                ->first();
            
            if ($existingUser) {
                // User exists, redirect to login
                session()->flash('info', 'Account found! Please login to complete your booking.');
                return redirect()->route('login');
            } else {
                // User doesn't exist, redirect to register
                session()->flash('info', 'Please register to complete your booking.');
                return redirect()->route('register');
            }
        }
        
        $this->currentStep = 4;
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

        // Set booking status to confirmed for both payment methods
        $status = 'confirmed';
        $isCompleted = false; // Only admin can mark as completed

        return Booking::create([
            'user_id' => $user->id,
            'event_package_id' => $this->package->id,
            'booking_name' => $this->name,
            'booking_email' => $this->email ?: null,
            'booking_phone_no' => $this->phone,
            'event_date' => $this->eventDate,
            'event_time' => !empty($this->eventTime) ? $this->eventTime : null,
            'event_end_date' => !empty($this->eventEndDate) ? $this->eventEndDate : null,
            'guest_count' => !empty($this->guestCount) ? intval($this->guestCount) : null,
            'location' => $this->location,
            'special_requests' => !empty($this->specialRequests) ? $this->specialRequests : null,
            'status' => $status,
            'total_price' => $this->package->discounted_price,
            'payment_method' => $this->paymentMethod,
            'advance_amount' => $this->paymentMethod === 'cash' ? ($this->package->discounted_price * 0.20) : null,
            'advance_paid' => false,
            'due_amount' => $this->paymentMethod === 'cash' ? ($this->package->discounted_price * 0.80) : 0,
            'pin_code' => $this->pinCode,
            'is_completed' => $isCompleted
        ]);
    }

    private function createPaymentRecord($booking)
    {
        if ($this->paymentMethod === 'cash') {
            // Create advance payment record for 20% of total amount
            $advanceAmount = $booking->total_price * 0.20;
            
            $paymentData = [
                'booking_id' => $booking->id,
                'amount' => $advanceAmount,
                'payment_date' => now('Asia/Kolkata'),
                'payment_method' => 'online', // 20% advance via Razorpay
                'transaction_id' => 'ADVANCE_' . now()->format('YmdHis') . '_' . $booking->id,
                'status' => 'pending',
                'notes' => 'Cash booking - 20% advance payment via Razorpay (Balance ₹' . number_format($booking->total_price * 0.80, 2) . ' to be paid in cash on event day)',
                'currency' => 'INR'
            ];
        } else {
            // For full online payment
            $paymentData = [
                'booking_id' => $booking->id,
                'amount' => $booking->total_price,
                'payment_date' => now('Asia/Kolkata'),
                'payment_method' => $this->paymentMethod,
                'status' => 'pending',
                'notes' => 'Full online payment',
                'currency' => 'INR'
            ];
        }

        return Payment::create($paymentData);
    }

    private function sendConfirmationEmail($user, $booking)
    {
        try {
            \Log::info("Starting email send process for booking ID: {$booking->id}");
            
            // Load the booking with relationships
            $booking->load(['eventPackage', 'user']);
            
            // Send confirmation email to user using the user_id from booking
            $bookingUser = $booking->user;
            if ($bookingUser && $bookingUser->email) {
                Mail::to($bookingUser->email)->send(new BookingConfirmationMail($booking, false));
                \Log::info("Booking confirmation email sent to user: {$bookingUser->email} (User ID: {$bookingUser->id})");
            } else {
                \Log::warning("No email found for user ID: {$booking->user_id}");
            }
            
            // Send notification email to all admin users (where is_admin = 1)
            $adminUsers = User::where('is_admin', 1)->get();
            if ($adminUsers->count() > 0) {
                foreach ($adminUsers as $admin) {
                    if ($admin->email) {
                        Mail::to($admin->email)->send(new BookingConfirmationMail($booking, true));
                        \Log::info("Booking notification email sent to admin: {$admin->email} (Admin ID: {$admin->id})");
                    }
                }
            } else {
                \Log::warning("No admin users found with is_admin = 1");
            }
            
            // If user has temp password, include it in email (for new registrations)
            if (isset($user->temp_password)) {
                \Log::info("New account created with password: {$user->temp_password}");
                // You could send a separate welcome email here if needed
            }
            
            \Log::info("Email send process completed for booking ID: {$booking->id}");
        } catch (\Exception $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
            \Log::error('Email error stack trace: ' . $e->getTraceAsString());
            // Don't throw the exception as we don't want email failure to break the booking process
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
            
            // Auto-fill user details if fields are empty or if explicitly requested
            if (empty($this->name) || empty($this->email) || empty($this->phone) || 
                session('prefill_user_data') || session('booking_step3_data')) {
                
                $this->name = $this->existingUser->name ?? $this->name;
                $this->email = $this->existingUser->email ?? $this->email;
                $this->phone = $this->existingUser->phone_no ?? $this->phone;
                
                session()->forget('prefill_user_data');
            }
            
            $this->userMessage = "Welcome back, {$this->existingUser->name}! Your details have been pre-filled. You can modify them for this booking if needed.";
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