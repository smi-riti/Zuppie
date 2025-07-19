<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;
use App\Models\EventPackage;
use App\Models\Offer;
use App\Models\Blog;
use Carbon\Carbon;

class SitemapController extends Controller
{
    /**
     * Generate main sitemap index
     */
    public function index(): Response
    {
        $sitemaps = [
            [
                'loc' => route('sitemap.static'),
                'lastmod' => Carbon::now()->toISOString(),
            ],
            [
                'loc' => route('sitemap.categories'),
                'lastmod' => Category::latest('updated_at')->first()?->updated_at?->toISOString() ?? Carbon::now()->toISOString(),
            ],
            [
                'loc' => route('sitemap.packages'),
                'lastmod' => EventPackage::latest('updated_at')->first()?->updated_at?->toISOString() ?? Carbon::now()->toISOString(),
            ],
            [
                'loc' => route('sitemap.offers'),
                'lastmod' => Offer::latest('updated_at')->first()?->updated_at?->toISOString() ?? Carbon::now()->toISOString(),
            ],
            [
                'loc' => route('sitemap.blogs'),
                'lastmod' => Blog::latest('updated_at')->first()?->updated_at?->toISOString() ?? Carbon::now()->toISOString(),
            ],
        ];

        $xml = view('sitemap.index', compact('sitemaps'))->render();
        
        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    /**
     * Generate static pages sitemap
     */
    public function static(): Response
    {
        $cacheKey = 'sitemap.static';
        
        $xml = Cache::remember($cacheKey, config('seo.sitemap.cache_duration'), function () {
            $pages = [
                [
                    'loc' => route('home'),
                    'lastmod' => Carbon::now()->toISOString(),
                    'changefreq' => 'daily',
                    'priority' => '1.0'
                ],
                [
                    'loc' => route('about'),
                    'lastmod' => Carbon::now()->toISOString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.5'
                ],
                [
                    'loc' => route('contact'),
                    'lastmod' => Carbon::now()->toISOString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.5'
                ],
                [
                    'loc' => route('event-packages'),
                    'lastmod' => Carbon::now()->toISOString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.9'
                ],
                [
                    'loc' => route('booking'),
                    'lastmod' => Carbon::now()->toISOString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.8'
                ],
                [
                    'loc' => route('reviews.add'),
                    'lastmod' => Carbon::now()->toISOString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.6'
                ],
            ];

            return view('sitemap.urlset', compact('pages'))->render();
        });

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    /**
     * Generate categories sitemap
     */
    public function categories(): Response
    {
        $cacheKey = 'sitemap.categories';
        
        $xml = Cache::remember($cacheKey, config('seo.sitemap.cache_duration'), function () {
            $categories = Category::select('id', 'slug', 'updated_at')
                ->where('is_active', true)
                ->orderBy('updated_at', 'desc')
                ->get();

            $pages = $categories->map(function ($category) {
                return [
                    'loc' => route('category.show', $category->slug),
                    'lastmod' => $category->updated_at->toISOString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.8'
                ];
            })->toArray();

            return view('sitemap.urlset', compact('pages'))->render();
        });

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    /**
     * Generate event packages sitemap
     */
    public function packages(): Response
    {
        $cacheKey = 'sitemap.packages';
        
        $xml = Cache::remember($cacheKey, config('seo.sitemap.cache_duration'), function () {
            $packages = EventPackage::select('id', 'slug', 'updated_at')
                ->where('is_active', true)
                ->orderBy('updated_at', 'desc')
                ->get();

            $pages = $packages->map(function ($package) {
                return [
                    'loc' => route('package-detail', $package->id),
                    'lastmod' => $package->updated_at->toISOString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.9'
                ];
            })->toArray();

            return view('sitemap.urlset', compact('pages'))->render();
        });

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    /**
     * Generate offers sitemap
     */
    public function offers(): Response
    {
        $cacheKey = 'sitemap.offers';
        
        $xml = Cache::remember($cacheKey, config('seo.sitemap.cache_duration'), function () {
            $offers = Offer::select('id', 'slug', 'updated_at')
                ->where('is_active', true)
                ->where('valid_until', '>=', Carbon::now())
                ->orderBy('updated_at', 'desc')
                ->get();

            $pages = $offers->map(function ($offer) {
                return [
                    'loc' => route('offer.show', $offer->slug),
                    'lastmod' => $offer->updated_at->toISOString(),
                    'changefreq' => 'daily',
                    'priority' => '0.7'
                ];
            })->toArray();

            return view('sitemap.urlset', compact('pages'))->render();
        });

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    /**
     * Generate blogs sitemap
     */
    public function blogs(): Response
    {
        $cacheKey = 'sitemap.blogs';
        
        $xml = Cache::remember($cacheKey, config('seo.sitemap.cache_duration'), function () {
            $blogs = Blog::select('id', 'slug', 'updated_at')
                ->where('is_published', true)
                ->orderBy('updated_at', 'desc')
                ->get();

            $pages = $blogs->map(function ($blog) {
                return [
                    'loc' => route('blog.show', $blog->slug),
                    'lastmod' => $blog->updated_at->toISOString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.6'
                ];
            })->toArray();

            return view('sitemap.urlset', compact('pages'))->render();
        });

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
