<?php

namespace App\Helpers;

class SEOHelper
{
    /**
     * Generate meta tags for a page
     */
    public static function generateMeta(array $data = []): string
    {
        $defaultData = [
            'title' => config('seo.site_name'),
            'description' => config('seo.site_description'),
            'keywords' => implode(', ', config('seo.keywords')),
            'image' => config('seo.meta.og.default_image'),
            'url' => request()->url(),
            'type' => 'website',
            'published_time' => null,
            'modified_time' => null,
            'author' => config('seo.author'),
            'section' => null,
            'tags' => [],
            'canonical' => null,
            'robots' => 'index, follow',
            'language' => 'en-IN',
            'region' => 'IN',
        ];

        $meta = array_merge($defaultData, $data);
        
        // Clean and prepare title
        $title = $meta['title'];
        if (!str_contains($title, config('seo.site_name'))) {
            $title .= ' | ' . config('seo.site_name');
        }

        // Generate meta tags
        $metaTags = [];
        
        // Basic Meta Tags
        $metaTags[] = '<title>' . htmlspecialchars($title) . '</title>';
        $metaTags[] = '<meta name="description" content="' . htmlspecialchars($meta['description']) . '">';
        $metaTags[] = '<meta name="keywords" content="' . htmlspecialchars($meta['keywords']) . '">';
        $metaTags[] = '<meta name="author" content="' . htmlspecialchars($meta['author']) . '">';
        $metaTags[] = '<meta name="robots" content="' . $meta['robots'] . '">';
        $metaTags[] = '<meta name="language" content="' . $meta['language'] . '">';
        $metaTags[] = '<meta name="geo.region" content="' . $meta['region'] . '">';
        $metaTags[] = '<meta name="geo.country" content="IN">';
        
        // Google Site Verification
        if (config('seo.meta.google_site_verification')) {
            $metaTags[] = '<meta name="google-site-verification" content="' . config('seo.meta.google_site_verification') . '">';
        }
        
        // Local SEO Meta Tags
        $metaTags[] = '<meta name="geo.placename" content="Purnia, Bihar, India">';
        $metaTags[] = '<meta name="geo.position" content="25.7788;87.4742">';
        $metaTags[] = '<meta name="ICBM" content="25.7788, 87.4742">';
        $metaTags[] = '<meta name="geo.locality" content="Purnia">';
        $metaTags[] = '<meta name="geo.state" content="Bihar">';
        $metaTags[] = '<meta name="geo.postal-code" content="854301">';
        
        // Canonical URL
        $canonical = $meta['canonical'] ?? $meta['url'];
        $metaTags[] = '<link rel="canonical" href="' . htmlspecialchars($canonical) . '">';
        
        // Open Graph Tags
        $metaTags[] = '<meta property="og:title" content="' . htmlspecialchars($title) . '">';
        $metaTags[] = '<meta property="og:description" content="' . htmlspecialchars($meta['description']) . '">';
        $metaTags[] = '<meta property="og:url" content="' . htmlspecialchars($meta['url']) . '">';
        $metaTags[] = '<meta property="og:type" content="' . $meta['type'] . '">';
        $metaTags[] = '<meta property="og:image" content="' . htmlspecialchars($meta['image']) . '">';
        $metaTags[] = '<meta property="og:image:width" content="' . config('seo.meta.og.image_width') . '">';
        $metaTags[] = '<meta property="og:image:height" content="' . config('seo.meta.og.image_height') . '">';
        $metaTags[] = '<meta property="og:site_name" content="' . htmlspecialchars(config('seo.site_name')) . '">';
        $metaTags[] = '<meta property="og:locale" content="en_IN">';
        
        // Twitter Cards
        $metaTags[] = '<meta name="twitter:card" content="' . config('seo.meta.twitter.card') . '">';
        $metaTags[] = '<meta name="twitter:site" content="' . config('seo.twitter_handle') . '">';
        $metaTags[] = '<meta name="twitter:creator" content="' . config('seo.meta.twitter.creator') . '">';
        $metaTags[] = '<meta name="twitter:title" content="' . htmlspecialchars($title) . '">';
        $metaTags[] = '<meta name="twitter:description" content="' . htmlspecialchars($meta['description']) . '">';
        $metaTags[] = '<meta name="twitter:image" content="' . htmlspecialchars($meta['image']) . '">';
        
        // Article specific tags
        if ($meta['type'] === 'article') {
            if ($meta['published_time']) {
                $metaTags[] = '<meta property="article:published_time" content="' . $meta['published_time'] . '">';
            }
            if ($meta['modified_time']) {
                $metaTags[] = '<meta property="article:modified_time" content="' . $meta['modified_time'] . '">';
            }
            if ($meta['section']) {
                $metaTags[] = '<meta property="article:section" content="' . htmlspecialchars($meta['section']) . '">';
            }
            foreach ($meta['tags'] as $tag) {
                $metaTags[] = '<meta property="article:tag" content="' . htmlspecialchars($tag) . '">';
            }
        }
        
        // Additional Meta Tags
        $metaTags[] = '<meta name="format-detection" content="telephone=yes">';
        $metaTags[] = '<meta name="mobile-web-app-capable" content="yes">';
        $metaTags[] = '<meta name="apple-mobile-web-app-capable" content="yes">';
        $metaTags[] = '<meta name="apple-mobile-web-app-status-bar-style" content="default">';
        $metaTags[] = '<meta name="theme-color" content="#8B5CF6">';
        $metaTags[] = '<meta name="msapplication-navbutton-color" content="#8B5CF6">';
        $metaTags[] = '<meta name="apple-mobile-web-app-status-bar-style" content="default">';
        
        // Production-specific optimizations
        if (app()->environment('production')) {
            // DNS Prefetch
            $preconnectDomains = config('seo.production.preconnect_domains', []);
            foreach ($preconnectDomains as $domain) {
                $metaTags[] = '<link rel="preconnect" href="' . $domain . '" crossorigin>';
            }
            
            $dnsPrefetchDomains = config('seo.production.dns_prefetch', []);
            foreach ($dnsPrefetchDomains as $domain) {
                $metaTags[] = '<link rel="dns-prefetch" href="' . $domain . '">';
            }
            
            // Security headers
            $metaTags[] = '<meta http-equiv="X-Content-Type-Options" content="nosniff">';
            $metaTags[] = '<meta http-equiv="X-Frame-Options" content="DENY">';
            $metaTags[] = '<meta http-equiv="X-XSS-Protection" content="1; mode=block">';
            
            // Analytics and tracking
            if (config('app.google_analytics_id')) {
                $metaTags[] = '<!-- Google Analytics -->';
                $metaTags[] = '<script async src="https://www.googletagmanager.com/gtag/js?id=' . config('app.google_analytics_id') . '"></script>';
                $metaTags[] = '<script>
                    window.dataLayer = window.dataLayer || [];
                    function gtag(){dataLayer.push(arguments);}
                    gtag("js", new Date());
                    gtag("config", "' . config('app.google_analytics_id') . '", {
                        page_location: "' . $meta['url'] . '",
                        page_title: "' . htmlspecialchars($title) . '"
                    });
                </script>';
            }
            
            // Google Tag Manager
            if (config('app.google_tag_manager_id')) {
                $metaTags[] = '<!-- Google Tag Manager -->';
                $metaTags[] = '<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({"gtm.start":
                new Date().getTime(),event:"gtm.js"});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!="dataLayer"?"&l="+l:"";j.async=true;j.src=
                "https://www.googletagmanager.com/gtm.js?id="+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,"script","dataLayer","' . config('app.google_tag_manager_id') . '");</script>';
            }
            
            // Facebook Pixel
            if (config('app.facebook_pixel_id')) {
                $metaTags[] = '<!-- Facebook Pixel -->';
                $metaTags[] = '<script>
                    !function(f,b,e,v,n,t,s)
                    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version="2.0";
                    n.queue=[];t=b.createElement(e);t.async=!0;
                    t.src=v;s=b.getElementsByTagName(e)[0];
                    s.parentNode.insertBefore(t,s)}(window, document,"script",
                    "https://connect.facebook.net/en_US/fbevents.js");
                    fbq("init", "' . config('app.facebook_pixel_id') . '");
                    fbq("track", "PageView");
                </script>';
            }
            
            // Microsoft Clarity
            if (config('app.microsoft_clarity_id')) {
                $metaTags[] = '<!-- Microsoft Clarity -->';
                $metaTags[] = '<script type="text/javascript">
                    (function(c,l,a,r,i,t,y){
                        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
                        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
                        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
                    })(window, document, "clarity", "script", "' . config('app.microsoft_clarity_id') . '");
                </script>';
            }
        }
        
        return implode("\n    ", $metaTags);
    }

    /**
     * Generate structured data JSON-LD
     */
    public static function generateStructuredData(string $type, array $data = []): string
    {
        $structuredData = [];
        
        switch ($type) {
            case 'organization':
                $structuredData = self::getOrganizationSchema();
                break;
            case 'website':
                $structuredData = self::getWebsiteSchema();
                break;
            case 'local_business':
                $structuredData = self::getLocalBusinessSchema();
                break;
            case 'event':
                $structuredData = self::getEventSchema($data);
                break;
            case 'product':
                $structuredData = self::getProductSchema($data);
                break;
            case 'review':
                $structuredData = self::getReviewSchema($data);
                break;
            case 'breadcrumb':
                $structuredData = self::getBreadcrumbSchema($data);
                break;
            case 'faq':
                $structuredData = self::getFAQSchema($data);
                break;
        }
        
        return '<script type="application/ld+json">' . json_encode($structuredData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>';
    }

    /**
     * Organization Schema
     */
    private static function getOrganizationSchema(): array
    {
        $org = config('seo.organization');
        
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $org['name'],
            'legalName' => $org['legal_name'],
            'url' => $org['url'],
            'logo' => $org['logo'],
            'description' => $org['description'],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $org['address']['street'],
                'addressLocality' => $org['address']['city'],
                'addressRegion' => $org['address']['state'],
                'postalCode' => $org['address']['postal_code'],
                'addressCountry' => $org['address']['country']
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => $org['contact']['phone'],
                'email' => $org['contact']['email'],
                'contactType' => 'customer support'
            ],
            'sameAs' => [
                config('seo.facebook_url'),
                config('seo.instagram_url'),
                config('seo.twitter_handle'),
                config('seo.linkedin_url'),
                config('seo.youtube_url')
            ]
        ];
    }

    /**
     * Website Schema
     */
    private static function getWebsiteSchema(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => config('seo.site_name'),
            'description' => config('seo.site_description'),
            'url' => config('app.url'),
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => config('app.url') . '/search?q={search_term_string}'
                ],
                'query-input' => 'required name=search_term_string'
            ]
        ];
    }

    /**
     * Local Business Schema
     */
    private static function getLocalBusinessSchema(): array
    {
        $org = config('seo.organization');
        
        return [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => $org['name'],
            'image' => $org['logo'],
            'telephone' => $org['contact']['phone'],
            'email' => $org['contact']['email'],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $org['address']['street'],
                'addressLocality' => $org['address']['city'],
                'addressRegion' => $org['address']['state'],
                'postalCode' => $org['address']['postal_code'],
                'addressCountry' => $org['address']['country']
            ],
            'url' => config('app.url'),
            'openingHours' => array_map(function ($day, $hours) {
                return ucfirst($day) . ' ' . $hours;
            }, array_keys($org['business_hours']), $org['business_hours'])
        ];
    }

    /**
     * Event Schema
     */
    private static function getEventSchema(array $data): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Event',
            'name' => $data['name'] ?? '',
            'description' => $data['description'] ?? '',
            'startDate' => $data['start_date'] ?? '',
            'endDate' => $data['end_date'] ?? '',
            'location' => [
                '@type' => 'Place',
                'name' => $data['location'] ?? '',
                'address' => $data['address'] ?? ''
            ],
            'organizer' => [
                '@type' => 'Organization',
                'name' => config('seo.organization.name'),
                'url' => config('app.url')
            ],
            'offers' => [
                '@type' => 'Offer',
                'url' => $data['url'] ?? '',
                'price' => $data['price'] ?? '',
                'priceCurrency' => 'INR',
                'availability' => 'https://schema.org/InStock'
            ]
        ];
    }

    /**
     * Product Schema
     */
    private static function getProductSchema(array $data): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $data['name'] ?? '',
            'description' => $data['description'] ?? '',
            'image' => $data['image'] ?? '',
            'brand' => [
                '@type' => 'Brand',
                'name' => config('seo.organization.name')
            ],
            'offers' => [
                '@type' => 'Offer',
                'url' => $data['url'] ?? '',
                'price' => $data['price'] ?? '',
                'priceCurrency' => 'INR',
                'availability' => 'https://schema.org/InStock'
            ]
        ];
    }

    /**
     * Review Schema
     */
    private static function getReviewSchema(array $data): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Review',
            'author' => [
                '@type' => 'Person',
                'name' => $data['author'] ?? ''
            ],
            'reviewBody' => $data['body'] ?? '',
            'reviewRating' => [
                '@type' => 'Rating',
                'ratingValue' => $data['rating'] ?? '',
                'bestRating' => 5
            ],
            'itemReviewed' => [
                '@type' => 'Service',
                'name' => $data['service'] ?? ''
            ]
        ];
    }

    /**
     * Breadcrumb Schema
     */
    private static function getBreadcrumbSchema(array $breadcrumbs): array
    {
        $itemListElement = [];
        
        foreach ($breadcrumbs as $index => $breadcrumb) {
            $itemListElement[] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $breadcrumb['name'],
                'item' => $breadcrumb['url']
            ];
        }
        
        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $itemListElement
        ];
    }

    /**
     * FAQ Schema
     */
    private static function getFAQSchema(array $faqs): array
    {
        $mainEntity = [];
        
        foreach ($faqs as $faq) {
            $mainEntity[] = [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['answer']
                ]
            ];
        }
        
        return [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $mainEntity
        ];
    }

    /**
     * Generate hreflang tags
     */
    public static function generateHreflang(string $route, array $parameters = []): string
    {
        if (!config('seo.hreflang.enable')) {
            return '';
        }

        $hreflangTags = [];
        $locales = config('seo.hreflang.supported_locales');
        
        foreach ($locales as $locale => $name) {
            $url = config('app.url') . '/' . $locale . '/' . $route;
            if (!empty($parameters)) {
                $url .= '?' . http_build_query($parameters);
            }
            $hreflangTags[] = '<link rel="alternate" hreflang="' . $locale . '" href="' . $url . '">';
        }
        
        // Add x-default
        $defaultUrl = config('app.url') . '/' . $route;
        if (!empty($parameters)) {
            $defaultUrl .= '?' . http_build_query($parameters);
        }
        $hreflangTags[] = '<link rel="alternate" hreflang="x-default" href="' . $defaultUrl . '">';
        
        return implode("\n    ", $hreflangTags);
    }

    /**
     * Generate pagination meta tags
     */
    public static function generatePaginationMeta(int $currentPage, int $totalPages, string $baseUrl): string
    {
        $tags = [];
        
        if ($currentPage > 1) {
            $prevUrl = $baseUrl . '?page=' . ($currentPage - 1);
            $tags[] = '<link rel="prev" href="' . $prevUrl . '">';
        }
        
        if ($currentPage < $totalPages) {
            $nextUrl = $baseUrl . '?page=' . ($currentPage + 1);
            $tags[] = '<link rel="next" href="' . $nextUrl . '">';
        }
        
        return implode("\n    ", $tags);
    }
}
