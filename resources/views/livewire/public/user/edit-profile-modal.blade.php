<div>
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/30 backdrop-blur-sm z-40 transition-opacity" wire:click="closeEditProfileModal">
    </div>

    <!-- Modal Container -->
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4" wire:click.stop>
        <div class="relative mx-auto w-full max-w-4xl">
            <!-- Modal Content -->
            <div class="bg-white rounded-xl shadow-2xl overflow-hidden" wire:click.stop>
                <!-- Close button -->
                <button wire:click="closeEditProfileModal"
                    class="absolute top-4 right-4 text-gray-500 hover:text-purple-600 transition-colors z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Profile Edit Form -->
                <div class="p-6 md:p-8 space-y-6 max-h-[80vh] overflow-y-auto bg-gray-50 rounded-lg shadow-sm">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Profile</h2>
                    <form wire:submit.prevent="updateProfile">
                        <div class="space-y-4">
                            <!-- Name Field -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                <label class="text-gray-700 font-medium">Full Name</label>
                                <div class="md:col-span-2">
                                    <input type="text" wire:model.defer="name" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                    @error('name')
                                        <span class="text-red-500 font-semibold">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email Field -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                <label class="text-gray-700 font-medium">Email</label>
                                <div class="md:col-span-2">
                                    <input type="email" wire:model.defer="email" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                    @error('email')
                                        <span class="text-red-500 font-semibold">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Phone Field -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                                <label class="text-gray-700 font-medium">Phone Number</label>
                                <div class="md:col-span-2">
                                    <input type="tel" wire:model.defer="phone_no" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                    @error('phone_no')
                                        <span class="text-red-500 font-semibold">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Footer Actions -->
                        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                            <button wire:click="closeEditProfileModal"
                                class="px-4 py-2 text-gray-700 hover:text-purple-600 font-medium rounded-lg transition-colors">
                                Cancel
                            </button>
                            <button
                                class="px-6 py-2 bg-purple-600 text-white font-medium rounded-lg hover:bg-purple-700 transition-colors">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>