<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-purple-50 py-12 md:py-24">

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="fixed top-4 right-4 z-50 max-w-md">
            <div class="bg-green-500 text-white px-6 py-4 rounded-xl shadow-lg" id="success-message">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3"></i>
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="fixed top-4 right-4 z-50 max-w-md">
            <div class="bg-red-500 text-white px-6 py-4 rounded-xl shadow-lg" id="error-message">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-3"></i>
                    {{ session('error') }}
                </div>
            </div>
        </div>
    @endif

    @if (session('info'))
        <div class="fixed top-4 right-4 z-50 max-w-md">
            <div class="bg-info-500 text-white px-6 py-4 rounded-xl shadow-lg" id="info-message">
                <div class="flex items-center">
                    <i class="fas fa-info-circle mr-3"></i>
                    {{ session('info') }}
                </div>
            </div>
        </div>
    @endif
    @if (!$package)
        <div class="text-center py-20">
            <h2 class="text-2xl font-bold text-gray-800">Package not found</h2>
            <a href="{{ route('event-packages') }}"
                class="mt-4 inline-block bg-purple-600 text-white px-6 py-3 rounded-lg">
                Back to Packages
            </a>
        </div>
    @else
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Booking Form (2/3 width) -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                        <!-- Progress Steps -->
                        <div class="px-8 pt-8">
                            <div class="flex justify-between relative mb-8">
                                <!-- Progress line -->
                                <div class="absolute top-1/2 left-0 right-0 h-1 bg-gray-200 -translate-y-1/2 z-0"></div>
                                <div class="absolute top-1/2 left-0 h-1 bg-purple-600 -translate-y-1/2 z-10 transition-all duration-500"
                                    style="width: {{ ($currentStep / 4) * 100 }}%"></div>

                                <!-- Steps -->
                                @foreach (['Event Details', 'Requirements', 'Your Info', 'Confirmation'] as $index => $step)
                                    <div class="relative z-20">
                                        <button
                                            class="w-12 h-12 rounded-full flex items-center justify-center transition-all duration-300
                                            @if ($currentStep > $index + 1) bg-green-100 text-green-600 border-2 border-green-500
                                            @elseif($currentStep === $index + 1) bg-purple-600 text-white border-2 border-purple-600 shadow-lg
                                            @else bg-white text-gray-500 border-2 border-gray-300 @endif">
                                            @if ($currentStep > $index + 1)
                                                <i class="fas fa-check"></i>
                                            @else
                                                {{ $index + 1 }}
                                            @endif
                                        </button>
                                        <span
                                            class="absolute top-full left-1/2 -translate-x-1/2 mt-2 text-sm font-medium 
                                            @if ($currentStep === $index + 1) text-purple-600 @else text-gray-500 @endif">
                                            {{ $step }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                            <!-- Package Summary Header -->
                            <div class="bg-gradient-to-r from-purple-600 to-pink-600 p-6 text-white">
                                <div class="flex flex-col md:flex-row md:items-center justify-between">
                                    <div>
                                        <h2 class="text-2xl font-bold">{{ $package->name }}</h2>
                                        <p class="text-purple-100">{{ $package->category->name ?? 'Event Package' }}</p>
                                    </div>
                                    <div class="mt-4 md:mt-0 text-right">
                                        <p class="text-sm text-purple-100">Total Price</p>
                                        <p class="text-2xl font-bold">₹{{ number_format($this->totalPrice) }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 1: Event Details -->
                            @if ($currentStep === 1)
                                <div class="p-6 animate-fade-in">
                                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                        <i class="fas fa-calendar-day text-purple-600 mr-3"></i>
                                        When & Where is Your Event?
                                    </h3>

                                    <div class="space-y-6">
                                        <div class="grid md:grid-cols-3 gap-6">
                                            <div>
                                                <label class="block text-gray-700 font-semibold mb-2">
                                                    <i class="fas fa-calendar text-purple-600 mr-2"></i>
                                                    Event Date *
                                                </label>
                                                <input type="date" wire:model.live="eventDate"
                                                    min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 @error('eventDate') border-red-500 @enderror">
                                                @error('eventDate')
                                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div>
                                                <label class="block text-gray-700 font-semibold mb-2">
                                                    <i class="fas fa-clock text-purple-600 mr-2"></i>
                                                    Event Time
                                                </label>
                                                <select wire:model="eventTime"
                                                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 @error('eventTime') border-red-500 @enderror">
                                                    <option value="">Select Time (Optional)</option>
                                                    <option value="06:00">06:00 AM</option>
                                                    <option value="06:30">06:30 AM</option>
                                                    <option value="07:00">07:00 AM</option>
                                                    <option value="07:30">07:30 AM</option>
                                                    <option value="08:00">08:00 AM</option>
                                                    <option value="08:30">08:30 AM</option>
                                                    <option value="09:00">09:00 AM</option>
                                                    <option value="09:30">09:30 AM</option>
                                                    <option value="10:00">10:00 AM</option>
                                                    <option value="10:30">10:30 AM</option>
                                                    <option value="11:00">11:00 AM</option>
                                                    <option value="11:30">11:30 AM</option>
                                                    <option value="12:00">12:00 PM</option>
                                                    <option value="12:30">12:30 PM</option>
                                                    <option value="13:00">01:00 PM</option>
                                                    <option value="13:30">01:30 PM</option>
                                                    <option value="14:00">02:00 PM</option>
                                                    <option value="14:30">02:30 PM</option>
                                                    <option value="15:00">03:00 PM</option>
                                                    <option value="15:30">03:30 PM</option>
                                                    <option value="16:00">04:00 PM</option>
                                                    <option value="16:30">04:30 PM</option>
                                                    <option value="17:00">05:00 PM</option>
                                                    <option value="17:30">05:30 PM</option>
                                                    <option value="18:00">06:00 PM</option>
                                                    <option value="18:30">06:30 PM</option>
                                                    <option value="19:00">07:00 PM</option>
                                                    <option value="19:30">07:30 PM</option>
                                                    <option value="20:00">08:00 PM</option>
                                                    <option value="20:30">08:30 PM</option>
                                                    <option value="21:00">09:00 PM</option>
                                                    <option value="21:30">09:30 PM</option>
                                                    <option value="22:00">10:00 PM</option>
                                                    <option value="22:30">10:30 PM</option>
                                                    <option value="23:00">11:00 PM</option>
                                                    <option value="23:30">11:30 PM</option>
                                                </select>
                                                @error('eventTime')
                                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                                @enderror
                                                <p class="text-xs text-gray-500 mt-1">Select the preferred start time
                                                    for your event</p>
                                            </div>
                                            <div>
                                                <label class="block text-gray-700 font-semibold mb-2">
                                                    <i class="fas fa-calendar-check text-purple-600 mr-2"></i>
                                                    Event End Date
                                                </label>
                                                <input type="date" wire:model="eventEndDate"
                                                    min="{{ $eventDate ? date('Y-m-d', strtotime($eventDate . ' +1 day')) : date('Y-m-d', strtotime('+2 days')) }}"
                                                    @if (!$eventDate) disabled @endif
                                                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 @error('eventEndDate') border-red-500 @enderror @if (!$eventDate) bg-gray-100 @endif">
                                                @error('eventEndDate')
                                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                                @enderror
                                                <p class="text-xs text-gray-500 mt-1">
                                                    @if (!$eventDate)
                                                        Please select event start date first
                                                    @else
                                                        Leave blank if single day event
                                                    @endif
                                                </p>
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-gray-700 font-semibold mb-2">
                                                <i class="fas fa-map-marker-alt text-purple-600 mr-2"></i>
                                                Event Venue/Location *
                                            </label>
                                            <textarea wire:model="location"
                                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 @error('location') border-red-500 @enderror"
                                                rows="3" placeholder="Enter complete venue address with pin code"></textarea>
                                            @error('location')
                                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="pt-4">
                                            <button wire:click="validateStep1"
                                                class="w-full bg-purple-600 text-white py-4 rounded-2xl font-bold text-lg hover:bg-purple-700 transition-all duration-300">
                                                Continue to Requirements <i class="fas fa-arrow-right ml-2"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Step 2: Requirements -->
                            @if ($currentStep === 2)
                                <div class="p-6 animate-fade-in">
                                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                        <i class="fas fa-clipboard-list text-purple-600 mr-3"></i>
                                        Event Requirements
                                    </h3>

                                    <div class="space-y-6">
                                        <div>
                                            <label class="block text-gray-700 font-semibold mb-2">
                                                <i class="fas fa-users text-purple-600 mr-2"></i>
                                                Expected Guests
                                            </label>
                                            <input type="number" wire:model="guestCount" min="1"
                                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 @error('guestCount') border-red-500 @enderror"
                                                placeholder="Approximate number of guests">
                                            @error('guestCount')
                                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-gray-700 font-semibold mb-2">
                                                <i class="fas fa-comment-dots text-purple-600 mr-2"></i>
                                                Special Requirements (Optional)
                                            </label>
                                            <textarea wire:model="specialRequests"
                                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300"
                                                rows="4" placeholder="Any special requests, dietary requirements, or additional services..."></textarea>
                                            @error('specialRequests')
                                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="grid grid-cols-2 gap-4 pt-4">
                                            <button wire:click="goToStep(1)"
                                                class="bg-gray-200 text-gray-800 py-3 rounded-xl font-bold hover:bg-gray-300 transition-all duration-300">
                                                <i class="fas fa-arrow-left mr-2"></i> Back
                                            </button>
                                            <button wire:click="validateStep2"
                                                class="bg-purple-600 text-white py-3 rounded-xl font-bold hover:bg-purple-700 transition-all duration-300">
                                                Continue <i class="fas fa-arrow-right ml-2"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Step 3: Personal Info -->
                            @if ($currentStep === 3)
                                <div class="p-6 animate-fade-in">
                                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                        <i class="fas fa-user-circle text-purple-600 mr-3"></i>
                                        Your Information
                                    </h3>

                                    @if ($isLoggedIn)
                                        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                                            <div class="flex items-center">
                                                <i class="fas fa-user-check text-green-500 mr-3 text-xl"></i>
                                                <div>
                                                    <p class="font-semibold text-green-800">Welcome back,
                                                        {{ $existingUser->name }}!</p>
                                                    <p class="text-sm text-green-700">
                                                        {{ $existingUser->email ?: $existingUser->phone_no }}</p>
                                                    <p class="text-xs text-green-600 mt-1">Your booking details are
                                                        pre-filled but can be edited below.</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- User Details Form -->
                                    <div class="space-y-6">
                                        <!-- Info note -->
                                        <div class="bg-info-50 border border-info-200 rounded-lg p-4">
                                            <div class="flex items-start">
                                                <i class="fas fa-info-circle text-info-500 mr-2 mt-0.5"></i>
                                                <div class="text-sm text-info-700">
                                                    <p class="font-medium">Booking Details</p>
                                                    <p>These details are specifically for this booking and can be
                                                        different from your account information.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-gray-700 font-semibold mb-2">
                                                <i class="fas fa-user text-purple-600 mr-2"></i>
                                                Full Name (for booking) *
                                            </label>
                                            <input type="text" wire:model="name"
                                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 @error('name') border-red-500 @enderror"
                                                placeholder="Enter name for this booking">
                                            @error('name')
                                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                            <p class="text-sm text-gray-500 mt-1">This name will be used for the
                                                booking details</p>
                                        </div>

                                        <div class="grid md:grid-cols-2 gap-6">
                                            <div>
                                                <label class="block text-gray-700 font-semibold mb-2">
                                                    <i class="fas fa-phone text-purple-600 mr-2"></i>
                                                    Phone Number (for booking) *
                                                </label>
                                                <input type="tel" wire:model="phone"
                                                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 @error('phone') border-red-500 @enderror"
                                                    placeholder="+91 98765 43210">
                                                @error('phone')
                                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                                @enderror
                                                <p class="text-sm text-gray-500 mt-1">Contact number for this booking
                                                </p>
                                            </div>
                                            <div>
                                                <label class="block text-gray-700 font-semibold mb-2">
                                                    <i class="fas fa-envelope text-purple-600 mr-2"></i>
                                                    Email Address (Optional)
                                                </label>
                                                <input type="email" wire:model="email"
                                                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 @error('email') border-red-500 @enderror"
                                                    placeholder="your@email.com (optional)">
                                                @error('email')
                                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                                @enderror
                                                <p class="text-sm text-gray-500 mt-1">Email for booking confirmations
                                                    (optional)</p>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-2 gap-4 pt-4">
                                            <button wire:click="goToStep(2)"
                                                class="bg-gray-200 text-gray-800 py-3 rounded-xl font-bold hover:bg-gray-300 transition-all duration-300">
                                                <i class="fas fa-arrow-left mr-2"></i> Back
                                            </button>
                                            <button wire:click="validateStep3"
                                                class="bg-purple-600 text-white py-3 rounded-xl font-bold hover:bg-purple-700 transition-all duration-300">
                                                Review Booking <i class="fas fa-arrow-right ml-2"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Step 4: Confirmation -->
                            @if ($currentStep === 4)
                                <div class="p-6 animate-fade-in">
                                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                        <i class="fas fa-clipboard-check text-purple-600 mr-3"></i>
                                        Review Your Booking
                                    </h3>

                                    <div class="space-y-6">
                                        <!-- Booking Summary -->
                                        <div class="bg-gray-50 rounded-xl p-6">
                                            <h4 class="font-bold text-lg text-gray-800 mb-4 border-b pb-2">Booking
                                                Summary</h4>

                                            <div class="space-y-4">
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Package:</span>
                                                    <span class="font-medium">{{ $package->name }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Event Date:</span>
                                                    <span
                                                        class="font-medium">{{ \Carbon\Carbon::parse($eventDate)->format('D, M j, Y') }}</span>
                                                </div>
                                                @if ($eventEndDate && $eventEndDate != $eventDate)
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-600">End Date:</span>
                                                        <span
                                                            class="font-medium">{{ \Carbon\Carbon::parse($eventEndDate)->format('D, M j, Y') }}</span>
                                                    </div>
                                                @endif
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Location:</span>
                                                    <span class="font-medium text-right">{{ $location }}</span>
                                                </div>
                                                @if ($guestCount)
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-600">Expected Guests:</span>
                                                        <span class="font-medium">{{ $guestCount }}</span>
                                                    </div>
                                                @endif
                                                @if ($specialRequests)
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-600">Special Requests:</span>
                                                        <span
                                                            class="font-medium text-right">{{ $specialRequests }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Personal Info Summary -->
                                        <div class="bg-gray-50 rounded-xl p-6">
                                            <h4 class="font-bold text-lg text-gray-800 mb-4 border-b pb-2">Your
                                                Information</h4>

                                            <div class="space-y-4">
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Name:</span>
                                                    <span class="font-medium">{{ $name }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Phone:</span>
                                                    <span class="font-medium">{{ $phone }}</span>
                                                </div>
                                                @if ($email)
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-600">Email:</span>
                                                        <span class="font-medium">{{ $email }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Payment Options -->
                                        <div class="bg-purple-50 rounded-xl p-6">
                                            <h4 class="font-bold text-lg text-gray-800 mb-4 border-b pb-2">Payment
                                                Method</h4>

                                            <div class="space-y-3">
                                                <label
                                                    class="flex items-center p-4 border border-gray-300 rounded-xl cursor-pointer hover:border-purple-500 transition-all duration-300 bg-white">
                                                    <input type="radio" wire:model="paymentMethod" value="cash"
                                                        class="mr-3">
                                                    <div class="flex-1">
                                                        <div class="font-semibold text-gray-800 flex items-center">
                                                            <i class="fas fa-money-bill-wave text-green-600 mr-2"></i>
                                                            Cash Payment (20% Advance Required)
                                                        </div>
                                                        <div class="text-sm text-gray-600">20% advance via Razorpay,
                                                            80% cash on event day</div>
                                                    </div>
                                                </label>

                                                <label
                                                    class="flex items-center p-4 border border-gray-300 rounded-xl cursor-pointer hover:border-purple-500 transition-all duration-300 bg-white">
                                                    <input type="radio" wire:model="paymentMethod" value="online"
                                                        class="mr-3">
                                                    <div class="flex-1">
                                                        <div class="font-semibold text-gray-800 flex items-center">
                                                            <i class="fas fa-credit-card text-info-600 mr-2"></i>
                                                            Online Payment
                                                        </div>
                                                        <div class="text-sm text-gray-600">Pay securely online via
                                                            Razorpay</div>
                                                        <div class="text-xs text-gray-500 mt-1">Supports UPI, Cards,
                                                            Net Banking & Wallets</div>
                                                    </div>
                                                </label>
                                            </div>

                                            @if ($paymentMethod === 'cash')
                                                <div class="mt-4 p-3 bg-orange-50 rounded-lg border border-orange-200">
                                                    <p class="text-sm text-orange-800">
                                                        <i class="fas fa-info-circle mr-2"></i>
                                                        <strong>Cash Payment:</strong> 20% advance payment required
                                                        online to confirm booking.
                                                        Remaining 80% can be paid on event day.
                                                    </p>
                                                    <p class="text-xs text-orange-600 mt-1">
                                                        Total Amount:
                                                        ₹{{ number_format($package->discounted_price, 2) }} |
                                                        Advance Required:
                                                        ₹{{ number_format($package->discounted_price * 0.2, 2) }} |
                                                        Balance on Event Day:
                                                        ₹{{ number_format($package->discounted_price * 0.8, 2) }}
                                                    </p>
                                                </div>
                                            @elseif($paymentMethod === 'online')
                                                <div class="mt-4 p-3 bg-green-50 rounded-lg">
                                                    <p class="text-sm text-green-800">
                                                        <i class="fas fa-shield-alt mr-2"></i>
                                                        Secure online payment powered by Razorpay. Complete payment to
                                                        confirm your booking instantly.
                                                    </p>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Package Price Summary -->
                                        <div class="bg-white border border-gray-200 rounded-xl p-6">
                                            <h4 class="font-bold text-lg text-gray-800 mb-4 border-b pb-2">Price
                                                Summary</h4>

                                            <div class="space-y-3">
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Package Price:</span>
                                                    <span
                                                        class="font-medium">₹{{ number_format($package->price) }}</span>
                                                </div>

                                                @if ($package->discount_type && $package->price != $package->discounted_price)
                                                    <div class="flex justify-between text-green-600">
                                                        <span>
                                                            @if ($package->discount_type === 'percentage')
                                                                Discount ({{ $package->discount_value }}%)
                                                            @else
                                                                Discount
                                                            @endif
                                                        </span>
                                                        <span>-₹{{ number_format($package->price - $package->discounted_price) }}</span>
                                                    </div>
                                                @endif

                                                <div class="border-t border-gray-200 pt-3 mt-3">
                                                    <div class="flex justify-between text-lg font-bold text-gray-800">
                                                        <span>Total Amount:</span>
                                                        <span
                                                            class="text-purple-600">₹{{ number_format($this->totalPrice) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Terms and Conditions -->
                                        <div class="bg-gray-50 rounded-xl p-4">
                                            <label class="flex items-start">
                                                <input type="checkbox" wire:model="acceptTerms"
                                                    class="mt-1 mr-3 @error('acceptTerms') border-red-500 @enderror">
                                                <span class="text-sm text-gray-700">
                                                    I agree to the <a href="{{ route('terms-of-service') }}"
                                                        target="_blank"
                                                        class="text-purple-600 hover:underline font-medium">Terms &
                                                        Conditions</a> and
                                                    <a href="{{ route('privacy-policy') }}" target="_blank"
                                                        class="text-purple-600 hover:underline font-medium">Privacy
                                                        Policy</a>. I understand that my booking
                                                    is subject to availability and will be confirmed by the event
                                                    organizer.
                                                </span>
                                                <span class="text-sm text-gray-500 ml-2">(Required)</span>
                                            </label>
                                            @error('acceptTerms')
                                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="grid grid-cols-2 gap-4 pt-4">
                                            <button wire:click="goToStep(3)"
                                                class="bg-gray-200 text-gray-800 py-3 rounded-xl font-bold hover:bg-gray-300 transition-all duration-300">
                                                <i class="fas fa-arrow-left mr-2"></i> Back
                                            </button>
                                            <button wire:click="submitBooking" wire:loading.attr="disabled"
                                                class="bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 rounded-xl font-bold hover:from-purple-700 hover:to-pink-700 transition-all duration-300 disabled:opacity-50">
                                                <span wire:loading.remove>
                                                    @if ($paymentMethod === 'online')
                                                        <i class="fas fa-credit-card mr-2"></i> Pay Now
                                                        ₹{{ number_format($this->totalPrice) }}
                                                    @else
                                                        <i class="fas fa-check-circle mr-2"></i> Confirm Booking
                                                    @endif
                                                </span>
                                                <span wire:loading>
                                                    <i class="fas fa-spinner fa-spin mr-2"></i>
                                                    @if ($paymentMethod === 'online')
                                                        Initiating Payment...
                                                    @else
                                                        Processing...
                                                    @endif
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Package Details Sidebar (1/3 width) -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-3xl shadow-xl sticky top-8">
                        <!-- Package Header -->
                        <div class="bg-gradient-to-r from-purple-600 to-pink-600 p-6 text-white rounded-t-3xl">
                            <h2 class="text-2xl font-bold">{{ $package->name }}</h2>
                            <p class="text-purple-100">{{ $package->category->name ?? 'Event Package' }}</p>
                        </div>

                        <!-- Package Image -->
                        @if ($package->images->count() > 0)
                            <div class="p-6 border-b border-gray-200">
                                <img src="{{ $package->images->first()->image_url }}" alt="{{ $package->name }}"
                                    class="w-full h-48 object-cover rounded-lg">
                            </div>
                        @endif

                        <!-- Package Description -->
                        <div class="p-6">
                            <h3 class="font-bold text-gray-800 mb-3">Package Includes</h3>
                            <div class="prose text-gray-700">
                                {!! $package->description !!}
                            </div>
                        </div>

                        <!-- Price Summary -->
                        <div class="p-6 bg-gray-50 rounded-b-3xl">
                            <h3 class="font-bold text-gray-800 mb-3">Price Summary</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Base Price:</span>
                                    <span class="font-medium">₹{{ number_format($package->price) }}</span>
                                </div>

                                @if ($package->discount_type && $package->price != $package->discounted_price)
                                    <div class="flex justify-between text-green-600">
                                        <span>
                                            @if ($package->discount_type === 'percentage')
                                                Discount ({{ $package->discount_value }}%)
                                            @else
                                                Discount
                                            @endif
                                        </span>
                                        <span>-₹{{ number_format($package->price - $package->discounted_price) }}</span>
                                    </div>
                                @endif

                                <div class="border-t border-gray-200 pt-2 mt-2">
                                    <div class="flex justify-between font-bold text-lg text-gray-800">
                                        <span>Total:</span>
                                        <span class="text-purple-600">₹{{ number_format($this->totalPrice) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <livewire:public.section.enquiry-form />
    <livewire:public.components.bottom-navigation />
    <!-- Custom Styles -->
    <style>
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <!-- Razorpay Script -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <!-- Auto-hide flash messages -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide flash messages after 5 seconds
            const messages = ['success-message', 'error-message', 'info-message'];
            messages.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    setTimeout(() => {
                        element.style.opacity = '0';
                        element.style.transform = 'translateX(400px)';
                        setTimeout(() => element.remove(), 300);
                    }, 5000);
                }
            });
        });

        // Listen for Livewire events
        document.addEventListener('livewire:init', () => {
            // Check if Razorpay is available
            if (typeof Razorpay === 'undefined') {
                console.error('Razorpay script not loaded properly');
            } else {
                console.log('Razorpay script loaded successfully');
            }

            Livewire.on('user-found', (event) => {
                console.log('User found:', event.message);
                // You can add additional UI feedback here
            });

            Livewire.on('user-not-found', () => {
                console.log('User not found');
                // You can add additional UI feedback here
            });

            // Listen for Razorpay payment initiation
            Livewire.on('initiate-razorpay-payment', (data) => {
                console.log('Received payment initiation event:', data);
                if (data && data.length > 0) {
                    initiateRazorpayPayment(data[0]);
                } else {
                    console.error('No payment data received');
                    alert('Payment initialization failed. Please try again.');
                }
            });
        });

        function initiateRazorpayPayment(paymentData) {
            console.log('Initiating Razorpay payment with data:', paymentData);

            // Validate payment data
            if (!paymentData || !paymentData.order_id || !paymentData.amount) {
                console.error('Invalid payment data:', paymentData);
                alert('Payment initialization failed. Missing required data.');
                @this.set('isSubmitting', false);
                return;
            }

            // Check if test mode (for development)
            const isTestMode = paymentData.order_id.includes('test_');

            if (isTestMode) {
                console.log('Running in test mode');
                simulateTestPayment(paymentData);
                return;
            }

            console.log('Initializing real Razorpay payment');

            // Real Razorpay integration
            const options = {
                key: '{{ config('razorpay.key_id') }}', // Your Razorpay key
                amount: paymentData.amount,
                currency: paymentData.currency || 'INR',
                name: paymentData.name || 'Zuppie',
                description: paymentData.description || 'Event Booking',
                order_id: paymentData.order_id,
                prefill: paymentData.prefill || {},
                theme: {
                    color: '#9333ea' // Purple theme to match your design
                },
                handler: function(response) {
                    console.log('Payment successful:', response);
                    // Call Livewire method to complete the payment
                    @this.call('completeRazorpayPayment',
                        response.razorpay_payment_id,
                        response.razorpay_order_id,
                        response.razorpay_signature
                    );
                },
                modal: {
                    ondismiss: function() {
                        console.log('Payment modal dismissed');
                        // Re-enable the submit button
                        @this.set('isSubmitting', false);
                        alert('Payment was cancelled. You can try again or choose cash payment.');
                    }
                }
            };

            console.log('Razorpay options:', options);

            try {
                const rzp = new Razorpay(options);

                rzp.on('payment.failed', function(response) {
                    console.log('Payment failed:', response.error);
                    @this.call('handleRazorpayError', response.error);
                });

                console.log('Opening Razorpay checkout...');
                rzp.open();
            } catch (error) {
                console.error('Error initializing Razorpay:', error);
                alert('Failed to initialize payment gateway. Please try again.');
                @this.set('isSubmitting', false);
            }
        }

        function simulateTestPayment(paymentData) {
            console.log('Simulating test payment for:', paymentData);

            // Show test payment modal
            if (confirm('This is TEST MODE. Click OK to simulate successful payment or Cancel to simulate failure.')) {
                // Simulate successful payment
                const testResponse = {
                    razorpay_payment_id: 'pay_test_' + Date.now(),
                    razorpay_order_id: paymentData.order_id,
                    razorpay_signature: 'test_signature_' + Date.now()
                };

                setTimeout(() => {
                    @this.call('completeRazorpayPayment',
                        testResponse.razorpay_payment_id,
                        testResponse.razorpay_order_id,
                        testResponse.razorpay_signature
                    );
                }, 1000);
            } else {
                // Simulate payment failure
                setTimeout(() => {
                    @this.call('handleRazorpayError', {
                        code: 'TEST_PAYMENT_CANCELLED',
                        description: 'Test payment was cancelled by user'
                    });
                }, 500);
            }
        }
    </script>
</div>
