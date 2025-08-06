<div>
    @if($showModal && $modalCategory)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black/50 transition-opacity duration-300" wire:click="closeModal"></div>

            <!-- Modal -->
            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="relative w-full max-w-5xl bg-white rounded-2xl shadow-xl transform transition-all duration-300">
                    <!-- Close Button -->
                    <button wire:click="closeModal"
                        class="absolute top-4 right-4 z-10 w-10 h-10 bg-white rounded-full shadow flex items-center justify-center text-gray-600 hover:text-gray-800 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>

                    <!-- Header -->
                    <div class="bg-gradient-to-r from-purple-600 to-pink-500 text-white p-6 rounded-t-2xl">
                        <h2 class="text-2xl font-bold">{{ $modalCategory->name }}</h2>
                        <p class="text-purple-100 opacity-90 mt-1">Choose a subcategory to explore our amazing packages
                        </p>
                    </div>

                    <!-- Content -->
                    <div class="p-6 max-h-[70vh] overflow-y-auto">
                        @if($modalCategory->children->count() > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                @foreach($modalCategory->children as $subcategory)
                                    <button wire:click="selectSubCategory('{{ $modalCategory->slug }}', '{{ $subcategory->slug }}')"
                                        class="group bg-white hover:bg-purple-50 rounded-lg p-4 text-center transition-all duration-200 border border-gray-200 hover:border-purple-300 hover:shadow-md">
                                        <div class="w-12 h-12 mx-auto mb-3 bg-purple-100 rounded-full flex items-center justify-center group-hover:bg-purple-200 transition-colors">
                                            <i class="{{ $this->getCategoryIcon($subcategory->slug) }} text-purple-600"></i>
                                        </div>
                                        <h3 class="font-medium text-gray-800 group-hover:text-purple-700">
                                            {{ $subcategory->name }}
                                        </h3>
                                        @if($subcategory->description)
                                            <p class="text-xs text-gray-500 mt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                {{ $subcategory->description }}
                                            </p>
                                        @endif
                                    </button>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-box-open text-gray-400 text-xl"></i>
                                </div>
                                <h4 class="text-lg font-medium text-gray-600">No subcategories available</h4>
                                <p class="text-gray-500 mt-1">We'll add more options soon!</p>
                            </div>
                        @endif
                    </div>

                    <!-- View All Option -->
                    <div class="border-t border-gray-100 p-4 bg-gray-50 rounded-b-2xl">
                        <button wire:click="selectCategory('{{ $modalCategory->slug }}')"
                            class="group flex items-center justify-between w-full py-4 px-6 bg-white hover:bg-purple-50 rounded-xl font-semibold text-purple-700 transition-all duration-300 border-2 border-purple-100 hover:border-purple-300 shadow-sm hover:shadow-md">
                            <span class="flex items-center">
                                <i class="fas fa-box-open mr-3 text-purple-500"></i>
                                View All {{ $modalCategory->name }} Packages
                            </span>
                            <i class="fas fa-arrow-right text-purple-400 group-hover:text-purple-600 group-hover:translate-x-1 transition-all duration-300"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
