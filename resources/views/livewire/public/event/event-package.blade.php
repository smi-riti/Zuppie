<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-purple-50">

    <!-- Hero Section -->
    <section class="relative h-[70vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=1920&h=1080&fit=crop"
                alt="Event Planning" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-purple-900/40 via-pink-900/30 to-purple-900/40"></div>

            <!-- Sparkle Animation Elements -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute top-1/5 left-[15%] w-2.5 h-2.5 bg-white/50 rounded-full animate-ping"></div>
                <div class="absolute top-3/5 right-1/5 w-3.5 h-3.5 bg-white/40 rounded-full animate-pulse"></div>
                <div class="absolute bottom-[15%] left-1/2 w-3 h-3 bg-white/60 rounded-full animate-bounce"></div>
            </div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 w-full flex flex-col items-center px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto text-center">
            <h1 class="text-4xl sm:text-6xl md:text-8xl font-black text-white leading-tight mb-6 animate-fade-in">
                <span class="block drop-shadow-lg">Magical</span>
                <span
                    class="block text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-purple-400 to-pink-500">
                    Event Packages
                </span>
            </h1>
            <p
                class="text-lg sm:text-xl md:text-2xl text-gray-100 max-w-3xl mx-auto leading-relaxed mb-8 drop-shadow-md">
                Transform your celebrations into unforgettable experiences with our expertly crafted event packages
            </p>

            <!-- Search Bar -->
            <div class="w-full max-w-lg mx-auto mb-8">
                <div class="relative group">
                    <input type="text" wire:model.live.debounce.500ms="searchQuery"
                        wire:keydown.enter="searchPackages" placeholder="Search packages, categories, events..."
                        class="w-full pl-6 pr-16 py-5 rounded-2xl bg-white/15 backdrop-blur-lg border border-white/30 text-white placeholder-gray-200 text-lg focus:outline-none focus:ring-4 focus:ring-pink-400/50 focus:border-pink-400 transition-all duration-300 shadow-xl group-hover:bg-white/20">
                    <button wire:click="searchPackages"
                        class="absolute right-6 top-1/2 -translate-y-1/2 transition-colors duration-300 group-hover:text-pink-300">
                        <i class="fas fa-search text-gray-200 text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Special Categories Section -->
    <section class="lg:px-10 p-6 py-12">
        <div class="">
            <div class="flex flex-col md:flex-row justify-between items-center mb-10">
                <div>
                    <h2 class="text-3xl md:text-4xl font-2xl text-gray-900 mb-2">Browse Categories</h2>
                    <p class="text-gray-600">Discover the perfect event package for your celebration</p>
                </div>
                <button wire:click="showAllCategories"
                    class="mt-4 md:mt-0 px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-full font-medium hover:opacity-90 transition-all duration-300 transform hover:scale-105">
                    {{ $showAllCategoriesMode ? 'Show Special Categories' : 'View All Categories' }}
                </button>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 sm:gap-6">
                @if ($showAllCategoriesMode)
                    @foreach ($this->allCategories as $category)
                        <div wire:click="openCategoryModal('{{ $category->slug }}')"
                            class="bg-white rounded-xl shadow-lg p-4 sm:p-6 text-center transition-all duration-300 cursor-pointer hover:-translate-y-2 hover:shadow-xl group">
                            <div
                                class="w-12 h-12 sm:w-16 sm:h-16 mx-auto mb-3 sm:mb-4 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <i
                                    class="{{ $this->getCategoryIcon($category->slug) }} text-lg sm:text-2xl text-purple-600 group-hover:text-pink-600"></i>
                            </div>
                            <h3
                                class="text-sm sm:text-base font-2xl text-gray-800 group-hover:text-purple-600 transition-colors">
                                {{ $category->name }}
                            </h3>
                            @if ($category->description)
                                <p
                                    class="text-xs text-gray-500 mt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    {{ Str::limit($category->description, 50) }}
                                </p>
                            @endif
                        </div>
                    @endforeach
                @else
                    @foreach ($this->specialCategories as $category)
                        <div wire:click="openCategoryModal('{{ $category['slug'] }}')"
                            class="bg-white rounded-xl shadow-lg p-4 sm:p-6 text-center transition-all duration-300 cursor-pointer hover:-translate-y-2 hover:shadow-xl group">
                            <div
                                class="w-12 h-12 sm:w-16 sm:h-16 mx-auto mb-3 sm:mb-4 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <i
                                    class="{{ $category['icon'] }} text-lg sm:text-2xl text-purple-600 group-hover:text-pink-600"></i>
                            </div>
                            <h3
                                class="text-sm sm:text-base font-2xl text-gray-800 group-hover:text-purple-600 transition-colors">
                                {{ $category['name'] }}
                            </h3>
                            @if ($category['description'])
                                <p
                                    class="text-xs text-gray-500 mt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    {{ Str::limit($category['description'], 50) }}
                                </p>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- Popular Packages Section -->
    <section class="lg:px-10 p-6 py-2">
        <div class="">
            <div class="flex flex-col md:flex-row justify-between items-center mb-10">
                <div>
                    <h2 class="text-3xl md:text-4xl font-2xl text-gray-900 mb-2">Popular Packages</h2>
                    <p class="text-gray-600">Most booked and highly rated event packages</p>
                </div>
                <div class="flex items-center mt-4 md:mt-0 space-x-2">
                    <button id="popular-prev"
                        class="p-2 bg-white border border-gray-300 rounded-full shadow-md hover:bg-gray-50 transition-all duration-300">
                        <i class="fas fa-chevron-left text-gray-600"></i>
                    </button>
                    <button id="popular-next"
                        class="p-2 bg-white border border-gray-300 rounded-full shadow-md hover:bg-gray-50 transition-all duration-300">
                        <i class="fas fa-chevron-right text-gray-600"></i>
                    </button>
                </div>
            </div>

            <div class="relative">
                <div id="popular-carousel" class="flex overflow-x-auto space-x-6 scrollbar-hide scroll-smooth"
                    style="scrollbar-width: none; -ms-overflow-style: none;">
                    @foreach ($this->popularPackages as $package)
                        <div
                            class="flex-shrink-0 w-80 rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
                            <div class="relative h-48">
                                <img src="{{ $package['image'] }}" alt="{{ $package['name'] }}"
                                    class="w-full h-full object-cover">
                                @if ($package['is_special'])
                                    <div
                                        class="absolute top-4 right-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white px-3 py-1 rounded-full text-xs font-medium">
                                        Special
                                    </div>
                                @endif
                                {{-- <div
                                    class="absolute top-3 left-3 text-white px-3 py-1 rounded-full text-xs font-medium">
                                    <livewire:public.components.wishlist-button :packageId="$package['id']" />
                                </div>  --}}
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-2xl text-gray-900 mb-2">{{ $package['name'] }}</h3>
                                <div class="flex items-center mb-3">
                                    <span
                                        class="text-2xl font-2xl text-purple-600">₹{{ number_format($package['discounted_price']) }}</span>
                                    @if ($package['price'] != $package['discounted_price'])
                                        <span
                                            class="text-lg text-gray-500 line-through ml-2">₹{{ number_format($package['price']) }}</span>
                                    @endif
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">{{ Str::limit($package['description'], 80) }}</p>
                                @if ($package['features'] && is_array($package['features']) && !empty($package['features']))
                                    <ul class="text-gray-600 mb-4 text-sm space-y-1">
                                        @foreach (array_slice($package['features'], 0, 3) as $feature)
                                            <li class="flex items-center">
                                                <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                                                {{ $feature }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <ul class="text-gray-600 mb-4 text-sm space-y-1">
                                        <li class="flex items-center">
                                            <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                                            Professional Event Planning
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                                            Venue Decoration
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                                            Photography Services
                                        </li>
                                    </ul>
                                @endif
                                <div class="mt-6 flex items-center justify-between gap-3">
                                    <a href="{{ route('package-detail', ['slug' => $package['slug'] ?? ($package->slug ?? '')]) }}" wire:navigate
                                        class="flex-1 text-white text-center px-4 py-3  bg-gradient-to-r from-purple-600 to-pink-600 rounded-xl font-medium hover:from-purple-700 hover:to-pink-700 transition ">
                                        View
                                    </a>
                                    <a href="tel:{{ $settings['phone_no'] ?? '' }}"
                                        class="flex-1 block text-center px-4 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-xl font-2xl hover:from-purple-700 hover:to-pink-700 transition">
                                        Call us
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Category-wise Packages Sections -->
    @php
        $specialCategories = $this->specialCategories->where('packages', '!=', null)->filter(function ($category) {
            return count($category['packages']) > 0;
        });

        $normalCategories = collect();
        if ($showAllCategoriesMode) {
            $normalCategories = $this->allCategories->filter(function ($category) {
                return !$category->is_special;
            });
        }
    @endphp

    {{-- Special Categories Packages --}}
    @foreach ($specialCategories as $category)
        <section class="lg:px-10 p-6 {{ $loop->even}}">
            <div class="">
                <div class="flex flex-col md:flex-row justify-between items-center mb-10">
                    <div>
                        <h2 class="text-3xl md:text-4xl font-2xl text-gray-900 mb-2">{{ $category['name'] }} Packages
                        </h2>
                        <p class="text-gray-600">Discover amazing {{ strtolower($category['name']) }} packages</p>
                    </div>
                    <div class="flex items-center mt-4 md:mt-0 space-x-2">
                        <button
                            class="category-prev p-2 bg-white border border-gray-300 rounded-full shadow-md hover:bg-gray-50 transition-all duration-300"
                            data-category="{{ $category['slug'] }}">
                            <i class="fas fa-chevron-left text-gray-600"></i>
                        </button>
                        <button
                            class="category-next p-2 bg-white border border-gray-300 rounded-full shadow-md hover:bg-gray-50 transition-all duration-300"
                            data-category="{{ $category['slug'] }}">
                            <i class="fas fa-chevron-right text-gray-600"></i>
                        </button>
                    </div>
                </div>

                <div class="relative">
                    <div id="category-{{ $category['slug'] }}-carousel"
                        class="flex overflow-x-auto space-x-6 scrollbar-hide scroll-smooth category-carousel"
                        style="scrollbar-width: none; -ms-overflow-style: none;">
                        @foreach ($category['packages'] as $package)
                            <div
                                class="flex-shrink-0 w-80 rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
                                <div class="relative h-48">
                                    <img src="{{ $package['image'] }}" alt="{{ $package['name'] }}"
                                        class="w-full h-full object-cover">
                                    @if ($package['is_special'])
                                        <div
                                            class="absolute top-4 right-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white px-3 py-1 rounded-full text-xs font-medium">
                                            Special
                                        </div>
                                    @endif
                                    {{-- <livewire:public.components.wishlist-button :packageId="$package['id']" /> --}}
                                </div>
                                <div class="p-6">
                                    <h3 class="text-xl font-2xl text-gray-900 mb-2">{{ $package['name'] }}</h3>
                                    <div class="flex items-center mb-3">
                                        <span
                                            class="text-2xl font-2xl text-purple-600">₹{{ number_format($package['discounted_price']) }}</span>
                                        @if ($package['price'] != $package['discounted_price'])
                                            <span
                                                class="text-lg text-gray-500 line-through ml-2">₹{{ number_format($package['price']) }}</span>
                                        @endif
                                    </div>
                                    <p class="text-gray-600 mb-4 text-sm">
                                        {{ Str::limit($package['description'], 80) }}</p>
                                    @if ($package['features'] && is_array($package['features']) && !empty($package['features']))
                                        <ul class="text-gray-600 mb-4 text-sm space-y-1">
                                            @foreach (array_slice($package['features'], 0, 3) as $feature)
                                                <li class="flex items-center">
                                                    <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                                                    {{ $feature }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <ul class="text-gray-600 mb-4 text-sm space-y-1">
                                            <li class="flex items-center">
                                                <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                                                Professional Event Planning
                                            </li>
                                            <li class="flex items-center">
                                                <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                                                Venue Decoration
                                            </li>
                                            <li class="flex items-center">
                                                <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                                                Photography Services
                                            </li>
                                        </ul>
                                    @endif
                                    <div class="mt-6 flex items-center justify-between gap-3">
                                        <a href="{{ route('package-detail', ['slug' => $package['slug'] ?? ($package->slug ?? '')]) }}" wire:navigate
                                            class="flex-1 block  text-center px-4 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-xl font-medium hover:from-purple-700 hover:to-pink-700 transition transition">
                                            View
                                        </a>
                                        <a href="tel:{{ $settings['phone_no'] ?? '' }}"
                                            class="flex-1 block text-center px-4 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-xl font-2xl hover:from-purple-700 hover:to-pink-700 transition">
                                            Call us
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="text-center mt-10">
                    <button wire:click="redirectToFilter('{{ $category['slug'] }}')"
                        class="px-8 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-full font-medium hover:opacity-90 transition-all duration-300 transform hover:scale-105">
                        View All {{ $category['name'] }} Packages
                    </button>
                </div>
            </div>
        </section>
    @endforeach

    {{-- Normal Categories Packages (Only when showing all categories) --}}
    @if ($showAllCategoriesMode)
        @foreach ($normalCategories as $category)
            @php
                $categoryPackages = $this->getCategoryPackages($category->id);
            @endphp
            @if (count($categoryPackages) > 0)
                <section
                    class="py-16 {{ ($specialCategories->count() + $loop->index) % 2 == 0 ? 'bg-gray-50' : 'bg-white' }}">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex flex-col md:flex-row justify-between items-center mb-10">
                            <div>
                                <h2 class="text-3xl md:text-4xl font-2xl text-gray-900 mb-2">{{ $category->name }}
                                    Packages</h2>
                                <p class="text-gray-600">Discover amazing {{ strtolower($category->name) }} packages
                                </p>
                            </div>
                            <div class="flex items-center mt-4 md:mt-0 space-x-2">
                                <button
                                    class="category-prev p-2 bg-white border border-gray-300 rounded-full shadow-md hover:bg-gray-50 transition-all duration-300"
                                    data-category="{{ $category->slug }}">
                                    <i class="fas fa-chevron-left text-gray-600"></i>
                                </button>
                                <button
                                    class="category-next p-2 bg-white border border-gray-300 rounded-full shadow-md hover:bg-gray-50 transition-all duration-300"
                                    data-category="{{ $category->slug }}">
                                    <i class="fas fa-chevron-right text-gray-600"></i>
                                </button>
                            </div>
                        </div>

                        <div class="relative">
                            <div id="category-{{ $category->slug }}-carousel"
                                class="flex overflow-x-auto space-x-6 scrollbar-hide scroll-smooth category-carousel"
                                style="scrollbar-width: none; -ms-overflow-style: none;">
                                @foreach ($categoryPackages as $package)
                                    <div
                                        class="flex-shrink-0 w-80 bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
                                        <div class="relative h-48">
                                            <img src="{{ $package['image'] }}" alt="{{ $package['name'] }}"
                                                class="w-full h-full object-cover">
                                            @if ($package['is_special'])
                                                <div
                                                    class="absolute top-4 right-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white px-3 py-1 rounded-full text-xs font-medium">
                                                    Special
                                                </div>
                                            @endif
                                            <button
                                                class="absolute top-4 left-4 text-white bg-black/40 p-2 rounded-full hover:bg-black/60 transition-all duration-300 wishlist-btn">
                                                <i class="far fa-heart"></i>
                                            </button>
                                        </div>
                                        <div class="p-6">
                                            <h3 class="text-xl font-2xl text-gray-900 mb-2">{{ $package['name'] }}
                                            </h3>
                                            <div class="flex items-center mb-3">
                                                <span
                                                    class="text-2xl font-2xl text-purple-600">₹{{ number_format($package['discounted_price']) }}</span>
                                                @if ($package['price'] != $package['discounted_price'])
                                                    <span
                                                        class="text-lg text-gray-500 line-through ml-2">₹{{ number_format($package['price']) }}</span>
                                                @endif
                                            </div>
                                            <p class="text-gray-600 mb-4 text-sm">
                                                {{ Str::limit($package['description'], 80) }}</p>
                                            @if ($package['features'] && is_array($package['features']) && !empty($package['features']))
                                                <ul class="text-gray-600 mb-4 text-sm space-y-1">
                                                    @foreach (array_slice($package['features'], 0, 3) as $feature)
                                                        <li class="flex items-center">
                                                            <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                                                            {{ $feature }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <ul class="text-gray-600 mb-4 text-sm space-y-1">
                                                    <li class="flex items-center">
                                                        <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                                                        Professional Event Planning
                                                    </li>
                                                    <li class="flex items-center">
                                                        <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                                                        Venue Decoration
                                                    </li>
                                                    <li class="flex items-center">
                                                        <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                                                        Photography Services
                                                    </li>
                                                </ul>
                                            @endif
                                            <div class="mt-6 flex items-center justify-between gap-3">
                                                <a href="{{ route('package-detail', ['slug' => $package['slug'] ?? ($package->slug ?? '')]) }}" wire:navigate
                                                    class="flex-1 block  text-center px-4 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-gray-700 rounded-xl font-medium hover:from-purple-700 hover:to-pink-700 transition">
                                                    View
                                                </a>
                                                <a href="tel:{{ $settings['phone_no'] ?? '' }}"
                                                    class="flex-1 block text-center px-4 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-xl font-2xl hover:from-purple-700 hover:to-pink-700 transition">
                                                    Call us
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="text-center mt-10">
                            <button wire:click="redirectToFilter('{{ $category->slug }}')"
                                class="px-8 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-full font-medium hover:opacity-90 transition-all duration-300 transform hover:scale-105">
                                View All {{ $category->name }} Packages
                            </button>
                        </div>
                    </div>
                </section>
            @endif
        @endforeach
    @endif

    <livewire:public.section.enquiry-form />
    <livewire:public.components.bottom-navigation />

    <!-- JavaScript for Enhanced Functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Wishlist functionality
            document.querySelectorAll('.wishlist-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    e.preventDefault();
                    const icon = this.querySelector('i');
                    if (icon.classList.contains('far')) {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                        this.classList.add('active');
                    } else {
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                        this.classList.remove('active');
                    }
                });
            });

            // Popular packages carousel with overflow-x-auto
            setupOverflowCarousel('popular-carousel', '#popular-prev', '#popular-next');

            // Category carousels with overflow-x-auto
            document.querySelectorAll('.category-carousel').forEach(carousel => {
                const categorySlug = carousel.id.replace('category-', '').replace('-carousel', '');
                setupOverflowCarousel(carousel.id, `[data-category="${categorySlug}"].category-prev`,
                    `[data-category="${categorySlug}"].category-next`);
            });

            function setupOverflowCarousel(carouselId, prevSelector, nextSelector) {
                const carousel = document.getElementById(carouselId);
                const prevBtn = document.querySelector(prevSelector);
                const nextBtn = document.querySelector(nextSelector);

                if (!carousel || !prevBtn || !nextBtn) return;

                const itemWidth = 320 + 24; // width + gap

                prevBtn.addEventListener('click', () => {
                    carousel.scrollBy({
                        left: -itemWidth * 2,
                        behavior: 'smooth'
                    });
                });

                nextBtn.addEventListener('click', () => {
                    carousel.scrollBy({
                        left: itemWidth * 2,
                        behavior: 'smooth'
                    });
                });

                // Auto-scroll for popular packages
                if (carouselId === 'popular-carousel') {
                    setInterval(() => {
                        if (carousel.scrollLeft >= carousel.scrollWidth - carousel.clientWidth) {
                            carousel.scrollTo({
                                left: 0,
                                behavior: 'smooth'
                            });
                        } else {
                            carousel.scrollBy({
                                left: itemWidth,
                                behavior: 'smooth'
                            });
                        }
                    }, 5000);
                }
            }

            // Touch/swipe support for mobile
            let startX, startY, currentX, currentY;

            document.querySelectorAll('[id$="-carousel"]').forEach(carousel => {
                carousel.addEventListener('touchstart', handleTouchStart, {
                    passive: true
                });
                carousel.addEventListener('touchmove', handleTouchMove, {
                    passive: true
                });
                carousel.addEventListener('touchend', handleTouchEnd, {
                    passive: true
                });

                function handleTouchStart(e) {
                    startX = e.touches[0].clientX;
                    startY = e.touches[0].clientY;
                }

                function handleTouchMove(e) {
                    if (!startX || !startY) return;
                    currentX = e.touches[0].clientX;
                    currentY = e.touches[0].clientY;
                }

                function handleTouchEnd(e) {
                    if (!startX || !currentX) return;

                    const diffX = startX - currentX;
                    const diffY = startY - currentY;

                    if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 50) {
                        const carouselId = carousel.id;
                        const categorySlug = carouselId.replace('category-', '').replace('-carousel', '');

                        if (diffX > 0) { // swipe left
                            if (carouselId === 'popular-carousel') {
                                document.getElementById('popular-next').click();
                            } else {
                                document.querySelector(`[data-category="${categorySlug}"].category-next`)
                                    .click();
                            }
                        } else { // swipe rightwish
                            if (carouselId === 'popular-carousel') {
                                document.getElementById('popular-prev').click();
                            } else {
                                document.querySelector(`[data-category="${categorySlug}"].category-prev`)
                                    .click();
                            }
                        }
                    }

                    startX = null;
                    startY = null;
                    currentX = null;
                    currentY = null;
                }
            });
        });
    </script>

    <!-- Enhanced CSS for animations and effects -->
    <style>
        @keyframes gradient-shift {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        .animate-gradient-x {
            background-size: 200% 200%;
            animation: gradient-shift 3s ease infinite;
        }

        .animate-fade-in {
            animation: fadeIn 1s ease-out;
        }

        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out 0.3s both;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .wishlist-btn.active {
            color: #ec4899;
        }

        .category-carousel {
            scroll-behavior: smooth;
        }

        /* Hide scrollbars */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .category-carousel::-webkit-scrollbar,
        #popular-carousel::-webkit-scrollbar {
            display: none;
        }

        .category-carousel,
        #popular-carousel {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Mobile optimizations */
        @media (max-width: 768px) {
            .flex-shrink-0.w-80 {
                width: 280px;
            }

            section {
                padding-top: 3rem;
                padding-bottom: 3rem;
            }

            .text-3xl.md\:text-4xl {
                wish font-size: 1.875rem;
            }
        }

        @media (max-width: 640px) {
            .flex-shrink-0.w-80 {
                width: 260px;
            }

            .space-x-6>*+* {
                margin-left: 1rem;
            }
        }
    </style>

    <livewire:public.components.category-popup />
</div>
