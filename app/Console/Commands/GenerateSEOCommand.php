<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Models\Category;
use App\Models\EventPackage;
use App\Models\Offer;
use App\Models\Blog;

class GenerateSEOCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:generate {--clear-cache}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate SEO meta tags and structured data for all pages';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting SEO generation...');

        if ($this->option('clear-cache')) {
            $this->call('cache:clear');
            $this->info('Cache cleared.');
        }

        // Generate meta tags for categories
        $this->generateCategoryMeta();
        
        // Generate meta tags for event packages
        $this->generatePackageMeta();
        
        // Generate meta tags for offers
        $this->generateOfferMeta();
        
        // Generate meta tags for blogs
        $this->generateBlogMeta();
        
        // Generate static page meta
        $this->generateStaticPageMeta();
        
        // Generate sitemaps
        $this->call('sitemap:generate');
        
        $this->info('SEO generation completed successfully!');
    }

    /**
     * Generate category meta tags
     */
    private function generateCategoryMeta()
    {
        $this->info('Generating category meta tags...');
        
        $categories = Category::all();
        
        foreach ($categories as $category) {
            $meta = [
                'title' => $category->name . ' - Premium Event Decorations in Purnia',
                'description' => "Discover our premium {$category->name} event packages in Purnia, Bihar. Professional decorations and planning services for memorable celebrations.",
                'keywords' => "{$category->name} Purnia, event planning Purnia, party decorations Bihar, celebration packages Purnia, premium events Bihar, {$category->name} party Purnia",
                'type' => 'article',
                'section' => 'Event Categories',
                'tags' => [$category->name, 'events Purnia', 'celebrations Bihar', 'decorations Purnia'],
                'image' => $category->image ?? config('seo.meta.og.default_image'),
                'canonical' => url("/category/{$category->slug}"),
            ];
            
            // Store meta in cache or database
            cache()->put("seo.category.{$category->id}", $meta, 3600);
        }
        
        $this->info('Category meta tags generated: ' . $categories->count());
    }

    /**
     * Generate event package meta tags
     */
    private function generatePackageMeta()
    {
        $this->info('Generating event package meta tags...');
        
        $packages = EventPackage::all();
        
        foreach ($packages as $package) {
            $price = $package->discount_value 
                ? $package->price - $package->discount_value
                : $package->price;
                
            $meta = [
                'title' => $package->name . ' - ₹' . number_format($price) . ' | Event Package Purnia',
                'description' => substr($package->description, 0, 140) . '... Available in Purnia, Bihar',
                'keywords' => "{$package->name} Purnia, event package Bihar, party planning Purnia, celebration Bihar, decoration Purnia, ₹{$price}",
                'type' => 'product',
                'image' => $package->images[0] ?? config('seo.meta.og.default_image'),
                'canonical' => route('package-detail', $package->id),
            ];
            
            cache()->put("seo.package.{$package->id}", $meta, 3600);
        }
        
        $this->info('Event package meta tags generated: ' . $packages->count());
    }

    /**
     * Generate offer meta tags
     */
    private function generateOfferMeta()
    {
        $this->info('Generating offer meta tags...');
        
        $offers = Offer::all();
        
        foreach ($offers as $offer) {
            $meta = [
                'title' => $offer->title . ' - Special Offer Purnia | Zuppie Events',
                'description' => substr($offer->description, 0, 140) . '... Available in Purnia, Bihar',
                'keywords' => "{$offer->title}, special offer, discount, event planning, celebration",
                'type' => 'article',
                'section' => 'Special Offers',
                'image' => $offer->image ?? config('seo.meta.og.default_image'),
                'canonical' => route('offer.show', $offer->slug),
            ];
            
            cache()->put("seo.offer.{$offer->id}", $meta, 3600);
        }
        
        $this->info('Offer meta tags generated: ' . $offers->count());
    }

    /**
     * Generate blog meta tags
     */
    private function generateBlogMeta()
    {
        $this->info('Generating blog meta tags...');
        
        $blogs = Blog::where('status', 'published')->get();
        
        foreach ($blogs as $blog) {
            $meta = [
                'title' => $blog->title . ' - Zuppie Blog Purnia',
                'description' => substr($blog->content, 0, 140) . '... Event planning tips for Purnia, Bihar',
                'keywords' => "{$blog->title} Purnia, event planning Bihar, party tips Purnia, celebration ideas Bihar, blog",
                'type' => 'article',
                'section' => 'Blog',
                'published_time' => $blog->created_at->toISOString(),
                'modified_time' => $blog->updated_at->toISOString(),
                'image' => $blog->image ?? config('seo.meta.og.default_image'),
                'canonical' => url("/blog/{$blog->slug}"),
            ];
            
            cache()->put("seo.blog.{$blog->id}", $meta, 3600);
        }
        
        $this->info('Blog meta tags generated: ' . $blogs->count());
    }

    /**
     * Generate static page meta tags
     */
    private function generateStaticPageMeta()
    {
        $this->info('Generating static page meta tags...');
        
        $pages = [
            'home' => [
                'title' => 'Zuppie - Premium Event Planning & Birthday Celebrations in India',
                'description' => 'Transform your special moments into magical memories with Zuppie\'s professional event planning services. Birthday parties, anniversaries, festivals, and premium decorations across India.',
                'keywords' => 'event planning, birthday celebrations, anniversary decorations, festival events, premium event management, party planning, decoration services, India',
                'canonical' => route('home'),
            ],
            'about' => [
                'title' => 'About Zuppie - Your Premier Event Planning Partner',
                'description' => 'Learn about Zuppie\'s journey in creating magical celebrations. Our expert team specializes in birthday parties, anniversaries, and premium event decorations across India.',
                'keywords' => 'about zuppie, event planning company, professional decorators, celebration experts, party planners India',
                'canonical' => route('about'),
            ],
            'contact' => [
                'title' => 'Contact Zuppie - Get Your Event Quote Today',
                'description' => 'Ready to plan your perfect celebration? Contact Zuppie for personalized event planning services. Get quotes for birthdays, anniversaries, and special occasions.',
                'keywords' => 'contact zuppie, event planning quote, party planning services, celebration consultation, event booking',
                'canonical' => route('contact'),
            ],
            'event-packages' => [
                'title' => 'Event Packages - Premium Celebration Themes | Zuppie',
                'description' => 'Explore our curated event packages for birthdays, anniversaries, festivals, and special occasions. Professional decorations and planning services.',
                'keywords' => 'event packages, birthday packages, anniversary packages, celebration themes, premium decorations, party packages',
                'canonical' => route('event-packages'),
            ],
        ];
        
        foreach ($pages as $page => $meta) {
            cache()->put("seo.page.{$page}", $meta, 3600);
        }
        
        $this->info('Static page meta tags generated: ' . count($pages));
    }
}
