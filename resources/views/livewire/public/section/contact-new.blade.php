<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-purple-50">
    <!-- Contact Page -->
    <main class="min-h-screen bg-white">
        <!-- Hero Section -->
        <section class="relative h-[60vh] overflow-hidden">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80" 
                     alt="Contact Background" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-900/40 via-pink-800/35 to-indigo-900/40"></div>
                <div class="absolute inset-0 bg-black/10"></div>
            </div>

            <!-- Content -->
            <div class="relative z-10 flex items-center justify-center h-full text-center text-white px-4">
                <div class="max-w-4xl mx-auto">
                    <h1 class="text-5xl md:text-7xl font-bold mb-6 sparkle-text drop-shadow-2xl">Get In Touch</h1>
                    <p class="text-xl md:text-2xl text-purple-100 max-w-2xl mx-auto leading-relaxed drop-shadow-lg">
                        Ready to create your perfect event? Let's bring your vision to life with {{ $settings['site_name'] }}.
                    </p>
                    <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="tel:{{ $settings['phone_no'] }}" 
                           class="px-8 py-4 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-full font-bold text-lg hover:from-pink-600 hover:to-purple-700 transition-all transform hover:scale-105 shadow-lg">
                            <i class="fas fa-phone mr-2"></i>Call Now
                        </a>
                        <a href="mailto:{{ $settings['email'] }}" 
                           class="px-8 py-4 bg-white/20 backdrop-blur-sm text-white rounded-full font-bold text-lg hover:bg-white/30 transition-all transform hover:scale-105 border border-white/30">
                            <i class="fas fa-envelope mr-2"></i>Email Us
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Information & Form Section -->
        <section class="py-20 bg-gradient-to-br from-purple-50 to-pink-50">
            <div class="container mx-auto px-4 max-w-7xl">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold gradient-text mb-6">Contact Information</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">{{ $settings['site_description'] }}</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Contact Info Cards -->
                    <div class="space-y-8">
                        <!-- Phone Card -->
                        <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="flex items-center space-x-6">
                                <div class="w-16 h-16 bg-gradient-to-r from-green-400 to-green-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-phone text-white text-2xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Call Us</h3>
                                    <a href="tel:{{ $settings['phone_no'] }}" 
                                       class="text-lg text-green-600 hover:text-green-700 font-semibold transition-colors">
                                        {{ $settings['phone_no'] }}
                                    </a>
                                    <p class="text-gray-600 mt-1">{{ $settings['business_hours'] ?? 'Mon-Sat: 9AM-6PM' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Email Card -->
                        <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="flex items-center space-x-6">
                                <div class="w-16 h-16 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-envelope text-white text-2xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Email Us</h3>
                                    <a href="mailto:{{ $settings['email'] }}" 
                                       class="text-lg text-blue-600 hover:text-blue-700 font-semibold transition-colors">
                                        {{ $settings['email'] }}
                                    </a>
                                    <p class="text-gray-600 mt-1">We'll respond within 24 hours</p>
                                </div>
                            </div>
                        </div>

                        <!-- Address Card -->
                        <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="flex items-center space-x-6">
                                <div class="w-16 h-16 bg-gradient-to-r from-purple-400 to-purple-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Visit Us</h3>
                                    <a href="https://maps.app.goo.gl/LdRMDfhWhcWTxKwL8" 
                                       target="_blank"
                                       class="text-lg text-purple-600 hover:text-purple-700 font-semibold transition-colors">
                                        {{ $settings['address'] }}
                                    </a>
                                    <p class="text-gray-600 mt-1">Click to open in Maps</p>
                                </div>
                            </div>
                        </div>

                        <!-- WhatsApp Card -->
                        @if($settings['whatsapp_number'])
                        <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="flex items-center space-x-6">
                                <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center">
                                    <i class="fab fa-whatsapp text-white text-2xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-800 mb-2">WhatsApp</h3>
                                    <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $settings['whatsapp_number']) }}" 
                                       target="_blank"
                                       class="text-lg text-green-600 hover:text-green-700 font-semibold transition-colors">
                                        {{ $settings['whatsapp_number'] }}
                                    </a>
                                    <p class="text-gray-600 mt-1">Chat with us instantly</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Map Section -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">Find Us Here</h3>
                        </div>
                        <div class="h-96">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3562.8066992!2d87.4533911!3d25.7833337!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39effba9476d5c8b%3A0x592155a546353642!2sHappy%20Birthday(Cake-%20Decoration-%20Gifts-Event)!5e0!3m2!1sen!2sin!4v1642668739123!5m2!1sen!2sin"
                                width="100%" 
                                height="100%" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade"
                                class="rounded-b-2xl">
                            </iframe>
                        </div>
                        <div class="p-6 bg-gray-50">
                            <a href="https://maps.app.goo.gl/LdRMDfhWhcWTxKwL8" 
                               target="_blank"
                               class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 rounded-lg font-semibold hover:from-purple-700 hover:to-pink-700 transition-all flex items-center justify-center">
                                <i class="fas fa-external-link-alt mr-2"></i>
                                Open in Google Maps
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Social Media & Additional Contact -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-4xl font-bold gradient-text mb-12">Follow Us & Connect</h2>
                
                <div class="flex flex-wrap justify-center gap-6 mb-12">
                    @if($settings['instagram_link'])
                    <a href="{{ $settings['instagram_link'] }}" 
                       target="_blank"
                       class="group flex items-center space-x-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white px-8 py-4 rounded-full font-semibold hover:from-pink-600 hover:to-purple-700 transition-all transform hover:scale-105 shadow-lg">
                        <i class="fab fa-instagram text-2xl group-hover:scale-110 transition-transform"></i>
                        <span>Instagram</span>
                    </a>
                    @endif

                    @if($settings['facebook_link'])
                    <a href="{{ $settings['facebook_link'] }}" 
                       target="_blank"
                       class="group flex items-center space-x-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-4 rounded-full font-semibold hover:from-blue-700 hover:to-blue-800 transition-all transform hover:scale-105 shadow-lg">
                        <i class="fab fa-facebook-f text-2xl group-hover:scale-110 transition-transform"></i>
                        <span>Facebook</span>
                    </a>
                    @endif

                    @if($settings['youtube_link'])
                    <a href="{{ $settings['youtube_link'] }}" 
                       target="_blank"
                       class="group flex items-center space-x-3 bg-gradient-to-r from-red-600 to-red-700 text-white px-8 py-4 rounded-full font-semibold hover:from-red-700 hover:to-red-800 transition-all transform hover:scale-105 shadow-lg">
                        <i class="fab fa-youtube text-2xl group-hover:scale-110 transition-transform"></i>
                        <span>YouTube</span>
                    </a>
                    @endif

                    @if($settings['twitter_link'])
                    <a href="{{ $settings['twitter_link'] }}" 
                       target="_blank"
                       class="group flex items-center space-x-3 bg-gradient-to-r from-sky-500 to-sky-600 text-white px-8 py-4 rounded-full font-semibold hover:from-sky-600 hover:to-sky-700 transition-all transform hover:scale-105 shadow-lg">
                        <i class="fab fa-twitter text-2xl group-hover:scale-110 transition-transform"></i>
                        <span>Twitter</span>
                    </a>
                    @endif

                    @if($settings['linkedin_link'])
                    <a href="{{ $settings['linkedin_link'] }}" 
                       target="_blank"
                       class="group flex items-center space-x-3 bg-gradient-to-r from-blue-700 to-blue-800 text-white px-8 py-4 rounded-full font-semibold hover:from-blue-800 hover:to-blue-900 transition-all transform hover:scale-105 shadow-lg">
                        <i class="fab fa-linkedin-in text-2xl group-hover:scale-110 transition-transform"></i>
                        <span>LinkedIn</span>
                    </a>
                    @endif
                </div>

                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-8 max-w-4xl mx-auto">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Ready to Plan Your Event?</h3>
                    <p class="text-gray-600 mb-6">Get in touch with our expert event planners and let's create something magical together.</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <button 
                            wire:click="$dispatch('open-enquiry-form')"
                            class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-8 py-4 rounded-full font-bold text-lg hover:from-purple-700 hover:to-pink-700 transition-all transform hover:scale-105 shadow-lg flex items-center justify-center">
                            <i class="fas fa-calendar-plus mr-2"></i>
                            Get Free Consultation
                        </button>
                        <a href="tel:{{ $settings['phone_no'] }}" 
                           class="border-2 border-purple-600 text-purple-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-purple-600 hover:text-white transition-all transform hover:scale-105 flex items-center justify-center">
                            <i class="fas fa-phone mr-2"></i>
                            Call Now
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

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
    </style>

    <!-- form modal -->
    <livewire:public.section.enquiry-form />
    <livewire:public.components.bottom-navigation />
</div>
