<div>
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 transition-opacity duration-300"
        wire:click="closeViewModal"></div>

    <!-- Modal Container -->
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6">
        <div class="relative w-full max-w-lg sm:max-w-xl">
            <!-- Modal Content -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all duration-300">
                <!-- Close Button -->
                <button wire:click="closeViewModal"
                    class="absolute top-3 right-3 text-pink-500 hover:text-pink-700 transition-colors duration-200 z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Profile Edit Form -->
                <div class="p-6 sm:p-8 space-y-6 bg-gradient-to-br from-pink-50 to-purple-50 rounded-2xl">
                    <h2 class="text-2xl font-semibold text-purple-900">Query of user</h2>
                    <h1>{{$enquiryDetails->message}}</h1>
                    @if ($enquiryDetails->status == 'pending')
                        <button wire:click="markResolved({{ $enquiryDetails->id }})"
                            class="bg-green-500 gap-2 font-semibold text-sm px-2 py-1 rounded text-white flex items-center">
                            <i class="fa-solid fa-circle-check" style="color: #03a800;"></i>
                            Mark as Resolved</button>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>