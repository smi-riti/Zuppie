<div class="min-h-screen bg-gray-50">
    <!-- Breadcrumb -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-zuppie-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="/blog" class="ml-1 text-sm font-medium text-gray-700 hover:text-zuppie-600 md:ml-2">Blog</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 truncate">{{ $blog->title }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Article -->
    <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Article Header -->
        <header class="mb-8">
            <!-- Category & Date -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                <div class="flex items-center space-x-4 mb-2 sm:mb-0">
                    @if($blog->category)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-zuppie-100 text-zuppie-800">
                            {{ $blog->category->name }}
                        </span>
                    @endif
                    <time class="text-sm text-gray-500">
                        {{ $blog->created_at->format('F d, Y') }}
                    </time>
                </div>
                
                <!-- Share Buttons -->
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-500 mr-2">Share:</span>
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(request()->url()) }}" 
                       target="_blank"
                       class="p-2 rounded-full bg-blue-400 text-white hover:bg-blue-500 transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                       target="_blank"
                       class="p-2 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" 
                       target="_blank"
                       class="p-2 rounded-full bg-blue-700 text-white hover:bg-blue-800 transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Title -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 leading-tight mb-4">
                {{ $blog->title }}
            </h1>

            <!-- Author Info -->
            <div class="flex items-center space-x-4 text-sm text-gray-600">
                <span>By <strong>{{ $blog->author->name ?? 'Admin' }}</strong></span>
                <span>•</span>
                <span>{{ $blog->created_at->diffForHumans() }}</span>
                <span>•</span>
                <span>{{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min read</span>
            </div>
        </header>

        <!-- Featured Image -->
        @if($blog->featuredImage)
            <div class="mb-8">
                <img src="{{ $blog->featuredImage->image_url }}" 
                     alt="{{ $blog->title }}"
                     class="w-full h-64 md:h-96 object-cover rounded-lg shadow-lg">
            </div>
        @endif

        <!-- Gallery Images -->
        @if($blog->galleryImages && $blog->galleryImages->count() > 0)
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Gallery</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($blog->galleryImages as $galleryImage)
                        <div class="group cursor-pointer" onclick="openImageModal('{{ $galleryImage->image_url }}')">
                            <img src="{{ $galleryImage->image_url }}" 
                                 alt="Gallery Image"
                                 class="w-full h-48 object-cover rounded-lg shadow-md group-hover:shadow-lg transition-shadow duration-300">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Article Content -->
        <div class="prose prose-lg prose-gray max-w-none mb-12">
            <div class="blog-content">
                {!! $blog->content !!}
            </div>
        </div>

        <!-- Article Footer -->
        <footer class="border-t border-gray-200 pt-8">
            <!-- Tags/Category -->
            @if($blog->category)
                <div class="mb-6">
                    <h3 class="text-sm font-medium text-gray-900 mb-2">Category</h3>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-zuppie-100 text-zuppie-800">
                        {{ $blog->category->name }}
                    </span>
                </div>
            @endif

            <!-- Author Bio -->
            <div class="bg-gray-100 rounded-lg p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">About the Author</h3>
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-zuppie-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold text-lg">
                                {{ substr($blog->author->name ?? 'A', 0, 1) }}
                            </span>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900">{{ $blog->author->name ?? 'Admin' }}</h4>
                        <p class="text-gray-600 text-sm mt-1">
                            Content creator and blogger sharing insights and experiences.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                <a href="/blog" 
                   class="inline-flex items-center text-zuppie-600 hover:text-zuppie-800 font-medium transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to Blog
                </a>

                <!-- Share Again -->
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-500 mr-2">Share this article:</span>
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(request()->url()) }}" 
                       target="_blank"
                       class="p-2 rounded-full bg-blue-400 text-white hover:bg-blue-500 transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                       target="_blank"
                       class="p-2 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </footer>
    </article>

    <!-- Related Posts -->
    @if($relatedBlogs->count() > 0)
        <section class="bg-white border-t border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Related Articles</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($relatedBlogs as $relatedBlog)
                        <article class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            @if($relatedBlog->featuredImage)
                                <div class="aspect-w-16 aspect-h-9">
                                    <img src="{{ $relatedBlog->featuredImage->image_url }}" 
                                         alt="{{ $relatedBlog->title }}"
                                         class="w-full h-48 object-cover">
                                </div>
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif

                            <div class="p-6">
                                @if($relatedBlog->category)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-zuppie-100 text-zuppie-800 mb-3">
                                        {{ $relatedBlog->category->name }}
                                    </span>
                                @endif

                                <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                                    <a href="/blog/{{ $relatedBlog->slug }}" class="hover:text-zuppie-600 transition-colors">
                                        {{ $relatedBlog->title }}
                                    </a>
                                </h3>

                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    {!! \Illuminate\Support\Str::limit(strip_tags($relatedBlog->content), 100) !!}
                                </p>

                                <div class="flex items-center justify-between">
                                    <time class="text-xs text-gray-500">
                                        {{ $relatedBlog->created_at->format('M d, Y') }}
                                    </time>
                                    <a href="/blog/{{ $relatedBlog->slug }}" 
                                       class="text-zuppie-600 hover:text-zuppie-800 font-medium text-sm transition-colors">
                                        Read more →
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <style>
    .blog-content {
        line-height: 1.8;
    }
    
    .blog-content h1, .blog-content h2, .blog-content h3, .blog-content h4, .blog-content h5, .blog-content h6 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: 600;
        color: #1f2937;
    }
    
    .blog-content h1 { font-size: 2rem; }
    .blog-content h2 { font-size: 1.75rem; }
    .blog-content h3 { font-size: 1.5rem; }
    .blog-content h4 { font-size: 1.25rem; }
    .blog-content h5 { font-size: 1.125rem; }
    .blog-content h6 { font-size: 1rem; }
    
    .blog-content p {
        margin-bottom: 1.5rem;
        color: #374151;
    }
    
    .blog-content ul, .blog-content ol {
        margin-bottom: 1.5rem;
        padding-left: 2rem;
    }
    
    .blog-content li {
        margin-bottom: 0.5rem;
        color: #374151;
    }
    
    .blog-content blockquote {
        border-left: 4px solid #e5e7eb;
        padding-left: 1rem;
        margin: 1.5rem 0;
        font-style: italic;
        color: #6b7280;
    }
    
    .blog-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 1.5rem 0;
    }
    
    .blog-content a {
        color: #dc2626;
        text-decoration: underline;
    }
    
    .blog-content a:hover {
        color: #b91c1c;
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<!-- Image Modal -->
<div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 p-4">
    <div class="relative max-w-4xl max-h-full">
        <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white hover:text-gray-300 z-10">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <img id="modalImage" src="" alt="Gallery Image" class="max-w-full max-h-full object-contain rounded-lg">
    </div>
</div>

<script>
function openImageModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('imageModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside the image
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImageModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});
</script>
</div>


