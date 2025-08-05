<div class="min-h-screen bg-gradient-to-br from-purple-50 to-pink-50 py-12 px-4 sm:px-6 lg:px-8 mt-8">
    <div class="max-w-4xl mx-auto">
        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Gradient Header -->
            <div class="bg-gradient-to-r from-purple-400 to-pink-400 p-8 text-white">
                <h2 class="text-3xl font-bold text-center">Event Booking Form</h2>
                <p class="mt-2 text-center text-purple-100">Fill in your details to book your special event</p>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                @if (session('message'))
                    <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded">
                        {{ session('message') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded">
                        {{ session('error') }}
                    </div>
                @endif
                @if ($errors->has('phone_no'))
                    <div class="mb-6 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 rounded">
                        {{ $errors->first('phone_no') }}
                    </div>
                @endif

                <form wire:submit.prevent="submit" class="space-y-6">
                    <!-- User Information Section -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-semibold text-purple-800 border-b-2 border-purple-100 pb-2">Your
                            Information</h3>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Name -->
                            <div>
                                <label class="block text-sm font-medium text-purple-700 mb-1">Full Name</label>
                                <input type="text" wire:model="name"
                                    class="w-full px-4 py-2 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition">
                                @error('name')
                                    <span class="text-sm text-pink-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-medium text-purple-700 mb-1">Email</label>
                                <input type="email" wire:model="email"
                                    class="w-full px-4 py-2 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition">
                                @error('email')
                                    <span class="text-sm text-pink-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div>
                                <label class="block text-sm font-medium text-purple-700 mb-1">Phone Number</label>
                                <input type="text" wire:model.debounce.500ms="phone_no"
                                    class="w-full px-4 py-2 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition">
                                @error('phone_no')
                                    <span class="text-sm text-pink-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Event Details Section -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-semibold text-purple-800 border-b-2 border-purple-100 pb-2">Event
                            Details</h3>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Package -->
                            <div>
                                <label class="block text-sm font-medium text-purple-700 mb-1">Event Package</label>
                                <select wire:model="event_package_id"
                                    class="w-full px-4 py-2 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition"
                                    {{ !$packages->count() ? 'disabled' : '' }}>
                                    <option value="">Select Package</option>
                                    @foreach ($packages as $package)
                                        <option value="{{ $package->id }}">{{ $package->name }} -
                                            ₹{{ number_format($package->price, 2) }}</option>
                                    @endforeach
                                </select>
                                @error('event_package_id')
                                    <span class="text-sm text-pink-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Event Date -->
                            <div>
                                <label class="block text-sm font-medium text-purple-700 mb-1">Event Date</label>
                                <input type="datetime-local" wire:model="event_date"
                                    class="w-full px-4 py-2 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition">
                                @error('event_date')
                                    <span class="text-sm text-pink-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Event End Date -->
                            <div>
                                <label class="block text-sm font-medium text-purple-700 mb-1">Event End Date</label>
                                <input type="datetime-local" wire:model="event_end_date"
                                    class="w-full px-4 py-2 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition">
                                @error('event_end_date')
                                    <span class="text-sm text-pink-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Guest Count -->
                            <div>
                                <label class="block text-sm font-medium text-purple-700 mb-1">Number of Guests</label>
                                <input type="number" wire:model="guest_count" min="1"
                                    class="w-full px-4 py-2 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition">
                                @error('guest_count')
                                    <span class="text-sm text-pink-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- PIN Code -->
                            <div>
                                <label class="block text-sm font-medium text-purple-700 mb-1">PIN Code</label>
                                <input type="text" wire:model.live.debounce.500ms="pin_code" id="pin_code"
                                    class="w-full px-4 py-2 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition">
                                @error('pin_code')
                                    <span class="text-sm text-pink-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Location -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-purple-700 mb-1">Event Location</label>
                                <input type="text" wire:model="location" id="location" x-data="{ location: $wire.entangle('location') }"
                                    x-on:location-updated.window="location = $event.detail.location"
                                    class="w-full px-4 py-2 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition">
                                @error('location')
                                    <span class="text-sm text-pink-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Special Requests -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-purple-700 mb-1">Special Requests</label>
                                <textarea wire:model="special_requests" rows="3"
                                    class="w-full px-4 py-2 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition"></textarea>
                            </div>

                            <!-- Total Price -->
                            <div>
                                <label class="block text-sm font-medium text-purple-700 mb-1">Total Price</label>
                                <div
                                    class="px-4 py-2 bg-purple-50 rounded-lg border border-purple-200 text-purple-800 font-medium">
                                    ₹{{ number_format($total_price, 2) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-semibold rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                            Confirm Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Remove this script block -->
<script>
    window.addEventListener('phoneNumberExists', event => {
        alert(event.detail.message);
    });
</script>
