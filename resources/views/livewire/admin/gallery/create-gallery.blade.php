<div class="fixed inset-0 backdrop-blur-sm bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full p-6 border-2 border-purple-300">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-purple-700">Upload Gallery Images</h3>
            <button wire:click="$emit('closeModal')" class="text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form wire:submit.prevent="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload Images *</label>
                    <input type="file" wire:model="images" multiple id="images" class="hidden">
                    <label for="images"
                        class="cursor-pointer bg-purple-100 hover:bg-purple-200 text-purple-700 px-4 py-2 rounded-lg transition inline-block">
                        Select Images
                    </label>
                    <p class="text-gray-500 text-sm mt-1">Max 2MB per image</p>

                    @error('images.*')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror

                    <div class="mt-4 grid grid-cols-3 gap-4">
                        @foreach ($images as $index => $image)
                            <div class="relative">
                                <img src="{{ $image->temporaryUrl() }}" alt="Preview"
                                    class="h-32 w-full object-cover rounded-lg border border-purple-200">
                                <button type="button" wire:click="removeImage({{ $index }})"
                                    class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label for="alt" class="block text-sm font-medium text-gray-700 mb-1">Alt Text</label>
                    <input type="text" wire:model="alt" id="alt"
                        class="w-full px-4 py-2 border border-purple-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-200 focus:border-purple-300">
                    @error('alt')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select wire:model="category_id" id="category_id"
                        class="w-full px-4 py-2 border border-purple-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-200 focus:border-purple-300">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <!-- Use $categories -->
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea wire:model="description" id="description" rows="3"
                        class="w-full px-4 py-2 border border-purple-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-200 focus:border-purple-300"></textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button type="button" wire:click="$dispatch('closeModal')"
                    class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-lg hover:from-purple-600 hover:to-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-300">
                    Upload Images
                </button>
            </div>
        </form>
    </div>
</div>
