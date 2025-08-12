<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-purple-50">
    @if (!$package)
        <div class="text-center py-20">
            <h2 class="text-2xl font-bold text-gray-800">Package not found</h2>
            <a href="{{ route('event-packages') }}" class="mt-4 inline-block bg-purple-600 text-white px-6 py-3 rounded-lg">
                Back to Packages
            </a>
        </div>
    @else
        <!-- Main Content -->
        <section class="py-8 md:py-20">
            <div class="max-w-[95%] lg:max-w-[80%] mx-auto px-1 sm:px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row gap-5">
                    <!-- Image Gallery -->
                    <div
                        class="w-full mt-10 lg:w-5/12 lg:sticky xl:sticky md:sticky top-4 lg:top-20 h-auto lg:h-[calc(100vh-5rem)] overflow-y-auto space-y-3 md:space-y-4 lg:space-y-6">
                        <!-- Main Image with Auto-Change -->
                        <div class="relative group">
                            <div class="aspect-w-16 aspect-h-12 rounded-2xl md:rounded-3xl overflow-hidden bg-black">
                                <img src="{{ $this->packageImages[$currentImageIndex] ?? 'https://cherishx.com/images/metallic-elegance-ring.jpg' }}"
                                    alt="{{ $package->name }}"
                                    class="w-full h-full object-cover transition-opacity duration-500"
                                    id="main-package-image">
                            </div>

                            <!-- Image Navigation Arrows -->
                            <button wire:click="previousImage" wire:key="prev-btn"
                                class="previous-button absolute left-2 md:left-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white text-black p-2 md:p-3 rounded-full transition-all duration-300">
                                <i class="fas fa-chevron-left text-sm md:text-base"></i>
                            </button>
                            <button wire:click="nextImage" wire:key="next-btn"
                                class="next-button absolute right-2 md:right-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white text-black p-2 md:p-3 rounded-full transition-all duration-300">
                                <i class="fas fa-chevron-right text-sm md:text-base"></i>
                            </button>

                            <!-- Image Counter -->
                            <div
                                class="image-counter absolute bottom-2 md:bottom-4 left-2 md:left-4 bg-black/60 text-white px-2 md:px-3 py-1 rounded-full text-xs md:text-sm">
                                {{ $currentImageIndex + 1 }} / {{ count($this->packageImages) }}
                            </div>
                        </div>

                        <!-- Thumbnail Gallery -->
                        <div class="grid grid-cols-4 gap-2 md:gap-3">
                            @foreach ($this->packageImages as $index => $image)
                                <div wire:click="selectImage({{ $index }})" wire:key="thumb-{{ $index }}"
                                    class="aspect-w-4 aspect-h-3 rounded-lg md:rounded-xl overflow-hidden cursor-pointer transition-all duration-300 {{ $index === $currentImageIndex ? 'ring-2 ring-black' : 'hover:ring-2 hover:ring-purple-300' }}">
                                    <img src="{{ $image }}" alt="Gallery image {{ $index + 1 }}"
                                        class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <!-- Package Details -->
                    <div class="w-full lg:w-7/12 space-y-8 animate-fade-in-left">
                        <!-- Package Header -->
                        <div class="bg-white rounded-3xl p-3 md:p-8 shadow-xl">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-1">{{ $package->name }}</h1>
                                    <p class="text-gray-600 text-sm md:text-base">
                                        {{ $package->category->name ?? 'Event Package' }}
                                    </p>
                                    @if ($package->duration)
                                        <p class="text-xs md:text-sm text-purple-600 font-medium mt-2">
                                            <i class="fas fa-clock mr-1"></i>{{ $package->formatted_duration }}
                                        </p>
                                    @endif
                                </div>
                                <livewire:public.components.wishlist-button :packageId="$package->id" />
                            </div>

                            <!-- Price and Offers -->
                            <div class="mb-6">
                                <div class="flex items-baseline">
                                    <span
                                        class="text-3xl md:text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
                                        ₹{{ number_format($package->discounted_price) }}
                                    </span>
                                    @if ($package->discount_type && $package->price != $package->discounted_price)
                                        <span
                                            class="ml-2 text-lg text-gray-500 line-through">₹{{ number_format($package->price) }}</span>
                                    @endif
                                </div>
                                <p class="text-gray-500 text-sm mt-1">Starting price</p>
                            </div>

                            <!-- Pincode Check (Auto-check on 6 digits) -->
                            <div class="mb-6 p-4 bg-purple-50 rounded-2xl">
                                <h4 class="font-bold text-gray-800 mb-3 flex items-center">
                                    <i class="fas fa-map-marker-alt text-purple-600 mr-2"></i>
                                    Check Service Availability
                                </h4>
                                <div class="relative">
                                    <input type="text" wire:model.live.debounce.500ms="pinCode"
                                        placeholder="Enter 6-digit pincode"
                                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300"
                                        maxlength="6" inputmode="numeric" pattern="\d*">

                                    <!-- Loading indicator inside input -->
                                    <div wire:loading wire:target="pinCode" class="absolute right-3 top-3">
                                        <i class="fas fa-spinner fa-spin text-purple-600"></i>
                                    </div>
                                </div>

                                <!-- Messages -->
                                @if (session('pin_message'))
                                    <div
                                        class="mt-3 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg text-sm">
                                        <i class="fas fa-check-circle mr-2"></i>{{ session('pin_message') }}
                                    </div>
                                @endif

                                @error('pinCode')
                                    <div class="mt-3 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">
                                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                    </div>
                                @enderror

                                @if (session('pin_error'))
                                    <div class="mt-3 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">
                                        <i class="fas fa-exclamation-circle mr-2"></i>{{ session('pin_error') }}
                                    </div>
                                @endif

                                <p class="text-xs text-gray-500 mt-2">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    We'll automatically check availability when you enter a 6-digit pincode
                                </p>
                            </div>

                            <!-- Book Now Button -->
                            <button wire:click="{{ $isPinCodeAvailable === true ? 'bookNow' : 'checkPinCodeAvailability' }}"
                                wire:loading.attr="disabled"
                                class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 md:px-8 md:py-4 rounded-2xl font-bold text-lg hover:shadow-lg transition-all duration-300 relative overflow-hidden">

                                <span wire:loading.remove>
                                    <i
                                        class="fas {{ $isPinCodeAvailable === true ? 'fa-calendar-check' : 'fa-lock' }} mr-2"></i>
                                    {{ $isPinCodeAvailable === true ? 'Book Now' : 'Check Availability' }}
                                </span>

                                <span wire:loading class="absolute inset-0 flex items-center justify-center">
                                    <i class="fas fa-spinner fa-spin mr-2"></i> Processing...
                                </span>
                            </button>
                        </div>
                        <!-- Features Section -->
                        <div class="bg-white rounded-3xl shadow-xl py-8 px-4">
                            <div class="max-w-full ">
                                <div class="flex overflow-x-auto md:gap-6 gap-5 text-center">
                                    <!-- Secured Transactions -->
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center mb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                            </svg>
                                        </div>
                                        <h3 class="font-medium text-gray-800 text-sm">Secured Transactions</h3>
                                    </div>

                                    

                                    <!-- Original Photos -->
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center mb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                                <polyline points="21 15 16 10 5 21"></polyline>
                                            </svg>
                                        </div>
                                        <h3 class="font-medium text-gray-800 text-sm">Original Photos</h3>
                                    </div>

                                    <!-- Original Reviews -->
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center mb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <polygon
                                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                </polygon>
                                            </svg>
                                        </div>
                                        <h3 class="font-medium text-gray-800 text-sm">Original Reviews</h3>
                                    </div>

                                    <!-- Expert Decorators -->
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center mb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path
                                                    d="M12 2v4M6 6l-3 3M3 11v2M21 11v2M18 6l3 3M12 18v4M18 18l3-3M6 18l-3-3">
                                                </path>
                                            </svg>
                                        </div>
                                        <h3 class="font-medium text-gray-800 text-sm">Expert Decorators</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- What's Included -->
                        <div class="bg-white rounded-3xl p-3 md:p-8 shadow-xl">
                            <h3 class="text-2xl md:text-2xl font-bold text-gray-800 mb-1 flex items-center">
                                <span
                                    class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600 mr-3">
                                    <i class="fas fa-check-circle text-2xl"></i>
                                </span>
                                What's Included
                            </h3>

                            <ul class="">
                                @php
                                    $features = [];
                                    if (is_array($package->features)) {
                                        $features = $package->features;
                                    } elseif (is_string($package->features)) {
                                        $decoded = json_decode($package->features, true);
                                        $features = json_last_error() === JSON_ERROR_NONE
                                            ? $decoded
                                            : array_filter(array_map('trim', explode(',', $package->features)));
                                    }
                                    $features = is_array($features) ? $features : [];
                                @endphp

                                @foreach ($features as $inclusion)
                                    <li class="flex gap-3 items-center p-2 hover:bg-purple-50 rounded-lg transition-colors">
                                        <i class="fa-solid fa-check text-xl" style="color: #00a303;"></i>
                                        <span class="text-gray-700">{!! $inclusion !!}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Description -->
                        <div class="bg-white rounded-3xl p-3 md:p-8 shadow-xl border border-gray-100">
                            <div class="mb-6">
                                <h3
                                    class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 relative pb-3 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-16 after:h-1 after:bg-gradient-to-r after:from-purple-500 after:to-pink-500">
                                    About This Package
                                </h3>

                                <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                                    {!! nl2br(e($package->description)) !!}
                                </div>
                            </div>

                            <!-- Package Details -->
                            <div class="grid md:grid-cols-2 gap-4">
                                @if ($package->duration)
                                    <div
                                        class="flex items-start space-x-4 p-4 bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl hover:shadow-md transition-all duration-300">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-white shadow-sm flex items-center justify-center text-purple-600 mt-0.5">
                                            <i class="fas fa-clock text-lg"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-800">Duration</h4>
                                            <p class="text-gray-600 mt-1">{{ $package->formatted_duration }}</p>
                                        </div>
                                    </div>
                                @endif

                                <div
                                    class="flex items-start space-x-4 p-4 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl hover:shadow-md transition-all duration-300">
                                    <div
                                        class="w-10 h-10 rounded-lg bg-white shadow-sm flex items-center justify-center text-blue-600 mt-0.5">
                                        <i class="fas fa-users text-lg"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">Team Size</h4>
                                        <p class="text-gray-600 mt-1">5-8 professionals</p>
                                    </div>
                                </div>

                                <div
                                    class="flex items-start space-x-4 p-4 bg-gradient-to-br from-green-50 to-teal-50 rounded-xl hover:shadow-md transition-all duration-300">
                                    <div
                                        class="w-10 h-10 rounded-lg bg-white shadow-sm flex items-center justify-center text-green-600 mt-0.5">
                                        <i class="fas fa-calendar text-lg"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">Advance Booking</h4>
                                        <p class="text-gray-600 mt-1">15 days minimum</p>
                                    </div>
                                </div>

                                <div
                                    class="flex items-start space-x-4 p-4 bg-gradient-to-br from-yellow-50 to-amber-50 rounded-xl hover:shadow-md transition-all duration-300">
                                    <div
                                        class="w-10 h-10 rounded-lg bg-white shadow-sm flex items-center justify-center text-yellow-600 mt-0.5">
                                        <i class="fas fa-star text-lg"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">Category</h4>
                                        <p class="text-gray-600 mt-1">{{ $package->category->name ?? 'General' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Review Section -->
                        <div class="max-w-3xl mx-auto p-3 bg-white rounded-xl shadow-lg border border-purple-50">
                            <!-- Section Header -->
                            <div class="flex justify-between items-center mb-8">
                                <h2
                                    class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-500 bg-clip-text text-transparent">
                                    Customer Reviews</h2>
                            </div>

                            <!-- Rating Summary -->
                            <div class="flex items-center mb-10 p-6 bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg">
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
                                                <i class="fa-solid fa-star-half-stroke text-xl mr-1" style="color: #9333ea;"></i>
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
                                    <div class="p-6 border border-purple-100 rounded-lg hover:shadow-md transition-shadow">
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
                                                        <i class="fa-solid fa-star text-sm mr-0.5" style="color: #9333ea;"></i>
                                                    @else
                                                        <i class="fa-regular fa-star text-sm mr-0.5" style="color: #d8b4fe;"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span class="text-xs bg-pink-100 text-pink-800 px-2 py-1 rounded-full">Verified
                                                Purchase</span>
                                        </div>

                                        <p class="text-gray-700 mb-4">
                                            {{ $review->comment ?? 'This user did not leave a comment' }}
                                        </p>

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
        document.addEventListener('DOMContentLoaded', function () {
            const mainImage = document.getElementById('main-package-image');
            const thumbnails = document.querySelectorAll('[wire\\:click^="selectImage"]');
            let autoChangeInterval;

            // Function to start auto-changing images
            function startAutoChange() {
                autoChangeInterval = setInterval(() => {
                    @this.nextImage();
                }, 5000); // Change every 5 seconds
            }

            // Initialize auto-change
            startAutoChange();

            // Pause auto-change on gallery hover
            const gallery = document.querySelector('.animate-fade-in-right');
            gallery.addEventListener('mouseenter', () => {
                clearInterval(autoChangeInterval);
            });
            gallery.addEventListener('mouseleave', startAutoChange);

            // Livewire event listener for image changes
            Livewire.on('imageChanged', () => {
                // Smooth transition effect
                mainImage.style.opacity = 0;
                setTimeout(() => {
                    mainImage.src = @json($this->packageImages)[@this.get('currentImageIndex')];
                    mainImage.style.opacity = 1;

                    // Update active thumbnail
                    thumbnails.forEach((thumb, index) => {
                        const isActive = index === @this.get('currentImageIndex');
                        thumb.classList.toggle('ring-purple-500', isActive);
                        thumb.classList.toggle('ring-2', isActive);
                        thumb.classList.toggle('hover:ring-purple-300', !isActive);
                    });
                }, 300);
            });

            // Handle thumbnail clicks
            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', function () {
                    clearInterval(autoChangeInterval);
                    setTimeout(startAutoChange, 10000); // Restart auto-change after 10 seconds of inactivity
                });
            });
        });
    </script>
</div>