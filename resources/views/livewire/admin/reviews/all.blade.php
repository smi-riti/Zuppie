<div x-data="{ activeTab: 'All Reviews' }" class="">
    <!-- Tabs Navigation -->
    <div class="flex border-b border-gray-200 mb-6">
        <template x-for="tab in ['All Reviews', 'Approved', 'Denied']" :key="tab">
            <button @click="activeTab = tab"
                class="px-6 py-3 font-semibold text-sm focus:outline-none transition-all duration-150" :class="{
                    'text-zuppie-700 border-b-4 border-zuppie-pink-400 bg-zuppie-50': activeTab === tab,
                    'text-gray-500 hover:text-zuppie-700': activeTab !== tab
                }" x-text="tab">
            </button>
        </template>
    </div>

    <!-- Tab Content -->
    <div class="p-2">
        <!-- All Reviews Tab -->
        <template x-if="activeTab === 'All Reviews'">
            <div>
                <table class="min-w-full text-left text-sm font-light rounded-lg overflow-hidden">
                   
                    <thead class="bg-zuppie-100 text-zuppie-700">
                        <tr>
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">User</th>
                            <th class="px-6 py-3">Event Package Name</th>
                            <th class="px-6 py-3">Rating</th>
                            <th class="px-6 py-3">Comment</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $review)
                            <tr class="even:bg-gray-50 hover:bg-zuppie-pink-50 transition">
                                <td class="px-6 py-4">{{ $review->id }}</td>
                                <td class="px-6 py-4">{{ $review->user->name }}</td>
                                <td class="px-6 py-4">
                                    {{ $review->eventPackage->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-yellow-500 font-bold">{{ $review->rating }} &#9733;</span>
                                </td>
                                <td class="px-6 py-4">{{ $review->comment }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <button type="button"
                                        class="bg-success-500 text-white px-3 py-1 rounded hover:bg-success-600 transition shadow"
                                        wire:click="approving({{ $review->id }})">Approve</button>
                                    <button
                                        class="bg-error-500 text-white px-3 py-1 rounded hover:bg-error-600 transition shadow"
                                        >Deny</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-400">No reviews found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </template>

        <!-- Approved Tab -->
        <template x-if="activeTab === 'Approved'">
            <div>
                <table class="min-w-full text-left text-sm font-light rounded-lg overflow-hidden">
                    <thead class="bg-success-100 text-success-700">
                        <tr>
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">User</th>
                            <th class="px-6 py-3">Event Package Name</th>
                            <th class="px-6 py-3">Rating</th>
                            <th class="px-6 py-3">Comment</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($approvedReviews as $apvr)
                            <tr class="even:bg-gray-50 hover:bg-success-50 transition">
                                <td class="px-6 py-4">{{ $apvr->id }}</td>
                                <td class="px-6 py-4">{{ $apvr->user->name }}</td>
                                <td class="px-6 py-4">
                                    {{ $apvr->eventPackage->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-yellow-500 font-bold">{{ $apvr->rating }} &#9733;</span>
                                </td>
                                <td class="px-6 py-4">{{ $apvr->comment }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <button
                                        class="bg-success-500 text-white px-3 py-1 rounded hover:bg-success-600 transition shadow"
                                        wire:click="">Something</button>
                                  
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-400">No approved reviews.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </template>

        
    </div>
</div>