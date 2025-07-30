<div class="p-6 bg-white  ">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-zuppie-800">All Offers</h2>
            <p class="text-sm text-zuppie-500 mt-1">
                {{ count($offers) }} {{ Str::plural('offer', count($offers)) }} available
            </p>
        </div>
        <button wire:click="$dispatch('open-create-offer-modal')"
            class="flex items-center gap-2 bg-gradient-to-r from-zuppie-pink-500 to-zuppie-600 hover:from-zuppie-pink-600 hover:to-zuppie-700 text-white font-medium py-2.5 px-5 rounded-lg transition shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Add New Offer
        </button>
    </div>

    <!-- Offers Table -->
    <div class="overflow-x-auto rounded-lg border border-zuppie-100">
        <table class="w-full">
            <thead class="bg-gradient-to-r from-zuppie-pink-50 to-zuppie-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-zuppie-700 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-zuppie-700 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-zuppie-700 uppercase tracking-wider">Code</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-zuppie-700 uppercase tracking-wider">Discount</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-zuppie-700 uppercase tracking-wider">Period</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-zuppie-700 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-zuppie-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zuppie-100">
                @forelse($offers as $offer)
                    <tr class="hover:bg-zuppie-pink-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-zuppie-900">#{{ $offer->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zuppie-800 font-medium">{{ $offer->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zuppie-600 font-mono">{{ $offer->offer_code }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zuppie-900">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                @if($offer->discount_type === 'percent') bg-zuppie-pink-100 text-zuppie-pink-800
                                @else bg-zuppie-100 text-zuppie-800 @endif">
                                {{ $offer->discount_value }} 
                                {{ $offer->discount_type === 'percent' ? '%' : '₹' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zuppie-700">
                            {{ Carbon\Carbon::parse($offer->start_date)->format('M d') }} - 
                            {{ Carbon\Carbon::parse($offer->end_date)->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                @if($offer->is_active === 1) bg-zuppie-pink-100 text-zuppie-pink-800
                                @else bg-zuppie-100 text-zuppie-800 @endif">
                                {{ $offer->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end gap-2">
                                <button wire:click="$dispatch('edit-offer', {id: {{ $offer->id }}})"
                                    class="text-zuppie-pink-600 hover:text-zuppie-pink-800 transition-colors p-1.5 rounded-lg hover:bg-zuppie-pink-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button wire:click="confirmDelete({{ $offer->id }})"
                                    class="text-red-500 hover:text-red-700 transition-colors p-1.5 rounded-lg hover:bg-red-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-zuppie-500">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-zuppie-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-lg font-medium text-zuppie-400">No offers found</p>
                                <p class="text-sm text-zuppie-300">Create your first offer to get started</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

   

    <!-- Livewire Modals -->
    <livewire:admin.offers.create-offer />
    <livewire:admin.offers.update />
</div>