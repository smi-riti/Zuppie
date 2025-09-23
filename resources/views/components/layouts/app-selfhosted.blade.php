<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" prefix="og: http://ogp.me/ns#">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="theme-color" content="#A855F7">
    <meta name="msapplication-navbutton-color" content="#A855F7">
    <meta name="apple-mobile-web-app-title" content="Zuppie">
    <meta name="application-name" content="Zuppie">
    <meta name="msapplication-TileColor" content="#A855F7">
    <meta name="msapplication-config" content="/browserconfig.xml">
    
    <!-- Restrictive CSP for self-hosted resources only -->
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://www.googletagmanager.com https://www.google-analytics.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; img-src 'self' data: https: blob: https://ik.imagekit.io; font-src 'self' https://fonts.gstatic.com; connect-src 'self' https://ik.imagekit.io https://www.google-analytics.com; media-src 'self'; object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'none';">
    
    <!-- Use Tailwind CDN as fallback with local build -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SEO Meta Tags -->
    @if(isset($seoData))
        {!! App\Helpers\SEOHelper::generateMeta($seoData) !!}
    @else
        {!! App\Helpers\SEOHelper::generateMeta() !!}
    @endif

    <!-- Preconnect only to essential domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://ik.imagekit.io">

    <!-- DNS Prefetch for essential services -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//ik.imagekit.io">

    <!-- Favicon and Icons -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#A855F7">

    <!-- Structured Data -->
    @if(config('seo.structured_data.enable_organization'))
        {!! App\Helpers\SEOHelper::generateStructuredData('organization') !!}
    @endif

    @if(config('seo.structured_data.enable_website'))
        {!! App\Helpers\SEOHelper::generateStructuredData('website') !!}
    @endif

    @if(config('seo.structured_data.enable_local_business'))
        {!! App\Helpers\SEOHelper::generateStructuredData('local_business') !!}
    @endif

    @if(isset($structuredData))
        @foreach($structuredData as $type => $data)
            {!! App\Helpers\SEOHelper::generateStructuredData($type, $data) !!}
        @endforeach
    @endif

    <!-- Hreflang Tags -->
    @if(isset($hreflangRoute))
        {!! App\Helpers\SEOHelper::generateHreflang($hreflangRoute, $hreflangParams ?? []) !!}
    @endif

    <!-- Pagination Meta Tags -->
    @if(isset($paginationMeta))
        {!! App\Helpers\SEOHelper::generatePaginationMeta($paginationMeta['current'], $paginationMeta['total'], $paginationMeta['base_url']) !!}
    @endif

    <!-- Self-hosted Google Fonts with fallback -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap">
    </noscript>
    
    @livewireStyles

    <!-- Self-hosted Font Awesome -->
    <link rel="stylesheet" href="/vendor/css/fontawesome.min.css">

    <!-- Self-hosted AOS Animation Library -->
    <link rel="stylesheet" href="/vendor/css/aos.css">

    <!-- Critical CSS for performance -->
    <style>
        /* Critical CSS */
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #a855f7 0%, #ec4899 100%);
        }

        .gradient-text {
            background: linear-gradient(135deg, #a855f7 0%, #ec4899 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>

    <!-- Non-critical CSS -->
    <style>
        /* Loading optimization */
        [x-cloak] {
            display: none !important;
        }

        /* Lazy loading placeholder */
        img[data-src] {
            filter: blur(5px);
            transition: filter 0.3s;
        }

        img[data-src].loaded {
            filter: blur(0);
        }
    </style>
    <style>
        /* Non-critical animations and effects */
        .hover-scale {
            transition: transform 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        @keyframes sparkle {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.5;
                transform: scale(1.2);
            }
        }

        .sparkle {
            animation: sparkle 2s ease-in-out infinite;
        }

        /* Enhanced Floating Animations */
        @keyframes float {
            0% {
                transform: translateY(0px) rotate(0deg);
            }

            33% {
                transform: translateY(-30px) rotate(-2deg);
            }

            66% {
                transform: translateY(-20px) rotate(2deg);
            }

            100% {
                transform: translateY(0px) rotate(0deg);
            }
        }

        @keyframes float-slow {
            0% {
                transform: translateY(0px) rotate(0deg);
            }

            33% {
                transform: translateY(-25px) rotate(1deg);
            }

            66% {
                transform: translateY(-15px) rotate(-1deg);
            }

            100% {
                transform: translateY(0px) rotate(0deg);
            }
        }

        @keyframes float-slower {
            0% {
                transform: translateY(0px) rotate(0deg);
            }

            33% {
                transform: translateY(-20px) rotate(-1deg);
            }

            66% {
                transform: translateY(-10px) rotate(1deg);
            }

            100% {
                transform: translateY(0px) rotate(0deg);
            }
        }

        @keyframes float-gentle {
            0% {
                transform: translateY(0px) translateX(0px) rotate(0deg);
            }

            25% {
                transform: translateY(-15px) translateX(5px) rotate(1deg);
            }

            50% {
                transform: translateY(-10px) translateX(-3px) rotate(-0.5deg);
            }

            75% {
                transform: translateY(-20px) translateX(2px) rotate(0.5deg);
            }

            100% {
                transform: translateY(0px) translateX(0px) rotate(0deg);
            }
        }

        .animate-float {
            animation: float 4s ease-in-out infinite;
        }

        .animate-float-slow {
            animation: float-slow 6s ease-in-out infinite;
        }

        .animate-float-slower {
            animation: float-slower 8s ease-in-out infinite;
        }

        .animate-float-gentle {
            animation: float-gentle 10s ease-in-out infinite;
        }

        /* Typing Animation */
        @keyframes typing {
            from {
                width: 0;
            }

            to {
                width: 100%;
            }
        }

        @keyframes blink {
            50% {
                border-color: transparent;
            }
        }

        .typewriter {
            overflow: hidden;
            border-right: 2px solid;
            white-space: nowrap;
            animation: typing 2s steps(40, end), blink 1s step-end infinite;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {

            .animate-float,
            .animate-float-slow,
            .animate-float-slower {
                animation-duration: 4s;
            }
        }

        /* Performance optimizations */
        .will-change-transform {
            will-change: transform;
        }

        .will-change-auto {
            will-change: auto;
        }

        /* Lazy loading styles */
        .lazy-load {
            opacity: 0;
            transition: opacity 0.3s;
        }

        .lazy-load.loaded {
            opacity: 1;
        }
    </style>
</head>

<body class="bg-gray-50 overflow-x-hidden">
    <livewire:public.section.header />
    {{ $slot }}
    <livewire:public.section.footer />
    @livewireScripts
    
    <!-- Self-hosted JavaScript -->
    <script src="/vendor/js/aos.js" defer></script>
    <script src="/vendor/js/confetti.js" defer></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize AOS with error handling
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    easing: 'ease-in-out',
                    once: true,
                    mirror: false,
                    offset: 120,
                    delay: 0,
                    anchorPlacement: 'top-bottom'
                });
            } else {
                console.log('AOS not loaded - animations disabled');
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Smooth scrolling
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
            
            // Parallax effect
            let ticking = false;
            function updateParallax() {
                const scrolled = window.pageYOffset;
                const parallax = document.querySelector('.parallax-bg');
                if (parallax) {
                    const speed = scrolled * 0.5;
                    parallax.style.transform = `translateY(${speed}px)`;
                }
                ticking = false;
            }

            window.addEventListener('scroll', function () {
                if (!ticking) {
                    requestAnimationFrame(updateParallax);
                    ticking = true;
                }
            });

            // Lazy loading for images
            const images = document.querySelectorAll('img[data-src]');
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy-load');
                        img.classList.add('loaded');
                        observer.unobserve(img);
                    }
                });
            });

            images.forEach(img => {
                img.classList.add('lazy-load');
                imageObserver.observe(img);
            });

            // Package slider
            let currentSlide = 0;
            const slides = document.querySelectorAll('.package-slide');
            const totalSlides = slides.length;

            function nextSlide() {
                if (slides.length > 0) {
                    slides[currentSlide].classList.add('translate-x-full');
                    slides[currentSlide].classList.remove('translate-x-0');
                    currentSlide = (currentSlide + 1) % totalSlides;
                    slides[currentSlide].classList.remove('translate-x-full');
                    slides[currentSlide].classList.add('translate-x-0');
                }
            }

            if (totalSlides > 0) {
                setInterval(nextSlide, 5000);
            }

            // Performance monitoring
            if ('performance' in window && 'measure' in performance) {
                performance.mark('zuppie-load-start');
                window.addEventListener('load', function () {
                    performance.mark('zuppie-load-end');
                    performance.measure('zuppie-load-time', 'zuppie-load-start', 'zuppie-load-end');
                });
            }

            // Service Worker registration with better error handling
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', () => {
                    navigator.serviceWorker.register('/sw.js')
                        .then(registration => {
                            console.log('SW registered successfully:', registration.scope);

                            // Handle service worker updates
                            registration.addEventListener('updatefound', () => {
                                const newWorker = registration.installing;
                                if (newWorker) {
                                    newWorker.addEventListener('statechange', () => {
                                        if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
                                            console.log('New service worker available');
                                            newWorker.postMessage({ type: 'SKIP_WAITING' });
                                        }
                                    });
                                }
                            });

                            navigator.serviceWorker.addEventListener('controllerchange', () => {
                                console.log('Service worker controller changed');
                                window.location.reload();
                            });
                        })
                        .catch(error => {
                            console.warn('SW registration failed:', error);
                        });
                });
            }

            // Global error handler for unhandled promises
            window.addEventListener('unhandledrejection', function (event) {
                if (event.reason && event.reason.message &&
                    event.reason.message.includes('message port closed')) {
                    event.preventDefault();
                    return;
                }
            });
        });

        // Google Analytics
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-PCX15ZTQQ3');
    </script>

    @if(config('app.env') === 'production')
        <script>
            // Enhanced ecommerce tracking
            gtag('config', 'G-PCX15ZTQQ3', {
                page_title: document.title,
                page_location: window.location.href,
                anonymize_ip: true,
                cookie_flags: 'SameSite=None;Secure',
                custom_map: {
                    'custom_dimension_1': 'event_type',
                    'custom_dimension_2': 'package_category',
                    'custom_dimension_3': 'location'
                }
            });

            gtag('event', 'page_view', {
                page_title: document.title,
                page_location: window.location.href,
                custom_parameter: 'zuppie_visit'
            });
        </script>
    @endif

    <!-- Schema.org for breadcrumbs -->
    @if(isset($breadcrumbs) && count($breadcrumbs) > 0)
        {!! App\Helpers\SEOHelper::generateStructuredData('breadcrumb', $breadcrumbs) !!}
    @endif
</body>

</html>