<div>
    <!-- Modal Backdrop -->
    @if($showModal)
        <div class="fixed inset-0 bg-white/80 backdrop-blur-sm z-40 transition-opacity" wire:click="closeModal"></div>
    @endif

    <!-- Modal Container -->
    <div class="@if(!$showModal) hidden @endif fixed inset-0 z-50 flex items-start justify-center pt-16 overflow-y-auto">
        <div class="relative mx-auto p-6 w-full max-w-2xl">
            <!-- Modal Content -->
            <div class="bg-white rounded-xl shadow-xl border border-zuppie-100 overflow-hidden transform transition-all">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-zuppie-pink-50 to-zuppie-50 px-6 py-4 border-b border-zuppie-pink-100">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-bold text-zuppie-800">Create New Offer</h3>
                        <button wire:click="closeModal" class="text-zuppie-pink-500 hover:text-zuppie-700 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                @if (session('message'))
                    <div class="mx-6 mt-4 px-4 py-3 rounded-lg bg-green-50 text-green-700 font-medium border border-green-100">
                        {{ session('message') }}
                    </div>
                @endif

                <!-- Form Content -->
                <form wire:submit.prevent="createOffer" class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Offer Title -->
                        <div>
                            <label class="block text-sm font-medium text-zuppie-700 mb-2">Offer Title</label>
                            <input type="text" wire:model.live="title" 
                                   class="w-full px-4 py-2 border border-zuppie-100 rounded-lg focus:ring-2 focus:ring-zuppie-pink-300 focus:border-zuppie-pink-400 transition">
                            @error('title') <p class="mt-1 text-sm text-zuppie-pink-600">{{ $message }}</p> @enderror
                        </div>

                        <!-- Offer Code -->
                        <div>
                            <label class="block text-sm font-medium text-zuppie-700 mb-2">Offer Code</label>
                            <input type="text" wire:model.live="offer_code" 
                                   class="w-full px-4 py-2 border border-zuppie-100 rounded-lg focus:ring-2 focus:ring-zuppie-pink-300 focus:border-zuppie-pink-400 transition">
                            @error('offer_code') <p class="mt-1 text-sm text-zuppie-pink-600">{{ $message }}</p> @enderror
                        </div>

                        <!-- Discount Type -->
                        <div>
                            <label class="block text-sm font-medium text-zuppie-700 mb-2">Discount Type</label>
                            <select wire:model.live="discount_type" 
                                    class="w-full px-4 py-2 border border-zuppie-100 rounded-lg focus:ring-2 focus:ring-zuppie-pink-300 focus:border-zuppie-pink-400 transition">
                                <option value="">Select Discount Type</option>
                                <option value="flat">Flat Amount</option>
                                <option value="percent">Percentage</option>
                            </select>
                            @error('discount_type') <p class="mt-1 text-sm text-zuppie-pink-600">{{ $message }}</p> @enderror
                        </div>

                        <!-- Discount Value -->
                        <div>
                            <label class="block text-sm font-medium text-zuppie-700 mb-2">Discount Value</label>
                            <input type="text" wire:model.live="discount_value" 
                                   class="w-full px-4 py-2 border border-zuppie-100 rounded-lg focus:ring-2 focus:ring-zuppie-pink-300 focus:border-zuppie-pink-400 transition">
                            @error('discount_value') <p class="mt-1 text-sm text-zuppie-pink-600">{{ $message }}</p> @enderror
                        </div>

                        <!-- Dates -->
                        <div>
                            <label class="block text-sm font-medium text-zuppie-700 mb-2">Start Date</label>
                            <input type="date" wire:model.live="start_date" 
                                   class="w-full px-4 py-2 border border-zuppie-100 rounded-lg focus:ring-2 focus:ring-zuppie-pink-300 focus:border-zuppie-pink-400 transition">
                            @error('start_date') <p class="mt-1 text-sm text-zuppie-pink-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-zuppie-700 mb-2">End Date</label>
                            <input type="date" wire:model.live="end_date" 
                                   class="w-full px-4 py-2 border border-zuppie-100 rounded-lg focus:ring-2 focus:ring-zuppie-pink-300 focus:border-zuppie-pink-400 transition">
                            @error('end_date') <p class="mt-1 text-sm text-zuppie-pink-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div>
                        <label class="block text-sm font-medium text-zuppie-700 mb-2">Offer Image</label>
                        <div class="flex items-center space-x-4">
                            <label class="flex flex-col items-center justify-center w-full px-4 py-6 border-2 border-dashed border-zuppie-pink-200 rounded-lg cursor-pointer bg-zuppie-pink-50 hover:bg-zuppie-pink-100 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-zuppie-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="mt-2 text-sm text-zuppie-700">Click to upload image</span>
                                <input type="file" wire:model.live="image" class="hidden">
                            </label>
                            @if($image)
                                <div class="relative">
                                    <img src="{{ $image->temporaryUrl() }}" class="h-24 w-24 object-cover rounded-lg border-2 border-zuppie-pink-200 shadow-sm">
                                    <button type="button" wire:click="$set('image', null)" class="absolute -top-2 -right-2 bg-zuppie-pink-500 text-white rounded-full p-1 hover:bg-zuppie-pink-600 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                        </div>
                        @error('image') <p class="mt-1 text-sm text-zuppie-pink-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-zuppie-700 mb-2">Description</label>
                        <textarea wire:model.live="description" rows="4" 
                                  class="w-full px-4 py-2 border border-zuppie-100 rounded-lg focus:ring-2 focus:ring-zuppie-pink-300 focus:border-zuppie-pink-400 transition" 
                                  placeholder="Enter offer details..."></textarea>
                        @error('description') <p class="mt-1 text-sm text-zuppie-pink-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Form Footer -->
                    <div class="flex justify-end space-x-3 pt-4 border-t border-zuppie-100">
                        <button type="button" wire:click="closeModal" 
                                class="px-5 py-2.5 text-sm font-medium text-zuppie-700 bg-white border border-zuppie-200 rounded-lg hover:bg-zuppie-50 transition">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-zuppie-pink-500 to-zuppie-600 rounded-lg hover:from-zuppie-pink-600 hover:to-zuppie-700 transition shadow-md">
                            Create Offer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>