<!-- resources/views/livewire/admin/blog/manage-blog.blade.php -->
<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-purple-700">Blog Posts ({{ $blogs->total() }})</h2>
        <div class="flex gap-2 items-center">
            <div class="mb- flex justify-end">
                <input type="text" wire:model.live.debounce.100ms="search" placeholder="Search blogs..."
                    class="px-4 py-2 border border-purple-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-200 focus:border-purple-300 bg-white text-purple-900" />
            </div>
            <button wire:click="$dispatch('open-create-blog-modal')"
                class="bg-gradient-to-r from-pink-500 to-purple-600 hover:from-purple-600 hover:to-pink-500 text-white font-bold py-2 px-4 rounded-lg flex items-center shadow-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Add Blog
            </button>
        </div>
    </div>

    @if ($blogs->isEmpty())
        <p class="text-pink-600 text-center py-8">No blog posts found.</p>
    @else
        <div class="overflow-x-auto rounded-lg border border-pink-200">
            <table class="min-w-full bg-white rounded-lg">
                <thead class="bg-gradient-to-r from-purple-200 to-pink-200">
                    <tr>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-purple-800 uppercase tracking-wider">
                            Image</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-purple-800 uppercase tracking-wider">
                            Title</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-purple-800 uppercase tracking-wider">
                            Slug</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-purple-800 uppercase tracking-wider">
                            Content</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-purple-800 uppercase tracking-wider">
                            Status</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-purple-800 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-pink-100">
                    @foreach ($blogs as $blog)
                        <tr class="hover:bg-pink-50 transition" wire:key="blog-{{ $blog->id }}">
                            <td class="py-4 px-6 whitespace-nowrap">
                                @if ($blog->image)
                                    <img src="{{ $blog->image }}" alt="Blog image"
                                        class="h-12 w-12 object-cover rounded-lg border-2 border-purple-300 shadow">
                                @else
                                    <span class="text-xs text-gray-400">No Image</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-purple-900 font-medium">
                                {{ $blog->title }}
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap text-pink-700">{{ $blog->slug }}</td>

                            <td class="py-4 px-6 whitespace-nowrap text-purple-900 font-medium">
                                {{ \Illuminate\Support\Str::words($blog->content, 2, '...') }}
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                <span
                                    class="px-2 py-1 text-xs rounded-full {{ $blog->is_published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $blog->is_published ? 'Published' : 'Draft' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                <button wire:click="$dispatch('open-update-blog-modal', { id: {{ $blog->id }}})"
                                    class="text-purple-600 hover:text-pink-600 font-semibold mr-3 transition">
                                    Edit
                                </button>
                                <button wire:click="confirmDelete({{ $blog->id }})"
                                    class="text-pink-600 hover:text-purple-700 font-semibold transition">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $blogs->links() }}
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if ($confirmingDeletion)
        <div class="fixed inset-0 backdrop-blur-sm bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6 border-2 border-pink-300">
                <div class="text-center">
                    <h3 class="text-lg font-bold text-pink-700 mb-4">Are you sure you want to delete this Blog Post?
                    </h3>
                    <div class="flex flex-col sm:flex-row justify-center gap-2 sm:gap-4 mt-6">
                        <button wire:click="deleteBlog" wire:loading.attr="disabled"
                            class="px-4 py-2 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded hover:from-purple-600 hover:to-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-400 disabled:opacity-50">
                            <span wire:loading.remove>Delete</span>
                            <span wire:loading>
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Deleting...
                            </span>
                        </button>
                        <button wire:click="cancelDelete" type="button"
                            class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-400">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Create and Update modals -->
    <livewire:admin.blog.create-blog />
    <livewire:admin.blog.update-blog />
</div>
