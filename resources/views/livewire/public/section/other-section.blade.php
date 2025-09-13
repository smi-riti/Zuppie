<div class="px-14 mx-auto bg-gradient-to-b from-gray-50 to-white relative">
    <section id="packages" class="sm:py-24 ">
        <div class=" sm:px-8">
            <!-- Header -->
            <div class="text-center mb-12 sm:mb-16" x-data="{ animate: true }" x-intersect="animate = true">
                <h2 class="text-3xl sm:text-4xl py-2 md:text-5xl font-extrabold font-display text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 mb-6"
                    x-show="animate" x-transition:enter="transition ease-out duration-700"
                    x-transition:enter-start="opacity-0 transform translate-y-10"
                    x-transition:enter-end="opacity-100 transform translate-y-0">
                    Explore Our Premium Packages
                </h2>
                <p class="text-lg sm:text-xl text-gray-600 max-w-2xl mx-auto" x-show="animate"
                    x-transition:enter="transition ease-out duration-700 delay-200"
                    x-transition:enter-start="opacity-0 transform translate-y-10"
                    x-transition:enter-end="opacity-100 transform translate-y-0">
                    Discover tailored packages to elevate your event with seamless planning and unforgettable moments.
                </p>
            </div>
            <!-- Scrollable Packages Container -->
            <div class="relative" x-data="scrollControl">
                <!-- Scroll Container -->
                <div class="relative overflow-x-auto scrollbar-hide snap-x snap-mandatory" x-ref="scrollContainer"
                    @scroll.debounce.100ms="updateScrollState">
                    <div class="flex space-x-6 pb-6" id="packages-scroll">
                        @foreach ($packages as $package)
                            <div class="flex-none w-80 sm:w-96">
                                <div
                                    class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group border border-gray-100 h-full flex flex-col">
                                    <!-- Image with hover zoom -->
                                    <div class="relative h-56 sm:h-64 overflow-hidden">
                                        <img src="{{ $package->images->first()?->image_url ?? 'https://via.placeholder.com/400x300' }}"
                                            alt="{{ $package->name }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent">
                                        </div>

                                        <!-- Package Info Overlay -->
                                        <div class="absolute bottom-4 left-4 right-4 text-white">
                                            <h3 class="text-lg sm:text-xl font-bold mb-1 drop-shadow-md">
                                                {{ $package->name }}
                                            </h3>
                                            <p class="text-sm opacity-90 flex items-center drop-shadow-sm">
                                                <i
                                                    class="fas fa-clock mr-2"></i>{{ $package->formatted_duration ?? 'Custom Duration' }}
                                            </p>
                                        </div>

                                        <!-- Category Badge -->
                                        @if($package->category)
                                            <div class="absolute top-4 left-4">
                                                <span
                                                    class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                                    {{ $package->category->name }}
                                                </span>
                                            </div>
                                        @endif

                                        <!-- Wishlist beige -->
                                        <div class="absolute top-4 right-4">
                                            <livewire:public.components.wishlist-button :packageId="$package->id" />
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="p-6 flex-grow flex flex-col">
                                        <!-- Price Section -->
                                        <div class="text-center mb-4">
                                            @if($package->discount_value > 0)
                                                <div class="flex justify-center items-center space-x-2 mb-2">
                                                    <span
                                                        class="text-gray-400 line-through text-lg">₹{{ number_format($package->price, 0) }}</span>
                                                    <span
                                                        class="text-2xl sm:text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
                                                        ₹{{ number_format($package->discounted_price, 0) }}
                                                    </span>
                                                </div>
                                            @else
                                                <div
                                                    class="text-2xl sm:text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600 mb-2">
                                                    ₹{{ number_format($package->price, 0) }}
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Description -->
                                        <p class="text-gray-600 text-sm mb-4 text-center leading-relaxed flex-grow">
                                            {{ Str::limit($package->description, 120) }}
                                        </p>
                                         
                                         <a href=" tel:{{ $settings['phone_no'] }}"
                                            class="block w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white py-3 px-4 rounded-xl text-center font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl mt-auto">
                                            <i class="fas fa-calendar-check mr-2"></i>Call us 
                                        </a>
                                        <!-- Action Button -->
                                        {{-- <a href="{{ route('package-detail', $package['slug']) }}"
                                            class="block w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white py-3 px-4 rounded-xl text-center font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl mt-auto">
                                            <i class="fas fa-calendar-check mr-2"></i>Book Now
                                        </a> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Alpine.js Auto-Scroll Control -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('scrollControl', () => ({
                autoScrollInterval: null,

                init() {
                    this.startAutoScroll();
                    this.$refs.scrollContainer.addEventListener('mouseenter', () => this.stopAutoScroll());
                    this.$refs.scrollContainer.addEventListener('mouseleave', () => this.startAutoScroll());
                },

                startAutoScroll() {
                    if (!this.autoScrollInterval) {
                        this.autoScrollInterval = setInterval(() => {
                            const container = this.$refs.scrollContainer;
                            const cardWidth = container.querySelector('.flex-none').offsetWidth + 24; // Card width + gap
                            const maxScroll = container.scrollWidth - container.clientWidth;

                            if (container.scrollLeft >= maxScroll - 1) {
                                // Reset to start when reaching the end
                                container.scrollTo({ left: 0, behavior: 'smooth' });
                            } else {
                                // Scroll by two cards
                                container.scrollBy({ left: cardWidth * 2, behavior: 'smooth' });
                            }
                        }, 3000); // Auto-scroll every 5 seconds
                    }
                },

                stopAutoScroll() {
                    if (this.autoScrollInterval) {
                        clearInterval(this.autoScrollInterval);
                        this.autoScrollInterval = null;
                    }
                }
            }));
        });
    </script>

    <!-- Tailwind Scrollbar Hide -->
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</div>