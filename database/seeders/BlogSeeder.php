<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BlogSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        
        // Get all user and category IDs
        $userIds = User::pluck('id')->toArray();
        $categoryIds = Category::pluck('id')->toArray();
        
        // Generate exactly 5 blog posts
        for ($i = 0; $i < 5; $i++) {
            $title = $faker->sentence(6, true);
            
            Blog::create([
                'title' => $title,
                'content' => $faker->paragraphs(3, true),
                'image' => $faker->imageUrl(640, 480, 'blog', true),
                'image_file_id' => null, // Assuming this might be used for file management
                'status' => $faker->randomElement(['draft', 'published']),
                'user_id' => $faker->randomElement($userIds),
                'category_id' => $faker->randomElement($categoryIds),
            ]);
        }
    }
}