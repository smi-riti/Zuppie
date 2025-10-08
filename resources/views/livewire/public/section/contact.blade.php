<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-purple-50">
    <!-- Contact Page -->
    <main class="min-h-screen bg-white">
        <!-- Hero Section -->
        <section class="relative h-[60vh] overflow-hidden">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0">
                <img src="{{ asset('images/contact-banner.webp') }}" 
                     alt="Contact Background" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-900/40 via-pink-800/35 to-indigo-900/40"></div>
                <div class="absolute inset-0 bg-black/10"></div>
            </div>

            <!-- Enhanced Content with Floating Elements -->
            <div class="relative z-10 flex items-center justify-center h-full text-center text-white px-4">
                <!-- Floating Background Elements -->
                <div class="absolute inset-0 overflow-hidden pointer-events-none">
                    <div class="absolute top-20 left-10 w-32 h-32 bg-white/10 rounded-full blur-3xl animate-float-slow"></div>
                    <div class="absolute bottom-20 right-10 w-24 h-24 bg-pink-300/20 rounded-full blur-2xl animate-float-delayed"></div>
                    <div class="absolute top-1/2 right-1/4 w-16 h-16 bg-purple-300/15 rounded-full blur-xl animate-float-fast"></div>
                </div>

                <div class="px-20 relative">
                   
                    <!-- Enhanced Description -->
                    <div class="mb-12 animate-fade-in-up animation-delay-300">
                        <p class="text-2xl md:text-3xl text-white/90 max-w-3xl mx-auto leading-relaxed drop-shadow-lg font-light">
                            Ready to create your <span class="font-2xl bg-gradient-to-r from-yellow-300 to-orange-300 bg-clip-text text-transparent">perfect event?</span> 
                            Let's bring your vision to life with <span class="font-2xl text-pink-200">{{ $settings['site_name'] }}</span>.
                        </p>
                        
                    </div>

                    <!-- Enhanced Button Group -->
                    <div class="space-y-6 animate-fade-in-up animation-delay-600">
                        <!-- Primary Actions -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="tel:{{ $settings['phone_no'] }}" 
                               class="group relative px-10 py-5 bg-gradient-to-r from-pink-500 via-pink-600 to-purple-600 text-white rounded-2xl font-2xl text-lg hover:from-pink-600 hover:via-pink-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 shadow-2xl hover:shadow-pink-500/25">
                                <div class="absolute inset-0 bg-gradient-to-r from-pink-400 to-purple-500 rounded-2xl blur opacity-75 group-hover:opacity-100 transition-opacity"></div>
                                <div class="relative flex items-center justify-center">
                                    <div class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center mr-3 group-hover:rotate-12 transition-transform">
                                        <i class="fas fa-phone text-sm"></i>
                                    </div>
                                    <span>Call Now</span>
                                    <div class="ml-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <i class="fas fa-arrow-right text-sm"></i>
                                    </div>
                                </div>
                            </a>

                            <a href="mailto:{{ $settings['email'] }}" 
                               class="group relative px-10 py-5 bg-white/10 backdrop-blur-xl text-white rounded-2xl font-2xl text-lg hover:bg-white/20 transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 border-2 border-white/30 hover:border-white/50 shadow-2xl">
                                <div class="flex items-center justify-center">
                                    <div class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center mr-3 group-hover:rotate-12 transition-transform">
                                        <i class="fas fa-envelope text-sm"></i>
                                    </div>
                                    <span>Email Us</span>
                                    <div class="ml-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <i class="fas fa-external-link-alt text-sm"></i>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Primary CTA Button -->
                        <div class="flex justify-center">
                            <button 
                                wire:click="$dispatch('open-enquiry-form')"
                                class="group relative px-12 py-6 bg-gradient-to-r from-purple-600 via-info-600 to-purple-600 text-white rounded-2xl font-2xl text-xl hover:from-purple-700 hover:via-info-700 hover:to-purple-700 transition-all duration-500 transform hover:scale-110 hover:-translate-y-2 shadow-2xl hover:shadow-purple-500/30 animate-pulse-border">
                                <div class="absolute inset-0 bg-gradient-to-r from-purple-400 via-info-400 to-purple-400 rounded-2xl blur-lg opacity-75 group-hover:opacity-100 transition-opacity"></div>
                                <div class="relative flex items-center justify-center">
                                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center mr-4 group-hover:rotate-180 transition-transform duration-500">
                                        <i class="fas fa-calendar-plus text-lg"></i>
                                    </div>
                                    <span class="mr-2">Get Free Consultation</span>
                                    <div class="flex space-x-1">
                                        <div class="w-2 h-2 bg-yellow-300 rounded-full animate-bounce"></div>
                                        <div class="w-2 h-2 bg-yellow-300 rounded-full animate-bounce animation-delay-100"></div>
                                        <div class="w-2 h-2 bg-yellow-300 rounded-full animate-bounce animation-delay-200"></div>
                                    </div>
                                </div>
                                <div class="absolute -inset-1 bg-gradient-to-r from-purple-600 via-pink-600 to-info-600 rounded-2xl opacity-0 group-hover:opacity-75 blur transition-opacity duration-300"></div>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Information & Form Section -->
        <section class="lg:px-20 p-6 py-20 bg-gradient-to-br from-purple-50 to-pink-50">
            <div class="">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-2xl gradient-text mb-6">Contact Information</h2>
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
                                    <h3 class="text-2xl font-2xl text-gray-800 mb-2">Call Us</h3>
                                    <a href="tel:{{ $settings['phone_no'] }}" 
                                       class="text-lg text-green-600 hover:text-green-700 font-2xl transition-colors">
                                        {{ $settings['phone_no'] }}
                                    </a>
                                    <p class="text-gray-600 mt-1">{{ $settings['business_hours'] ?? 'Mon-Sat: 9AM-6PM' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Email Card -->
                        <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="flex items-center space-x-6">
                                <div class="w-16 h-16 bg-gradient-to-r from-info-400 to-info-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-envelope text-white text-2xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-2xl text-gray-800 mb-2">Email Us</h3>
                                    <a href="mailto:{{ $settings['email'] }}" 
                                       class="text-lg text-info-600 hover:text-info-700 font-2xl transition-colors">
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
                                    <h3 class="text-2xl font-2xl text-gray-800 mb-2">Visit Us</h3>
                                    <a href="https://maps.app.goo.gl/LdRMDfhWhcWTxKwL8" 
                                       target="_blank"
                                       class="text-lg text-purple-600 hover:text-purple-700 font-2xl transition-colors">
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
                                    <h3 class="text-2xl font-2xl text-gray-800 mb-2">WhatsApp</h3>
                                    <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $settings['phone_no']) }}" 
                                       target="_blank"
                                       class="text-lg text-green-600 hover:text-green-700 font-2xl transition-colors">
                                        {{ $settings['phone_no'] }}
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
                            <h3 class="text-2xl font-2xl text-gray-800 mb-4">Find Us Here</h3>
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
                               class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 rounded-lg font-2xl hover:from-purple-700 hover:to-pink-700 transition-all flex items-center justify-center">
                                <i class="fas fa-external-link-alt mr-2"></i>
                                Open in Google Maps
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Social Media & Additional Contact -->
        <section class="lg:px-20 p-6 py-20 bg-white">
            <div class="text-center">
                <h2 class="text-4xl font-2xl gradient-text mb-12">Follow Us & Connect</h2>
                
                <div class="flex flex-wrap justify-center gap-6 mb-12">
                    @if($settings['instagram_link'])
                    <a href="{{ $settings['instagram_link'] }}" 
                       target="_blank"
                       class="group flex items-center space-x-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white px-8 py-4 rounded-full font-2xl hover:from-pink-600 hover:to-purple-700 transition-all transform hover:scale-105 shadow-lg">
                        <i class="fab fa-instagram text-2xl group-hover:scale-110 transition-transform"></i>
                        <span>Instagram</span>
                    </a>
                    @endif

                    @if($settings['facebook_link'])
                    <a href="{{ $settings['facebook_link'] }}" 
                       target="_blank"
                       class="group flex items-center space-x-3 bg-gradient-to-r from-info-600 to-info-700 text-white px-8 py-4 rounded-full font-2xl hover:from-info-700 hover:to-info-800 transition-all transform hover:scale-105 shadow-lg">
                        <i class="fab fa-facebook-f text-2xl group-hover:scale-110 transition-transform"></i>
                        <span>Facebook</span>
                    </a>
                    @endif

                    @if($settings['youtube_link'])
                    <a href="{{ $settings['youtube_link'] }}" 
                       target="_blank"
                       class="group flex items-center space-x-3 bg-gradient-to-r from-red-600 to-red-700 text-white px-8 py-4 rounded-full font-2xl hover:from-red-700 hover:to-red-800 transition-all transform hover:scale-105 shadow-lg">
                        <i class="fab fa-youtube text-2xl group-hover:scale-110 transition-transform"></i>
                        <span>YouTube</span>
                    </a>
                    @endif

                    @if($settings['twitter_link'])
                    <a href="{{ $settings['twitter_link'] }}" 
                       target="_blank"
                       class="group flex items-center space-x-3 bg-gradient-to-r from-sky-500 to-sky-600 text-white px-8 py-4 rounded-full font-2xl hover:from-sky-600 hover:to-sky-700 transition-all transform hover:scale-105 shadow-lg">
                        <i class="fab fa-twitter text-2xl group-hover:scale-110 transition-transform"></i>
                        <span>Twitter</span>
                    </a>
                    @endif

                    @if($settings['linkedin_link'])
                    <a href="{{ $settings['linkedin_link'] }}" 
                       target="_blank"
                       class="group flex items-center space-x-3 bg-gradient-to-r from-info-700 to-info-800 text-white px-8 py-4 rounded-full font-2xl hover:from-info-800 hover:to-info-900 transition-all transform hover:scale-105 shadow-lg">
                        <i class="fab fa-linkedin-in text-2xl group-hover:scale-110 transition-transform"></i>
                        <span>LinkedIn</span>
                    </a>
                    @endif
                </div>

                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-8 max-w-4xl mx-auto">
                    <h3 class="text-2xl font-2xl text-gray-800 mb-4">Ready to Plan Your Event?</h3>
                    <p class="text-gray-600 mb-6">Get in touch with our expert event planners and let's create something magical together.</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <button 
                            wire:click="$dispatch('open-enquiry-form')"
                            class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-8 py-4 rounded-full font-2xl text-lg hover:from-purple-700 hover:to-pink-700 transition-all transform hover:scale-105 shadow-lg flex items-center justify-center">
                            <i class="fas fa-calendar-plus mr-2"></i>
                            Get Free Consultation
                        </button>
                        <a href="tel:{{ $settings['phone_no'] }}" 
                           class="border-2 border-purple-600 text-purple-600 px-8 py-4 rounded-full font-2xl text-lg hover:bg-purple-600 hover:text-white transition-all transform hover:scale-105 flex items-center justify-center">
                            <i class="fas fa-phone mr-2"></i>
                            Call Now
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <style>
        /* Enhanced Sparkle Text Animation */
        .sparkle-text {
            position: relative;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4, #feca57, #ff9ff3, #54a0ff);
            background-size: 400% 400%;
            animation: sparkle-gradient 4s ease infinite;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: drop-shadow(0 0 30px rgba(255, 255, 255, 0.5));
        }

        @keyframes sparkle-gradient {
            0% { background-position: 0% 50%; }
            25% { background-position: 100% 50%; }
            50% { background-position: 100% 100%; }
            75% { background-position: 0% 100%; }
            100% { background-position: 0% 50%; }
        }

        /* Enhanced Gradient Text */
        .gradient-text {
            background: linear-gradient(45deg, #8B5CF6, #EC4899, #F59E0B, #10B981);
            background-size: 300% 300%;
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

        /* Floating Animations */
        .animate-float-slow {
            animation: float-slow 6s ease-in-out infinite;
        }

        .animate-float-delayed {
            animation: float-delayed 4s ease-in-out infinite;
        }

        .animate-float-fast {
            animation: float-fast 3s ease-in-out infinite;
        }

        @keyframes float-slow {
            0%, 100% { transform: translateY(0px) translateX(0px); }
            25% { transform: translateY(-20px) translateX(10px); }
            50% { transform: translateY(-10px) translateX(-15px); }
            75% { transform: translateY(-25px) translateX(5px); }
        }

        @keyframes float-delayed {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-15px) rotate(120deg); }
            66% { transform: translateY(-25px) rotate(240deg); }
        }

        @keyframes float-fast {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(-30px) scale(1.1); }
        }

        /* Fade In Up Animation */
        .animate-fade-in-up {
            animation: fade-in-up 1s ease-out forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        @keyframes fade-in-up {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Animation Delays */
        .animation-delay-100 { animation-delay: 0.1s; }
        .animation-delay-200 { animation-delay: 0.2s; }
        .animation-delay-300 { animation-delay: 0.3s; }
        .animation-delay-600 { animation-delay: 0.6s; }

        /* Pulse Glow Effect */
        .animate-pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }

        @keyframes pulse-glow {
            0%, 100% {
                box-shadow: 0 0 20px rgba(236, 72, 153, 0.5);
                transform: scaleX(1);
            }
            50% {
                box-shadow: 0 0 40px rgba(236, 72, 153, 0.8), 0 0 60px rgba(139, 92, 246, 0.6);
                transform: scaleX(1.1);
            }
        }

        /* Pulse Border Animation */
        .animate-pulse-border {
            position: relative;
        }

        .animate-pulse-border::before {
            content: '';
            position: absolute;
            inset: -3px;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4, #feca57);
            background-size: 400% 400%;
            border-radius: 1rem;
            z-index: -1;
            animation: border-pulse 3s ease infinite;
            opacity: 0.7;
        }

        @keyframes border-pulse {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        /* Enhanced Button Hover Effects */
        .group:hover .group-hover\:rotate-12 {
            transform: rotate(12deg);
        }

        .group:hover .group-hover\:rotate-180 {
            transform: rotate(180deg);
        }

        /* Enhanced Shadows */
        .shadow-2xl {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .hover\:shadow-pink-500\/25:hover {
            box-shadow: 0 25px 50px -12px rgba(236, 72, 153, 0.25);
        }

        .hover\:shadow-purple-500\/30:hover {
            box-shadow: 0 25px 50px -12px rgba(139, 92, 246, 0.3);
        }

        /* Backdrop Blur Enhancement */
        .backdrop-blur-xl {
            backdrop-filter: blur(24px);
        }

        /* Custom Scrollbar for smooth experience */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #8B5CF6, #EC4899);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #7C3AED, #DB2777);
        }

        /* Responsive Enhancements */
        @media (max-width: 640px) {
            .sparkle-text {
                font-size: 3rem;
            }
            
            .animate-fade-in-up {
                animation-duration: 0.8s;
            }
        }
    </style>

    <!-- form modal -->
    <livewire:public.section.enquiry-form />
    <livewire:public.components.bottom-navigation />
</div>
