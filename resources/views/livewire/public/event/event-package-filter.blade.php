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
                                <div class="absolute top-4 left-4">
                                    <livewire:public.components.wishlist-button :packageId="$package->id"/>
                                </div>
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

                                <!-- Fixed features Section -->
                                <div class="mb-4">
                                    <h4 class="text-lg font-semibold text-gray-800 mb-2 flex items-center">
                                        Inclusions
                                    </h4>

                                    @php
                                        // Handle different inclusion formats
                                        $features = [];

                                        if (is_array($package->features)) {
                                            // Already an array
                                            $features = $package->features;
                                        } elseif (is_string($package->features)) {
                                            // Try to decode as JSON first
                                            $decoded = json_decode($package->features, true);
                                            if (json_last_error() === JSON_ERROR_NONE) {
                                                $features = $decoded;
                                            } else {
                                                // Fallback to explode if JSON decode fails
                                                $features = array_filter(
                                                    array_map('trim', explode(',', $package->features)),
                                                    function ($item) {
                                                        return !empty($item); }
                                                );
                                            }
                                        }

                                        // Ensure we have an array
                                        $features = is_array($features) ? $features : [];
                                    @endphp

                                    <ul class="features-list space-y-2 max-h-40 overflow-y-auto pr-2">
                                        @foreach(array_slice($features, 0, 3) as $inclusion)
                                            <li class="flex gap-3 items-start">
                                                <i class="fa-solid fa-check text-xl" style="color: #00b30c;"></i>
                                                <span class="text-gray-700">{!! $inclusion !!}</span>
                                            </li>
                                        @endforeach
                                    </ul>

                                    @if(count($features) > 3)
                                        <div x-data="{ showAll: false }">
                                            <ul class="features-list space-y-2 mt-2 pr-2" x-show="showAll" x-collapse>
                                                @foreach(array_slice($features, 3) as $inclusion)
                                                    <li class="flex gap-3 items-start">
                                                        <i class="fa-solid fa-check text-xl" style="color: #00b30c;"></i>
                                                        <span class="text-gray-700">{!! $inclusion !!}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <button @click="showAll = !showAll"
                                                class="text-sm font-medium text-purple-600 hover:text-purple-700 mt-2 flex items-center">
                                                <span x-text="showAll ? 'Show less' : 'Show more'"></span>
                                                <svg class="w-4 h-4 ml-1 transition-transform duration-200"
                                                    :class="{ 'rotate-180': showAll }" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    @endif
                                </div>

                                <div class="flex space-x-3">
                                    <a href="{{ route('package-detail', ['id' => $package->id]) }}"
                                        class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 px-4 rounded-xl font-semibold text-center hover:shadow-lg transition-all duration-300">
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
                                    <div class="absolute top-4 left-4">
                                        <livewire:public.components.wishlist-button :packageId="$package->id" />
                                    </div>
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
                                        {{ $package->description }}
                                    </p>
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
    
    <script>
        const features = [
            "3 Pixel Lights warm White",
            "Oh baby Cutout",
            "Arch of 180 balloons of color 70 Pastel Pink, 70 Latex White, 30 Chrome light Pink and 10 Rose Gold Confetti balloons decorated with 7 Rose gold butterflies",
            "2 Pastel pink (18 inch) balloons",
            "10 Free floating balloons",
            // Add more items as needed
        ];

        function renderfeatures() {
            const container = document.querySelector('.package-features');

            let html = `
                <h3 class="features-title">features</h3>
                <ul class="features-list">
                `;

            features.forEach(item => {
                html += `
                        <li class="inclusion-item">
                        <span class="checkmark">✔</span>
                        <span class="feature-text">${item}</span>
                        </li>
                        `;
            });

            html += `</ul>`;

            if (features.length > 3) {
                html += `<button class="show-more-btn">+ Show More features</button>`;
            }

            container.innerHTML = html;

            // Initialize show more functionality
            if (features.length > 3) {
                const showMoreBtn = container.querySelector('.show-more-btn');
                const featuresList = container.querySelector('.features-list');

                showMoreBtn.addEventListener('click', function () {
                    featuresList.classList.toggle('show-all');

                    if (featuresList.classList.contains('show-all')) {
                        showMoreBtn.textContent = 'Show Less features';
                        showMoreBtn.innerHTML = '− ' + showMoreBtn.textContent;
                    } else {
                        showMoreBtn.textContent = 'Show More features';
                        showMoreBtn.innerHTML = '+ ' + showMoreBtn.textContent;
                    }
                });
            }
        }

        document.addEventListener('DOMContentLoaded', renderfeatures);
    </script>
</div>