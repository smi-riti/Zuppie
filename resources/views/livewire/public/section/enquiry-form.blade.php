<div>
     @if($showModal)
        <div class="fixed inset-0 bg-black/60 backdrop-blur-md z-40 transition-all duration-300" wire:click="closeModal"></div>
    @endif

    <!-- Modal Container -->
    <div class="@if(!$showModal) hidden @endif fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6">
        <div class="relative mx-auto w-full max-w-4xl max-h-[90vh] overflow-y-auto">
            <!-- Modal Content -->
            <div class="bg-white rounded-2xl shadow-2xl border-0 overflow-hidden transform transition-all animate-in zoom-in-95 duration-300">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-purple-600 to-pink-600 px-6 py-5">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-2xl font-2xl text-white flex items-center">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                Plan Your Dream Event
                            </h3>
                            <p class="text-purple-100 text-sm mt-1">Tell us about your vision and we'll make it happen</p>
                        </div>
                        <button wire:click="closeModal" class="text-white/80 hover:text-white transition-colors rounded-full p-2 hover:bg-white/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                @if (session('message'))
                    <div class="mx-6 mt-4 px-4 py-3 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 text-green-700 font-medium border border-green-200 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('message') }}
                    </div>
                @endif

               <form wire:submit.prevent="captureEnquiry" class="space-y-6 p-5" x-data="{
    currentField: 'event_type',
    formData: {
        event_type: '',
        budget_index: 0,  // Track slider position (0-5)
        message: '',
        fullname: '',
        email: '',
        phone: ''
    },
    budgetDisplay: '₹1000', // Initialize with first option
    
    // Your other methods...
    nextField(field) {
        this.currentField = field;
    },
    skipField() {
        if (this.currentField === 'event_type') this.currentField = 'message';
        else if (this.currentField === 'budget') this.currentField = 'message';
    },
    
    updateBudgetRange(value) {
        const ranges = [
            { index: 0, value: '1000', display: '₹1000' },
            { index: 1, value: '2500', display: '₹2500' },
            { index: 2, value: '5000', display: '₹5000' },
            { index: 3, value: '10000', display: '₹10000' },
            { index: 4, value: '25000', display: '₹25000' },
            { index: 5, value: '25000+', display: '₹25k+' }
        ];
        
        const selected = ranges.find(r => r.index == value);
        this.budgetDisplay = selected.display;
        // Update Livewire with both values
        this.$wire.set('formData.budget', selected.value);
        this.$wire.set('formData.budget_index', value);
    },
    
    autoNext(field) {
        setTimeout(() => {
            this.currentField = field;
        }, 1000);
    },
    
    // Initialize the display
    init() {
        this.updateBudgetRange(this.formData.budget_index);
    }
}">
    <!-- Event Type (First Question) -->
    <div x-show="currentField === 'event_type'">
        <div>
            <label class="block text-gray-800 font-2xl mb-4 text-lg">What type of event are you planning? *</label>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                @foreach ($parentCategory as $category)
                    <div x-on:click="formData.event_type = '{{ $category->slug }}'; $wire.set('formData.event_type', '{{ $category->slug }}'); autoNext('budget')"
                        :class="formData.event_type === '{{ $category->slug }}' ? 'ring-2 ring-purple-500 bg-purple-50 shadow-md' : 'border-gray-200 hover:bg-purple-50 hover:shadow-md'"
                        class="p-4 border rounded-xl cursor-pointer transition-all duration-200 flex flex-col items-center">
                        <i class="{{ $category->icon }} text-purple-600 text-2xl mb-2"></i>
                        <p class="text-gray-700 font-medium">{{ $category->name }}</p>
                    </div>
                @endforeach
                @error('formData.event_type')
                    <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <!-- Budget Range (Second Question) -->
    <div x-show="currentField === 'budget'" class="space-y-4">
        <div>
            <label class="block text-gray-800 font-2xl mb-4 text-lg">What's your estimated budget range? *</label>
            <div class="px-2">
              <input wire:model="formData.budget_index" type="range"
                    x-model="formData.budget"
                    x-on:input="updateBudgetRange($event.target.value); autoNext('message')"
                    min="0" max="5" step="1"
                    class="w-full h-3 bg-gray-200 rounded-full appearance-none cursor-pointer accent-purple-600">
                <div class="flex justify-between text-xs text-gray-500 mt-3 px-1">
                    <span class="text-center">₹1000</span>
                    <span class="text-center">₹2500</span>
                    <span class="text-center">₹5000</span>
                    <span class="text-center">₹10000</span>
                    <span class="text-center">₹25000</span>
                    <span class="text-center">₹25k+</span>
                </div>
                @error('formData.budget')
                    <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4 p-3 bg-purple-50 rounded-lg">
                <span class="text-gray-700">Selected budget: </span>
                <span x-text="budgetDisplay" class="font-2xl text-purple-700"></span>
            </div>
        </div>
        <div class="flex justify-between items-center">
            <button type="button" @click="currentField = 'event_type'"
                class="text-gray-500 hover:text-gray-700 text-sm font-medium transition-colors">
                ← Back
            </button>
            <button type="button" @click="skipField"
                class="bg-purple-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-purple-700 transition-colors">
                Skip →
            </button>
        </div>
    </div>

    <!-- Event Details -->
    <div x-show="currentField === 'message'" class="space-y-4">
        <div>
            <label class="block text-gray-700 font-2xl mb-2">Tell Us About Your Event *</label>
            <textarea wire:model="formData.message" rows="5"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300"
                placeholder="Share your vision, requirements, theme ideas, and any special requests..."></textarea>
            @error('formData.message')
                <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex justify-between items-center">
            <button type="button" @click="currentField = 'budget'"
                class="text-gray-500 hover:text-gray-700 text-sm font-medium transition-colors">
                ← Back
            </button>
            <button type="button" @click="autoNext('contact_info')"
                class="bg-purple-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-purple-700 transition-colors">
                Continue
            </button>
        </div>
    </div>

    <!-- Contact Information -->
    <div x-show="currentField === 'contact_info'" class="space-y-6">
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-2xl mb-2">Full Name *</label>
                <input wire:model="formData.fullname" type="text"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300"
                    placeholder="Your full name">
                @error('formData.fullname')
                    <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700 font-2xl mb-2">Email Address *</label>
                <input wire:model="formData.email" type="email"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300"
                    placeholder="your@email.com">
                @error('formData.email')
                    <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-2xl mb-2">Phone Number</label>
                <input wire:model="formData.phone" type="tel"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300"
                    placeholder="(555) 123-4567">
                @error('formData.phone')
                    <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div>
                            <label class="block text-sm font-medium text-purple-700 mb-1">Add Images</label>
                            <input type="file" accept="image/*" multiple wire:model="images"
                                class="block w-full text-sm text-purple-700 border border-purple-100 rounded-lg shadow-sm">
                            <div class="flex flex-wrap gap-2 mt-2">
                                @if($images)
                                    @foreach($images as $image)
                                        <img src="{{ $image->temporaryUrl() }}"
                                            class="h-24 w-24 object-cover rounded border border-pink-200 shadow" alt="Preview">
                                    @endforeach
                                @endif
                            </div>
                            @error('images.*')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
        </div>
        
        <div class="flex justify-between items-center">
            <button type="button" @click="currentField = 'message'"
                class="text-gray-500 hover:text-gray-700 text-sm font-medium transition-colors">
                ← Back
            </button>
            <button type="submit"
                class="w-fit bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 px-4 rounded-lg font-2xl text-lg hover:shadow-lg hover:scale-[1.02] transition-all duration-300 flex items-center justify-center space-x-2">
                <i class="fas fa-paper-plane"></i>
                <span>Send Message</span>
            </button>
        </div>

        @if (session()->has('message'))
            <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('message') }}
            </div>
        @endif

        <p class="text-sm text-gray-500 text-center mt-4">
            We'll get back to you within 24 hours to discuss your magical event!
        </p>
    </div>
</form>
            </div>
        </div>
    </div>
</div>