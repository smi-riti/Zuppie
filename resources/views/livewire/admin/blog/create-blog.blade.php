<div>
    @if ($showModal)
        <div class="fixed inset-0 backdrop-blur-sm bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full p-6 border-2 border-zuppie-300">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-zuppie-700">Create New Blog Post</h3>
                    <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <form wire:submit.prevent="saveBlog">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
                            <input type="text" wire:model="form.title" id="title"
                                class="w-full px-4 py-2 border border-zuppie-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-zuppie-pink-200 focus:border-zuppie-300">
                            @error('form.title') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug *</label>
                            <input type="text" wire:model="form.slug" id="slug"
                                class="w-full px-4 py-2 border border-zuppie-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-zuppie-pink-200 focus:border-zuppie-300">
                            @error('form.slug') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                       
                        <div class="md:col-span-2">
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content *</label>
                            <textarea wire:model="form.content" id="content" rows="6"
                                class="w-full px-4 py-2 border border-zuppie-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-zuppie-pink-200 focus:border-zuppie-300"></textarea>
                            @error('form.content') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Featured Image</label>
                            <div class="flex items-center">
                                @if ($image)
                                    <img src="{{ is_string($image) ? $image : $image->temporaryUrl() }}" 
                                        alt="Preview" class="h-32 w-32 object-cover rounded-lg mr-4 border border-zuppie-200">
                                @endif
                                <input type="file" wire:model="image" id="image" class="hidden">
                                <label for="image" class="cursor-pointer bg-zuppie-100 hover:bg-zuppie-200 text-zuppie-700 px-4 py-2 rounded-lg transition">
                                    {{ $image ? 'Change Image' : 'Upload Image' }}
                                </label>
                            </div>
                            @error('image') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="inline-flex items-center mt-6">
                                <input type="checkbox" wire:model="form.is_published" class="rounded border-zuppie-300 text-zuppie-pink-600 shadow-sm focus:border-zuppie-pink-300 focus:ring focus:ring-zuppie-pink-200 focus:ring-opacity-50">
                                <span class="ml-2 text-gray-700">Publish immediately</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" wire:click="closeModal" 
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300">
                            Cancel
                        </button>
                        <button type="submit" 
                            class="px-4 py-2 bg-gradient-to-r from-zuppie-pink-500 to-zuppie-600 text-white rounded-lg hover:from-zuppie-600 hover:to-zuppie-pink-500 focus:outline-none focus:ring-2 focus:ring-zuppie-pink-300">
                            Create Blog
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>