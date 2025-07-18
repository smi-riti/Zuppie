<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class ProductionRobotsController extends Controller
{
    /**
     * Generate robots.txt for production
     */
    public function index(): Response
    {
        $cacheKey = 'robots_txt_production';
        $cacheDuration = 86400; // 24 hours
        
        $robotsTxt = Cache::remember($cacheKey, $cacheDuration, function () {
            return $this->generateRobotsTxt();
        });
        
        return response($robotsTxt, 200, [
            'Content-Type' => 'text/plain; charset=utf-8',
            'Cache-Control' => 'public, max-age=' . $cacheDuration
        ]);
    }

    /**
     * Generate robots.txt content
     */
    private function generateRobotsTxt(): string
    {
        $baseUrl = 'https://zuppie.in';
        
        $robots = "# Robots.txt for Zuppie - Event Management Services\n";
        $robots .= "# Generated on: " . now()->toDateTimeString() . "\n\n";
        
        // Main robots directives
        $robots .= "User-agent: *\n";
        $robots .= "Allow: /\n";
        $robots .= "Disallow: /admin/\n";
        $robots .= "Disallow: /dashboard/\n";
        $robots .= "Disallow: /api/\n";
        $robots .= "Disallow: /login\n";
        $robots .= "Disallow: /register\n";
        $robots .= "Disallow: /password/\n";
        $robots .= "Disallow: /email/\n";
        $robots .= "Disallow: /storage/\n";
        $robots .= "Disallow: /vendor/\n";
        $robots .= "Disallow: /resources/\n";
        $robots .= "Disallow: /bootstrap/\n";
        $robots .= "Disallow: /config/\n";
        $robots .= "Disallow: /database/\n";
        $robots .= "Disallow: /routes/\n";
        $robots .= "Disallow: /tests/\n";
        $robots .= "Disallow: /*?*\n";
        $robots .= "Disallow: /search?*\n";
        $robots .= "Disallow: /cart\n";
        $robots .= "Disallow: /checkout\n";
        $robots .= "Disallow: /profile\n";
        $robots .= "Disallow: /account/\n";
        $robots .= "Disallow: /my-bookings\n";
        $robots .= "Disallow: /booking/\n";
        $robots .= "Disallow: /*.pdf$\n";
        $robots .= "Disallow: /*.doc$\n";
        $robots .= "Disallow: /*.docx$\n";
        $robots .= "Disallow: /*.xls$\n";
        $robots .= "Disallow: /*.xlsx$\n";
        $robots .= "Disallow: /*.zip$\n";
        $robots .= "Disallow: /*.rar$\n\n";
        
        // Specific bot rules
        $robots .= "# Google Bot\n";
        $robots .= "User-agent: Googlebot\n";
        $robots .= "Allow: /\n";
        $robots .= "Disallow: /admin/\n";
        $robots .= "Disallow: /api/\n";
        $robots .= "Crawl-delay: 1\n\n";
        
        $robots .= "# Bing Bot\n";
        $robots .= "User-agent: Bingbot\n";
        $robots .= "Allow: /\n";
        $robots .= "Disallow: /admin/\n";
        $robots .= "Disallow: /api/\n";
        $robots .= "Crawl-delay: 1\n\n";
        
        $robots .= "# Yandex Bot\n";
        $robots .= "User-agent: YandexBot\n";
        $robots .= "Allow: /\n";
        $robots .= "Disallow: /admin/\n";
        $robots .= "Disallow: /api/\n";
        $robots .= "Crawl-delay: 2\n\n";
        
        $robots .= "# DuckDuckGo Bot\n";
        $robots .= "User-agent: DuckDuckBot\n";
        $robots .= "Allow: /\n";
        $robots .= "Disallow: /admin/\n";
        $robots .= "Disallow: /api/\n";
        $robots .= "Crawl-delay: 1\n\n";
        
        $robots .= "# Facebook Bot\n";
        $robots .= "User-agent: facebookexternalhit\n";
        $robots .= "Allow: /\n";
        $robots .= "Disallow: /admin/\n";
        $robots .= "Disallow: /api/\n\n";
        
        $robots .= "# Twitter Bot\n";
        $robots .= "User-agent: Twitterbot\n";
        $robots .= "Allow: /\n";
        $robots .= "Disallow: /admin/\n";
        $robots .= "Disallow: /api/\n\n";
        
        $robots .= "# LinkedIn Bot\n";
        $robots .= "User-agent: LinkedInBot\n";
        $robots .= "Allow: /\n";
        $robots .= "Disallow: /admin/\n";
        $robots .= "Disallow: /api/\n\n";
        
        $robots .= "# WhatsApp Bot\n";
        $robots .= "User-agent: WhatsApp\n";
        $robots .= "Allow: /\n";
        $robots .= "Disallow: /admin/\n";
        $robots .= "Disallow: /api/\n\n";
        
        // Bad bots
        $robots .= "# Block malicious bots\n";
        $robots .= "User-agent: AhrefsBot\n";
        $robots .= "Disallow: /\n\n";
        
        $robots .= "User-agent: MJ12bot\n";
        $robots .= "Disallow: /\n\n";
        
        $robots .= "User-agent: DotBot\n";
        $robots .= "Disallow: /\n\n";
        
        $robots .= "User-agent: SemrushBot\n";
        $robots .= "Disallow: /\n\n";
        
        $robots .= "User-agent: BLEXBot\n";
        $robots .= "Disallow: /\n\n";
        
        // Sitemap location
        $robots .= "# Sitemap\n";
        $robots .= "Sitemap: $baseUrl/sitemap.xml\n";
        $robots .= "Sitemap: $baseUrl/sitemap/static.xml\n";
        $robots .= "Sitemap: $baseUrl/sitemap/categories.xml\n";
        $robots .= "Sitemap: $baseUrl/sitemap/packages.xml\n";
        $robots .= "Sitemap: $baseUrl/sitemap/offers.xml\n";
        $robots .= "Sitemap: $baseUrl/sitemap/blogs.xml\n\n";
        
        // Additional information
        $robots .= "# Host\n";
        $robots .= "Host: zuppie.in\n\n";
        
        $robots .= "# Contact Information\n";
        $robots .= "# For questions about this robots.txt file, contact: info@zuppie.in\n";
        $robots .= "# Website: https://zuppie.in\n";
        $robots .= "# Business: Premium Event Management Services in Purnia, Bihar\n";
        
        return $robots;
    }
}
