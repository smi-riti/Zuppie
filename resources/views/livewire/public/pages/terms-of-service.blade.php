<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-purple-50">
    <!-- Terms of Service Page -->
    <main class="min-h-screen bg-white">
        <!-- Hero Section -->
        <section class="relative h-[50vh] overflow-hidden">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80" 
                     alt="Terms of Service Background" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-900/45 to-pink-800/45"></div>
            </div>

            <!-- Content -->
            <div class="relative z-10 flex items-center justify-center h-full text-center text-white px-4">
                <div class="max-w-4xl mx-auto">
                    <h1 class="text-4xl md:text-6xl font-bold mb-6 sparkle-text drop-shadow-2xl">Terms of Service</h1>
                    <p class="text-xl md:text-2xl text-purple-100 max-w-2xl mx-auto leading-relaxed drop-shadow-lg">
                        Our terms and conditions for using {{ $settings['site_name'] }} services
                    </p>
                </div>
            </div>
        </section>

        <!-- Terms Content -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4 max-w-4xl">
                <div class="prose prose-lg max-w-none">
                    <!-- Last Updated -->
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg p-6 mb-8">
                        <p class="text-sm text-gray-600 mb-0">
                            <strong>Last Updated:</strong> {{ $settings['last_updated_date'] ?? date('F j, Y') }}
                        </p>
                    </div>

                    <!-- Introduction -->
                    <h2 class="text-3xl font-bold gradient-text mb-6">1. Introduction</h2>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        Welcome to {{ $settings['site_name'] }}. These Terms of Service ("Terms") govern your use of our event planning and management services. By engaging our services, you agree to be bound by these Terms.
                    </p>

                    <!-- Services -->
                    <h2 class="text-3xl font-bold gradient-text mb-6">2. Our Services</h2>
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <p class="text-gray-700 mb-4 leading-relaxed">
                            {{ $settings['site_name'] }} provides comprehensive event planning and management services including:
                        </p>
                        <ul class="list-disc list-inside text-gray-700 space-y-2">
                            <li>Event concept development and planning</li>
                            <li>Venue selection and booking</li>
                            <li>Vendor coordination and management</li>
                            <li>Event day coordination and supervision</li>
                            <li>Photography and videography services</li>
                            <li>Catering and entertainment arrangements</li>
                        </ul>
                    </div>

                    <!-- Booking and Payments -->
                    <h2 class="text-3xl font-bold gradient-text mb-6">3. Booking and Payments</h2>
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-purple-50 rounded-lg p-6">
                            <h3 class="text-xl font-bold text-purple-800 mb-3">Booking Process</h3>
                            <ul class="text-gray-700 space-y-2 text-sm">
                                <li>• Initial consultation and proposal</li>
                                <li>• Contract signing and deposit payment</li>
                                <li>• Planning phase with regular updates</li>
                                <li>• Final payment before event date</li>
                            </ul>
                        </div>
                        <div class="bg-pink-50 rounded-lg p-6">
                            <h3 class="text-xl font-bold text-pink-800 mb-3">Payment Terms</h3>
                            <ul class="text-gray-700 space-y-2 text-sm">
                                <li>• 50% deposit required to secure booking</li>
                                <li>• Balance due 7 days before event</li>
                                <li>• Payment methods: Bank transfer, UPI, Card</li>
                                <li>• Late payment fees may apply</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Cancellation Policy -->
                    <h2 class="text-3xl font-bold gradient-text mb-6">4. Cancellation and Refund Policy</h2>
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 mb-6">
                        <h3 class="text-lg font-bold text-yellow-800 mb-3">Cancellation by Client:</h3>
                        <ul class="text-gray-700 space-y-2">
                            <li><strong>More than 30 days:</strong> 75% refund of deposit</li>
                            <li><strong>15-30 days:</strong> 50% refund of deposit</li>
                            <li><strong>Less than 15 days:</strong> No refund</li>
                            <li><strong>Force majeure events:</strong> Case-by-case consideration</li>
                        </ul>
                    </div>

                    <!-- Client Responsibilities -->
                    <h2 class="text-3xl font-bold gradient-text mb-6">5. Client Responsibilities</h2>
                    <p class="text-gray-700 mb-4 leading-relaxed">As our client, you agree to:</p>
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <ul class="list-disc list-inside text-gray-700 space-y-2">
                            <li>Provide accurate information and requirements</li>
                            <li>Make timely decisions and payments</li>
                            <li>Obtain necessary permits and approvals</li>
                            <li>Respect vendor policies and venue rules</li>
                            <li>Maintain open communication throughout planning</li>
                            <li>Hold {{ $settings['site_name'] }} harmless from guest behavior</li>
                        </ul>
                    </div>

                    <!-- Liability Limitations -->
                    <h2 class="text-3xl font-bold gradient-text mb-6">6. Liability and Insurance</h2>
                    <div class="bg-red-50 border border-red-200 rounded-lg p-6 mb-6">
                        <p class="text-gray-700 mb-4 leading-relaxed">
                            {{ $settings['site_name'] }} maintains professional liability insurance. However, our liability is limited to the total amount paid for our services. We are not responsible for:
                        </p>
                        <ul class="list-disc list-inside text-gray-700 space-y-2">
                            <li>Acts of nature, weather conditions, or force majeure events</li>
                            <li>Vendor failures or third-party service issues</li>
                            <li>Guest injuries or property damage</li>
                            <li>Personal belongings or valuables</li>
                        </ul>
                    </div>

                    <!-- Intellectual Property -->
                    <h2 class="text-3xl font-bold gradient-text mb-6">7. Intellectual Property</h2>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        All event concepts, designs, and materials created by {{ $settings['site_name'] }} remain our intellectual property. You grant us permission to use photos and videos of your event for marketing purposes unless explicitly requested otherwise.
                    </p>

                    <!-- Privacy and Confidentiality -->
                    <h2 class="text-3xl font-bold gradient-text mb-6">8. Privacy and Confidentiality</h2>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        We respect your privacy and maintain confidentiality of all personal information. Please refer to our <a href="/privacy-policy" class="text-purple-600 hover:text-purple-700 underline">Privacy Policy</a> for detailed information about data handling.
                    </p>

                    <!-- Modifications -->
                    <h2 class="text-3xl font-bold gradient-text mb-6">9. Terms Modification</h2>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        {{ $settings['site_name'] }} reserves the right to modify these Terms at any time. Changes will be effective immediately upon posting on our website. Continued use of our services constitutes acceptance of modified Terms.
                    </p>

                    <!-- Governing Law -->
                    <h2 class="text-3xl font-bold gradient-text mb-6">10. Governing Law</h2>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        These Terms are governed by the laws of India. Any disputes will be subject to the jurisdiction of courts in Purnia, Bihar.
                    </p>

                    <!-- Contact Information -->
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-8 mt-12">
                        <h2 class="text-3xl font-bold gradient-text mb-6">Contact Us</h2>
                        <p class="text-gray-700 mb-6 leading-relaxed">
                            If you have any questions about these Terms of Service, please contact us:
                        </p>
                        <div class="grid md:grid-cols-3 gap-6">
                            <div class="text-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-envelope text-white"></i>
                                </div>
                                <h3 class="font-bold text-gray-800 mb-1">Email</h3>
                                <a href="mailto:{{ $settings['email'] }}" class="text-purple-600 hover:text-purple-700">
                                    {{ $settings['email'] }}
                                </a>
                            </div>
                            <div class="text-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-pink-600 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-phone text-white"></i>
                                </div>
                                <h3 class="font-bold text-gray-800 mb-1">Phone</h3>
                                <a href="tel:{{ $settings['phone_no'] }}" class="text-pink-600 hover:text-pink-700">
                                    {{ $settings['phone_no'] }}
                                </a>
                            </div>
                            <div class="text-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-info-500 to-info-600 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-map-marker-alt text-white"></i>
                                </div>
                                <h3 class="font-bold text-gray-800 mb-1">Address</h3>
                                <p class="text-info-600">{{ $settings['address'] }}</p>
                            </div>
                        </div>
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

    <livewire:public.components.bottom-navigation />
</div>
