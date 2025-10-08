<div>
    @if ($showModal)
        <div class="fixed inset-0 backdrop-blur-sm flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto border-2 border-purple-300">
                <div class="sticky top-0 bg-white p-6 border-b border-gray-200 rounded-t-lg">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl text-purp text-purple-700">Edit Blog Post</h3>
                        <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <form wire:submit.prevent="updateBlog" class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                        <!-- Title -->
                        <div class="lg:col-span-2">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                            <input type="text" 
                                   wire:model.live="form.title" 
                                   id="title"
                                   class="w-full px text-purp-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors"
                                   placeholder="Enter blog title">
                            @error('form.title') 
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p> 
                            @enderror
                        </div>
                        
                        <!-- Category -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                            <select wire:model="form.category_id" 
                                    id="category"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('form.category_id') 
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p> 
                            @enderror
                        </div>
                        
                        <!-- Status Toggle -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                            <div class="flex items-center space-x-3">
                                <span class="text-sm text-gray-500">Draft</span>
                                <button type="button" wire:click="toggleStatus" 
                                    class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 {{ $form['status'] === 'published' ? 'bg-purple-600' : 'bg-gray-200' }}">
                                    <span class="sr-only">Toggle status</span>
                                    <span class="inline-block h-4 w-4 transform rounded-full bg-white transition {{ $form['status'] === 'published' ? 'translate-x-6' : 'translate-x-1' }}"></span>
                                </button>
                                <span class="text-sm text-gray-500">Published</span>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Current status: <span class="font-medium {{ $form['status'] === 'published' ? 'text-green-600' : 'text-yellow-600' }}">{{ ucfirst($form['status']) }}</span></p>
                            @error('form.status') 
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p> 
                            @enderror
                        </div>
                        
                        <!-- Image Upload -->
                        <div class="lg:col-span-2">
                            <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Images (First image will be featured image)</label>
                            
                            <!-- Current Images -->
                            @if($blog && ($blog->featuredImage || $blog->galleryImages->count() > 0))
                                <div class="mb-4">
                                    <p class="text-sm text-gray-600 mb-2">Current Images:</p>
                                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                        @if($blog->featuredImage)
                                            <div class="relative">
                                                <img src="{{ $blog->featuredImage->image_url }}" 
                                                     alt="Featured Image" 
                                                     class="w-full h-24 object-cover rounded-lg border border-gray-300">
                                                <span class="absolute top-1 left-1 bg-green-500 text-white text-xs px-2 py-1 rounded">
                                                    Featured
                                                </span>
                                            </div>
                                        @endif
                                        
                                        @foreach($blog->galleryImages as $galleryImage)
                                            <div class="relative">
                                                <img src="{{ $galleryImage->image_url }}" 
                                                     alt="Gallery Image" 
                                                     class="w-full h-24 object-cover rounded-lg border border-gray-300">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                            <!-- New Images Upload -->
                            <input type="file" 
                                   wire:model="images" 
                                   id="images"
                                   accept="image/*"
                                   multiple
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors">
                            <p class="text-sm text-gray-600 mt-1">Upload new images to add to existing gallery.</p>
                            @error('images.*') 
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p> 
                            @enderror
                            
                            @if ($images)
                                <div class="mt-4">
                                    <p class="text-sm text-gray-600 mb-2">New Images Preview:</p>
                                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                        @foreach($images as $index => $image)
                                            <div class="relative">
                                                <img src="{{ $image->temporaryUrl() }}" 
                                                     alt="Preview {{ $index + 1 }}" 
                                                     class="w-full h-24 object-cover rounded-lg border border-gray-300">
                                                <span class="absolute top-1 left-1 bg-blue-500 text-white text-xs px-2 py-1 rounded">
                                                    New
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Rich Text Editor for Content -->
                    <div class="mb-6">
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content *</label>
                        <div wire:ignore>
                            <div id="edit-editor" style="height: 300px;"></div>
                        </div>
                        <textarea wire:model="form.content" id="edit-content" class="hidden"></textarea>
                        @error('form.content') 
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p> 
                        @enderror
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
                        <button type="button" 
                                wire:click="closeModal" 
                                class="w-full sm:w-auto px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="w-full sm:w-auto bg-gradient-to-r from-pink-500 to-purple-600 hover:from-purple-600 hover:to-pink-500 text-white py-3 px-6 rounded-lg transition-all shadow-lg">
                            Update Blog Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    @push('scripts')
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script>
        document.addEventListener('livewire:init', function () {
            let editQuill;
            
            Livewire.on('open-update-blog-modal', function () {
                setTimeout(() => {
                    if (document.getElementById('edit-editor')) {
                        editQuill = new Quill('#edit-editor', {
                            theme: 'snow',
                            placeholder: 'Write your blog content here...',
                            modules: {
                                toolbar: [
                                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                                    ['bold', 'italic', 'underline', 'strike'],
                                    [{ 'color': [] }, { 'background': [] }],
                                    [{ 'align': [] }],
                                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                                    ['blockquote', 'code-block'],
                                    ['link', 'image'],
                                    ['clean']
                                ]
                            }
                        });

                        // Set initial content
                        editQuill.root.innerHTML = @this.get('form.content');

                        editQuill.on('text-change', function() {
                            let content = editQuill.root.innerHTML;
                            @this.set('form.content', content);
                        });
                    }
                }, 100);
            });
        });
    </script>
    @endpush
</div>