<div>
    <livewire:public.section.hero-section />
    <section id="categories" class="sm:py-20 sm:px-10">
        <div class="p-5 lg:px-10">
            <div class="text-center mb-12">
                <h2 class="text-3xl py-2 sm:text-4xl md:text-5xl font-semibold font-display text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600 mb-6"
                    data-aos="fade-up">
                    Event Planning Services in Purnia, Bihar
                </h2>
                <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    Discover our magical collection of <strong>birthday celebrations</strong>, <strong>anniversary
                        decorations</strong>,
                    and <strong>premium event management</strong> services designed to create unforgettable moments
                    across Bihar
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 sm:gap-8">
                @foreach ($categories as $index => $category)
                    <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:scale-105 cursor-pointer"
                        data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}" @if ($category->children->count())
                        wire:click="$dispatch('openCategoryModal', { categorySlug: '{{ $category->slug }}' })" @else
                            onclick="window.location.href='{{ route('event-package.filter', ['category' => $category->slug]) }}'"
                        @endif>
                        <div class="relative h-64 sm:h-80">
                            <!-- Category Image with fallback -->
                            @if ($category->image)
                                <x-imagekit-image 
                                    :src="$category->image" 
                                    :alt="$category->name"
                                    class="absolute inset-0 w-full h-full object-cover"
                                    width="400"
                                    height="320"
                                    :lazy="true"
                                />
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent">
                                </div>
                            @else
                                <!-- Dynamic Gradient Background -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-br {{ $gradientColors[$index % count($gradientColors)] }}">
                                </div>
                            @endif

                            <!-- Single Reusable SVG Pattern Overlay -->
                            <div class="absolute inset-0 opacity-10">
                                <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <pattern id="eventPattern" x="0" y="0" width="20" height="20"
                                            patternUnits="userSpaceOnUse">
                                            <!-- Event celebration elements -->
                                            <circle cx="5" cy="5" r="1.5" fill="white" opacity="0.4" />
                                            <circle cx="15" cy="15" r="1" fill="white" opacity="0.3" />
                                            <path d="M8,8 Q10,6 12,8 Q10,10 8,8" fill="white" opacity="0.3" />
                                            <path d="M3,15 L5,13 L7,15 L5,17 Z" fill="white" opacity="0.2" />
                                            <circle cx="18" cy="3" r="0.8" fill="white" opacity="0.4" />
                                        </pattern>
                                    </defs>
                                    <rect width="100%" height="100%" fill="url(#eventPattern)" />
                                </svg>
                            </div>
                            <div
                                class="absolute inset-0 p-6 sm:p-8 text-white flex flex-col justify-center items-center text-center">
                                <div
                                    class="w-16 h-16 sm:w-20 sm:h-20 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-white/30 transition-all duration-300 shadow-lg">
                                    <i
                                        class="{{ $categoryIcons[$index % count($categoryIcons)] }} text-2xl sm:text-3xl drop-shadow-md"></i>
                                </div>
                                <h3
                                    class="text-xl sm:text-2xl font-2xl mb-2 group-hover:scale-105 transition-transform duration-300 drop-shadow-md">
                                    {{ $category->name }}
                                </h3>
                                <p
                                    class="text-sm opacity-90 group-hover:opacity-100 transition-opacity duration-300 drop-shadow-sm">
                                    Click to explore subcategories</p>
                                <div
                                    class="absolute inset-0 bg-white/0 group-hover:bg-white/10 transition-all duration-300 rounded-2xl">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Enhanced Packages Section - Horizontal Scroll -->
    <livewire:public.section.other-section />

    <!-- Enhanced Birthday Special Section -->
    <section class="relative overflow-hidden lg:px-20 p-6 bg-white ">

        <div class="relative">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <!-- Image Section -->
                <div data-aos="fade-right" class="relative">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl group">
                                            <div class="relative">
                        <x-local-image 
                            src="images/our-team.png" 
                            alt="Our Team" 
                            class="w-full h-auto object-cover rounded-lg"
                            :lazy="false"
                            :critical="true" />
                    </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-purple-900/30 to-transparent"></div>

                        <!-- Floating Elements -->
                        <div
                            class="absolute top-6 right-6 w-12 h-12 bg-accent-400 rounded-full flex items-center justify-center animate-bounce shadow-lg">
                            <span class="text-2xl">🎂</span>
                        </div>
                        <div
                            class="absolute bottom-6 left-6 w-10 h-10 bg-pink-400 rounded-full flex items-center justify-center animate-pulse shadow-lg">
                            <span class="text-xl">🎈</span>
                        </div>
                    </div>

                    <!-- Decorative Elements -->
                    <div class="absolute -top-4 -left-4 w-8 h-8 bg-purple-400 rounded-full animate-float opacity-80">
                    </div>
                    <div
                        class="absolute -bottom-4 -right-4 w-6 h-6 bg-pink-400 rounded-full animate-float-slow opacity-80">
                    </div>
                </div>

                <!-- Content Section -->
                <div data-aos="fade-left" class="space-y-6">
                    <h2
                        class="text-3xl sm:text-4xl lg:text-5xl font-semibold font-display bg-gradient-to-r from-purple-600 via-pink-600 to-purple-700 bg-clip-text text-transparent leading-tight">
                        Make Birthdays Unforgettable
                    </h2>

                    <p class="text-lg sm:text-xl text-gray-600 leading-relaxed">
                        Transform ordinary birthdays into extraordinary celebrations with our specially curated birthday
                        packages.
                        From enchanting decorations to delightful activities, we ensure every moment sparkles with joy
                        and creates
                        memories that last a lifetime.
                    </p>

                    <!-- Features -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4 group">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                <i class="fas fa-magic text-white text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-2xl text-gray-800 text-lg">Magical Decorations</h4>
                                <p class="text-gray-600">Themed decorations that bring dreams to life</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4 group">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-info-500 to-info-600 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                <i class="fas fa-gamepad text-white text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-2xl text-gray-800 text-lg">Fun Activities</h4>
                                <p class="text-gray-600">Engaging games and entertainment for all ages</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4 group">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-success-500 to-success-600 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                <i class="fas fa-birthday-cake text-white text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-2xl text-gray-800 text-lg">Custom Cakes</h4>
                                <p class="text-gray-600">Delicious cakes designed to match your theme</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="{{ route('event-packages') }}"
                            class="inline-flex items-center justify-center bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-8 py-4 rounded-full font-2xl text-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <i class="fas fa-gift mr-3"></i>
                            View Birthday Packages
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Collage Section -->
    <section id="gallery" class="lg:px-20 p-6 bg-white">
        <div class="">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl py-2 font-semibold font-display gradient-text mb-6" data-aos="fade-up">
                    Our Magic Gallery
                </h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="col-span-1 row-span-2" data-aos="fade-up" data-aos-delay="100">
                    <div
                        class="relative overflow-hidden rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover-scale h-[500px]">
                        <x-local-image 
                            src="images/birthday-party-decoration.avif" 
                            alt="Birthday Party"
                            class="w-full h-full object-cover" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                            <span class="text-white font-2xl">Birthday Celebration</span>
                        </div>
                    </div>
                </div>

                <!-- Wedding -->
                <div class="col-span-1" data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="relative overflow-hidden rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover-scale h-[240px]">
                        <x-local-image 
                            src="images/wedding-setup-1.jpg" 
                            alt="Wedding Setup"
                            class="w-full h-full object-cover" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                            <span class="text-white font-2xl">Wedding Magic</span>
                        </div>
                    </div>
                </div>

                <!-- Corporate Event -->
                <div class="col-span-1" data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="relative overflow-hidden rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover-scale h-[240px]">
                        <x-local-image 
                            src="images/corporate-event-decoration.jpg" 
                            alt="Corporate Event"
                            class="w-full h-full object-cover" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                            <span class="text-white font-2xl">Corporate Event</span>
                        </div>
                    </div>
                </div>

                <!-- Anniversary -->
                <div class="col-span-1" data-aos="fade-up" data-aos-delay="400">
                    <div
                        class="relative overflow-hidden rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover-scale h-[240px]">
                        <x-local-image 
                            src="images/anniversary-decoration.jpg" 
                            alt="Anniversary"
                            class="w-full h-full object-cover" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                            <span class="text-white font-2xl">Anniversary</span>
                        </div>
                    </div>
                </div>

                <!-- Baby Shower -->
                <div class="col-span-1" data-aos="fade-up" data-aos-delay="500">
                    <div
                        class="relative overflow-hidden rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover-scale h-[240px]">
                        <x-local-image 
                            src="images/baby-shower-decoration.avif" 
                            alt="Baby Shower"
                            class="w-full h-full object-cover" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                            <span class="text-white font-2xl">Baby Shower</span>
                        </div>
                    </div>
                </div>

                <!-- Event Planning -->
                <div class="col-span-2 row-span-1" data-aos="fade-up" data-aos-delay="600">
                    <div
                    <div\n                        class=\"relative overflow-hidden rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover-scale h-[240px] md:h-[240px]\">\n                        <x-local-image \n                            src=\"images/elegant-event-setup.jpg\" \n                            alt=\"Event Setup\"\n                            class=\"w-full h-full object-cover\" />\n                        <div\n                            class=\"absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-end p-4\">\n                            <span class=\"text-white font-2xl\">Event Planning</span>\n                        </div>\n                    </div>
                </div>
            </div>


            <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="700">
                <button
                    class="gradient-bg text-white px-8 py-4 rounded-full font-2xl text-lg hover:shadow-lg hover:scale-105 transition-all duration-300">
                    View Full Gallery
                </button>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section id="about" class=" p-6 lg:px-10 py-20 bg-gradient-to-br from-purple-50 to-pink-50">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl py-2 font-semibold font-display gradient-text mb-6" data-aos="fade-up">
                    Why Choose Zuppie for Event Planning in Bihar?
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    We are the leading <strong>event management company in Purnia</strong> offering <strong>affordable
                        party packages</strong>
                    with exceptional service quality and creative decoration ideas for all your celebrations
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="text-center group" data-aos="fade-up" data-aos-delay="100">
                    <div
                        class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-magic text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-2xl text-gray-800 mb-4">Magical Touch</h3>
                    <p class="text-gray-600">We add that special something that transforms ordinary events into
                        extraordinary experiences.</p>
                </div>

                <div class="text-center group" data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-users text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-2xl text-gray-800 mb-4">Expert Team</h3>
                    <p class="text-gray-600">Our passionate team of event specialists brings years of experience and
                        creativity to every project.</p>
                </div>

                <div class="text-center group" data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-heart text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-2xl text-gray-800 mb-4">Personal Touch</h3>
                    <p class="text-gray-600">Every event is tailored to your unique vision, preferences, and budget.
                    </p>
                </div>

                <div class="text-center group" data-aos="fade-up" data-aos-delay="400">
                    <div
                        class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-clock text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-2xl text-gray-800 mb-4">On-Time Delivery</h3>
                    <p class="text-gray-600">We ensure everything is perfectly executed on schedule, so you can relax
                        and enjoy.</p>
                </div>

                <div class="text-center group" data-aos="fade-up" data-aos-delay="500">
                    <div
                        class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-dollar-sign text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-2xl text-gray-800 mb-4">Transparent Pricing</h3>
                    <p class="text-gray-600">No hidden costs or surprises. We provide clear, upfront pricing for all
                        our
                        services.</p>
                </div>

                <div class="text-center group" data-aos="fade-up" data-aos-delay="600">
                    <div
                        class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-medal text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-2xl text-gray-800 mb-4">Award Winning</h3>
                    <p class="text-gray-600">Recognized as the best event management company with numerous industry
                        awards.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section -->
    {{-- <section class="py-20 bg-gradient-to-br from-pink-50 to-purple-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl py-2 font-2xl font-display gradient-text mb-6" data-aos="fade-up">
                    Event Planning Tips & Decoration Ideas
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    Expert advice on <strong>birthday party planning</strong>, <strong>anniversary decorations</strong>,
                    and the latest trends for creating magical celebrations in Bihar
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                @foreach ($blogs as $blog)
                <article
                    class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group"
                    data-aos="fade-up" data-aos-delay="100">
                    <div class="relative overflow-hidden">
                        <img src="{{ $blog->image }}" alt="Blog Post"
                            class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
                        <div
                            class="absolute top-4 left-4 bg-purple-600 text-white px-3 py-1 rounded-full text-sm font-2xl">
                            {{ $blog->category->name }}
                        </div>
                    </div>
                    <div class="p-6">
                        <h3
                            class="text-xl font-2xl text-gray-800 mb-3 group-hover:text-purple-600 transition-colors duration-300">
                            {{ str($blog->title)->words(7) }}
                        </h3>
                        <p class="text-gray-600 mb-4">{{ str($blog->content)->words(25) }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">{{ $blog->created_at->format('M D, Y') }}</span>
                            <a href="{{ route('blog.detail', $blog->slug) }}" class="text-purple-600 font-2xl hover:underline">Read More →</a>
                            <a href="{{ route('blog.detail', $blog->slug) }}"
                                class="text-purple-600 font-semibold hover:underline">Read More →</a>
                        </div>
                    </div>
                </article>
                @endforeach

            </div>

            <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="400">
                <button
                    class="gradient-bg text-white px-8 py-4 rounded-full font-2xl text-lg hover:shadow-lg hover:scale-105 transition-all duration-300">
                    Visit Our Blog
                </button>
            </div>
        </div>
    </section> --}}

    <!-- Contact Form Section -->

    <livewire:public.section.enquiry-form />
    <livewire:public.components.bottom-navigation />
    <livewire:public.components.category-popup />
    <!-- Include Category Popup Component -->

    <!-- Custom Styles for Animations -->
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes float-slow {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        @keyframes float-slower {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
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

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {

            .animate-float,
            .animate-float-slow,
            .animate-float-slower {
                animation-duration: 4s;
            }
        }
    </style>
</div>
