<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class GenerateSitemapCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate and cache sitemaps for better SEO';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating sitemaps...');

        // Clear existing sitemap cache
        Cache::forget('sitemap.static');
        Cache::forget('sitemap.categories');
        Cache::forget('sitemap.packages');
        Cache::forget('sitemap.offers');
        Cache::forget('sitemap.blogs');

        // Generate each sitemap by calling the controller methods
        $this->call('route:cache');
        
        $this->info('Sitemaps generated and cached successfully!');
    }
}
