<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-purple-50">

    <!-- Hero Section with Single Image and Gradient -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=1920&h=1080&fit=crop"
                alt="Event Planning" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-purple-900/40 via-pink-900/30 to-purple-900/40"></div>

            <!-- Sparkle Animation Elements -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="sparkle-1 absolute animate-ping"></div>
                <div class="sparkle-2 absolute animate-pulse"></div>
                <div class="sparkle-3 absolute animate-bounce"></div>
            </div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 w-full flex flex-col items-center px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto text-center">
            <h1 class="text-4xl sm:text-6xl md:text-8xl font-black text-white leading-tight mb-6 animate-fade-in">
                <span class="block drop-shadow-lg">Magical</span>
                <span
                    class="block text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-purple-400 to-pink-500 animate-gradient-x">
                    Event Packages
                </span>
            </h1>
            <p
                class="text-lg sm:text-xl md:text-2xl text-gray-100 max-w-3xl mx-auto leading-relaxed mb-8 drop-shadow-md animate-fade-in-up">
                Transform your celebrations into unforgettable experiences with our expertly crafted event packages
            </p>

            <!-- Search Bar -->
            <div class="w-full max-w-lg mx-auto mb-8 animate-fade-in-up">
                <div class="relative group">
                    <input type="text" wire:model.live="searchQuery"
                        placeholder="Search for your perfect event package..."
                        class="w-full pl-6 pr-16 py-5 rounded-2xl bg-white/15 backdrop-blur-lg border border-white/30 text-white placeholder-gray-200 text-lg focus:outline-none focus:ring-4 focus:ring-pink-400/50 focus:border-pink-400 transition-all duration-300 shadow-xl group-hover:bg-white/20">
                    <div
                        class="absolute right-6 top-1/2 transform -translate-y-1/2 transition-colors duration-300 group-hover:text-pink-300">
                        <i class="fas fa-search text-gray-200 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Packages Section -->
    @if (!$searchQuery)
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">
                        Most Popular Packages
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Handpicked by our experts and loved by our customers
                    </p>
                </div>

                <!-- Featured Carousel -->
                <div class="featured-carousel-container relative" data-aos="fade-up" data-aos-delay="200">
                    <div class="featured-carousel flex space-x-8 overflow-x-auto pb-4 scrollbar-hide">
                        @foreach ($this->featuredPackages as $index => $package)
                            <div
                                class="featured-card flex-shrink-0 w-80 bg-white rounded-3xl shadow-2xl overflow-hidden hover:shadow-3xl transform hover:-translate-y-2 transition-all duration-500 group">
                                <!-- Image -->
                                <div class="relative h-48 overflow-hidden">
                                    <img src="{{ $package['image'] }}" alt="{{ $package['name'] }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                                    <!-- Most Popular Badge -->
                                    <div class="absolute top-4 right-4">
                                        <span
                                            class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg animate-pulse">
                                            <i class="fas fa-crown mr-1"></i>Most Popular
                                        </span>
                                    </div>
                                    <!-- wishlist Badge -->
                                    <div class="absolute top-4 right-4">
                                        <livewire:public.components.wishlist-button :packageId="$package['id']" />
                                    </div>

                                    <!-- Price Badge -->
                                    <div class="absolute bottom-4 left-4">
                                        <span
                                            class="bg-white/90 backdrop-blur-sm text-gray-800 px-4 py-2 rounded-full font-bold text-lg shadow-lg">
                                            ₹{{ number_format($package['price']) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="p-6">
                                    <h3
                                        class="text-xl font-bold text-gray-800 group-hover:text-purple-600 transition-colors duration-300 mb-3">
                                        {{ $package['name'] }}
                                    </h3>

                                    <p class="text-gray-600 mb-4 leading-relaxed">{{ $package['description'] }}</p>

                                    <!-- Features Preview -->
                                    <div class="space-y-2 mb-6">
                                        @foreach (array_slice($package['features'], 0, 3) as $feature)
                                            <div class="flex items-center space-x-2">
                                                <div
                                                    class="w-2 h-2 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex-shrink-0">
                                                </div>
                                                <span class="text-gray-700 text-sm">{{ $feature }}</span>
                                            </div>
                                        @endforeach
                                        @if (count($package['features']) > 3)
                                            <div class="text-purple-600 font-semibold text-sm">
                                                +{{ count($package['features']) - 3 }} more features included
                                            </div>
                                        @endif
                                    </div>

                                    <!-- CTA Button -->
                                    <div class="flex gap-3">
                                        <a href="{{ route('package-detail', ['id' => $package['id']]) }}"
                                            class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 px-6 rounded-2xl font-bold hover:from-purple-700 hover:to-pink-700 transform hover:scale-105 transition-all duration-300 shadow-lg text-center">
                                            <i class="fas fa-eye mr-2"></i>
                                            View Package
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Main Packages Section -->
    <section class="py-20 bg-gradient-to-br from-gray-50 to-purple-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-8">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                    All Event Packages
                </h2>
                <p class="text-base sm:text-xl text-gray-600 max-w-2xl mx-auto mb-4">
                    Choose from our wide range of event packages for every occasion
                </p>
                <div class="flex flex-wrap justify-center gap-2 sm:gap-3 mt-4">
                    @foreach ($this->displayCategories as $category)
                        <button @if ($category->children->count())
                        wire:click="$dispatch('openCategoryModal', { categorySlug: '{{ $category->slug }}' })" @else
                                onclick="window.location.href='{{ route('event-package.filter', ['category' => $category->slug]) }}'"
                            @endif
                            class="px-4 py-2 bg-white text-gray-700 rounded-xl border border-gray-200 hover:border-purple-300 mb-2">
                            {{ $category->name }}
                            @if ($category->children->count())
                                <i class="fas fa-chevron-down ml-1 text-xs"></i>
                            @endif
                        </button>
                    @endforeach
                    <button wire:click="showAllCategories"
                        class="px-4 py-2 sm:px-6 sm:py-3 bg-purple-600 text-white rounded-xl font-semibold ml-2 mb-2 {{ !$selectedCategory ? 'ring-2 ring-purple-400' : '' }}">
                        {{ $showAllCategoriesMode ? 'Show Special Only' : 'View All' }}
                    </button>
                </div>
            </div>

            <!-- Packages Grid -->
            <div class="packages-section">
                @if ($selectedCategory || $searchQuery)
                    <div class="flex items-center justify-between mb-8">
                        <div class="text-gray-600">
                            @if ($searchQuery)
                                <span>Search results for: <strong>"{{ $searchQuery }}"</strong></span>
                            @endif
                            @if ($selectedCategory && $searchQuery)
                                <span class="mx-2">in</span>
                            @endif
                            @if ($selectedCategory)
                                @php
                                    $category = \App\Models\Category::where('slug', $selectedCategory)->first();
                                    $subCategory = $selectedSubCategory
                                        ? \App\Models\Category::where('slug', $selectedSubCategory)->first()
                                        : null;
                                @endphp
                                <span>{{ $category->name }}</span>
                                @if ($subCategory)
                                    <span> > {{ $subCategory->name }}</span>
                                @endif
                            @endif
                            <span class="ml-2 text-purple-600 font-semibold">({{ count($filteredPackages) }}
                                found)</span>
                        </div>
                        <div class="flex gap-3">
                            @if ($searchQuery)
                                <button wire:click="clearSearch" class="text-purple-600 hover:text-purple-800 font-medium">
                                    Clear Search
                                </button>
                            @endif
                            @if ($selectedCategory)
                                <button wire:click="showAllCategories"
                                    class="text-purple-600 hover:text-purple-800 font-medium">
                                    Show All Categories
                                </button>
                            @endif
                        </div>
                    </div>
                @endif

                @if (count($this->filteredPackages) > 0)
                    <div class="packages-grid">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($this->filteredPackages as $package)
                                <div class="package-card bg-white rounded-3xl shadow-xl overflow-hidden">
                                    <div class="relative h-56 overflow-hidden">
                                        <img src="{{ $package['image'] }}" alt="{{ $package['name'] }}"
                                            class="w-full h-full object-cover">
                                        @if (isset($package['popular']) && $package['popular'])
                                            <div class="absolute top-4 right-4">
                                                <span
                                                    class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-2 rounded-full text-sm font-bold">
                                                    <i class="fas fa-star mr-1"></i>Popular
                                                </span>
                                            </div>
                                        @endif
                                        @if (isset($package['rating']))
                                            <div class="absolute top-4 left-4">
                                                <div
                                                    class="bg-black/60 backdrop-blur-sm text-white px-3 py-2 rounded-full text-sm font-semibold flex items-center space-x-1">
                                                    <i class="fas fa-star text-yellow-400"></i>
                                                    <span>{{ $package['rating'] }}</span>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="absolute top-4 right-4">
                                            <livewire:public.components.wishlist-button :packageId="$package['id']" />
                                        </div>
                                        <div class="absolute bottom-4 left-4">
                                            <div
                                                class="bg-white/90 backdrop-blur-sm text-gray-800 px-3 py-2 rounded-full font-bold text-lg">
                                                ₹{{ number_format($package['price']) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-6">
                                        <h3 class="text-xl font-bold text-gray-800 mb-3">
                                            {{ $package['name'] }}
                                        </h3>
                                        <p class="text-gray-600 mb-4 leading-relaxed">
                                            {{\Illuminate\Support\Str::words($package['description'], 10, '...') }}
                                        </p>
                                        <div class="space-y-2 mb-6">
                                            @foreach (array_slice($package['features'], 0, 4) as $feature)
                                                <div class="flex items-center space-x-2">
                                                    <div
                                                        class="w-2 h-2 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex-shrink-0">
                                                    </div>
                                                    <span class="text-gray-700 text-sm">{{ $feature }}</span>
                                                </div>
                                            @endforeach
                                            @if (count($package['features']) > 4)
                                                <div class="text-purple-600 font-semibold text-sm">
                                                    +{{ count($package['features']) - 4 }} more features
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex space-x-3">
                                            <a href="{{ route('package-detail', ['id' => $package['id']]) }}"
                                                class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 px-4 rounded-xl font-semibold text-center">
                                                <i class="fas fa-eye mr-2"></i>
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- View More Button -->
                    @if ($this->hasMorePackages)
                        <div class="text-center mt-12" data-aos="fade-up">
                            <button wire:click="loadMorePackages"
                                class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-8 py-4 rounded-xl font-semibold text-lg hover:from-purple-700 hover:to-pink-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                                <i class="fas fa-plus-circle mr-2"></i>
                                View More Packages
                            </button>
                        </div>
                    @endif

                    <!-- Similar Packages Section -->
                    @if (count($this->similarPackages) > 0 && ($searchQuery || $selectedCategory))
                        <div class="mt-16">
                            <div class="text-center mb-12">
                                <h3 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                                    Similar Packages
                                </h3>
                                <p class="text-lg text-gray-600">
                                    @if ($selectedCategory)
                                        More packages from
                                        {{ $this->categories[$selectedCategory]['name'] ?? 'this category' }}
                                    @else
                                        You might also like these packages
                                    @endif
                                </p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach ($this->similarPackages as $package)
                                    <div
                                        class="package-card bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                                        <div class="relative h-56 overflow-hidden">
                                            <img src="{{ $package['image'] }}" alt="{{ $package['name'] }}"
                                                class="w-full h-full object-cover">
                                            @if (isset($package['popular']) && $package['popular'])
                                                <div class="absolute top-4 right-4">
                                                    <span
                                                        class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-2 rounded-full text-sm font-bold">
                                                        <i class="fas fa-star mr-1"></i>Popular
                                                    </span>
                                                </div>
                                            @endif
                                            <div class="absolute bottom-4 left-4">
                                                <div
                                                    class="bg-white/90 backdrop-blur-sm text-gray-800 px-3 py-2 rounded-full font-bold text-lg">
                                                    ₹{{ number_format($package['price']) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-6">
                                            <h4 class="text-xl font-bold text-gray-800 mb-3">
                                                {{ $package['name'] }}
                                            </h4>
                                            <p class="text-gray-600 mb-4 leading-relaxed line-clamp-2">
                                                {{ $package['description'] }}
                                            </p>
                                            <div class="flex space-x-3">
                                                <a href="{{ route('package-detail', ['id' => $package['id']]) }}"
                                                    class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 px-4 rounded-xl font-semibold text-center hover:from-purple-700 hover:to-pink-700 transform hover:scale-105 transition-all duration-300">
                                                    <i class="fas fa-eye mr-2"></i>
                                                    View Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @else
                    <div class="text-center py-20" data-aos="fade-up">
                        <div class="text-6xl text-gray-300 mb-6">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-600 mb-4">
                            @if ($selectedSubCategory)
                                No packages found in this subcategory
                            @else
                                No packages found
                            @endif
                        </h3>
                        <p class="text-gray-500 mb-8">
                            @if ($searchQuery && $selectedCategory)
                                Try different search terms or browse other categories
                            @elseif($searchQuery)
                                Try different search terms or browse by category
                            @elseif($selectedSubCategory)
                                This subcategory doesn't have any packages yet. Try browsing the main category or other
                                subcategories.
                            @elseif($selectedCategory)
                                No packages available in this category yet
                            @else
                                No packages available at the moment
                            @endif
                        </p>
                        <div class="space-x-4">
                            @if ($searchQuery)
                                <button wire:click="clearSearch"
                                    class="bg-purple-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-purple-700 transition-colors duration-300">
                                    Clear Search
                                </button>
                            @endif
                            @if ($selectedSubCategory)
                                <button wire:click="selectCategory('{{ $selectedCategory }}')"
                                    class="bg-purple-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-purple-700 transition-colors duration-300">
                                    View Main Category
                                </button>
                            @endif
                            @if ($selectedCategory)
                                <button wire:click="showAllCategories"
                                    class="border border-purple-600 text-purple-600 px-6 py-3 rounded-lg font-medium hover:bg-purple-50 transition-colors duration-300">
                                    Browse All Categories
                                </button>
                            @else
                                <button wire:click="showAllCategories"
                                    class="bg-purple-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-purple-700 transition-colors duration-300">
                                    Browse Categories
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- Similar Packages when no packages found -->
                    @if (count($this->similarPackages) > 0)
                        <div class="mt-16">
                            <div class="text-center mb-12">
                                <h3 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                                    You Might Like These
                                </h3>
                                <p class="text-lg text-gray-600">
                                    Popular packages from other categories
                                </p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach ($this->similarPackages as $package)
                                    <div
                                        class="package-card bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                                        <div class="relative h-56 overflow-hidden">
                                            <img src="{{ $package['image'] }}" alt="{{ $package['name'] }}"
                                                class="w-full h-full object-cover">
                                            @if (isset($package['popular']) && $package['popular'])
                                                <div class="absolute top-4 right-4">
                                                    <span
                                                        class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-2 rounded-full text-sm font-bold">
                                                        <i class="fas fa-star mr-1"></i>Popular
                                                    </span>
                                                </div>
                                            @endif
                                            <div class="absolute bottom-4 left-4">
                                                <div
                                                    class="bg-white/90 backdrop-blur-sm text-gray-800 px-3 py-2 rounded-full font-bold text-lg">
                                                    ₹{{ number_format($package['price']) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-6">
                                            <h4 class="text-xl font-bold text-gray-800 mb-3">
                                                {{ $package['name'] }}
                                            </h4>
                                            <p class="text-gray-600 mb-4 leading-relaxed line-clamp-2">
                                                {{ $package['description'] }}
                                            </p>
                                            <div class="flex space-x-3">
                                                <a href="{{ route('package-detail', ['id' => $package['id']]) }}"
                                                    class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 px-4 rounded-xl font-semibold text-center hover:from-purple-700 hover:to-pink-700 transform hover:scale-105 transition-all duration-300">
                                                    <i class="fas fa-eye mr-2"></i>
                                                    View Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </section>

    <livewire:public.section.enquiry-form />
    <livewire:public.components.bottom-navigation />
    <!-- Enhanced JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Removed hero carousel JS
        });

        // Enhanced Featured Packages Auto-scroll
        const featuredCarousel = document.querySelector('.featured-carousel');
        if (featuredCarousel) {
            let scrollAmount = 0;
            const cardWidth = 320; // w-80 = 320px
            const gap = 32; // gap-8 = 32px
            const totalWidth = cardWidth + gap;
            const totalCards = {{ count($this->featuredPackages) }};

            function autoScrollFeatured() {
                if (totalCards <= 1) return;

                scrollAmount += totalWidth;
                if (scrollAmount >= totalWidth * totalCards) {
                    scrollAmount = 0;
                }
                featuredCarousel.scrollTo({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            }

            // Auto-scroll every 4 seconds
            setInterval(autoScrollFeatured, 4000);

            // Manual navigation buttons
            const prevBtn = document.querySelector('.featured-prev');
            const nextBtn = document.querySelector('.featured-next');

            if (prevBtn) {
                prevBtn.addEventListener('click', function () {
                    scrollAmount -= totalWidth;
                    if (scrollAmount < 0) {
                        scrollAmount = totalWidth * (totalCards - 1);
                    }
                    featuredCarousel.scrollTo({
                        left: scrollAmount,
                        behavior: 'smooth'
                    });
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', function () {
                    scrollAmount += totalWidth;
                    if (scrollAmount >= totalWidth * totalCards) {
                        scrollAmount = 0;
                    }
                    featuredCarousel.scrollTo({
                        left: scrollAmount,
                        behavior: 'smooth'
                    });
                });
            }
        }

        // Enhanced Category Carousels Auto-scroll with smooth transitions
        @foreach ($this->categories as $key => $category)
            (function () {
                const carousel{{ ucfirst($key) }} = document.querySelector(
                    '.packages-carousel-{{ $key }} .carousel-track');
                if (carousel{{ ucfirst($key) }}) {
                    let scrollPos{{ ucfirst($key) }} = 0;
                    const cardWidth = 384; // w-96 = 384px
                    const gap = 32; // gap-8 = 32px  
                    const totalWidth = cardWidth + gap;
                    const totalCards = {{ count($this->featuredPackages) }};
                    let isScrolling{{ ucfirst($key) }} = false;

                    function autoScroll{{ ucfirst($key) }}() {
                        if (totalCards <= 1 || isScrolling{{ ucfirst($key) }}) return;

                        isScrolling{{ ucfirst($key) }} = true;
                        scrollPos{{ ucfirst($key) }} += totalWidth;

                        if (scrollPos{{ ucfirst($key) }} >= totalWidth * totalCards) {
                            scrollPos{{ ucfirst($key) }} = 0;
                        }

                        carousel{{ ucfirst($key) }}.style.transition = 'transform 0.8s ease-in-out';
                        carousel{{ ucfirst($key) }}.style.transform =
                            `translateX(-${scrollPos{{ ucfirst($key) }}}px)`;

                        // Reset scrolling flag after transition
                        setTimeout(() => {
                            isScrolling{{ ucfirst($key) }} = false;
                        }, 800);
                    }

                    // Staggered auto-scroll timing for visual variety
                    const scrollInterval = 3500 + ({{ $loop->index }} * 750);
                    let autoScrollTimer{{ ucfirst($key) }} = setInterval(autoScroll{{ ucfirst($key) }},
                        scrollInterval);

                    // Enhanced manual controls
                    const prevBtn = document.querySelector('.carousel-prev-{{ $key }}');
                    const nextBtn = document.querySelector('.carousel-next-{{ $key }}');

                    if (prevBtn) {
                        prevBtn.addEventListener('click', function () {
                            if (isScrolling{{ ucfirst($key) }}) return;

                            isScrolling{{ ucfirst($key) }} = true;
                            clearInterval(autoScrollTimer{{ ucfirst($key) }});

                            scrollPos{{ ucfirst($key) }} -= totalWidth;
                            if (scrollPos{{ ucfirst($key) }} < 0) {
                                scrollPos{{ ucfirst($key) }} = totalWidth * (totalCards - 1);
                            }

                            carousel{{ ucfirst($key) }}.style.transition = 'transform 0.5s ease-in-out';
                            carousel{{ ucfirst($key) }}.style.transform =
                                `translateX(-${scrollPos{{ ucfirst($key) }}}px)`;

                            setTimeout(() => {
                                isScrolling{{ ucfirst($key) }} = false;
                                autoScrollTimer{{ ucfirst($key) }} = setInterval(
                                    autoScroll{{ ucfirst($key) }}, scrollInterval);
                            }, 500);
                        });
                    }

                    if (nextBtn) {
                        nextBtn.addEventListener('click', function () {
                            if (isScrolling{{ ucfirst($key) }}) return;

                            clearInterval(autoScrollTimer{{ ucfirst($key) }});
                            autoScroll{{ ucfirst($key) }}();
                            autoScrollTimer{{ ucfirst($key) }} = setInterval(autoScroll{{ ucfirst($key) }},
                                scrollInterval);
                        });
                    }

                    // Pause auto-scroll on hover for better UX
                    const carouselContainer = document.querySelector('.packages-carousel-{{ $key }}');
                    if (carouselContainer) {
                        carouselContainer.addEventListener('mouseenter', function () {
                            clearInterval(autoScrollTimer{{ ucfirst($key) }});
                        });

                        carouselContainer.addEventListener('mouseleave', function () {
                            autoScrollTimer{{ ucfirst($key) }} = setInterval(autoScroll{{ ucfirst($key) }},
                                scrollInterval);
                        });
                    }
                }
            })();
        @endforeach

        // Category menu smooth scrolling
        document.addEventListener('livewire:initialized', function () {
            // Listen for category selection events
            window.addEventListener('category-selected', function (event) {
                if (event.detail && event.detail.category) {
                    const categorySection = document.querySelector(`#category-${event.detail.category}`);
                    if (categorySection) {
                        categorySection.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });

        // Enhanced search functionality with better UX
        const searchInput = document.querySelector('input[wire\\:model\\.live="searchQuery"]');
        if (searchInput) {
            let searchTimeout;

            searchInput.addEventListener('input', function (event) {
                // Clear existing timeout
                clearTimeout(searchTimeout);

                // Add loading indicator class
                searchInput.classList.add('searching');

                // Remove loading indicator after delay
                searchTimeout = setTimeout(() => {
                    searchInput.classList.remove('searching');
                }, 500);
            });
        }

        // Enhanced parallax scrolling effects
        window.addEventListener('scroll', function () {
            const scrolled = window.pageYOffset;
            const parallaxElements = document.querySelectorAll('.parallax-element');

            parallaxElements.forEach(function (element) {
                const speed = element.dataset.speed || 0.5;
                const yPos = -(scrolled * speed);
                element.style.transform = `translateY(${yPos}px)`;
            });
        });

        // Enhanced hover effects for package cards
        const packageCards = document.querySelectorAll('.package-card');
        packageCards.forEach(function (card) {
            card.addEventListener('mouseenter', function () {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });

            card.addEventListener('mouseleave', function () {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Enhanced loading animations
        function showLoadingState() {
            const packageGrid = document.querySelector('.packages-grid');
            if (packageGrid) {
                packageGrid.style.opacity = '0.6';
                packageGrid.style.pointerEvents = 'none';
            }
        }

        function hideLoadingState() {
            const packageGrid = document.querySelector('.packages-grid');
            if (packageGrid) {
                packageGrid.style.opacity = '1';
                packageGrid.style.pointerEvents = 'auto';
            }
        }

        // Listen for Livewire events
        document.addEventListener('livewire:request', showLoadingState);
        document.addEventListener('livewire:response', hideLoadingState);
    </script>

    <!-- Enhanced CSS for animations and effects -->
    <style>
        .carousel-slide {
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .carousel-slide.active {
            opacity: 1;
        }

        .searching {
            background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.1) 25%, transparent 25%),
                linear-gradient(-45deg, rgba(255, 255, 255, 0.1) 25%, transparent 25%),
                linear-gradient(45deg, transparent 75%, rgba(255, 255, 255, 0.1) 75%),
                linear-gradient(-45deg, transparent 75%, rgba(255, 255, 255, 0.1) 75%);
            background-size: 20px 20px;
            background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
            animation: slide 1s infinite linear;
        }

        @keyframes slide {
            0% {
                background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
            }

            100% {
                background-position: 20px 20px, 20px 30px, 30px 10px, 10px 20px;
            }
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .parallax-element {
            will-change: transform;
        }

        .package-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .featured-card {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .classic-package-card {
            transition: all 0.3s ease;
        }

        /* Enhanced gradient animations */
        .bg-gradient-to-br {
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Enhanced shadow effects */
        .shadow-3xl {
            box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.25);
        }

        /* Enhanced loading states */
        .loading-skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }
    </style>

    <livewire:public.components.category-popup />
</div>