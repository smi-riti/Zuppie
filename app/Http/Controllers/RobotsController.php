<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class RobotsController extends Controller
{
    /**
     * Generate robots.txt
     */
    public function index(): Response
    {
        $robots = [
            'User-agent: *',
            'Allow: /',
            '',
            '# Disallow admin and private areas',
            'Disallow: /admin/',
            'Disallow: /login',
            'Disallow: /register',
            'Disallow: /forgot-password',
            'Disallow: /reset-password',
            'Disallow: /api/',
            'Disallow: /*.json$',
            'Disallow: /storage/',
            'Disallow: /vendor/',
            '',
            '# Allow important files',
            'Allow: /images/',
            'Allow: /css/',
            'Allow: /js/',
            'Allow: /build/',
            '',
            '# Crawl delay',
            'Crawl-delay: 1',
            '',
            '# Sitemap',
            'Sitemap: ' . route('sitemap.index'),
            '',
            '# Special rules for search engines',
            'User-agent: Googlebot',
            'Crawl-delay: 0',
            '',
            'User-agent: Bingbot',
            'Crawl-delay: 1',
            '',
            'User-agent: Slurp',
            'Crawl-delay: 1',
            '',
            'User-agent: DuckDuckBot',
            'Crawl-delay: 1',
            '',
            '# Block spam bots',
            'User-agent: SemrushBot',
            'Disallow: /',
            '',
            'User-agent: AhrefsBot',
            'Disallow: /',
            '',
            'User-agent: MJ12bot',
            'Disallow: /',
            '',
            'User-agent: DotBot',
            'Disallow: /',
        ];

        $content = implode("\n", $robots);

        return response($content, 200, [
            'Content-Type' => 'text/plain; charset=utf-8',
            'Cache-Control' => 'public, max-age=86400', // 24 hours
        ]);
    }
}
