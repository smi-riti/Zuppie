
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Zuppie - Magical Event Management for Birthday Celebrations and Special Events">
        
        <title>{{ $title ?? 'Zuppie - Magical Events & Birthday Celebrations' }}</title>
        
        <!-- Tailwind CSS -->
         @vite('resources/css/app.css')
        
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        
        <!-- Font Awesome for Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <!-- AOS Animation Library -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        
        <!-- Custom Styles -->
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
            
            .gradient-bg {
                background: linear-gradient(135deg, #8B5CF6 0%, #EC4899 100%);
            }
            
            .gradient-text {
                background: linear-gradient(135deg, #8B5CF6 0%, #EC4899 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            
            .glass-effect {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            
            .hover-scale {
                transition: transform 0.3s ease;
            }
            
            .hover-scale:hover {
                transform: scale(1.05);
            }
            
            @keyframes sparkle {
                0%, 100% { opacity: 1; transform: scale(1); }
                50% { opacity: 0.5; transform: scale(1.2); }
            }
            
            .sparkle {
                animation: sparkle 2s ease-in-out infinite;
            }
        </style>
    </head>
    <body class="bg-gray-50 overflow-x-hidden">
         <livewire:public.section.header />
        {{ $slot }}
         <livewire:public.section.footer />
        <!-- AOS Animation Script -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        
        <!-- Initialize AOS -->
        <script>
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                mirror: false
            });
        </script>
        
        <!-- Custom JavaScript -->
        <script>
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
            
            // Parallax effect for hero section
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const parallax = document.querySelector('.parallax-bg');
                if (parallax) {
                    const speed = scrolled * 0.5;
                    parallax.style.transform = `translateY(${speed}px)`;
                }
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
            setInterval(nextSlide, 5000);
        </script>
    </body>
</html>
