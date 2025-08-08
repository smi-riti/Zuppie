<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-purple-50">
    <!-- Breadcrumb Section -->
    <section class="py-8 bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('event-packages') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-purple-600">
                            <i class="fas fa-home mr-2"></i>
                            Event Packages
                        </a>
                    </li>
                    @if ($selectedCategory)
                        @php
                            $category = \App\Models\Category::where('slug', $selectedCategory)->first();
                        @endphp
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mr-2"></i>
                                <span class="text-sm font-medium text-gray-500">{{ $category->name ?? '' }}</span>
                            </div>
                        </li>
                        @if ($selectedSubCategory)
                            @php
                                $subCategory = \App\Models\Category::where('slug', $selectedSubCategory)->first();
                            @endphp
                            <li>
                                <div class="flex items-center">
                                    <i class="fas fa-chevron-right text-gray-400 mr-2"></i>
                                    <span class="text-sm font-medium text-gray-500">{{ $subCategory->name ?? '' }}</span>
                                </div>
                            </li>
                        @endif
                    @endif
                    @if ($searchQuery)
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mr-2"></i>
                                <span class="text-sm font-medium text-gray-500">Search: "{{ $searchQuery }}"</span>
                            </div>
                        </li>
                    @endif
                </ol>
            </nav>
        </div>
    </section>

    <section class="py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-12">
                <h1 class="text-3xl md:text-5xl font-bold text-gray-800 mb-4">
                    @if ($selectedCategory)
                        @php
                            $category = \App\Models\Category::where('slug', $selectedCategory)->first();
                        @endphp
                        {{ $category->name ?? 'Filtered' }} Event Packages
                    @elseif ($searchQuery)
                        Search Results
                    @else
                        All Event Packages
                    @endif
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    @if ($searchQuery)
                        Showing results for "{{ $searchQuery }}"
                    @elseif ($selectedCategory)
                        Discover amazing packages for your special celebration
                    @else
                        Browse our complete collection of event packages
                    @endif
                </p>
            </div>

            <!-- Filter Header -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 bg-white rounded-xl p-6 shadow-lg">
                <div class="text-gray-600 mb-4 md:mb-0">
                    @if ($selectedCategory)
                        @php
                            $category = \App\Models\Category::where('slug', $selectedCategory)->first();
                        @endphp
                        <span class="font-medium">{{ $category->name ?? '' }}</span>
                        @if ($selectedSubCategory)
                            @php
                                $subCategory = \App\Models\Category::where('slug', $selectedSubCategory)->first();
                            @endphp
                            <span class="mx-2">></span>
                            <span class="font-medium">{{ $subCategory->name ?? '' }}</span>
                        @endif
                    @endif
                    <span class="ml-2 text-purple-600 font-bold text-lg">({{ count($packages) }} packages found)</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('event-packages') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition-all duration-300">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Browse
                    </a>
                    @if($selectedCategory || $selectedSubCategory || $searchQuery)
                        <button wire:click="clearFilters" 
                                class="inline-flex items-center px-4 py-2 bg-red-100 hover:bg-red-200 text-red-700 rounded-lg font-medium transition-all duration-300">
                            <i class="fas fa-times mr-2"></i>
                            Clear Filters
                        </button>
                    @endif
                </div>
            </div>

            <!-- Packages Grid -->
            @if (count($packages) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
                    @foreach ($packages as $package)
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl group">
                            <div class="relative h-48">
                                <img src="{{ $package->images->first()->image_url ?? 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=400&h=300&fit=crop' }}" 
                                     alt="{{ $package->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @if($package->is_special)
                                    <div class="absolute top-4 right-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white px-3 py-1 rounded-full text-xs font-medium">
                                        Special
                                    </div>
                                @endif
                                <button class="absolute top-4 left-4 text-white bg-black/40 p-2 rounded-full hover:bg-black/60 transition-all duration-300 wishlist-btn">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-purple-600 transition-colors">
                                    {{ $package->name }}
                                </h3>
                                <div class="flex items-center mb-3">
                                    <span class="text-2xl font-bold text-purple-600">₹{{ number_format($package->discounted_price) }}</span>
                                    @if($package->price != $package->discounted_price)
                                        <span class="text-lg text-gray-500 line-through ml-2">₹{{ number_format($package->price) }}</span>
                                    @endif
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">{{ Str::limit($package->description, 100) }}</p>
                                @if($package->features)
                                    <ul class="text-gray-600 mb-4 text-sm space-y-1">
                                        @foreach(array_slice($package->features, 0, 3) as $feature)
                                            <li class="flex items-center">
                                                <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                                                {{ $feature }}
                                            </li>
                                        @endforeach
                                        @if(count($package->features) > 3)
                                            <li class="text-purple-600 text-xs font-medium">
                                                +{{ count($package->features) - 3 }} more features
                                            </li>
                                        @endif
                                    </ul>
                                @endif
                                <div class="flex items-center text-gray-500 mb-4 text-sm">
                                    <i class="fas fa-tag mr-2"></i>
                                    <span>{{ $package->category->name ?? 'General' }}</span>
                                </div>
                                <a href="{{ route('package-detail', $package->slug) }}" 
                                   class="block w-full py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-lg font-medium hover:opacity-90 transition-all duration-300 text-center transform hover:scale-105">
                                    View Details
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Load More Button -->
                @if($hasMorePackages)
                    <div class="text-center">
                        <button wire:click="loadMorePackages" 
                                class="px-8 py-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-full font-medium hover:opacity-90 transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-plus mr-2"></i>
                            Load More Packages
                        </button>
                    </div>
                @endif
            @else
                <!-- No Results Found -->
                <div class="text-center py-20">
                    <div class="text-6xl text-gray-300 mb-6">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-600 mb-4">
                        No packages found
                    </h3>
                    <p class="text-gray-500 mb-8 max-w-md mx-auto">
                        @if($searchQuery)
                            We couldn't find any packages matching "{{ $searchQuery }}". Try different keywords or browse our categories.
                        @else
                            No packages are available in this category at the moment. Please check back later or explore other categories.
                        @endif
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('event-packages') }}" 
                           class="px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-full font-medium hover:opacity-90 transition-all duration-300">
                            Browse All Packages
                        </a>
                        @if($searchQuery)
                            <button wire:click="$set('searchQuery', '')" 
                                    class="px-6 py-3 bg-gray-200 text-gray-700 rounded-full font-medium hover:bg-gray-300 transition-all duration-300">
                                Clear Search
                            </button>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Similar Packages Section -->
            @if (count($similarPackages) > 0)
                <div class="mt-20">
                    <div class="text-center mb-12">
                        <h3 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                            You Might Also Like
                        </h3>
                        <p class="text-lg text-gray-600">
                            Discover more amazing packages for your celebration
                        </p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach ($similarPackages as $package)
                            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl group">
                                <div class="relative h-48">
                                    <img src="{{ $package->images->first()->image_url ?? 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=400&h=300&fit=crop' }}" 
                                         alt="{{ $package->name }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @if($package->is_special)
                                        <div class="absolute top-4 right-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white px-3 py-1 rounded-full text-xs font-medium">
                                            Special
                                        </div>
                                    @endif
                                    <button class="absolute top-4 left-4 text-white bg-black/40 p-2 rounded-full hover:bg-black/60 transition-all duration-300 wishlist-btn">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-purple-600 transition-colors">
                                        {{ $package->name }}
                                    </h3>
                                    <div class="flex items-center mb-3">
                                        <span class="text-2xl font-bold text-purple-600">₹{{ number_format($package->discounted_price) }}</span>
                                        @if($package->price != $package->discounted_price)
                                            <span class="text-lg text-gray-500 line-through ml-2">₹{{ number_format($package->price) }}</span>
                                        @endif
                                    </div>
                                    <p class="text-gray-600 mb-4 text-sm">{{ Str::limit($package->description, 100) }}</p>
                                    <a href="{{ route('package-detail', $package->slug) }}" 
                                       class="block w-full py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-lg font-medium hover:opacity-90 transition-all duration-300 text-center transform hover:scale-105">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
    
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
        });
    </script>

    <style>
        .wishlist-btn.active {
            color: #ec4899;
        }
    </style>
</div>
