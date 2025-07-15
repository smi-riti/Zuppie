<div class="">
    <div class="mt-4">
        <label class="block text-sm font-medium text-gray-700">Pin Code</label>
        <input 
            wire:model.live.debounce.500ms="pin_code" 
            name="pin_code"
            type="number"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50"
            placeholder="Enter 6-digit pin code"
        >
        @error('pin_code') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
    </div>

    <div class="mt-6 flex justify-end space-x-3">
        <button 
            wire:click="$dispatch('close-modal')" 
            type="button"
            wire:loading.attr="disabled"
            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
        >
            <span wire:loading.class="hidden">Cancel</span>
            <span wire:loading>Loading...</span>
        </button>
        <button 
            wire:click="saveService" 
            type="button"
            wire:loading.attr="disabled"
            class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-purple-500 to-pink-500 border border-transparent rounded-md shadow-sm hover:from-purple-600 hover:to-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
        >
            <span wire:loading.class="hidden">{{ $editingId ? 'Update' : 'Create' }}</span>
            <span wire:loading>Loading...</span>
        </button>
    </div>
</div>