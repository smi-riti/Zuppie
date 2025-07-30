<div>
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 transition-opacity duration-300" wire:click="closeEditProfileModal"></div>

    <!-- Modal Container -->
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6">
        <div class="relative w-full max-w-lg sm:max-w-xl">
            <!-- Modal Content -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all duration-300">
                <!-- Close Button -->
                <button wire:click="closeEditProfileModal" class="absolute top-3 right-3 text-zuppie-pink-500 hover:text-zuppie-pink-700 transition-colors duration-200 z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Profile Edit Form -->
                <div class="p-6 sm:p-8 space-y-6 bg-gradient-to-br from-zuppie-pink-50 to-zuppie-50 rounded-2xl">
                    <h2 class="text-2xl font-semibold text-zuppie-900">Edit Profile</h2>
                    <form wire:submit.prevent="updateProfile" class="space-y-5">
                        <!-- Name Field -->
                        <div class="space-y-2">
                            <label class="text-zuppie-800 font-medium text-sm">Full Name</label>
                            <input type="text" wire:model.defer="name" 
                                   class="w-full px-4 py-2 bg-white border border-zuppie-pink-200 rounded-lg focus:ring-2 focus:ring-zuppie-pink-400 focus:border-zuppie-pink-400 transition-colors duration-200 text-gray-800 placeholder-gray-400">
                            @error('name')
                                <span class="text-zuppie-pink-600 text-sm font-medium">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="space-y-2">
                            <label class="text-zuppie-800 font-medium text-sm">Email</label>
                            <input type="email" wire:model.defer="email" 
                                   class="w-full px-4 py-2 bg-white border border-zuppie-pink-200 rounded-lg focus:ring-2 focus:ring-zuppie-pink-400 focus:border-zuppie-pink-400 transition-colors duration-200 text-gray-800 placeholder-gray-400">
                            @error('email')
                                <span class="text-zuppie-pink-600 text-sm font-medium">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Phone Field -->
                        <div class="space-y-2">
                            <label class="text-zuppie-800 font-medium text-sm">Phone Number</label>
                            <input type="tel" wire:model.defer="phone_no" 
                                   class="w-full px-4 py-2 bg-white border border-zuppie-pink-200 rounded-lg focus:ring-2 focus:ring-zuppie-pink-400 focus:border-zuppie-pink-400 transition-colors duration-200 text-gray-800 placeholder-gray-400">
                            @error('phone_no')
                                <span class="text-zuppie-pink-600 text-sm font-medium">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Footer Actions -->
                        <div class="flex justify-end space-x-3 pt-4">
                            <button wire:click="closeEditProfileModal"
                                    class="px-4 py-2 text-zuppie-700 font-medium rounded-lg hover:bg-zuppie-pink-100 transition-colors duration-200">
                                Cancel
                            </button>
                            <button type="submit"
                                    class="px-5 py-2 bg-gradient-to-r from-zuppie-pink-500 to-zuppie-600 text-white font-medium rounded-lg hover:from-zuppie-pink-600 hover:to-zuppie-700 transition-all duration-200">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>