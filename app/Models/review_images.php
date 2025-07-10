<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class review_images extends Model
{
    protected $guarded = [];

    public function review()
    {
        return $this->belongsTo(reviews::class, 'review_id');
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }
}
