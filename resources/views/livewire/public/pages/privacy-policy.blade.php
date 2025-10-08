<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-purple-50">
    <!-- Privacy Policy Page -->
    <main class="min-h-screen bg-white">
        <!-- Hero Section -->
        <section class="relative h-[50vh] overflow-hidden">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1563013544-824ae1b704d3?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80" 
                     alt="Privacy Policy Background" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-900/45 to-pink-800/45"></div>
            </div>

            <!-- Content -->
            <div class="relative z-10 flex items-center justify-center h-full text-center text-white px-4">
                <div class="max-w-4xl mx-auto">
                    <h1 class="text-4xl md:text-6xl font-2xl mb-6 sparkle-text drop-shadow-2xl">Privacy Policy</h1>
                    <p class="text-xl md:text-2xl text-purple-100 max-w-2xl mx-auto leading-relaxed drop-shadow-lg">
                        How {{ $settings['site_name'] }} protects and handles your personal information
                    </p>
                </div>
            </div>
        </section>

        <!-- Privacy Content -->
        <section class="py-20 bg-white">
            <div class="px-20">
                <div class="prose prose-lg max-w-none">
                    <!-- Last Updated -->
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg p-6 mb-8">
                        <p class="text-sm text-gray-600 mb-0">
                            <strong>Last Updated:</strong> {{ $settings['last_updated_date'] ?? date('F j, Y') }}
                        </p>
                    </div>

                    <!-- Introduction -->
                    <h2 class="text-3xl font-2xl gradient-text mb-6">1. Introduction</h2>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        At {{ $settings['site_name'] }}, we are committed to protecting your privacy and ensuring the security of your personal information. This Privacy Policy explains how we collect, use, and safeguard your data when you use our event planning services.
                    </p>

                    <!-- Information We Collect -->
                    <h2 class="text-3xl font-2xl gradient-text mb-6">2. Information We Collect</h2>
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-info-50 rounded-lg p-6">
                            <h3 class="text-xl font-2xl text-info-800 mb-4">Personal Information</h3>
                            <ul class="text-gray-700 space-y-2 text-sm">
                                <li>• Full name and contact details</li>
                                <li>• Email address and phone number</li>
                                <li>• Address and location information</li>
                                <li>• Event preferences and requirements</li>
                                <li>• Payment and billing information</li>
                                <li>• Emergency contact details</li>
                            </ul>
                        </div>
                        <div class="bg-green-50 rounded-lg p-6">
                            <h3 class="text-xl font-2xl text-green-800 mb-4">Usage Information</h3>
                            <ul class="text-gray-700 space-y-2 text-sm">
                                <li>• Website browsing behavior</li>
                                <li>• Device and browser information</li>
                                <li>• IP address and location data</li>
                                <li>• Cookies and tracking data</li>
                                <li>• Service usage patterns</li>
                                <li>• Communication preferences</li>
                            </ul>
                        </div>
                    </div>

                    <!-- How We Use Your Information -->
                    <h2 class="text-3xl font-2xl gradient-text mb-6">3. How We Use Your Information</h2>
                    <div class="bg-purple-50 rounded-lg p-6 mb-6">
                        <p class="text-gray-700 mb-4 leading-relaxed">
                            We use your personal information for the following purposes:
                        </p>
                        <div class="grid md:grid-cols-2 gap-4">
                            <ul class="list-disc list-inside text-gray-700 space-y-2">
                                <li>Event planning and coordination</li>
                                <li>Communication and updates</li>
                                <li>Payment processing</li>
                                <li>Service customization</li>
                            </ul>
                            <ul class="list-disc list-inside text-gray-700 space-y-2">
                                <li>Marketing and promotions</li>
                                <li>Customer support</li>
                                <li>Legal compliance</li>
                                <li>Service improvement</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Information Sharing -->
                    <h2 class="text-3xl font-2xl gradient-text mb-6">4. Information Sharing and Disclosure</h2>
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 mb-6">
                        <h3 class="text-lg font-2xl text-yellow-800 mb-3">We share your information only when:</h3>
                        <ul class="text-gray-700 space-y-2">
                            <li><strong>Service Providers:</strong> With trusted vendors and partners for event execution</li>
                            <li><strong>Legal Requirements:</strong> When required by law or legal process</li>
                            <li><strong>Business Transfers:</strong> In case of merger, sale, or transfer of business</li>
                            <li><strong>Consent:</strong> When you explicitly authorize us to share</li>
                        </ul>
                        <p class="text-gray-700 mt-4 font-2xl">
                            We never sell your personal information to third parties.
                        </p>
                    </div>

                    <!-- Data Security -->
                    <h2 class="text-3xl font-2xl gradient-text mb-6">5. Data Security</h2>
                    <div class="grid md:grid-cols-3 gap-6 mb-6">
                        <div class="bg-red-50 rounded-lg p-6 text-center">
                            <div class="w-16 h-16 bg-gradient-to-r from-red-500 to-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-shield-alt text-white text-2xl"></i>
                            </div>
                            <h3 class="font-2xl text-red-800 mb-2">Encryption</h3>
                            <p class="text-gray-700 text-sm">All data transmitted is encrypted using SSL/TLS protocols</p>
                        </div>
                        <div class="bg-orange-50 rounded-lg p-6 text-center">
                            <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-lock text-white text-2xl"></i>
                            </div>
                            <h3 class="font-2xl text-orange-800 mb-2">Access Control</h3>
                            <p class="text-gray-700 text-sm">Restricted access with authentication and authorization</p>
                        </div>
                        <div class="bg-purple-50 rounded-lg p-6 text-center">
                            <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-server text-white text-2xl"></i>
                            </div>
                            <h3 class="font-2xl text-purple-800 mb-2">Secure Storage</h3>
                            <p class="text-gray-700 text-sm">Data stored on secure servers with regular backups</p>
                        </div>
                    </div>

                    <!-- Your Rights -->
                    <h2 class="text-3xl font-2xl gradient-text mb-6">6. Your Privacy Rights</h2>
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <p class="text-gray-700 mb-4 leading-relaxed">You have the following rights regarding your personal information:</p>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-2xl text-gray-800 mb-2">Access & Portability</h4>
                                <ul class="text-gray-700 space-y-1 text-sm">
                                    <li>• Request copies of your data</li>
                                    <li>• Export your information</li>
                                    <li>• Know what data we have</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-2xl text-gray-800 mb-2">Control & Deletion</h4>
                                <ul class="text-gray-700 space-y-1 text-sm">
                                    <li>• Update or correct information</li>
                                    <li>• Delete your account and data</li>
                                    <li>• Opt-out of marketing</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Cookies -->
                    <h2 class="text-3xl font-2xl gradient-text mb-6">7. Cookies and Tracking</h2>
                    <div class="bg-pink-50 rounded-lg p-6 mb-6">
                        <p class="text-gray-700 mb-4 leading-relaxed">
                            We use cookies and similar technologies to enhance your experience:
                        </p>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <h4 class="font-2xl text-pink-800 mb-2">Essential Cookies</h4>
                                <p class="text-gray-700 text-sm">Required for website functionality and security</p>
                            </div>
                            <div>
                                <h4 class="font-2xl text-pink-800 mb-2">Analytics Cookies</h4>
                                <p class="text-gray-700 text-sm">Help us understand usage patterns and improve services</p>
                            </div>
                        </div>
                        <p class="text-gray-700 mt-4 text-sm">
                            You can control cookie preferences through your browser settings.
                        </p>
                    </div>

                    <!-- Data Retention -->
                    <h2 class="text-3xl font-2xl gradient-text mb-6">8. Data Retention</h2>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        We retain your personal information for as long as necessary to provide our services and comply with legal obligations. Typically, we keep event-related data for 7 years for business and legal purposes, after which it is securely deleted.
                    </p>

                    <!-- Third-Party Services -->
                    <h2 class="text-3xl font-2xl gradient-text mb-6">9. Third-Party Services</h2>
                    <div class="bg-info-50 rounded-lg p-6 mb-6">
                        <p class="text-gray-700 mb-4 leading-relaxed">
                            Our website and services may contain links to third-party websites or integrate with external services:
                        </p>
                        <ul class="list-disc list-inside text-gray-700 space-y-2">
                            <li>Payment processors (secure payment gateways)</li>
                            <li>Social media platforms</li>
                            <li>Google Maps and location services</li>
                            <li>Analytics and marketing tools</li>
                        </ul>
                        <p class="text-gray-700 mt-4 text-sm font-2xl">
                            These services have their own privacy policies, which we encourage you to review.
                        </p>
                    </div>

                    <!-- Children's Privacy -->
                    <h2 class="text-3xl font-2xl gradient-text mb-6">10. Children's Privacy</h2>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        Our services are not intended for children under 13 years of age. We do not knowingly collect personal information from children under 13. If you believe we have inadvertently collected such information, please contact us immediately.
                    </p>

                    <!-- Policy Updates -->
                    <h2 class="text-3xl font-2xl gradient-text mb-6">11. Policy Updates</h2>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        We may update this Privacy Policy from time to time to reflect changes in our practices or legal requirements. We will notify you of any material changes by email or through a prominent notice on our website.
                    </p>

                    <!-- Contact Information -->
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-8 mt-12">
                        <h2 class="text-3xl font-2xl gradient-text mb-6">Contact Our Privacy Team</h2>
                        <p class="text-gray-700 mb-6 leading-relaxed">
                            If you have any questions, concerns, or requests regarding this Privacy Policy or your personal information, please contact us:
                        </p>
                        <div class="grid md:grid-cols-3 gap-6">
                            <div class="text-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-envelope text-white"></i>
                                </div>
                                <h3 class="font-2xl text-gray-800 mb-1">Email</h3>
                                <a href="mailto:{{ $settings['email'] }}" class="text-purple-600 hover:text-purple-700">
                                    {{ $settings['email'] }}
                                </a>
                                <p class="text-xs text-gray-500 mt-1">Privacy inquiries welcome</p>
                            </div>
                            <div class="text-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-pink-600 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-phone text-white"></i>
                                </div>
                                <h3 class="font-2xl text-gray-800 mb-1">Phone</h3>
                                <a href="tel:{{ $settings['phone_no'] }}" class="text-pink-600 hover:text-pink-700">
                                    {{ $settings['phone_no'] }}
                                </a>
                                <p class="text-xs text-gray-500 mt-1">Mon-Fri 9AM-6PM</p>
                            </div>
                            <div class="text-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-info-500 to-info-600 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-map-marker-alt text-white"></i>
                                </div>
                                <h3 class="font-2xl text-gray-800 mb-1">Address</h3>
                                <p class="text-info-600">{{ $settings['address'] }}</p>
                                <p class="text-xs text-gray-500 mt-1">Visit by appointment</p>
                            </div>
                        </div>
                        
                        <div class="mt-8 p-4 bg-white rounded-lg border border-purple-200">
                            <p class="text-sm text-gray-600 text-center">
                                <i class="fas fa-info-circle text-purple-500 mr-2"></i>
                                We typically respond to privacy requests within 48 hours during business days.
                            </p>
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
