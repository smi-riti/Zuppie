<div class="min-h-screen bg-gray-50">
    <!-- Hero Section with Background Image -->
    <div class="relative bg-gradient-to-br from-zuppie-pink-500 via-zuppie-600 to-purple-700 text-white py-16 sm:py-20 lg:py-24 overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-black/30 z-10"></div>
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2072&q=80')] bg-cover bg-center bg-no-repeat opacity-20"></div>
        
        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 w-20 h-20 bg-white/10 rounded-full blur-xl animate-float"></div>
        <div class="absolute top-32 right-20 w-32 h-32 bg-zuppie-pink-400/20 rounded-full blur-2xl animate-float-slow"></div>
        <div class="absolute bottom-20 left-1/4 w-16 h-16 bg-purple-400/20 rounded-full blur-lg animate-float-slower"></div>
        
        <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mt-2">
                <h1 class="text-4xl sm:text-3xl md:text-5xl font-bold mt-4 bg-gradient-to-r from-white to-zuppie-100 bg-clip-text text-transparent">
                    Our Blog
                </h1>
                <p class="text-lg sm:text-xl md:text-2xl text-white/90 mb-6 sm:mb-8 max-w-3xl mx-auto">
                    Discover stories, insights, and experiences that inspire and inform
                </p>
                
                <!-- Enhanced Search Bar in Hero -->
                <div class="max-w-2xl mx-auto">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                            <svg class="h-5 w-5 sm:h-6 sm:w-6 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input wire:model.live.debounce.300ms="search" 
                               type="text" 
                               class="block w-full pl-10 sm:pl-12 pr-4 py-3 sm:py-4 text-base sm:text-lg border-0 rounded-2xl bg-white/20 backdrop-blur-sm text-white placeholder-white/70 focus:outline-none focus:ring-4 focus:ring-white/30 focus:bg-white/30 transition-all duration-300" 
                               placeholder="Search for amazing blog posts...">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Decorative waves -->
        <div class="absolute bottom-0 w-full">
            <svg class="w-full h-12 sm:h-16 text-gray-50" fill="currentColor" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"></path>
            </svg>
        </div>
    </div>

    <!-- Categories Section - Mobile/Tablet: Horizontal Scroll, Desktop: Sidebar -->
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 lg:py-12">
        <!-- Mobile & Tablet: Horizontal Scrollable Categories -->
        <div class="block lg:hidden mb-8">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-900">
                    <span class="bg-gradient-to-r from-zuppie-500 to-zuppie-pink-500 bg-clip-text text-transparent">Categories</span>
                </h2>
                @if($search || $selectedCategory)
                    <button wire:click="clearFilters" 
                        class="text-sm text-gray-500 hover:text-zuppie-600 transition-colors">
                        Clear All
                    </button>
                @endif
            </div>
            
            <!-- Horizontal Scrollable Categories -->
            <div class="overflow-x-auto scrollbar-hide">
                <div class="flex space-x-3 pb-2" style="width: max-content;">
                    <!-- All Categories Button -->
                    <button wire:click="selectCategory('')"
                        class="flex-shrink-0 px-4 py-2 rounded-full border-2 transition-all duration-200 {{ !$selectedCategory ? 'bg-zuppie-500 border-zuppie-500 text-white' : 'bg-white border-gray-200 text-gray-700 hover:border-zuppie-300' }}">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <span class="font-medium whitespace-nowrap">All ({{ $blogs->total() }})</span>
                        </div>
                    </button>

                    <!-- Category Buttons -->
                    @foreach($categories as $category)
                        <button wire:click="selectCategory({{ $category->id }})"
                            class="flex-shrink-0 px-4 py-2 rounded-full border-2 transition-all duration-200 {{ $selectedCategory == $category->id ? 'bg-zuppie-500 border-zuppie-500 text-white' : 'bg-white border-gray-200 text-gray-700 hover:border-zuppie-300' }}">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                <span class="font-medium whitespace-nowrap">{{ $category->name }} ({{ $category->blogs_count }})</span>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Active Filters for Mobile -->
            @if($search || $selectedCategory)
                <div class="mt-4 p-4 bg-white rounded-xl shadow-sm border border-gray-100">
                    <h3 class="text-sm font-bold text-gray-900 mb-2">Active Filters</h3>
                    <div class="flex flex-wrap gap-2">
                        @if($search)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-zuppie-100 text-zuppie-800">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                "{{ $search }}"
                                <button wire:click="$set('search', '')" class="ml-1 text-zuppie-600 hover:text-zuppie-800">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </span>
                        @endif
                        @if($selectedCategory)
                            @php $selectedCat = $categories->firstWhere('id', $selectedCategory) @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                {{ $selectedCat->name ?? 'Unknown' }}
                                <button wire:click="$set('selectedCategory', '')" class="ml-1 text-blue-600 hover:text-blue-800">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </span>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Desktop: Grid Layout with Sidebar -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Desktop Sidebar -->
            <div class="hidden lg:block lg:col-span-1">
                <div class="sticky top-8">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-bold text-gray-900">
                                <span class="bg-gradient-to-r from-zuppie-500 to-zuppie-pink-500 bg-clip-text text-transparent">Categories</span>
                            </h2>
                            @if($search || $selectedCategory)
                                <button wire:click="clearFilters" 
                                    class="text-sm text-gray-500 hover:text-zuppie-600 transition-colors">
                                    Clear All
                                </button>
                            @endif
                        </div>

                        <!-- All Categories Button -->
                        <button wire:click="selectCategory('')"
                            class="w-full p-3 mb-3 text-left rounded-xl transition-all duration-200 {{ !$selectedCategory ? 'bg-zuppie-100 text-zuppie-700 ring-1 ring-zuppie-500' : 'bg-gray-50 hover:bg-gray-100 text-gray-700' }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 rounded-lg {{ !$selectedCategory ? 'bg-zuppie-500' : 'bg-gray-300' }} flex items-center justify-center">
                                        <svg class="w-4 h-4 {{ !$selectedCategory ? 'text-white' : 'text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium">All Categories</h4>
                                        <p class="text-xs text-gray-500">{{ $blogs->total() }} posts</p>
                                    </div>
                                </div>
                            </div>
                        </button>

                        <!-- All Categories -->
                        @foreach($categories as $category)
                            <button wire:click="selectCategory({{ $category->id }})"
                                class="w-full p-3 mb-2 text-left rounded-xl transition-all duration-200 {{ $selectedCategory == $category->id ? 'bg-zuppie-100 text-zuppie-700 ring-1 ring-zuppie-500' : 'bg-gray-50 hover:bg-gray-100 text-gray-700' }}">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-lg {{ $selectedCategory == $category->id ? 'bg-zuppie-500' : 'bg-gray-300' }} flex items-center justify-center">
                                            <svg class="w-4 h-4 {{ $selectedCategory == $category->id ? 'text-white' : 'text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-medium">{{ $category->name }}</h4>
                                            <p class="text-xs text-gray-500">{{ $category->blogs_count }} posts</p>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        @endforeach

                        <!-- Active Filters Display -->
                        @if($search || $selectedCategory)
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <h3 class="text-sm font-bold text-gray-900 mb-3">Active Filters</h3>
                                <div class="space-y-2">
                                    @if($search)
                                        <div class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium bg-zuppie-100 text-zuppie-800">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                            "{{ $search }}"
                                            <button wire:click="$set('search', '')" class="ml-2 text-zuppie-600 hover:text-zuppie-800">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    @endif
                                    @if($selectedCategory)
                                        @php $selectedCat = $categories->firstWhere('id', $selectedCategory) @endphp
                                        <div class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium bg-blue-100 text-blue-800">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                            {{ $selectedCat->name ?? 'Unknown' }}
                                            <button wire:click="$set('selectedCategory', '')" class="ml-2 text-blue-600 hover:text-blue-800">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="lg:col-span-3" id="blog-results">
                <!-- Results Header -->
                <div class="mb-6 sm:mb-8">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">
                        @if($search)
                            Search Results for "{{ $search }}"
                        @elseif($selectedCategory)
                            @php $selectedCat = $categories->firstWhere('id', $selectedCategory) @endphp
                            {{ $selectedCat->name ?? 'Category' }} Posts
                        @else
                            Latest Blog Posts
                        @endif
                    </h2>
                    @if($blogs->total() > 0)
                        <p class="text-gray-600">
                            {{ number_format($blogs->total()) }} {{ Str::plural('post', $blogs->total()) }} found
                        </p>
                    @endif
                </div>

                @if($blogs->count() > 0)
                    <!-- Blog Cards Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-2 gap-4 sm:gap-6 mb-8">
                        @foreach($blogs as $blog)
                            <article class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 hover:-translate-y-1 border border-gray-100">
                                <!-- Blog Image -->
                                <div class="relative h-44 sm:h-48 overflow-hidden">
                                    @if($blog->featuredImage)
                                        <img src="{{ $blog->featuredImage->image_url }}" 
                                             alt="{{ $blog->title }}"
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-zuppie-100 via-zuppie-200 to-zuppie-300 flex items-center justify-center">
                                            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-zuppie-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <!-- Gradient Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    
                                    <!-- Category Badge -->
                                    @if($blog->category)
                                        <div class="absolute top-3 left-3">
                                            <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-medium bg-white/90 backdrop-blur-sm text-zuppie-700 shadow-sm">
                                                {{ $blog->category->name }}
                                            </span>
                                        </div>
                                    @endif

                                    <!-- Read Time Badge -->
                                    <div class="absolute top-3 right-3">
                                        <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-medium bg-black/20 backdrop-blur-sm text-white">
                                            {{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min
                                        </span>
                                    </div>
                                </div>

                                <!-- Blog Content -->
                                <div class="p-4 sm:p-6">
                                    <!-- Date and Author -->
                                    <div class="flex items-center justify-between mb-3 text-xs sm:text-sm">
                                        <time class="font-medium text-gray-500 flex items-center">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $blog->created_at->format('M d, Y') }}
                                        </time>
                                        <div class="flex items-center text-gray-500">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            {{ $blog->author->name ?? 'Admin' }}
                                        </div>
                                    </div>

                                    <!-- Title -->
                                    <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-2 sm:mb-3 line-clamp-2 group-hover:text-zuppie-600 transition-colors duration-300">
                                        <a href="/blog/{{ $blog->slug }}" class="hover:text-zuppie-600">
                                            {{ $blog->title }}
                                        </a>
                                    </h3>

                                    <!-- Excerpt -->
                                    <div class="text-gray-600 mb-4 line-clamp-2 leading-relaxed text-sm">
                                        {!! \Illuminate\Support\Str::limit(strip_tags($blog->content), 100) !!}
                                    </div>

                                    <!-- Read More Button -->
                                    <div class="flex items-center justify-between">
                                        <a href="/blog/{{ $blog->slug }}" 
                                           class="inline-flex items-center px-3 sm:px-4 py-2 bg-gradient-to-r from-zuppie-500 to-zuppie-pink-500 hover:from-zuppie-600 hover:to-zuppie-pink-600 text-white font-medium rounded-lg text-xs sm:text-sm transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105">
                                            Read More
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 ml-1 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                            </svg>
                                        </a>

                                        <!-- Share Button -->
                                        <button class="p-2 text-gray-400 hover:text-zuppie-500 hover:bg-zuppie-50 rounded-lg transition-all duration-300"
                                            onclick="navigator.share ? navigator.share({title: '{{ addslashes($blog->title) }}', url: '{{ url('/blog/' . $blog->slug) }}'}) : window.open('https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(url('/blog/' . $blog->slug)) }}', '_blank')">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Status Indicator (if needed for admin) -->
                                @if($blog->status === 'draft')
                                    <div class="absolute top-2 right-2">
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Draft
                                        </span>
                                    </div>
                                @endif
                            </article>
                        @endforeach
                    </div>

                    <!-- Enhanced Pagination -->
                    <div class="flex justify-center">
                        {{ $blogs->links() }}
                    </div>

                @else
                    <!-- Enhanced Empty State -->
                    <div class="text-center py-16">
                        <div class="max-w-md mx-auto">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-6 bg-gradient-to-br from-zuppie-100 to-zuppie-200 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-zuppie-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                </svg>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-4">No blogs found</h3>
                            @if($search || $selectedCategory)
                                <p class="text-gray-600 mb-6">
                                    We couldn't find any blogs matching your current filters. Try adjusting your search terms or browse all categories.
                                </p>
                                <button wire:click="clearFilters" 
                                    class="inline-flex items-center px-4 sm:px-6 py-2 sm:py-3 bg-gradient-to-r from-zuppie-500 to-zuppie-pink-500 hover:from-zuppie-600 hover:to-zuppie-pink-600 text-white font-medium rounded-xl transition-all duration-300 shadow-md hover:shadow-lg">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Show All Blogs
                                </button>
                            @else
                                <p class="text-gray-600">
                                    No blogs have been published yet. Check back soon for exciting content!
                                </p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Auto-scroll JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Listen for the scroll-to-results event
            window.addEventListener('scroll-to-results', function() {
                const resultsElement = document.getElementById('blog-results');
                if (resultsElement) {
                    resultsElement.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'start' 
                    });
                }
            });

            // Listen for Livewire events
            if (typeof Livewire !== 'undefined') {
                Livewire.on('scroll-to-results', () => {
                    const resultsElement = document.getElementById('blog-results');
                    if (resultsElement) {
                        setTimeout(() => {
                            resultsElement.scrollIntoView({ 
                                behavior: 'smooth', 
                                block: 'start' 
                            });
                        }, 100);
                    }
                });
            }
        });
    </script>

    <style>
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

        /* Hide scrollbar for horizontal scroll */
        .scrollbar-hide {
            -ms-overflow-style: none;  /* Internet Explorer 10+ */
            scrollbar-width: none;  /* Firefox */
        }
        .scrollbar-hide::-webkit-scrollbar { 
            display: none;  /* Safari and Chrome */
        }

        /* Floating animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(2deg); }
        }
        
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(-1deg); }
        }
        
        @keyframes float-slower {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(1deg); }
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

        /* Enhanced backdrop blur support */
        @supports (backdrop-filter: blur(10px)) {
            .backdrop-blur-sm {
                backdrop-filter: blur(4px);
            }
        }

        /* Sticky sidebar */
        .sticky {
            position: -webkit-sticky;
            position: sticky;
        }

        /* Mobile optimizations */
        @media (max-width: 768px) {
            .grid.grid-cols-1.sm\:grid-cols-2 {
                grid-template-columns: 1fr;
            }
        }

        /* Tablet optimizations */
        @media (min-width: 640px) and (max-width: 1023px) {
            .grid.grid-cols-1.sm\:grid-cols-2 {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</div>

