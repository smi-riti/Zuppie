<!-- Hero Section with Floating Balloons and Changing Text -->
<div>
    <!-- Hero Section -->
    <livewire:public.section.hero-section />

    <!-- Categories Section with SEO Keywords -->
    <section id="categories" class="py-12 sm:py-20 bg-gradient-to-br from-purple-50 to-pink-50 relative z-10">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-3xl py-2 sm:text-4xl md:text-5xl font-bold font-display text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600 mb-6"
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

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 sm:gap-8 max-w-7xl mx-auto">
                @foreach ($categories as $index => $category)
                    <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:scale-105 cursor-pointer"
                        data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}"
                        wire:click="$dispatch('openSubCategoryPopup', {categorySlug: '{{ $category->slug }}'})">
                        <div class="relative h-64 sm:h-80">
                            <!-- Category Image with fallback -->
                            @if($category->image)
                                <img src="{{ $category->image }}" alt="{{ $category->name }}"
                                    class="absolute inset-0 w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
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

                            <!-- Content -->
                            <div
                                class="absolute inset-0 p-6 sm:p-8 text-white flex flex-col justify-center items-center text-center">
                                <div
                                    class="w-16 h-16 sm:w-20 sm:h-20 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-white/30 transition-all duration-300 shadow-lg">
                                    <i
                                        class="{{ $categoryIcons[$index % count($categoryIcons)] }} text-2xl sm:text-3xl drop-shadow-md"></i>
                                </div>
                                <h3
                                    class="text-xl sm:text-2xl font-bold mb-2 group-hover:scale-105 transition-transform duration-300 drop-shadow-md">
                                    {{$category->name}}
                                </h3>
                                <p
                                    class="text-sm opacity-90 group-hover:opacity-100 transition-opacity duration-300 drop-shadow-sm">
                                    Click to explore subcategories</p>

                                <!-- Hover Effect -->
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
    <section class="py-12 sm:py-20 bg-gradient-to-br from-pink-50 via-purple-50 to-indigo-50 relative overflow-hidden">
        <!-- Background Decorations -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-10 w-32 h-32 bg-pink-300 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-40 h-40 bg-purple-300 rounded-full blur-3xl"></div>
            <div
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-yellow-300 rounded-full blur-3xl">
            </div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center max-w-7xl mx-auto">
                <!-- Image Section -->
                <div data-aos="fade-right" class="relative">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl group">
                        <img src="https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=600&h=400&fit=crop"
                            alt="Birthday Celebration"
                            class="w-full h-64 sm:h-80 lg:h-96 object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-purple-900/30 to-transparent"></div>

                        <!-- Floating Elements -->
                        <div
                            class="absolute top-6 right-6 w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center animate-bounce shadow-lg">
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
                    <div
                        class="inline-flex items-center bg-gradient-to-r from-purple-100 to-pink-100 text-purple-700 px-4 py-2 rounded-full font-medium text-sm">
                        <i class="fas fa-star mr-2"></i>
                        Special Birthday Packages
                    </div>

                    <h2
                        class="text-3xl sm:text-4xl lg:text-5xl font-bold font-display bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 bg-clip-text text-transparent leading-tight">
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
                                <h4 class="font-semibold text-gray-800 text-lg">Magical Decorations</h4>
                                <p class="text-gray-600">Themed decorations that bring dreams to life</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4 group">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                <i class="fas fa-gamepad text-white text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 text-lg">Fun Activities</h4>
                                <p class="text-gray-600">Engaging games and entertainment for all ages</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4 group">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                <i class="fas fa-birthday-cake text-white text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 text-lg">Custom Cakes</h4>
                                <p class="text-gray-600">Delicious cakes designed to match your theme</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="{{ route('event-packages') }}"
                            class="inline-flex items-center justify-center bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-8 py-4 rounded-full font-semibold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <i class="fas fa-gift mr-3"></i>
                            View Birthday Packages
                        </a>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Collage Section -->
    <section id="gallery" class="py-20 bg-gradient-to-br from-pink-50 to-purple-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl py-2 font-bold font-display gradient-text mb-6" data-aos="fade-up">
                    Our Magic Gallery
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    Witness the joy and wonder we've created at countless celebrations
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-6xl mx-auto">
                <!-- Gallery Items with Unsplash Images -->
                <div class="col-span-1 row-span-2" data-aos="fade-up" data-aos-delay="100">
                    <div
                        class="relative overflow-hidden rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover-scale h-full">
                        <img src="https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=400&h=600&fit=crop"
                            alt="Birthday Party" class="w-full h-full object-cover">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                            <span class="text-white font-semibold">Birthday Celebration</span>
                        </div>
                    </div>
                </div>

                <div class="col-span-1" data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="relative overflow-hidden rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover-scale h-48">
                        <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=400&h=300&fit=crop"
                            alt="Wedding Setup" class="w-full h-full object-cover">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                            <span class="text-white font-semibold">Wedding Magic</span>
                        </div>
                    </div>
                </div>

                <div class="col-span-1" data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="relative overflow-hidden rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover-scale h-48">
                        <img src="https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?w=400&h=300&fit=crop"
                            alt="Corporate Event" class="w-full h-full object-cover">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                            <span class="text-white font-semibold">Corporate Event</span>
                        </div>
                    </div>
                </div>

                <div class="col-span-1" data-aos="fade-up" data-aos-delay="400">
                    <div
                        class="relative overflow-hidden rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover-scale h-48">
                        <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400&h=300&fit=crop"
                            alt="Anniversary" class="w-full h-full object-cover">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                            <span class="text-white font-semibold">Anniversary</span>
                        </div>
                    </div>
                </div>

                <div class="col-span-1" data-aos="fade-up" data-aos-delay="500">
                    <div
                        class="relative overflow-hidden rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover-scale h-48">
                        <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=400&h=300&fit=crop"
                            alt="Baby Shower" class="w-full h-full object-cover">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                            <span class="text-white font-semibold">Baby Shower</span>
                        </div>
                    </div>
                </div>

                <div class="col-span-2 row-span-1" data-aos="fade-up" data-aos-delay="600">
                    <div
                        class="relative overflow-hidden rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover-scale h-48">
                        <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=800&h=300&fit=crop"
                            alt="Event Setup" class="w-full h-full object-cover">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                            <span class="text-white font-semibold">Event Planning</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="700">
                <button
                    class="gradient-bg text-white px-8 py-4 rounded-full font-semibold text-lg hover:shadow-lg hover:scale-105 transition-all duration-300">
                    View Full Gallery
                </button>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section id="about" class="py-20 bg-gradient-to-br from-purple-50 to-pink-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl py-2 font-bold font-display gradient-text mb-6" data-aos="fade-up">
                    Why Choose Zuppie for Event Planning in Bihar?
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    We are the leading <strong>event management company in Purnia</strong> offering <strong>affordable
                        party packages</strong>
                    with exceptional service quality and creative decoration ideas for all your celebrations
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <div class="text-center group" data-aos="fade-up" data-aos-delay="100">
                    <div
                        class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-magic text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Magical Touch</h3>
                    <p class="text-gray-600">We add that special something that transforms ordinary events into
                        extraordinary experiences.</p>
                </div>

                <div class="text-center group" data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-users text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Expert Team</h3>
                    <p class="text-gray-600">Our passionate team of event specialists brings years of experience and
                        creativity to every project.</p>
                </div>

                <div class="text-center group" data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-heart text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Personal Touch</h3>
                    <p class="text-gray-600">Every event is tailored to your unique vision, preferences, and budget.</p>
                </div>

                <div class="text-center group" data-aos="fade-up" data-aos-delay="400">
                    <div
                        class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-clock text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">On-Time Delivery</h3>
                    <p class="text-gray-600">We ensure everything is perfectly executed on schedule, so you can relax
                        and enjoy.</p>
                </div>

                <div class="text-center group" data-aos="fade-up" data-aos-delay="500">
                    <div
                        class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-dollar-sign text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Transparent Pricing</h3>
                    <p class="text-gray-600">No hidden costs or surprises. We provide clear, upfront pricing for all our
                        services.</p>
                </div>

                <div class="text-center group" data-aos="fade-up" data-aos-delay="600">
                    <div
                        class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-medal text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Award Winning</h3>
                    <p class="text-gray-600">Recognized as the best event management company with numerous industry
                        awards.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl py-2 md:text-5xl font-bold font-display gradient-text mb-6" data-aos="fade-up">
                    Reviews from Our Satisfied Clients
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    Discover why we're the <strong>trusted event planning company in Purnia</strong> - hear testimonials
                    from our delighted clients who experienced our <strong>premium event management services</strong>
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300"
                    data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400 text-xl">
                            ★★★★★
                        </div>
                    </div>
                    <p class="text-gray-700 mb-6 italic">"Zuppie made my daughter's 5th birthday absolutely magical!
                        Every detail was perfect, and the kids were enchanted. Highly recommended!"</p>
                    <div class="flex items-center">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=50&h=50&fit=crop&crop=face"
                            alt="Sarah Johnson" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <div class="font-semibold text-gray-800">Sarah Johnson</div>
                            <div class="text-sm text-gray-500">Mother of Birthday Girl</div>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300"
                    data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400 text-xl">
                            ★★★★★
                        </div>
                    </div>
                    <p class="text-gray-700 mb-6 italic">"Our wedding was a dream come true thanks to Zuppie. They
                        handled everything with such professionalism and creativity!"</p>
                    <div class="flex items-center">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=50&h=50&fit=crop&crop=face"
                            alt="Michael Chen" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <div class="font-semibold text-gray-800">Michael Chen</div>
                            <div class="text-sm text-gray-500">Newlywed</div>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300"
                    data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400 text-xl">
                            ★★★★★
                        </div>
                    </div>
                    <p class="text-gray-700 mb-6 italic">"The corporate event they organized for us was flawless. Our
                        clients were impressed, and it exceeded all expectations!"</p>
                    <div class="flex items-center">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=50&h=50&fit=crop&crop=face"
                            alt="Emily Rodriguez" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <div class="font-semibold text-gray-800">Emily Rodriguez</div>
                            <div class="text-sm text-gray-500">CEO, Tech Solutions</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="py-20 bg-gradient-to-br from-pink-50 to-purple-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl py-2 font-bold font-display gradient-text mb-6" data-aos="fade-up">
                    Event Planning Tips & Decoration Ideas
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    Expert advice on <strong>birthday party planning</strong>, <strong>anniversary decorations</strong>,
                    and the latest trends for creating magical celebrations in Bihar
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <article
                    class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group"
                    data-aos="fade-up" data-aos-delay="100">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1464207687429-7505649dae38?w=400&h=250&fit=crop"
                            alt="Blog Post"
                            class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
                        <div
                            class="absolute top-4 left-4 bg-purple-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Tips
                        </div>
                    </div>
                    <div class="p-6">
                        <h3
                            class="text-xl font-bold text-gray-800 mb-3 group-hover:text-purple-600 transition-colors duration-300">
                            10 Birthday Party Ideas That Will Wow Your Guests
                        </h3>
                        <p class="text-gray-600 mb-4">Discover creative and magical birthday party themes that will make
                            your celebration unforgettable...</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">Jan 15, 2025</span>
                            <a href="#" class="text-purple-600 font-semibold hover:underline">Read More →</a>
                        </div>
                    </div>
                </article>

                <article
                    class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group"
                    data-aos="fade-up" data-aos-delay="200">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?w=400&h=250&fit=crop"
                            alt="Blog Post"
                            class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
                        <div
                            class="absolute top-4 left-4 bg-pink-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Trends
                        </div>
                    </div>
                    <div class="p-6">
                        <h3
                            class="text-xl font-bold text-gray-800 mb-3 group-hover:text-purple-600 transition-colors duration-300">
                            2025 Wedding Trends You Need to Know
                        </h3>
                        <p class="text-gray-600 mb-4">Stay ahead with the latest wedding trends that are taking 2025 by
                            storm...</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">Jan 10, 2025</span>
                            <a href="#" class="text-purple-600 font-semibold hover:underline">Read More →</a>
                        </div>
                    </div>
                </article>

                <article
                    class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group"
                    data-aos="fade-up" data-aos-delay="300">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?w=400&h=250&fit=crop"
                            alt="Blog Post"
                            class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
                        <div
                            class="absolute top-4 left-4 bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Guide
                        </div>
                    </div>
                    <div class="p-6">
                        <h3
                            class="text-xl font-bold text-gray-800 mb-3 group-hover:text-purple-600 transition-colors duration-300">
                            Corporate Event Planning: A Complete Guide
                        </h3>
                        <p class="text-gray-600 mb-4">Everything you need to know about planning successful corporate
                            events...</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">Jan 5, 2025</span>
                            <a href="#" class="text-purple-600 font-semibold hover:underline">Read More →</a>
                        </div>
                    </div>
                </article>
            </div>

            <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="400">
                <button
                    class="gradient-bg text-white px-8 py-4 rounded-full font-semibold text-lg hover:shadow-lg hover:scale-105 transition-all duration-300">
                    Visit Our Blog
                </button>
            </div>
        </div>
    </section>

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