<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogImage;
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
        
        if (empty($userIds) || empty($categoryIds)) {
            $this->command->error('Please ensure users and categories exist before running blog seeder.');
            return;
        }
        
        // Sample blog titles and content for more realistic data
        $blogData = [
            [
                'title' => 'Getting Started with Web Development',
                'content' => '<h2>Introduction to Web Development</h2><p>Web development is an exciting field that combines creativity with technical skills. In this comprehensive guide, we\'ll explore the fundamentals of building modern websites.</p><h3>Key Technologies</h3><ul><li>HTML for structure</li><li>CSS for styling</li><li>JavaScript for interactivity</li></ul><p>Whether you\'re just starting out or looking to expand your skills, understanding these core technologies is essential for any web developer.</p>'
            ],
            [
                'title' => 'The Future of Artificial Intelligence',
                'content' => '<h2>AI in Everyday Life</h2><p>Artificial Intelligence is no longer a concept from science fiction. It\'s becoming an integral part of our daily lives, from smart assistants to recommendation systems.</p><h3>Current Applications</h3><p>AI is currently being used in:</p><ul><li>Healthcare diagnostics</li><li>Financial services</li><li>Transportation</li><li>Entertainment</li></ul><p>As we move forward, the integration of AI in various sectors will continue to grow, bringing both opportunities and challenges.</p>'
            ],
            [
                'title' => 'Sustainable Living: Small Changes, Big Impact',
                'content' => '<h2>Making a Difference</h2><p>Living sustainably doesn\'t require drastic lifestyle changes. Small, consistent actions can create a significant positive impact on our environment.</p><h3>Simple Steps to Get Started</h3><ol><li>Reduce single-use plastics</li><li>Choose energy-efficient appliances</li><li>Support local and organic products</li><li>Use public transportation or bike</li></ol><p>Every small action counts towards creating a more sustainable future for generations to come.</p>'
            ],
            [
                'title' => 'Digital Marketing Trends for 2024',
                'content' => '<h2>The Evolution of Digital Marketing</h2><p>Digital marketing continues to evolve at a rapid pace. Staying ahead of trends is crucial for businesses looking to connect with their audience effectively.</p><h3>Top Trends to Watch</h3><ul><li>Personalized content experiences</li><li>Voice search optimization</li><li>Interactive content</li><li>Sustainability messaging</li></ul><p>Businesses that adapt to these trends will be better positioned to engage their customers and drive growth in the digital age.</p>'
            ],
            [
                'title' => 'The Art of Remote Work: Tips for Productivity',
                'content' => '<h2>Mastering Remote Work</h2><p>Remote work has become the new normal for many professionals. While it offers flexibility, it also presents unique challenges that require strategic approaches.</p><h3>Essential Tips for Success</h3><ul><li>Create a dedicated workspace</li><li>Establish clear boundaries</li><li>Use productivity tools effectively</li><li>Maintain regular communication</li><li>Take regular breaks</li></ul><p>With the right strategies and mindset, remote work can be both productive and fulfilling, offering the perfect work-life balance.</p>'
            ]
        ];
        
        // Create blogs with images in separate table
        foreach ($blogData as $index => $data) {
            $blog = Blog::create([
                'title' => $data['title'],
                'content' => $data['content'],
                'status' => $faker->randomElement(['draft', 'published', 'published', 'published']), // More published posts
                'user_id' => $faker->randomElement($userIds),
                'category_id' => $faker->randomElement($categoryIds),
            ]);

            // Create featured image for each blog
            BlogImage::create([
                'blog_id' => $blog->id,
                'image_url' => $faker->imageUrl(800, 600, 'business', true, $data['title']),
                'image_file_id' => null,
                'is_featured' => true,
                'sort_order' => 1,
            ]);

            // Create 2-4 gallery images for each blog
            $galleryImageCount = $faker->numberBetween(2, 4);
            for ($i = 2; $i <= $galleryImageCount + 1; $i++) {
                BlogImage::create([
                    'blog_id' => $blog->id,
                    'image_url' => $faker->imageUrl(600, 400, 'business', true, $data['title'] . ' gallery ' . ($i-1)),
                    'image_file_id' => null,
                    'is_featured' => false,
                    'sort_order' => $i,
                ]);
            }
        }
        
        // Generate additional random blogs
        for ($i = 0; $i < 10; $i++) {
            $title = $faker->sentence(6, true);
            $content = '<h2>' . $faker->sentence(4) . '</h2>';
            $content .= '<p>' . $faker->paragraph(5) . '</p>';
            $content .= '<h3>' . $faker->sentence(3) . '</h3>';
            $content .= '<p>' . $faker->paragraph(4) . '</p>';
            $content .= '<ul>';
            for ($j = 0; $j < 3; $j++) {
                $content .= '<li>' . $faker->sentence(8) . '</li>';
            }
            $content .= '</ul>';
            $content .= '<p>' . $faker->paragraph(6) . '</p>';
            
            $blog = Blog::create([
                'title' => $title,
                'content' => $content,
                'status' => $faker->randomElement(['draft', 'published', 'published']),
                'user_id' => $faker->randomElement($userIds),
                'category_id' => $faker->randomElement($categoryIds),
            ]);

            // Create featured image for random blogs
            BlogImage::create([
                'blog_id' => $blog->id,
                'image_url' => $faker->imageUrl(800, 600, 'business', true, $title),
                'image_file_id' => null,
                'is_featured' => true,
                'sort_order' => 1,
            ]);

            // Create 1-3 gallery images for random blogs
            $galleryImageCount = $faker->numberBetween(1, 3);
            for ($k = 2; $k <= $galleryImageCount + 1; $k++) {
                BlogImage::create([
                    'blog_id' => $blog->id,
                    'image_url' => $faker->imageUrl(600, 400, 'business', true, $title . ' gallery ' . ($k-1)),
                    'image_file_id' => null,
                    'is_featured' => false,
                    'sort_order' => $k,
                ]);
            }
        }
        
        $this->command->info('Blog seeder completed successfully! Created ' . Blog::count() . ' blog posts.');
    }
}