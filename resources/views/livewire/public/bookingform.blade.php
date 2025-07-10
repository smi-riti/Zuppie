<div class="min-h-screen bg-gradient-to-br from-purple-400 to-pink-500 py-12 px-4 sm:px-6 lg:px-8 mt-6">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 to-pink-500 p-6 text-white">
                <h2 class="text-2xl font-bold">Create New Booking</h2>
                <p class="mt-1">Fill in the form below to book your event</p>
            </div>

            <div class="p-6">
                @if (session('message'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('message') }}
                    </div>
                @endif



                <form wire:submit.prevent="submit">
        <!-- User Information -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-4">Your Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Name -->
                <div>
                    <label class="block mb-1">Full Name</label>
                    <input type="text" wire:model="name" class="w-full p-2 border rounded">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <!-- Email -->
                <div>
                    <label class="block mb-1">Email</label>
                    <input type="email" wire:model="email" class="w-full p-2 border rounded">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <!-- Phone -->
                <div>
                    <label class="block mb-1">Phone Number</label>
                    <input type="text" wire:model="phone_no" class="w-full p-2 border rounded">
                    @error('phone_no') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Booking Information -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-4">Event Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Category -->
                <div>
                    <label class="block mb-1">Event Category</label>
                    <select wire:model="category_id" class="w-full p-2 border rounded">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <!-- Package -->
                <div>
                    <label class="block mb-1">Event Package</label>
                    <select wire:model="event_package_id" class="w-full p-2 border rounded" {{ !$packages->count() ? 'disabled' : '' }}>
                        <option value="">Select Package</option>
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}">{{ $package->name }} - ₹{{ number_format($package->price, 2) }}</option>
                        @endforeach
                    </select>
                    @error('event_package_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>



                            <div>
                                <label for="booking_date" class="block text-sm font-medium text-gray-700">Booking
                                    Date</label>
                                <input type="datetime-local" wire:model="booking_date" id="booking_date"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                @error('booking_date')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="event_date" class="block text-sm font-medium text-gray-700">Event
                                    Date</label>
                                <input type="datetime-local" wire:model="event_date" id="event_date"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                @error('event_date')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="event_end_date" class="block text-sm font-medium text-gray-700">Event End
                                    Date (Optional)</label>
                                <input type="datetime-local" wire:model="event_end_date" id="event_end_date"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                @error('event_end_date')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="guest_count" class="block text-sm font-medium text-gray-700">Number of
                                    Guests</label>
                                <input type="number" wire:model="guest_count" id="guest_count"
                                    wire:change="calculatePrice" min="1"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                @error('guest_count')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="sm:col-span-2">
                                <label for="location" class="block text-sm font-medium text-gray-700">Event
                                    Location</label>
                                <input type="text" wire:model="location" id="location"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                @error('location')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="sm:col-span-2">
                                <label for="special_requests" class="block text-sm font-medium text-gray-700">Special
                                    Requests (Optional)</label>
                                <textarea wire:model="special_requests" id="special_requests" rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500"></textarea>
                            </div>

                            <div>
                    <label class="block mb-1">Total Price</label>
                    <input type="text" value="₹{{ number_format($total_price, 2) }}" readonly class="w-full p-2 border rounded bg-gray-100">
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Book Now
            </button>
        </div>
    </form>

            </div>
        </div>
    </div>
</div>
