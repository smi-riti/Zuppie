<div>
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/30 z-40 transition-opacity duration-200" wire:click="closeViewModal"></div>

    <!-- Modal Container -->
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6">
        <div class="relative w-full max-w-md">
            <!-- Modal Content -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
                <!-- Close Button -->
                <button wire:click="closeViewModal"
                    class="absolute top-4 right-4 bg-white rounded-full p-1.5 shadow-sm border border-gray-200 hover:bg-gray-50 transition-colors duration-150 z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 hover:text-gray-700"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Content Area -->
                <div class="p-6 space-y-4">
                    <!-- Header -->
                    <div class="flex items-start justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">User Enquiry</h2>
                            <span class="text-xs font-medium px-2 py-1 rounded-full 
                                @if($enquiryDetails->status == 'pending') bg-amber-100 text-amber-800
                                @else bg-green-100 text-green-800 @endif">
                                {{ ucfirst($enquiryDetails->status) }}
                            </span>
                        </div>


                    </div>

                    <!-- Message Card -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <p class="text-gray-700 whitespace-pre-line">{{ $enquiryDetails->message }}</p>
                    </div>

                    <!-- Metadata -->
                    <div class="flex justify-between items-center">
                        <div class="text-xs text-gray-500">
                            <p>Submitted On: {{ $enquiryDetails->created_at->format('M j, Y \a\t g:i A') }}</p>
                            @if($enquiryDetails->status == 'resolved')
                                <p>Resolved On: {{ $enquiryDetails->updated_at->format('M j, Y \a\t g:i A') }}</p>
                            @endif
                        </div>
                        @if ($enquiryDetails->status == 'pending')
                            <button wire:click="markResolved({{ $enquiryDetails->id }})"
                                class="bg-green-600 hover:bg-green-700 text-white text-sm font-medium py-2 px-3 rounded-lg transition-colors duration-150 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Mark Resolved
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>