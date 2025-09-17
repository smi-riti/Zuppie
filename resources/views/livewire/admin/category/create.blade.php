<div x-data="{ show: @entangle('showModal') }" x-show="show" class="fixed z-50 inset-0 top-28 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Backdrop -->
        <div x-show="show" class="fixed inset-0  backdrop-blur-sm transition-opacity" @click="show = false">
        </div>

        <!-- Modal panel -->
        <div x-show="show" 
             x-transition:enter="ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl border-2 border-pink-100 transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full relative z-10">
            
            <!-- Header -->
            <div class="bg-gradient-to-r from-pink-500 to-purple-600 px-8 py-6">
                <h3 class="text-2xl  text-white text-center">
                    {{ $editingId ? 'Edit Category' : 'Create New Category' }}
                </h3>
                <p class="text-pink-100 text-center mt-1">
                    {{ $editingId ? 'Update category information' : 'Add a new category to your system' }}
                </p>
            </div>

            <div class="px-8 py-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-5">
                        <!-- Category Name -->
                        <div>
                            <label for="name" class="block text-sm font-2xl text-purple-700 mb-2">
                                Category Name *
                            </label>
                            <input wire:model="form.name" id="name" type="text"
                                class="w-full px-4 py-3 border-2 border-purple-100 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-300 focus:border-pink-400 bg-white text-purple-900 placeholder-purple-400 transition">
                            @error('form.name') 
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p> 
                            @enderror
                        </div>

                        <!-- Parent Category -->
                        <div>
                            <label for="parentCategories" class="block text-sm font-2xl text-purple-700 mb-2">
                                Parent Category
                            </label>
                            <select wire:model="form.parent_id" id="parentCategories"
                                class="w-full px-4 py-3 border-2 border-purple-100 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-300 focus:border-pink-400 bg-white text-purple-900 transition">
                                <option value="">Select Parent Category</option>
                                @foreach ($parentCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('form.parent_id') 
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p> 
                            @enderror
                        </div>

                        <!-- Special Category Toggle -->
                        <div class="bg-purple-50 p-4 rounded-xl border border-purple-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <label class="text-sm font-2xl text-purple-700">Special Category</label>
                                    <p class="text-xs text-purple-500 mt-1">Mark this category as special for featured display</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" wire:model="form.is_special" class="sr-only peer">
                                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-pink-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-pink-500"></div>
                                </label>
                            </div>
                            @error('form.is_special') 
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p> 
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-5">
                        <!-- Image Upload -->
                        <div>
                            <label class="block text-sm font-2xl text-purple-700 mb-2">Category Image</label>
                            
                            <!-- Image Preview Area -->
                            <div class="mb-4">
                                @if ($currentImageUrl && !$image)
                                    <div class="relative">
                                        <img src="{{ $currentImageUrl }}" alt="Current image" 
                                             class="w-full h-32 object-cover rounded-xl border-2 border-purple-200 shadow-sm">
                                        <div class="absolute top-2 right-2 bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">
                                            Current
                                        </div>
                                    </div>
                                @elseif ($image)
                                    <div class="relative">
                                        @if(method_exists($image, 'temporaryUrl'))
                                            <img src="{{ $image->temporaryUrl() }}" alt="New image preview"
                                                 class="w-full h-32 object-cover rounded-xl border-2 border-pink-200 shadow-sm">
                                        @else
                                            <div class="w-full h-32 flex items-center justify-center bg-pink-50 rounded-xl border-2 border-pink-200 shadow-sm">
                                                <div class="text-center px-4">
                                                    <svg class="w-8 h-8 text-pink-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                                    </svg>
                                                    <p class="text-sm text-pink-600">Image selected (preview not available in production)</p>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="absolute top-2 right-2 bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">
                                            New
                                        </div>
                                    </div>
                                @else
                                    <div class="w-full h-32 bg-purple-50 border-2 border-dashed border-purple-200 rounded-xl flex items-center justify-center">
                                        <div class="text-center">
                                            <svg class="w-8 h-8 text-purple-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <p class="text-sm text-purple-500">No image selected</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- File Input -->
                            <input type="file" wire:model="image" id="image" accept="image/*" 
                                class="block w-full text-sm text-purple-700
                                file:mr-4 file:py-3 file:px-4
                                file:rounded-xl file:border-0
                                file:text-sm file:font-2xl
                                file:bg-pink-50 file:text-purple-700
                                hover:file:bg-pink-100
                                border-2 border-purple-100 rounded-xl shadow-sm cursor-pointer transition">
                            
                            @error('image')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror

                            <!-- Upload Progress -->
                            <div wire:loading wire:key="image-loading" class="mt-3 flex items-center text-pink-600">
                                <span class="text-sm font-medium">Processing image...</span>
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-2xl text-purple-700 mb-2">
                                Description
                            </label>
                            <textarea wire:model="form.description" id="description" rows="4"
                                placeholder="Enter category description..."
                                class="w-full px-4 py-3 border-2 border-purple-100 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-300 focus:border-pink-400 bg-white text-purple-900 placeholder-purple-400 resize-none transition"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-8 py-6 flex flex-col sm:flex-row justify-end gap-3 border-t border-gray-200">
                <button @click="show = false" type="button"
                    class="w-full sm:w-auto px-6 py-3 text-sm font-2xl text-gray-700 bg-white border-2 border-gray-300 rounded-xl hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-400 transition">
                    Cancel
                </button>
                <button 
                    type="button"
                    wire:click="saveCategory"
                    wire:loading.attr="disabled"
                    wire:target="saveCategory"
                    class="w-full sm:w-auto px-6 py-3 text-sm text-white bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-300 transition disabled:opacity-50 shadow-lg"
                >
                    <div wire:loading.remove wire:target="saveCategory">
                        {{ $editingId ? 'Update Category' : 'Create Category' }}
                    </div>
                    <div wire:loading wire:target="saveCategory" class="inline-flex items-center">
                        <svg class="animate-spin w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Saving...
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>