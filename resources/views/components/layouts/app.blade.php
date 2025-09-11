
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
    
    <!-- SEO Meta Tags -->
    @if(isset($seoData))
        {!! App\Helpers\SEOHelper::generateMeta($seoData) !!}
    @else
        {!! App\Helpers\SEOHelper::generateMeta() !!}
    @endif
    
    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://unpkg.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    
    <!-- DNS Prefetch -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="//unpkg.com">
    <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
    
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

    
    <!-- Performance and Resource Hints -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap"></noscript>
    
    <!-- tailwind script  -->
        <script src="https://cdn.tailwindcss.com"></script>
    <!-- Custom CSS -->
    <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
    
    <!-- Livewire Styles -->
    @livewireStyles

    <!-- Font Awesome for Icons -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></noscript>

    <!-- AOS Animation Library -->
    <link rel="preload" href="https://unpkg.com/aos@2.3.1/dist/aos.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css"></noscript>

    <!-- Preload JavaScript -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js" as="script">
    <link rel="preload" href="https://unpkg.com/aos@2.3.1/dist/aos.js" as="script">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/chart.js" as="script">
    
    <!-- Critical CSS for performance -->
    <style>
        /* Critical CSS */
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #a855f7 0%, #ec4899 100%); }
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
        [x-cloak] { display: none !important; }
        
        /* Lazy loading placeholder */
        img[data-src] {
            filter: blur(5px);
            transition: filter 0.3s;
        }
        img[data-src].loaded {
            filter: blur(0);
        }
    </style>

    <!-- Excitement Confetti Script -->
    <script>
        // Optimized confetti function
        function fireConfetti() {
            if (typeof confetti === 'undefined') return;
            
            const duration = 3000;
            const animationEnd = Date.now() + duration;
            const defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 9999 };

            function randomInRange(min, max) {
                return Math.random() * (max - min) + min;
            }

            const interval = setInterval(function () {
                const timeLeft = animationEnd - Date.now();

                if (timeLeft <= 0) {
                    return clearInterval(interval);
                }

                const particleCount = 50 * (timeLeft / duration);

                // Front confetti
                confetti({
                    ...defaults,
                    particleCount,
                    origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 }
                });

                // Back confetti
                confetti({
                    ...defaults,
                    particleCount,
                    origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 }
                });
            }, 250);
        }

        // Listen for Livewire success events
        document.addEventListener('livewire:initialized', () => {
            if (typeof Livewire !== 'undefined') {
                Livewire.on('reviewSubmitted', () => {
                    fireConfetti();
                });
            }
        });
    </script>

    <!-- Load Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom Styles -->
    <style>
        /* Non-critical animations and effects */
        .hover-scale {
            transition: transform 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        @keyframes sparkle {
            0%, 100% {
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
    
    <!-- Livewire Scripts -->
    @livewireScripts
    
    <!-- AOS Animation Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>
    
    <!-- Canvas Confetti -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js" defer></script>

    <!-- Initialize AOS -->
    <script>
        // Optimized AOS initialization
        document.addEventListener('DOMContentLoaded', function() {
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
            }
        });
    </script>

    <!-- Enhanced Custom JavaScript -->
    <script>
        // Critical performance optimizations
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scrolling for anchor links
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

            // Optimized parallax effect
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

            window.addEventListener('scroll', function() {
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

            // Auto-swipe functionality for packages
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

            // Auto-swipe every 5 seconds
            if (totalSlides > 0) {
                setInterval(nextSlide, 5000);
            }

            // Performance monitoring
            if ('performance' in window && 'measure' in performance) {
                performance.mark('zuppie-load-start');
                window.addEventListener('load', function() {
                    performance.mark('zuppie-load-end');
                    performance.measure('zuppie-load-time', 'zuppie-load-start', 'zuppie-load-end');
                });
            }

            // Service Worker registration for PWA
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('/sw.js')
                    .then(registration => {
                        console.log('SW registered: ', registration);
                    })
                    .catch(registrationError => {
                        console.log('SW registration failed: ', registrationError);
                    });
            }
        });

        // Critical resource hints
        function preloadCriticalResources() {
            const criticalResources = [
                '/images/hero-bg.jpg',
                '/images/logo.png'
            ];

            criticalResources.forEach(resource => {
                const link = document.createElement('link');
                link.rel = 'preload';
                link.href = resource;
                link.as = 'image';
                document.head.appendChild(link);
            });
        }

        // Execute preload on page load
        document.addEventListener('DOMContentLoaded', preloadCriticalResources);
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PCX15ZTQQ3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-PCX15ZTQQ3');
    </script>

    <!-- Enhanced Analytics for Production -->
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
        
        // Track key events
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
