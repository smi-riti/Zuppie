<div class="p-5">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold">Categories List ({{ count($categories) }})</h2>
                <button wire:click="$dispatch('open-create-modal')"
                    class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Add Category
                </button>
            </div>

            @if($categories->isEmpty())
                <p class="text-gray-600">No categories found.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Slug</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Description</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($categories as $category)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-4 px-6 whitespace-nowrap">{{ $category->name }}</td>
                                    <td class="py-4 px-6 whitespace-nowrap">{{ $category->slug }}</td>
                                    <td class="py-4 px-6 whitespace-nowrap">{{ $category->description ?? '-' }}</td>
                                    <td class="py-4 px-6 whitespace-nowrap">
                                        <button wire:click="$dispatch('open-create-modal', { editId: {{ $category->id }}})"
                                            class="text-blue-600 hover:text-blue-900 mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                            Edit
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger"
                                            wire:click="alertConfirm({{ $category->id }})">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    <!-- livewire modals -->
    <livewire:admin.category.create />
    @script
    <script>
        window.addEventListener('swal:confirm', event => {
            Swal.fire({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('delete', event.detail.categoryId)
                }
            })
        });
    </script>
    @endscript
</div>