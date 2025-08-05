<div class="min-h-screen bg-gray-50">
    <!-- Breadcrumb - Simplified -->
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-4xl mx-auto px-4 py-3">
            <nav class="flex text-sm text-gray-500">
                <a href="/" class="hover:text-indigo-600 transition-colors">Home</a>
                <span class="mx-2">/</span>
                <a href="/blog" class="hover:text-indigo-600 transition-colors">Blog</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900 truncate">{{ $blog->title }}</span>
            </nav>
        </div>
    </div>

    <!-- Article Layout -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col lg:flex-row gap-8">
        <!-- Main Content -->
        <article class="w-full lg:w-2/3">
            <!-- Article Header -->
            <header class="mb-10">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                    <div class="flex items-center space-x-3">
                        @if($blog->category)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                            {{ $blog->category->name }}
                        </span>
                        @endif
                        <time class="text-sm text-gray-500">
                            {{ $blog->created_at->format('M d, Y') }}
                        </time>
                        <span class="text-sm text-gray-500">•</span>
                        <span class="text-sm text-gray-500">{{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min read</span>
                    </div>
                    
                    <!-- Share Buttons - Compact -->
                    <div class="flex items-center space-x-1">
                        <span class="text-xs text-gray-500">Share:</span>
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(request()->url()) }}" 
                           target="_blank"
                           class="p-2 rounded-full bg-gray-100 text-gray-600 hover:bg-indigo-100 hover:text-indigo-600 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                           target="_blank"
                           class="p-2 rounded-full bg-gray-100 text-gray-600 hover:bg-indigo-100 hover:text-indigo-600 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Title -->
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight mb-6">
                    {{ $blog->title }}
                </h1>

                <!-- Author Info -->
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-white font-medium">
                        {{ substr($blog->author->name ?? 'A', 0, 1) }}
                    </div>
                    <div>
                        <div class="text-sm font-medium text-gray-900">{{ $blog->author->name ?? 'Admin' }}</div>
                        <div class="text-xs text-gray-500">{{ $blog->created_at->diffForHumans() }}</div>
                    </div>
                </div>
            </header>

            <!-- Featured Image -->
            @if($blog->featuredImage)
                <div class="mb-10 rounded-xl overflow-hidden">
                    <img src="{{ $blog->featuredImage->image_url }}" 
                         alt="{{ $blog->title }}"
                         class="w-full h-auto object-cover rounded-xl">
                </div>
            @endif

            <!-- Article Content -->
            <div class="prose prose-lg max-w-none mb-12">
                <div class="blog-content">
                    {!! $blog->content !!}
                </div>
            </div>

            <!-- Gallery Images -->
            @if($blog->galleryImages && $blog->galleryImages->count() > 0)
                <div class="mb-12">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Gallery</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @foreach($blog->galleryImages as $galleryImage)
                            <div class="group cursor-pointer" onclick="openImageModal('{{ $galleryImage->image_url }}')">
                                <img src="{{ $galleryImage->image_url }}" 
                                     alt="Gallery Image"
                                     class="w-full h-40 object-cover rounded-lg group-hover:opacity-90 transition-opacity">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Article Footer -->
            <footer class="border-t border-gray-200 pt-8">
                <!-- Share Again -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <a href="/blog" 
                       class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Back to Blog
                    </a>
                    
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-500">Share this article:</span>
                        <div class="flex space-x-1">
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(request()->url()) }}" 
                               target="_blank"
                               class="p-2 rounded-full bg-gray-100 text-gray-600 hover:bg-indigo-100 hover:text-indigo-600 transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                               target="_blank"
                               class="p-2 rounded-full bg-gray-100 text-gray-600 hover:bg-indigo-100 hover:text-indigo-600 transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
        </article>

        <!-- Sidebar -->
        <aside class="w-full lg:w-1/3">
            <!-- Author Bio -->
            <div class="bg-white rounded-xl border border-gray-200 p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">About the Author</h3>
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-indigo-500 rounded-full flex items-center justify-center text-white font-medium text-lg">
                            {{ substr($blog->author->name ?? 'A', 0, 1) }}
                        </div>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900">{{ $blog->author->name ?? 'Admin' }}</h4>
                        <p class="text-gray-600 text-sm mt-2">
                            Content creator and blogger sharing insights and experiences.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Table of Contents -->
            <div class="bg-white rounded-xl border border-gray-200 p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Table of Contents</h3>
                <div id="toc-container" class="text-sm space-y-2">
                    <!-- TOC will be generated by JS -->
                </div>
            </div>

            <!-- Newsletter -->
            <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-xl p-6 text-white">
                <h3 class="text-lg font-semibold mb-2">Join the Newsletter</h3>
                <p class="text-indigo-100 text-sm mb-4">Get the latest posts delivered right to your inbox</p>
                <form class="space-y-3">
                    <input type="email" placeholder="Your email address" class="w-full px-4 py-2 rounded-lg bg-white/20 placeholder-indigo-200 text-white focus:ring-2 focus:ring-white focus:ring-opacity-50">
                    <button type="submit" class="w-full bg-white text-indigo-600 font-medium py-2 rounded-lg hover:bg-opacity-90 transition-opacity">Subscribe</button>
                </form>
            </div>
        </aside>
    </div>

    <!-- Related Posts -->
    @if($relatedBlogs->count() > 0)
        <section class="bg-white border-t border-gray-200">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">You Might Also Like</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($relatedBlogs as $relatedBlog)
                        <article class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                            @if($relatedBlog->featuredImage)
                                <div class="aspect-w-16 aspect-h-10">
                                    <img src="{{ $relatedBlog->featuredImage->image_url }}" 
                                         alt="{{ $relatedBlog->title }}"
                                         class="w-full h-48 object-cover">
                                </div>
                            @else
                                <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif

                            <div class="p-5">
                                @if($relatedBlog->category)
                                    <span class="inline-block px-2 py-1 text-xs font-medium bg-indigo-100 text-indigo-800 rounded-full mb-3">
                                        {{ $relatedBlog->category->name }}
                                    </span>
                                @endif

                                <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                                    <a href="/blog/{{ $relatedBlog->slug }}" class="hover:text-indigo-600 transition-colors">
                                        {{ $relatedBlog->title }}
                                    </a>
                                </h3>

                                <div class="flex items-center justify-between mt-4">
                                    <time class="text-xs text-gray-500">
                                        {{ $relatedBlog->created_at->format('M d, Y') }}
                                    </time>
                                    <a href="/blog/{{ $relatedBlog->slug }}" 
                                       class="text-indigo-600 hover:text-indigo-800 font-medium text-sm flex items-center">
                                        Read
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
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
        color: #374151;
    }
    
    .blog-content h2 {
        font-size: 1.75rem;
        font-weight: 700;
        margin-top: 2.5rem;
        margin-bottom: 1rem;
        color: #1f2937;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .blog-content h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: #1f2937;
    }
    
    .blog-content p {
        margin-bottom: 1.5rem;
    }
    
    .blog-content a {
        color: #4f46e5;
        text-decoration: underline;
        text-decoration-color: #c7d2fe;
        text-underline-offset: 3px;
    }
    
    .blog-content a:hover {
        color: #3730a3;
        text-decoration-color: #a5b4fc;
    }
    
    .blog-content ul, .blog-content ol {
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
    }
    
    .blog-content li {
        margin-bottom: 0.5rem;
        position: relative;
    }
    
    .blog-content ul li::before {
        content: "•";
        color: #818cf8;
        position: absolute;
        left: -1rem;
    }
    
    .blog-content blockquote {
        border-left: 4px solid #e0e7ff;
        padding-left: 1.5rem;
        margin: 1.5rem 0;
        font-style: italic;
        color: #4b5563;
    }
    
    .blog-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.75rem;
        margin: 1.5rem 0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<!-- Image Modal -->
<div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50 p-4">
    <div class="relative max-w-6xl max-h-full">
        <button onclick="closeImageModal()" class="absolute top-6 right-6 text-white hover:text-gray-300 z-10">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <img id="modalImage" src="" alt="Gallery Image" class="max-w-full max-h-[90vh] object-contain rounded-lg">
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

// Generate Table of Contents
document.addEventListener('DOMContentLoaded', function() {
    const tocContainer = document.getElementById('toc-container');
    const headings = document.querySelectorAll('.blog-content h2, .blog-content h3');
    
    if (headings.length > 1) {
        let tocHTML = '<ul class="space-y-2">';
        
        headings.forEach((heading, index) => {
            const id = `heading-${index}`;
            heading.id = id;
            
            const indent = heading.tagName === 'H3' ? ' pl-4' : '';
            tocHTML += `
                <li class="${indent}">
                    <a href="#${id}" class="text-indigo-600 hover:text-indigo-800 hover:underline transition-colors">
                        ${heading.textContent}
                    </a>
                </li>
            `;
        });
        
        tocHTML += '</ul>';
        tocContainer.innerHTML = tocHTML;
    } else {
        tocContainer.parentElement.classList.add('hidden');
    }
});

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