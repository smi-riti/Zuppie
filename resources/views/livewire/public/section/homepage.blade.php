<div class="font-sans antialiased  text-gray-900 overflow-x-hidden">
    <!-- ===== 1. Supercharged Hero Section ===== -->
<div class="mt-16">
    <div class="flex flex-wrap gap-4 p-6 justify-center ">
        @foreach($categories as $category)
            <div class="font-semibold text-pink-700 text-lg">{{ $category->name }}</div>
            
        @endforeach
    </div>
</div>
    <section class="relative h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-purple-900 via-pink-800 to-indigo-900">
        <!-- Animated Particles Background -->
        <div class="absolute inset-0 particle-container">
            <!-- Floating decorative elements -->
            <div class="absolute top-1/4 left-1/4 w-40 h-40 rounded-full bg-pink-500/10 animate-float-1 blur-xl"></div>
            <div class="absolute bottom-1/3 right-1/4 w-48 h-48 rounded-full bg-purple-500/10 animate-float-2 blur-xl"></div>
            <div class="absolute top-1/3 right-1/3 w-32 h-32 rounded-full bg-white/5 animate-float-3 blur-xl"></div>
            
            <!-- Dynamic particles -->
            <div class="particle" style="top:20%; left:10%; animation-delay:0s;"></div>
            <div class="particle" style="top:60%; left:80%; animation-delay:1s;"></div>
            <div class="particle" style="top:40%; left:30%; animation-delay:2s;"></div>
            <div class="particle" style="top:70%; left:40%; animation-delay:3s;"></div>
            <div class="particle" style="top:10%; left:70%; animation-delay:1.5s;"></div>
            <div class="particle" style="top:80%; left:20%; animation-delay:2.5s;"></div>
        </div>

        <!-- Floating decorative shapes -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden">
            <div class="absolute -top-20 -left-20 w-80 h-80 rounded-full bg-pink-500/5 animate-pulse"></div>
            <div class="absolute -bottom-40 -right-40 w-96 h-96 rounded-full bg-purple-500/5 animate-pulse animation-delay-2000"></div>
            <div class="absolute top-1/3 right-0 transform translate-x-1/2 w-64 h-64 rounded-full bg-white/5 animate-pulse animation-delay-3000"></div>
        </div>

        <!-- Hero content with creative layout -->
        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col lg:flex-row items-center">
                <!-- Left side - Creative text elements -->
                <div class="lg:w-1/2 mb-12 lg:mb-0 relative">
                    <!-- Floating text elements -->
                    <div class="absolute -top-16 -left-10 text-8xl font-bold text-white/10">01</div>
                    <div class="absolute -bottom-16 -right-10 text-8xl font-bold text-white/10 rotate-12">EVENT</div>
                    
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                        <span class="relative inline-block">
                            <span class="absolute -bottom-2 left-0 w-full h-3 bg-pink-400/50 z-0 transform -skew-y-2"></span>
                            <span class="relative z-10">Create</span>
                        </span>
                        <span class="typewrite text-transparent bg-clip-text bg-gradient-to-r from-pink-300 via-purple-300 to-indigo-300" 
                              data-text='["Unforgettable Moments","Magical Weddings","Epic Celebrations","Dream Events"]'></span>
                    </h1>
                    
                    <p class="text-xl text-pink-100 mb-8 max-w-lg">
                        India's premier event planning platform with 1000+ venues and 500+ trusted vendors
                    </p>
                    
                    <!-- Creative stats bar -->
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 mb-8 border border-white/10 shadow-lg">
                        <div class="flex flex-wrap justify-between text-center">
                            <div class="px-4 py-2">
                                <div class="text-3xl font-bold text-white">10K+</div>
                                <div class="text-pink-200 text-sm">Happy Couples</div>
                            </div>
                            <div class="px-4 py-2">
                                <div class="text-3xl font-bold text-white">1K+</div>
                                <div class="text-pink-200 text-sm">Venues</div>
                            </div>
                            <div class="px-4 py-2">
                                <div class="text-3xl font-bold text-white">50+</div>
                                <div class="text-pink-200 text-sm">Cities</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Creative CTA buttons -->
                    <div class="flex flex-wrap gap-4">
                        <button class="px-8 py-4 bg-gradient-to-r from-pink-600 to-purple-600 text-white rounded-xl font-bold hover:from-pink-700 hover:to-purple-700 transition-all transform hover:-translate-y-1 shadow-lg hover:shadow-xl flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Explore Venues
                        </button>
                        <button class="px-8 py-4 bg-transparent border-2 border-white text-white rounded-xl font-bold hover:bg-white/10 transition-all transform hover:-translate-y-1 shadow-lg hover:shadow-xl flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            Talk to Expert
                        </button>
                    </div>
                </div>
                
                <!-- Right side - Animated search card -->
                <div class="lg:w-1/2 lg:pl-12 relative">
                    <div class="relative">
                        <!-- Floating card decoration -->
                        <div class="absolute -top-6 -left-6 w-full h-full rounded-2xl border-2 border-pink-400/30 z-0"></div>
                        <div class="absolute -top-3 -left-3 w-full h-full rounded-2xl border-2 border-purple-400/30 z-0"></div>
                        
                        <!-- Main search card -->
                        <div class="relative bg-white/90 backdrop-blur-sm rounded-2xl shadow-2xl p-8 transform rotate-1 hover:rotate-0 transition duration-500 z-10">
                            <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">Find Your Perfect Venue</h3>
                            
                            <div class="space-y-4">
                                <div class="relative">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">What are you planning?</label>
                                    <select class="w-full px-4 py-3 pr-8 border border-gray-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 appearance-none bg-white">
                                        <option>Wedding Celebration</option>
                                        <option>Birthday Party</option>
                                        <option>Corporate Event</option>
                                        <option>Anniversary</option>
                                        <option>Engagement</option>
                                        <option>Baby Shower</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none top-7">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                                    <div class="relative">
                                        <input type="text" placeholder="City or venue name" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 top-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Event Date</label>
                                        <input type="date" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Guest Count</label>
                                        <select class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                                            <option>50-100</option>
                                            <option>100-200</option>
                                            <option>200-500</option>
                                            <option>500+</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <button class="w-full mt-6 px-6 py-3 bg-gradient-to-r from-pink-600 to-purple-600 text-white rounded-lg hover:from-pink-700 hover:to-purple-700 transition flex items-center justify-center shadow-md hover:shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Search Venues
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Animated Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
            <div class="animate-bounce flex flex-col items-center">
                <span class="text-white text-sm mb-1">Scroll to Explore</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </div>
        </div>
    </section>

    <!-- ===== 2. Slideable Category Explorer ===== -->
    <section class="py-16 bg-pink-200 relative">
        <div class="absolute top-0 left-0 w-full h-16 bg-gradient-to-b from-white to-transparent z-20"></div>
        <div class="absolute bottom-0 left-0 w-full h-16 bg-gradient-to-t from-white to-transparent z-20"></div>
        
        <div class="container mx-auto px-4 relative">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    <span class="relative inline-block">
                        <span class="absolute -bottom-1 left-0 w-full h-3 bg-pink-200/50 z-0 transform -skew-y-1"></span>
                        <span class="relative z-10">Browse By Category</span>
                    </span>
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">Find the perfect venue for your special occasion</p>
            </div>
            
            <!-- Slideable Category Navigation -->
            <div class="relative mb-8">
                <div class="category-scroller flex overflow-x-auto pb-6 scrollbar-hide snap-x snap-mandatory">
                    <div class="flex space-x-3 mx-auto px-4">
                        <button class="px-6 py-2 bg-pink-600 text-white rounded-full whitespace-nowrap shadow-lg hover:bg-pink-700 transition snap-start flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                            All Venues
                        </button>
                        <button class="px-6 py-2 bg-white border border-gray-200 rounded-full hover:bg-pink-50 whitespace-nowrap shadow-sm hover:shadow-md transition snap-start flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Wedding Halls
                        </button>
                        <button class="px-6 py-2 bg-white border border-gray-200 rounded-full hover:bg-pink-50 whitespace-nowrap shadow-sm hover:shadow-md transition snap-start flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Outdoor Gardens
                        </button>
                        <button class="px-6 py-2 bg-white border border-gray-200 rounded-full hover:bg-pink-50 whitespace-nowrap shadow-sm hover:shadow-md transition snap-start flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Hotels
                        </button>
                        <button class="px-6 py-2 bg-white border border-gray-200 rounded-full hover:bg-pink-50 whitespace-nowrap shadow-sm hover:shadow-md transition snap-start flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Destination
                        </button>
                        <button class="px-6 py-2 bg-white border border-gray-200 rounded-full hover:bg-pink-50 whitespace-nowrap shadow-sm hover:shadow-md transition snap-start flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            Rooftop
                        </button>
                        <button class="px-6 py-2 bg-white border border-gray-200 rounded-full hover:bg-pink-50 whitespace-nowrap shadow-sm hover:shadow-md transition snap-start flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                            Customizable
                        </button>
                    </div>
                </div>
                
                <!-- Navigation arrows -->
                <button class="category-scroll-left absolute left-0 top-1/2 transform -translate-y-1/2 -ml-4 bg-white p-2 rounded-full shadow-md hover:bg-pink-100 transition z-10 hidden md:block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button class="category-scroll-right absolute right-0 top-1/2 transform -translate-y-1/2 -mr-4 bg-white p-2 rounded-full shadow-md hover:bg-pink-100 transition z-10 hidden md:block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            
            <!-- Slideable Category Grid -->
            <div class="relative">
                <div class="venue-scroller flex overflow-x-auto pb-8 scrollbar-hide snap-x snap-mandatory">
                    <div class="flex space-x-6 mx-auto px-4">
                        <!-- Wedding Palace -->
                        <div class="group relative overflow-hidden rounded-2xl shadow-lg h-96 w-80 flex-shrink-0 snap-start">
                            <div class="relative h-full w-full">
                                <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                                     class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                <div class="absolute bottom-0 left-0 p-6 w-full">
                                    <h3 class="text-2xl font-bold text-white mb-2 transform group-hover:-translate-y-2 transition duration-300">Grand Wedding Palaces</h3>
                                    <p class="text-pink-200 opacity-0 group-hover:opacity-100 transition duration-500">50+ venues starting at ₹1,50,000</p>
                                    <button class="mt-4 px-4 py-2 bg-white text-pink-600 rounded-lg font-medium opacity-0 group-hover:opacity-100 transform group-hover:-translate-y-2 transition duration-500">
                                        Explore Now
                                    </button>
                                </div>
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1 bg-white/90 text-pink-600 rounded-full text-sm font-medium shadow-sm">Most Popular</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Garden Venues -->
                        <div class="group relative overflow-hidden rounded-2xl shadow-lg h-96 w-80 flex-shrink-0 snap-start">
                            <div class="relative h-full w-full">
                                <img src="https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                                     class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                <div class="absolute bottom-0 left-0 p-6 w-full">
                                    <h3 class="text-2xl font-bold text-white mb-2 transform group-hover:-translate-y-2 transition duration-300">Garden Venues</h3>
                                    <p class="text-pink-200 opacity-0 group-hover:opacity-100 transition duration-500">Romantic outdoor settings</p>
                                    <button class="mt-4 px-4 py-2 bg-white text-pink-600 rounded-lg font-medium opacity-0 group-hover:opacity-100 transform group-hover:-translate-y-2 transition duration-500">
                                        Explore Now
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Beach Weddings -->
                        <div class="group relative overflow-hidden rounded-2xl shadow-lg h-96 w-80 flex-shrink-0 snap-start">
                            <div class="relative h-full w-full">
                                <img src="https://images.unsplash.com/photo-1519046904884-53103b34b206?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                                     class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                <div class="absolute bottom-0 left-0 p-6 w-full">
                                    <h3 class="text-2xl font-bold text-white mb-2 transform group-hover:-translate-y-2 transition duration-300">Beach Weddings</h3>
                                    <p class="text-pink-200 opacity-0 group-hover:opacity-100 transition duration-500">Destination beachfront venues</p>
                                    <button class="mt-4 px-4 py-2 bg-white text-pink-600 rounded-lg font-medium opacity-0 group-hover:opacity-100 transform group-hover:-translate-y-2 transition duration-500">
                                        Explore Now
                                    </button>
                                </div>
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1 bg-white/90 text-pink-600 rounded-full text-sm font-medium shadow-sm">Trending</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Luxury Hotels -->
                        <div class="group relative overflow-hidden rounded-2xl shadow-lg h-96 w-80 flex-shrink-0 snap-start">
                            <div class="relative h-full w-full">
                                <img src="https://images.unsplash.com/photo-1530103862676-de8c9debad1d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                                     class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                <div class="absolute bottom-0 left-0 p-6 w-full">
                                    <h3 class="text-2xl font-bold text-white mb-2 transform group-hover:-translate-y-2 transition duration-300">Luxury Hotels</h3>
                                    <p class="text-pink-200 opacity-0 group-hover:opacity-100 transition duration-500">5-star experiences</p>
                                    <button class="mt-4 px-4 py-2 bg-white text-pink-600 rounded-lg font-medium opacity-0 group-hover:opacity-100 transform group-hover:-translate-y-2 transition duration-500">
                                        Explore Now
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- View All Card -->
                        <div class="group relative overflow-hidden rounded-2xl shadow-lg h-96 w-80 flex-shrink-0 snap-start bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center">
                            <div class="text-center p-6 transform group-hover:scale-105 transition duration-500">
                                <div class="w-16 h-16 mx-auto mb-6 rounded-full bg-white flex items-center justify-center shadow-md transform group-hover:rotate-12 transition duration-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-800 mb-3">Explore All Categories</h3>
                                <p class="text-gray-600 mb-4">Discover 1000+ venues across India</p>
                                <button class="px-6 py-2 bg-white text-pink-600 rounded-lg font-medium shadow-md hover:bg-gray-50 transition flex items-center mx-auto">
                                    View All
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Navigation arrows -->
                <button class="venue-scroll-left absolute left-0 top-1/2 transform -translate-y-1/2 -ml-4 bg-white p-2 rounded-full shadow-md hover:bg-pink-100 transition z-10 hidden md:block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button class="venue-scroll-right absolute right-0 top-1/2 transform -translate-y-1/2 -mr-4 bg-white p-2 rounded-full shadow-md hover:bg-pink-100 transition z-10 hidden md:block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </section>


    <!-- ===== 3. Enhanced Featured Venues Carousel with Swiper ===== -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Featured Venues</h2>
                    <p class="text-gray-600">Handpicked by our event specialists</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="swiper-button-prev venue-prev-btn p-2 rounded-full bg-white shadow-md hover:bg-pink-100 transition transform hover:scale-110 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </div>
                    <div class="swiper-button-next venue-next-btn p-2 rounded-full bg-white shadow-md hover:bg-pink-100 transition transform hover:scale-110 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Swiper Container -->
            <div class="swiper venue-swiper">
                <div class="swiper-wrapper pb-8">
                    <!-- Venue 1 -->
                    <div class="swiper-slide">
                        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition transform hover:-translate-y-2 h-full">
                            <div class="relative h-64 overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1530103862676-de8c9debad1d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                                     class="w-full h-full object-cover hover:scale-105 transition duration-700">
                                <div class="absolute top-4 right-4">
                                    <button class="p-2 bg-white/90 rounded-full shadow-md hover:bg-pink-100 transition transform hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 hover:text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="absolute bottom-4 left-4 bg-pink-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    ₹2,20,000 onwards
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-xl font-bold text-gray-800">Royal Orchid Banquet</h3>
                                    <div class="flex items-center bg-pink-100 text-pink-800 px-2 py-1 rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span>4.9</span>
                                    </div>
                                </div>
                                <p class="text-gray-600 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Powai, Mumbai • 700+ guests
                                </p>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span class="text-xs bg-gray-100 px-2 py-1 rounded">5-Star Hotel</span>
                                    <span class="text-xs bg-gray-100 px-2 py-1 rounded">In-house Catering</span>
                                    <span class="text-xs bg-gray-100 px-2 py-1 rounded">Valet Parking</span>
                                </div>
                                <button class="w-full px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition flex items-center justify-center transform hover:scale-105">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Venue 2 -->
                    <div class="swiper-slide">
                        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition transform hover:-translate-y-2 h-full">
                            <div class="relative h-64 overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                                     class="w-full h-full object-cover hover:scale-105 transition duration-700">
                                <div class="absolute top-4 right-4">
                                    <button class="p-2 bg-white/90 rounded-full shadow-md hover:bg-pink-100 transition transform hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 hover:text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="absolute bottom-4 left-4 bg-pink-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    ₹1,80,000 onwards
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-xl font-bold text-gray-800">Gardenia Resort</h3>
                                    <div class="flex items-center bg-pink-100 text-pink-800 px-2 py-1 rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span>4.7</span>
                                    </div>
                                </div>
                                <p class="text-gray-600 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Whitefield, Bangalore • 500+ guests
                                </p>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span class="text-xs bg-gray-100 px-2 py-1 rounded">Outdoor Garden</span>
                                    <span class="text-xs bg-gray-100 px-2 py-1 rounded">Poolside</span>
                                    <span class="text-xs bg-gray-100 px-2 py-1 rounded">DJ Setup</span>
                                </div>
                                <button class="w-full px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition flex items-center justify-center transform hover:scale-105">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Venue 3 -->
                    <div class="swiper-slide">
                        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition transform hover:-translate-y-2 h-full">
                            <div class="relative h-64 overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1523438885200-e635ba2c371e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                                     class="w-full h-full object-cover hover:scale-105 transition duration-700">
                                <div class="absolute top-4 right-4">
                                    <button class="p-2 bg-white/90 rounded-full shadow-md hover:bg-pink-100 transition transform hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 hover:text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="absolute bottom-4 left-4 bg-pink-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    ₹2,50,000 onwards
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-xl font-bold text-gray-800">Taj Banquets</h3>
                                    <div class="flex items-center bg-pink-100 text-pink-800 px-2 py-1 rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span>4.8</span>
                                    </div>
                                </div>
                                <p class="text-gray-600 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Colaba, Mumbai • 1000+ guests
                                </p>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span class="text-xs bg-gray-100 px-2 py-1 rounded">Luxury Hotel</span>
                                    <span class="text-xs bg-gray-100 px-2 py-1 rounded">Fine Dining</span>
                                    <span class="text-xs bg-gray-100 px-2 py-1 rounded">Ballroom</span>
                                </div>
                                <button class="w-full px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition flex items-center justify-center transform hover:scale-105">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Venue 4 -->
                    <div class="swiper-slide">
                        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition transform hover:-translate-y-2 h-full">
                            <div class="relative h-64 overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1519046904884-53103b34b206?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                                     class="w-full h-full object-cover hover:scale-105 transition duration-700">
                                <div class="absolute top-4 right-4">
                                    <button class="p-2 bg-white/90 rounded-full shadow-md hover:bg-pink-100 transition transform hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 hover:text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="absolute bottom-4 left-4 bg-pink-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    ₹3,00,000 onwards
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-xl font-bold text-gray-800">Goa Beach Resort</h3>
                                    <div class="flex items-center bg-pink-100 text-pink-800 px-2 py-1 rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span>4.9</span>
                                    </div>
                                </div>
                                <p class="text-gray-600 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    North Goa • 300+ guests
                                </p>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span class="text-xs bg-gray-100 px-2 py-1 rounded">Beachfront</span>
                                    <span class="text-xs bg-gray-100 px-2 py-1 rounded">Destination</span>
                                    <span class="text-xs bg-gray-100 px-2 py-1 rounded">Sunset Views</span>
                                </div>
                                <button class="w-full px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition flex items-center justify-center transform hover:scale-105">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Add pagination -->
                <div class="swiper-pagination mt-4"></div>
            </div>
        </div>
    </section>

    <!-- ===== 4. Enhanced Why Choose Us ===== -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    <span class="relative inline-block">
                        <span class="absolute -bottom-1 left-0 w-full h-2 bg-pink-200 z-0"></span>
                        <span class="relative z-10">Why Book With Us?</span>
                    </span>
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">We make event planning effortless and memorable</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Benefit 1 -->
                <div class="bg-gray-50 rounded-xl p-8 hover:bg-white hover:shadow-lg transition group">
                    <div class="w-16 h-16 mb-6 rounded-xl bg-pink-100 flex items-center justify-center text-pink-600 transform group-hover:rotate-6 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Verified Venues</h3>
                    <p class="text-gray-600">Every venue is personally inspected by our team for quality and amenities</p>
                </div>
                
                <!-- Benefit 2 -->
                <div class="bg-gray-50 rounded-xl p-8 hover:bg-white hover:shadow-lg transition group">
                    <div class="w-16 h-16 mb-6 rounded-xl bg-purple-100 flex items-center justify-center text-purple-600 transform group-hover:-rotate-6 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Best Price Guarantee</h3>
                    <p class="text-gray-600">We negotiate the best rates so you don't have to</p>
                </div>
                
                <!-- Benefit 3 -->
                <div class="bg-gray-50 rounded-xl p-8 hover:bg-white hover:shadow-lg transition group">
                    <div class="w-16 h-16 mb-6 rounded-xl bg-pink-100 flex items-center justify-center text-pink-600 transform group-hover:rotate-12 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">24/7 Support</h3>
                    <p class="text-gray-600">Dedicated event specialist available round the clock</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== 5. Enhanced Real Weddings Gallery ===== -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Real Weddings</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">Get inspired by these beautiful celebrations</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <!-- Gallery Item 1 -->
                <a href="#" class="group relative block aspect-square overflow-hidden rounded-lg shadow-md hover:shadow-xl transition">
                    <img src="https://images.unsplash.com/photo-1523438885200-e635ba2c371e?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                         class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex items-end p-4">
                        <div>
                            <h3 class="text-white font-medium">Priya & Rahul's Wedding</h3>
                            <p class="text-pink-200 text-sm">Grand Palace, Mumbai</p>
                        </div>
                    </div>
                </a>
                
                <!-- Gallery Item 2 -->
                <a href="#" class="group relative block aspect-square overflow-hidden rounded-lg shadow-md hover:shadow-xl transition">
                    <img src="https://images.unsplash.com/photo-1523438885200-e635ba2c371e?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                         class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex items-end p-4">
                        <div>
                            <h3 class="text-white font-medium">Ananya & Vikram's Wedding</h3>
                            <p class="text-pink-200 text-sm">Beach Resort, Goa</p>
                        </div>
                    </div>
                </a>
                
                <!-- Gallery Item 3 -->
                <a href="#" class="group relative block aspect-square overflow-hidden rounded-lg shadow-md hover:shadow-xl transition">
                    <img src="https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                         class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex items-end p-4">
                        <div>
                            <h3 class="text-white font-medium">Neha & Arjun's Wedding</h3>
                            <p class="text-pink-200 text-sm">Heritage Palace, Jaipur</p>
                        </div>
                    </div>
                </a>
                
                <!-- Gallery Item 4 -->
                <a href="#" class="group relative block aspect-square overflow-hidden rounded-lg shadow-md hover:shadow-xl transition">
                    <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                         class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex items-end p-4">
                        <div>
                            <h3 class="text-white font-medium">Sanya & Rohan's Wedding</h3>
                            <p class="text-pink-200 text-sm">Luxury Hotel, Delhi</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="text-center mt-8">
                <button class="px-6 py-3 border border-pink-600 text-pink-600 rounded-lg hover:bg-pink-50 transition flex items-center mx-auto transform hover:scale-105">
                    View More Real Weddings
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <!-- ===== 6. Enhanced Vendor Marketplace ===== -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Complete Your Event</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">Find trusted vendors for every need</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                <!-- Vendor 1 -->
                <a href="#" class="group text-center">
                    <div class="relative mb-4 aspect-square overflow-hidden rounded-xl shadow-md hover:shadow-lg transition">
                        <img src="https://images.unsplash.com/photo-1595476108010-b4d1f102b1b1?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
                    </div>
                    <h3 class="font-bold text-gray-800 group-hover:text-pink-600 transition">Mehndi Artists</h3>
                </a>
                
                <!-- Vendor 2 -->
                <a href="#" class="group text-center">
                    <div class="relative mb-4 aspect-square overflow-hidden rounded-xl shadow-md hover:shadow-lg transition">
                        <img src="https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
                    </div>
                    <h3 class="font-bold text-gray-800 group-hover:text-pink-600 transition">Photographers</h3>
                </a>
                
                <!-- Vendor 3 -->
                <a href="#" class="group text-center">
                    <div class="relative mb-4 aspect-square overflow-hidden rounded-xl shadow-md hover:shadow-lg transition">
                        <img src="https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
                    </div>
                    <h3 class="font-bold text-gray-800 group-hover:text-pink-600 transition">Caterers</h3>
                </a>
                
                <!-- Vendor 4 -->
                <a href="#" class="group text-center">
                    <div class="relative mb-4 aspect-square overflow-hidden rounded-xl shadow-md hover:shadow-lg transition">
                        <img src="https://images.unsplash.com/photo-1519046904884-53103b34b206?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
                    </div>
                    <h3 class="font-bold text-gray-800 group-hover:text-pink-600 transition">Decorators</h3>
                </a>
                
                <!-- Vendor 5 -->
                <a href="#" class="group text-center">
                    <div class="relative mb-4 aspect-square overflow-hidden rounded-xl shadow-md hover:shadow-lg transition">
                        <img src="https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
                    </div>
                    <h3 class="font-bold text-gray-800 group-hover:text-pink-600 transition">Makeup Artists</h3>
                </a>
                
                <!-- Vendor 6 -->
                <a href="#" class="group text-center">
                    <div class="relative mb-4 aspect-square overflow-hidden rounded-xl shadow-md hover:shadow-lg transition">
                        <img src="https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
                    </div>
                    <h3 class="font-bold text-gray-800 group-hover:text-pink-600 transition">DJ & Music</h3>
                </a>
            </div>
        </div>
    </section>

    <!-- ===== 7. Enhanced CTA with Floating Elements ===== -->
    <section class="py-16 bg-gradient-to-br from-purple-900 to-pink-800 text-white relative overflow-hidden">
        <!-- Floating elements -->
        <div class="absolute top-0 left-0 w-full h-full particle-container">
            <div class="particle" style="top:30%; left:20%; animation-delay:0s;"></div>
            <div class="particle" style="top:60%; left:70%; animation-delay:1.5s;"></div>
            <div class="particle" style="top:20%; left:80%; animation-delay:2.5s;"></div>
            <div class="particle" style="top:80%; left:30%; animation-delay:3s;"></div>
        </div>
        
        <div class="container mx-auto px-4 text-center relative z-10">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Plan Your Dream Event?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Join thousands of couples who found their perfect venue with us</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <button class="px-8 py-3 bg-white text-pink-600 rounded-lg font-bold hover:bg-gray-100 transition shadow-lg transform hover:scale-105">
                    Browse Venues
                </button>
                <button class="px-8 py-3 border-2 border-white text-white rounded-lg font-bold hover:bg-white/10 transition shadow-lg transform hover:scale-105">
                    Talk to an Expert
                </button>
            </div>
            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <div class="flex items-center">
                    <div class="flex -space-x-2">
                        <img class="w-8 h-8 rounded-full border-2 border-white" src="https://randomuser.me/api/portraits/women/44.jpg" alt="User">
                        <img class="w-8 h-8 rounded-full border-2 border-white" src="https://randomuser.me/api/portraits/men/32.jpg" alt="User">
                        <img class="w-8 h-8 rounded-full border-2 border-white" src="https://randomuser.me/api/portraits/women/68.jpg" alt="User">
                    </div>
                    <span class="ml-3 text-pink-100">500+ happy couples this month</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== 8. Enhanced Blog Section ===== -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Planning Resources</h2>
                    <p class="text-gray-600">Tips, trends and inspiration for your event</p>
                </div>
                <a href="#" class="text-pink-600 hover:text-pink-700 font-medium flex items-center">
                    View All Articles
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Blog Post 1 -->
                <a href="#" class="group">
                    <div class="relative h-64 overflow-hidden rounded-xl mb-4 shadow-md hover:shadow-lg transition">
                        <img src="https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent flex items-end p-4">
                            <span class="text-white font-medium">Planning Guide</span>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-pink-600 transition">Ultimate Wedding Planning Timeline</h3>
                    <p class="text-gray-600">A complete month-by-month guide to planning your perfect wedding</p>
                    <div class="mt-3 flex items-center text-sm text-gray-500">
                        <span>5 min read</span>
                        <span class="mx-2">•</span>
                        <span>May 15, 2023</span>
                    </div>
                </a>
                
                <!-- Blog Post 2 -->
                <a href="#" class="group">
                    <div class="relative h-64 overflow-hidden rounded-xl mb-4 shadow-md hover:shadow-lg transition">
                        <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent flex items-end p-4">
                            <span class="text-white font-medium">Venue Tips</span>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-pink-600 transition">10 Questions to Ask Before Booking a Venue</h3>
                    <p class="text-gray-600">Essential checklist to ensure you choose the perfect location</p>
                    <div class="mt-3 flex items-center text-sm text-gray-500">
                        <span>7 min read</span>
                        <span class="mx-2">•</span>
                        <span>June 2, 2023</span>
                    </div>
                </a>
                
                <!-- Blog Post 3 -->
                <a href="#" class="group">
                    <div class="relative h-64 overflow-hidden rounded-xl mb-4 shadow-md hover:shadow-lg transition">
                        <img src="https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent flex items-end p-4">
                            <span class="text-white font-medium">Trends</span>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-pink-600 transition">2023 Wedding Trends You'll Love</h3>
                    <p class="text-gray-600">Discover the hottest trends in decor, food and entertainment</p>
                    <div class="mt-3 flex items-center text-sm text-gray-500">
                        <span>4 min read</span>
                        <span class="mx-2">•</span>
                        <span>April 28, 2023</span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- ===== 9. Enhanced Instagram Feed ===== -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Follow @EventVibe</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">See real events and get daily inspiration</p>
                <a href="#" class="inline-block mt-4 text-pink-600 hover:text-pink-700 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Follow Us
                </a>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-1">
                <!-- Instagram Post 1 -->
                <a href="#" class="group relative block aspect-square overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1523438885200-e635ba2c371e?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                         class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                </a>
                
                <!-- Instagram Post 2 -->
                <a href="#" class="group relative block aspect-square overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                         class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                </a>
                
                <!-- More Instagram posts... -->
            </div>
        </div>
    </section>

    <!-- ===== 10. New Testimonials Section ===== -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">What Our Clients Say</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">Hear from couples who celebrated with us</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-gray-50 p-8 rounded-xl shadow-sm hover:shadow-md transition">
                    <div class="flex items-center mb-4">
                        <div class="flex -space-x-2">
                            <img class="w-12 h-12 rounded-full border-2 border-white" src="https://randomuser.me/api/portraits/women/44.jpg" alt="User">
                        </div>
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-800">Priya Sharma</h4>
                            <p class="text-sm text-gray-600">Wedding at Grand Palace</p>
                        </div>
                    </div>
                    <div class="mb-4 flex text-yellow-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                    <p class="text-gray-600 italic">"EventVibe made our wedding planning so easy! Their team helped us find the perfect venue within our budget and handled all the details. Our day was absolutely magical!"</p>
                </div>
                
                <!-- More testimonials... -->
            </div>
        </div>
    </section>

    <!-- ===== 11. New Event Types Section ===== -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Events We Specialize In</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">From intimate gatherings to grand celebrations</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Wedding -->
                <div class="group relative overflow-hidden rounded-2xl shadow-lg h-64">
                    <div class="relative h-full w-full">
                        <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                             class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-105 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-6 w-full">
                            <h3 class="text-2xl font-bold text-white mb-2">Weddings</h3>
                            <button class="mt-2 px-4 py-2 bg-white text-pink-600 rounded-lg font-medium opacity-0 group-hover:opacity-100 transform group-hover:-translate-y-2 transition duration-500">
                                Explore
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Birthday -->
                <div class="group relative overflow-hidden rounded-2xl shadow-lg h-64">
                    <div class="relative h-full w-full">
                        <img src="https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                             class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-105 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-6 w-full">
                            <h3 class="text-2xl font-bold text-white mb-2">Birthdays</h3>
                            <button class="mt-2 px-4 py-2 bg-white text-pink-600 rounded-lg font-medium opacity-0 group-hover:opacity-100 transform group-hover:-translate-y-2 transition duration-500">
                                Explore
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Corporate -->
                <div class="group relative overflow-hidden rounded-2xl shadow-lg h-64">
                    <div class="relative h-full w-full">
                        <img src="https://images.unsplash.com/photo-1530103862676-de8c9debad1d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                             class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-105 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-6 w-full">
                            <h3 class="text-2xl font-bold text-white mb-2">Corporate Events</h3>
                            <button class="mt-2 px-4 py-2 bg-white text-pink-600 rounded-lg font-medium opacity-0 group-hover:opacity-100 transform group-hover:-translate-y-2 transition duration-500">
                                Explore
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Anniversary -->
                <div class="group relative overflow-hidden rounded-2xl shadow-lg h-64">
                    <div class="relative h-full w-full">
                        <img src="https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                             class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-105 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-6 w-full">
                            <h3 class="text-2xl font-bold text-white mb-2">Anniversaries</h3>
                            <button class="mt-2 px-4 py-2 bg-white text-pink-600 rounded-lg font-medium opacity-0 group-hover:opacity-100 transform group-hover:-translate-y-2 transition duration-500">
                                Explore
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== 12. New FAQ Section ===== -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 max-w-4xl">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Frequently Asked Questions</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">Find answers to common questions about booking venues</p>
            </div>
            
            <div class="space-y-4">
                <!-- FAQ Item 1 -->
                <div x-data="{ open: false }" class="border border-gray-200 rounded-lg overflow-hidden">
                    <button @click="open = !open" class="w-full px-6 py-4 text-left flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition">
                        <span class="font-medium text-gray-800">How far in advance should I book my venue?</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 transition-transform duration-200" :class="{ 'transform rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 py-4 text-gray-600">
                        <p>We recommend booking your venue at least 6-12 months in advance for weddings and 3-6 months for other events. Popular venues and dates get booked quickly, especially during wedding season (November-February).</p>
                    </div>
                </div>
                
                <!-- FAQ Item 2 -->
                <div x-data="{ open: false }" class="border border-gray-200 rounded-lg overflow-hidden">
                    <button @click="open = !open" class="w-full px-6 py-4 text-left flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition">
                        <span class="font-medium text-gray-800">What's included in the venue booking price?</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 transition-transform duration-200" :class="{ 'transform rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 py-4 text-gray-600">
                        <p>This varies by venue but typically includes the space rental, basic furniture (tables, chairs), and sometimes basic decor. Catering, audio-visual equipment, and other services are usually additional. Our venue listings clearly specify what's included.</p>
                    </div>
                </div>
                
                <!-- More FAQ items... -->
            </div>
            
            <div class="text-center mt-8">
                <button class="px-6 py-3 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition flex items-center mx-auto">
                    View All FAQs
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </section>
    

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Typewriter effect
        const typewriteElements = document.querySelectorAll('.typewrite');
        typewriteElements.forEach(el => {
            const texts = JSON.parse(el.getAttribute('data-text'));
            let count = 0;
            
            function typeWriter(text, i, fnCallback) {
                if (i < text.length) {
                    el.innerHTML = text.substring(0, i+1) + '<span class="border-r-2 border-white animate-pulse">|</span>';
                    setTimeout(() => typeWriter(text, i + 1, fnCallback), 100);
                } else if (typeof fnCallback == 'function') {
                    setTimeout(fnCallback, 2000);
                }
            }
            
            function startTextAnimation(i) {
                if (i >= texts.length) { i = 0; }
                typeWriter(texts[i], 0, () => {
                    setTimeout(() => startTextAnimation(i + 1), 500);
                });
            }
            
            startTextAnimation(0);
        });
        
        // Slideable category navigation
        const categoryScroller = document.querySelector('.category-scroller');
        const categoryScrollLeft = document.querySelector('.category-scroll-left');
        const categoryScrollRight = document.querySelector('.category-scroll-right');
        
        categoryScrollLeft.addEventListener('click', () => {
            categoryScroller.scrollBy({ left: -200, behavior: 'smooth' });
        });
        
        categoryScrollRight.addEventListener('click', () => {
            categoryScroller.scrollBy({ left: 200, behavior: 'smooth' });
        });
        
        // Slideable venue cards
        const venueScroller = document.querySelector('.venue-scroller');
        const venueScrollLeft = document.querySelector('.venue-scroll-left');
        const venueScrollRight = document.querySelector('.venue-scroll-right');
        
        venueScrollLeft.addEventListener('click', () => {
            venueScroller.scrollBy({ left: -300, behavior: 'smooth' });
        });
        
        venueScrollRight.addEventListener('click', () => {
            venueScroller.scrollBy({ left: 300, behavior: 'smooth' });
        });

        // Initialize Swiper
        const swiper = new Swiper('.venue-swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            grabCursor: true,
            centeredSlides: false,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                }
            }
        });
        
        // Add touch events for better mobile swipe
        let touchStartX = 0;
        let touchEndX = 0;
        
        const venueSwiper = document.querySelector('.venue-swiper');
        
        venueSwiper.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, {passive: true});
        
        venueSwiper.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, {passive: true});
        
        function handleSwipe() {
            if (touchEndX < touchStartX - 50) {
                swiper.slideNext();
            }
            if (touchEndX > touchStartX + 50) {
                swiper.slidePrev();
            }
        }
    });
</script>

<!-- Add Swiper JS -->
<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- Add custom animations -->
<style>
    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(2deg); }
    }
    
    @keyframes particle-move {
        0% { transform: translateY(0) translateX(0); opacity: 1; }
        100% { transform: translateY(-150px) translateX(30px); opacity: 0; }
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 0.05; }
        50% { opacity: 0.15; }
    }
    
    .animate-float-1 {
        animation: float 8s ease-in-out infinite;
    }
    
    .animate-float-2 {
        animation: float 10s ease-in-out infinite 2s;
    }
    
    .animate-float-3 {
        animation: float 7s ease-in-out infinite 1s;
    }
    
    .particle {
        position: absolute;
        width: 6px;
        height: 6px;
        background-color: rgba(255, 255, 255, 0.7);
        border-radius: 50%;
        animation: particle-move 6s linear infinite;
        filter: blur(1px);
    }
    
    .particle:nth-child(odd) {
        background-color: rgba(255, 192, 203, 0.9);
    }
    
    .animate-pulse {
        animation: pulse 4s ease-in-out infinite;
    }
    
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    
    .animation-delay-3000 {
        animation-delay: 3s;
    }
    
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    .snap-x {
        scroll-snap-type: x mandatory;
    }
    
    .snap-start {
        scroll-snap-align: start;
    }
    
    /* Custom scroll behavior for slideable sections */
    .category-scroller, .venue-scroller {
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
    }
    
    /* Gradient fade effect for slideable sections */
    .category-scroller::after, .venue-scroller::after {
        content: '';
        position: absolute;
        right: 0;
        top: 0;
        bottom: 0;
        width: 60px;
        background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
        pointer-events: none;
    }

    /* Custom Swiper styles */
    .venue-swiper {
        padding: 0 10px 30px;
    }
    
    .swiper-slide {
        transition: transform 0.3s ease;
    }
    
    .swiper-slide:hover {
        transform: translateY(-5px) scale(1.01);
    }
    
    .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        background-color: #d1d5db;
        opacity: 1;
    }
    
    .swiper-pagination-bullet-active {
        background-color: #ec4899;
        transform: scale(1.2);
    }
    
    .swiper-button-next,
    .swiper-button-prev {
        position: static;
        margin-top: 0;
        width: auto;
        height: auto;
        margin-left: 0.5rem;
    }
    
    .swiper-button-next::after,
    .swiper-button-prev::after {
        content: none;
    }
    
    @media (max-width: 640px) {
        .venue-swiper {
            padding: 0 5px 25px;
        }
        
        .swiper-slide {
            width: 85%;
        }
    }
</style></div>