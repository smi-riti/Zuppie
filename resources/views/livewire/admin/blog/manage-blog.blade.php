<!-- resources/views/livewire/admin/blog/manage-blog.blade.php -->
<div class="p-2">
    <!-- Toast Messages -->
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-full" x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform translate-x-0" x-transition:leave-end="opacity-0 transform translate-x-full" x-init="setTimeout(() => show = false, 5000)"
            class="fixed top-4 right-4 z-50 max-w-sm w-full bg-green-500 text-white p-4 rounded-lg shadow-lg border-l-4 border-green-600">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-white hover:text-gray-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-full" x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform translate-x-0" x-transition:leave-end="opacity-0 transform translate-x-full" x-init="setTimeout(() => show = false, 5000)"
            class="fixed top-4 right-4 z-50 max-w-sm w-full bg-red-500 text-white p-4 rounded-lg shadow-lg border-l-4 border-red-600">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
                <button @click="show = false" class="text-white hover:text-gray-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <h2 class="text-3xl text-purple-700">Blog Posts ({{ $blogs->total() }})</h2>
        <div class="flex flex-col sm:flex-row gap-3 items-stretch sm:items-center w-full md:w-auto">
            <div class="flex-1 md:flex-none">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search blogs..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white text-gray-900" />
            </div>
            <button wire:click="$dispatch('open-create-blog-modal')"
                class="bg-gradient-to-r from-pink-500 to-purple-600 hover:from-purple-600 hover:to-pink-500 text-white py-3 px-6 rounded-lg flex items-center justify-center shadow-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                <span class="hidden sm:inline">Add Blog</span>
                <span class="sm:hidden">Add</span>
            </button>
        </div>
    </div>

    @if ($blogs->isEmpty())
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <p class="text-gray-600 text-lg">No blog posts found.</p>
            @if($search)
                <p class="text-gray-500 text-sm mt-2">Try adjusting your search terms.</p>
            @endif
        </div>
    @else
        <!-- Mobile Card View -->
        <div class="block md:hidden space-y-6">
            @foreach ($blogs as $blog)
                <div class="bg-white rounded-xl border border-gray-200 shadow-lg hover:shadow-xl transition-all duration-300 p-6 hover:border-purple-200" wire:key="blog-mobile-{{ $blog->id }}">
                    <div class="flex items-start space-x-4">
                        @if ($blog->featuredImage)
                            <img src="{{ $blog->featuredImage->image_url }}" alt="Blog image"
                                class="w-20 h-20 object-cover rounded-xl border-2 border-gray-200 flex-shrink-0 shadow-sm">
                        @else
                            <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center flex-shrink-0 border-2 border-gray-200">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-2xl text-gray-900 truncate mb-1">{{ $blog->title }}</h3>
                           
                            @if($blog->category)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mb-3">
                                    {{ $blog->category->name }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600 mb-3">
                                    Uncategorized
                                </span>
                            @endif
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 100) }}</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <button wire:click="toggleStatus({{ $blog->id }})" 
                                        class="relative inline-flex h-6 w-12 items-center rounded-full transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 shadow-inner {{ $blog->status === 'published' ? 'bg-gradient-to-r from-green-400 to-green-500 shadow-green-200' : 'bg-gradient-to-r from-gray-300 to-gray-400 shadow-gray-200' }}">
                                        <span class="sr-only">Toggle status</span>
                                        <span class="inline-block h-5 w-5 transform rounded-full bg-white transition-transform duration-300 shadow-lg border-2 border-white {{ $blog->status === 'published' ? 'translate-x-6' : 'translate-x-1' }}"></span>
                                    </button>
                                    <span class="ml-3 text-sm font-medium {{ $blog->status === 'published' ? 'text-green-700' : 'text-gray-600' }}">
                                        {{ ucfirst($blog->status) }}
                                    </span>
                                </div>
                                <div class="flex space-x-2">
                                    <button wire:click="viewBlog({{ $blog->id }})"
                                        class="inline-flex items-center px-2 py-1.5 text-xs font-medium text-purple-600 hover:text-purple-900 hover:bg-purple-50 rounded-lg transition-all duration-200">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View
                                    </button>
                                    <button wire:click="$dispatch('open-update-blog-modal', { id: {{ $blog->id }}})"
                                        class="inline-flex items-center px-2 py-1.5 text-xs font-medium text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded-lg transition-all duration-200">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </button>
                                    <button wire:click="confirmDelete({{ $blog->id }})"
                                        class="inline-flex items-center px-2 py-1.5 text-xs font-medium text-red-600 hover:text-red-900 hover:bg-red-50 rounded-lg transition-all duration-200">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </div>
                            <div class="mt-3 pt-3 border-t border-gray-100 text-xs text-gray-500">
                                Created: {{ $blog->created_at->format('M j, Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Desktop Table View -->
        <div class="hidden md:block desktop-table w-full overflow-hidden rounded-xl border border-gray-200 shadow-lg bg-white">
            <div class="overflow-x-auto">
                <table class="w-full min-w-full">
                    <thead class="bg-gradient-to-r from-purple-50 to-purple-100">
                        <tr>
                            <th class="py-4 px-6 text-left text-xs text-purple-700 uppercase tracking-wider">Image</th>
                            <th class="py-4 px-6 text-left text-xs text-purple-700 uppercase tracking-wider">Title</th>
                            <th class="py-4 px-6 text-left text-xs text-purple-700 uppercase tracking-wider">Category</th>
                            <th class="py-4 px-6 text-left text-xs text-purple-700 uppercase tracking-wider">Status</th>
                            <th class="py-4 px-6 text-left text-xs text-purple-700 uppercase tracking-wider">Created</th>
                            <th class="py-4 px-6 text-right text-xs text-purple-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">                        
                        @foreach ($blogs as $blog)
                            <tr class="hover:bg-purple-50 transition-colors duration-200" wire:key="blog-{{ $blog->id }}">
                                <td class="py-6 px-6 whitespace-nowrap">
                                    @if ($blog->featuredImage)
                                        <img src="{{ $blog->featuredImage->image_url }}" alt="Blog image"
                                            class="h-16 w-16 object-cover rounded-xl border-2 border-gray-200 shadow-sm">
                                    @else
                                        <div class="h-16 w-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center border-2 border-gray-200">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="py-6 px-6">
                                    <div class="max-w-sm">
                                        <div class="text-sm font-2xl text-gray-900 truncate mb-1">{{ $blog->title }}</div>
                                        <div class="text-xs text-gray-500 truncate">{{ $blog->slug }}</div>
                                    </div>
                                </td>
                                <td class="py-6 px-6 whitespace-nowrap">
                                    @if($blog->category)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $blog->category->name }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                            Uncategorized
                                        </span>
                                    @endif
                                </td>
                            <td class="py-6 px-6 whitespace-nowrap">
                                <div class="flex items-center">
                                    <button wire:click="toggleStatus({{ $blog->id }})" 
                                        class="relative inline-flex h-6 w-12 items-center rounded-full transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 shadow-inner {{ $blog->status === 'published' ? 'bg-gradient-to-r from-green-400 to-green-500 shadow-green-200' : 'bg-gradient-to-r from-gray-300 to-gray-400 shadow-gray-200' }}">
                                        <span class="sr-only">Toggle status</span>
                                        <span class="inline-block h-5 w-5 transform rounded-full bg-white transition-transform duration-300 shadow-lg border-2 border-white {{ $blog->status === 'published' ? 'translate-x-6' : 'translate-x-1' }}"></span>
                                    </button>
                                    <span class="ml-3 text-sm font-medium {{ $blog->status === 'published' ? 'text-green-700' : 'text-gray-600' }}">
                                        {{ ucfirst($blog->status) }}
                                    </span>
                                </div>
                            </td>
                            <td class="py-6 px-6 whitespace-nowrap text-sm font-medium text-gray-500">
                                {{ $blog->created_at->format('M j, Y') }}
                            </td>
                            <td class="py-6 px-6 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-3">
                                    <button wire:click="viewBlog({{ $blog->id }})"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-purple-600 hover:text-purple-900 hover:bg-purple-50 rounded-lg transition-all duration-200 group">
                                        <svg class="w-4 h-4 mr-1.5 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View
                                    </button>
                                    <button wire:click="$dispatch('open-update-blog-modal', { id: {{ $blog->id }}})"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded-lg transition-all duration-200 group">
                                        <svg class="w-4 h-4 mr-1.5 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </button>
                                    <button wire:click="confirmDelete({{ $blog->id }})"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-red-600 hover:text-red-900 hover:bg-red-50 rounded-lg transition-all duration-200 group">
                                        <svg class="w-4 h-4 mr-1.5 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $blogs->links() }}
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if ($confirmingDeletion)
        <div class="fixed inset-0 backdrop-blur-sm bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6 border border-gray-300">
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Delete Blog Post</h3>
                    <p class="text-sm text-gray-500 mb-6">Are you sure you want to delete this blog post? This action cannot be undone.</p>
                    <div class="flex flex-col sm:flex-row justify-center gap-3">
                        <button wire:click="deleteBlog" wire:loading.attr="disabled"
                            class="w-full sm:w-auto px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 disabled:opacity-50 transition-colors">
                            <span wire:loading.remove>Delete</span>
                            <span wire:loading class="flex items-center justify-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Deleting...
                            </span>
                        </button>
                        <button wire:click="cancelDelete" type="button"
                            class="w-full sm:w-auto px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Create, Update and View modals -->
    <livewire:admin.blog.create-blog />
    <livewire:admin.blog.update-blog />
    <livewire:admin.blog.view-blog />
</div>
