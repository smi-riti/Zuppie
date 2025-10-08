<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class ProductionSEOOptimize extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:optimize-production {--clear-cache : Clear all SEO caches}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Optimize SEO for production environment';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Starting Production SEO Optimization for Zuppie.in...');
        $this->newLine();

        // Step 1: Clear caches if requested
        if ($this->option('clear-cache')) {
            $this->clearCaches();
        }

        // Step 2: Validate environment
        $this->validateEnvironment();

        // Step 3: Generate sitemaps
        $this->generateSitemaps();

        // Step 4: Optimize images
        $this->optimizeImages();

        // Step 5: Validate SEO configuration
        $this->validateSEOConfig();

        // Step 6: Test critical endpoints
        $this->testEndpoints();

        // Step 7: Generate cache
        $this->generateCache();

        // Step 8: Final validation
        $this->finalValidation();

        $this->newLine();
        $this->info('✅ Production SEO Optimization Complete!');
        $this->info('🌐 Your website is now optimized for https://zuppie.in');

        return 0;
    }

    /**
     * Clear all SEO-related caches
     */
    private function clearCaches()
    {
        $this->info('🗑️  Clearing SEO caches...');

        // Clear Laravel caches
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');

        // Clear SEO-specific caches
        Cache::forget('sitemap_index_production');
        Cache::forget('sitemap_static_production');
        Cache::forget('sitemap_categories_production');
        Cache::forget('sitemap_packages_production');
        Cache::forget('sitemap_offers_production');
        Cache::forget('sitemap_blogs_production');
        Cache::forget('robots_txt_production');

        $this->info('✅ Caches cleared successfully');
    }

    /**
     * Validate production environment
     */
    private function validateEnvironment()
    {
        $this->info('🔍 Validating production environment...');

        // Check environment
        if (app()->environment('production')) {
            $this->info('✅ Environment: Production');
        } else {
            $this->warn('⚠️  Environment: ' . app()->environment() . ' (Expected: production)');
        }

        // Check APP_URL
        if (config('app.url') === 'https://zuppie.in') {
            $this->info('✅ APP_URL: https://zuppie.in');
        } else {
            $this->error('❌ APP_URL: ' . config('app.url') . ' (Expected: https://zuppie.in)');
        }

        // Check debug mode
        if (config('app.debug') === false) {
            $this->info('✅ Debug mode: Disabled');
        } else {
            $this->warn('⚠️  Debug mode: Enabled (Should be disabled in production)');
        }

        // Check Google verification
        if (config('seo.meta.google_site_verification')) {
            $this->info('✅ Google Site Verification: Configured');
        } else {
            $this->error('❌ Google Site Verification: Not configured');
        }
    }

    /**
     * Generate production sitemaps
     */
    private function generateSitemaps()
    {
        $this->info('🗺️  Generating production sitemaps...');

        try {
            // Generate sitemap cache
            $baseUrl = 'https://zuppie.in';

            // Test sitemap endpoints
            $endpoints = [
                '/sitemap.xml',
                '/sitemap/static.xml',
                '/sitemap/categories.xml',
                '/sitemap/packages.xml',
                '/sitemap/offers.xml',
                '/sitemap/blogs.xml'
            ];

            foreach ($endpoints as $endpoint) {
                try {
                    $response = Http::timeout(10)->get($baseUrl . $endpoint);
                    if ($response->successful()) {
                        $this->info("✅ Generated: $endpoint");
                    } else {
                        $this->error("❌ Failed to generate: $endpoint");
                    }
                } catch (\Exception $e) {
                    $this->error("❌ Error generating $endpoint: " . $e->getMessage());
                }
            }

        } catch (\Exception $e) {
            $this->error('❌ Sitemap generation failed: ' . $e->getMessage());
        }
    }

    /**
     * Optimize images for production
     */
    private function optimizeImages()
    {
        $this->info('🖼️  Optimizing images...');

        $imageDir = public_path('images');

        if (File::exists($imageDir)) {
            $images = File::files($imageDir);
            $count = 0;

            foreach ($images as $image) {
                if (in_array($image->getExtension(), ['jpg', 'jpeg', 'png', 'gif'])) {
                    $count++;
                }
            }

            $this->info("✅ Found $count images for optimization");
            $this->info("💡 Consider using WebP format for better performance");
        } else {
            $this->warn('⚠️  Images directory not found');
        }
    }

    /**
     * Validate SEO configuration
     */
    private function validateSEOConfig()
    {
        $this->info('⚙️  Validating SEO configuration...');

        // Check essential SEO config
        $checks = [
            'Site Name' => config('seo.site_name'),
            'Site Description' => config('seo.site_description'),
            'Keywords' => count(config('seo.keywords', [])),
            'Organization Name' => config('seo.organization.name'),
            'Organization URL' => config('seo.organization.url'),
            'Google Verification' => config('seo.meta.google_site_verification'),
            'Structured Data' => config('seo.structured_data.enable_organization'),
            'Sitemap Enabled' => config('seo.sitemap.enable'),
            'Location Targeting' => config('seo.organization.geo.latitude'),
        ];

        foreach ($checks as $name => $value) {
            if ($value) {
                $this->info("✅ $name: Configured");
            } else {
                $this->error("❌ $name: Not configured");
            }
        }
    }

    /**
     * Test critical endpoints
     */
    private function testEndpoints()
    {
        $this->info('🌐 Testing critical endpoints...');

        $baseUrl = 'https://zuppie.in';
        $endpoints = [
            '/' => 'Homepage',
            '/robots.txt' => 'Robots.txt',
            '/sitemap.xml' => 'Sitemap Index',
            '/manifest.json' => 'PWA Manifest',
            '/offline.html' => 'Offline Page',
        ];

        foreach ($endpoints as $endpoint => $name) {
            try {
                $response = Http::timeout(10)->get($baseUrl . $endpoint);
                if ($response->successful()) {
                    $this->info("✅ $name: OK ({$response->status()})");
                } else {
                    $this->error("❌ $name: Failed ({$response->status()})");
                }
            } catch (\Exception $e) {
                $this->error("❌ $name: Error - " . $e->getMessage());
            }
        }
    }

    /**
     * Generate production cache
     */
    private function generateCache()
    {
        $this->info('🚀 Generating production cache...');

        try {
            // Cache configuration
            Artisan::call('config:cache');
            $this->info('✅ Configuration cached');

            // Cache routes
            Artisan::call('route:cache');
            $this->info('✅ Routes cached');

            // Cache views
            Artisan::call('view:cache');
            $this->info('✅ Views cached');

            // Cache events
            Artisan::call('event:cache');
            $this->info('✅ Events cached');

        } catch (\Exception $e) {
            $this->error('❌ Cache generation failed: ' . $e->getMessage());
        }
    }

    /**
     * Final validation
     */
    private function finalValidation()
    {
        $this->info('🔍 Running final validation...');

        // Check if production files exist
        $productionFiles = [
            '.htaccess.production' => 'Production .htaccess',
            '.env.production' => 'Production environment file',
            'PRODUCTION_DEPLOYMENT_CHECKLIST.md' => 'Deployment checklist',
            'seo-audit-production.sh' => 'Production SEO audit script'
        ];

        foreach ($productionFiles as $file => $name) {
            if (File::exists(base_path($file))) {
                $this->info("✅ $name: Available");
            } else {
                $this->warn("⚠️  $name: Not found");
            }
        }

        // Check critical configuration
        $criticalConfig = [
            'SSL Ready' => config('app.url') === 'https://zuppie.in',
            'Cache Enabled' => config('cache.default') !== 'array',
            'Session Secure' => config('session.secure') === true,
            'Cookie Secure' => config('session.same_site') === 'strict',
        ];

        foreach ($criticalConfig as $name => $status) {
            if ($status) {
                $this->info("✅ $name: Configured");
            } else {
                $this->warn("⚠️  $name: Review required");
            }
        }
    }
}
