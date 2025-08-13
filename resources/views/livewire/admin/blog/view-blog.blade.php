<div>
    @if ($showModal && $blog)
        <div class="fixed inset-0 backdrop-blur-sm flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-5xl w-full max-h-[90vh] overflow-hidden border-2 border-purple-300">
                <!-- Header -->
                <div class="sticky top-0 bg-white p-6 border-b border-gray-200 rounded-t-lg">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-purple-700 mb-2">{{ $blog->title }}</h3>
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span>By {{ $blog->author->name }}</span>
                                <span>•</span>
                                <span>{{ $blog->created_at->format('M d, Y') }}</span>
                                <span>•</span>
                                <div class="flex items-center space-x-2">
                                    <button wire:click="toggleStatus" 
                                        class="relative inline-flex h-4 w-8 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 {{ $blog->status === 'published' ? 'bg-green-500' : 'bg-gray-300' }}">
                                        <span class="sr-only">Toggle status</span>
                                        <span class="inline-block h-2 w-2 transform rounded-full bg-white transition {{ $blog->status === 'published' ? 'translate-x-5' : 'translate-x-1' }}"></span>
                                    </button>
                                    <span class="text-xs {{ $blog->status === 'published' ? 'text-green-800' : 'text-gray-600' }}">
                                        {{ ucfirst($blog->status) }}
                                    </span>
                                </div>
                                @if($blog->category)
                                    <span>•</span>
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">{{ $blog->category->name }}</span>
                                @endif
                            </div>
                        </div>
                        <button wire:click="closeModal" class="ml-4 text-gray-500 hover:text-gray-700 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Content -->
                <div class="overflow-y-auto p-6" style="max-height: calc(90vh - 120px);">
                    <!-- Featured Image -->
                    @if($blog->featuredImage)
                        <div class="mb-6">
                            <img src="{{ $blog->featuredImage->image_url }}" 
                                 alt="{{ $blog->title }}"
                                 class="w-full h-64 object-cover rounded-lg border border-gray-300">
                        </div>
                    @endif

                    <!-- Blog Content -->
                    <div class="prose prose-lg max-w-none mb-8">
                        {!! $blog->content !!}
                    </div>

                    <!-- Gallery Images -->
                    @if($blog->galleryImages->count() > 0)
                        <div class="mb-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Gallery Images ({{ $blog->galleryImages->count() }})</h4>
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                @foreach($blog->galleryImages as $image)
                                    <div class="relative group cursor-pointer" onclick="openImageModal('{{ $image->image_url }}')">
                                        <img src="{{ $image->image_url }}" 
                                             alt="Gallery image"
                                             class="w-full h-24 object-cover rounded-lg border border-gray-300 transition-transform group-hover:scale-105">
                                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-200 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Blog Meta Information -->
                    <div class="bg-gray-50 rounded-lg p-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h5 class="font-semibold text-gray-900 mb-2">Blog Details</h5>
                            <div class="space-y-1 text-sm text-gray-600">
                                <p><span class="font-medium">Slug:</span> {{ $blog->slug }}</p>
                                <p><span class="font-medium">Author:</span> {{ $blog->author->name }}</p>
                                <p><span class="font-medium">Category:</span> {{ $blog->category ? $blog->category->name : 'Uncategorized' }}</p>
                                <p><span class="font-medium">Status:</span> {{ ucfirst($blog->status) }}</p>
                            </div>
                        </div>
                        <div>
                            <h5 class="font-semibold text-gray-900 mb-2">Statistics</h5>
                            <div class="space-y-1 text-sm text-gray-600">
                                <p><span class="font-medium">Created:</span> {{ $blog->created_at->format('F j, Y \a\t g:i A') }}</p>
                                <p><span class="font-medium">Updated:</span> {{ $blog->updated_at->format('F j, Y \a\t g:i A') }}</p>
                                <p><span class="font-medium">Total Images:</span> {{ $blog->images->count() }}</p>
                                <p><span class="font-medium">Content Length:</span> {{ strlen(strip_tags($blog->content)) }} characters</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 rounded-b-lg">
                    <div class="flex justify-between items-center">
                        <div class="flex space-x-3">
                            <button wire:click="$dispatch('open-update-blog-modal', ['id' => {{ $blog->id }}]); closeModal()"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit Blog
                            </button>
                            @if($blog->status === 'published')
                                <a href="{{ route('blog.detail', $blog->slug) }}" target="_blank"
                                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                    View Live
                                </a>
                            @endif
                        </div>
                        <button wire:click="closeModal" 
                            class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Image Modal for Gallery -->
        <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-[60] hidden">
            <div class="relative max-w-4xl max-h-4xl p-4">
                <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white hover:text-gray-300 z-10">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <img id="modalImage" src="" alt="Gallery image" class="max-w-full max-h-full object-contain rounded-lg">
            </div>
        </div>
    @endif
</div>

<script>
    function openImageModal(imageUrl) {
        document.getElementById('modalImage').src = imageUrl;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }

    // Close modal on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeImageModal();
        }
    });
</script>
