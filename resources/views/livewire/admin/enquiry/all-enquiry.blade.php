<div x-data="{ activeTab: 'All Enquiries' }" class="p-4">
    <!-- Tabs Navigation -->
    <div class="flex border-b border-gray-200 mb-6">
        <template x-for="tab in ['All Enquiries', 'Resolved', 'Denied']" :key="tab">
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
        <!-- All Enquiries Tab -->
        <template x-if="activeTab === 'All Enquiries'">
            <div>
                <table class="min-w-full text-left text-sm font-light rounded-lg overflow-hidden">
                    <thead class="bg-zuppie-100 text-zuppie-700">
                        <tr>
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">User Name</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3">Phone</th>
                            <th class="px-6 py-3">Message</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($enquiries as $enquiry)
                            <tr class="even:bg-gray-50 hover:bg-zuppie-pink-50 transition">
                                <td class="px-6 py-4">{{ $enquiry->id }}</td>
                                <td class="px-6 py-4">{{ $enquiry->fullname }}</td>
                                <td class="px-6 py-4">{{ $enquiry->email }}</td>
                                <td class="px-6 py-4">{{ $enquiry->phone }}</td>
                                <td class="px-6 py-4">{{ $enquiry->message }}</td>
                                <td class="px-6 py-4">
                                    <button type="button"
                                        class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition shadow"
                                        wire:click="">Mark As Resolve</button>
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

        <!-- Resolved Tab -->
        <template x-if="activeTab === 'Resolved'">
            <div>
                <table class="min-w-full text-left text-sm font-light rounded-lg overflow-hidden">
                    <thead class="bg-green-100 text-green-700">
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

                    </tbody>
                </table>
            </div>
        </template>


    </div>
</div>