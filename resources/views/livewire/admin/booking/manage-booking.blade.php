<div class="min-h-screen bg-gradient-to-br from-purple-50 to-pink-50 p-4 sm:p-6">
    <div class="">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-purple-800">Manage Bookings</h1>
                <p class="text-purple-600">View and manage all event bookings</p>
            </div>
            <button wire:click="openCreateModal" 
                    class="flex items-center px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-500 text-white rounded-lg shadow-md hover:from-purple-700 hover:to-pink-600 transition-all">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Create Booking
            </button>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">Event Details</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">Date & Time</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">Location/Pincode</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-purple-200">
                        @forelse ($bookings as $booking)
                            <tr class="hover:bg-purple-50">
                                <!-- Customer Column -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-r from-purple-400 to-pink-400 flex items-center justify-center text-white font-bold">
                                            {{ strtoupper(substr($booking->user->name, 0, 1)) }}
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-purple-900">{{ $booking->user->name }}</div>
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
                                    <div class="text-sm text-purple-600">{{ $booking->event_date->format('h:i A') }}</div>
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
                                            <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>

                                        <!-- Status Change Modal -->
                                        <div x-show="showStatusChangeModal" @click.away="showStatusChangeModal = false"
                                            class="absolute z-10 mt-1 w-48 bg-white rounded-md shadow-lg border border-gray-200 py-1">
                                            <div class="px-3 py-2 text-xs text-gray-500 border-b">
                                                Change Status
                                            </div>

                                            @foreach ($statusOptions as $status)
                                                @if ($status !== $booking->status)
                                                    @if (($booking->status === 'confirmed' && $status === 'cancelled') || ($booking->status === 'pending' && $status === 'confirmed'))
                                                        <button @click="if(confirm('Are you sure you want to change status to {{ $status }}? This action requires admin approval.')) { $wire.updateStatus({{ $booking->id }}, '{{ $status }}'); showStatusChangeModal = false; }"
                                                            class="block w-full text-left px-4 py-2 text-xs hover:bg-gray-100">
                                                            {{ ucfirst($status) }}
                                                        </button>
                                                    @else
                                                        <button @click="$wire.updateStatus({{ $booking->id }}, '{{ $status }}'); showStatusChangeModal = false;"
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
                            <!-- Edit Button -->
                            <button wire:click="openUpdateModal({{ $booking->id }})"
                                class="p-2 bg-purple-100 text-purple-600 rounded-lg hover:bg-purple-200 transition shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15.414 9 16l.586-2.828L18.414 4.586z">
                                    </path>
                                </svg>
                            </button>
                            
                            <!-- Delete Button -->
                            <button wire:click="confirmDelete({{ $booking->id }})" 
                                class="p-2 bg-pink-100 text-pink-600 rounded-lg hover:bg-pink-200 transition shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
    @if ($showCreateModal)
    <livewire:admin.booking.create-booking :key="'create-booking-'.now()" />
@endif

<!-- Update Booking Modal -->
@if ($showUpdateModal)
    <livewire:admin.booking.update-booking 
        :bookingId="$bookingIdToUpdate" 
        :key="'update-booking-'.$bookingIdToUpdate" />
@endif


    <!-- Delete Confirmation Modal -->
    @if ($confirmingDeletion)
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <div class="flex items-center mb-4">
                <svg class="w-6 h-6 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <h3 class="text-lg font-medium">Confirm Deletion</h3>
            </div>
            <p class="mb-4">Are you sure you want to delete this booking? This action cannot be undone.</p>
            <div class="flex justify-end space-x-3">
                <button wire:click="closeModals" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                    Cancel
                </button>
                <button wire:click="deleteBooking"
                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                    Delete
                </button>
            </div>
        </div>
    </div>
    @endif

</div>