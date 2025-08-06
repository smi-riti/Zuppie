<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Services\RazorpayService;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RazorpayWebhookController extends Controller
{
    protected $razorpayService;

    public function __construct(RazorpayService $razorpayService)
    {
        $this->razorpayService = $razorpayService;
    }

    public function handleWebhook(Request $request)
    {
        try {
            $payload = $request->getContent();
            $signature = $request->header('X-Razorpay-Signature');
            
            // Verify webhook signature
            if (!$this->razorpayService->verifyWebhookSignature($payload, $signature)) {
                Log::warning('Razorpay webhook signature verification failed');
                return response()->json(['error' => 'Invalid signature'], 400);
            }
            
            $data = json_decode($payload, true);
            $event = $data['event'];
            $paymentEntity = $data['payload']['payment']['entity'];
            
            Log::info('Razorpay webhook received', ['event' => $event, 'payment_id' => $paymentEntity['id']]);
            
            switch ($event) {
                case 'payment.captured':
                    $this->handlePaymentCaptured($paymentEntity);
                    break;
                    
                case 'payment.failed':
                    $this->handlePaymentFailed($paymentEntity);
                    break;
                    
                default:
                    Log::info('Unhandled Razorpay webhook event', ['event' => $event]);
            }
            
            return response()->json(['status' => 'success']);
            
        } catch (\Exception $e) {
            Log::error('Razorpay webhook error: ' . $e->getMessage());
            return response()->json(['error' => 'Webhook processing failed'], 500);
        }
    }
    
    private function handlePaymentCaptured($paymentEntity)
    {
        $paymentId = $paymentEntity['id'];
        $orderId = $paymentEntity['order_id'];
        $amount = $paymentEntity['amount'] / 100; // Convert from paise to rupees
        
        // Find payment record and update status
        $payment = Payment::where('transaction_id', $paymentId)->first();
        if ($payment) {
            $payment->update(['status' => 'completed']);
            
            // Update booking status
            $booking = $payment->booking;
            if ($booking) {
                $booking->update([
                    'status' => 'confirmed',
                    'is_completed' => true
                ]);
            }
            
            Log::info('Payment captured and booking confirmed', [
                'payment_id' => $paymentId,
                'booking_id' => $booking ? $booking->id : 'Not found'
            ]);
        }
    }
    
    private function handlePaymentFailed($paymentEntity)
    {
        $paymentId = $paymentEntity['id'];
        
        // Find payment record and update status
        $payment = Payment::where('transaction_id', $paymentId)->first();
        if ($payment) {
            $payment->update(['status' => 'failed']);
            
            Log::info('Payment failed', ['payment_id' => $paymentId]);
        }
    }
}
