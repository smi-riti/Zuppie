<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-purple-50">

    <!-- Success Message -->
    @if($showSuccess)
        <div class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-30 backdrop-blur-sm z-50 flex items-center justify-center p-4"
            id="success-overlay">
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 max-w-md w-full text-center shadow-2xl border border-white/20"
                id="success-modal">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-check text-green-600 text-4xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Booking Confirmed!</h2>
                <p class="text-gray-600 mb-6">Your event booking has been successfully confirmed. We'll contact you soon to
                    finalize the details.</p>
                <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                    <div class="bg-gradient-to-r from-purple-600 to-pink-600 h-2 rounded-full" id="progress-bar"
                        style="width: 0%"></div>
                </div>
                <button wire:click="dismissSuccess"
                    class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 rounded-xl font-semibold">
                    Continue
                </button>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <section class="py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($booking)
                <!-- Current Booking Details -->
                <div class="mb-12">
                    <div class="text-center mb-8">
                        <h1 class="text-4xl font-bold text-gray-800 mb-4">Booking Management</h1>
                        <p class="text-xl text-gray-600">Track and manage your event booking</p>
                    </div>

                    <!-- Booking Card -->
                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                        <!-- Header -->
                        <div class="bg-gradient-to-r from-purple-600 to-pink-600 p-8 text-white">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                <div>
                                    <h2 class="text-2xl font-bold mb-2">{{ $booking->eventPackage->name }}</h2>
                                    <p class="text-purple-100">Booking ID:
                                        #{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</p>
                                </div>
                                <div class="mt-4 md:mt-0">
                                    <span class="inline-block px-4 py-2 bg-white bg-opacity-20 rounded-full font-semibold">
                                        <i class="fas fa-calendar mr-2"></i>
                                        {{ $booking->event_date->format('M d, Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-8">
                            <div class="grid lg:grid-cols-2 gap-8">
                                <!-- Booking Details -->
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                        <i class="fas fa-info-circle text-purple-600 mr-3"></i>
                                        Booking Details
                                    </h3>

                                    <div class="space-y-4">
                                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                            <span class="text-gray-600">Status</span>
                                            <span
                                                class="px-3 py-1 rounded-full text-sm font-medium {{ $this->bookingStatusBadge }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </div>

                                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                            <span class="text-gray-600">Event Date</span>
                                            <span class="font-semibold">{{ $booking->event_date->format('M d, Y') }}</span>
                                        </div>

                                        @if($booking->event_end_date && $booking->event_end_date != $booking->event_date)
                                            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                                <span class="text-gray-600">End Date</span>
                                                <span
                                                    class="font-semibold">{{ $booking->event_end_date->format('M d, Y') }}</span>
                                            </div>
                                        @endif

                                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                            <span class="text-gray-600">Guest Count</span>
                                            <span class="font-semibold">{{ $booking->guest_count }} guests</span>
                                        </div>

                                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                            <span class="text-gray-600">Pin Code</span>
                                            <span class="font-semibold">{{ $booking->pin_code }}</span>
                                        </div>

                                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                            <span class="text-gray-600">Total Amount</span>
                                            <span
                                                class="font-bold text-lg text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
                                                ₹{{ number_format($booking->total_price) }}
                                            </span>
                                        </div>

                                        @if($booking->payments->count() > 0)
                                            <div class="flex items-center justify-between py-3">
                                                <span class="text-gray-600">Payment Status</span>
                                                <span
                                                    class="px-3 py-1 rounded-full text-sm font-medium {{ $this->paymentStatusBadge }}">
                                                    {{ ucfirst($booking->payments->first()->status) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Event Information -->
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                        <i class="fas fa-map-marker-alt text-purple-600 mr-3"></i>
                                        Event Information
                                    </h3>

                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-gray-600 text-sm font-medium mb-2">Customer
                                                Information</label>
                                            <div class="bg-gray-50 p-3 rounded-lg">
                                                <p class="font-semibold">{{ $booking->user->name }}</p>
                                                @if($booking->user->email)
                                                    <p class="text-sm text-gray-600">{{ $booking->user->email }}</p>
                                                @endif
                                                <p class="text-sm text-gray-600">{{ $booking->user->phone_no }}</p>
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-gray-600 text-sm font-medium mb-2">Location</label>
                                            <p class="text-gray-800 bg-gray-50 p-3 rounded-lg">{{ $booking->location }}</p>
                                        </div>

                                        @if($booking->special_requests)
                                            <div>
                                                <label class="block text-gray-600 text-sm font-medium mb-2">Special
                                                    Requests</label>
                                                <p class="text-gray-800 bg-gray-50 p-3 rounded-lg">
                                                    {{ $booking->special_requests }}</p>
                                            </div>
                                        @endif

                                        <!-- Package Image -->
                                        @if($booking->eventPackage->images->count() > 0)
                                            <div>
                                                <label class="block text-gray-600 text-sm font-medium mb-2">Package
                                                    Preview</label>
                                                <img src="{{ $booking->eventPackage->images->first()->image_url }}"
                                                    alt="{{ $booking->eventPackage->name }}"
                                                    class="w-full h-40 object-cover rounded-lg">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-8 pt-8 border-t border-gray-200">
                                <div class="flex flex-col sm:flex-row gap-4">
                                    <button wire:click="downloadInvoice"
                                        class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 px-6 rounded-xl font-semibold hover:from-purple-700 hover:to-pink-700 transition-all duration-300">
                                        <i class="fas fa-download mr-2"></i>
                                        Download Invoice
                                    </button>
                                    <button wire:click="contactSupport"
                                        class="flex-1 border-2 border-purple-600 text-purple-600 py-3 px-6 rounded-xl font-semibold hover:bg-purple-50 transition-all duration-300">
                                        <i class="fas fa-headset mr-2"></i>
                                        Contact Support
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- All User Bookings -->
            @if(Auth::check() && $this->allUserBookings->count() > 1)
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Your Booking History</h2>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($this->allUserBookings as $userBooking)
                            @if($userBooking->id != $booking?->id)
                                <div
                                    class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                                    @if($userBooking->eventPackage->images->count() > 0)
                                        <img src="{{ $userBooking->eventPackage->images->first()->image_url }}"
                                            alt="{{ $userBooking->eventPackage->name }}" class="w-full h-32 object-cover">
                                    @endif

                                    <div class="p-6">
                                        <h3 class="font-bold text-gray-800 mb-2">{{ $userBooking->eventPackage->name }}</h3>
                                        <p class="text-sm text-gray-600 mb-4">{{ $userBooking->event_date->format('M d, Y') }}</p>

                                        <div class="flex items-center justify-between">
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-medium {{ $userBooking->status === 'confirmed' ? 'bg-green-100 text-green-800' : ($userBooking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                {{ ucfirst($userBooking->status) }}
                                            </span>
                                            <span
                                                class="font-bold text-purple-600">₹{{ number_format($userBooking->total_price) }}</span>
                                        </div>

                                        <a href="{{ route('manage-booking', ['booking_id' => $userBooking->id]) }}"
                                            class="w-full mt-4 bg-purple-600 text-white py-2 rounded-lg font-semibold hover:bg-purple-700 transition-colors duration-300 inline-block text-center">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- No Booking State -->
            @if(!$booking)
                <div class="text-center py-20">
                    <div class="w-24 h-24 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-calendar-times text-purple-600 text-3xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">No Bookings Found</h2>
                    <p class="text-gray-600 mb-8">You don't have any bookings yet. Start by exploring our amazing event
                        packages.</p>
                    <a href="{{ route('event-packages') }}"
                        class="inline-block bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 px-8 rounded-xl font-semibold hover:from-purple-700 hover:to-pink-700 transition-all duration-300">
                        <i class="fas fa-search mr-2"></i>
                        Browse Packages
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Need Help with Your Booking?</h2>
            <p class="text-gray-600 mb-8">Our customer support team is here to help you 24/7</p>

            <div class="grid md:grid-cols-3 gap-6">
                <a href="tel:+919876543210"
                    class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-phone text-green-600 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">Call Us</h3>
                    <p class="text-gray-600 text-sm">+91 98765 43210</p>
                </a>

                <a href="mailto:support@zuppie.com"
                    class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-envelope text-blue-600 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">Email Us</h3>
                    <p class="text-gray-600 text-sm">support@zuppie.com</p>
                </a>

                <a href="#" class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-comments text-purple-600 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">Live Chat</h3>
                    <p class="text-gray-600 text-sm">Available 24/7</p>
                </a>
            </div>
        </div>
    </section>

    <livewire:public.section.enquiry-form />
    <livewire:public.components.bottom-navigation />
    <!-- Flash Messages -->
    @if(session('info'))
        <div class="fixed bottom-4 right-4 z-50">
            <div class="bg-blue-500 text-white px-6 py-4 rounded-xl shadow-lg">
                {{ session('info') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="fixed bottom-4 right-4 z-50">
            <div class="bg-red-500 text-white px-6 py-4 rounded-xl shadow-lg">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Auto-hide success message after 5 seconds with progress bar
            @if($showSuccess)
                let progress = 0;
                const progressBar = document.getElementById('progress-bar');
                const interval = setInterval(() => {
                    progress += 2;
                    if (progressBar) {
                        progressBar.style.width = progress + '%';
                    }
                    if (progress >= 100) {
                        clearInterval(interval);
                        @this.call('dismissSuccess');
                    }
                }, 100); // 100ms * 50 = 5000ms (5 seconds)
            @endif
        });
    </script>
</div>