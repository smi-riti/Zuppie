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
        $categories = [
            // Birthday Main Category
            [
                'name' => 'Birthday',
                'slug' => 'birthday',
                'description' => 'Celebrate special birthdays with our customized packages',
                'image' => 'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop',
                'is_special' => true,
                'parent_id' => null,
                'subcategories' => [
                    [
                        'name' => 'Girl Birthday',
                        'slug' => 'girl-birthday',
                        'description' => 'Princess themed birthday celebrations for girls',
                        'image' => 'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800&h=600&fit=crop',
                    ],
                    [
                        'name' => 'Boy Birthday',
                        'slug' => 'boy-birthday',
                        'description' => 'Adventure and superhero themed birthday parties for boys',
                        'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&h=600&fit=crop',
                    ],
                    [
                        'name' => 'Teenage Birthday',
                        'slug' => 'teenage-birthday',
                        'description' => 'Cool and trendy birthday celebrations for teenagers',
                        'image' => 'https://images.unsplash.com/photo-1549451371-64aa98a6f660?w=800&h=600&fit=crop',
                    ],
                    [
                        'name' => 'Adult Birthday',
                        'slug' => 'adult-birthday',
                        'description' => 'Elegant and sophisticated birthday celebrations for adults',
                        'image' => 'https://images.unsplash.com/photo-1527529482837-4698179dc6ce?w=800&h=600&fit=crop',
                    ]
                ]
            ],

            // Wedding Anniversary
            [
                'name' => 'Wedding Anniversary',
                'slug' => 'wedding-anniversary',
                'description' => 'Celebrate your love milestones with romantic anniversary packages',
                'image' => 'https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?w=800&h=600&fit=crop',
                'is_special' => true,
                'parent_id' => null,
                'subcategories' => [
                    [
                        'name' => '1st Anniversary',
                        'slug' => '1st-anniversary',
                        'description' => 'Celebrate your first year of marriage with romantic decorations',
                        'image' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                    ],
                    [
                        'name' => '25th Anniversary',
                        'slug' => '25th-anniversary',
                        'description' => 'Silver jubilee celebration with elegant silver-themed decorations',
                        'image' => 'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&h=600&fit=crop',
                    ],
                    [
                        'name' => '50th Anniversary',
                        'slug' => '50th-anniversary',
                        'description' => 'Golden jubilee celebration with luxurious golden decorations',
                        'image' => 'https://images.unsplash.com/photo-1465495976277-4387d4b0e4a6?w=800&h=600&fit=crop',
                    ]
                ]
            ],

            // Festival
            [
                'name' => 'Festival',
                'slug' => 'festival',
                'description' => 'Traditional and cultural festival celebrations',
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop',
                'is_special' => false,
                'parent_id' => null,
                'subcategories' => []
            ],

            // 1st Birthday Special
            [
                'name' => '1st Birthday',
                'slug' => '1st-birthday',
                'description' => 'Special first birthday celebrations',
                'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&h=600&fit=crop',
                'is_special' => true,
                'parent_id' => null,
                'subcategories' => [
                    [
                        'name' => '1st Birthday Girl',
                        'slug' => '1st-birthday-girl',
                        'description' => 'Sweet and colorful first birthday celebration for baby girls',
                        'image' => 'https://images.unsplash.com/photo-1464207687429-7505649dae38?w=800&h=600&fit=crop',
                    ],
                    [
                        'name' => '1st Birthday Boy',
                        'slug' => '1st-birthday-boy',
                        'description' => 'Fun and playful first birthday celebration for baby boys',
                        'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&h=600&fit=crop',
                    ]
                ]
            ],

            // Haldi & Mehndi
            [
                'name' => 'Haldi & Mehndi',
                'slug' => 'haldi-mehndi',
                'description' => 'Traditional pre-wedding celebrations with vibrant decorations',
                'image' => 'https://images.unsplash.com/photo-1606800052052-a08af7148866?w=800&h=600&fit=crop',
                'is_special' => true,
                'parent_id' => null,
                'subcategories' => []
            ],

            // Premium Decoration
            [
                'name' => 'Premium Decoration',
                'slug' => 'premium-decoration',
                'description' => 'Luxury and high-end decoration services for special occasions',
                'image' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                'is_special' => true,
                'parent_id' => null,
                'subcategories' => []
            ],

            // Flower Bouquet
            [
                'name' => 'Flower Bouquet',
                'slug' => 'flower-bouquet',
                'description' => 'Beautiful flower arrangements and bouquets for all occasions',
                'image' => 'https://images.unsplash.com/photo-1455659817273-f96807779a8a?w=800&h=600&fit=crop',
                'is_special' => true,
                'parent_id' => null,
                'subcategories' => []
            ],

            // Gift Section
            [
                'name' => 'Gift Section',
                'slug' => 'gift-section',
                'description' => 'Special gift packages and surprise arrangements',
                'image' => 'https://images.unsplash.com/photo-1549465220-1a8b9238cd48?w=800&h=600&fit=crop',
                'is_special' => true,
                'parent_id' => null,
                'subcategories' => []
            ],

            // Simple Decoration
            [
                'name' => 'Simple Decoration',
                'slug' => 'simple-decoration',
                'description' => 'Elegant and minimalistic decoration for intimate celebrations',
                'image' => 'https://images.unsplash.com/photo-1527529482837-4698179dc6ce?w=800&h=600&fit=crop',
                'is_special' => true,
                'parent_id' => null,
                'subcategories' => []
            ],

            // Ring Decoration
            [
                'name' => 'Ring Decoration',
                'slug' => 'ring-decoration',
                'description' => 'Special decoration arrangements for engagement and ring ceremonies',
                'image' => 'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?w=800&h=600&fit=crop',
                'is_special' => false,
                'parent_id' => null,
                'subcategories' => []
            ],

            // Welcome Baby
            [
                'name' => 'Welcome Baby',
                'slug' => 'welcome-baby',
                'description' => 'Cute and adorable decorations for welcoming new babies',
                'image' => 'https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?w=800&h=600&fit=crop',
                'is_special' => false,
                'parent_id' => null,
                'subcategories' => []
            ],

            // Baby Shower
            [
                'name' => 'Baby Shower',
                'slug' => 'baby-shower',
                'description' => 'Celebrate the upcoming arrival with beautiful baby shower decorations',
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop',
                'is_special' => false,
                'parent_id' => null,
                'subcategories' => []
            ],

            // Love Theme
            [
                'name' => 'Love Theme',
                'slug' => 'love-theme',
                'description' => 'Romantic and love-themed decorations for couples',
                'image' => 'https://images.unsplash.com/photo-1518621012420-9f4c3ba55fdd?w=800&h=600&fit=crop',
                'is_special' => false,
                'parent_id' => null,
                'subcategories' => []
            ],

            // Bride to Be
            [
                'name' => 'Bride to Be',
                'slug' => 'bride-to-be',
                'description' => 'Special celebration packages for bride-to-be parties',
                'image' => 'https://images.unsplash.com/photo-1594736797933-d0d3482ba3a8?w=800&h=600&fit=crop',
                'is_special' => false,
                'parent_id' => null,
                'subcategories' => []
            ]
        ];

        foreach ($categories as $categoryData) {
            $subcategories = $categoryData['subcategories'] ?? [];
            unset($categoryData['subcategories']);

            $category = Category::create($categoryData);

            // Create subcategories
            foreach ($subcategories as $subcat) {
                $subcat['parent_id'] = $category->id;
                $subcat['is_special'] = false;
                Category::create($subcat);
            }
        }
    }
}
