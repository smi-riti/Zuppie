<?php

namespace App\Livewire\Admin\Booking;

use Livewire\Component;
use App\Models\Booking;
use App\Models\EventPackage;
use App\Models\Service;
use App\Services\RazorpayService;
use App\Models\Payment;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
#[Title('Create Booking')]
class CreateBooking extends Component
{
    public $currentStep = 1;
    public $manualLocation = '';
    public $pin_code = '';
    public $event_package_id = '';
    public $guest_count = 1;
    public $event_date_date;
    public $event_date_time;
    public $event_end_date_date;
    public $event_end_date_time;
    public $special_requests = '';
    public $additional_services = [];
    public $name = '';
    public $email = '';
    public $phone_no = '';
    public $secondary_phone = '';
    public $billing_address = '';
    public $total_price = 0;
    public $acceptTerms = false;
    public $packages;
    public $checkingPinCode = false;
    public $isPinCodeAvailable = false;
    public $razorpayOrderId = null;
    public $razorpayPaymentId = null;
    public $razorpaySignature = null;
    public $isSubmitting = false;
    public $payment_method = 'online'; // Use underscore consistently
    protected $listeners = [
        'completeRazorpayPayment', // emitted from JS when payment succeeds
        'payment-failed' => 'handleRazorpayError', // optional: map JS failure event
    ];

    protected $rules = [
        'event_package_id' => 'required',
        'guest_count' => 'required|integer|min:1',
        'event_date_date' => 'required|date|after_or_equal:today',
        'event_date_time' => 'required',
        'event_end_date_date' => 'required|date|after_or_equal:event_date_date',
        'event_end_date_time' => 'required',
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone_no' => 'required|string|max:15',
        'secondary_phone' => 'nullable|string|max:15',
        'billing_address' => 'required|string',
        'acceptTerms' => 'accepted',
        'payment_method' => 'required|in:online,cash',
    ];

    public function mount()
    {
        $this->packages = EventPackage::all();
        $this->event_date_date = now()->format('Y-m-d');
        $this->event_end_date_date = now()->addDay()->format('Y-m-d');
        $this->event_date_time = '10:00';
        $this->event_end_date_time = '18:00';
    }

    public function updatedPinCode($value)
    {
        $this->checkingPinCode = true;
        $this->isPinCodeAvailable = false;
        $this->resetErrorBag('pin_code');
        session()->forget(['pin_message', 'pin_error']);

        if (preg_match('/^[0-9]{6}$/', $value)) {
            $service = Service::where('pin_code', $value)->first();
            $this->isPinCodeAvailable = (bool)$service;

            if ($this->isPinCodeAvailable) {
                session()->flash('pin_message', 'Great! We provide services in your area.');
            } else {
                session()->flash('pin_error', 'Sorry, we don\'t provide services in this area yet.');
            }
        } else {
            $this->addError('pin_code', 'Please enter a valid 6-digit PIN code.');
        }

        $this->checkingPinCode = false;
    }

    public function calculateTotal()
    {
        if ($package = EventPackage::find($this->event_package_id)) {
            $this->total_price = $package->price * $this->guest_count;
        } else {
            $this->total_price = 0;
        }
    }

    public function nextStep()
    {
        try {
            if ($this->currentStep === 1) {
                if (!$this->pin_code || !preg_match('/^[0-9]{6}$/', $this->pin_code)) {
                    throw ValidationException::withMessages([
                        'pin_code' => ['Please enter a valid 6-digit PIN code.']
                    ]);
                }
                
                if (!$this->isPinCodeAvailable) {
                    throw ValidationException::withMessages([
                        'pin_code' => ['Service is not available for this PIN code.']
                    ]);
                }
            } 
            elseif ($this->currentStep === 2) {
                $this->validate([
                    'event_package_id' => 'required',
                    'guest_count' => 'required|integer|min:1',
                    'event_date_date' => 'required|date|after_or_equal:today',
                    'event_end_date_date' => 'required|date|after_or_equal:event_date_date',
                ]);
            } 
            elseif ($this->currentStep === 3) {
                // No validation needed for optional fields
            } 
            elseif ($this->currentStep === 4) {
                $this->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                    'phone_no' => 'required|string|max:15',
                    'secondary_phone' => 'nullable|string|max:15',
                    'billing_address' => 'required|string',
                    'payment_method' => 'required|in:online,cash',
                ]);
            }

            if ($this->currentStep < 5) {
                $this->currentStep++;
            }
        } catch (ValidationException $e) {
            $this->setErrorBag($e->validator->getMessageBag());
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function closeModal()
    {
        $this->reset();
        $this->dispatch('closeModal');
    }

    public function saveBooking()
    {
        try {
            $this->validate([
                'acceptTerms' => 'accepted',
                'payment_method' => 'required|in:online,cash',
            ]);

            if (!$this->isPinCodeAvailable) {
                throw new \Exception('Service not available for this PIN code');
            }

            $this->isSubmitting = true;

            $razorpayService = new RazorpayService();
            
            $amount = ($this->payment_method === 'cash') 
                ? $this->total_price * 0.2  
                : $this->total_price;       

            $order = $razorpayService->createOrder(
                $amount * 100, // Convert to paise
                'INR',
                'admin_booking_' . time(),
                [
                    'admin' => true,
                    'event_package_id' => $this->event_package_id,
                    'pin_code' => $this->pin_code,
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone_no' => $this->phone_no,
                    'payment_type' => $this->payment_method
                ]
            );

            $this->razorpayOrderId = $order->id;

            Log::info('Razorpay order created', [
                'order_id' => $order->id,
                'amount' => $order->amount,
                'payment_method' => $this->payment_method,
            ]);

            $this->dispatch('initiate-razorpay-payment', [
                'order_id' => $order->id,
                'amount' => $order->amount,
                'currency' => 'INR',
                'name' => config('app.name'),
                'description' => 'Admin Booking Payment',
                'prefill' => [
                    'name' => $this->name,
                    'email' => $this->email,
                    'contact' => $this->phone_no
                ]
            ]);

        } catch (ValidationException $e) {
            $this->setErrorBag($e->validator->getMessageBag());
            $this->isSubmitting = false;
        } catch (\Exception $e) {
            $this->isSubmitting = false;
            session()->flash('error', 'Error: ' . $e->getMessage());
            Log::error('Booking error: '.$e->getMessage(), ['exception' => $e]);
        }
    }

        public function completeRazorpayPayment($paymentId, $orderId, $signature)
    {
        try {
            Log::info('Payment completion started', [
                'paymentId' => $paymentId,
                'orderId' => $orderId,
                'signature' => $signature
            ]);
            
            $razorpayService = new RazorpayService();
            
            if (!$razorpayService->verifyPaymentSignature($orderId, $paymentId, $signature)) {
                throw new \Exception('Payment signature verification failed');
            }

            // Calculate advance for cash payments
            $advance_amount = ($this->payment_method === 'cash') 
                ? $this->total_price * 0.2 
                : $this->total_price;

            // Create booking
            $booking = Booking::create([
                'event_package_id' => $this->event_package_id,
                'guest_count' => $this->guest_count,
                'event_date' => $this->event_date_date . ' ' . $this->event_date_time,
                'event_end_date' => $this->event_end_date_date . ' ' . $this->event_end_date_time,
                'special_requests' => $this->special_requests,
                'additional_services' => json_encode($this->additional_services),
                'name' => $this->name,
                'email' => $this->email,
                'phone_no' => $this->phone_no,
                'secondary_phone' => $this->secondary_phone,
                'billing_address' => $this->billing_address,
                'total_price' => $this->total_price,
                'pin_code' => $this->pin_code,
                'location' => $this->manualLocation,
                'payment_method' => $this->payment_method,
                'razorpay_order_id' => $orderId,
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature' => $signature,
                'advance_amount' => $advance_amount,
                'balance_amount' => $this->payment_method === 'cash' ? ($this->total_price - $advance_amount) : 0,
                'status' => 'confirmed',
                'admin_created' => true,
            ]);

            // Create payment record
            Payment::create([
                'booking_id' => $booking->id,
                'razorpay_payment_id' => $paymentId,
                'razorpay_order_id' => $orderId,
                'razorpay_signature' => $signature,
                'amount' => $advance_amount,
                'currency' => 'INR',
                'status' => 'paid',
                'payment_method' => 'online',
                'payment_date' => now('Asia/Kolkata'),
                'notes' => ($this->payment_method === 'cash') 
                    ? '20% advance payment for cash booking (Balance ₹' . number_format($this->total_price - $advance_amount, 2) . ' to be paid in cash)' 
                    : 'Full payment via Razorpay'
            ]);

            Log::info('Booking and payment created successfully', [
                'booking_id' => $booking->id,
                'payment_id' => $paymentId
            ]);

            session()->flash('message', 'Booking created and payment successful!');
            $this->closeModal();
            
        } catch (\Exception $e) {
            Log::error('Payment completion failed: ' . $e->getMessage());
            $this->isSubmitting = false;
            session()->flash('error', 'Payment failed: ' . $e->getMessage());
        }
    }

    public function handleRazorpayError($payload = null)
    {
        // JS can send a payload with error details; log and surface to user
        
        
        if (is_array($payload)) {
            $message = $payload['error']['description'] ?? json_encode($payload);
        } else {
            $message = (string) $payload ?: 'Payment failed';
        }

        
        
    session()->flash('error', 'Payment failed: ' . $message);
    $this->isSubmitting = false;
    Log::warning('Razorpay payment failed', ['payload' => $payload]);
    }


    public function render()
    {
        return view('livewire.admin.booking.create-booking');
    }
}
