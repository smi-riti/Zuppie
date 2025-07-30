<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-zuppie-700">Categories List ({{ $categories->total() }})</h2>
        <div class="flex gap-2 items-center">

            <div class="mb- flex justify-end">
                <input type="text" wire:model.live.debounce.100ms="search" placeholder="Search categories..."
                    class="px-4 py-2 border border-zuppie-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-zuppie-pink-200 focus:border-zuppie-300 bg-white text-zuppie-900" />
            </div>
            <button wire:click="$dispatch('open-create-modal')"
                class="bg-gradient-to-r from-zuppie-pink-500 to-zuppie-600 hover:from-zuppie-600 hover:to-zuppie-pink-500 text-white font-bold py-2 px-4 rounded-lg flex items-center shadow-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Add Category
            </button>
        </div>
    </div>

    @if ($categories->isEmpty())
        <p class="text-zuppie-pink-600 text-center py-8">No categories found.</p>
    @else
        <div class="overflow-x-auto rounded-lg border border-zuppie-pink-200">
            <table class="min-w-full bg-white rounded-lg">
                <thead class="bg-gradient-to-r from-zuppie-200 to-zuppie-pink-200">
                    <tr>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-zuppie-800 uppercase tracking-wider">
                            Image</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-zuppie-800 uppercase tracking-wider">
                            Name</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-zuppie-800 uppercase tracking-wider">
                            Slug</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-zuppie-800 uppercase tracking-wider">
                            Description</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-zuppie-800 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zuppie-pink-100">
                    @foreach ($categories as $category)
                        <tr class="hover:bg-zuppie-pink-50 transition" wire:key="category-{{ $category->id }}">
                            <td class="py-4 px-6 whitespace-nowrap">
                                @if ($category->image)
                                    <img src="{{ $category->image }}" alt="Image"
                                        class="h-12 w-12 object-cover rounded-full border-2 border-zuppie-300 shadow">
                                @else
                                    <span class="text-xs text-gray-400">No Image</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-zuppie-900 font-medium">
                                {{ $category->name }}
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-zuppie-pink-700">{{ $category->slug }}</td>
                            <td class="py-4 px-6 whitespace-nowrap text-gray-700">
                                {{ $category->description ?? '-' }}
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                <button wire:click="$dispatch('open-create-modal', { editId: {{ $category->id }}})"
                                    class="text-zuppie-600 hover:text-zuppie-pink-600 font-semibold mr-3 transition">
                                    Edit
                                </button>
                                <button wire:click="confirmDelete({{ $category->id }})"
                                    class="text-zuppie-pink-600 hover:text-zuppie-700 font-semibold transition">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $categories->links() }}

        </div>
    @endif
    <!-- Delete Confirmation Modal (works for both views) -->
    @if ($confirmingDeletion)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6 border-2 border-zuppie-pink-300">
                <div class="text-center">
                    <h3 class="text-lg font-bold text-zuppie-pink-700 mb-4">Are you sure you want to delete this Category?</h3>
                    <div class="flex flex-col sm:flex-row justify-center gap-2 sm:gap-4 mt-6">
                        <button wire:click="deleteCategory" wire:loading.attr="disabled"
                            class="px-4 py-2 bg-gradient-to-r from-zuppie-pink-500 to-zuppie-600 text-white rounded hover:from-zuppie-600 hover:to-zuppie-pink-500 focus:outline-none focus:ring-2 focus:ring-zuppie-pink-400 disabled:opacity-50">
                            <span wire:loading.remove>Delete</span>
                            <span wire:loading>
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Deleting...
                            </span>
                        </button>
                        <button wire:click="cancelDelete" type="button"
                            class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-zuppie-400">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- livewire modals -->
    <livewire:admin.category.create />

</div>