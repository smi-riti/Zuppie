<!-- Edit or insert Modal  from alpine.js-->
<div x-data="{ show: @entangle('showModal') }" x-show="show" class="fixed z-50 inset-0 top-28 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div x-show="show" x-transition:enter="ease-out duration-50" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 transition-opacity" @click="show = false">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- Modal panel -->
        <div x-show="show" x-transition:enter="ease-out duration-30"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                    {{ $editingId ? 'Edit Category' : 'Create Category' }}
                </h3>

                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                        <input wire:model="form.name" id="name" type="text"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500">
                        @error('form.name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div class="w-full mb-4">
                        <!-- Label with icon -->
                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Select Image
                        </label>

                        <!-- File input -->
                        <div class="mt-1 relative">
                            <input type="file" wire:model="image" id="image" accept="image/*" class="block w-full text-sm text-gray-500
                      file:mr-4 file:py-2 file:px-4
                      file:rounded-md file:border-0
                      file:text-sm file:font-semibold
                      file:bg-blue-50 file:text-blue-700
                      hover:file:bg-blue-100
                      border border-gray-300 rounded-md shadow-sm">
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Loading indicator -->
                        <div wire:loading wire:target="image" class="mt-2 flex items-center text-blue-600">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-blue-500"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <span>Uploading Preview...</span>
                        </div>

                        <!-- Image preview -->
                        @if ($image)
                            <div class="mt-3 space-y-1">
                                <p class="text-sm font-medium text-gray-700">Preview:</p>
                                <div class="border border-gray-200 rounded-md p-1 inline-block">
                                    <img src="{{ $image->temporaryUrl() }}" class="max-h-48 object-contain rounded-md"
                                        alt="Image preview">
                                </div>
                            </div>
                        @endif
                    </div>
                    <div>
                        <label for="is_special" class="inline-flex items-center">
                            <input type="checkbox" wire:model="form.is_special" id="is_special"
                                class="form-checkbox h-5 w-5 text-teal-600">
                            <span class="ml-2 text-sm text-gray-700">Special Category</span>
                        </label>
                        @error('form.is_special') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="parentCategories"
                            class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <select wire:model="form.parent_id" id="parentCategories"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500">
                            <option value="">Select Parent Category</option>
                            @foreach ($parentCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('form.parent_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="description"
                            class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea wire:model="form.description" id="description" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500"></textarea>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button wire:click="saveCategory" wire:loading.attr="disabled" type="button"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-teal-600 text-base font-medium text-white hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 sm:ml-3 sm:w-auto sm:text-sm">
                    <span wire:loading.remove>{{ $editingId ? 'Update' : 'Save' }}</span>
                    <span wire:loading>
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Processing...
                    </span>
                </button>
                <button @click="show = false" type="button"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>