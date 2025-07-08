<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);

            // Ensure slug is unique
            $originalSlug = $slug = $category->slug;
            $count = 2;

            while (static::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            $category->slug = $slug;
        });

        static::updating(function ($category) {
            if ($category->isDirty('name')) {
                $category->slug = Str::slug($category->name);

                // Ensure slug is unique
                $originalSlug = $slug = $category->slug;
                $count = 2;

                while (
                    static::where('slug', $slug)
                        ->where('id', '!=', $category->id)
                        ->exists()
                ) {
                    $slug = $originalSlug . '-' . $count;
                    $count++;
                }

                $category->slug = $slug;
            }
        });
    }
}
