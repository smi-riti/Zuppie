
<div x-data="{ show: @entangle('showModal') }" x-show="show" class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto">
    <!-- Blurred backdrop -->
    <div x-show="show"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity"
        @click="show = false"></div>

    <!-- Modal panel -->
    <div x-show="show" x-transition
        class="bg-white rounded-xl shadow-xl max-w-md w-full p-6 border-2 border-red-300 relative z-10">
        <h2 class="text-xl font-bold text-red-600 mb-4">Add New Offer</h2>
        <!-- Modal content goes here -->
        <div class="mb-4">
            <input type="text" placeholder="Offer Title" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-200">
        </div>
        <div class="mb-4">
            <textarea placeholder="Offer Description" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-200"></textarea>
        </div>
        <div class="flex justify-end gap-2">
            <button type="button" @click="show = false"
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Cancel</button>
            <button type="button"
                class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Save Offer</button>
        </div>
    </div>
</div>