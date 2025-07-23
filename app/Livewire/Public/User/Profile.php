<?php

namespace App\Livewire\Public\User;

use App\Models\Booking;
use App\Models\EventPackage;
use App\Models\Wishlist;
use App\Services\WishlistService;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
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

    public $isProcessingPayment = false;
    protected $listeners = [
        'closeViewModal' => 'closeViewModal',
        'closeReviewModal' => 'closeReviewModal',
        'closeEditProfileModal' => 'closeEditProfileModal',
        'completeRazorpayPayment' => 'completeRazorpayPayment'
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
        $this->upComingBookings = Booking::with(['eventPackage', 'payments'])
            ->where('user_id', auth()->id())
            ->where('status', 'confirmed')
            ->where('is_completed', 0)
            ->whereDate('event_date', '>=', now()->toDateString())
            ->get();

        $this->pastBookings = Booking::with(['eventPackage', 'payments'])
            ->where('user_id', auth()->id())
            ->whereDate('event_date', '<', now()->toDateString())
            ->where('is_completed', 1)
            ->where('status', 'confirmed')
            ->get();

        $this->completedBookings = Booking::with(['eventPackage', 'payments'])
            ->where(function ($query) {
                $query->where('user_id', auth()->id())
                    ->where('is_completed', 1);
            })->get();
            
        $this->cancelledBookings = Booking::with(['eventPackage', 'payments'])
            ->where('user_id', auth()->id())
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

    public function getPaymentMethod($booking)
    {
        // Check if booking has payment_method field
        if (isset($booking->payment_method)) {
            if ($booking->payment_method === 'cash') {
                // Check if advance payment is made
                $advancePaid = $booking->payments()
                    ->where('status', 'paid')
                    ->where('payment_method', 'razorpay')
                    ->exists();
                
                if ($advancePaid) {
                    return 'Cash Payment (20% advance paid via Razorpay)';
                } else {
                    return 'Cash Payment (20% advance required via Razorpay)';
                }
            } else {
                return 'Online Payment (Razorpay)';
            }
        }
        
        // Fallback for older bookings without payment_method field
        if (!$booking->payments->count()) {
            return 'Cash Payment (20% advance required)';
        }
        
        $payment = $booking->payments->first();
        return $payment->payment_method === 'razorpay' ? 'Online Payment (Razorpay)' : 'Cash Payment';
    }

    public function getPaymentStatus($booking)
    {
        if (!$booking->payments->count()) return 'pending';
        
        return $booking->payments->first()->status;
    }

    public function downloadInvoice($bookingId)
    {
        $booking = Booking::find($bookingId);
        
        if (!$booking || $booking->user_id !== auth()->id()) {
            session()->flash('error', 'Booking not found or unauthorized access.');
            return;
        }

        // Only allow invoice download for confirmed bookings
        if ($booking->status !== 'confirmed') {
            session()->flash('error', 'Invoice can only be downloaded for confirmed bookings.');
            return;
        }

        // Redirect to invoice download route
        return redirect()->route('invoices.download', ['invoice' => $bookingId]);
    }

    public function getBalanceAmount($booking)
    {
        // Use discounted price as the total amount (after discount)
        $totalAfterDiscount = $booking->eventPackage->discounted_price ?? $booking->total_price;
        
        // Calculate total amount paid
        $totalPaid = $booking->payments()
            ->where('status', 'paid')
            ->sum('amount');
        
        // Balance = Total After Discount - Amount Paid
        $balance = $totalAfterDiscount - $totalPaid;
        
        return max(0, $balance); // Ensure balance is never negative
    }

    public function hasUnpaidBalance($booking)
    {
        return $this->getBalanceAmount($booking) > 0;
    }

    public function isPaymentCompleted($booking)
    {
        // Use discounted price as the total amount (after discount)
        $totalAfterDiscount = $booking->eventPackage->discounted_price ?? $booking->total_price;
        
        $totalPaid = $booking->payments()
            ->where('status', 'paid')
            ->sum('amount');
        
        return $totalPaid >= $totalAfterDiscount;
    }

    public function getTotalAmountAfterDiscount($booking)
    {
        return $booking->eventPackage->discounted_price ?? $booking->total_price;
    }

    public function getTotalPaidAmount($booking)
    {
        return $booking->payments()
            ->where('status', 'paid')
            ->sum('amount');
    }

    public function getDueAmount($booking)
    {
        $dueAmount = $this->getBalanceAmount($booking);
        
        // Update the due_amount in database if different
        if ($booking->due_amount != $dueAmount) {
            $booking->update(['due_amount' => $dueAmount]);
        }
        
        return $dueAmount;
    }

    public function initiatePayment($bookingId)
    {
        $this->isProcessingPayment = true;
        
        $booking = Booking::with(['eventPackage', 'payments'])->find($bookingId);
        
        if (!$booking || $booking->user_id !== auth()->id()) {
            session()->flash('error', 'Booking not found or unauthorized access.');
            $this->isProcessingPayment = false;
            return;
        }

        if ($booking->status !== 'confirmed' || !$this->hasUnpaidBalance($booking)) {
            session()->flash('error', 'Payment not required for this booking.');
            $this->isProcessingPayment = false;
            return;
        }

        // Store booking information in session for payment completion
        session([
            'pending_payment_booking_id' => $bookingId,
            'pending_payment_amount' => $this->getBalanceAmount($booking)
        ]);

        // Create Razorpay order for the pending amount
        try {
            // Debug: Check Razorpay configuration
            $razorpayKey = config('services.razorpay.key');
            $razorpaySecret = config('services.razorpay.secret');
            
            \Log::info('Profile Payment Initiation - Config Check', [
                'key' => $razorpayKey ? 'Set (Length: ' . strlen($razorpayKey) . ')' : 'Not Set',
                'secret' => $razorpaySecret ? 'Set (Length: ' . strlen($razorpaySecret) . ')' : 'Not Set',
                'booking_id' => $bookingId,
                'balance_amount' => $this->getBalanceAmount($booking)
            ]);

            if (!$razorpayKey || !$razorpaySecret) {
                throw new \Exception('Razorpay credentials not configured properly. Key: ' . ($razorpayKey ? 'Set' : 'Missing') . ', Secret: ' . ($razorpaySecret ? 'Set' : 'Missing'));
            }
            
            $razorpayService = new \App\Services\RazorpayService();
            $orderData = $razorpayService->createOrder(
                $this->getBalanceAmount($booking),
                'INR',
                'booking_payment_' . $bookingId,
                [
                    'booking_id' => $bookingId,
                    'payment_type' => 'balance_payment'
                ]
            );

            \Log::info('Razorpay Order Created Successfully', [
                'order_id' => $orderData->id,
                'amount' => $orderData->amount,
                'booking_id' => $bookingId
            ]);

            // Emit event to initiate Razorpay payment
            $this->dispatch('initiate-razorpay-payment', [
                'order_id' => $orderData->id,
                'amount' => $orderData->amount,
                'currency' => $orderData->currency,
                'booking_id' => $bookingId,
                'customer_name' => $booking->booking_name ?? $booking->user->name,
                'customer_email' => $booking->booking_email ?? $booking->user->email,
                'customer_phone' => $booking->booking_phone_no ?? $booking->user->phone_no
            ]);

        } catch (\Exception $e) {
            \Log::error('Razorpay Payment Initiation Failed', [
                'booking_id' => $bookingId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            session()->flash('error', 'Payment Failed: ' . $e->getMessage());
            $this->isProcessingPayment = false;
        }
    }

    public function completeRazorpayPayment($paymentId, $orderId, $signature)
    {
        try {
            $this->isProcessingPayment = true;
            
            $razorpayService = new \App\Services\RazorpayService();
            
            // Verify payment signature
            $isValid = $razorpayService->verifyPaymentSignature(
                $orderId,
                $paymentId,
                $signature
            );

            if (!$isValid) {
                session()->flash('error', 'Payment verification failed.');
                return;
            }

            $bookingId = session('pending_payment_booking_id');
            $booking = Booking::find($bookingId);

            if (!$booking) {
                session()->flash('error', 'Booking not found.');
                return;
            }

            // Create payment record
            $paymentAmount = session('pending_payment_amount');
            $paymentNotes = 'Balance payment via Razorpay from profile';
            
            // Check if this is an advance payment for cash booking
            if ($booking->payment_method === 'cash' && !$booking->advance_paid) {
                $paymentNotes = '20% advance payment via Razorpay for cash booking (Balance ₹' . number_format($booking->total_price * 0.80, 2) . ' to be paid in cash on event day)';
                
                // Update booking to mark advance as paid
                $booking->update([
                    'advance_paid' => true,
                    'due_amount' => $booking->total_price * 0.80
                ]);
            } else {
                // This is due payment - mark booking as fully paid if paying full due amount
                $totalPaid = $booking->payments()->sum('amount') + $paymentAmount;
                if ($totalPaid >= $booking->total_price) {
                    $booking->update([
                        'due_amount' => 0,
                        'payment_status' => 'paid'
                    ]);
                    $paymentNotes = 'Final balance payment via Razorpay - Booking fully paid';
                } else {
                    $remainingDue = $booking->total_price - $totalPaid;
                    $booking->update([
                        'due_amount' => $remainingDue
                    ]);
                    $paymentNotes = 'Partial payment via Razorpay (Remaining due: ₹' . number_format($remainingDue, 2) . ')';
                }
            }

            Payment::create([
                'booking_id' => $bookingId,
                'razorpay_payment_id' => $paymentId,
                'razorpay_order_id' => $orderId,
                'razorpay_signature' => $signature,
                'amount' => $paymentAmount,
                'currency' => 'INR',
                'status' => 'paid',
                'payment_method' => 'razorpay',
                'payment_date' => now('Asia/Kolkata'),
                'notes' => $paymentNotes
            ]);

            // Clear session data
            session()->forget(['pending_payment_booking_id', 'pending_payment_amount']);

            session()->flash('success', 'Payment completed successfully!');
            $this->isProcessingPayment = false;
            return redirect()->route('profile');

        } catch (\Exception $e) {
            $this->isProcessingPayment = false;
            session()->flash('error', 'Payment processing failed. Please contact support.');
            \Log::error('Payment processing failed: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $bookings = Booking::with(['eventPackage', 'payments'])
            ->where('user_id', auth()->id())
            ->orderBy('event_date', 'desc')
            ->get();
        return view('livewire.public.user.profile', compact('bookings'));
    }
}
