<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
    {
        // Sample data for gallery_images
        $images = [
            [
                'filename' => 'image1.jpg',
                'alt' => 'Beautiful landscape',
                'category_id' => 1, // Assumes category with ID 1 exists
                'file_id' => Str::random(10),
                'description' => 'A stunning view of a mountain landscape at sunset.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'filename' => 'image2.png',
                'alt' => 'City skyline',
                'category_id' => 2, // Assumes category with ID 2 exists
                'file_id' => Str::random(10),
                'description' => 'A vibrant city skyline during the evening.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'filename' => 'image3.jpg',
                'alt' => null,
                'category_id' => null,
                'file_id' => Str::random(10),
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert the sample data into the gallery_images table
        DB::table('gallery_images')->insert($images);
    }
}