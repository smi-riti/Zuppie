<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\EventPackage;
class Booking extends Model
{
        protected $fillable = [
        'user_id',
        'category_id',
        'event_package_id',
        'booking_date',
        'event_date',
        'event_end_date',
        'guest_count',
        'location',
        'special_requests',
        'status',
        'total_price',
        'payment_status',
        'payment_method',
        'transaction_id',
        'setup_requirements'
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'event_end_date' => 'datetime',
        'booking_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function eventPackage()
    {
        return $this->belongsTo(EventPackage::class);
    }

}
