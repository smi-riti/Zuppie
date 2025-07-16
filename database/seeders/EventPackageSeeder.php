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
        // Get categories
        $birthdayCategory = Category::where('slug', 'birthday')->first();
        $anniversaryCategory = Category::where('slug', 'wedding-anniversary')->first();
        $festivalCategory = Category::where('slug', 'festival')->first();
        $firstBirthdayCategory = Category::where('slug', '1st-birthday')->first();
        $haldiMehndiCategory = Category::where('slug', 'haldi-mehndi')->first();
        $premiumCategory = Category::where('slug', 'premium-decoration')->first();
        $flowerCategory = Category::where('slug', 'flower-bouquet')->first();
        $giftCategory = Category::where('slug', 'gift-section')->first();
        $simpleCategory = Category::where('slug', 'simple-decoration')->first();
        $ringCategory = Category::where('slug', 'ring-decoration')->first();
        $welcomeBabyCategory = Category::where('slug', 'welcome-baby')->first();
        $babyShowerCategory = Category::where('slug', 'baby-shower')->first();
        $loveThemeCategory = Category::where('slug', 'love-theme')->first();
        $brideToBeCategory = Category::where('slug', 'bride-to-be')->first();

        $packages = [
            // Birthday Packages
            [
                'name' => 'Princess Birthday Package',
                'description' => 'Transform your little princess\'s birthday into a magical fairy tale with our enchanting princess-themed decorations.',
                'price' => 15000,
                'discount_type' => 'fixed',
                'discount_value' => 3000,
                'duration' => 6 * 60 * 60 * 1000, // 6 hours in milliseconds
                'is_active' => true,
                'is_special' => true,
                'category_id' => $birthdayCategory->id,
                'images' => [
                    'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Superhero Birthday Bash',
                'description' => 'Let your little hero save the day with our action-packed superhero birthday celebration.',
                'price' => 14000,
                'discount_type' => 'fixed',
                'discount_value' => 2500,
                'duration' => 6 * 60 * 60 * 1000, // 6 hours in milliseconds
                'is_active' => true,
                'is_special' => false,
                'category_id' => $birthdayCategory->id,
                'images' => [
                    'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Teenage Glow Party',
                'description' => 'Light up the night with our trendy glow-in-the-dark teenage birthday party setup.',
                'price' => 18000,
                'discount_type' => 'fixed',
                'discount_value' => 3000,
                'duration' => 8 * 60 * 60 * 1000, // 8 hours in milliseconds
                'is_active' => true,
                'is_special' => true,
                'category_id' => $birthdayCategory->id,
                'images' => [
                    'https://images.unsplash.com/photo-1549451371-64aa98a6f660?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Elegant Adult Birthday',
                'description' => 'Celebrate another year of life with sophisticated and elegant birthday decorations.',
                'price' => 25000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'duration' => 8 * 60 * 60 * 1000, // 8 hours in milliseconds
                'is_active' => true,
                'is_special' => false,
                'category_id' => $birthdayCategory->id,
                'images' => [
                    'https://images.unsplash.com/photo-1527529482837-4698179dc6ce?w=800&h=600&fit=crop'
                ]
            ],

            // Anniversary Packages
            [
                'name' => 'First Anniversary Romance',
                'description' => 'Celebrate your first year of marriage with romantic candlelit decorations and rose petals.',
                'price' => 20000,
                'discount_type' => 'fixed',
                'discount_value' => 4000,
                'duration' => 4 * 60 * 60 * 1000, // 4 hours in milliseconds
                'is_active' => true,
                'is_special' => true,
                'category_id' => $anniversaryCategory->id,
                'images' => [
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Silver Jubilee Celebration',
                'description' => 'Honor 25 years of togetherness with elegant silver-themed decorations and memories.',
                'price' => 35000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'duration' => 6 * 60 * 60 * 1000, // 6 hours in milliseconds
                'is_active' => true,
                'is_special' => true,
                'category_id' => $anniversaryCategory->id,
                'images' => [
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Golden Anniversary Grandeur',
                'description' => 'Celebrate 50 years of love with luxurious golden decorations and family gatherings.',
                'price' => 50000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'duration' => 8 * 60 * 60 * 1000, // 8 hours in milliseconds
                'is_active' => true,
                'is_special' => true,
                'category_id' => $anniversaryCategory->id,
                'images' => [
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop'
                ]
            ],

            // Festival Packages
            [
                'name' => 'Diwali Festival Celebration',
                'description' => 'Light up your home with traditional Diwali decorations, diyas, and rangoli.',
                'price' => 12000,
                'discount_type' => 'fixed',
                'discount_value' => 2000,
                'duration' => 4 * 60 * 60 * 1000, // 4 hours in milliseconds
                'is_active' => true,
                'is_special' => false,
                'category_id' => $festivalCategory->id,
                'images' => [
                    'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop'
                ]
            ],

            // 1st Birthday Special
            [
                'name' => 'Baby Girl First Birthday',
                'description' => 'Celebrate your baby girl\'s milestone first birthday with pastel colors and cute decorations.',
                'price' => 10000,
                'discount_type' => 'fixed',
                'discount_value' => 2000,
                'duration' => 4 * 60 * 60 * 1000, // 4 hours in milliseconds
                'is_active' => true,
                'is_special' => true,
                'category_id' => $firstBirthdayCategory->id,
                'images' => [
                    'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Baby Boy First Birthday',
                'description' => 'Celebrate your baby boy\'s first birthday with playful and colorful decorations.',
                'price' => 10000,
                'discount_type' => 'fixed',
                'discount_value' => 2000,
                'duration' => 4 * 60 * 60 * 1000, // 4 hours in milliseconds
                'is_active' => true,
                'is_special' => true,
                'category_id' => $firstBirthdayCategory->id,
                'images' => [
                    'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&h=600&fit=crop'
                ]
            ],

            // Haldi & Mehndi
            [
                'name' => 'Traditional Haldi Ceremony',
                'description' => 'Create a vibrant yellow-themed setup for your traditional haldi ceremony.',
                'price' => 22000,
                'discount_type' => 'fixed',
                'discount_value' => 4000,
                'duration' => 6 * 60 * 60 * 1000, // 6 hours in milliseconds
                'is_active' => true,
                'is_special' => false,
                'category_id' => $haldiMehndiCategory->id,
                'images' => [
                    'https://images.unsplash.com/photo-1606800052052-a08af7148866?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Mehndi Night Celebration',
                'description' => 'Beautiful green and orange themed decorations for your mehndi night festivities.',
                'price' => 25000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'duration' => 8 * 60 * 60 * 1000, // 8 hours in milliseconds
                'is_active' => true,
                'is_special' => true,
                'category_id' => $haldiMehndiCategory->id,
                'images' => [
                    'https://images.unsplash.com/photo-1606800052052-a08af7148866?w=800&h=600&fit=crop'
                ]
            ],

            // Premium Decoration
            [
                'name' => 'Luxury Wedding Decoration',
                'description' => 'Opulent and grand wedding decorations with premium flowers and lighting.',
                'price' => 100000,
                'discount_type' => 'fixed',
                'discount_value' => 15000,
                'duration' => 12 * 60 * 60 * 1000, // 12 hours in milliseconds
                'is_active' => true,
                'is_special' => true,
                'category_id' => $premiumCategory->id,
                'images' => [
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop'
                ]
            ],

            // Flower Bouquet
            [
                'name' => 'Rose Bouquet Arrangement',
                'description' => 'Beautiful red rose bouquets perfect for romantic occasions and proposals.',
                'price' => 3000,
                'discount_type' => 'fixed',
                'discount_value' => 500,
                'duration' => 1 * 60 * 60 * 1000, // 1 hour in milliseconds
                'is_active' => true,
                'is_special' => false,
                'category_id' => $flowerCategory->id,
                'images' => [
                    'https://images.unsplash.com/photo-1455659817273-f96807779a8a?w=800&h=600&fit=crop'
                ]
            ],

            // Gift Section
            [
                'name' => 'Surprise Gift Box',
                'description' => 'Curated gift boxes with personalized items for special occasions.',
                'price' => 5000,
                'discount_type' => 'fixed',
                'discount_value' => 1000,
                'duration' => 1 * 60 * 60 * 1000, // 1 hour in milliseconds
                'is_active' => true,
                'is_special' => false,
                'category_id' => $giftCategory->id,
                'images' => [
                    'https://images.unsplash.com/photo-1549465220-1a8b9238cd48?w=800&h=600&fit=crop'
                ]
            ],

            // Simple Decoration
            [
                'name' => 'Minimalist Birthday Setup',
                'description' => 'Clean and elegant minimalist decoration for intimate birthday celebrations.',
                'price' => 8000,
                'discount_type' => 'fixed',
                'discount_value' => 1500,
                'duration' => 3 * 60 * 60 * 1000, // 3 hours in milliseconds
                'is_active' => true,
                'is_special' => false,
                'category_id' => $simpleCategory->id,
                'images' => [
                    'https://images.unsplash.com/photo-1527529482837-4698179dc6ce?w=800&h=600&fit=crop'
                ]
            ],

            // Ring Decoration
            [
                'name' => 'Ring Ceremony Decoration',
                'description' => 'Elegant ring ceremony setup with floral arrangements and traditional elements.',
                'price' => 30000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'duration' => 6 * 60 * 60 * 1000, // 6 hours in milliseconds
                'is_active' => true,
                'is_special' => false,
                'category_id' => $ringCategory->id,
                'images' => [
                    'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?w=800&h=600&fit=crop'
                ]
            ],

            // Welcome Baby
            [
                'name' => 'Welcome Baby Home Setup',
                'description' => 'Adorable decorations to welcome your newborn baby home.',
                'price' => 7000,
                'discount_type' => 'fixed',
                'discount_value' => 1500,
                'duration' => 2 * 60 * 60 * 1000, // 2 hours in milliseconds
                'is_active' => true,
                'is_special' => false,
                'category_id' => $welcomeBabyCategory->id,
                'images' => [
                    'https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?w=800&h=600&fit=crop'
                ]
            ],

            // Baby Shower
            [
                'name' => 'Baby Shower Celebration',
                'description' => 'Beautiful baby shower decorations with balloons, banners, and cute props.',
                'price' => 12000,
                'discount_type' => 'fixed',
                'discount_value' => 2000,
                'duration' => 4 * 60 * 60 * 1000, // 4 hours in milliseconds
                'is_active' => true,
                'is_special' => false,
                'category_id' => $babyShowerCategory->id,
                'images' => [
                    'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop'
                ]
            ],

            // Love Theme
            [
                'name' => 'Romantic Date Night Setup',
                'description' => 'Intimate romantic setup with candles, flowers, and mood lighting for couples.',
                'price' => 8000,
                'discount_type' => 'fixed',
                'discount_value' => 1500,
                'duration' => 3 * 60 * 60 * 1000, // 3 hours in milliseconds
                'is_active' => true,
                'is_special' => true,
                'category_id' => $loveThemeCategory->id,
                'images' => [
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],

            // Bride to Be
            [
                'name' => 'Bride to Be Party',
                'description' => 'Celebrate the bride-to-be with elegant and fun decorations for her special day.',
                'price' => 15000,
                'discount_type' => 'fixed',
                'discount_value' => 2500,
                'duration' => 6 * 60 * 60 * 1000, // 6 hours in milliseconds
                'is_active' => true,
                'is_special' => true,
                'category_id' => $brideToBeCategory->id,
                'images' => [
                    'https://images.unsplash.com/photo-1594736797933-d0d3482ba3a8?w=800&h=600&fit=crop'
                ]
            ]
        ];

        foreach ($packages as $packageData) {
            $images = $packageData['images'];
            unset($packageData['images']);

            $package = EventPackage::create($packageData);

            // Create package images
            foreach ($images as $imageUrl) {
                EventPackageImage::create([
                    'event_package_id' => $package->id,
                    'image_url' => $imageUrl
                ]);
            }
        }
    }
}
