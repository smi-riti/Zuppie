<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\EventPackage;
use App\Models\Offer;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ProductionSitemapController extends Controller
{
    /**
     * Generate sitemap index for production
     */
    public function index(): Response
    {
        $cacheKey = 'sitemap_index_production';
        $cacheDuration = config('seo.sitemap.cache_duration', 3600);
        
        $xml = Cache::remember($cacheKey, $cacheDuration, function () {
            return $this->generateSitemapIndex();
        });
        
        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=' . $cacheDuration,
            'Last-Modified' => gmdate('D, d M Y H:i:s') . ' GMT'
        ]);
    }

    /**
     * Generate static pages sitemap
     */
    public function static(): Response
    {
        $cacheKey = 'sitemap_static_production';
        $cacheDuration = config('seo.sitemap.cache_duration', 3600);
        
        $xml = Cache::remember($cacheKey, $cacheDuration, function () {
            return $this->generateStaticSitemap();
        });
        
        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=' . $cacheDuration
        ]);
    }

    /**
     * Generate categories sitemap
     */
    public function categories(): Response
    {
        $cacheKey = 'sitemap_categories_production';
        $cacheDuration = config('seo.sitemap.cache_duration', 3600);
        
        $xml = Cache::remember($cacheKey, $cacheDuration, function () {
            return $this->generateCategoriesSitemap();
        });
        
        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=' . $cacheDuration
        ]);
    }

    /**
     * Generate event packages sitemap
     */
    public function packages(): Response
    {
        $cacheKey = 'sitemap_packages_production';
        $cacheDuration = config('seo.sitemap.cache_duration', 3600);
        
        $xml = Cache::remember($cacheKey, $cacheDuration, function () {
            return $this->generatePackagesSitemap();
        });
        
        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=' . $cacheDuration
        ]);
    }

    /**
     * Generate offers sitemap
     */
    public function offers(): Response
    {
        $cacheKey = 'sitemap_offers_production';
        $cacheDuration = config('seo.sitemap.cache_duration', 3600);
        
        $xml = Cache::remember($cacheKey, $cacheDuration, function () {
            return $this->generateOffersSitemap();
        });
        
        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=' . $cacheDuration
        ]);
    }

    /**
     * Generate blogs sitemap
     */
    public function blogs(): Response
    {
        $cacheKey = 'sitemap_blogs_production';
        $cacheDuration = config('seo.sitemap.cache_duration', 3600);
        
        $xml = Cache::remember($cacheKey, $cacheDuration, function () {
            return $this->generateBlogsSitemap();
        });
        
        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=' . $cacheDuration
        ]);
    }

    /**
     * Generate sitemap index XML
     */
    private function generateSitemapIndex(): string
    {
        $baseUrl = 'https://zuppie.in';
        $lastmod = now()->toISOString();
        
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        // Static pages sitemap
        $xml .= '    <sitemap>' . "\n";
        $xml .= '        <loc>' . $baseUrl . '/sitemap/static.xml</loc>' . "\n";
        $xml .= '        <lastmod>' . $lastmod . '</lastmod>' . "\n";
        $xml .= '    </sitemap>' . "\n";
        
        // Categories sitemap
        $xml .= '    <sitemap>' . "\n";
        $xml .= '        <loc>' . $baseUrl . '/sitemap/categories.xml</loc>' . "\n";
        $xml .= '        <lastmod>' . $lastmod . '</lastmod>' . "\n";
        $xml .= '    </sitemap>' . "\n";
        
        // Event packages sitemap
        $xml .= '    <sitemap>' . "\n";
        $xml .= '        <loc>' . $baseUrl . '/sitemap/packages.xml</loc>' . "\n";
        $xml .= '        <lastmod>' . $lastmod . '</lastmod>' . "\n";
        $xml .= '    </sitemap>' . "\n";
        
        // Offers sitemap
        $xml .= '    <sitemap>' . "\n";
        $xml .= '        <loc>' . $baseUrl . '/sitemap/offers.xml</loc>' . "\n";
        $xml .= '        <lastmod>' . $lastmod . '</lastmod>' . "\n";
        $xml .= '    </sitemap>' . "\n";
        
        // Blogs sitemap
        $xml .= '    <sitemap>' . "\n";
        $xml .= '        <loc>' . $baseUrl . '/sitemap/blogs.xml</loc>' . "\n";
        $xml .= '        <lastmod>' . $lastmod . '</lastmod>' . "\n";
        $xml .= '    </sitemap>' . "\n";
        
        $xml .= '</sitemapindex>';
        
        return $xml;
    }

    /**
     * Generate static pages sitemap
     */
    private function generateStaticSitemap(): string
    {
        $baseUrl = 'https://zuppie.in';
        $lastmod = now()->toISOString();
        
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        // Static pages with their priorities and change frequencies
        $staticPages = [
            ['url' => '', 'priority' => '1.0', 'changefreq' => 'daily'],
            ['url' => '/about', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => '/contact', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => '/services', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => '/event-packages', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => '/offers', 'priority' => '0.8', 'changefreq' => 'daily'],
            ['url' => '/gallery', 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['url' => '/reviews', 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['url' => '/privacy-policy', 'priority' => '0.3', 'changefreq' => 'yearly'],
            ['url' => '/terms-of-service', 'priority' => '0.3', 'changefreq' => 'yearly'],
            ['url' => '/refund-policy', 'priority' => '0.3', 'changefreq' => 'yearly'],
            ['url' => '/careers', 'priority' => '0.5', 'changefreq' => 'monthly'],
            ['url' => '/blog', 'priority' => '0.8', 'changefreq' => 'daily'],
            ['url' => '/faq', 'priority' => '0.6', 'changefreq' => 'monthly'],
        ];
        
        foreach ($staticPages as $page) {
            $xml .= '    <url>' . "\n";
            $xml .= '        <loc>' . $baseUrl . $page['url'] . '</loc>' . "\n";
            $xml .= '        <lastmod>' . $lastmod . '</lastmod>' . "\n";
            $xml .= '        <changefreq>' . $page['changefreq'] . '</changefreq>' . "\n";
            $xml .= '        <priority>' . $page['priority'] . '</priority>' . "\n";
            $xml .= '    </url>' . "\n";
        }
        
        $xml .= '</urlset>';
        
        return $xml;
    }

    /**
     * Generate categories sitemap
     */
    private function generateCategoriesSitemap(): string
    {
        $baseUrl = 'https://zuppie.in';
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        try {
            $categories = Category::select('id', 'name', 'slug', 'updated_at')
                ->where('status', 'active')
                ->orderBy('updated_at', 'desc')
                ->get();
            
            foreach ($categories as $category) {
                $xml .= '    <url>' . "\n";
                $xml .= '        <loc>' . $baseUrl . '/category/' . $category->slug . '</loc>' . "\n";
                $xml .= '        <lastmod>' . $category->updated_at->toISOString() . '</lastmod>' . "\n";
                $xml .= '        <changefreq>weekly</changefreq>' . "\n";
                $xml .= '        <priority>0.8</priority>' . "\n";
                $xml .= '    </url>' . "\n";
            }
        } catch (\Exception $e) {
            Log::error('Sitemap categories generation failed: ' . $e->getMessage());
        }
        
        $xml .= '</urlset>';
        
        return $xml;
    }

    /**
     * Generate event packages sitemap
     */
    private function generatePackagesSitemap(): string
    {
        $baseUrl = 'https://zuppie.in';
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        try {
            $packages = EventPackage::select('id', 'name', 'slug', 'updated_at')
                ->where('status', 'active')
                ->orderBy('updated_at', 'desc')
                ->get();
            
            foreach ($packages as $package) {
                $xml .= '    <url>' . "\n";
                $xml .= '        <loc>' . $baseUrl . '/event-package/' . $package->slug . '</loc>' . "\n";
                $xml .= '        <lastmod>' . $package->updated_at->toISOString() . '</lastmod>' . "\n";
                $xml .= '        <changefreq>weekly</changefreq>' . "\n";
                $xml .= '        <priority>0.9</priority>' . "\n";
                $xml .= '    </url>' . "\n";
            }
        } catch (\Exception $e) {
            Log::error('Sitemap packages generation failed: ' . $e->getMessage());
        }
        
        $xml .= '</urlset>';
        
        return $xml;
    }

    /**
     * Generate offers sitemap
     */
    private function generateOffersSitemap(): string
    {
        $baseUrl = 'https://zuppie.in';
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        try {
            $offers = Offer::select('id', 'title', 'slug', 'updated_at')
                ->where('status', 'active')
                ->where('expires_at', '>', now())
                ->orderBy('updated_at', 'desc')
                ->get();
            
            foreach ($offers as $offer) {
                $xml .= '    <url>' . "\n";
                $xml .= '        <loc>' . $baseUrl . '/offer/' . $offer->slug . '</loc>' . "\n";
                $xml .= '        <lastmod>' . $offer->updated_at->toISOString() . '</lastmod>' . "\n";
                $xml .= '        <changefreq>daily</changefreq>' . "\n";
                $xml .= '        <priority>0.7</priority>' . "\n";
                $xml .= '    </url>' . "\n";
            }
        } catch (\Exception $e) {
            Log::error('Sitemap offers generation failed: ' . $e->getMessage());
        }
        
        $xml .= '</urlset>';
        
        return $xml;
    }

    /**
     * Generate blogs sitemap
     */
    private function generateBlogsSitemap(): string
    {
        $baseUrl = 'https://zuppie.in';
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        try {
            $blogs = Blog::select('id', 'title', 'slug', 'updated_at')
                ->where('status', 'published')
                ->orderBy('updated_at', 'desc')
                ->get();
            
            foreach ($blogs as $blog) {
                $xml .= '    <url>' . "\n";
                $xml .= '        <loc>' . $baseUrl . '/blog/' . $blog->slug . '</loc>' . "\n";
                $xml .= '        <lastmod>' . $blog->updated_at->toISOString() . '</lastmod>' . "\n";
                $xml .= '        <changefreq>weekly</changefreq>' . "\n";
                $xml .= '        <priority>0.6</priority>' . "\n";
                $xml .= '    </url>' . "\n";
            }
        } catch (\Exception $e) {
            Log::error('Sitemap blogs generation failed: ' . $e->getMessage());
        }
        
        $xml .= '</urlset>';
        
        return $xml;
    }
}
