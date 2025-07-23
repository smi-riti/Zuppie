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
        // Get categories
        $birthdayCategory = Category::where('slug', 'birthday')->first();
        $girlBirthdayCategory = Category::where('slug', 'girl-birthday')->first();
        $boyBirthdayCategory = Category::where('slug', 'boy-birthday')->first();
        $teenageBirthdayCategory = Category::where('slug', 'teenage-birthday')->first();
        $adultBirthdayCategory = Category::where('slug', 'adult-birthday')->first();
        $anniversaryCategory = Category::where('slug', 'wedding-anniversary')->first();
        $firstAnniversaryCategory = Category::where('slug', '1st-anniversary')->first();
        $silverAnniversaryCategory = Category::where('slug', '25th-anniversary')->first();
        $goldenAnniversaryCategory = Category::where('slug', '50th-anniversary')->first();
        $festivalCategory = Category::where('slug', 'festival')->first();
        $firstBirthdayCategory = Category::where('slug', '1st-birthday')->first();
        $firstBirthdayGirlCategory = Category::where('slug', '1st-birthday-girl')->first();
        $firstBirthdayBoyCategory = Category::where('slug', '1st-birthday-boy')->first();
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
            // Birthday Category
            [
                'name' => 'Princess Birthday Extravaganza',
                'description' => 'A magical fairy-tale setup with pink and gold decorations for your little princess.',
                'price' => 15000,
                'discount_type' => 'fixed',
                'discount_value' => 3000,
                'duration' => 6 * 60 * 60 * 1000, // 6 hours
                'is_active' => true,
                'is_special' => true,
                'category_id' => $birthdayCategory->id,
                'features' => 'Balloons, Cake Table, Fairy Lights, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Superhero Adventure Party',
                'description' => 'An action-packed superhero-themed celebration with vibrant decorations.',
                'price' => 14000,
                'discount_type' => 'fixed',
                'discount_value' => 2500,
                'duration' => 6 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $birthdayCategory->id,
                'features' => 'Superhero Props, Balloons, Backdrop, Party Favors',
                'images' => [
                    'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1503453362798-6e858b3a1638?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1544027993-7ad6d309ef80?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1581235720704-06d1012a8b73?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Jungle Safari Birthday',
                'description' => 'Explore the wild with a jungle-themed birthday party full of adventure.',
                'price' => 16000,
                'discount_type' => 'fixed',
                'discount_value' => 3000,
                'duration' => 6 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $birthdayCategory->id,
                'features' => 'Animal Props, Balloons, Jungle Backdrop, Face Painting',
                'images' => [
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1503453362798-6e858b3a1638?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1544027993-7ad6d309ef80?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1581235720704-06d1012a8b73?w=800&h=600&fit=crop'
                ]
            ],

            // Girl Birthday Category
            [
                'name' => 'Unicorn Dream Party',
                'description' => 'A whimsical unicorn-themed party with pastel colors and sparkles.',
                'price' => 13000,
                'discount_type' => 'fixed',
                'discount_value' => 2000,
                'duration' => 5 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $girlBirthdayCategory->id,
                'features' => 'Unicorn Props, Balloons, Glitter Backdrop, Candy Bar',
                'images' => [
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Fairy Garden Celebration',
                'description' => 'A magical fairy garden setup with flowers and twinkling lights.',
                'price' => 14000,
                'discount_type' => 'fixed',
                'discount_value' => 2500,
                'duration' => 5 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $girlBirthdayCategory->id,
                'features' => 'Floral Decor, Fairy Lights, Cake Table, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Mermaid Splash Party',
                'description' => 'Dive into an underwater adventure with mermaid-themed decorations.',
                'price' => 15000,
                'discount_type' => 'fixed',
                'discount_value' => 3000,
                'duration' => 5 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $girlBirthdayCategory->id,
                'features' => 'Mermaid Props, Balloons, Undersea Backdrop, Shell Decor',
                'images' => [
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800&h=600&fit=crop'
                ]
            ],

            // Boy Birthday Category
            [
                'name' => 'Dinosaur Roar Party',
                'description' => 'A prehistoric adventure with dinosaur-themed decorations and props.',
                'price' => 14000,
                'discount_type' => 'fixed',
                'discount_value' => 2500,
                'duration' => 5 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $boyBirthdayCategory->id,
                'features' => 'Dinosaur Props, Balloons, Fossil Backdrop, Activity Zone',
                'images' => [
                    'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1503453362798-6e858b3a1638?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1544027993-7ad6d309ef80?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1581235720704-06d1012a8b73?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Space Explorer Bash',
                'description' => 'Blast off into a space-themed party with planets and stars.',
                'price' => 15000,
                'discount_type' => 'fixed',
                'discount_value' => 3000,
                'duration' => 5 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $boyBirthdayCategory->id,
                'features' => 'Planet Props, Star Lights, Rocket Backdrop, Glow Sticks',
                'images' => [
                    'https://images.unsplash.com/photo-1544027993-7ad6d309ef80?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1503453362798-6e858b3a1638?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1581235720704-06d1012a8b73?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Pirate Treasure Hunt',
                'description' => 'Set sail for a pirate-themed birthday with treasure chests and maps.',
                'price' => 13000,
                'discount_type' => 'fixed',
                'discount_value' => 2000,
                'duration' => 5 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $boyBirthdayCategory->id,
                'features' => 'Pirate Props, Treasure Chest, Map Backdrop, Eye Patches',
                'images' => [
                    'https://images.unsplash.com/photo-1581235720704-06d1012a8b73?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1503453362798-6e858b3a1638?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1544027993-7ad6d309ef80?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&h=600&fit=crop'
                ]
            ],

            // Teenage Birthday Category
            [
                'name' => 'Glow Party Extravaganza',
                'description' => 'A trendy glow-in-the-dark party with neon lights and music.',
                'price' => 18000,
                'discount_type' => 'fixed',
                'discount_value' => 3000,
                'duration' => 8 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $teenageBirthdayCategory->id,
                'features' => 'Neon Lights, Glow Sticks, DJ Booth, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1549451371-64aa98a6f660?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Retro Arcade Party',
                'description' => 'A nostalgic arcade-themed party with retro games and decorations.',
                'price' => 17000,
                'discount_type' => 'fixed',
                'discount_value' => 2500,
                'duration' => 8 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $teenageBirthdayCategory->id,
                'features' => 'Arcade Games, Retro Decor, Snack Bar, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1549451371-64aa98a6f660?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1503453362798-6e858b3a1638?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1544027993-7ad6d309ef80?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1581235720704-06d1012a8b73?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Music Festival Vibes',
                'description' => 'A vibrant music festival-themed party with colorful decorations.',
                'price' => 19000,
                'discount_type' => 'fixed',
                'discount_value' => 3500,
                'duration' => 8 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $teenageBirthdayCategory->id,
                'features' => 'Stage Setup, Colorful Lights, Music System, Dance Floor',
                'images' => [
                    'https://images.unsplash.com/photo-1549451371-64aa98a6f660?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],

            // Adult Birthday Category
            [
                'name' => 'Elegant Milestone Celebration',
                'description' => 'Sophisticated decorations for a memorable adult birthday milestone.',
                'price' => 25000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'duration' => 8 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $adultBirthdayCategory->id,
                'features' => 'Elegant Decor, Floral Arrangements, Lighting, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1527529482837-4698179dc6ce?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Vintage Wine & Dine',
                'description' => 'A classy wine-themed adult birthday with elegant decor.',
                'price' => 24000,
                'discount_type' => 'fixed',
                'discount_value' => 4500,
                'duration' => 8 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $adultBirthdayCategory->id,
                'features' => 'Wine Bar, Vintage Decor, Candlelight, Dining Setup',
                'images' => [
                    'https://images.unsplash.com/photo-1527529482837-4698179dc6ce?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Golden Glam Party',
                'description' => 'A luxurious gold-themed adult birthday celebration.',
                'price' => 26000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'duration' => 8 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $adultBirthdayCategory->id,
                'features' => 'Gold Decor, Balloons, Premium Lighting, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1527529482837-4698179dc6ce?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],

            // Wedding Anniversary Category
            [
                'name' => 'Romantic Anniversary Night',
                'description' => 'A romantic evening setup with candles and rose petals.',
                'price' => 20000,
                'discount_type' => 'fixed',
                'discount_value' => 4000,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $anniversaryCategory->id,
                'features' => 'Candles, Rose Petals, Romantic Lighting, Floral Decor',
                'images' => [
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Classic Anniversary Gala',
                'description' => 'An elegant anniversary celebration with timeless decorations.',
                'price' => 22000,
                'discount_type' => 'fixed',
                'discount_value' => 4000,
                'duration' => 6 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $anniversaryCategory->id,
                'features' => 'Elegant Decor, Floral Arrangements, Lighting, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Love Eternal Package',
                'description' => 'A grand celebration of enduring love with luxurious decor.',
                'price' => 25000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'duration' => 6 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $anniversaryCategory->id,
                'features' => 'Luxury Decor, Floral Arches, Candles, Premium Lighting',
                'images' => [
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],

            // 1st Anniversary Category
            [
                'name' => 'First Year Bliss Package',
                'description' => 'Celebrate your first year with romantic and intimate decorations.',
                'price' => 20000,
                'discount_type' => 'fixed',
                'discount_value' => 4000,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $firstAnniversaryCategory->id,
                'features' => 'Candles, Rose Petals, Intimate Lighting, Floral Decor',
                'images' => [
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Newlywed Romance Setup',
                'description' => 'A cozy setup for your first anniversary with candles and flowers.',
                'price' => 18000,
                'discount_type' => 'fixed',
                'discount_value' => 3500,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $firstAnniversaryCategory->id,
                'features' => 'Candles, Flowers, Cozy Lighting, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'First Love Celebration',
                'description' => 'A heartfelt setup to celebrate your first year of marriage.',
                'price' => 19000,
                'discount_type' => 'fixed',
                'discount_value' => 3500,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $firstAnniversaryCategory->id,
                'features' => 'Floral Decor, Candles, Romantic Lighting, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],

            // 25th Anniversary Category
            [
                'name' => 'Silver Jubilee Elegance',
                'description' => 'Celebrate 25 years with elegant silver-themed decorations.',
                'price' => 35000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'duration' => 6 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $silverAnniversaryCategory->id,
                'features' => 'Silver Decor, Floral Arrangements, Lighting, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Silver Memories Package',
                'description' => 'A nostalgic silver anniversary setup with classic decor.',
                'price' => 34000,
                'discount_type' => 'fixed',
                'discount_value' => 4500,
                'duration' => 6 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $silverAnniversaryCategory->id,
                'features' => 'Silver Props, Classic Decor, Candles, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Silver Sparkle Celebration',
                'description' => 'A dazzling silver-themed party for your 25th anniversary.',
                'price' => 36000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'duration' => 6 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $silverAnniversaryCategory->id,
                'features' => 'Silver Decor, Sparkle Lights, Floral Arches, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],

            // 50th Anniversary Category
            [
                'name' => 'Golden Anniversary Grandeur',
                'description' => 'Celebrate 50 years with luxurious golden decorations.',
                'price' => 50000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'duration' => 8 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $goldenAnniversaryCategory->id,
                'features' => 'Golden Decor, Floral Arrangements, Premium Lighting, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Golden Legacy Celebration',
                'description' => 'A grand setup to honor 50 years of love and commitment.',
                'price' => 48000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'duration' => 8 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $goldenAnniversaryCategory->id,
                'features' => 'Golden Props, Elegant Decor, Candles, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Golden Eternity Package',
                'description' => 'A majestic golden anniversary setup with elegant decor.',
                'price' => 52000,
                'discount_type' => 'fixed',
                'discount_value' => 6000,
                'duration' => 8 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $goldenAnniversaryCategory->id,
                'features' => 'Golden Decor, Floral Arches, Premium Lighting, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],

            // Festival Category
            [
                'name' => 'Diwali Glow Celebration',
                'description' => 'Light up your home with traditional Diwali decorations and diyas.',
                'price' => 12000,
                'discount_type' => 'fixed',
                'discount_value' => 2000,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $festivalCategory->id,
                'features' => 'Diyas, Rangoli, Fairy Lights, Floral Decor',
                'images' => [
                    'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1605550113667-3a4a7e3b3b3a?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1607292366048-0d1f2b1584e0?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1605550113667-3a4a7e3b3b3a?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Holi Color Festival',
                'description' => 'A vibrant setup for Holi with colorful decorations and rangoli.',
                'price' => 13000,
                'discount_type' => 'fixed',
                'discount_value' => 2500,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $festivalCategory->id,
                'features' => 'Colorful Decor, Rangoli, Balloons, Water Guns',
                'images' => [
                    'https://images.unsplash.com/photo-1605550113667-3a4a7e3b3b3a?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1607292366048-0d1f2b1584e0?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Eid Celebration Package',
                'description' => 'A festive Eid setup with traditional decor and lights.',
                'price' => 14000,
                'discount_type' => 'fixed',
                'discount_value' => 2500,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $festivalCategory->id,
                'features' => 'Traditional Decor, Lanterns, Fairy Lights, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1607292366048-0d1f2b1584e0?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1605550113667-3a4a7e3b3b3a?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop'
                ]
            ],

            // 1st Birthday Category
            [
                'name' => 'First Birthday Fiesta',
                'description' => 'A colorful setup for your baby’s first milestone celebration.',
                'price' => 10000,
                'discount_type' => 'fixed',
                'discount_value' => 2000,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $firstBirthdayCategory->id,
                'features' => 'Balloons, Cake Table, Banners, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Tiny Star Celebration',
                'description' => 'A starry-themed first birthday with cute decorations.',
                'price' => 11000,
                'discount_type' => 'fixed',
                'discount_value' => 2000,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $firstBirthdayCategory->id,
                'features' => 'Star Props, Balloons, Fairy Lights, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Little Explorer Party',
                'description' => 'An adventurous first birthday with playful decorations.',
                'price' => 12000,
                'discount_type' => 'fixed',
                'discount_value' => 2500,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $firstBirthdayCategory->id,
                'features' => 'Adventure Props, Balloons, Backdrop, Activity Zone',
                'images' => [
                    'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],

            // 1st Birthday Girl Category
            [
                'name' => 'Baby Girl Princess Party',
                'description' => 'A pink and gold setup for your baby girl’s first birthday.',
                'price' => 10000,
                'discount_type' => 'fixed',
                'discount_value' => 2000,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $firstBirthdayGirlCategory->id,
                'features' => 'Pink Balloons, Gold Decor, Cake Table, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Little Fairy First Birthday',
                'description' => 'A magical fairy-themed first birthday for your little girl.',
                'price' => 11000,
                'discount_type' => 'fixed',
                'discount_value' => 2000,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $firstBirthdayGirlCategory->id,
                'features' => 'Fairy Props, Balloons, Floral Decor, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Pink Balloon Bash',
                'description' => 'A vibrant pink-themed first birthday celebration.',
                'price' => 12000,
                'discount_type' => 'fixed',
                'discount_value' => 2500,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $firstBirthdayGirlCategory->id,
                'features' => 'Pink Balloons, Banners, Cake Table, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],

            // 1st Birthday Boy Category
            [
                'name' => 'Baby Boy Adventure Party',
                'description' => 'A playful setup for your baby boy’s first birthday.',
                'price' => 10000,
                'discount_type' => 'fixed',
                'discount_value' => 2000,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $firstBirthdayBoyCategory->id,
                'features' => 'Adventure Props, Blue Balloons, Cake Table, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1503453362798-6e858b3a1638?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1544027993-7ad6d309ef80?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1581235720704-06d1012a8b73?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Little Sailor Celebration',
                'description' => 'A nautical-themed first birthday for your baby boy.',
                'price' => 11000,
                'discount_type' => 'fixed',
                'discount_value' => 2000,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $firstBirthdayBoyCategory->id,
                'features' => 'Nautical Props, Balloons, Anchor Decor, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1503453362798-6e858b3a1638?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1544027993-7ad6d309ef80?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1581235720704-06d1012a8b73?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Blue Balloon Bash',
                'description' => 'A vibrant blue-themed first birthday celebration.',
                'price' => 12000,
                'discount_type' => 'fixed',
                'discount_value' => 2500,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $firstBirthdayBoyCategory->id,
                'features' => 'Blue Balloons, Banners, Cake Table, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1503453362798-6e858b3a1638?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1544027993-7ad6d309ef80?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1581235720704-06d1012a8b73?w=800&h=600&fit=crop'
                ]
            ],

            // Haldi Mehndi Category
            [
                'name' => 'Vibrant Haldi Ceremony',
                'description' => 'A bright yellow-themed setup for a traditional haldi ceremony.',
                'price' => 22000,
                'discount_type' => 'fixed',
                'discount_value' => 4000,
                'duration' => 6 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $haldiMehndiCategory->id,
                'features' => 'Yellow Decor, Floral Arrangements, Traditional Props, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1606800052052-a08af7148866?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1605550113667-3a4a7e3b3b3a?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1607292366048-0d1f2b1584e0?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Mehndi Night Extravaganza',
                'description' => 'A green and orange-themed setup for a festive mehndi night.',
                'price' => 25000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'duration' => 8 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $haldiMehndiCategory->id,
                'features' => 'Green Decor, Orange Accents, Mehndi Station, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1606800052052-a08af7148866?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1605550113667-3a4a7e3b3b3a?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1607292366048-0d1f2b1584e0?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Floral Haldi Mehndi Combo',
                'description' => 'A floral-themed setup for haldi and mehndi celebrations.',
                'price' => 24000,
                'discount_type' => 'fixed',
                'discount_value' => 4500,
                'duration' => 6 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $haldiMehndiCategory->id,
                'features' => 'Floral Decor, Traditional Props, Lighting, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1606800052052-a08af7148866?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1605550113667-3a4a7e3b3b3a?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1607292366048-0d1f2b1584e0?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop'
                ]
            ],

            // Premium Decoration Category
            [
                'name' => 'Luxury Wedding Extravaganza',
                'description' => 'Opulent wedding decorations with premium flowers and lighting.',
                'price' => 100000,
                'discount_type' => 'fixed',
                'discount_value' => 15000,
                'duration' => 12 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $premiumCategory->id,
                'features' => 'Premium Flowers, Chandeliers, Drapes, Stage Setup',
                'images' => [
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Grand Gala Decoration',
                'description' => 'A majestic setup for high-end events with luxurious decor.',
                'price' => 95000,
                'discount_type' => 'fixed',
                'discount_value' => 14000,
                'duration' => 12 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $premiumCategory->id,
                'features' => 'Luxury Decor, Floral Arches, Premium Lighting, Stage Setup',
                'images' => [
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Elite Event Package',
                'description' => 'A premium event setup with sophisticated and elegant decor.',
                'price' => 110000,
                'discount_type' => 'fixed',
                'discount_value' => 16000,
                'duration' => 12 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $premiumCategory->id,
                'features' => 'Elegant Decor, Chandeliers, Floral Arches, Premium Lighting',
                'images' => [
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],

            // Flower Bouquet Category
            [
                'name' => 'Red Rose Romance',
                'description' => 'A stunning red rose bouquet for romantic occasions.',
                'price' => 3000,
                'discount_type' => 'fixed',
                'discount_value' => 500,
                'duration' => 1 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $flowerCategory->id,
                'features' => 'Red Roses, Greenery, Ribbon, Gift Wrapping',
                'images' => [
                    'https://images.unsplash.com/photo-1455659817273-f96807779a8a?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Sunflower Delight',
                'description' => 'A cheerful sunflower bouquet to brighten any occasion.',
                'price' => 3500,
                'discount_type' => 'fixed',
                'discount_value' => 600,
                'duration' => 1 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $flowerCategory->id,
                'features' => 'Sunflowers, Greenery, Ribbon, Gift Wrapping',
                'images' => [
                    'https://images.unsplash.com/photo-1455659817273-f96807779a8a?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Mixed Floral Bouquet',
                'description' => 'A vibrant mix of flowers for a special touch.',
                'price' => 3200,
                'discount_type' => 'fixed',
                'discount_value' => 500,
                'duration' => 1 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $flowerCategory->id,
                'features' => 'Mixed Flowers, Greenery, Ribbon, Gift Wrapping',
                'images' => [
                    'https://images.unsplash.com/photo-1455659817273-f96807779a8a?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],

            // Gift Section Category
            [
                'name' => 'Surprise Gift Hamper',
                'description' => 'A curated gift box with personalized items for special occasions.',
                'price' => 5000,
                'discount_type' => 'fixed',
                'discount_value' => 1000,
                'duration' => 1 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $giftCategory->id,
                'features' => 'Chocolates, Personalized Items, Gift Box, Ribbon',
                'images' => [
                    'https://images.unsplash.com/photo-1549465220-1a8b9238cd48?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Luxury Gift Basket',
                'description' => 'A premium gift basket with high-end items for gifting.',
                'price' => 6000,
                'discount_type' => 'fixed',
                'discount_value' => 1200,
                'duration' => 1 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $giftCategory->id,
                'features' => 'Premium Chocolates, Wine, Gift Basket, Ribbon',
                'images' => [
                    'https://images.unsplash.com/photo-1549465220-1a8b9238cd48?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Personalized Gift Box',
                'description' => 'A customized gift box tailored for your loved ones.',
                'price' => 5500,
                'discount_type' => 'fixed',
                'discount_value' => 1000,
                'duration' => 1 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $giftCategory->id,
                'features' => 'Custom Items, Chocolates, Gift Box, Ribbon',
                'images' => [
                    'https://images.unsplash.com/photo-1549465220-1a8b9238cd48?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],

            // Simple Decoration Category
            [
                'name' => 'Minimalist Birthday Setup',
                'description' => 'A clean and elegant setup for intimate birthday celebrations.',
                'price' => 8000,
                'discount_type' => 'fixed',
                'discount_value' => 1500,
                'duration' => 3 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $simpleCategory->id,
                'features' => 'Balloons, Simple Decor, Cake Table, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1527529482837-4698179dc6ce?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Simple Anniversary Decor',
                'description' => 'A minimalist setup for a cozy anniversary celebration.',
                'price' => 8500,
                'discount_type' => 'fixed',
                'discount_value' => 1500,
                'duration' => 3 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $simpleCategory->id,
                'features' => 'Candles, Floral Decor, Simple Lighting, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1527529482837-4698179dc6ce?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Basic Party Setup',
                'description' => 'A simple yet elegant setup for small gatherings.',
                'price' => 7000,
                'discount_type' => 'fixed',
                'discount_value' => 1000,
                'duration' => 3 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $simpleCategory->id,
                'features' => 'Balloons, Simple Decor, Cake Table, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1527529482837-4698179dc6ce?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],

            // Ring Decoration Category
            [
                'name' => 'Elegant Ring Ceremony',
                'description' => 'A floral and traditional setup for your ring ceremony.',
                'price' => 30000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'duration' => 6 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $ringCategory->id,
                'features' => 'Floral Arches, Traditional Decor, Lighting, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Romantic Engagement Setup',
                'description' => 'A romantic setup for your engagement with floral arches.',
                'price' => 32000,
                'discount_type' => 'fixed',
                'discount_value' => 5500,
                'duration' => 6 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $ringCategory->id,
                'features' => 'Floral Arches, Romantic Lighting, Candles, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Classic Ring Exchange',
                'description' => 'A traditional setup for a memorable ring ceremony.',
                'price' => 31000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'duration' => 6 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $ringCategory->id,
                'features' => 'Traditional Decor, Floral Arches, Lighting, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],

            // Welcome Baby Category
            [
                'name' => 'Welcome Baby Home',
                'description' => 'A cute setup to welcome your newborn home.',
                'price' => 7000,
                'discount_type' => 'fixed',
                'discount_value' => 1500,
                'duration' => 2 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $welcomeBabyCategory->id,
                'features' => 'Balloons, Banners, Baby Props, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Vintage Wine & Dine',
                'description' => 'A classy wine-themed adult birthday with elegant decor.',
                'price' => 24000,
                'discount_type' => 'fixed',
                'discount_value' => 4500,
                'duration' => 8 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $adultBirthdayCategory->id,
                'features' => 'Wine Bar, Vintage Decor, Candlelight, Dining Setup',
                'images' => [
                    'https://images.unsplash.com/photo-1527529482837-4698179dc6ce?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Golden Glam Party',
                'description' => 'A luxurious gold-themed adult birthday celebration.',
                'price' => 26000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'duration' => 8 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $adultBirthdayCategory->id,
                'features' => 'Gold Decor, Balloons, Premium Lighting, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1527529482837-4698179dc6ce?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],

            // Wedding Anniversary Category
            [
                'name' => 'Romantic Anniversary Night',
                'description' => 'A romantic evening setup with candles and rose petals.',
                'price' => 20000,
                'discount_type' => 'fixed',
                'discount_value' => 4000,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $anniversaryCategory->id,
                'features' => 'Candles, Rose Petals, Romantic Lighting, Floral Decor',
                'images' => [
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Classic Anniversary Gala',
                'description' => 'An elegant anniversary celebration with timeless decorations.',
                'price' => 22000,
                'discount_type' => 'fixed',
                'discount_value' => 4000,
                'duration' => 6 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $anniversaryCategory->id,
                'features' => 'Elegant Decor, Floral Arrangements, Lighting, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Love Eternal Package',
                'description' => 'A grand celebration of enduring love with luxurious decor.',
                'price' => 25000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'duration' => 6 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $anniversaryCategory->id,
                'features' => 'Luxury Decor, Floral Arches, Candles, Premium Lighting',
                'images' => [
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],

            // 1st Anniversary Category
            [
                'name' => 'First Year Bliss Package',
                'description' => 'Celebrate your first year with romantic and intimate decorations.',
                'price' => 20000,
                'discount_type' => 'fixed',
                'discount_value' => 4000,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $firstAnniversaryCategory->id,
                'features' => 'Candles, Rose Petals, Intimate Lighting, Floral Decor',
                'images' => [
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Newlywed Romance Setup',
                'description' => 'A cozy setup for your first anniversary with candles and flowers.',
                'price' => 18000,
                'discount_type' => 'fixed',
                'discount_value' => 3500,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $firstAnniversaryCategory->id,
                'features' => 'Candles, Flowers, Cozy Lighting, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'First Love Celebration',
                'description' => 'A heartfelt setup to celebrate your first year of marriage.',
                'price' => 19000,
                'discount_type' => 'fixed',
                'discount_value' => 3500,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $firstAnniversaryCategory->id,
                'features' => 'Floral Decor, Candles, Romantic Lighting, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],

            // 25th Anniversary Category
            [
                'name' => 'Silver Jubilee Elegance',
                'description' => 'Celebrate 25 years with elegant silver-themed decorations.',
                'price' => 35000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'duration' => 6 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $silverAnniversaryCategory->id,
                'features' => 'Silver Decor, Floral Arrangements, Lighting, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Silver Memories Package',
                'description' => 'A nostalgic silver anniversary setup with classic decor.',
                'price' => 34000,
                'discount_type' => 'fixed',
                'discount_value' => 4500,
                'duration' => 6 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $silverAnniversaryCategory->id,
                'features' => 'Silver Props, Classic Decor, Candles, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Silver Sparkle Celebration',
                'description' => 'A dazzling silver-themed party for your 25th anniversary.',
                'price' => 36000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'duration' => 6 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $silverAnniversaryCategory->id,
                'features' => 'Silver Decor, Sparkle Lights, Floral Arches, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],

            // 50th Anniversary Category
            [
                'name' => 'Golden Anniversary Grandeur',
                'description' => 'Celebrate 50 years with luxurious golden decorations.',
                'price' => 50000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'duration' => 8 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $goldenAnniversaryCategory->id,
                'features' => 'Golden Decor, Floral Arrangements, Premium Lighting, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Golden Legacy Celebration',
                'description' => 'A grand setup to honor 50 years of love and commitment.',
                'price' => 48000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'duration' => 8 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $goldenAnniversaryCategory->id,
                'features' => 'Golden Props, Elegant Decor, Candles, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Golden Eternity Package',
                'description' => 'A majestic golden anniversary setup with elegant decor.',
                'price' => 52000,
                'discount_type' => 'fixed',
                'discount_value' => 6000,
                'duration' => 8 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $goldenAnniversaryCategory->id,
                'features' => 'Golden Decor, Floral Arches, Premium Lighting, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],

            // Festival Category
            [
                'name' => 'Diwali Glow Celebration',
                'description' => 'Light up your home with traditional Diwali decorations and diyas.',
                'price' => 12000,
                'discount_type' => 'fixed',
                'discount_value' => 2000,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $festivalCategory->id,
                'features' => 'Diyas, Rangoli, Fairy Lights, Floral Decor',
                'images' => [
                    'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1605550113667-3a4a7e3b3b3a?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1607292366048-0d1f2b1584e0?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1605550113667-3a4a7e3b3b3a?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Holi Color Festival',
                'description' => 'A vibrant setup for Holi with colorful decorations and rangoli.',
                'price' => 13000,
                'discount_type' => 'fixed',
                'discount_value' => 2500,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $festivalCategory->id,
                'features' => 'Colorful Decor, Rangoli, Balloons, Water Guns',
                'images' => [
                    'https://images.unsplash.com/photo-1605550113667-3a4a7e3b3b3a?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1607292366048-0d1f2b1584e0?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Eid Celebration Package',
                'description' => 'A festive Eid setup with traditional decor and lights.',
                'price' => 14000,
                'discount_type' => 'fixed',
                'discount_value' => 2500,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $festivalCategory->id,
                'features' => 'Traditional Decor, Lanterns, Fairy Lights, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1607292366048-0d1f2b1584e0?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1605550113667-3a4a7e3b3b3a?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop'
                ]
            ],

            // 1st Birthday Category
            [
                'name' => 'First Birthday Fiesta',
                'description' => 'A colorful setup for your baby’s first milestone celebration.',
                'price' => 10000,
                'discount_type' => 'fixed',
                'discount_value' => 2000,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $firstBirthdayCategory->id,
                'features' => 'Balloons, Cake Table, Banners, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Tiny Star Celebration',
                'description' => 'A starry-themed first birthday with cute decorations.',
                'price' => 11000,
                'discount_type' => 'fixed',
                'discount_value' => 2000,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $firstBirthdayCategory->id,
                'features' => 'Star Props, Balloons, Fairy Lights, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Little Explorer Party',
                'description' => 'An adventurous first birthday with playful decorations.',
                'price' => 12000,
                'discount_type' => 'fixed',
                'discount_value' => 2500,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $firstBirthdayCategory->id,
                'features' => 'Adventure Props, Balloons, Backdrop, Activity Zone',
                'images' => [
                    'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],

            // 1st Birthday Girl Category
            [
                'name' => 'Baby Girl Princess Party',
                'description' => 'A pink and gold setup for your baby girl’s first birthday.',
                'price' => 10000,
                'discount_type' => 'fixed',
                'discount_value' => 2000,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $firstBirthdayGirlCategory->id,
                'features' => 'Pink Balloons, Gold Decor, Cake Table, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Little Fairy First Birthday',
                'description' => 'A magical fairy-themed first birthday for your little girl.',
                'price' => 11000,
                'discount_type' => 'fixed',
                'discount_value' => 2000,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $firstBirthdayGirlCategory->id,
                'features' => 'Fairy Props, Balloons, Floral Decor, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Pink Balloon Bash',
                'description' => 'A vibrant pink-themed first birthday celebration.',
                'price' => 12000,
                'discount_type' => 'fixed',
                'discount_value' => 2500,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $firstBirthdayGirlCategory->id,
                'features' => 'Pink Balloons, Banners, Cake Table, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],

            // 1st Birthday Boy Category
            [
                'name' => 'Baby Boy Adventure Party',
                'description' => 'A playful setup for your baby boy’s first birthday.',
                'price' => 10000,
                'discount_type' => 'fixed',
                'discount_value' => 2000,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $firstBirthdayBoyCategory->id,
                'features' => 'Adventure Props, Blue Balloons, Cake Table, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1503453362798-6e858b3a1638?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1544027993-7ad6d309ef80?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1581235720704-06d1012a8b73?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Little Sailor Celebration',
                'description' => 'A nautical-themed first birthday for your baby boy.',
                'price' => 11000,
                'discount_type' => 'fixed',
                'discount_value' => 2000,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $firstBirthdayBoyCategory->id,
                'features' => 'Nautical Props, Balloons, Anchor Decor, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1503453362798-6e858b3a1638?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1544027993-7ad6d309ef80?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1581235720704-06d1012a8b73?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Blue Balloon Bash',
                'description' => 'A vibrant blue-themed first birthday celebration.',
                'price' => 12000,
                'discount_type' => 'fixed',
                'discount_value' => 2500,
                'duration' => 4 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $firstBirthdayBoyCategory->id,
                'features' => 'Blue Balloons, Banners, Cake Table, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1503453362798-6e858b3a1638?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1544027993-7ad6d309ef80?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1581235720704-06d1012a8b73?w=800&h=600&fit=crop'
                ]
            ],

            // Haldi Mehndi Category
            [
                'name' => 'Vibrant Haldi Ceremony',
                'description' => 'A bright yellow-themed setup for a traditional haldi ceremony.',
                'price' => 22000,
                'discount_type' => 'fixed',
                'discount_value' => 4000,
                'duration' => 6 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $haldiMehndiCategory->id,
                'features' => 'Yellow Decor, Floral Arrangements, Traditional Props, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1606800052052-a08af7148866?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1605550113667-3a4a7e3b3b3a?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1607292366048-0d1f2b1584e0?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Mehndi Night Extravaganza',
                'description' => 'A green and orange-themed setup for a festive mehndi night.',
                'price' => 25000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'duration' => 8 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $haldiMehndiCategory->id,
                'features' => 'Green Decor, Orange Accents, Mehndi Station, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1606800052052-a08af7148866?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1605550113667-3a4a7e3b3b3a?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1607292366048-0d1f2b1584e0?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Floral Haldi Mehndi Combo',
                'description' => 'A floral-themed setup for haldi and mehndi celebrations.',
                'price' => 24000,
                'discount_type' => 'fixed',
                'discount_value' => 4500,
                'duration' => 6 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $haldiMehndiCategory->id,
                'features' => 'Floral Decor, Traditional Props, Lighting, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1606800052052-a08af7148866?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1605550113667-3a4a7e3b3b3a?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1607292366048-0d1f2b1584e0?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop'
                ]
            ],

            // Premium Decoration Category
            [
                'name' => 'Luxury Wedding Extravaganza',
                'description' => 'Opulent wedding decorations with premium flowers and lighting.',
                'price' => 100000,
                'discount_type' => 'fixed',
                'discount_value' => 15000,
                'duration' => 12 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $premiumCategory->id,
                'features' => 'Premium Flowers, Chandeliers, Drapes, Stage Setup',
                'images' => [
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Grand Gala Decoration',
                'description' => 'A majestic setup for high-end events with luxurious decor.',
                'price' => 95000,
                'discount_type' => 'fixed',
                'discount_value' => 14000,
                'duration' => 12 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $premiumCategory->id,
                'features' => 'Luxury Decor, Floral Arches, Premium Lighting, Stage Setup',
                'images' => [
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Elite Event Package',
                'description' => 'A premium event setup with sophisticated and elegant decor.',
                'price' => 110000,
                'discount_type' => 'fixed',
                'discount_value' => 16000,
                'duration' => 12 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $premiumCategory->id,
                'features' => 'Elegant Decor, Chandeliers, Floral Arches, Premium Lighting',
                'images' => [
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],

            // Flower Bouquet Category
            [
                'name' => 'Red Rose Romance',
                'description' => 'A stunning red rose bouquet for romantic occasions.',
                'price' => 3000,
                'discount_type' => 'fixed',
                'discount_value' => 500,
                'duration' => 1 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $flowerCategory->id,
                'features' => 'Red Roses, Greenery, Ribbon, Gift Wrapping',
                'images' => [
                    'https://images.unsplash.com/photo-1455659817273-f96807779a8a?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Sunflower Delight',
                'description' => 'A cheerful sunflower bouquet to brighten any occasion.',
                'price' => 3500,
                'discount_type' => 'fixed',
                'discount_value' => 600,
                'duration' => 1 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $flowerCategory->id,
                'features' => 'Sunflowers, Greenery, Ribbon, Gift Wrapping',
                'images' => [
                    'https://images.unsplash.com/photo-1455659817273-f96807779a8a?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Mixed Floral Bouquet',
                'description' => 'A vibrant mix of flowers for a special touch.',
                'price' => 3200,
                'discount_type' => 'fixed',
                'discount_value' => 500,
                'duration' => 1 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $flowerCategory->id,
                'features' => 'Mixed Flowers, Greenery, Ribbon, Gift Wrapping',
                'images' => [
                    'https://images.unsplash.com/photo-1455659817273-f96807779a8a?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],

            // Gift Section Category
            [
                'name' => 'Surprise Gift Hamper',
                'description' => 'A curated gift box with personalized items for special occasions.',
                'price' => 5000,
                'discount_type' => 'fixed',
                'discount_value' => 1000,
                'duration' => 1 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $giftCategory->id,
                'features' => 'Chocolates, Personalized Items, Gift Box, Ribbon',
                'images' => [
                    'https://images.unsplash.com/photo-1549465220-1a8b9238cd48?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Luxury Gift Basket',
                'description' => 'A premium gift basket with high-end items for gifting.',
                'price' => 6000,
                'discount_type' => 'fixed',
                'discount_value' => 1200,
                'duration' => 1 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $giftCategory->id,
                'features' => 'Premium Chocolates, Wine, Gift Basket, Ribbon',
                'images' => [
                    'https://images.unsplash.com/photo-1549465220-1a8b9238cd48?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Personalized Gift Box',
                'description' => 'A customized gift box tailored for your loved ones.',
                'price' => 5500,
                'discount_type' => 'fixed',
                'discount_value' => 1000,
                'duration' => 1 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $giftCategory->id,
                'features' => 'Custom Items, Chocolates, Gift Box, Ribbon',
                'images' => [
                    'https://images.unsplash.com/photo-1549465220-1a8b9238cd48?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],

            // Simple Decoration Category
            [
                'name' => 'Minimalist Birthday Setup',
                'description' => 'A clean and elegant setup for intimate birthday celebrations.',
                'price' => 8000,
                'discount_type' => 'fixed',
                'discount_value' => 1500,
                'duration' => 3 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $simpleCategory->id,
                'features' => 'Balloons, Simple Decor, Cake Table, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1527529482837-4698179dc6ce?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Simple Anniversary Decor',
                'description' => 'A minimalist setup for a cozy anniversary celebration.',
                'price' => 8500,
                'discount_type' => 'fixed',
                'discount_value' => 1500,
                'duration' => 3 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $simpleCategory->id,
                'features' => 'Candles, Floral Decor, Simple Lighting, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1527529482837-4698179dc6ce?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Basic Party Setup',
                'description' => 'A simple yet elegant setup for small gatherings.',
                'price' => 7000,
                'discount_type' => 'fixed',
                'discount_value' => 1000,
                'duration' => 3 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $simpleCategory->id,
                'features' => 'Balloons, Simple Decor, Cake Table, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1527529482837-4698179dc6ce?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop'
                ]
            ],

            // Ring Decoration Category
            [
                'name' => 'Elegant Ring Ceremony',
                'description' => 'A floral and traditional setup for your ring ceremony.',
                'price' => 30000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'duration' => 6 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $ringCategory->id,
                'features' => 'Floral Arches, Traditional Decor, Lighting, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Romantic Engagement Setup',
                'description' => 'A romantic setup for your engagement with floral arches.',
                'price' => 32000,
                'discount_type' => 'fixed',
                'discount_value' => 5500,
                'duration' => 6 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $ringCategory->id,
                'features' => 'Floral Arches, Romantic Lighting, Candles, Photo Booth',
                'images' => [
                    'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Classic Ring Exchange',
                'description' => 'A traditional setup for a memorable ring ceremony.',
                'price' => 31000,
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'duration' => 6 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $ringCategory->id,
                'features' => 'Traditional Decor, Floral Arches, Lighting, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop'
                ]
            ],

            // Welcome Baby Category
            [
                'name' => 'Welcome Baby Home',
                'description' => 'A cute setup to welcome your newborn home.',
                'price' => 7000,
                'discount_type' => 'fixed',
                'discount_value' => 1500,
                'duration' => 2 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => false,
                'category_id' => $welcomeBabyCategory->id,
                'features' => 'Balloons, Banners, Baby Props, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Baby Shower Celebration',
                'description' => 'A joyful setup for celebrating the arrival of your baby.',
                'price' => 9000,
                'discount_type' => 'fixed',
                'discount_value' => 2000,
                'duration' => 3 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $welcomeBabyCategory->id,
                'features' => 'Balloons, Baby Props, Cake Table, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop'
                ]
            ],
            [
                'name' => 'Newborn Welcome Setup',
                'description' => 'A charming setup to welcome your newborn with love.',
                'price' => 8000,
                'discount_type' => 'fixed',
                'discount_value' => 1500,
                'duration' => 2 * 60 * 60 * 1000,
                'is_active' => true,
                'is_special' => true,
                'category_id' => $welcomeBabyCategory->id,
                'features' => 'Balloons, Baby Props, Banners, Photo Area',
                'images' => [
                    'https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1519748771451-a94c186835b7?w=800&h=600&fit=crop',
                    'https://images.unsplash.com/photo-1593642532973-d31b97d0e6b8?w=800&h=600&fit=crop'
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
