<!-- Hero Section with Floating Balloons and Changing Text -->
<div x-data="{}" x-init="
    let texts = ['Moment Magical', 'Dream Come True', 'Memory Special', 'Celebration Perfect', 'Event Unforgettable'];
    let index = 0;
    setInterval(() => {
        index = (index + 1) % texts.length;
        document.getElementById('changing-text').textContent = texts[index];
    }, 3000);
">
    <!-- Floating Balloons Background -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <!-- Balloon 1 -->
        <div class="absolute top-20 left-5 sm:left-10 w-6 sm:w-8 h-8 sm:h-10 rounded-full bg-gradient-to-b from-red-400 to-red-600 opacity-70 animate-float-slow">
            <div class="absolute top-0 left-1/2 w-0.5 h-6 sm:h-8 bg-gray-400 transform -translate-x-1/2 translate-y-full"></div>
        </div>
        <!-- Balloon 2 -->
        <div class="absolute top-40 right-5 sm:right-20 w-5 sm:w-6 h-6 sm:h-8 rounded-full bg-gradient-to-b from-blue-400 to-blue-600 opacity-60 animate-float-slower">
            <div class="absolute top-0 left-1/2 w-0.5 h-5 sm:h-6 bg-gray-400 transform -translate-x-1/2 translate-y-full"></div>
        </div>
        <!-- Balloon 3 -->
        <div class="absolute bottom-32 left-5 sm:left-20 w-8 sm:w-10 h-10 sm:h-12 rounded-full bg-gradient-to-b from-yellow-400 to-yellow-600 opacity-80 animate-float">
            <div class="absolute top-0 left-1/2 w-0.5 h-8 sm:h-10 bg-gray-400 transform -translate-x-1/2 translate-y-full"></div>
        </div>
        <!-- Balloon 4 -->
        <div class="absolute bottom-20 right-5 sm:right-10 w-6 sm:w-7 h-7 sm:h-9 rounded-full bg-gradient-to-b from-green-400 to-green-600 opacity-70 animate-float-slow">
            <div class="absolute top-0 left-1/2 w-0.5 h-6 sm:h-7 bg-gray-400 transform -translate-x-1/2 translate-y-full"></div>
        </div>
        <!-- Balloon 5 -->
        <div class="absolute top-60 left-1/4 sm:left-1/3 w-5 sm:w-6 h-6 sm:h-8 rounded-full bg-gradient-to-b from-purple-400 to-purple-600 opacity-65 animate-float-slower">
            <div class="absolute top-0 left-1/2 w-0.5 h-5 sm:h-6 bg-gray-400 transform -translate-x-1/2 translate-y-full"></div>
        </div>
        <!-- Balloon 6 -->
        <div class="absolute bottom-40 right-1/4 sm:right-1/3 w-6 sm:w-8 h-8 sm:h-10 rounded-full bg-gradient-to-b from-pink-400 to-pink-600 opacity-75 animate-float">
            <div class="absolute top-0 left-1/2 w-0.5 h-6 sm:h-8 bg-gray-400 transform -translate-x-1/2 translate-y-full"></div>
        </div>
    </div>

    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background with Parallax Effect -->
        <div class="absolute inset-0 gradient-bg parallax-bg"></div>
        <div class="absolute inset-0 bg-black/20"></div>

        <div class="relative z-10 text-center text-white px-4 max-w-6xl mx-auto">
            <!-- Main Tagline with Animation -->
            <h1 class="text-4xl sm:text-5xl md:text-7xl lg:text-8xl font-bold font-display mb-6" data-aos="fade-up">
                <span class="block sparkle" data-aos="zoom-in" data-aos-delay="200">🎈 Make Every</span>
                <!-- Changing Text Animation -->
                <span class="block gradient-text bg-gradient-to-r from-yellow-400 to-pink-400 bg-clip-text text-transparent"
                      data-aos="zoom-in" data-aos-delay="400">
                    <span id="changing-text" class="animate-pulse transition-all duration-500">Moment Magical</span>
                </span>
            </h1>

            <p class="text-lg sm:text-xl md:text-2xl mb-8 opacity-90 max-w-3xl mx-auto leading-relaxed" data-aos="fade-up"
                data-aos-delay="600">
                From intimate birthday celebrations to grand special events, we create unforgettable experiences that
                bring joy, wonder, and pure magic to your most precious moments.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center" data-aos="fade-up"
                data-aos-delay="800">
                <a href="{{route('event.packages')}}"
                    class="border-2 border-white text-white px-6 sm:px-8 py-3 sm:py-4 rounded-full font-semibold text-base sm:text-lg hover:bg-white hover:text-purple-700 transition-all duration-300 flex items-center space-x-2">
                    <i class="fas fa-gift"></i>
                    <span>View Packages</span>
                </a>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <i class="fas fa-chevron-down text-white text-2xl opacity-70"></i>
        </div>
    </section>

    <!-- Categories Section -->
    <section id="categories" class="py-12 sm:py-20 bg-gradient-to-br from-purple-50 to-pink-50 relative z-10">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold font-display gradient-text mb-6" data-aos="fade-up">
                    Event Categories
                </h2>
                <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    Discover our magical collection of event categories, each designed to create unforgettable moments
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 sm:gap-8 max-w-7xl mx-auto">
                @foreach ($categories as $index => $category)
                    <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:scale-105 cursor-pointer"
                         data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}"
                         wire:click="$emit('openCategoryPopup', {{ $category->id }})">
                        <div class="relative h-64 sm:h-80">
                            <!-- Dynamic Gradient Background -->
                            <div class="absolute inset-0 bg-gradient-to-br {{ $gradientColors[$index % count($gradientColors)] }}"></div>
                            
                            <!-- SVG Pattern Overlay -->
                            <div class="absolute inset-0 opacity-10">
                                <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <pattern id="pattern-{{ $index }}" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                            <circle cx="10" cy="10" r="2" fill="white" opacity="0.3"/>
                                            <path d="M5,5 L15,15 M15,5 L5,15" stroke="white" stroke-width="0.5" opacity="0.2"/>
                                        </pattern>
                                    </defs>
                                    <rect width="100%" height="100%" fill="url(#pattern-{{ $index }})"/>
                                </svg>
                            </div>
                            
                            <!-- Content -->
                            <div class="absolute inset-0 p-6 sm:p-8 text-white flex flex-col justify-center items-center text-center">
                                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-white/30 transition-all duration-300 shadow-lg">
                                    <i class="{{ $categoryIcons[$index % count($categoryIcons)] }} text-2xl sm:text-3xl"></i>
                                </div>
                                <h3 class="text-xl sm:text-2xl font-bold mb-2 group-hover:scale-105 transition-transform duration-300">{{$category->name}}</h3>
                                <p class="text-sm opacity-90 group-hover:opacity-100 transition-opacity duration-300">Click to explore subcategories</p>
                                
                                <!-- Hover Effect -->
                                <div class="absolute inset-0 bg-white/0 group-hover:bg-white/10 transition-all duration-300 rounded-2xl"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Enhanced Packages Section - Horizontal Scroll -->
    <section id="packages" class="py-12 sm:py-20 bg-white relative z-10">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold font-display gradient-text mb-6" data-aos="fade-up">
                    Featured Packages
                </h2>
                <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    Choose from our carefully crafted packages designed to make your event planning effortless
                </p>
            </div>

            <!-- Horizontal Scroll Container -->
            <div class="relative max-w-full mx-auto" data-aos="fade-up" data-aos-delay="400">
                <div class="flex overflow-x-auto scrollbar-hide space-x-6 pb-4" id="packages-scroll">
                    @foreach ($packages as $package)
                        <div class="flex-none w-80 sm:w-96 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group border border-gray-100">
                            <div class="relative h-56 sm:h-64 overflow-hidden">
                                <img src="{{ $package->images->first()?->image_url ?? 'https://via.placeholder.com/400x300' }}" 
                                     alt="{{ $package->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                
                                <!-- Gradient Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                                
                                <!-- Package Info Overlay -->
                                <div class="absolute bottom-4 left-4 right-4 text-white">
                                    <h3 class="text-lg sm:text-xl font-bold mb-1">{{ $package->name }}</h3>
                                    <p class="text-sm opacity-90 flex items-center">
                                        <i class="fas fa-clock mr-2"></i>{{ $package->formatted_duration ?? 'Custom Duration' }}
                                    </p>
                                </div>
                                
                                <!-- Category Badge -->
                                @if($package->category)
                                    <div class="absolute top-4 left-4">
                                        <span class="bg-white/20 backdrop-blur-sm text-white px-3 py-1 rounded-full text-xs font-medium">
                                            {{ $package->category->name }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <div class="p-6">
                                <!-- Price Section -->
                                <div class="text-center mb-4">
                                    @if($package->discount_value > 0)
                                        <div class="flex justify-center items-center space-x-2 mb-2">
                                            <span class="text-gray-400 line-through text-lg">₹{{ number_format($package->price, 0) }}</span>
                                            <span class="text-2xl sm:text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                                                ₹{{ number_format($package->discounted_price, 0) }}
                                            </span>
                                            <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded-full font-medium">
                                                {{ $package->discount_value }}{{ $package->discount_type === 'percentage' ? '%' : '₹' }} OFF
                                            </span>
                                        </div>
                                    @else
                                        <div class="text-2xl sm:text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-2">
                                            ₹{{ number_format($package->price, 0) }}
                                        </div>
                                    @endif
                                </div>

                                <!-- Description -->
                                <p class="text-gray-600 text-sm mb-4 text-center leading-relaxed">
                                    {{ Str::limit($package->description, 120) }}
                                </p>

                                <!-- Action Button -->
                                <a href="{{ route('event.packages') }}?package={{ $package->id }}"
                                   class="block w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white py-3 px-4 rounded-xl text-center font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    <i class="fas fa-calendar-check mr-2"></i>Book Now
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- View All Button -->
                <div class="text-center mt-8">
                    <a href="{{ route('event.packages') }}"
                       class="inline-flex items-center bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-8 py-4 rounded-full font-semibold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <i class="fas fa-grid-3x3 mr-3"></i>
                        View All Packages
                        <i class="fas fa-arrow-right ml-3"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Birthday Special Section -->
    <section class="py-12 sm:py-20 bg-gradient-to-br from-pink-50 via-purple-50 to-indigo-50 relative overflow-hidden">
        <!-- Background Decorations -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-10 w-32 h-32 bg-pink-300 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-40 h-40 bg-purple-300 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-yellow-300 rounded-full blur-3xl"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center max-w-7xl mx-auto">
                <!-- Image Section -->
                <div data-aos="fade-right" class="relative">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl group">
                        <img src="https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=600&h=400&fit=crop" 
                             alt="Birthday Celebration" 
                             class="w-full h-64 sm:h-80 lg:h-96 object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-purple-900/30 to-transparent"></div>
                        
                        <!-- Floating Elements -->
                        <div class="absolute top-6 right-6 w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center animate-bounce shadow-lg">
                            <span class="text-2xl">🎂</span>
                        </div>
                        <div class="absolute bottom-6 left-6 w-10 h-10 bg-pink-400 rounded-full flex items-center justify-center animate-pulse shadow-lg">
                            <span class="text-xl">🎈</span>
                        </div>
                    </div>
                    
                    <!-- Decorative Elements -->
                    <div class="absolute -top-4 -left-4 w-8 h-8 bg-purple-400 rounded-full animate-float opacity-80"></div>
                    <div class="absolute -bottom-4 -right-4 w-6 h-6 bg-pink-400 rounded-full animate-float-slow opacity-80"></div>
                </div>

                <!-- Content Section -->
                <div data-aos="fade-left" class="space-y-6">
                    <div class="inline-flex items-center bg-gradient-to-r from-purple-100 to-pink-100 text-purple-700 px-4 py-2 rounded-full font-medium text-sm">
                        <i class="fas fa-star mr-2"></i>
                        Special Birthday Packages
                    </div>
                    
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold font-display bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 bg-clip-text text-transparent leading-tight">
                        Make Birthdays Unforgettable
                    </h2>
                    
                    <p class="text-lg sm:text-xl text-gray-600 leading-relaxed">
                        Transform ordinary birthdays into extraordinary celebrations with our specially curated birthday packages. 
                        From enchanting decorations to delightful activities, we ensure every moment sparkles with joy and creates 
                        memories that last a lifetime.
                    </p>

                    <!-- Features -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4 group">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                <i class="fas fa-magic text-white text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 text-lg">Magical Decorations</h4>
                                <p class="text-gray-600">Themed decorations that bring dreams to life</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4 group">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                <i class="fas fa-gamepad text-white text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 text-lg">Fun Activities</h4>
                                <p class="text-gray-600">Engaging games and entertainment for all ages</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4 group">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                <i class="fas fa-birthday-cake text-white text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 text-lg">Custom Cakes</h4>
                                <p class="text-gray-600">Delicious cakes designed to match your theme</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="{{ route('event.packages') }}?category=birthday"
                           class="inline-flex items-center justify-center bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-8 py-4 rounded-full font-semibold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <i class="fas fa-gift mr-3"></i>
                            View Birthday Packages
                        </a>
                        
                        <a href="{{ route('event.packages') }}?type=custom-birthday"
                           class="inline-flex items-center justify-center border-2 border-purple-600 text-purple-600 hover:bg-purple-600 hover:text-white px-8 py-4 rounded-full font-semibold text-lg transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-palette mr-3"></i>
                            Custom Birthday Plan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

  
    <!-- Custom Styles for Animations -->
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
        
        @keyframes float-slower {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        .animate-float-slow {
            animation: float-slow 8s ease-in-out infinite;
        }
        
        .animate-float-slower {
            animation: float-slower 10s ease-in-out infinite;
        }
        
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hover-scale:hover {
            transform: scale(1.05);
        }
        
        /* Responsive adjustments */
        @media (max-width: 640px) {
            .animate-float, .animate-float-slow, .animate-float-slower {
                animation-duration: 4s;
            }
        }
    </style>

    <!-- Custom JavaScript for Enhanced Interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll for packages
            const packagesScroll = document.getElementById('packages-scroll');
            let isScrolling = false;
            
            // Auto-scroll packages on larger screens
            if (window.innerWidth > 768) {
                setInterval(() => {
                    if (!isScrolling && packagesScroll) {
                        packagesScroll.scrollBy({
                            left: 320,
                            behavior: 'smooth'
                        });
                        
                        // Reset scroll when reaching end
                        if (packagesScroll.scrollLeft >= packagesScroll.scrollWidth - packagesScroll.clientWidth) {
                            setTimeout(() => {
                                packagesScroll.scrollTo({
                                    left: 0,
                                    behavior: 'smooth'
                                });
                            }, 2000);
                        }
                    }
                }, 5000);
            }
            
            // Detect manual scrolling
            if (packagesScroll) {
                packagesScroll.addEventListener('scroll', () => {
                    isScrolling = true;
                    clearTimeout(window.scrollTimeout);
                    window.scrollTimeout = setTimeout(() => {
                        isScrolling = false;
                    }, 1000);
                });
            }
        });
    </script>
</div>
