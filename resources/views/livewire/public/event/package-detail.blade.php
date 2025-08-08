<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-purple-50">
    @if (!$package)
        <div class="text-center py-20">
            <h2 class="text-2xl font-bold text-gray-800">Package not found</h2>
            <a href="{{ route('event-packages') }}"
                class="mt-4 inline-block bg-purple-600 text-white px-6 py-3 rounded-lg">
                Back to Packages
            </a>
        </div>
    @else
        <!-- Main Content -->
        <section class="py-8 md:py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-8 md:gap-12">

                    <!-- Image Gallery -->
                    <div class="space-y-4 md:space-y-6 animate-fade-in-right">
                        <!-- Main Image with Auto-Change -->
                        <div class="relative group">
                            <div class="aspect-w-16 aspect-h-12 rounded-2xl md:rounded-3xl overflow-hidden bg-gray-200">
                                <img src="{{ $this->packageImages[$currentImageIndex] ?? 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop' }}"
                                    alt="{{ $package->name }}"
                                    class="w-full h-full object-cover transition-all duration-500 transform group-hover:scale-105"
                                    id="main-package-image">
                            </div>

                            <!-- Image Navigation Arrows -->
                            <button wire:click="previousImage"
                                class="previous-button absolute left-2 md:left-4 top-1/2 transform -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-2 md:p-3 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <i class="fas fa-chevron-left text-sm md:text-base"></i>
                            </button>
                            <button wire:click="nextImage"
                                class="next-button absolute right-2 md:right-4 top-1/2 transform -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-2 md:p-3 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <i class="fas fa-chevron-right text-sm md:text-base"></i>
                            </button>

                            <!-- Image Counter -->
                            <div
                                class="image-counter absolute bottom-2 md:bottom-4 left-2 md:left-4 bg-black/50 text-white px-2 md:px-3 py-1 rounded-full text-xs md:text-sm">
                                {{ $currentImageIndex + 1 }} / {{ count($this->packageImages) }}
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-2 md:gap-3">
                            @foreach ($this->packageImages as $index => $image)
                                <div
                                    class="aspect-w-4 aspect-h-3 rounded-lg md:rounded-xl overflow-hidden {{ $index === $currentImageIndex ? 'ring-2 md:ring-4 ring-purple-500' : 'hover:ring-2 hover:ring-purple-300' }} transition-all duration-300">
                                    <img src="{{ $image }}" alt="Gallery image {{ $index + 1 }}"
                                        wire:click="selectImage({{ $index }})"
                                        class="thumbnail-image w-full h-full object-cover cursor-pointer hover:scale-110 transition-transform duration-300">
                                </div>
                            @endforeach
                        </div>

                        <!-- Review Section -->
                        <div class="max-w-3xl mx-auto p-8 bg-white rounded-xl shadow-lg border border-purple-50">
                            <!-- Section Header -->
                            <div class="flex justify-between items-center mb-8">
                                <h2
                                    class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-500 bg-clip-text text-transparent">
                                    Customer Reviews</h2>
                            </div>

                            <!-- Rating Summary -->
                            <div
                                class="flex items-center mb-10 p-6 bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg">
                                <div
                                    class="text-5xl font-bold mr-6 bg-gradient-to-r from-purple-600 to-pink-500 bg-clip-text text-transparent">
                                    {{ number_format($average_review, 1) }}
                                </div>
                                <div>
                                    <div class="flex items-center mb-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $average_review)
                                                <i class="fa-solid fa-star text-xl mr-1" style="color: #9333ea;"></i>
                                            @elseif($i - 0.5 <= $average_review)
                                                <i class="fa-solid fa-star-half-stroke text-xl mr-1"
                                                    style="color: #9333ea;"></i>
                                            @else
                                                <i class="fa-regular fa-star text-xl mr-1" style="color: #d8b4fe;"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <div class="text-sm text-purple-700">Based on {{ $totalReview }} verified reviews
                                    </div>
                                </div>
                            </div>


                            <!-- Reviews List -->
                            <div class="space-y-8">
                                @foreach ($reviews as $review)
                                    <div
                                        class="p-6 border border-purple-100 rounded-lg hover:shadow-md transition-shadow">
                                        <div class="flex justify-between items-start mb-3">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                                    <span
                                                        class="text-purple-600 font-medium">{{ strtoupper(substr($review->user->name, 0, 1)) }}</span>
                                                </div>
                                                <h3 class="font-semibold text-purple-900">{{ $review->user->name }}
                                                </h3>
                                            </div>
                                            <span
                                                class="text-sm text-pink-600">{{ $review->created_at->format('M d, Y') }}</span>
                                        </div>

                                        <div class="flex items-center mb-3">
                                            <div class="flex mr-3">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $review->rating)
                                                        <i class="fa-solid fa-star text-sm mr-0.5"
                                                            style="color: #9333ea;"></i>
                                                    @else
                                                        <i class="fa-regular fa-star text-sm mr-0.5"
                                                            style="color: #d8b4fe;"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span
                                                class="text-xs bg-pink-100 text-pink-800 px-2 py-1 rounded-full">Verified
                                                Purchase</span>
                                        </div>

                                        <p class="text-gray-700 mb-4">
                                            {{ $review->comment ?? 'This user did not leave a comment' }}</p>

                                    </div>
                                @endforeach
                            </div>

                            <!-- View More Button -->
                            @if ($reviews->count() > 3)
                                <div class="mt-8 text-center">
                                    <button
                                        class="px-6 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-full hover:shadow-lg transition-all">
                                        View All Reviews
                                    </button>
                                </div>
                            @endif
                        </div>

                    </div>

                    <!-- Package Details -->
                    <div class="space-y-8 animate-fade-in-left">
                        <!-- Package Header -->
                        <div class="bg-white rounded-3xl p-8 shadow-xl">
                            <div class="mb-6">
                                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $package->name }}</h1>
                                <p class="text-gray-600">{{ $package->category->name ?? 'Event Package' }}</p>
                                @if ($package->duration)
                                    <p class="text-sm text-purple-600 font-medium mt-1">
                                        <i class="fas fa-clock mr-1"></i>{{ $package->formatted_duration }}
                                    </p>
                                @endif
                            </div>
                            <livewire:public.components.wishlist-button :packageId="$package->id" />

                            <!-- Price and Offers -->
                            <div
                                class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 space-y-4 sm:space-y-0">
                                <div>
                                    <span
                                        class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
                                        ₹{{ number_format($package->discounted_price) }}
                                    </span>
                                    @if ($package->discount_type && $package->price != $package->discounted_price)
                                        <span
                                            class="ml-2 text-lg text-gray-500 line-through">₹{{ number_format($package->price) }}</span>
                                    @endif
                                    <p class="text-gray-600 mt-1">Starting price</p>
                                </div>
                            </div>

                            <!-- Pincode Check -->
                            <div class="mb-6 p-4 bg-info-50 rounded-2xl">
                                <h4 class="font-bold text-gray-800 mb-3 flex items-center">
                                    <i class="fas fa-map-marker-alt text-info-600 mr-2"></i>
                                    Check Service Availability
                                </h4>
                                <div class="flex space-x-3">
                                    <input type="text" wire:model.live="pinCode" placeholder="Enter your pincode"
                                        class="flex-1 border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-info-500 focus:border-transparent transition-all duration-300"
                                        maxlength="6">
                                    <button wire:click="checkPinCodeAvailability" wire:loading.attr="disabled"
                                        class="bg-blue-600 text-white px-6 py-2 rounded-xl font-semibold hover:bg-info-700 transition-all duration-300 disabled:opacity-50">
                                        <span wire:loading.remove>Check</span>
                                        <span wire:loading>
                                            <i class="fas fa-spinner fa-spin"></i>
                                        </span>
                                    </button>
                                </div>

                                @if (session('pin_message'))
                                    <div
                                        class="mt-3 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                                        <i class="fas fa-check-circle mr-2"></i>{{ session('pin_message') }}
                                    </div>
                                @endif
                                @error('pinCode')
                                    <div class="mt-3 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                    </div>
                                @enderror

                                @if (session('pin_error'))
                                    <div class="mt-3 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                                        <i class="fas fa-exclamation-circle mr-2"></i>{{ session('pin_error') }}
                                    </div>
                                @endif

                                <p class="text-sm text-gray-600 mt-2">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    We'll check if our services are available in your area
                                </p>
                            </div>

                            <!-- Book Now Button -->
                            @if ($isPinCodeAvailable === true)
                                <button wire:click="bookNow" wire:loading.attr="disabled"
                                    class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:from-purple-700 hover:to-pink-700 transform hover:scale-105 transition-all duration-300 shadow-lg">
                                    <i class="fas fa-calendar-check mr-2"></i>
                                    <span wire:loading.remove>Book Now</span>
                                    <span wire:loading>
                                        <i class="fas fa-spinner fa-spin mr-2"></i> Checking...
                                    </span>
                                </button>
                            @else
                                <button wire:click="checkPinCodeAvailability" wire:loading.attr="disabled"
                                    class="w-full bg-gradient-to-r from-gray-600 to-gray-700 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:from-gray-700 hover:to-gray-800 transform hover:scale-105 transition-all duration-300 shadow-lg">
                                    <i class="fas fa-lock mr-2"></i>
                                    <span wire:loading.remove>Check Availability</span>
                                    <span wire:loading>
                                        <i class="fas fa-spinner fa-spin mr-2"></i> Checking...
                                    </span>
                                </button>
                            @endif
                        </div>

                        <!-- Description -->
                        <div class="bg-white rounded-3xl p-8 shadow-xl">
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">About This Package</h3>
                            <p class="text-gray-600 leading-relaxed mb-6">{{ $package->description }}</p>

                            <!-- Package Details -->
                            <div class="grid md:grid-cols-2 gap-4 text-sm">
                                @if ($package->duration)
                                    <div class="flex items-center space-x-2">
                                        <i class="fas fa-clock text-purple-600"></i>
                                        <span class="font-medium">Duration:</span>
                                        <span class="text-gray-600">{{ $package->formatted_duration }}</span>
                                    </div>
                                @endif
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-users text-purple-600"></i>
                                    <span class="font-medium">Team Size:</span>
                                    <span class="text-gray-600">5-8 professionals</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-calendar text-purple-600"></i>
                                    <span class="font-medium">Advance Booking:</span>
                                    <span class="text-gray-600">15 days minimum</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-star text-purple-600"></i>
                                    <span class="font-medium">Category:</span>
                                    <span class="text-gray-600">{{ $package->category->name ?? 'General' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- What's Included -->
                        <div class="bg-white rounded-3xl p-8 shadow-xl">
                            <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                What's Included

                            </h3>
                            <div class="">
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
                                                    return !empty($item);
                                                },
                                            );
                                        }
                                    }
                                    $features = is_array($features) ? $features : [];
                                @endphp

                                <ul class="features-list space-y-2 pr-2">
                                    @foreach ($features as $inclusion)
                                        <li class="flex gap-3 items-start">
                                            <div
                                                class="w-3 h-3 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full mt-2 flex-shrink-0">
                                            </div>
                                            <span class="text-gray-700">{!! $inclusion !!}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Similar Packages Section -->
        @if ($this->similarPackages->count() > 0)
            <section class="py-20 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">
                            Similar Packages You Might Like
                        </h2>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                            Explore more packages from the same category -
                            {{ $package->category->name ?? 'Event Packages' }}
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($this->similarPackages as $similarPackage)
                            <div
                                class="bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500 group">
                                <!-- Image -->
                                <div class="relative h-56 overflow-hidden">
                                    <img src="{{ $similarPackage['image'] }}" alt="{{ $similarPackage['name'] }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                                    @if ($similarPackage['popular'])
                                        <div class="absolute top-4 right-4">
                                            <span
                                                class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-2 rounded-full text-sm font-bold shadow-lg">
                                                <i class="fas fa-star mr-1"></i>Popular
                                            </span>
                                        </div>
                                    @endif

                                    <div class="absolute bottom-4 left-4">
                                        <div
                                            class="bg-white/90 backdrop-blur-sm text-gray-800 px-3 py-2 rounded-full font-bold text-lg">
                                            ₹{{ number_format($similarPackage['price']) }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="p-6">
                                    <h3
                                        class="text-xl font-bold text-gray-800 group-hover:text-purple-600 transition-colors duration-300 mb-3">
                                        {{ $similarPackage['name'] }}
                                    </h3>

                                    <p class="text-gray-600 mb-4 leading-relaxed">{{ $similarPackage['description'] }}
                                    </p>

                                    <!-- Package Info -->
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center space-x-1">
                                            <i class="fas fa-star text-yellow-400"></i>
                                            <span class="text-sm font-medium">{{ $similarPackage['rating'] }}</span>
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            {{ $similarPackage['category'] }}
                                        </div>
                                    </div>

                                    <!-- CTA Button -->
                                    <a href="{{ route('package-detail', $similarPackage['slug']) }}"
                                        class="block w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 px-6 rounded-2xl font-bold text-center hover:from-purple-700 hover:to-pink-700 transform hover:scale-105 transition-all duration-300 shadow-lg">
                                        <i class="fas fa-eye mr-2"></i>
                                        View Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center mt-12">
                        <a href="{{ route('event-packages') }}"
                            class="inline-flex items-center space-x-2 bg-white border-2 border-purple-600 text-purple-600 px-8 py-3 rounded-2xl font-bold hover:bg-purple-600 hover:text-white transition-all duration-300">
                            <i class="fas fa-th-large"></i>
                            <span>View All Packages</span>
                        </a>
                    </div>
                </div>
            </section>
        @endif
    @endif

    <livewire:public.section.enquiry-form />
    <livewire:public.components.bottom-navigation />
    <!-- Custom Styles -->
    <style>
        /* Custom Animations */
        .animate-fade-in-right {
            animation: fadeInRight 1s ease-in-out;
        }

        .animate-fade-in-left {
            animation: fadeInLeft 1s ease-in-out;
        }

        @keyframes fadeInRight {
            0% {
                opacity: 0;
                transform: translateX(30px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInLeft {
            0% {
                opacity: 0;
                transform: translateX(-30px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Aspect Ratio */
        .aspect-w-16 {
            position: relative;
            padding-bottom: 75%;
        }

        .aspect-w-4 {
            position: relative;
            padding-bottom: 75%;
        }

        .aspect-w-16>*,
        .aspect-w-4>* {
            position: absolute;
            height: 100%;
            width: 100%;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mainImage = document.getElementById('main-package-image');
            const imageCounter = document.querySelector('.image-counter'); // Add a class to the counter div
            const thumbnails = document.querySelectorAll('.thumbnail-image'); // Add a class to thumbnail images
            let currentIndex = {{ $currentImageIndex }};
            const images = @json($this->packageImages);
            const totalImages = images.length;

            // Function to update the main image and counter
            function updateImage(index) {
                currentIndex = (index + totalImages) % totalImages; // Ensure index stays in bounds
                mainImage.src = images[currentIndex];
                mainImage.style.opacity = '0';
                setTimeout(() => {
                    mainImage.style.opacity = '1';
                }, 150);
                imageCounter.textContent = `${currentIndex + 1} / ${totalImages}`;

                // Update thumbnail selection
                thumbnails.forEach((thumb, i) => {
                    thumb.parentElement.classList.toggle('ring-2', i === currentIndex);
                    thumb.parentElement.classList.toggle('ring-4', i === currentIndex);
                    thumb.parentElement.classList.toggle('ring-purple-500', i === currentIndex);
                    thumb.parentElement.classList.toggle('hover:ring-2', i !== currentIndex);
                    thumb.parentElement.classList.toggle('hover:ring-purple-300', i !== currentIndex);
                });
            }

            // Auto-change image every 5 seconds
            let autoChangeInterval = setInterval(() => {
                updateImage(currentIndex + 1);
            }, 3000);

            // Pause auto-change on hover
            const imageGallery = document.querySelector('.animate-fade-in-right');
            if (imageGallery) {
                imageGallery.addEventListener('mouseenter', () => {
                    clearInterval(autoChangeInterval);
                });
                imageGallery.addEventListener('mouseleave', () => {
                    autoChangeInterval = setInterval(() => {
                        updateImage(currentIndex + 1);
                    }, 5000);
                });
            }

            // Sync with Livewire when the user manually changes the image
            thumbnails.forEach((thumb, index) => {
                thumb.addEventListener('click', () => {
                    updateImage(index);
                    @this.set('currentImageIndex', currentIndex); // Sync with Livewire
                });
            });

            // Handle navigation arrows
            document.querySelector('.previous-button').addEventListener('click', () => {
                updateImage(currentIndex - 1);
                @this.call('previousImage'); // Sync with Livewire
            });
            document.querySelector('.next-button').addEventListener('click', () => {
                updateImage(currentIndex + 1);
                @this.call('nextImage'); // Sync with Livewire
            });
        });
    </script>
</div>
