<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-purple-50">
    <!-- Contact Page -->
    <main class="min-h-screen bg-white">
        <!-- Hero Section -->
        <section class="relative h-[60vh] overflow-hidden">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?w=1920&h=1080&fit=crop"
                    alt="Contact Us" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 to-purple-900/60"></div>
            </div>

            <!-- Content -->
            <div class="relative z-10 flex items-center justify-center h-full text-center text-white px-4">
                <div class="max-w-4xl mx-auto">
                    <h1 class="text-5xl md:text-7xl font-bold font-display mb-6 sparkle-text">
                        Get In Touch
                    </h1>
                    <p class="text-xl md:text-2xl opacity-90 leading-relaxed">
                        Let's start planning your magical event together
                    </p>
                    <button wire:click="$dispatch('open-enquiry-form')"
                        class="text-2xl bg-gray-200 rounded border font-bold gradient-text mb-6 px-3 py-2 w-fit h-fit">Contact
                        us</button>

                    <!-- Floating sparkles -->
                    <div class="absolute inset-0 pointer-events-none">
                        <div class="sparkle-float absolute w-3 h-3 bg-yellow-300 rounded-full top-16 left-16"></div>
                        <div class="sparkle-float absolute w-2 h-2 bg-white rounded-full top-32 right-24"
                            style="animation-delay: 1.5s;"></div>
                        <div class="sparkle-float absolute w-4 h-4 bg-pink-300 rounded-full bottom-24 left-24"
                            style="animation-delay: 0.8s;"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Information & Form Section -->
        <section class="py-20 bg-gradient-to-br from-purple-50 to-pink-50">
            <div class="container mx-auto px-4 max-w-7xl">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold font-display gradient-text mb-6">
                        Let's Create Magic Together
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Ready to plan your dream event? We're here to help make it unforgettable!
                    </p>
                </div>

                <div class="grid lg:grid-cols-2 gap-16">
                    <!-- Contact Information -->
                    <div class="space-y-8">
                        <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300">
                            <h3 class="text-2xl font-bold gradient-text mb-6">Contact Information</h3>

                            <div class="space-y-6">
                                <!-- Address -->
                                <div class="flex items-start space-x-4">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-map-marker-alt text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-800 mb-1">Visit Our Office</h4>
                                        <p class="text-gray-600">123 Magic Lane<br>Celebration City, CC 12345<br>United
                                            States</p>
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="flex items-start space-x-4">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-r from-pink-600 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-phone text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-800 mb-1">Call Us</h4>
                                        <p class="text-gray-600">+1 (555) 123-MAGIC<br>+1 (555) 123-4567</p>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="flex items-start space-x-4">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-envelope text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-800 mb-1">Email Us</h4>
                                        <p class="text-gray-600">hello@zuppie.com<br>events@zuppie.com</p>
                                    </div>
                                </div>

                                <!-- Hours -->
                                <div class="flex items-start space-x-4">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-r from-pink-600 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-clock text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-800 mb-1">Business Hours</h4>
                                        <p class="text-gray-600">Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday -
                                            Sunday: 10:00 AM - 4:00 PM</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Social Media & Quick Links -->
                        <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300">
                            <h3 class="text-2xl font-bold gradient-text mb-6">Follow Us</h3>

                            <div class="flex flex-wrap gap-4 mb-6">
                                <a href="#"
                                    class="w-12 h-12 bg-gradient-to-r from-blue-600 to-blue-500 rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#"
                                    class="w-12 h-12 bg-gradient-to-r from-pink-600 to-red-500 rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#"
                                    class="w-12 h-12 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#"
                                    class="w-12 h-12 bg-gradient-to-r from-red-600 to-red-500 rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
                                    <i class="fab fa-pinterest"></i>
                                </a>
                                <a href="#"
                                    class="w-12 h-12 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>

                            <p class="text-gray-600 text-sm leading-relaxed">
                                Stay updated with our latest events, behind-the-scenes content, and inspiration for your
                                next celebration!
                            </p>
                        </div>
                    </div>

                    <!-- Contact Form -->



                    <!-- Studio Information -->
                    <div class="space-y-6">
                        <h3 class="text-3xl font-bold gradient-text mb-4">Our Creative Studio</h3>
                        <p class="text-gray-700 leading-relaxed">
                            Visit our beautiful studio to see our decoration samples, meet our team, and get inspired
                            for your upcoming event. We have a comfortable consultation area where we can discuss
                            your vision in detail.
                        </p>

                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-check-circle text-green-500"></i>
                                <span class="text-gray-700">Free consultation appointments</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-check-circle text-green-500"></i>
                                <span class="text-gray-700">Sample decorations and themes</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-check-circle text-green-500"></i>
                                <span class="text-gray-700">Professional design consultation</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-check-circle text-green-500"></i>
                                <span class="text-gray-700">Portfolio viewing area</span>
                            </div>
                        </div>

                        <div class="pt-6">
                            <a href="#"
                                class="inline-flex items-center bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-full font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300">
                                <i class="fas fa-calendar-check mr-2"></i>
                                Schedule a Visit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4 text-center">
                <div class="max-w-4xl mx-auto">
                    <h2 class="text-4xl md:text-5xl font-bold font-display gradient-text mb-6">
                        Ready to Start Planning?
                    </h2>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Let's bring your vision to life and create an unforgettable experience that you and your guests
                        will treasure forever.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <button
                            class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-8 py-4 rounded-full font-semibold text-lg hover:shadow-lg hover:scale-105 transition-all duration-300 flex items-center space-x-2">
                            <i class="fas fa-phone"></i>
                            <span>Call Us Now</span>
                        </button>
                        <a href="/packages"
                            class="border-2 border-purple-600 text-purple-600 px-8 py-4 rounded-full font-semibold text-lg hover:bg-purple-600 hover:text-white transition-all duration-300 flex items-center space-x-2">
                            <i class="fas fa-gift"></i>
                            <span>View Packages</span>
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
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Sparkle Float Animation */
        .sparkle-float {
            animation: sparkle-float 3s ease-in-out infinite;
        }

        @keyframes sparkle-float {

            0%,
            100% {
                transform: translateY(0px) scale(1);
                opacity: 0.7;
            }

            50% {
                transform: translateY(-15px) scale(1.2);
                opacity: 1;
            }
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
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Enhanced Animations */
        @keyframes bounce-slow {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes pulse-slow {

            0%,
            100% {
                opacity: 0.8;
                transform: scale(1);
            }

            50% {
                opacity: 1;
                transform: scale(1.1);
            }
        }

        .animate-bounce-slow {
            animation: bounce-slow 3s ease-in-out infinite;
        }

        .animate-pulse-slow {
            animation: pulse-slow 4s ease-in-out infinite;
        }

        /* Form Focus Effects */
        input:focus,
        select:focus,
        textarea:focus {
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // FAQ Toggle Functionality
            window.toggleFAQ = function (button) {
                const content = button.nextElementSibling;
                const icon = button.querySelector('i');

                if (content.classList.contains('hidden')) {
                    content.classList.remove('hidden');
                    icon.style.transform = 'rotate(180deg)';
                } else {
                    content.classList.add('hidden');
                    icon.style.transform = 'rotate(0deg)';
                }
            };

            // Form Validation
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    // Basic validation
                    const Fields = form.querySelectorAll('input[], textarea[]');
                    let valid = true;

                    Fields.forEach(field => {
                        if (!field.value.trim()) {
                            valid = false;
                            field.classList.add('border-red-500');
                            field.focus();
                        } else {
                            field.classList.remove('border-red-500');
                        }
                    });

                    if (valid) {
                        // Here you would normally submit the form
                        alert('Thank you for your message! We\'ll get back to you within 24 hours.');
                    } else {
                        alert('Please fill in all  fields.');
                    }
                });
            }

            // Add scroll animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function (entries) {
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

            // Add parallax effect for sparkles
            window.addEventListener('scroll', function () {
                const scrolled = window.pageYOffset;
                const sparkles = document.querySelectorAll('.sparkle-float');

                sparkles.forEach((sparkle, index) => {
                    const speed = (index + 1) * 0.3;
                    sparkle.style.transform = `translateY(${scrolled * speed}px)`;
                });
            });
        });
    </script>
    <!-- form modal -->
      
    <livewire:public.section.enquiry-form />
    <livewire:public.components.bottom-navigation />
</div>