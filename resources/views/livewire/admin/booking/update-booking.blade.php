<div class="fixed inset-0 backdrop-blur-sm bg-black/30 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden w-full max-w-4xl max-h-[90vh] overflow-y-auto">
        <!-- Gradient Header -->
        <div class="bg-gradient-to-r from-purple-400 to-pink-400 p-8 text-white">
            <h2 class="text-3xl text-center">Update Booking</h2>
            <p class="mt-2 text-center text-purple-100">Update the booking details</p>
        </div>

        <!-- Form Content --> 
        <div class="p-8">
            @if (session('message'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded">
                    {{ session('message') }}
                </div>
            @endif

            <form wire:submit.prevent="update" class="space-y-6">
                <!-- User Information Section -->
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold text-purple-800 border-b-2 border-purple-100 pb-2">
                        Customer Information
                    </h3>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-purple-700 mb-1">Full Name (User)</label>
                            <input type="text" value="{{ $name }}" readonly
                                class="w-full px-4 py-2 rounded-lg border border-purple-200 bg-gray-100 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition">
                            <label class="block text-sm font-medium text-purple-700 mb-1">Full Name</label>
                            <input type="text" wire:model="booking_name"
                                class="w-full px-4 py-2 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition">
                            @error('booking_name')
                                <span class="text-sm text-pink-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-purple-700 mb-1">Email (User)</label>
                            <input type="email" value="{{ $email }}" readonly
                                class="w-full px-4 py-2 rounded-lg border border-purple-200 bg-gray-100 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition">
                            <label class="block text-sm font-medium text-purple-700 mb-1">Email</label>
                            <input type="email" wire:model="booking_email"
                                class="w-full px-4 py-2 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition">
                            @error('booking_email')
                                <span class="text-sm text-pink-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label class="block text-sm font-medium text-purple-700 mb-1">Phone Number (User)</label>
                            <input type="text" value="{{ $phone_no }}" readonly
                                class="w-full px-4 py-2 rounded-lg border border-purple-200 bg-gray-100 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition">
                            <label class="block text-sm font-medium text-purple-700 mb-1">Phone Number</label>
                            <input type="text" wire:model="booking_phone_no"
                                class="w-full px-4 py-2 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition">
                            @error('booking_phone_no')
                                <span class="text-sm text-pink-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold text-purple-800 border-b-2 border-purple-100 pb-2">
                        Event Details
                    </h3>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Package -->
                        <div>
                            <label class="block text-sm font-medium text-purple-700 mb-1">Event Package</label>
                            <select wire:model="event_package_id" wire:change="calculateTotal"
                                class="w-full px-4 py-2 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition">
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
                            <input type="number" wire:model="guest_count" min="1" wire:change="calculateTotal"
                                class="w-full px-4 py-2 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition">
                            @error('guest_count')
                                <span class="text-sm text-pink-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- PIN Code -->
                        <div>
                            <label class="block text-sm font-medium text-purple-700 mb-1">PIN Code</label>
                            <div class="relative">
                                <input type="text" wire:model="pin_code"
                                    class="w-full px-4 py-2 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition"
                                    maxlength="6">
                                @error('pin_code')
                                    <span class="text-sm text-pink-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Location Field -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-purple-700 mb-1">Event Location</label>
                            <input type="text" wire:model="location"
                                class="w-full px-4 py-2 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition"
                                placeholder="Enter event location">
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

                <!-- Action Buttons -->
                <div class="pt-4 flex justify-end space-x-4">
                    <button type="button" wire:click="closeModal"
                        class="px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg shadow-md transition">
                        Cancel
                </button>
                    <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-semibold rounded-lg shadow-md transition">
                        Update Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>