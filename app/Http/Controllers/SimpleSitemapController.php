<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Carbon\Carbon;

class SimpleSitemapController extends Controller
{
    /**
     * Generate simple sitemap for testing
     */
    public function index(): Response
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>' . url('/') . '</loc>
        <lastmod>' . Carbon::now()->toISOString() . '</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>' . url('/about') . '</loc>
        <lastmod>' . Carbon::now()->toISOString() . '</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>' . url('/contact') . '</loc>
        <lastmod>' . Carbon::now()->toISOString() . '</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>' . url('/event-packages') . '</loc>
        <lastmod>' . Carbon::now()->toISOString() . '</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
</urlset>';

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
