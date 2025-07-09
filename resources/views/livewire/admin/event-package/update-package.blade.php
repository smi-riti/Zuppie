<div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" x-data="{ show: true }" x-show="show" wire:ignore.self>
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <h3 class="text-lg font-medium mb-4">Update Package</h3>
        @if (session()->has('message'))
            <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">
                {{ session('message') }}
            </div>
        @endif
        <form wire:submit.prevent="update">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Category</label>
                <select wire:model.live="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">Select Category</option>
                    @foreach($categories as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" wire:model.live="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" step="0.01" wire:model.live="price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Discount Type</label>
                <select wire:model.live="discount_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">None</option>
                    <option value="percentage">Percentage</option>
                    <option value="fixed">Fixed</option>
                </select>
                @error('discount_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Discount Value</label>
                <input type="number" step="0.01" wire:model.live="discount_value" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('discount_value') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea wire:model.live="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Duration (minutes)</label>
                <input type="number" wire:model.live="duration" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('duration') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
           
            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" wire:model.live="is_active" class="rounded border-gray-300">
                    <span class="ml-2 text-sm text-gray-700">Is Active</span>
                </label>
            </div>
            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" wire:model.live="is_special" class="rounded border-gray-300">
                    <span class="ml-2 text-sm text-gray-700">Is Special</span>
                </label>
            </div>
            <div class="flex justify-end">
                <button type="button" wire:click="$dispatch('closeUpdateModal')" class="mr-2 px-4 py-2 bg-gray-300 rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Update</button>
            </div>
        </form>
    </div>
</div>