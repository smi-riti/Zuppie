<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class GalleryImage extends Model
{
    protected $fillable = [
        'filename',
        'alt',
        'category_id',
        'file_id',
        'description',

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
