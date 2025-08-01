<div class="min-h-screen bg-gray-50">
    <!-- Hero Section with Background Image -->
    <div class="relative bg-gradient-to-br from-zuppie-pink-500 via-zuppie-600 to-purple-700 text-white py-24 overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-black/30 z-10"></div>
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2072&q=80')] bg-cover bg-center bg-no-repeat opacity-20"></div>
        
        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 w-20 h-20 bg-white/10 rounded-full blur-xl animate-float"></div>
        <div class="absolute top-32 right-20 w-32 h-32 bg-zuppie-pink-400/20 rounded-full blur-2xl animate-float-slow"></div>
        <div class="absolute bottom-20 left-1/4 w-16 h-16 bg-purple-400/20 rounded-full blur-lg animate-float-slower"></div>
        
        <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-5xl md:text-7xl font-bold mb-6 bg-gradient-to-r from-white to-zuppie-100 bg-clip-text text-transparent">
                    Our Blog
                </h1>
                <p class="text-xl md:text-2xl text-white/90 mb-8 max-w-3xl mx-auto">
                    Discover stories, insights, and experiences that inspire and inform
                </p>
                
                <!-- Enhanced Search Bar in Hero -->
                <div class="max-w-2xl mx-auto">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-6 w-6 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input wire:model.live.debounce.300ms="search" 
                               type="text" 
                               class="block w-full pl-12 pr-4 py-4 text-lg border-0 rounded-2xl bg-white/20 backdrop-blur-sm text-white placeholder-white/70 focus:outline-none focus:ring-4 focus:ring-white/30 focus:bg-white/30 transition-all duration-300" 
                               placeholder="Search for amazing blog posts...">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Decorative waves -->
        <div class="absolute bottom-0 w-full">
            <svg class="w-full h-16 text-gray-50" fill="currentColor" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"></path>
            </svg>
        </div>
    </div>

    <!-- Categories Showcase Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
                Explore by <span class="bg-gradient-to-r from-zuppie-500 to-zuppie-pink-500 bg-clip-text text-transparent">Categories</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Discover content tailored to your interests across our diverse range of topics
            </p>
        </div>

        <!-- Featured Categories Grid -->
        @if($featuredCategories->isNotEmpty())
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 mb-8">
                @foreach($featuredCategories as $category)
                    <button wire:click="selectCategory({{ $category->id }})"
                        class="group relative p-6 bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-zuppie-200 hover:-translate-y-1 {{ $selectedCategory == $category->id ? 'ring-2 ring-zuppie-500 bg-zuppie-50' : '' }}">
                        <div class="text-center">
                            <!-- Category Icon (you can add specific icons based on category name) -->
                            <div class="w-12 h-12 mx-auto mb-3 rounded-full {{ $selectedCategory == $category->id ? 'bg-zuppie-500' : 'bg-gradient-to-br from-zuppie-100 to-zuppie-200' }} flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 {{ $selectedCategory == $category->id ? 'text-white' : 'text-zuppie-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <h3 class="font-semibold text-gray-900 mb-1 group-hover:text-zuppie-600 transition-colors">
                                {{ $category->name }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                {{ $category->blogs_count }} {{ Str::plural('post', $category->blogs_count) }}
                            </p>
                        </div>
                    </button>
                @endforeach
            </div>

            <!-- View All Categories Toggle -->
            @if($categories->count() > 9)
                <div class="text-center">
                    <button wire:click="toggleCategoriesView" 
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-700 font-medium rounded-xl transition-all duration-300 shadow-sm hover:shadow-md">
                        @if($showAllCategories)
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                            </svg>
                            Show Less Categories
                        @else
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                            View All {{ $categories->count() }} Categories
                        @endif
                    </button>
                </div>
            @endif

            <!-- All Categories Modal/Expanded View -->
            @if($showAllCategories)
                <div class="mt-8 p-8 bg-white rounded-2xl shadow-lg border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-gray-900">All Categories</h3>
                        <button wire:click="toggleCategoriesView" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4">
                        @foreach($categories as $category)
                            <button wire:click="selectCategory({{ $category->id }})"
                                class="group p-4 bg-gray-50 rounded-xl hover:bg-zuppie-50 transition-all duration-200 text-left {{ $selectedCategory == $category->id ? 'bg-zuppie-100 ring-1 ring-zuppie-500' : '' }}">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 rounded-lg {{ $selectedCategory == $category->id ? 'bg-zuppie-500' : 'bg-zuppie-200' }} flex items-center justify-center">
                                        <svg class="w-4 h-4 {{ $selectedCategory == $category->id ? 'text-white' : 'text-zuppie-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900 group-hover:text-zuppie-600">{{ $category->name }}</h4>
                                        <p class="text-xs text-gray-500">{{ $category->blogs_count }} posts</p>
                                    </div>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif
    </div>

    <!-- Filters Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
            <div class="flex flex-col lg:flex-row gap-4 items-start lg:items-center justify-between">
                <!-- Current Filters Display -->
                <div class="flex-1">
                    @if($search || $selectedCategory)
                        <div class="flex flex-wrap items-center gap-2 mb-4 lg:mb-0">
                            <span class="text-sm font-medium text-gray-700 mr-2">Active filters:</span>
                            @if($search)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-zuppie-100 text-zuppie-800">
                                    Search: "{{ $search }}"
                                    <button wire:click="$set('search', '')" class="ml-2 text-zuppie-600 hover:text-zuppie-800">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                            @if($selectedCategory)
                                @php $selectedCat = $categories->firstWhere('id', $selectedCategory) @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    Category: {{ $selectedCat->name ?? 'Unknown' }}
                                    <button wire:click="$set('selectedCategory', '')" class="ml-2 text-blue-600 hover:text-blue-800">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Results Count and Clear Filters -->
                <div class="flex items-center gap-4">
                    @if($blogs->total() > 0)
                        <p class="text-sm text-gray-600">
                            {{ number_format($blogs->total()) }} {{ Str::plural('result', $blogs->total()) }}
                        </p>
                    @endif
                    
                    @if($search || $selectedCategory)
                        <button wire:click="clearFilters" 
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Clear All
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Posts Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        @if($blogs->isEmpty())
            <div class="text-center py-20">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">No blog posts found</h3>
                    <p class="text-gray-600 mb-6">
                        @if($search || $selectedCategory)
                            We couldn't find any posts matching your criteria. Try adjusting your search or explore other categories.
                        @else
                            Our content team is working hard to bring you amazing stories. Check back soon!
                        @endif
                    </p>
                    @if($search || $selectedCategory)
                        <button wire:click="clearFilters" 
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-zuppie-500 to-zuppie-pink-500 hover:from-zuppie-600 hover:to-zuppie-pink-600 text-white font-medium rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                            View All Posts
                        </button>
                    @endif
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($blogs as $blog)
                    <article class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-zuppie-200 hover:-translate-y-2">
                        <!-- Blog Image -->
                        <div class="relative overflow-hidden">
                            @if($blog->featuredImage)
                                <div class="aspect-w-16 aspect-h-10">
                                    <img src="{{ $blog->featuredImage->image_url }}" 
                                         alt="{{ $blog->title }}"
                                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                            @else
                                <div class="w-full h-64 bg-gradient-to-br from-zuppie-100 via-zuppie-200 to-zuppie-300 flex items-center justify-center group-hover:from-zuppie-200 group-hover:to-zuppie-400 transition-all duration-500">
                                    <div class="text-center">
                                        <svg class="w-16 h-16 text-zuppie-500 mx-auto mb-2 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                        </svg>
                                        <p class="text-zuppie-600 font-medium">{{ $blog->title }}</p>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Category Badge Overlay -->
                            @if($blog->category)
                                <div class="absolute top-4 left-4">
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-white/90 backdrop-blur-sm text-zuppie-700 shadow-lg border border-white/20">
                                        {{ $blog->category->name }}
                                    </span>
                                </div>
                            @endif
                            
                            <!-- Reading Time Badge -->
                            <div class="absolute top-4 right-4">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-black/50 text-white backdrop-blur-sm">
                                    {{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min read
                                </span>
                            </div>
                        </div>

                        <!-- Blog Content -->
                        <div class="p-8">
                            <!-- Date and Author -->
                            <div class="flex items-center justify-between mb-4">
                                <time class="text-sm font-medium text-gray-500 flex items-center">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $blog->created_at->format('M j, Y') }}
                                </time>
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ $blog->author->name ?? 'Admin' }}
                                </div>
                            </div>

                            <!-- Title -->
                            <h2 class="text-xl font-bold text-gray-900 mb-4 line-clamp-2 group-hover:text-zuppie-600 transition-colors duration-300">
                                <a href="/blog/{{ $blog->slug }}" class="hover:text-zuppie-600">
                                    {{ $blog->title }}
                                </a>
                            </h2>

                            <!-- Excerpt -->
                            <div class="text-gray-600 mb-6 line-clamp-3 leading-relaxed">
                                {!! \Illuminate\Support\Str::limit(strip_tags($blog->content), 150) !!}
                            </div>

                            <!-- Read More Button -->
                            <div class="flex items-center justify-between">
                                <a href="/blog/{{ $blog->slug }}" 
                                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-zuppie-500 to-zuppie-pink-500 hover:from-zuppie-600 hover:to-zuppie-pink-600 text-white font-medium rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl group-hover:scale-105">
                                    Read More
                                    <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                                
                                <!-- Social Share Button -->
                                <button class="p-3 text-gray-400 hover:text-zuppie-500 hover:bg-zuppie-50 rounded-xl transition-all duration-300"
                                    onclick="navigator.share ? navigator.share({title: '{{ addslashes($blog->title) }}', url: '{{ url('/blog/' . $blog->slug) }}'}) : window.open('https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(url('/blog/' . $blog->slug)) }}', '_blank')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Enhanced Pagination -->
            <div class="mt-16">
                <div class="flex items-center justify-center">
                    {{ $blogs->links() }}
                </div>
            </div>
        @endif
    </div>

    <!-- Call to Action Section -->
    <div class="bg-gradient-to-r from-zuppie-500 via-zuppie-pink-500 to-purple-600 py-16">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Stay Updated with Our Latest Posts
            </h2>
            <p class="text-xl text-white/90 mb-8">
                Subscribe to our newsletter and never miss out on amazing content
            </p>
            <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                <input type="email" placeholder="Enter your email" 
                    class="flex-1 px-6 py-4 rounded-xl border-0 focus:outline-none focus:ring-4 focus:ring-white/30 text-gray-900">
                <button class="px-8 py-4 bg-white text-zuppie-600 font-bold rounded-xl hover:bg-gray-100 transition-colors duration-300 shadow-lg">
                    Subscribe
                </button>
            </div>
        </div>
    </div>

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
    </style>
</div>

