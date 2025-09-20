<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-purple-50">
    <!-- About Page -->
    <main class="min-h-screen bg-white">
        <!-- Hero Section -->
        <section class="relative h-[70vh] overflow-hidden">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0">
                <img src="{{ asset('images/banner.webp')}}" 
                     alt="About Us Background" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-900/40 via-pink-800/35 to-indigo-900/40"></div>
                <div class="absolute inset-0 bg-black/15"></div>
            </div>

            <!-- Content -->
            <div class="relative z-10 flex items-center justify-center h-full text-center text-white px-4">
                <div class="max-w-5xl mx-auto">
                    <h1 class="text-5xl md:text-7xl font-2xl mb-6 sparkle-text drop-shadow-2xl">About {{ $settings['site_name'] }}</h1>
                    <p class="text-xl md:text-2xl text-purple-100 max-w-3xl mx-auto leading-relaxed drop-shadow-lg">
                        {{ $settings['site_description'] ?? 'Creating unforgettable moments through exceptional event planning and coordination.' }}
                    </p>
                    <div class="mt-8">
                        <button 
                            wire:click="$dispatch('open-enquiry-form')"
                            class="px-8 py-4 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-full font-2xl text-lg hover:from-pink-600 hover:to-purple-700 transition-all transform hover:scale-105 shadow-lg">
                            <i class="fas fa-calendar-plus mr-2"></i>Plan Your Event
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Story Section -->
        <section class="lg:px-20 p-6 py-20 bg-gradient-to-br from-purple-50 to-pink-50">
            <div class="">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div class="space-y-6">
                        <h2 class="text-4xl md:text-5xl font-2xl font-display gradient-text mb-6">
                            Our Story
                        </h2>
                        <p class="text-lg text-gray-700 leading-relaxed">
                            Founded in 2015 by a passionate team of event enthusiasts, Zuppie began with a simple dream: 
                            to make every celebration magical. What started as a small team of friends organizing birthday 
                            parties has grown into a premier event management company.
                        </p>
                        <p class="text-lg text-gray-700 leading-relaxed">
                            Our journey has been filled with countless smiles, tears of joy, and moments that take your 
                            breath away. We believe that every event, no matter how big or small, deserves the magic 
                            touch that makes it truly unforgettable.
                        </p>
                        <p class="text-lg text-gray-700 leading-relaxed">
                            Today, we've had the privilege of creating over 500 magical events, building relationships 
                            with amazing clients, and becoming part of their most precious memories.
                        </p>
                        
                        <!-- Stats -->
                        <div class="grid grid-cols-2 gap-6 pt-8">
                            <div class="text-center">
                                <div class="text-4xl font-2xl gradient-text mb-2">500+</div>
                                <div class="text-gray-600">Events Created</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl font-2xl gradient-text mb-2">8</div>
                                <div class="text-gray-600">Years Experience</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl transform hover:scale-105 transition-transform duration-500 w-3/3 mx-auto">
                            <img src="{{ asset('images/Gemini_Generated_Image_b2vgmeb2vgmeb2vg.png') }}" alt="Our Team" class="object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Mission & Vision -->
        <section class="lg:px-20 p-6 bg-white">
            <div class="">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-2xl font-display gradient-text mb-6">
                        Mission & Vision
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Driven by passion, guided by purpose
                    </p>
                </div>
                
                <div class="grid md:grid-cols-2 gap-16">
                    <!-- Mission -->
                    <div class="relative bg-gradient-to-br from-purple-100 to-pink-100 rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300">
                        <div class="absolute -top-4 left-8 w-16 h-16 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-heart text-white text-2xl"></i>
                        </div>
                        <div class="pt-8">
                            <h3 class="text-2xl font-2xl text-gray-800 mb-4">Our Mission</h3>
                            <p class="text-gray-700 leading-relaxed">
                                To create extraordinary experiences that bring people together, celebrate life's precious 
                                moments, and leave lasting memories. We strive to exceed expectations through innovative 
                                design, meticulous planning, and heartfelt service.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Vision -->
                    <div class="relative bg-gradient-to-br from-pink-100 to-purple-100 rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300">
                        <div class="absolute -top-4 left-8 w-16 h-16 bg-gradient-to-r from-pink-600 to-purple-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-star text-white text-2xl"></i>
                        </div>
                        <div class="pt-8">
                            <h3 class="text-2xl font-2xl text-gray-800 mb-4">Our Vision</h3>
                            <p class="text-gray-700 leading-relaxed">
                                To be the leading event management company that transforms ordinary celebrations into 
                                magical experiences. We envision a world where every special moment is celebrated with 
                                joy, creativity, and wonder.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Values -->
        <section class="lg:px-20 p-6 py-20 bg-gradient-to-br from-purple-50 to-pink-50">
            <div class="">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-2xl font-display gradient-text mb-6">
                        Our Values
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        The principles that guide everything we do
                    </p>
                </div>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Excellence -->
                    <div class="text-center group hover:scale-105 transition-transform duration-300">
                        <div class="w-20 h-20 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:shadow-lg transition-shadow duration-300">
                            <i class="fas fa-crown text-white text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-2xl text-gray-800 mb-4">Excellence</h3>
                        <p class="text-gray-600">We pursue perfection in every detail, ensuring your event exceeds expectations.</p>
                    </div>
                    
                    <!-- Creativity -->
                    <div class="text-center group hover:scale-105 transition-transform duration-300">
                        <div class="w-20 h-20 bg-gradient-to-r from-pink-600 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:shadow-lg transition-shadow duration-300">
                            <i class="fas fa-palette text-white text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-2xl text-gray-800 mb-4">Creativity</h3>
                        <p class="text-gray-600">Innovation and imagination drive us to create unique, memorable experiences.</p>
                    </div>
                    
                    <!-- Integrity -->
                    <div class="text-center group hover:scale-105 transition-transform duration-300">
                        <div class="w-20 h-20 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:shadow-lg transition-shadow duration-300">
                            <i class="fas fa-handshake text-white text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-2xl text-gray-800 mb-4">Integrity</h3>
                        <p class="text-gray-600">Honest communication and transparent practices build lasting relationships.</p>
                    </div>
                    
                    <!-- Passion -->
                    <div class="text-center group hover:scale-105 transition-transform duration-300">
                        <div class="w-20 h-20 bg-gradient-to-r from-pink-600 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:shadow-lg transition-shadow duration-300">
                            <i class="fas fa-fire text-white text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-2xl text-gray-800 mb-4">Passion</h3>
                        <p class="text-gray-600">Our love for what we do shines through in every event we create.</p>
                    </div>
                    
                    <!-- Collaboration -->
                    <div class="text-center group hover:scale-105 transition-transform duration-300">
                        <div class="w-20 h-20 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:shadow-lg transition-shadow duration-300">
                            <i class="fas fa-users text-white text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-2xl text-gray-800 mb-4">Collaboration</h3>
                        <p class="text-gray-600">Working together with clients and partners to achieve extraordinary results.</p>
                    </div>
                    
                    <!-- Innovation -->
                    <div class="text-center group hover:scale-105 transition-transform duration-300">
                        <div class="w-20 h-20 bg-gradient-to-r from-pink-600 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:shadow-lg transition-shadow duration-300">
                            <i class="fas fa-lightbulb text-white text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-2xl text-gray-800 mb-4">Innovation</h3>
                        <p class="text-gray-600">Embracing new ideas and technologies to enhance our event experiences.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Meet Our Team -->
        <section class="lg:px-20 p-6 py-20 bg-white">
            <div class="">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-2xl font-display gradient-text mb-6">
                        Meet Our Amazing Team
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        The passionate people behind the magic
                    </p>
                </div>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Team Member 1 -->
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=400&h=400&fit=crop&crop=face" alt="Sarah Johnson" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <div class="p-6 text-center">
                            <h3 class="text-xl font-2xl text-gray-800 mb-2">Sarah Johnson</h3>
                            <p class="text-purple-600 font-2xl mb-3">Founder & Creative Director</p>
                            <p class="text-gray-600 text-sm">Passionate about creating magical moments that last a lifetime.</p>
                        </div>
                    </div>
                    
                    <!-- Team Member 2 -->
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop&crop=face" alt="Michael Chen" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <div class="p-6 text-center">
                            <h3 class="text-xl font-2xl text-gray-800 mb-2">Michael Chen</h3>
                            <p class="text-purple-600 font-2xl mb-3">Event Operations Manager</p>
                            <p class="text-gray-600 text-sm">Ensures every detail is perfectly executed with precision and care.</p>
                        </div>
                    </div>
                    
                    <!-- Team Member 3 -->
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&h=400&fit=crop&crop=face" alt="Emily Rodriguez" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <div class="p-6 text-center">
                            <h3 class="text-xl font-2xl text-gray-800 mb-2">Emily Rodriguez</h3>
                            <p class="text-purple-600 font-2xl mb-3">Design Specialist</p>
                            <p class="text-gray-600 text-sm">Brings creative visions to life with stunning visual designs.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="lg:px-20 p-6 py-20 bg-white">
            <div class=" text-center">
                <div class="">
                    <h2 class="text-4xl md:text-5xl font-2xl font-display gradient-text mb-6">
                        Ready to Create Magic Together?
                    </h2>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Let's bring your vision to life and create an unforgettable experience that you and your guests will treasure forever.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <a href="{{route('contact')}}" wire:navigate class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-8 py-4 rounded-full font-2xl text-lg hover:shadow-lg hover:scale-105 transition-all duration-300 flex items-center space-x-2">
                            <i class="fas fa-calendar-plus"></i>
                            <span>Start Planning</span>
                        </a>
                        <a href="/event-packages" wire:navigate class="border-2  border-purple-600 text-purple-600 px-8 py-4 rounded-full font-2xl text-lg hover:bg-purple-600 hover:text-white transition-all duration-300 flex items-center space-x-2">
                            <i class="fas fa-eye"></i>
                            <span>View Packages</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
  
    <livewire:public.section.enquiry-form />
    <livewire:public.components.bottom-navigation />

<style>
    /* Sparkle Text Animation */
    .sparkle-text {
        position: relative;
        background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4, #feca57);
        background-size: 300% 300%;
        animation: sparkle-gradient 3s ease infinite;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    @keyframes sparkle-gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Sparkle Float Animation */
    .sparkle-float {
        animation: sparkle-float 3s ease-in-out infinite;
    }

    @keyframes sparkle-float {
        0%, 100% { transform: translateY(0px) scale(1); opacity: 0.7; }
        50% { transform: translateY(-15px) scale(1.2); opacity: 1; }
    }

    /* Gradient Text */
    .gradient-text {
        background: linear-gradient(45deg, #8B5CF6, #EC4899, #F59E0B);
        background-size: 200% 200%;
        animation: gradient-shift 3s ease infinite;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    @keyframes gradient-shift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Enhanced Animations */
    @keyframes bounce-slow {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    @keyframes pulse-slow {
        0%, 100% { opacity: 0.8; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.1); }
    }

    .animate-bounce-slow {
        animation: bounce-slow 3s ease-in-out infinite;
    }

    .animate-pulse-slow {
        animation: pulse-slow 4s ease-in-out infinite;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all sections
        document.querySelectorAll('section').forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';
            section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(section);
        });

        // Add parallax effect
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const parallax = document.querySelector('.sparkle-float');
            if (parallax) {
                const speed = scrolled * 0.5;
                parallax.style.transform = `translateY(${speed}px)`;
            }
        });
    });
</script>
</div>