<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\EventPackage;
use App\Models\EventPackageImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * This seeder creates default categories if none exist,
     * and populates the database with sample event packages
     * for demonstration purposes.
     */
    public function run(): void
    {
        // Create some categories if none exist
        if (Category::count() === 0) {
            $categories = [
                ['name' => 'Wedding'],
                ['name' => 'Birthday'],
                ['name' => 'Corporate Event'],
                ['name' => 'Anniversary'],
                ['name' => 'Baby Shower'],
            ];

            foreach ($categories as $category) {
                Category::create($category);
            }
        }

        // Get all categories
        $categories = Category::all();

        // Sample packages
        $packages = [
            [
                'name' => 'Premium Wedding Package',
                'price' => 2999.99,
                'discount_type' => 'percentage',
                'discount_value' => 10,
                'description' => "Our premium wedding package includes:\n- Professional photography\n- Gourmet catering\n- Venue decoration\n- DJ and entertainment\n- Wedding coordinator\n- Floral arrangements",
                'is_active' => true,
                'is_special' => true,
                'duration' => 480 * 60 * 1000, // 8 hours in milliseconds
                'category_id' => $categories->where('name', 'Wedding')->first()?->id,
                'images' => [
                    'https://ik.imagekit.io/demo/sample-image1.jpg',
                    'https://ik.imagekit.io/demo/sample-image2.jpg',
                    'https://ik.imagekit.io/demo/sample-image3.jpg',
                ]
            ],
            [
                'name' => 'Basic Birthday Party',
                'price' => 599.99,
                'discount_type' => 'fixed',
                'discount_value' => 50,
                'description' => "Perfect for children's birthday parties:\n- Themed decorations\n- Birthday cake\n- Party games\n- Party favors\n- Basic catering",
                'is_active' => true,
                'is_special' => false,
                'duration' => 180, // 3 hours
                'category_id' => $categories->where('name', 'Birthday')->first()?->id,
                'images' => [
                    'https://ik.imagekit.io/demo/sample-birthday1.jpg',
                    'https://ik.imagekit.io/demo/sample-birthday2.jpg',
                ]
            ],
            [
                'name' => 'Corporate Conference',
                'price' => 4999.99,
                'discount_type' => null,
                'discount_value' => null,
                'description' => "Professional corporate event solution:\n- Conference room setup\n- Audio/visual equipment\n- Professional staff\n- Catering options\n- Networking area\n- Registration services",
                'is_active' => true,
                'is_special' => false,
                'duration' => 480, // 8 hours
                'category_id' => $categories->where('name', 'Corporate Event')->first()?->id,
                'images' => [
                    'https://ik.imagekit.io/demo/sample-corporate1.jpg',
                ]
            ],
            [
                'name' => 'Silver Anniversary',
                'price' => 1499.99,
                'discount_type' => 'percentage',
                'discount_value' => 5,
                'description' => "Celebrate your special milestone:\n- Elegant decorations\n- Anniversary cake\n- Professional photography\n- Dinner service\n- Champagne toast",
                'is_active' => true,
                'is_special' => true,
                'duration' => 300, // 5 hours
                'category_id' => $categories->where('name', 'Anniversary')->first()?->id,
                'images' => [
                    'https://ik.imagekit.io/demo/sample-anniversary1.jpg',
                    'https://ik.imagekit.io/demo/sample-anniversary2.jpg',
                ]
            ],
            [
                'name' => 'Deluxe Baby Shower',
                'price' => 899.99,
                'discount_type' => 'fixed',
                'discount_value' => 100,
                'description' => "Welcome the new arrival in style:\n- Custom theme decorations\n- Catering and refreshments\n- Baby shower games\n- Party favors\n- Professional photography",
                'is_active' => true,
                'is_special' => false,
                'duration' => 240, // 4 hours
                'category_id' => $categories->where('name', 'Baby Shower')->first()?->id,
                'images' => [
                    'https://ik.imagekit.io/demo/sample-babyshower1.jpg',
                ]
            ],
            [
                'name' => 'Elite Wedding Experience',
                'price' => 8999.99,
                'discount_type' => null,
                'discount_value' => null,
                'description' => "The ultimate wedding experience:\n- Luxury venue\n- Gourmet multi-course meal\n- Premium open bar\n- Live band and DJ\n- Professional photography and videography\n- Wedding planner\n- Luxury transportation",
                'is_active' => true,
                'is_special' => true,
                'duration' => 720, // 12 hours
                'category_id' => $categories->where('name', 'Wedding')->first()?->id,
                'images' => [
                    'https://ik.imagekit.io/demo/sample-elite-wedding1.jpg',
                    'https://ik.imagekit.io/demo/sample-elite-wedding2.jpg',
                ]
            ],
            [
                'name' => 'VIP Birthday Experience',
                'price' => 1999.99,
                'discount_type' => 'percentage',
                'discount_value' => 15,
                'description' => "Celebrate in VIP style:\n- Private venue\n- Custom decorations\n- Premium catering\n- Open bar\n- Entertainment options\n- Red carpet entrance",
                'is_active' => false, // Inactive package
                'is_special' => true,
                'duration' => 360, // 6 hours
                'category_id' => $categories->where('name', 'Birthday')->first()?->id,
                'images' => [
                    'https://ik.imagekit.io/demo/sample-vip-birthday1.jpg',
                ]
            ],
        ];

        // Create packages
        foreach ($packages as $packageData) {
            $images = $packageData['images'];
            unset($packageData['images']);
            
            $package = EventPackage::create($packageData);

            // Create images for this package
            foreach ($images as $imageUrl) {
                EventPackageImage::create([
                    'event_package_id' => $package->id,
                    'image_url' => $imageUrl,
                    'image_file_id' => 'seed_' . uniqid(), // Fake file ID for seeded data
                ]);
            }
        }

        $this->command->info('Created ' . count($packages) . ' event packages with images!');
    }
}
