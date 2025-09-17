<div class="p-4 lg:p-6 bg-white">
    <!-- Flash Messages -->
    @if (session('message'))
        <div class="mb-6">
            <div class="px-4 py-3 rounded-lg bg-green-50 text-green-700 font-medium border border-green-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                {{ session('message') }}
            </div>
        </div>
    @endif

    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl text-purple-800">All Offers</h2>
            <p class="text-sm text-purple-500 mt-1">
                {{ $offers->total() }} {{ Str::plural('offer', $offers->total()) }} available
            </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
            <!-- Search -->
            <div class="relative">
                <input type="text" wire:model.live.debounce.300ms="search" 
                       placeholder="Search offers..." 
                       class="w-full sm:w-64 px-4 py-2 pl-10 border border-purple-200 rounded-lg focus:ring-2 focus:ring-pink-300 focus:border-pink-400 transition">
                <svg class="absolute left-3 top-2.5 h-5 w-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <!-- Add Button -->
            <button wire:click="$dispatch('open-create-offer-modal')"
                class="flex items-center justify-center gap-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-medium py-2.5 px-5 rounded-lg transition shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add New Offer
            </button>
        </div>
    </div>

    <!-- Offers Table -->
    <div class="overflow-x-auto rounded-lg border border-purple-100 shadow-sm">
        <table class="w-full">
            <thead class="bg-gradient-to-r from-pink-50 to-purple-50">
                <tr>
                    <th class="px-4 lg:px-6 py-3 text-left text-xs font-2xl text-purple-700 uppercase tracking-wider">Image</th>
                    <th class="px-4 lg:px-6 py-3 text-left text-xs font-2xl text-purple-700 uppercase tracking-wider">Title</th>
                    <th class="px-4 lg:px-6 py-3 text-left text-xs font-2xl text-purple-700 uppercase tracking-wider">Code</th>
                    <th class="px-4 lg:px-6 py-3 text-left text-xs font-2xl text-purple-700 uppercase tracking-wider">Discount</th>
                    <th class="px-4 lg:px-6 py-3 text-left text-xs font-2xl text-purple-700 uppercase tracking-wider">Period</th>
                    <th class="px-4 lg:px-6 py-3 text-left text-xs font-2xl text-purple-700 uppercase tracking-wider">Status</th>
                    <th class="px-4 lg:px-6 py-3 text-right text-xs font-2xl text-purple-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-purple-100">
                @forelse($offers as $offer)
                    <tr class="hover:bg-pink-50 transition-colors">
                        <td class="px-4 lg:px-6 py-4 whitespace-nowrap">
                            @if($offer->image)
                                <img src="{{ $offer->image }}" alt="{{ $offer->title }}" class="h-12 w-12 rounded-lg object-cover border border-purple-200">
                            @else
                                <div class="h-12 w-12 rounded-lg bg-purple-100 flex items-center justify-center">
                                    <svg class="h-6 w-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-4 lg:px-6 py-4">
                            <div class="text-sm font-medium text-purple-900">{{ $offer->title }}</div>
                            <div class="text-sm text-purple-500">ID: #{{ $offer->id }}</div>
                        </td>
                        <td class="px-4 lg:px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">
                                {{ $offer->offer_code }}
                            </span>
                        </td>
                        <td class="px-4 lg:px-6 py-4 whitespace-nowrap text-sm text-purple-900">
                            @if($offer->discount_type === 'percent')
                                {{ $offer->discount_value }}%
                            @else
                                ₹{{ number_format($offer->discount_value, 0) }}
                            @endif
                        </td>
                        <td class="px-4 lg:px-6 py-4 whitespace-nowrap text-sm text-purple-500">
                            <div>{{ \Carbon\Carbon::parse($offer->start_date)->format('M d, Y') }}</div>
                            <div>{{ \Carbon\Carbon::parse($offer->end_date)->format('M d, Y') }}</div>
                        </td>
                        <td class="px-4 lg:px-6 py-4 whitespace-nowrap">
                            @if($offer->is_active && \Carbon\Carbon::parse($offer->end_date)->isFuture())
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Active
                                </span>
                            @elseif(\Carbon\Carbon::parse($offer->end_date)->isPast())
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    Expired
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td class="px-4 lg:px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <button wire:click="$dispatch('edit-offer', { id: {{ $offer->id }} })" 
                                        class="text-purple-600 hover:text-purple-900 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button wire:click="confirmDelete({{ $offer->id }})" 
                                        class="text-red-600 hover:text-red-900 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-purple-700 mb-2">No offers found</h3>
                                <p class="text-purple-500 mb-4">
                                    @if($search)
                                        No offers match your search criteria.
                                    @else
                                        Get started by creating your first offer.
                                    @endif
                                </p>
                                @if(!$search)
                                    <button wire:click="$dispatch('open-create-offer-modal')"
                                        class="bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-medium py-2 px-4 rounded-lg transition">
                                        Create Your First Offer
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($offers->hasPages())
        <div class="mt-6">
            {{ $offers->links() }}
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if ($confirmingDeletion)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6 border-2 border-pink-300">
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <h3 class="text-lg text-gray-900 mb-2">Delete Offer</h3>
                    <p class="text-sm text-gray-500 mb-6">
                        Are you sure you want to delete this offer? This action cannot be undone.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-2 sm:gap-4">
                        <button wire:click="cancelDelete" 
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                            Cancel
                        </button>
                        <button wire:click="deleteOffer" 
                                class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition">
                            Delete Offer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Livewire Modals -->
    <livewire:admin.offers.create-offer />
    <livewire:admin.offers.update />
</div>
