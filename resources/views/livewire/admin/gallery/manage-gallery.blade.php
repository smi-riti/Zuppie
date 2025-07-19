<div class="min-h-screen bg-gradient-to-br from-purple-50 to-pink-50 p-6">
    @if (session()->has('message'))
        <div class="mb-4 px-4 py-2 bg-gradient-to-r from-purple-100 to-pink-100 text-purple-700 rounded-lg border border-purple-200 shadow-sm">
            {{ session('message') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <div class="w-full md:w-1/3">
            <input type="text" wire:model.debounce.300ms="search" 
                   placeholder="Search images..." 
                   class="w-full px-4 py-2 border border-purple-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-purple-300 bg-white shadow-sm">
        </div>
        <button wire:click="openCreateModal" 
                class="px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-lg hover:from-purple-600 hover:to-pink-600 transition-all transform hover:scale-[1.02] shadow-md w-full md:w-auto">
            + Add Images
        </button>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow-lg border border-purple-100">
        <table class="min-w-full divide-y divide-purple-100">
            <thead class="bg-gradient-to-r from-purple-50 to-pink-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider cursor-pointer"
                        wire:click="sortBy('id')">
                        <div class="flex items-center">
                            ID
                            @if($sortField === 'id')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                </svg>
                            @endif
                        </div>
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">Image</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider cursor-pointer"
                        wire:click="sortBy('alt')">
                        <div class="flex items-center">
                            Alt Text
                            @if($sortField === 'alt')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                </svg>
                            @endif
                        </div>
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-purple-50">
                @forelse ($images as $image)
                    <tr class="hover:bg-purple-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-purple-900 font-medium">{{ $image->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img src="{{ $image->filename }}" alt="{{ $image->alt }}" 
                                 class="h-16 w-16 object-cover rounded-lg border-2 border-purple-100 shadow">
                        </td>
                        <td class="px-6 py-4 text-purple-800">{{ $image->alt }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded-full text-xs">
                                {{ $image->category->name ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button wire:click="openEditModal({{ $image->id }})"
                                    class="px-3 py-1 bg-gradient-to-r from-purple-400 to-purple-500 text-white rounded-lg hover:from-purple-500 hover:to-purple-600 mr-2 shadow transition">
                                Edit
                            </button>
                            <button wire:click="deleteImage({{ $image->id }})"
                                    class="px-3 py-1 bg-gradient-to-r from-pink-400 to-pink-500 text-white rounded-lg hover:from-pink-500 hover:to-pink-600 shadow transition"
                                    onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-purple-700">
                            <div class="flex flex-col items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-purple-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="mt-4 text-lg">No images found</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $images->links() }}
    </div>

    <!-- Create Modal -->
    @if ($showCreateModal)
        <livewire:admin.gallery.create-gallery />
    @endif

    <!-- Edit Modal -->
    @if ($showEditModal)
        <livewire:admin.gallery.update-gallery :id="$editId" />
    @endif
</div>

@push('styles')
<style>
    /* Custom pagination styles */
    .custom-pagination .page-item.active .page-link {
        background: linear-gradient(to right, #a78bfa, #f472b6);
        border-color: #a78bfa;
        color: white;
    }
    
    .custom-pagination .page-link {
        color: #8b5cf6;
        border: 1px solid #e9d8fd;
    }
    
    .custom-pagination .page-link:hover {
        background-color: #f5f3ff;
    }
    
    /* Scrollbar styling */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f5f3ff;
    }
    
    ::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #d8b4fe, #f9a8d4);
        border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, #c084fc, #f472b6);
    }
</style>
@endpush