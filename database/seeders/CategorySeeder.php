<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example parent category
        $parent = Category::create([
            'name' => 'Electronics',
            'description' => 'All kinds of electronic items',
            'is_special' => true,
            'image' => 'https://ik.imagekit.io/demo/electronics.jpg',
            'image_file_id' => 'demo_file_id_1',
        ]);

        // Example child category
        Category::create([
            'name' => 'Mobile Phones',
            'description' => 'Smartphones and accessories',
            'parent_id' => $parent->id,
            'is_special' => false,
            'image' => 'https://ik.imagekit.io/demo/mobiles.jpg',
            'image_file_id' => 'demo_file_id_2',
        ]);

        // Add more categories as needed
        Category::create([
            'name' => 'Laptops',
            'description' => 'Laptops and notebooks',
            'parent_id' => $parent->id,
            'is_special' => false,
            'image' => 'https://ik.imagekit.io/demo/laptops.jpg',
            'image_file_id' => 'demo_file_id_3',
        ]);
    }
}
