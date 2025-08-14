<div class="p-4 lg:p-6">
    <!-- Flash Messages -->
    @if (session('message'))
        <div class="mb-6">
            <div class="px-4 py-3 rounded-lg bg-green-50 text-green-700 font-medium border border-green-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                {{ session('message') }}
            </div>
        </div>
    @endif

    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-purple-700">Categories</h2>
            <p class="text-sm text-purple-500 mt-1">
                {{ $categories->total() }} {{ Str::plural('category', $categories->total()) }} available
            </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
            <!-- Search -->
            <div class="relative">
                <input type="text" wire:model.live.debounce.300ms="search" 
                       placeholder="Search categories..." 
                       class="w-full sm:w-64 px-4 py-2 pl-10 border border-purple-200 rounded-lg focus:ring-2 focus:ring-pink-300 focus:border-pink-400 transition">
                <svg class="absolute left-3 top-2.5 h-5 w-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <!-- Add Button -->
            <button wire:click="$dispatch('open-create-modal')"
                class="flex items-center justify-center gap-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-medium py-2.5 px-5 rounded-lg transition shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add Category
            </button>
        </div>
    </div>

    @if ($categories->count() > 0)
        <div class="overflow-x-auto rounded-lg border border-purple-100 shadow-sm">
            <table class="w-full bg-white">
                <thead class="bg-gradient-to-r from-pink-50 to-purple-50">
                    <tr>
                        <th class="px-6 lg:px-8 py-4 text-left text-xs font-semibold text-purple-700 uppercase tracking-wider">Image</th>
                        <th class="px-6 lg:px-8 py-4 text-left text-xs font-semibold text-purple-700 uppercase tracking-wider">Name</th>
                        <th class="px-6 lg:px-8 py-4 text-left text-xs font-semibold text-purple-700 uppercase tracking-wider">Parent</th>
                        <th class="px-6 lg:px-8 py-4 text-left text-xs font-semibold text-purple-700 uppercase tracking-wider">Description</th>
                        <th class="px-6 lg:px-8 py-4 text-left text-xs font-semibold text-purple-700 uppercase tracking-wider">Special</th>
                        <th class="px-6 lg:px-8 py-4 text-right text-xs font-semibold text-purple-700 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-purple-100">
                    @foreach ($categories as $category)
                        <tr class="hover:bg-pink-50 transition-colors" wire:key="category-{{ $category->id }}">
                            <td class="px-6 lg:px-8 py-5 whitespace-nowrap">
                                @if ($category->image)
                                    <img src="{{ $category->image }}" alt="{{ $category->name }}" 
                                         class="h-14 w-14 object-cover rounded-lg border border-purple-200 shadow-sm">
                                @else
                                    <div class="h-14 w-14 rounded-lg bg-purple-100 flex items-center justify-center">
                                        <svg class="h-7 w-7 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 lg:px-8 py-5">
                                <div class="text-sm font-medium text-purple-900">{{ $category->name }}</div>
                                <div class="text-sm text-purple-500">{{ $category->slug }}</div>
                            </td>
                            <td class="px-6 lg:px-8 py-5 whitespace-nowrap text-sm text-purple-700">
                                @if($category->parent)
                                    <span class="px-2 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">
                                        {{ $category->parent->name }}
                                    </span>
                                @else
                                    <span class="text-purple-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 lg:px-8 py-5 text-sm text-purple-700">
                                <div class="max-w-xs truncate">
                                    {{ $category->description ?: '—' }}
                                </div>
                            </td>
                            <td class="px-6 lg:px-8 py-5 whitespace-nowrap">
                                @if($category->is_special)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        Special
                                    </span>
                                @else
                                    <span class="text-purple-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 lg:px-8 py-5 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-3">
                                    <button wire:click="$dispatch('open-create-modal', { editId: {{ $category->id }}})"
                                            class="p-2 text-purple-600 hover:text-purple-900 hover:bg-purple-50 rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button wire:click="confirmDelete({{ $category->id }})"
                                            class="p-2 text-red-600 hover:text-red-900 hover:bg-red-50 rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($categories->hasPages())
            <div class="mt-6">
                {{ $categories->links() }}
            </div>
        @endif
    @else
        <div class="text-center py-12">
            <div class="mx-auto w-24 h-24 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                <svg class="w-12 h-12 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-purple-700 mb-2">No categories found</h3>
            <p class="text-purple-500 mb-4">
                @if($search)
                    No categories match your search criteria.
                @else
                    Get started by creating your first category.
                @endif
            </p>
            @if(!$search)
                <button wire:click="$dispatch('open-create-modal')"
                    class="bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-medium py-2 px-4 rounded-lg transition">
                    Create Your First Category
                </button>
            @endif
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if ($confirmingDeletion)
        <div class="fixed inset-0  flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6 border-2 border-pink-300">
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Delete Category</h3>
                    <p class="text-sm text-gray-500 mb-6">
                        Are you sure you want to delete this category? This action cannot be undone.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-2 sm:gap-4">
                        <button wire:click="cancelDelete" 
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                            Cancel
                        </button>
                        <button wire:click="deleteCategory" wire:loading.attr="disabled"
                                class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition disabled:opacity-50">
                            <span wire:loading.remove>Delete Category</span>
                            <span wire:loading class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Deleting...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- livewire modals -->
    <livewire:admin.category.create />
</div>