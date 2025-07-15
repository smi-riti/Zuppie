<!-- Hero Section with Animated Tagline -->
<div>
    <section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background with Parallax Effect -->
        <div class="absolute inset-0 gradient-bg parallax-bg"></div>
        <div class="absolute inset-0 bg-black/20"></div>

        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 w-6 h-6 bg-yellow-400 rounded-full animate-float opacity-80"></div>
        <div class="absolute top-40 right-20 w-4 h-4 bg-pink-400 rounded-full animate-bounce-slow opacity-60"></div>
        <div class="absolute bottom-32 left-20 w-8 h-8 bg-purple-400 rounded-full animate-pulse-slow opacity-70"></div>
        <div class="absolute bottom-20 right-10 w-5 h-5 bg-indigo-400 rounded-full animate-float opacity-80"></div>

        <div class="relative z-10 text-center text-white px-4 max-w-6xl mx-auto">
            <!-- Main Tagline with Animation -->
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold font-display mb-6" data-aos="fade-up">
                <span class="block sparkle" data-aos="zoom-in" data-aos-delay="200">✨ Make Every</span>
                <span
                    class="block gradient-text bg-gradient-to-r from-yellow-400 to-pink-400 bg-clip-text text-transparent animate-pulse"
                    data-aos="zoom-in" data-aos-delay="400">
                    Moment Magical
                </span>
            </h1>

            <p class="text-xl md:text-2xl mb-8 opacity-90 max-w-3xl mx-auto leading-relaxed" data-aos="fade-up"
                data-aos-delay="600">
                From intimate birthday celebrations to grand special events, we create unforgettable experiences that
                bring joy, wonder, and pure magic to your most precious moments.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center" data-aos="fade-up"
                data-aos-delay="800">
                <a href="#categories"
                    class="bg-white text-zuppie-purple px-8 py-4 rounded-full font-semibold text-lg hover:shadow-2xl hover:scale-105 transition-all duration-300 flex items-center space-x-2">
                    <i class="fas fa-calendar-star"></i>
                    <span>Explore Events</span>
                </a>
                <a href="#packages"
                    class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white hover:text-zuppie-purple transition-all duration-300 flex items-center space-x-2">
                    <i class="fas fa-gift"></i>
                    <span>View Packages</span>
                </a>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mt-16 max-w-4xl mx-auto" data-aos="fade-up"
                data-aos-delay="1000">
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold mb-2">500+</div>
                    <div class="text-sm md:text-base opacity-80">Events Planned</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold mb-2">98%</div>
                    <div class="text-sm md:text-base opacity-80">Happy Clients</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold mb-2">50+</div>
                    <div class="text-sm md:text-base opacity-80">Event Types</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold mb-2">5★</div>
                    <div class="text-sm md:text-base opacity-80">Average Rating</div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <i class="fas fa-chevron-down text-white text-2xl opacity-70"></i>
        </div>
    </section>

    <!-- Categories Section -->
    <section id="categories" class="py-20 bg-gradient-to-br from-purple-50 to-pink-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold font-display gradient-text mb-6" data-aos="fade-up">
                    Event Categories
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    Discover our magical collection of event categories, each designed to create unforgettable moments
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
                @foreach ($categories as $category)
                    <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover-scale"
                        data-aos="fade-up" data-aos-delay="100">
                        <div class="relative h-80">
                            <img src="{{ $category->image }}" alt="Birthday Party" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-pink-400/50 to-purple-400/30"></div>
                            <div class="absolute inset-0 p-8 text-white flex flex-col justify-end">
                                <div
                                    class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-birthday-cake text-3xl"></i>
                                </div>
                                <h3 class="text-2xl font-bold mb-2">{{$category->name}}</h3>
                                <p class="text-sm opacity-90">{{$category->description}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Packages Section with Auto-Swipe -->
    <section id="packages" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold font-display gradient-text mb-6" data-aos="fade-up">
                    Event Packages
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    Choose from our carefully crafted packages designed to make your event planning effortless
                </p>
            </div>

            <div class="relative max-w-7xl mx-auto">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($packages as $package)
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden"
                            data-aos="fade-up">
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ $package->images->first()->image_url }}" alt="package_image"
                                    class="w-full h-full object-cover">

                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                <div class="absolute bottom-4 left-4 text-white">
                                    <h3 class="text-lg font-bold">{{ $package->name }}</h3>
                                    <p class="text-sm opacity-90 mt-1">
                                        <i class="fas fa-clock mr-1"></i> {{ $package->formatted_duration }}
                                    </p>
                                </div>
                            </div>

                            <div class="p-6">
                                <div class="text-center mb-4">
                                    <!-- Price with discount if available -->
                                    @if($package->discount_value > 0)
                                        <div class="flex justify-center items-center space-x-2 mb-2">
                                            <span
                                                class="text-gray-400 line-through text-lg">₹{{ number_format($package->price, 2) }}</span>
                                            <span class="text-3xl font-bold gradient-text">
                                                ₹{{ number_format($package->discounted_price, 2) }}
                                            </span>
                                            @if($package->discount_type === 'percentage')
                                                <span class="text-sm bg-red-100 text-red-800 px-2 py-1 rounded-full">
                                                    {{ $package->discount_value }}% OFF
                                                </span>
                                            @else
                                                <span class="text-sm bg-red-100 text-red-800 px-2 py-1 rounded-full">
                                                    ₹{{ $package->discount_value }} OFF
                                                </span>
                                            @endif
                                        </div>
                                    @else
                                        <div class="text-3xl font-bold gradient-text mb-2">
                                            ₹{{ number_format($package->price, 2) }}</div>
                                    @endif
                                    <p class="text-gray-600 text-sm mb-3">{{ $package->description }}</p>

                                    <div class="flex justify-center space-x-4 text-xs text-gray-500">

                                        @if($package->category)
                                            <span><i class="fas fa-tag mr-1"></i> {{ $package->category->name }}</span>
                                        @endif
                                    </div>
                                </div>

                                <button
                                    class="w-full bg-primary hover:bg-primary-dark text-white py-2 rounded-lg transition-colors">
                                    Book Now
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Collage Section -->
    <section id="gallery" class="py-20 bg-gradient-to-br from-pink-50 to-purple-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold font-display gradient-text mb-6" data-aos="fade-up">
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

    <!-- Birthday Special Section -->
    <section class="py-20 bg-white relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-purple-100 to-pink-100 opacity-50"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-center max-w-7xl mx-auto">
                <div data-aos="fade-right">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1558636508-e0db3814bd1d?w=600&h=400&fit=crop"
                            alt="Birthday Special" class="rounded-2xl shadow-2xl">
                        <div
                            class="absolute -top-4 -right-4 w-24 h-24 gradient-bg rounded-full flex items-center justify-center text-white text-2xl animate-bounce-slow">
                            🎉
                        </div>
                    </div>
                </div>

                <div data-aos="fade-left">
                    <h2 class="text-4xl md:text-5xl font-bold font-display gradient-text mb-6">
                        Birthday Specials
                    </h2>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Make every birthday unforgettable with our magical touch. From intimate gatherings to grand
                        celebrations,
                        we specialize in creating birthday experiences that sparkle with joy and wonder.
                    </p>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 gradient-bg rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <span class="text-gray-700">Custom themed decorations</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 gradient-bg rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <span class="text-gray-700">Professional photography & videography</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 gradient-bg rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <span class="text-gray-700">Entertainment and activities</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 gradient-bg rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <span class="text-gray-700">Custom birthday cake & catering</span>
                        </div>
                    </div>

                    <button
                        class="gradient-bg text-white px-8 py-4 rounded-full font-semibold text-lg hover:shadow-lg hover:scale-105 transition-all duration-300 mr-4">
                        Plan Birthday Event
                    </button>
                    <button
                        class="border-2 border-zuppie-purple text-zuppie-purple px-8 py-4 rounded-full font-semibold text-lg hover:bg-zuppie-purple hover:text-white transition-all duration-300">
                        View Portfolio
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section id="about" class="py-20 bg-gradient-to-br from-purple-50 to-pink-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold font-display gradient-text mb-6" data-aos="fade-up">
                    Why Choose Zuppie?
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    We don't just plan events, we create magical experiences that leave lasting memories
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
                <h2 class="text-4xl md:text-5xl font-bold font-display gradient-text mb-6" data-aos="fade-up">
                    What Our Clients Say
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    Don't just take our word for it - hear from our delighted clients
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
                <h2 class="text-4xl md:text-5xl font-bold font-display gradient-text mb-6" data-aos="fade-up">
                    Latest from Our Blog
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    Tips, trends, and inspiration for your next magical event
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
                            class="absolute top-4 left-4 bg-zuppie-purple text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Tips
                        </div>
                    </div>
                    <div class="p-6">
                        <h3
                            class="text-xl font-bold text-gray-800 mb-3 group-hover:text-zuppie-purple transition-colors duration-300">
                            10 Birthday Party Ideas That Will Wow Your Guests
                        </h3>
                        <p class="text-gray-600 mb-4">Discover creative and magical birthday party themes that will make
                            your celebration unforgettable...</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">Jan 15, 2025</span>
                            <a href="#" class="text-zuppie-purple font-semibold hover:underline">Read More →</a>
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
                            class="absolute top-4 left-4 bg-zuppie-pink text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Trends
                        </div>
                    </div>
                    <div class="p-6">
                        <h3
                            class="text-xl font-bold text-gray-800 mb-3 group-hover:text-zuppie-purple transition-colors duration-300">
                            2025 Wedding Trends You Need to Know
                        </h3>
                        <p class="text-gray-600 mb-4">Stay ahead with the latest wedding trends that are taking 2025 by
                            storm...</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">Jan 10, 2025</span>
                            <a href="#" class="text-zuppie-purple font-semibold hover:underline">Read More →</a>
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
                            class="text-xl font-bold text-gray-800 mb-3 group-hover:text-zuppie-purple transition-colors duration-300">
                            Corporate Event Planning: A Complete Guide
                        </h3>
                        <p class="text-gray-600 mb-4">Everything you need to know about planning successful corporate
                            events...</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">Jan 5, 2025</span>
                            <a href="#" class="text-zuppie-purple font-semibold hover:underline">Read More →</a>
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
    <section id="contact" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold font-display gradient-text mb-6" data-aos="fade-up">
                    Let's Create Magic Together
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    Ready to plan your magical event? Get in touch and let's bring your vision to life!
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-16 max-w-6xl mx-auto">
                <!-- Contact Info -->
                <div data-aos="fade-right">
                    <div class="space-y-8">
                        <div class="flex items-start space-x-4">
                            <div
                                class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">Visit Our Office</h3>
                                <p class="text-gray-600">123 Magic Lane, Celebration City, CC 12345</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div
                                class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-phone text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">Call Us</h3>
                                <p class="text-gray-600">+1 (555) 123-MAGIC</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div
                                class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">Email Us</h3>
                                <p class="text-gray-600">hello@zuppie.com</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div
                                class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-clock text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">Business Hours</h3>
                                <p class="text-gray-600">Mon - Fri: 9AM - 6PM<br>Sat - Sun: 10AM - 4PM</p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="mt-12">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Follow Us</h3>
                        <div class="flex space-x-4">
                            <a href="#"
                                class="w-10 h-10 gradient-bg rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#"
                                class="w-10 h-10 gradient-bg rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#"
                                class="w-10 h-10 gradient-bg rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#"
                                class="w-10 h-10 gradient-bg rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div data-aos="fade-left">
                    <form class="space-y-6" wire:submit.prevent="submitContact">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">First Name *</label>
                                <input type="text" wire:model="firstName"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zuppie-purple focus:border-transparent transition-all duration-300"
                                    placeholder="Your first name">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Last Name *</label>
                                <input type="text" wire:model="lastName"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zuppie-purple focus:border-transparent transition-all duration-300"
                                    placeholder="Your last name">
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Email Address *</label>
                            <input type="email" wire:model="email"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zuppie-purple focus:border-transparent transition-all duration-300"
                                placeholder="your@email.com">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Phone Number</label>
                            <input type="tel" wire:model="phone"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zuppie-purple focus:border-transparent transition-all duration-300"
                                placeholder="(555) 123-4567">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Event Type</label>
                            <select wire:model="eventType"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zuppie-purple focus:border-transparent transition-all duration-300">
                                <option value="">Select Event Type</option>
                                <option value="birthday">Birthday Party</option>
                                <option value="wedding">Wedding</option>
                                <option value="corporate">Corporate Event</option>
                                <option value="anniversary">Anniversary</option>
                                <option value="baby_shower">Baby Shower</option>
                                <option value="graduation">Graduation</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Event Date</label>
                            <input type="date" wire:model="eventDate"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zuppie-purple focus:border-transparent transition-all duration-300">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Budget Range</label>
                            <select wire:model="budget"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zuppie-purple focus:border-transparent transition-all duration-300">
                                <option value="">Select Budget Range</option>
                                <option value="under_500">Under $500</option>
                                <option value="500_1000">$500 - $1,000</option>
                                <option value="1000_2500">$1,000 - $2,500</option>
                                <option value="2500_5000">$2,500 - $5,000</option>
                                <option value="over_5000">Over $5,000</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Tell us about your event *</label>
                            <textarea wire:model="message" rows="5"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zuppie-purple focus:border-transparent transition-all duration-300"
                                placeholder="Share your vision, requirements, and any special requests..."></textarea>
                        </div>

                        <button type="submit"
                            class="w-full gradient-bg text-white py-4 rounded-lg font-semibold text-lg hover:shadow-lg hover:scale-105 transition-all duration-300 flex items-center justify-center space-x-2">
                            <i class="fas fa-paper-plane"></i>
                            <span>Send Message</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>