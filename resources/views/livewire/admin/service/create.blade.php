{{-- Wrap everything in a single root div --}}
<div>
    <div class="mt-4">
        <label for="pin_code_input" class="block text-sm font-medium text-gray-700">
            Pin Code
        </label>
        <input 
            wire:model="pin_code" 
            id="pin_code_input"
            type="text" 
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50"
            placeholder="Enter pin code"
        >
        @error('pin_code') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
    </div>

    <div class="mt-6 flex justify-end space-x-3">
        <button 
            wire:click="$dispatch('close-modal')" 
            type="button"
            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
        >
            Cancel
        </button>
        <button 
            wire:click="saveService" 
            type="button"
            class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-purple-500 to-pink-500 border border-transparent rounded-md shadow-sm hover:from-purple-600 hover:to-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
        >
            {{ $editingId ? 'Update' : 'Create' }}
        </button>
    </div>
</div>