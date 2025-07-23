<?php

namespace App\Services;

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use Exception;

class RazorpayService
{
    protected $api;
    protected $keyId;
    protected $keySecret;
    protected $testMode = false;

    public function __construct()
    {
        $this->keyId = config('services.razorpay.key');
        $this->keySecret = config('services.razorpay.secret');
        
        // Enable test mode only if credentials are missing, empty, or explicitly test keys
        if (!$this->keyId || !$this->keySecret || 
            strlen($this->keyId) < 10 || strlen($this->keySecret) < 10) {
            $this->testMode = true;
            \Log::info('Razorpay service running in test mode - credentials missing or invalid', [
                'key_id_present' => !empty($this->keyId),
                'key_secret_present' => !empty($this->keySecret),
                'key_id_length' => $this->keyId ? strlen($this->keyId) : 0,
                'key_secret_length' => $this->keySecret ? strlen($this->keySecret) : 0
            ]);
            return;
        }
        
        try {
            $this->api = new Api($this->keyId, $this->keySecret);
            $this->testMode = false;
            \Log::info('Razorpay service initialized successfully with real credentials', [
                'key_id' => substr($this->keyId, 0, 12) . '...',
                'environment' => config('services.razorpay.env', 'test')
            ]);
        } catch (Exception $e) {
            $this->testMode = true;
            \Log::warning('Razorpay API initialization failed, switching to test mode', [
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Create a Razorpay order
     */
    public function createOrder($amount, $currency = 'INR', $receipt = null, $notes = [])
    {
        // Handle array parameter for backward compatibility
        if (is_array($amount)) {
            $orderData = $amount;
            $amount = $orderData['amount'] ?? 0;
            $currency = $orderData['currency'] ?? 'INR';
            $receipt = $orderData['receipt'] ?? null;
            $notes = $orderData['notes'] ?? [];
        }

        if ($this->testMode) {
            return $this->createTestOrder($amount, $currency, $receipt, $notes);
        }

        try {
            $orderData = [
                'amount' => floatval($amount) * 100, // Convert to paise (smallest currency unit)
                'currency' => $currency,
                'receipt' => $receipt ?: 'receipt_' . time(),
                'notes' => $notes
            ];

            \Log::info('Creating Razorpay order', [
                'orderData' => $orderData,
                'keyId' => $this->keyId
            ]);

            $order = $this->api->order->create($orderData);
            
            \Log::info('Razorpay order created successfully', ['order' => $order]);
            
            return $order;
        } catch (Exception $e) {
            \Log::error('Razorpay order creation failed', [
                'error' => $e->getMessage(),
                'amount' => $amount,
                'keyId' => $this->keyId
            ]);
            
            // Fallback to test mode
            return $this->createTestOrder($amount, $currency, $receipt, $notes);
        }
    }

    /**
     * Create a test order for development
     */
    private function createTestOrder($amount, $currency = 'INR', $receipt = null, $notes = [])
    {
        $amountInPaise = floatval($amount) * 100;
        
        $testOrder = [
            'id' => 'order_test_' . time() . rand(1000, 9999),
            'entity' => 'order',
            'amount' => $amountInPaise,
            'amount_paid' => 0,
            'amount_due' => $amountInPaise,
            'currency' => $currency,
            'receipt' => $receipt ?: 'test_receipt_' . time(),
            'offer_id' => null,
            'status' => 'created',
            'attempts' => 0,
            'notes' => $notes,
            'created_at' => time()
        ];
        
        \Log::info('Test Razorpay order created', $testOrder);
        
        return (object) $testOrder;
    }

    /**
     * Verify payment signature
     */
    public function verifyPaymentSignature($razorpayOrderId, $razorpayPaymentId, $signature)
    {
        if ($this->testMode) {
            // In test mode, accept any properly formatted test payment
            return str_starts_with($razorpayOrderId, 'order_test_') && 
                   str_starts_with($razorpayPaymentId, 'pay_test_') &&
                   !empty($signature);
        }

        try {
            $attributes = [
                'razorpay_order_id' => $razorpayOrderId,
                'razorpay_payment_id' => $razorpayPaymentId,
                'razorpay_signature' => $signature
            ];

            $this->api->utility->verifyPaymentSignature($attributes);
            return true;
        } catch (SignatureVerificationError $e) {
            return false;
        }
    }

    /**
     * Fetch payment details
     */
    public function fetchPayment($paymentId)
    {
        try {
            return $this->api->payment->fetch($paymentId);
        } catch (Exception $e) {
            throw new Exception('Failed to fetch payment: ' . $e->getMessage());
        }
    }

    /**
     * Fetch order details
     */
    public function fetchOrder($orderId)
    {
        try {
            return $this->api->order->fetch($orderId);
        } catch (Exception $e) {
            throw new Exception('Failed to fetch order: ' . $e->getMessage());
        }
    }

    /**
     * Create refund
     */
    public function createRefund($paymentId, $amount = null, $notes = [])
    {
        try {
            $refundData = [
                'amount' => $amount ? floatval($amount) * 100 : null, // Convert to paise if amount specified
                'notes' => $notes
            ];

            // Remove null amount if full refund
            if ($refundData['amount'] === null) {
                unset($refundData['amount']);
            }

            return $this->api->payment->fetch($paymentId)->refund($refundData);
        } catch (Exception $e) {
            throw new Exception('Failed to create refund: ' . $e->getMessage());
        }
    }

    /**
     * Verify webhook signature
     */
    public function verifyWebhookSignature($payload, $signature, $secret = null)
    {
        try {
            $webhookSecret = $secret ?: config('razorpay.webhook_secret');
            $this->api->utility->verifyWebhookSignature($payload, $signature, $webhookSecret);
            return true;
        } catch (SignatureVerificationError $e) {
            return false;
        }
    }

    /**
     * Get key ID for frontend
     */
    public function getKeyId()
    {
        return $this->testMode ? 'rzp_test_demo_key' : $this->keyId;
    }

    /**
     * Check if service is running in test mode
     */
    public function isTestMode()
    {
        return $this->testMode;
    }
}
