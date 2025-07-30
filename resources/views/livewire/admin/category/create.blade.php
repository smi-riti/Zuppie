<div x-data="{ show: @entangle('showModal') }" x-show="show" class="fixed z-50 inset-0 top-28 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Subtle blurred backdrop -->
        <div x-show="show" class="fixed inset-0 bg-white/60 backdrop-blur-sm transition-opacity" @click="show = false">
        </div>

        <!-- Modal panel -->
        <div x-show="show" 
             x-transition:enter="ease-out duration-100"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-100"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl border border-zuppie-100 transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full relative z-10">
            <div>
                <div class="px-6 pt-6 pb-4 sm:p-8 sm:pb-4">
                    <h3 class="text-xl leading-6 font-bold text-zuppie-700 mb-6 text-center">
                        {{ $editingId ? 'Edit Category' : 'Create Category' }}
                    </h3>

                    <div class="space-y-5">
                        <div>
                            <label for="name" class="block text-sm font-medium text-zuppie-700 mb-1">Category
                                Name</label>
                            <input wire:model="form.name" id="name" type="text"
                                class="w-full px-3 py-2 border border-zuppie-100 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-zuppie-pink-200 focus:border-zuppie-300 bg-white text-zuppie-900 placeholder-zuppie-300">
                            @error('form.name') <p class="mt-1 text-sm text-zuppie-pink-600">{{ $message }}</p> @enderror
                        </div>
                        <div class="w-full mb-4">
                            <label class="block text-sm font-medium text-zuppie-700 mb-2">Select Image</label>
                            <input type="file" wire:model="image" id="image" accept="image/*" class="block w-full text-sm text-zuppie-700
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-lg file:border-0
                            file:text-sm file:font-medium
                            file:bg-zuppie-50 file:text-zuppie-700
                            hover:file:bg-zuppie-pink-100
                            border border-zuppie-100 rounded-lg shadow-sm">
                            @error('image')
                                <p class="mt-1 text-sm text-zuppie-pink-600">{{ $message }}</p>
                            @enderror
                            <div wire:loading wire:target="image" class="mt-2 flex items-center text-zuppie-pink-600">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-zuppie-pink-400"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                <span>Uploading Preview...</span>
                            </div>
                            @if ($image && !is_object($image))
                                <div class="mb-2">
                                    <img src="{{ $image }}" alt="Category Image"
                                        class="h-24 rounded-lg shadow border border-zuppie-100">
                                </div>
                            @endif
                            @if ($image && is_object($image))
                                <div class="mb-2">
                                    <img src="{{ $image->temporaryUrl() }}" alt="Preview"
                                        class="h-24 rounded-lg shadow border border-zuppie-pink-100">
                                </div>
                            @endif
                        </div>
                        <div>
                            <label for="is_special" class="inline-flex items-center">
                                <input type="checkbox" wire:model="form.is_special" id="is_special"
                                    class="form-checkbox h-5 w-5 text-zuppie-pink-500 rounded focus:ring-zuppie-pink-300">
                                <span class="ml-2 text-sm text-zuppie-700 font-medium">Special Category</span>
                            </label>
                            @error('form.is_special') <p class="mt-1 text-sm text-zuppie-pink-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="parentCategories" class="block text-sm font-medium text-zuppie-700 mb-1">Parent
                                Category</label>
                            <select wire:model="form.parent_id" id="parentCategories"
                                class="w-full px-3 py-2 border border-zuppie-100 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-zuppie-pink-200 focus:border-zuppie-300 bg-white text-zuppie-900">
                                <option value="">Select Parent Category</option>
                                @foreach ($parentCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('form.parent_id') <p class="mt-1 text-sm text-zuppie-pink-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="description"
                                class="block text-sm font-medium text-zuppie-700 mb-1">Description</label>
                            <textarea wire:model="form.description" id="description" rows="3"
                                class="w-full px-3 py-2 border border-zuppie-100 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-zuppie-pink-200 focus:border-zuppie-300 bg-white text-zuppie-900"></textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-white px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-zuppie-50">
                    <button wire:click="saveCategory" wire:loading.attr="disabled" type="button"
                        class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-zuppie-pink-500 text-base font-bold text-white hover:bg-zuppie-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zuppie-pink-200 sm:ml-3 sm:w-auto sm:text-sm transition">
                        <span wire:loading.remove>{{ $editingId ? 'Update' : 'Save' }}</span>
                        <span wire:loading>
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Processing...
                        </span>
                    </button>
                    <button @click="show = false" type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-lg border border-zuppie-100 shadow-sm px-4 py-2 bg-white text-base font-medium text-zuppie-700 hover:bg-zuppie-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zuppie-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>