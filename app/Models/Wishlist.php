<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $guarded = [];
    public function eventPackage(){
        return $this->belongsTo(EventPackage::class,'event_package_id');
    }
}
