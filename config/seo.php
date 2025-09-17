<?php

return [
    /*
    |--------------------------------------------------------------------------
    | SEO Configuration
    |--------------------------------------------------------------------------
    |
    | Enterprise-level SEO configuration for Zuppie
    |
    */

    'site_name' => 'Zuppie - Premium Event Management & Birthday Celebrations in Purnia, Bihar',
    'site_description' => 'Leading event planning company in Purnia, Bihar specializing in premium birthday celebrations, anniversary decorations, and affordable party packages. Transform your special moments into magical memories with our professional event management services across Bihar and Eastern India.',
    'keywords' => [
        // Primary Local Keywords
        'event planning Purnia', 'birthday celebrations Purnia Bihar', 'anniversary decorations Purnia', 'festival events Bihar',
        'premium event management Purnia', 'party planning Bihar', 'decoration services Purnia', 'event packages Bihar',
        'birthday party planner Purnia', 'event organizer Bihar', 'celebration planning Purnia', 'special occasions Bihar',
        
        // Service-Specific Keywords
        'wedding anniversary Purnia', 'baby shower Bihar', 'haldi mehndi Purnia', 'corporate events Bihar', 'luxury events Purnia',
        'theme parties Purnia', 'balloon decorations Bihar', 'flower arrangements Purnia', 'photography services Bihar',
        'catering services Purnia', 'venue booking Bihar', 'event coordination Purnia', 'party supplies Bihar',
        
        // Location-Specific Keywords
        'Purnia event management', 'Bihar party decorations', 'Purnia celebration services', 'Bihar event planning',
        'Purnia birthday decorations', 'Bihar anniversary planning', 'Purnia festival events', 'Bihar wedding planning',
        'Araria event planning', 'Kishanganj party services', 'Katihar celebrations', 'Madhepura events',
        'Saharsa party planning', 'Supaul event management', 'Darbhanga celebrations', 'Muzaffarpur events',
        
        // Business Keywords
        'professional event planners', 'event management company', 'party decorators', 'celebration experts',
        'event design services', 'custom party themes', 'event consultation', 'party entertainment',
        'zuppie.in', 'zuppie events', 'zuppie party planners', 'zuppie Bihar'
    ],
    'author' => 'Zuppie Events',
    'twitter_handle' => '@ZuppieEvents',
    'facebook_url' => 'https://facebook.com/ZuppieEvents',
    'instagram_url' => 'https://instagram.com/ZuppieEvents',
    'linkedin_url' => 'https://linkedin.com/company/zuppie-events',
    'youtube_url' => 'https://youtube.com/ZuppieEvents',
    
    'organization' => [
        'name' => 'Zuppie Events Purnia',
        'legal_name' => 'Zuppie Event Management Private Limited',
        'url' => 'https://zuppie.in',
        'logo' => 'https://zuppie.in/images/logo.jpeg',
        'description' => 'Premium event management and celebration planning services in Purnia, Bihar and across Eastern India. Specializing in birthdays, anniversaries, corporate events, and luxury celebrations.',
        'address' => [
            'street' => 'Near Argra Chowk ,Madhubani Bazaar Purnia',
            'city' => 'Purnia',
            'state' => 'Bihar',
            'postal_code' => '854301',
            'country' => 'India'
        ],
        'contact' => [
            'phone' => '+91 70223 23470',
            'email' => 'info@zuppie.in',
            'customer_service' => 'zuppiepurnea@gmail.com'
        ],
        'business_hours' => [
            'monday' => '09:00-18:00',
            'tuesday' => '09:00-18:00',
            'wednesday' => '09:00-18:00',
            'thursday' => '09:00-18:00',
            'friday' => '09:00-18:00',
            'saturday' => '09:00-16:00',
            'sunday' => '10:00-16:00'
        ],
        'geo' => [
            'latitude' => 25.7771,
            'longitude' => 87.4753,
            'address' => 'Near Purnia Court, Line Bazar, Purnia, Bihar 854301, India'
        ],
        'services' => [
            'Birthday Celebrations',
            'Anniversary Decorations',
            'Corporate Events',
            'Wedding Planning',
            'Festival Celebrations',
            'Theme Parties',
            'Balloon Decorations',
            'Photography Services',
            'Catering Services',
            'Venue Booking'
        ],
        'service_areas' => [
            'Purnia', 'Araria', 'Kishanganj', 'Katihar', 'Madhepura', 'Saharsa', 'Supaul', 'Darbhanga', 'Muzaffarpur', 'Patna'
        ]
    ],

    'meta' => [
        'google_site_verification' => 'Zz0DsylMiWrdm3JmPGU-dYP7fls1PEn4z1lF9aix62U',
        'robots' => [
            'index' => true,
            'follow' => true,
            'noarchive' => false,
            'nosnippet' => false,
            'noimageindex' => false,
        ],
        'og' => [
            'default_image' => 'https://zuppie.in/images/og-default.jpg',
            'image_width' => 1200,
            'image_height' => 630,
        ],
        'twitter' => [
            'card' => 'summary_large_image',
            'site' => '@ZuppieEvents',
            'creator' => '@ZuppieEvents',
        ]
    ],

    // Production SEO Enhancements
    'production' => [
        'canonical_url' => 'https://zuppie.in',
        'ssl_enabled' => true,
        'www_redirect' => true, // Redirect www to non-www
        'trailing_slash' => false,
        'preconnect_domains' => [
            'https://fonts.googleapis.com',
            'https://fonts.gstatic.com',
            'https://ik.imagekit.io',
            'https://www.google-analytics.com',
            'https://www.googletagmanager.com'
        ],
        'dns_prefetch' => [
            '//fonts.googleapis.com',
            '//fonts.gstatic.com',
            '//ik.imagekit.io',
            '//www.google-analytics.com'
        ]
    ],

    'structured_data' => [
        'enable_breadcrumbs' => true,
        'enable_organization' => true,
        'enable_website' => true,
        'enable_local_business' => true,
        'enable_events' => true,
        'enable_products' => true,
        'enable_reviews' => true,
        'enable_faq' => true,
    ],

    'sitemap' => [
        'enable' => true,
        'cache_duration' => 3600, // 1 hour
        'max_urls_per_sitemap' => 50000,
        'priority' => [
            'home' => 1.0,
            'categories' => 0.8,
            'event_packages' => 0.9,
            'offers' => 0.7,
            'reviews' => 0.6,
            'about' => 0.5,
            'contact' => 0.5,
        ],
        'changefreq' => [
            'home' => 'daily',
            'categories' => 'weekly',
            'event_packages' => 'weekly',
            'offers' => 'daily',
            'reviews' => 'weekly',
            'about' => 'monthly',
            'contact' => 'monthly',
        ]
    ],

    'hreflang' => [
        'enable' => true,
        'supported_locales' => [
            'en-IN' => 'English (India)',
            'hi-IN' => 'Hindi (India)',
            'mr-IN' => 'Marathi (India)',
            'gu-IN' => 'Gujarati (India)',
            'ta-IN' => 'Tamil (India)',
            'te-IN' => 'Telugu (India)',
            'kn-IN' => 'Kannada (India)',
            'bn-IN' => 'Bengali (India)',
        ],
        'default' => 'en-IN',
    ]
];
