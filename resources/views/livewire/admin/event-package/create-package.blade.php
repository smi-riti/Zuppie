<div class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center z-50" x-data="{ show: true }"
    x-show="show" x-transition wire:ignore.self>
    <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-lg p-6">
        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Create New Package</h3>
        @if (session()->has('message'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ session('message') }}
            </div>
        @endif
        <form wire:submit.prevent="submit" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Category</label>
                <select wire:model.live="category_id"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select Category</option>
                    @foreach($categories as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" wire:model.live="name"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" step="0.01" wire:model.live="price"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('price') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Discount Type</label>
                <select wire:model.live="discount_type"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">None</option>
                    <option value="percentage">Percentage</option>
                    <option value="fixed">Fixed</option>
                </select>
                @error('discount_type') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Discount Value</label>
                <input type="number" step="0.01" wire:model.live="discount_value"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('discount_value') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Images</label>
                <input type="file" wire:model.live="newImages" multiple
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <p class="text-xs text-gray-500 mt-1">Accepted formats: JPG, PNG, GIF, SVG, WEBP. Max 2MB per file.</p>
                @error('newImages.*') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror

                @if($newImages)
                    <div class="grid grid-cols-3 gap-3 mt-3">
                        @foreach($newImages as $index => $image)
                            <div class="relative border border-gray-200 rounded-lg p-1">
                                <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="w-full h-24 object-cover rounded">
                                <div class="absolute top-1 right-1">
                                    <button type="button" wire:click="$set('newImages.{{ $index }}', null)"
                                        class="bg-red-500 text-white rounded-full p-1 text-xs hover:bg-red-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="mt-5">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>

                <div wire:ignore>
                    <!-- This hidden input holds the value -->
                    <input id="description" wire:model="description" type="hidden" value="{{ $description }}">
                    <trix-editor wire:model="description" input="description"></trix-editor>
                </div>

                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>


            <div>
                <label class="block text-sm font-medium text-gray-700">Duration</label>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-gray-600">Hours</label>
                        <input type="number" wire:model.live="duration_hours" min="0"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('duration_hours') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs text-gray-600">Minutes</label>
                        <input type="number" wire:model.live="duration_minutes" min="0" max="59"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('duration_minutes') <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <label class="flex items-center">
                    <input type="checkbox" wire:model.live="is_active"
                        class="rounded border-gray-300 text-blue-500 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-700">Is Active</span>
                </label>
                <label class="flex items-center">
                    <input type="checkbox" wire:model.live="is_special"
                        class="rounded border-gray-300 text-blue-500 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-700">Is Special</span>
                </label>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" wire:click="$dispatch('closeCreateModal')"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Cancel</button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Create</button>
            </div>
        </form>
    </div>
</div>