<?php

namespace App\Livewire\Admin\Booking;

use Livewire\Component;
use App\Models\Booking;
use App\Models\EventPackage;
use App\Models\Service;
use Illuminate\Validation\ValidationException;

class CreateBooking extends Component
{
    public $currentStep = 1;
    public $manualLocation = '';
    public $pin_code = '';
    public $event_package_id = '';
    public $guest_count = 1;
    public $event_date_date = '';
    public $event_date_time = '';
    public $event_end_date_date = '';
    public $event_end_date_time = '';
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
    public $payment_method = 'online';


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
        'paymentMethod' => 'required|in:online,cash', // Add validation rule

    ];

    public function mount()
    {
        $this->packages = EventPackage::all();
        $this->event_date_date = now()->format('Y-m-d');
        $this->event_end_date_date = now()->format('Y-m-d');
    }

   public function updatedPinCode($value)
{
    $this->checkingPinCode = true;
    $this->isPinCodeAvailable = false;
    $this->resetErrorBag('pin_code');
    session()->forget(['pin_message', 'pin_error']);

    if (preg_match('/^[0-9]{6}$/', $value)) {
        $service = Service::where('pin_code', $value)->first();
        $this->isPinCodeAvailable = $service ? true : false;

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
        $package = EventPackage::find($this->event_package_id);
        $this->total_price = $package ? ($package->price * $this->guest_count) : 0;
    }

    public function nextStep()
{
    if ($this->currentStep === 1) {
        // Validate PIN code
        if (!$this->pin_code || !preg_match('/^[0-9]{6}$/', $this->pin_code)) {
            $this->addError('pin_code', 'Please enter a valid 6-digit PIN code.');
            return;
        }

        if (!$this->isPinCodeAvailable) {
            $this->addError('pin_code', 'Service is not available for this PIN code.');
            return;
        }
    } elseif ($this->currentStep === 2) {
        $this->validate([
            'event_package_id' => 'required',
            'guest_count' => 'required|integer|min:1',
            'event_date_date' => 'required|date|after_or_equal:today',
            'event_end_date_date' => 'required|date|after_or_equal:event_date_date',
        ]);
    } elseif ($this->currentStep === 4) {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_no' => 'required|string|max:15',
            'secondary_phone' => 'nullable|string|max:15',
            'billing_address' => 'required|string',
        ]);
    } elseif ($this->currentStep === 5) {
        $this->validate(['acceptTerms' => 'accepted']);
    }

    if ($this->currentStep < 5) {
        $this->currentStep++;
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
        $this->validate();
        
        if (!$this->isPinCodeAvailable) {
            $this->addError('pin_code', 'Service not available for this PIN code.');
            return;
        }
        
        $this->isSubmitting = true;
        
        try {
            $razorpayService = new \App\Services\RazorpayService();
            $order = $razorpayService->createOrder($this->total_price, 'INR', 'admin_booking_' . time(), [
                'admin' => true,
                'event_package_id' => $this->event_package_id,
                'pin_code' => $this->pin_code,
                'name' => $this->name,
                'email' => $this->email,
                'phone_no' => $this->phone_no
            ]);
            
            $this->razorpayOrderId = $order->id;
            
            $this->dispatch('initiate-razorpay-payment', [
                'order_id' => $order->id,
                'amount' => $order->amount,
                'currency' => 'INR',
                'name' => $this->name,
                'description' => 'Admin Booking Payment',
                'prefill' => [
                    'name' => $this->name,
                    'email' => $this->email,
                    'contact' => $this->phone_no
                ]
            ]);
        } catch (\Exception $e) {
            $this->isSubmitting = false;
            $this->addError('booking', 'Failed to initiate payment: ' . $e->getMessage());
        }
    }

    public function completeRazorpayPayment($paymentId, $orderId, $signature)
    {
        $razorpayService = new \App\Services\RazorpayService();
        
        if (!$razorpayService->verifyPaymentSignature($orderId, $paymentId, $signature)) {
            $this->addError('booking', 'Payment verification failed.');
            $this->isSubmitting = false;
            return;
        }
        
        try {
            $this->isSubmitting = true;
            // Calculate advance amount if needed
        $advance_amount = ($this->paymentMethod === 'cash') 
            ? $this->total_price * 0.2 
            : $this->total_price;


            Booking::create([
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
                'payment_method' => $this->paymentMethod,
                'advance_amount' => $advance_amount,
                'balance_amount' => $this->total_price - $advance_amount,
                'status' => 'confirmed',

            ]);
            
            session()->flash('message', 'Booking created and payment successful!');
            $this->closeModal();
        } catch (\Exception $e) {
            $this->addError('booking', 'Failed to save booking after payment: ' . $e->getMessage());
        }
        
        $this->isSubmitting = false;
    }
    
    public function render()
    {
        return view('livewire.admin.booking.create-booking');
    }
}