<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'booking_id',
        'amount',
        'currency',
        'payment_date',
        'payment_method',
        'transaction_id',
        'razorpay_payment_id',
        'razorpay_order_id',
        'razorpay_signature',
        'status',
        'notes',
        'receipt_url'
    ];

    protected $casts = [
        'payment_date' => 'datetime',
        'amount' => 'decimal:2',
    ];

    // Relationships
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}
