<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reviews extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
