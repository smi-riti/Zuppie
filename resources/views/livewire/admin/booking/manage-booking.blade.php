<div class="min-h-screen bg-gradient-to-br from-purple-50 to-pink-50 p-4 sm:p-6">
    <div class="">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-purple-800">Manage Bookings</h1>
                <p class="text-purple-600">View and manage all event bookings</p>
            </div>
        </div>

        @if (session()->has('message'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ session('message') }}
            </div>
        @endif

        <!-- Filters -->
        <div class="mb-6 grid grid-cols-1 md:grid-cols-5 gap-4">
            <!-- Search -->
            <div class="md:col-span-2">
                <div class="relative">
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search bookings..."
                        class="w-full pl-10 pr-4 py-2 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Status Filter -->
            <div>
                <select wire:model.live="statusFilter"
                    class="w-full pl-10 pr-4 py-2 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition">
                    <option value="">All Status</option>
                    @foreach ($statusOptions as $status)
                        <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h7"></path>
                    </svg>
                </div>
            </div>

            <!-- User Filter -->
            <div>
                <select wire:model.live="userFilter"
                    class="w-full pl-10 pr-4 py-2 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition">
                    <option value="">All Users</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            </div>

            <!-- Package Filter -->
            <div>
                <select wire:model.live="packageFilter"
                    class="w-full pl-10 pr-4 py-2 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition">
                    <option value="">All Packages</option>
                    @foreach ($packages as $package)
                        <option value="{{ $package->id }}">{{ $package->name }}</option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Bookings Table -->
        <div class="bg-white rounded-xl shadow-lg border border-purple-200">
            <div class="p-3 border-b border-purple-200 bg-purple-50">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-purple-600">
                        <span class="font-medium">{{ $bookings->total() }}</span> bookings found
                        @if (!empty($search) || !empty($statusFilter) || !empty($userFilter) || !empty($packageFilter))
                            <span class="ml-1">
                                with current filters
                                <button
                                    wire:click="$set('search', ''); $set('statusFilter', ''); $set('userFilter', ''); $set('packageFilter', '');"
                                    class="ml-2 text-purple-600 hover:text-purple-800 underline text-xs focus:outline-none">
                                    Clear filters
                                </button>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-purple-200">
                    <thead class="bg-purple-50">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">
                                Customer</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">
                                Event Details</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">
                                Date & Time</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">
                                Location/Pincode</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">
                                Amount</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-purple-200">
                        @forelse ($bookings as $booking)
                            <tr class="hover:bg-purple-50">
                                <!-- Customer Column -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-r from-purple-400 to-pink-400 flex items-center justify-center text-white font-bold">
                                            {{ strtoupper(substr($booking->user->name, 0, 1)) }}
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-purple-900">{{ $booking->user->name }}
                                            </div>
                                            <div class="text-sm text-purple-600">{{ $booking->user->email }}</div>
                                            <div class="text-xs text-purple-500">{{ $booking->user->phone_no }}</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Event Details Column -->
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-purple-900">
                                        {{ $booking->eventPackage->category->name ?? 'N/A' }} -
                                        {{ $booking->eventPackage->name }}</div>
                                    <div class="text-xs text-purple-500 mt-1">{{ $booking->guest_count }} guests</div>
                                    @if ($booking->special_requests)
                                        <div class="text-xs text-pink-600 mt-1 italic">
                                            "{{ Str::limit($booking->special_requests, 30) }}"</div>
                                    @endif
                                </td>

                                <!-- Date & Time Column -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-purple-900">
                                        {{ $booking->event_date->format('M d, Y') }}</div>
                                    <div class="text-sm text-purple-600">{{ $booking->event_date->format('h:i A') }}
                                    </div>
                                </td>

                                <!-- Location/Pincode Column -->
                                <td class="px-6 py-4">
                                    <div class="text-sm text-purple-900">{{ Str::limit($booking->location, 20) }}</div>
                                    <div class="text-xs text-purple-500">{{ $booking->pin_code }}</div>
                                </td>

                                <!-- Status Column -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div x-data="{ showStatusChangeModal: false, selectedStatus: '{{ $booking->status }}' }" class="relative">
                                        <!-- Status Badge with Change Option -->
                                        <button @click="showStatusChangeModal = true"
                                            class="px-3 py-1 text-xs font-semibold rounded-full 
                                                {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200' : '' }}
                                                {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-800 hover:bg-green-200' : '' }}
                                                {{ $booking->status === 'cancelled' ? 'bg-red-100 text-red-800 hover:bg-red-200' : '' }}
                                                transition cursor-pointer flex items-center">
                                            {{ ucfirst($booking->status) }}
                                            <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>

                                        <!-- Status Change Modal -->
                                        <div x-show="showStatusChangeModal"
                                            @click.away="showStatusChangeModal = false"
                                            class="absolute z-10 mt-1 w-48 bg-white rounded-md shadow-lg border border-gray-200 py-1">
                                            <div class="px-3 py-2 text-xs text-gray-500 border-b">
                                                Change Status
                                            </div>

                                            <!-- Condition 1: Only allow specific status changes -->
                                            @foreach ($statusOptions as $status)
                                                @if ($status !== $booking->status)
                                                    <!-- Condition 2: For certain status changes, require admin approval -->
                                                    @if (
                                                        ($booking->status === 'confirmed' && $status === 'cancelled') ||
                                                            ($booking->status === 'pending' && $status === 'confirmed'))
                                                        <button
                                                            @click="
                                                                if(confirm('Are you sure you want to change status to {{ $status }}? This action requires admin approval.')) {
                                                                    $wire.updateStatus({{ $booking->id }}, '{{ $status }}');
                                                                    showStatusChangeModal = false;
                                                                }
                                                            "
                                                            class="block w-full text-left px-4 py-2 text-xs hover:bg-gray-100">
                                                            {{ ucfirst($status) }}
                                                        </button>
                                                    @else
                                                        <button
                                                            @click="
                                                                $wire.updateStatus({{ $booking->id }}, '{{ $status }}');
                                                                showStatusChangeModal = false;
                                                            "
                                                            class="block w-full text-left px-4 py-2 text-xs hover:bg-gray-100">
                                                            {{ ucfirst($status) }}
                                                        </button>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </td>

                                <!-- Amount Column -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-purple-900">
                                    ₹{{ number_format($booking->total_price, 2) }}
                                </td>

                                <!-- Actions Column -->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button wire:click="openViewModal({{ $booking->id }})"
                                            class="p-2 bg-purple-100 text-purple-600 rounded-lg hover:bg-purple-200 transition shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </button>
                                        <button wire:click="openDeleteModal({{ $booking->id }})"
                                            class="p-2 bg-pink-100 text-pink-600 rounded-lg hover:bg-pink-200 transition shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-sm text-purple-600">
                                    No bookings found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-purple-200">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>

    <!-- View Modal -->
    @if ($showViewModal)
        <livewire:admin.booking.view-booking :bookingId="$bookingIdToView" />
    @endif

    <!-- Delete Confirmation Modal -->
    @if ($showDeleteModal)
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50"
            x-data="{ show: true }" x-show="show" x-transition wire:ignore.self>
            <div
                class="relative bg-white rounded-xl shadow-2xl w-full max-w-md p-6 transform transition-all animate-fade-in">
                <div class="flex items-center mb-6 pb-3 border-b border-gray-200">
                    <div class="bg-red-100 p-2 rounded-lg mr-3">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">Confirm Delete</h3>
                </div>

                <div class="p-4 mb-5 bg-yellow-50 text-yellow-800 rounded-lg border border-yellow-200">
                    <p class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-yellow-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Are you sure you want to delete this booking? This action cannot be undone.
                    </p>
                </div>

                <div class="flex justify-end space-x-3">
                    <button wire:click="$set('showDeleteModal', false)"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel
                    </button>
                    <button wire:click="deleteBooking"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        Delete
                    </button>
                </div>
                <!-- Add this right after your table, inside the white rounded-xl div -->
                @if ($bookings->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $bookings->links() }}
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
