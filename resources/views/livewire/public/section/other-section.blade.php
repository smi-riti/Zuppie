<div class="bg-gradient-to-b from-gray-50 to-white relative" 
     x-data="{
        currentScrollIndex: 0,
        totalCards: 0,
        startX: null,
        isMobile: window.innerWidth < 640,
        
        init() {
            this.initializeScrollIndicators();
            this.$nextTick(() => {
                window.addEventListener('resize', () => {
                    this.isMobile = window.innerWidth < 640;
                    this.initializeScrollIndicators();
                });
                
                // Keyboard navigation
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowLeft') {
                        this.scrollPackages('left');
                    } else if (e.key === 'ArrowRight') {
                        this.scrollPackages('right');
                    }
                });
            });
        },
        
        scrollPackages(direction) {
            const container = this.$refs.packagesContainer;
            const scrollAmount = this.isMobile ? 280 : 320;
            
            if (direction === 'left') {
                container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
                if (this.currentScrollIndex > 0) this.currentScrollIndex--;
            } else {
                container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                if (this.currentScrollIndex < this.totalCards - 1) this.currentScrollIndex++;
            }
            
            this.updateScrollIndicators();
        },
        
        initializeScrollIndicators() {
            const container = this.$refs.packagesContainer;
            const indicators = this.$refs.scrollIndicators;
            if (!container || !indicators) return;
            
            const cards = container.querySelectorAll('.flex-none');
            this.totalCards = Math.ceil(cards.length / (this.isMobile ? 1 : 2));
            
            if (this.isMobile && this.totalCards > 1) {
                indicators.innerHTML = '';
                for (let i = 0; i < this.totalCards; i++) {
                    const dot = document.createElement('div');
                    dot.className = `w-2 h-2 rounded-full transition-all duration-300 cursor-pointer ${i === 0 ? 'bg-purple-600 w-6' : 'bg-gray-300'}`;
                    dot.onclick = () => this.scrollToIndex(i);
                    indicators.appendChild(dot);
                }
            }
        },
        
        updateScrollIndicators() {
            const indicators = this.$refs.scrollIndicators;
            if (!indicators) return;
            
            const dots = indicators.querySelectorAll('div');
            dots.forEach((dot, index) => {
                if (index === this.currentScrollIndex) {
                    dot.className = 'w-6 h-2 rounded-full bg-purple-600 transition-all duration-300 cursor-pointer';
                } else {
                    dot.className = 'w-2 h-2 rounded-full bg-gray-300 transition-all duration-300 cursor-pointer';
                }
            });
        },
        
        scrollToIndex(index) {
            const container = this.$refs.packagesContainer;
            const scrollAmount = this.isMobile ? 280 : 320;
            container.scrollTo({ left: index * scrollAmount, behavior: 'smooth' });
            this.currentScrollIndex = index;
            this.updateScrollIndicators();
        },
        
        handleTouchStart(e) {
            this.startX = e.touches[0].clientX;
        },
        
        handleTouchEnd(e) {
            if (!this.startX) return;
            
            const endX = e.changedTouches[0].clientX;
            const diffX = this.startX - endX;
            
            if (Math.abs(diffX) > 50) {
                if (diffX > 0) {
                    this.scrollPackages('right');
                } else {
                    this.scrollPackages('left');
                }
            }
            
            this.startX = null;
        }
     }">
    <section id="packages" class="py-12 sm:py-24">
        <div class="px-4 sm:px-8">
            <!-- Header -->
            <div class="text-center mb-8 sm:mb-16 fade-in-up">
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold font-display text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 mb-4 sm:mb-6 px-4">
                    Explore Our Premium Packages
                </h2>
                <p class="text-base sm:text-lg lg:text-xl text-gray-600 max-w-2xl mx-auto px-4">
                    Discover tailored packages to elevate your event with seamless planning and unforgettable moments.
                </p>
            </div>
            
            <!-- Scrollable Packages Container -->
            <div class="relative">
                <!-- Navigation Buttons - Hidden on mobile, visible on larger screens -->
                <button @click="scrollPackages('left')" 
                    class="hidden sm:flex absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white/90 hover:bg-white shadow-lg rounded-full p-3 transition-all duration-300 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-purple-500 backdrop-blur-sm items-center justify-center">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button @click="scrollPackages('right')" 
                    class="hidden sm:flex absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white/90 hover:bg-white shadow-lg rounded-full p-3 transition-all duration-300 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-purple-500 backdrop-blur-sm items-center justify-center">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                
                <!-- Scroll Container with hidden scrollbar -->
                <div x-ref="packagesContainer" 
                     @touchstart="handleTouchStart($event)"
                     @touchend="handleTouchEnd($event)"
                     class="overflow-x-auto scroll-smooth px-4 sm:px-12 scrollbar-hide"
                     style="scrollbar-width: none; -ms-overflow-style: none;">
                    <div class="flex space-x-3 sm:space-x-6 pb-6" style="min-width: max-content;">
                        @foreach ($packages as $package)
                            <div class="flex-none w-64 sm:w-72 lg:w-80 xl:w-96">
                                <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group border border-gray-100 h-full flex flex-col hover-lift transform hover:scale-[1.02]">
                                    <!-- Image with hover zoom -->
                                    <div class="relative h-48 sm:h-56 lg:h-64 overflow-hidden">
                                        <img src="{{ $package->images->first()?->image_url ?? 'https://via.placeholder.com/400x300' }}"
                                            alt="{{ $package->name }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                            loading="lazy">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent"></div>

                                        <!-- Package Info Overlay -->
                                        <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4 right-3 sm:right-4 text-white">
                                            <h3 class="text-base sm:text-lg lg:text-xl font-bold mb-1 drop-shadow-md line-clamp-2">
                                                {{ $package->name }}
                                            </h3>
                                            <p class="text-xs sm:text-sm opacity-90 flex items-center drop-shadow-sm">
                                                <i class="fas fa-clock mr-2"></i>{{ $package->formatted_duration ?? 'Custom Duration' }}
                                            </p>
                                        </div>

                                        <!-- Category Badge -->
                                        @if($package->category)
                                            <div class="absolute top-3 sm:top-4 left-3 sm:left-4">
                                                <span class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-2 sm:px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                                    {{ $package->category->name }}
                                                </span>
                                            </div>
                                        @endif

                                        <!-- Wishlist button -->
                                        <div class="absolute top-3 sm:top-4 right-3 sm:right-4">
                                            <livewire:public.components.wishlist-button :packageId="$package->id" />
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="p-4 sm:p-6 flex-grow flex flex-col">
                                        <!-- Price Section -->
                                        <div class="text-center mb-3 sm:mb-4">
                                            @if($package->discount_value > 0)
                                                <div class="flex justify-center items-center space-x-2 mb-2">
                                                    <span class="text-gray-400 line-through text-sm sm:text-lg">₹{{ number_format($package->price, 0) }}</span>
                                                    <span class="text-xl sm:text-2xl lg:text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
                                                        ₹{{ number_format($package->discounted_price, 0) }}
                                                    </span>
                                                </div>
                                            @else
                                                <div class="text-xl sm:text-2xl lg:text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600 mb-2">
                                                    ₹{{ number_format($package->price, 0) }}
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Description -->
                                        <p class="text-gray-600 text-xs sm:text-sm mb-3 sm:mb-4 text-center leading-relaxed flex-grow line-clamp-3">
                                            {{ Str::limit($package->description, 100) }}
                                        </p>
                                         
                                        <!-- Action Button -->
                                        <a href="tel:{{ $settings['phone_no'] }}"
                                            class="block w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white py-2.5 sm:py-3 px-4 rounded-xl text-center text-sm sm:text-base font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl mt-auto">
                                            <i class="fas fa-phone mr-2"></i>Call us 
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Mobile Scroll Indicators -->
                <div class="flex justify-center mt-4 sm:hidden">
                    <div x-ref="scrollIndicators" class="flex space-x-2"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Custom styles for hiding scrollbar -->
    <style>
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .hover-lift:hover {
            transform: translateY(-4px) scale(1.02);
        }
        
        @media (max-width: 640px) {
            .hover-lift:hover {
                transform: translateY(-2px) scale(1.01);
            }
        }
    </style>
</div>