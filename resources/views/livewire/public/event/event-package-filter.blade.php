<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-purple-50">
    <section class="py-20 bg-gradient-to-br from-gray-50 to-purple-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Heading for Filtered Packages -->
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                    Filtered Event Packages
                </h2>
                <p class="text-lg text-gray-600">
                    Browse packages based on your selected category and preferences.
                </p>
            </div>

            <!-- Filter Header -->
            <div class="flex items-center justify-between mb-8">
                <div class="text-gray-600">
                    @if ($selectedCategory)
                        @php
                            $category = \App\Models\Category::where('slug', $selectedCategory)->first();
                            $subCategory = $selectedSubCategory
                                ? \App\Models\Category::where('slug', $selectedSubCategory)->first()
                                : null;
                        @endphp
                        <span>{{ $category->name ?? '' }}</span>
                        @if ($subCategory)
                            <span> > {{ $subCategory->name }}</span>
                        @endif
                    @endif
                    <span class="ml-2 text-purple-600 font-semibold">({{ count($packages) }} found)</span>
                </div>
                <button wire:click="clearFilters" class="text-purple-600 hover:text-purple-800 font-medium">
                    Clear Filters
                </button>
            </div>

            <!-- Packages Grid -->
            @if (count($packages) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($packages as $package)
                        <div class="package-card bg-white rounded-3xl shadow-xl overflow-hidden">
                            <div class="relative h-56 overflow-hidden">
                                <img src="{{ $package->images->first()->image_url ?? 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=400&h=300&fit=crop' }}"
                                    alt="{{ $package->name }}" class="w-full h-full object-cover">
                                @if ($package->is_special)
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
                                        ₹{{ number_format($package->discounted_price) }}
                                    </div>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-3">
                                    {{ $package->name }}
                                </h3>
                                <p class="text-gray-600 mb-4 leading-relaxed">{{ $package->description }}</p>
                                <div class="space-y-2 mb-6">
                                    {{-- Replace the existing @foreach block with this: --}}
                                    <div class="space-y-2 mb-6">
                                        @php
                                            // Convert features to array if it's a string
                                            $features = is_array($package->features)
                                                ? $package->features
                                                : [$package->features];
                                            $features = array_slice($features, 0, 4);
                                        @endphp

                                        @foreach ($features as $feature)
                                            <div class="flex items-center space-x-2">
                                                <div
                                                    class="w-2 h-2 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex-shrink-0">
                                                </div>
                                                <span class="text-gray-700 text-sm">{{ $feature }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if (is_array($package->features) && count($package->features) > 4)
                                        <div class="text-purple-600 font-semibold text-sm">
                                            +{{ count($package->features) - 4 }} more features
                                        </div>
                                    @endif
                                </div>
                                <div class="flex space-x-3">
                                    <a href="{{ route('package-detail', ['id' => $package->id]) }}"
                                        class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 px-4 rounded-xl font-semibold text-center">
                                        <i class="fas fa-eye mr-2"></i>
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- No Results Found -->
                <div class="text-center py-20">
                    <div class="text-6xl text-gray-300 mb-6">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-600 mb-4">
                        No packages found
                    </h3>
                </div>
            @endif
            <!-- Similar Packages Section -->
            @if (count($similarPackages) > 0)
                <div class="mt-16">
                    <div class="text-center mb-12">
                        <h3 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                            Similar Packages
                        </h3>
                        <p class="text-lg text-gray-600">
                            You might also like these packages
                        </p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($similarPackages as $package)
                            <div
                                class="package-card bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                                <div class="relative h-56 overflow-hidden">
                                    <img src="{{ $package->images->first()->image_url ?? 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=400&h=300&fit=crop' }}"
                                        alt="{{ $package->name }}" class="w-full h-full object-cover">
                                    @if ($package->is_special)
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
                                            ₹{{ number_format($package->discounted_price) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h4 class="text-xl font-bold text-gray-800 mb-3">
                                        {{ $package->name }}
                                    </h4>
                                    <p class="text-gray-600 mb-4 leading-relaxed line-clamp-2">
                                        {{ $package->description }}</p>
                                    <div class="flex space-x-3">
                                        <a href="{{ route('package-detail', ['id' => $package->id]) }}"
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
        </div>
    </section>
</div>
