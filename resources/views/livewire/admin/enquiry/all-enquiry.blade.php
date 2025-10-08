<div x-data="{ activeTab: 'All Enquiries' }" class="p-4">
    <!-- Enhanced Tabs Navigation -->
    <div class="flex mb-6">
        <div class="flex space-x-1 rounded-lg bg-gray-100 p-1">
            <template x-for="tab in ['All Enquiries', 'Resolved']" :key="tab">
                <button 
                    @click="activeTab = tab"
                    class="px-6 py-2.5 text-sm font-medium rounded-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
                    :class="{
                        'bg-white shadow-sm text-purple-700': activeTab === tab,
                        'text-gray-600 hover:text-purple-700 hover:bg-white/50': activeTab !== tab
                    }" 
                    x-text="tab">
                </button>
            </template>
        </div>
    </div>

    <!-- Tab Content -->
    <div class="p-2">
        <!-- All Enquiries Tab -->
        <template x-if="activeTab === 'All Enquiries'">
            <div class="overflow-hidden rounded-xl border border-gray-200 shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-purple-50 to-pink-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs text-purple-700 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs text-purple-700 uppercase">User Name</th>
                            <th class="px-6 py-3 text-left text-xs text-purple-700 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs text-purple-700 uppercase">Phone</th>
                            <th class="px-6 py-3 text-left text-xs text-purple-700 uppercase">Message</th>
                            <th class="px-6 py-3 text-left text-xs text-purple-700 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($enquiries as $enquiry)
                            <tr class="hover:bg-purple-50/50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $enquiry->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $enquiry->fullname }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $enquiry->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $enquiry->phone }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 max-w-xs truncate">{{ $enquiry->message }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all"
                                        wire:click="openEnquiryViewModal({{ $enquiry->id }})">
                                        View
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                    <div class="flex flex-col items-center justify-center p-6">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="mt-2 text-gray-600">No enquiries found</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </template>

        <!-- Resolved Tab -->
        <template x-if="activeTab === 'Resolved'">
            <div class="overflow-hidden rounded-xl border border-gray-200 shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-green-50 to-emerald-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-2xl text-green-700 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-2xl text-green-700 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-2xl text-green-700 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-2xl text-green-700 uppercase tracking-wider">Phone</th>
                            <th class="px-6 py-3 text-left text-xs font-2xl text-green-700 uppercase tracking-wider">Message</th>
                            <th class="px-6 py-3 text-left text-xs font-2xl text-green-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($resolvedEnquiry as $enquiry)
                            <tr class="hover:bg-green-50/50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $enquiry->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $enquiry->fullName }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $enquiry->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $enquiry->phone }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 max-w-xs truncate">{{ $enquiry->message }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all"
                                        wire:click="openEnquiryViewModal({{ $enquiry->id }})">
                                        View
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                    <div class="flex flex-col items-center justify-center p-6">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="mt-2 text-gray-600">No resolved enquiries found</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </template>
    </div>

    <!-- livewire modals -->
    @if ($showViewModal)
        <livewire:admin.enquiry.view-enquiry :enquiryId="$enquiryIdToView"/>
    @endif
</div>