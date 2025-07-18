<div>
    <!-- Category Popup Modal -->
    @if($isOpen)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black/75 transition-opacity duration-300" 
                 wire:click="closePopup">
            </div>

            <!-- Modal -->
            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="relative w-full max-w-6xl bg-white rounded-3xl shadow-2xl transform transition-all duration-300 scale-100">
                    
                    <!-- Close Button -->
                    <button wire:click="closePopup" 
                            class="absolute top-4 right-4 z-10 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center text-gray-600 hover:text-gray-800 hover:bg-gray-50 transition-colors duration-200">
                        <i class="fas fa-times text-xl"></i>
                    </button>

                    <!-- Header -->
                    @if($selectedCategory)
                        <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white p-8 rounded-t-3xl">
                            <h2 class="text-3xl font-bold mb-2">{{ $selectedCategory->name }}</h2>
                            <p class="text-purple-100">Choose a subcategory to explore our amazing packages</p>
                        </div>
                    @endif

                    <!-- Content -->
                    <div class="p-8 max-h-[70vh] overflow-y-auto">
                        @if(!$selectedSubcategory)
                            <!-- Subcategories Grid -->
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-8">
                                @foreach($subcategories as $subcategory)
                                    <button wire:click="selectSubcategory({{ $subcategory->id }})"
                                            class="group bg-gradient-to-br from-purple-50 to-pink-50 hover:from-purple-100 hover:to-pink-100 rounded-xl p-6 text-center transition-all duration-300 hover:scale-105 border-2 border-transparent hover:border-purple-200 hover:shadow-lg">
                                        <div class="w-12 h-12 mx-auto mb-3 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-md">
                                            <i class="fas fa-star text-white"></i>
                                        </div>
                                        <h3 class="font-semibold text-gray-800 group-hover:text-purple-700 transition-colors duration-300">{{ $subcategory->name }}</h3>
                                        <p class="text-xs text-gray-500 mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">Click to explore</p>
                                    </button>
                                @endforeach
                            </div>
                        @else
                            <!-- Back Button -->
                            <button wire:click="$set('selectedSubcategory', null)" 
                                    class="mb-6 flex items-center text-purple-600 hover:text-purple-800 hover:bg-purple-50 px-3 py-2 rounded-lg transition-all duration-200">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Back to subcategories
                            </button>

                            <!-- Selected Subcategory Packages -->
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-gray-800 mb-6 text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">{{ $selectedSubcategory->name }} Packages</h3>
                                
                                @if($packages->count() > 0)
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                                        @foreach($packages as $package)
                                            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-purple-200 group">
                                                <div class="relative h-48 overflow-hidden">
                                                    <img src="{{ $package->images->first()?->image_url ?? 'https://via.placeholder.com/400x300' }}" 
                                                         alt="{{ $package->name }}"
                                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                                    <div class="absolute bottom-4 left-4 text-white">
                                                        <h4 class="font-bold text-lg drop-shadow-md">{{ $package->name }}</h4>
                                                        <p class="text-sm opacity-90 drop-shadow-sm">
                                                            <i class="fas fa-clock mr-1"></i>{{ $package->formatted_duration ?? 'N/A' }}
                                                        </p>
                                                    </div>
                                                </div>
                                                
                                                <div class="p-6">
                                                    <div class="text-center mb-4">
                                                        @if($package->discount_value > 0)
                                                            <div class="flex justify-center items-center space-x-2 mb-2">
                                                                <span class="text-gray-400 line-through text-lg">₹{{ number_format($package->price, 2) }}</span>
                                                                <span class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">₹{{ number_format($package->discounted_price, 2) }}</span>
                                                                <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded-full">
                                                                    {{ $package->discount_value }}{{ $package->discount_type === 'percentage' ? '%' : '₹' }} OFF
                                                                </span>
                                                            </div>
                                                        @else
                                                            <div class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600 mb-2">₹{{ number_format($package->price, 2) }}</div>
                                                        @endif
                                                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($package->description, 100) }}</p>
                                                    </div>
                                                    
                                                    <a href="{{ route('package-detail', ['id' => $package->id]) }}"
                                                       class="block w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white py-3 px-4 rounded-lg text-center font-semibold transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                                                        Book Now
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-12">
                                        <i class="fas fa-gift text-6xl text-gray-300 mb-4"></i>
                                        <h4 class="text-xl font-semibold text-gray-600 mb-2">No packages available</h4>
                                        <p class="text-gray-500">Check back soon for new packages in this category!</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Similar Packages -->
                            @if($similarPackages->count() > 0)
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-6">Similar Packages</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                        @foreach($similarPackages as $package)
                                            <div class="bg-gradient-to-br from-gray-50 to-purple-50 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-200 group">
                                                <div class="relative h-40 overflow-hidden">
                                                    <img src="{{ $package->images->first()?->image_url ?? 'https://via.placeholder.com/400x300' }}" 
                                                         alt="{{ $package->name }}"
                                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                                    <div class="absolute bottom-2 left-2 text-white">
                                                        <h4 class="font-semibold drop-shadow-md">{{ $package->name }}</h4>
                                                        <p class="text-xs opacity-90 drop-shadow-sm">{{ $package->category->name }}</p>
                                                    </div>
                                                </div>
                                                
                                                <div class="p-4">
                                                    <div class="text-center">
                                                        <div class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600 mb-2">₹{{ number_format($package->discounted_price ?? $package->price, 2) }}</div>
                                                        <a href="{{ route('package-detail', ['id' => $package->id]) }}"
                                                           class="block w-full bg-purple-100 hover:bg-purple-200 text-purple-700 py-2 px-3 rounded-lg text-center text-sm font-medium transition-colors duration-200">
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
            </div>
        </div>
    @endif
</div>
